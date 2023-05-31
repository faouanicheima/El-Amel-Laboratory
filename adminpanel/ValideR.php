  <?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
include("../inc/connect.php");
include("../inc/functions/functions.php");
include("../inc/functions/sqlFunctions.php");
include("../inc/functions/webSiteInformations.php");
require '../inc/lib/PHPMailer/src/Exception.php';
require '../inc/lib/PHPMailer/src/PHPMailer.php';
require '../inc/lib/PHPMailer/src/SMTP.php';
$num = $_GET["num"];
checkStatus($num,"en attente de validation","ValideList.php",$conn);
$query = "select p.nomP,p.prénomP,p.emailP,p.sexeP from patient p INNER JOIN test t on p.idPatient=t.idPatient where t.numTest='".$num."'";
      $q = $conn->query($query);
        while($row= $q->fetch()) {
          $nomP= $row['nomP'];
          $prenomP= $row['prénomP'];
          $emailP= $row['emailP'];
          $sexeP= $row['sexeP'];
        }
        $nomC= $nomP.' '.$prenomP;
        if($sexeP=="m") $s= "Cher";
        else  $s= "Chère";
?>
<html>
     <head>
  <title>Valider Un RDV</title>
<link rel="stylesheet" href="style/css/style.css" type="text/css">
<link rel="stylesheet" href="style/css/forms.css" type="text/css">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
     <?php include("sidemenu.php"); ?>
        <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Valider Un RDV</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']); ?></span>
            </div>
        </nav>
            <div class="home-content">
                <div class="centre">
    <form action="" method="post">
        <?php
         $queryN = "select a.idAnalyse, a.nomA ,a.référencesA, dt.résultat  from  test t INNER JOIN détail_test dt  on dt.numTest=t.numTest INNER JOIN analyse a on  dt.idAnalyse=a.idAnalyse where t.numTest='".$num."'";
      $qN = $conn->query($queryN);
      $Count = $qN->rowCount();
      $i=0;
      $arr = array();
        while($rowN= $qN->fetch()) {
           echo"<div class='content'><label for=''>".$rowN['nomA'].":</label>
        <input type='radio' name='test".$i."' value ='oui' />
        <label for=''>Oui</label>
        <input type='radio' name='test".$i."'  value ='Non' />
        <label for=''>Non</label>
         <p>Range est :".$rowN['référencesA']." et Resultats est :".$rowN['résultat']."</p>
         <br></div>";
         $arr[] = $rowN['idAnalyse'];
         $i++;
        }

?>
<button type="submit" name="valider">Valider</button>
    </form>

    <?php
    if(isset($_POST['valider'])){
    $validite=array();
     foreach($_POST as $name => $value) {
      $validite [$name]=$value;
      }
      $i=0;
      foreach($validite as $key => $value){
        if($i<$Count){
          $updateQuery = "UPDATE détail_test SET décision='".$value."' WHERE numTest='".$num."' AND idAnalyse='".$arr[$i]."'";
          $stmt= $conn->prepare($updateQuery);
         $stmt->execute();
         if(!$stmt){
        echo"<div class='error-msg'>ERROR</div>";
         }
        }
           
      }
          $Subject="Resultat sortie !!";
      $body = $s." ".$nomC.",<br>
Nous vous écrivons pour vous informer que les résultats de votre tests sont maintenant disponibles. Vous pouvez les récupérer en personne à notre adresse pendant nos heures d'ouverture.<br>
Si vous avez des questions ou des préoccupations concernant vos résultats, n'hésitez pas à nous contacter. Nous sommes là pour vous aider.<br>
Vous pouvez  imperimer  votre test via cette lien : ".$lien."/patientpanel/gen.php?id=".$num."<br>
Cordialement,
".$nomLabo;
     sendMail($nomC,$emailP,$Subject,$body,$conn);
echo'<div class="info-msg">Vous pouvez imprimer les documents en cliquant sur  <a href=gen.php?num='.$num.'>ce lien<a/></div>';
$status = "en attente dimpression";
    $sqlS = "UPDATE test SET status = '".$status."'  WHERE numTest = '".$num."'";
    $stmtS = $conn->prepare($sqlS);
    $stmtS->execute();
    header("Location:ValideList.php");
             ob_end_flush();
              exit(); 
    }
    ?>
    </div>
</div>
  </section>
  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
</script>
</body>
</html>
