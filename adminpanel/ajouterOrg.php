<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
 include("../inc/functions/sqlFunctions.php");
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Ajouter Un Convention</title>
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="style/css/messages.css" type="text/css">
      <link rel="stylesheet" href="style/css/forms.css" type="text/css">
</head>

<body>
<style>
    .sales-boxes{
        padding-top:100px;
    }

    </style>
  <?php include("sidemenu.php"); ?>
   <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Ajouter Un Convention</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']);?></span>
            </div>
  </nav>
    <div class="home-content">
        <div class="sales-boxes">
            <div class="overview-boxes">
    <form action="" method="post">
    <table>
        <label>Désignation</label>
        <input type="text"  name="des"   /><br>
        <label>Address</label>
        <input type="text"  name="address"  /><br>
        <label>Ville</label>
        <?php getVilles("select"); ?>
        <br>
         <label for="">Tel</label>
        <input type="number" name="tel" maxlength="10"/><br>
        <label for="">Fax</label>
        <input type="fax" name="fax" maxlength="10"/><br>
        <label>Email</label>
       <input type="email" name="email" />
        <button type="submit" name="ajouter">Ajouter</button>
       </table>
       </form>
       <?php
        if(isset($_POST['ajouter'])){
              $des=$_POST['des'] ;
               $address=$_POST['address'] ;
               $ville=$_POST['ville'] ;
               $tel=$_POST['tel'] ;
                $fax=$_POST['fax'] ;
                 $email=$_POST['email'] ;
               $sql = "INSERT INTO `organisme`(`désignationOrg`, `adresseOrg`, `villeOrg`, `télOrg`, `faxOrg`, `emailOrg`) VALUES (?,?,?,?,?,?)";
 $stmtP= $conn->prepare($sql);
           $stmtP->execute([ $des , $address,$ville,$tel,$fax,$email]);
if($stmtP){
    echo"<div class='success-msg'>Organisme ajoutée avec succès</div>";
    header("Refresh: 5; url=organisme.php");
  ob_end_flush();
  exit();
}else {
  echo"<div class='error-msg'>ERROR</div>";
  header("Refresh: 5; url=organisme.php");
  ob_end_flush();
  exit();
}
        }
        ?>
        </div>
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