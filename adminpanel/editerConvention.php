<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
 $id = $_GET['id']; 
  $query = "SELECT * FROM `convention` WHERE id='".$id."'";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
            while($row= $q->fetch()) {
              $nom= $row['nom'];
              $pre=$row['percentage'] ;
              $email=$row['email'];
               $fin=$row['fin'];
          }
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Editer Un Convention</title>
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
 <span class="dashboard">Editer Un Convention</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']);?></span>
                </i>
            </div>
  </nav>
    <div class="home-content">
        <div class="sales-boxes">
            <div class="overview-boxes">
    <form action="" method="post">
    <table>
        <label>Nom</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>"   /><br>
        <label for="">Precentage</label>
        <input type="number" name="pre" min="1" max="100" value="<?php echo $pre; ?>"   /><br>
         <label for="">Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>"/><br>
        <label>Date</label>
       <input type="date" name="fin" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $fin; ?>" />
        <button type="submit" name="ajouter">Ajouter</button>
       </table>
       </form>
       <?php
        if(isset($_POST['ajouter'])){
            $nom= $_POST['nom'];
              $pre=$_POST['pre'] ;
              $email=$_POST['email'];
               $fin=$_POST['fin'];
       $sql = "UPDATE convention set `nom` = '".$nom."' ,`percentage` = '".$pre."' ,`email` = '".$email."',`fin` = '".$fin."' where id=".$id;
$stmt= $conn->prepare($sql);
$stmt->execute();
if($stmt){
    echo"<div class='success-msg'>la convention a été mis à jour avec succès </div>";
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
 <script>
 function show() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
 </script>
</body>

</html>