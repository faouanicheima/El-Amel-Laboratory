<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Editer Test</title>
    <link rel="stylesheet" href="style/css/style.css" type="text/css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="style/css/messages.css" type="text/css">
     <link rel="stylesheet" href="style/css/forms.css" type="text/css">
</head>

<body>
    <style>
    form {
        margin: 10px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        margin-top: 200px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        margin-bottom: 10px;
        font-size: 16px;
    }

    textarea {
        height: 100px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
</style>
   <?php include("sidemenu.php"); ?>
   <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Editer Test</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']);?></span>
            </div>
  </nav>
    <div class="home-content">
        <div class="sales-boxes">
            <div class="overview-boxes">
    <form action="" method="post">
        <label>Nom</label>
        <input type="text" name="nom"   /><br>
        <label for="">Références</label>
        <input type="text" name="champ"   /><br>
        <label>conditions</label>
        <textarea name="notes"  cols="30" rows="5" ></textarea> <br>
        <label for="">unite</label>
        <input   type="text" name="unite"  /><br>
        <label for="">prix</label>
        <input type="number" name="prix"  min="0" /><br>
          <label for="">Délai</label>
        <input type="text" name="delai"   /><br>
        <button type="submit" name="editer">Editer</button>
       </form>
       <?php
        if(isset($_POST['editer'])){
            $nom= $_POST['nom'];
              $ref=$_POST['champ'] ;
              $con=$_POST['notes'];
               $unite=$_POST['unite'];
              $prix=$_POST['prix'];
              $delai = $_POST['delai'];
       $sql = "INSERT INTO `analyse` (`nomA`, `référencesA`, `conditionsA`, `unitéA`, `prixA`, `délaiA`)
        VALUES ('".$nom."', '".$ref."', '".$con."', '".$unite."', '".$prix."', '".$delai."')";
$stmt = $conn->prepare($sql);
$stmt->execute();
if($stmt){
    echo"<div class='success-msg'>le test a ajoute à jour avec succès </div>";
     header("Refresh: 5; url=analyseLists.php");
  ob_end_flush();
  exit();
}else {
  echo"<div class='error-msg'>ERROR</div>";
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