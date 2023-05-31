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
    <title>Page d'accuile</title>
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
 <span class="dashboard">Page d'accuile</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']);?></span>
            </div>
        </nav>
    <div class="home-content">
      <div class="overview-boxes">
<div class="search-container">
     <form action="" method="post">
    <select name="chosse">
     <option value="" selected disabled hidden>Select</option>
     
     
     <option>en attente de consultations</option>
     <option>en attente de resulat</option>
     <option>en attente dimpression</option>
     <option>en attente dajout de noms de test</option>
     <option>en attente de validation</option>
 </select>
   <button type="submit" name="sel" value="select">Selectionner</button>
 </form>
    <button type="submit" name="ajouter" value="Ajouter"  onclick="Ajouter()">Ajouter</button>
</div>
            <table>
                <thead>
                    <th>N°</th>
                    <th>Nom Complet</th>
                    <th>Mobile</th>
                    <th>Date</th>
                     <th>Action</th>
                </thead>
                <?php
               if(isset($_POST['sel'])){
                   $status= $_POST['chosse'];
           $query = "select * from patient p INNER JOIN test t on p.idPatient=t.idPatient where t.status='".$status."'";
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
          $i=1;
          if($Count>0)  {
            while($row= $q->fetch()) {
                $nomC =   $row['nomP'] ." " .$row['prénomP'];
                $num = $row['numTest'];
                 echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$nomC.'</td>
                    <td>0'.$row['télP'].'</td>
                    <td>'.$row['dateTest'].'</td>';
                 switch($status){
                case"en attente de consultations": echo('<td><a href=Vignete.php?id='.$num.' target="_blank">Vignete</a></td></tr>'); break ;
                  case"en attente de resulat": echo('<td><a href=editeRDV.php?id='.$num.'>Ajouter des résultats</a></td></tr>'); break ;
                  case"en attente dimpression": echo('<td><a href=gen.php?id='.$num.' target="_blank">Generate PDF</a></td></tr>'); break ;
                  case"en attente dajout de noms de test": echo('<td><a
                  href=ajouterNoms.php?id='.$num.'&num='.$row['noTest'].'>Ajouter des tests</a></td></tr>'); break ;
                 }
                
                  $i++;
                 }
          }else {
          echo"<tr><td>Aucune donnée disponible</td></tr>";
          }
          } else  echo"<tr><td>Veuillez sélectionner</td></tr>";

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
