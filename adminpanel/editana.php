<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
 $id = $_GET['id'];
   $query = "SELECT * FROM `analyse` WHERE idAnalyse='".$id."'";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
            while($row= $q->fetch()) {
                 $nom =   $row['nomA'];
                 $ref =$row['référencesA'];
                  $con= $row['conditionsA'];
                $unite =  $row['unitéA'];
                 $prix =  $row['prixA'];
                 $delai = $row['délaiA'];

          }
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
    <table>
        <label>Nom</label>
        <input type="text" name="nom" value= "<?php echo $nom; ?>"  /><br>
        <label for="">Références</label>
        <input type="text" name="champ" value= "<?php echo $ref; ?>"  /><br>
        <label>conditions</label>
        <textarea name="notes"  cols="30" rows="5" ><?php echo $con; ?></textarea> <br>
        <label for="">unite</label>
        <input   type="text" name="unite" value= "<?php echo $unite; ?>" /><br>
        <label for="">prix</label>
        <input type="number" name="prix" value= "<?php echo $prix; ?>" min="0" /><br>
          <label for="">Délai</label>
        <input type="text" name="delai" value= "<?php echo $delai; ?>"  /><br>
        <button type="submit" name="editer">Editer</button>
       </table>
       </form>
       <?php
        if(isset($_POST['editer'])){
            $nom= $_POST['nom'];
              $ref=$_POST['champ'] ;
              $con=$_POST['notes'];
               $unite=$_POST['unite'];
              $prix=$_POST['prix'];
              $delai = $_POST['delai'];
        $sql = "UPDATE `analyse` SET `nomA` = '".$nom."' ,`référencesA` = '".$ref."' ,`conditionsA` = '".$con."',`unitéA` = '".$unite."',`prixA` = '".$prix."' `délaiA` = '".$delai."' WHERE `idAnalyse` = ".$id;
$stmt= $conn->prepare($sql);
$stmt->execute();
if($stmt){
    echo"<div class='success-msg'>le test a été mis à jour avec succès </div>";
     header("Refresh: 5; url=analysLists.php");
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
        
