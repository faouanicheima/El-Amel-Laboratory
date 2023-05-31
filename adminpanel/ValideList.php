<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
include("../inc/connect.php");
$nom =$_SESSION['nom_c'];
$id = $_SESSION['idA']
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Validation List</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
     <link rel="stylesheet" href="style/css/tables.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
 <?php include("sidemenu.php"); ?>
 <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Validation List</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo $nom;?></span>
            </div>
        </nav>
    <div class="home-content">
            <table>
                <thead>
                    <th>N°</th>
                    <th>Nom Complet</th>
                    <th>Date</th>
                     <th>Action</th>
                </thead>
                <?php
           $query0 = "SELECT * FROM test t INNER JOIN patient p ON t.idPatient = p.idPatient WHERE t.médecinTraitant = '".$id."' and t.status='en attente de validation'  ORDER BY t.DateRésultatT DESC";
          $q0 = $conn->query($query0);
          $q0->setFetchMode(PDO::FETCH_ASSOC);
          $Count0 = $q0->rowCount();
          $i=1;
          if($Count0>0)  {
            while($row= $q0->fetch()) {
                  echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['nomP']." ".$row['prénomP'].'</td>
                    <td>'.$row['dateTest'].'</td>
               <td><a href=ValideR.php?num='.$row['numTest'].'>Valider</a></td></tr>';
                 }
                  $i++;
                }else {
          echo"<tr><td>Aucune donnée disponible</td></tr>";
          }
                 ?>
            </table>
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