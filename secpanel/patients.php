<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
include("../inc/connect.php");
?>
<html>
    <head>
         <link rel="stylesheet" href="style/css/style.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style/css/tables.css" type="text/css">
    </head>
    <body>

        <?php include("sidemenu.php"); ?>
        <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">patient</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']); ?></span>
            </div>
        </nav>
            <div class="home-content">
      <div class="overview-boxes">
         <table>
                <thead>
                    <th>N°</th>
                    <th>Nom Complet</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </thead>
                <?php
           $query = 'SELECT p.idPatient, p.idPatient, p.nomP, p.prénomP, p.télP, p.datenaissP , p.emailP, COUNT(r.idPatient) as numRDV FROM patient p LEFT JOIN rendez_vous r ON p.idPatient = r.idPatient GROUP BY p.idPatient';
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
          $i=1;
          if($Count>0)  {
            while($row= $q->fetch()) {
                $nom_c=  $row['nomP']." ".$row['prénomP'];
                 echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$nom_c.'</td>
                    <td>0'.$row['télP'].'</td>
                    <td>'.$row['emailP'].'</td>
                    <td>'.$row['datenaissP'].'</td>
                    <td>'.$row['numRDV'].'</td>
                    <td><a href=editPatient.php?id='.$row['idPatient'].'>Modifier</a></td>';
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
</script>


    </body>
</html>