<?php
session_start();
if (!isset($_SESSION['emailPatient'])) {
    header('Location:../login.php');
    exit;
}
include("../inc/connect.php");
include("../inc/functions/sqlFunctions.php");

$idP= $_SESSION['idP'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Page d'accuile</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
     <link rel="stylesheet" type="text/css" href="style/css/tables.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

 <?php include("sidemenu.php"); ?>
 <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Page d'accuile</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['NomPatient']) ?></span>
            </div>
        </nav>

    <div class="home-content">
      <div class="overview-boxes">
<div class="search-container">
    <button type="submit" name="ajouter" value="Ajouter"  onclick="Ajouter()">Ajouter</button>
</div>
            <table>
                <thead>
                    <th>N°</th>
                    <th>Date</th>
                    <th>Status</th>
                     <th>Action</th>
                </thead>
                <?php
                 $query = "select * from test where idPatient='".$idP."'";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
          $i=1;
          if($Count>0)  {
            while($row= $q->fetch()) {
                $num = $row['numTest'];
                $status=  $row['status'];
                 echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['dateTest'].'</td>
                    <td>'.$row['status'].'</td>';
               switch($status) {
                 case"en attente de sortie de résultat": case "en attente d'ajout de noms": echo('<td>/</td></tr>'); break ;
                  case"complete": echo('<td><a href=gen.php?id='.$num.' target="_blank">Generate PDF</a></td></tr>'); break ;
                 }
                  $i++;
                 }
          }else {
          echo"<tr><td>Aucune donnée disponible</td></tr>";
          }
                 ?>
            </table>
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
function Ajouter() {
  window.location.href = "ajouterRDV.php";
}
</script>
</body>

</html>
