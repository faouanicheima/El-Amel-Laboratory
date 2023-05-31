<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/pdf.css">
    <title>Vignete</title>
</head>
<body>
     <?php
      require("../inc/lib/pdf/autoload.php");
      include("../inc/connect.php");
      include("../inc/functions/sqlFunctions.php");
      include("../inc/functions/webSiteInformations.php");
     $id= $_GET['id'];
     checkStatus($id,"en attente de consultations","index.php",$conn);
     $status = "en attente de resulat";
$sqlS = "UPDATE test set status=? where numTest=?";
    $stmtS= $conn->prepare($sqlS);
$stmtS->execute([$status,$id]);
     $query = "SELECT r.dateR,r.heureR, p.nomP,p.prénomP,p.télP,p.emailP FROM rendez_vous r INNER JOIN test t ON r.idPatient = t.idPatient INNER JOIN patient p on r.idPatient=p.idPatient where  t.numTest='".$id."'";
      $q = $conn->query($query);
      $q->setFetchMode(PDO::FETCH_ASSOC);
       while($row= $q->fetch()) {
              $nom=$row['nomP'];
              $prenom=$row['prénomP'];
              $Email=$row['emailP'];
               $mobile="0".$row['télP'];
               $heur=$row['heureR'];
               $date=$row['dateR'];
               $con = $row['numCon'];
          }
          $totalPrix = getTotalPrice($id,$conn);

          $nom_c= $nom ." ".$prenom;
            $noms="";
            $queryN = "SELECT a.nomA  from  test t  INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse a on dt.idAnalyse=a.idAnalyse where t.numTest='".$id."'";
          $qN = $conn->query($queryN);
          $qN->setFetchMode(PDO::FETCH_ASSOC);
            while($row= $qN->fetch()){
               $noms =$noms." ". $row['nomA'];
            }
     $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [100, 200]]);
$stylesheet = file_get_contents('style/pdf.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("<h2>".$nomLabo."</h2>");
date_default_timezone_set('Africa/Algiers');
$date = date('Y-m-d');$time = date('H:i');
$mpdf->WriteHTML("<hr>");
$mpdf->WriteHTML('<label class="left-label">Nom: '.$nom_c.' </label>');
$mpdf->WriteHTML('<label class="left-label">Email: '.$Email.' </label>');
$mpdf->WriteHTML('<label class="left-label">Mobile: '.$mobile.' </label>');
$mpdf->WriteHTML("<hr>");
$mpdf->WriteHTML('<label class="left-label">le '.$date.' a '.$heur.' </label>');
$mpdf->WriteHTML('<label >num Test:'.$id.'</label>');
$mpdf->WriteHTML("<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=".$lien."/login.php' title='Espace Patient' />");
$mpdf->WriteHTML("<hr>");
$mpdf->WriteHTML("<label >Analyses:".$noms."</label>");
$mpdf->WriteHTML("<label >Total :".$totalPrix." DA</label>");
if($con!=0) {
           $queryC = "SELECT * from  convention where numConv='".$con."'";
      $qC = $conn->query($queryC);
      $qC->setFetchMode(PDO::FETCH_ASSOC);
       while($row= $qC->fetch()) {
              $red=$row['réductionC'];
          }
          if (strtotime($dateFC) > date("Y-m-d")) {
$prixD = $totalPrix*100/$red;
            $totalPrixN = $totalPrix- $prixD;
            $mpdf->WriteHTML("<label > Aprés Reduction  :".$totalPrixN." DA</label>");
}
          }
$mpdf->WriteHTML("<hr>");
$mpdf->WriteHTML("<p style='display: flex; justify-content: space-between;'>
  <span>FIX: ".$fixeLabo."</span>
  <span>Address: ".$adressLC."</span>
</p>
");
$mpdf->Output();
   ?>

</body>

</html>