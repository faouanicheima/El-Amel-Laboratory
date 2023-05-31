<?php
session_start();
if (!isset($_SESSION['emailPatient'])) {
    header('Location:../login.php');
    exit;
}

include("../inc/connect.php");
include("../inc/functions/functions.php");
include("../inc/functions/webSiteInformations.php");
require '../inc/lib/PHPMailer/src/Exception.php';
require '../inc/lib/PHPMailer/src/PHPMailer.php';
require '../inc/lib/PHPMailer/src/SMTP.php';
$idP= $_SESSION['idP'];
$current_date = date('Y-m-d');
$min = date('Y-m-d', strtotime($current_date . ' + 1 day'));
$max = date('Y-m-d', strtotime($current_date . ' + 30 day'));

?>
<html>
     <head>
  <title>Ajouter Un RDV</title>
  <link rel="stylesheet" type="text/css" href="style/css/tabs.css">
  <link rel="stylesheet" type="text/css" href="style/css/messages.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" />
<link rel="stylesheet" href="style/css/style.css" type="text/css">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
 <link rel="stylesheet" href="style/css/forms.css" type="text/css">
</head>
<body>
     <?php include("sidemenu.php"); ?>
        <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Ajouter Un RDV</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['NomPatient']) ?></span>
            </div>
        </nav>
            <div class="home-content">
            <form action="" method="post">
             <label for="">Date</label>
             <input type="date" name="date" min="<?php echo $min; ?>" max="<?php echo $max; ?>" /><br>
             <label for="">heur</label>
              <input type="time" name="heur" min="09:00" max="16:00"><br>
     <label for="Numero">Numero</label>
     <input type="number" max="30" min="1" name="num"  required="required"/><br>
     <button type="submit" name="ajouter">ajouter</button>
 </form>
    </div>
    <?php
    if(isset($_POST['ajouter'])){
     $num = $_POST['num'];
     $date=$_POST['date'];
     $heur= $_POST['heur'];
     $time= getCurrentTime();
    $sql1 = "INSERT INTO `rendez_vous` (`idPatient`,`dateR`,heureR) VALUES (?,?,?)";
$stmt1= $conn->prepare($sql1);
$stmt1->execute([$idP,$date,$heur]);
$status="en attente dajout de noms de test";
  $sql2 = "INSERT INTO `test` (noTest,dateTest,idPatient,status) VALUES (?,?,?,?)";
$stmt2= $conn->prepare($sql2);
$stmt2->execute([$num,$date,$idP,$status]);
         if($stmt1){
             if($_SESSION['sexeP']=="m") $s= "Cher";
             else  $s= "Chère";
             $adressLC =  $addressL.",".$villeL;
               $Subject="Votre Rendez-vous ";
          $body = $s." ". $_SESSION['NomPatient']. "
Nous avons bien reçu votre demande de rendez-vous  et nous sommes ravis de vous informer que nous avons réservé une plage horaire pour vous.
Voici les détails de votre rendez-vous:
ss
Date: ".$date."
Heure: ".$heur."
Adresse: ".$adressLC."
Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. Nous serons heureux de vous aider.
Nous sommes impatients de vous rencontrer et de vous offrir un excellent service.

Cordialement,".
$nomLabo;
                sendMail($_SESSION['NomPatient'],$_SESSION['emailPatient'],$Subject,$body,$conn);
    echo"<div class='success-msg'>le rendez-vous a été ajouté avec succès</div>";
     header("Refresh: 5; url=index.php");
}else {
  echo"<div class='error-msg'>ERROR</div>";
   header("Refresh: 5; url=index.php");
}
    }
     ?>
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

     $(document).ready(function () {
                $(".ch").chosen({
                    width: "30%",
                    no_results_text: "Oops, nothing found!",
                    allow_single_deselect: true,
                });
            });
</script>
</body>
</html>