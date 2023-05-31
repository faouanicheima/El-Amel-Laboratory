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
    <title>Convention</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="style/css/tables.css">
     
</head>
<body>
               <style>

        </style>
 <?php include("sidemenu.php"); ?>
 <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Convention</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']);?></span>
            </div>
        </nav>

    <div class="home-content">
      <div class="overview-boxes">
<div class="search-container">
    <select name="chosse">
     <option value="" selected disabled hidden>Select</option>
     <option>en cours</option>
     <option>complété</option>
 </select>
   <button type="submit" name="sel" value="select">Selectionner</button>
    <button type="submit" name="ajouter" value="Ajouter"  onclick="Ajouter()">Ajouter</button>
</div>
            <table>
                <thead>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Precentage</th>
                    <th>Debut</th>
                    <th>Fin</th>
                     <th>Editer</th>
                </thead>
                <?php
                   if(isset($_POST['sel'])){
                   $state= $_POST['chosse'];
                   $date = date("Y-m-d");
                   switch($state){
                       case"en cours":
                        $query = 'select * from convention where fin<'.$date;
                        break ;
                         case"complété":
                        $query = 'select * from convention where fin>'.$date;
                        break ;
                   }
          $q = $conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $q->rowCount();
          $i=1;
          if($Count>0)  {
            while($row= $q->fetch()) {
                 echo'<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['nom'].'</td>
                     <td>'.$row['email'].'</td>
                    <td>'.$row['percentage'].'</td>
                    <td>'.$row['debut'].'</td>
                    <td>'.$row['fin'].' DA</td>
                   <td><a href=editerConvention.php?id='.$row['id'].'>Modifier</a></td></tr>';

                  $i++;
                 }


          }else {
          echo"<tr style='text-align: center;'><td>aucune convention trouvée</td></tr>";
          }  } else {
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
  window.location.href = " ajouterConvention.php";
}
</script>
</body>

</html>
