<?php
include("../inc/connect.php");
include("../inc/functions/sqlFunctions.php");
require("../inc/lib/pdf/autoload.php");
include("../inc/functions/webSiteInformations.php");
$id= $_GET['id'];
checkStatus($id,"en attente dimpression","index.php",$conn);
$status = "complete";
$sqlS = "UPDATE test set status=? where numTest=?";
    $stmtS= $conn->prepare($sqlS);
$stmtS->execute([$status,$id]);
$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('style/css/pdf.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

       $header ='<h1>'.$nomLabo.'</h1>';
$mpdf->WriteHTML($header);

     $query = "SELECT * FROM rendez_vous r INNER JOIN test t ON r.idPatient = t.idPatient INNER JOIN patient p on r.idPatient=p.idPatient where  t.numTest='".$id."'";
      $q = $conn->query($query);
      $q->setFetchMode(PDO::FETCH_ASSOC);
       while($row= $q->fetch()) {
              $prenomP=$row['prénomP'];
              $nomP=$row['nomP'];
              $telP="0".$row['télP'];
              $emailP=$row['emailP'];
              $addressP=$row['adresseP'];
              $dateP=$row['datenaissP'];
              $con = $row['numCon'];
          }
          $mpdf->SetTitle($nomP." ".$prenomP."-F".$id);
          $totalPrix = getTotalPrice($id,$conn);
$box ='<div id="box">
        <label>Prenom:</label><label>'.$prenomP.'</label> <br>
        <label>Nom:</label><label>'.$nomP.'</label> <br>
        <label>Mobile:</label><label>'.$telP.'</label> <br>
        <label>Email:</label><label>'.$emailP.'</label> <br>
        <label>Date:</label><label>'.$dateP.'</label> <br>
    </div>';
$mpdf->WriteHTML($box);
  $table="<table>
    <tr>
        <th>N°</th>
         <th>Nom</th>
         <th>résultat</th>
         <th>références</th>
         <th>décision</th>
    </tr>";
$mpdf->WriteHTML($table);
 $query1 = "SELECT a.nomA,a.référencesA ,a.unitéA , dt.résultat,dt.décision from détail_test dt  INNER JOIN analyse a on a.idAnalyse=dt.idAnalyse where dt.numTest='".$id."'";
      $q1 = $conn->query($query1);
      $q1->setFetchMode(PDO::FETCH_ASSOC);
      $i=1;
       while($row1= $q1->fetch()) {
           $ro="<tr>
      <td>".$i."</td>
      <td>".$row1["nomA"]."</td>
      <td>".$row1["résultat"]." ".$row1["unitéA"]."</td>
      <td>".$row1["référencesA"]."</td>
      <td>".$row1["décision"]."</td>
  </tr>";
  $mpdf->WriteHTML($ro);
   $i++;
          }
$mpdf->WriteHTML("</table>");
$footer ="<footer>
    <hr>
    <p>Address:".$adressLC." Mobile :".$telLabo." FIX:".$fixeLabo." FAX:".$faxLabo." Email:".$emailLabo."</p>
</footer>";
$mpdf->WriteHTML($footer);
$mpdf->AddPage();
 $mpdf->WriteHTML($header);
$mpdf->WriteHTML($box);
  $table="<table>
    <tr>
        <th>N°</th>
         <th>Nom</th>
         <th>Prix</th>
    </tr>";
$mpdf->WriteHTML($table);
 $query1 = "SELECT a.nomA,a.prixA,a.unitéA from détail_test dt  INNER JOIN analyse a on a.idAnalyse=dt.idAnalyse where dt.numTest='".$id."'";
      $q1 = $conn->query($query1);
      $q1->setFetchMode(PDO::FETCH_ASSOC);
      $i=1;
       while($row1= $q1->fetch()) {
           $ro="<tr>
      <td>".$i."</td>
      <td>".$row1["nomA"]."</td>
      <td>".$row1["prixA"]."</td>
  </tr>";
  $mpdf->WriteHTML($ro);
  $i++;
          }
$mpdf->WriteHTML("</table>");
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
$mpdf->WriteHTML($footer);
$mpdf->Output();
?>

