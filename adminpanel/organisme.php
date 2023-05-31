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
    <title>Organisme</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="style/css/tables.css">
     
</head>
<body>
 <?php include("sidemenu.php"); ?>
 <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Organisme</span>
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
     <option value="0">Convention  en cours</option>
     <option  value="1">Convention complété</option>
     <option  value="2">Organisation sans convention</option>
 </select>
   <button type="submit" name="sel" value="select">Selectionner</button>
</form>
    <button type="submit" name="ajouter" value="Ajouter"  onclick="Ajouter()">Ajouter</button>
</div>
            <table>
                <?php
                   if(isset($_POST['sel'])){
                   $state= $_POST['chosse'];
                   $date = date("Y-m-d");
                   switch($state){
                       case"0":
                        $query = 'SELECT * FROM `organisme` o INNER JOIN convention C on o.idOrg=c.idOrg where c.dateFC>'.$date;
                        break ;
                         case"1":
                        $query = 'SELECT * FROM `organisme` o INNER JOIN convention C on o.idOrg=c.idOrg where c.dateFC<='.$date;
                        break ;
                        case"2":
                        $query = 'SELECT o.*FROM `organisme` o LEFT JOIN convention c ON o.idOrg=c.idOrg WHERE c.idOrg IS NULL';
                        break ;
                   }
          $q = $conn->query($query);
          $count = $q->rowCount();
          if($state==0 || $state==1) {
              $i=1;
              echo"<thead>
                    <th>N°</th>
                    <th>Désignation</th>
                    <th>Email</th>
                    <th>Tél</th>
                    <th>Ville</th>
                  <th>Modifer</th></thead>";
          if($count>0)  {
            while($row= $q->fetch()) {
                 echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['désignationOrg'].'</td>
                     <td>'.$row['emailOrg'].'</td>
                    <td>'.$row['télOrg'].'</td>
                    <td>'.$row['villeOrg'].'</td>
                     <td>'.$row['dateDC'].' DA</td>
                    <td>'.$row['dateFC'].' DA</td>
                   <td><a href=editerOrg.php?id='.$row['idOrg'].'>Modifier</a></td></tr>';
                  $i++;
                 }
          }else echo"<tr style='text-align: center;'><td>aucune convention trouvée</td></tr>";
          } else {
             $i=1;
              echo"<thead>
                    <th>N°</th>
                    <th>Désignation</th>
                    <th>Email</th>
                    <th>Tél</th>
                    <th>Ville</th>
                  <th>Ajouter</th>/thead>";
          if($count>0)  {
            while($row= $q->fetch()) {
                 echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['désignationOrg'].'</td>
                     <td>'.$row['emailOrg'].'</td>
                    <td>0'.$row['télOrg'].'</td>
                    <td>'.$row['villeOrg'].'</td>
                    <td><a href=ajouterCon.php?id='.$row['idOrg'].'>Ajouter</a></td></tr>';
                  $i++;
                 }
          }else echo"<tr style='text-align: center;'><td>aucune organisme trouvée</td></tr>";
          }
          }else {
             echo"<tr style='text-align: center;'><td>Veuillez sélectionner</td></tr>";
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
  window.location.href = "ajouterOrg.php";
}
</script>
</body>

</html>
