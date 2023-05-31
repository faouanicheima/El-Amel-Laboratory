<!DOCTYPE html>
 <?php
 session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
$id =$_GET["id"] ;
include("../inc/connect.php");
include("../inc/functions/sqlFunctions.php");
 $num = $_GET["num"];
 $id = $_GET['id'];
checkStatus($id,"en attente dajout de noms de test","index.php",$conn);
  ?>
<html>

<head>
  <title>Ajouter  des analyse</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" />
        <link rel="stylesheet" href="style/css/style.css" type="text/css">


</head>

<body>
  <?php include("sidemenu.php"); ?>
   <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Ajouter  des analyse</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']); ?></span>
            </div>
  </nav>
    <div class="home-content">
        <div class="boxAdminPanel"> 
          <div>
              <form action="" method="post">
    <label for="">Doctor</label><br>
      <select data-placeholder="Choose a name..." class="ch" name="doctor">
         <option value="" selected disabled hidden>Select</option>
              <?php
               $queryD = "SELECT * FROM `administrateur`";
              $qD = $conn->query($queryD);
          $qD->setFetchMode(PDO::FETCH_ASSOC);
          $CountD = $qD->rowCount();
          if($CountD>0)  {
            while($rowD= $qD->fetch()) {
                echo'<option value='.$rowD['matriculeAdministrateur'].'>'.$rowD['nomA']." ".$rowD['prénomA'].'</option>';
          }
          }
            ?>
                  </select><br>
          <?php
          for($i=1;$i<$num+1;$i++)  {
              echo"<label>Nom du TEST :".$i." </label>";
              $querya = "SELECT * FROM `analyse`";
              $qa = $conn->query($querya);
          $qa->setFetchMode(PDO::FETCH_ASSOC);
          $Count = $qa->rowCount();
          echo'<select data-placeholder="Choose a name..." class="ch" name="select'.$i.'">';
           echo'<option value="" selected disabled hidden>Select</option>';
          if($Count>0)  {
            while($rowa= $qa->fetch()) {
                echo'<option value='.$rowa['idAnalyse'].'>'.$rowa['nomA'].'</option>';
          }
          }
            echo'</select><br>';
          }
         ?>
        <button type="submit"  name="ajouter">Ajouter</button>
    </form>
    <?php
   if(isset($_POST['ajouter'])){
   $values =array();
  foreach($_POST as $name => $value) {$values[]=$value; }
$doctor =$values[0];
$c;
for($i=0;$i<$num;$i++){
    $c=$i+1;
$sql = "insert into  détail_test(idAnalyse,numTest) values (?,?)";
    $stmt2= $conn->prepare($sql);
$stmt2->execute([$values[$c],$id]);
}
$status = "en attente de consultations";
$sqlS = "UPDATE test set status=?,médecinTraitant=? where numTest=?";
    $stmtS= $conn->prepare($sqlS);
$stmtS->execute([$status,$doctor,$id]);
if($stmtS){
 header("Location:index.php");
             ob_end_flush();
               exit();
}else {
 echo"<div class='error-msg'>ERROR</div>";
         header("Refresh: 5; url=ajouterNoms.php?id=".$last_id."&num=".$num);
         ob_end_flush();
               exit();
}
            }


 ?>
          </div></div>
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
 <script>
 $(document).ready(function () {
 $(".ch").chosen({
 width: "30%",
 no_results_text: "Oops, nothing found!",
 allow_single_deselect: true,
                });
            });
        </script>
</body>
</html>