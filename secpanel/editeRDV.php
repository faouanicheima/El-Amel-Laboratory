<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
 include("../inc/connect.php");
 include("../inc/functions/sqlFunctions.php");
$id = $_GET['id'];
checkStatus($id,"en attente de resulat","index.php",$conn);
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Ajouter des résultats</title>
      <link rel="stylesheet" href="style/css/messages.css" type="text/css">
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
 <span class="dashboard">Ajouter des résultats</span>
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
  <?php
   $querya = "SELECT* FROM  détail_test dt  INNER JOIN analyse a on dt.idAnalyse=a.idAnalyse where dt.numTest='".$id."'";
          $qa = $conn->query($querya);
          $qa->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $qa->rowCount();
          $array = array();
          $i=0;
            while($rowa= $qa->fetch()) {
                 if ($rowa["résultat"]=="/") {
            echo'<tr>
       <td>'.$rowa["nomA"].'</td>
        <td><input type="text" name="insert'.$i.'" value="'.$rowa["résultat"].'" required="required"/></td>
   </tr>';
   $array[] =$rowa["idAnalyse"];
   $i++;
        }
          }
   ?>
        <tr><td><button type="submit" name="edit">Edit</button></td></tr>
       </table>
       </form>
       <?php
       if(isset($_POST['edit'])){
         $i=0;
         $values = array();
       if(isset($_POST['edit'])){
  $result = true;
  $i=0;
  foreach ($_POST as $name => $value) {
    if ($value !== '/' && $i<$Count) {
      $idA = $array[$i];
      $sql = "UPDATE détail_test SET `résultat` ='".$value."' WHERE `numTest` = '".$id."' and idAnalyse='".$idA."'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    $values[]=  $value;
    $i++;
  }
    for($i=0;$i<sizeof($values);$i++){
        if($values[$i]=="/"){
            $result= false ;
            break ;
        }
    }
  if ($result) {
    // Update the status of the test
    $status = "en attente de validation";
    $date= date("Y-m-d");
    $sqlS = "UPDATE test SET status = '".$status."' , DateRésultatT='".$date."' WHERE numTest = '".$id."'";
    $stmtS = $conn->prepare($sqlS);
    $stmtS->execute();
  }

  header("Refresh: 5; url=index.php");
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