<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
 $id= $_GET['id'];
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
        <label>Réduction</label>
        <input type="number"  name="red" min="1" max="100"  /><br>
         <label for="">Objet</label>
        <input type="text" name="obj"/><br>
        <label>Date</label>
       <input type="date" name="fin" min="<?php echo date("Y-m-d"); ?>" />
        <button type="submit" name="ajouter">Ajouter</button>
       </table>
       </form>
       <?php
        if(isset($_POST['ajouter'])){
               $debut=date("Y-m-d");
              $red=$_POST['red'] ;
              $obj=$_POST['obj'];
               $fin=$_POST['fin'];
               $sql = "INSERT INTO `convention`(`réductionC`, `dateDC`, `dateFC`, `objetC`, `codeLabo`, `idOrg`) VALUES (?,?,?,?,?,?)";
               $stmtP= $conn->prepare($sql);
                         $stmtP->execute([$red,$debut,$fin,$obj,"1",$id]);
              $stmtP->execute();
if($stmtP){
    echo"<div class='success-msg'>Convention ajoutée avec succès</div>";
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