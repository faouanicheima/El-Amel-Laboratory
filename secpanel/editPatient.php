<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
 include("../inc/functions/functions.php");
 include("../inc/functions/sqlFunctions.php");
 $id = $_GET['id'];
  $query = "SELECT * FROM `patient` where idPatient='".$id."' ";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
            while($row= $q->fetch()) {
                $ville=   $row['villeP'];
                $address= $row['adresseP'];
               $mobile= "0".$row['télP'];
               $email= $row['emailP'];
               $conNUM= $row['numCon'];
               $password= $row['MDPP'];
            }
            $queryN = "SELECT * FROM   organisme o INNER JOIN convention c  on  c.idOrg=o.idOrg where  c.numConv='".$conNUM."' ";
          $qN = $conn->query($queryN);
          $qN->setFetchMode(PDO::FETCH_ASSOC);
            while($rowN= $qN->fetch()) {
               $conNAME= $rowN['désignationOrg'];
            }

?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Editer Patient</title>
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
 <span class="dashboard">Editer Patient</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']);?></span>
            </div>
  </nav>
    <div class="home-content">
        <div class="sales-boxes">
            <div class="overview-boxes">
     <form action="" method="post">
        <label>Email</label>
        <input type="email" name="email" required="required" value="<?php echo($email); ?>" /><br>
        <label>Mobile</label>
        <input type="number" name="mobile" required="required" value="<?php echo($mobile); ?>"  /><br>

   <label for="password">Mot de passe </label>
  <input type="password"  name="password" required="required">
    <label>Address</label>
    <input type="text" name="address" required="required" value="<?php echo($address); ?>" /> <br>
       <label>Ville</label>
            <?php getVilles($ville); ?>
    <br>
         <label for="">Convention</label><br>
      <select data-placeholder="Choose a name..." class="ch" name="con">
        <?php
        if($conNUM!='0')echo" <option value='<?php echo($conNUM); ?>' selected disabled hidden><?php echo($conNAME); ?></option>";
              
               $queryO = "SELECT * FROM organisme o INNER JOIN convention c on c.idOrg=o.idOrg where c.dateFC>'".date("Y-m-d")."';";
              $qO = $conn->query($queryO);
          $qO->setFetchMode(PDO::FETCH_ASSOC);
          $CountO = $qO->rowCount();
          if($CountO>0)  {
            while($rowO= $qO->fetch()) {
                echo'<option value='.$rowO['numConv'].'>'.$rowO['désignationOrg'].'</option>';
          }
          }
            ?>
                  </select><br>
    <button type="submit" name="modifer">Modifier</button>
    </form>
  <?php
    if(isset($_POST['modifer'])){
        $cmdps = $_POST['password'];
        $con = $_POST['con'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         $ville = $_POST['ville'];
        if(isMobileNumber($mobile)){
$query= "UPDATE `patient` SET `adresseP` = '".$address."',`MDPP` = '".$cmdps."',`télP` = '".$mobile."' ,`emailP` = '".$email."' , villeP='".$ville."' , numCon='".$con."' WHERE idPatient = '".$id."' ";
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