﻿<!DOCTYPE html>
﻿<?php
session_start();
if (!isset($_SESSION['emailPatient'])) {
    header('Location:../login.php');
    exit;
}
include("../inc/connect.php");
include("../inc/functions/functions.php");
include("../inc/functions/sqlFunctions.php");
$idP= $_SESSION['idP'];
$query = "SELECT * FROM `patient` where idPatient='".$idP."' ";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
            while($row= $q->fetch()) {
                $ville=   $row['villeP'];
                $address= $row['adresseP'];
               $mobile= $row['télP'];
               $email= $row['emailP'];
               $password= $row['MDPP'];
            }
 ?>
<html>

<head>
  <title>Profile</title>
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
     <link rel="stylesheet" href="style/css/forms.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php include("sidemenu.php"); ?>
 <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Profile</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['NomPatient']) ?></span>
            </div>
        </nav>

    <div class="home-content">
      <div class="overview-boxes">

    <form action="" method="post">
        <label>Email</label>
        <input type="email" name="email" required="required" value="<?php echo($email); ?>" /><br>
        <label>Mobile</label>
        <input type="number" name="mobile" required="required" value="<?php echo("0".$mobile); ?>"  /><br>

        <label for="">Change mot de pass ?</label>
<input type="radio" name="cmdps" value="oui" onclick="showDiv()"> Oui
  <input type="radio" name="cmdps" value="no" onclick="hideDiv()"checked> No

  <div id="myDiv" style="display: none;">
   <label for="new_password">Mot de passe actuel:</label>
  <input type="password"  name="old_password" required="required" disabled>
  <br>
  <label for="confirm_password">Nouvelle mot de passe:</label>
  <input type="password" name="new_password" required="required" disabled>
  </div>
    <label>Address</label>
    <input type="text" name="address" required="required" value="<?php echo($address); ?>" /> <br>
       <label>Ville</label>
            <?php getVilles($ville); ?>
    <br>
    <button type="submit" name="modifer">Modifier</button>
    </form>
  <?php
    if(isset($_POST['modifer'])){
        $cmdps = $_POST['cmdps'];
        if($cmdps=="oui"){
            $oldPasswordF = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            if(md5($oldPasswordF)==$Password)$cmdps=md5($newPassword);
        }
        $address = $_POST['address'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         $ville = $_POST['ville'];
        if(isMobileNumber($mobile)){
$query= "UPDATE `patient` SET `adresseP` = '".$address."',`MDPP` = '".$cmdps."',`télP` = '".$mobile."' ,`emailP` = '".$email."' , villeP='".$ville."' WHERE idPatient = '".$idP."' ";
$stmt= $conn->prepare($query);
$stmt->execute();
if($stmt){
    echo"<div class='success-msg'>Les informations de profile ont été mises à jour avec succès</div>";
} else {
    echo"<div class='error-msg'>Error.</div>";
}
        } else {
          echo"<div class='error-msg'>Error sur Mobile.</div>";
        }

    }

   ?>

</div>
      </div>

 </section>
<script>
function showDiv() {
  document.getElementById('myDiv').style.display = "block";
}

function hideDiv() {
  document.getElementById('myDiv').style.display = "none";
}
</script>
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