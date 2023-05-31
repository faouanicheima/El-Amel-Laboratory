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
    <title>Analytics</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="style/css/style.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="style/css/forms.css" type="text/css"> 
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
</head>
<body>
 <?php include("sidemenu.php"); ?>
 <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Analytics</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']); ?></span>
            </div>
        </nav>

    <div class="home-content">
      <div class="overview-boxes">
<div class="search-container">
     <form action="" method="post">
    <select name="type" required>
     <option value="" selected disabled hidden>Select</option>
     <option>Visites</option>
     <option>gains</option>
 </select>
 <br></br>
  <select name="date" required>
     <option value="" selected disabled hidden>Select</option>
     <?php
     $currentDayWeek = date('N');
     $currentDay = date('d');
     $currentMonth = date('n');
     if($currentDayWeek!=0) echo"<option>Cette semaine</option>";
     if($currentDay!=1)echo"<option>Ce Mois</option>";
     if($currentYear!=1)echo"<option>Cette année</option>";
      ?>
     <option>Semaine précédente</option>
      <option>Mois précédent</option>
      <option>Cette année</option>
      <option>Année précédente</option>
 </select>
 <br></br>
   <button type="submit" name="sel" value="select">Selectionner</button>
 </form>
 <?php
         $currentMonth = date('n');
         $currentWeek = date('W');
         $currentYear = date('Y');
         $currentDay = date('N');
         $prevMonth = date('n', strtotime('-1 month'));
         $prevWeek = date('W', strtotime('-1 week'));
         $prevYear = date('Y', strtotime('-1 year'));
     if(isset($_POST['sel'])){
         if($_POST['type']=="Visites"){
             switch($_POST['date']) {
               case "Cette semaine":
               $query="SELECT DAY(dateR) AS SelectedUnit, COUNT(*) AS count FROM rendez_vous WHERE WEEK(dateR) = '".$currentWeek."' GROUP BY DAY(dateR)";
               break;
               case "Semaine précédente":
               $query="SELECT DAY(dateR) AS SelectedUnit, COUNT(*) AS count FROM rendez_vous WHERE WEEK(dateR) = '".$prevWeek."' GROUP BY DAY(dateR)";
               break;
               case "Ce Mois":$query="SELECT DAY(dateR) AS SelectedUnit, COUNT(*) AS count FROM rendez_vous WHERE Month(dateR) = '".$currentMonth."' GROUP BY DAY(dateR)";
               break;
               case "Mois précédent":$query="SELECT DAY(dateR) AS SelectedUnit, COUNT(*) AS count FROM rendez_vous WHERE Month(dateR) = '".$prevMonth."' GROUP BY DAY(dateR)";
               break;
               case "Cette année":$query="SELECT Month(dateR) AS SelectedUnit, COUNT(*) AS count FROM rendez_vous WHERE YEAR(dateR) = '".$currentYear."' GROUP BY Month(dateR)";
               break;
               case "Année précédente":$query="SELECT Month(dateR) AS SelectedUnit, COUNT(*) AS count FROM rendez_vous WHERE YEAR(dateR) = '".$prevYear."' GROUP BY Month(dateR)";
               break;
             }
                        $q = $conn->query($query);
     $q->setFetchMode(PDO::FETCH_ASSOC);
       $dataPoints = array();
     while($row= $q->fetch()){
       $dataPoint = array("y" => $row['count'], "label" => $row['SelectedUnit']);
  array_push($dataPoints, $dataPoint);
     }
     $title= "Nombre de rendez_vous de ".$_POST['date'];
     $titleY= "rendez_vous";
         } else{
        switch($_POST['date']) {
            //SELECT DAY(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE WEEK(t.dateTest) = '2' GROUP BY DAY(t.dateTest);
               case "Cette semaine":
               $query="SELECT DAY(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE WEEK(t.dateTest) = '".$currentWeek."' GROUP BY DAY(t.dateTest)";
               break;
               case "Semaine précédente":
               $query="SELECT DAY(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE WEEK(t.dateTest) = '".$prevWeek."' GROUP BY DAY(t.dateTest)";
               break;
               case "Ce Mois":
               $query="SELECT DAY(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE Month(t.dateTest) = '".$currentMonth."' GROUP BY DAY(t.dateTest)";
               break;
               case "Mois précédent":
               $query="SELECT DAY(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE Month(t.dateTest) = '".$prevMonth."' GROUP BY DAY(t.dateTest)";
               break;
               case "Cette année":
               $query="SELECT Month(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse  WHERE YEAR(t.dateTest) = '".$currentYear."' GROUP BY Month(t.dateTest)";
               break;
               case "Année précédente":
               $query="SELECT Month(t.dateTest) AS SelectedUnit, SUM(an.prixA) AS prixTotal FROM test t INNER JOIN détail_test dt ON dt.numTest = t.numTest INNER JOIN analyse an ON dt.idAnalyse = an.idAnalyse WHERE  YEAR(t.dateTest) = '".$prevYear."' GROUP BY Month(t.dateTest)";
               break;
             }
           $q = $conn->query($query);
     $q->setFetchMode(PDO::FETCH_ASSOC);
       $dataPoints = array();
     while($row= $q->fetch()){
       $dataPoint = array("y" => $row['prixTotal'], "label" => $row['SelectedUnit']);
  array_push($dataPoints, $dataPoint);
     }
     $title= "gains de ".$_POST['date'];
     $titleY= "gains En DA";
         }

     }
  ?>
</div>
<div id='chartContainer' style='height: 370px; width: 100%;'></div>
      </div>
    </div>

  </section>
  <footer><p style="margin-left:100px;">Note : Be carful is the current Month is Janury or Today is Sunday the numbre of visites and income will show in homepage not here</p></footer>
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
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text:"<?php echo $title; ?>"
	},
	axisY: {
		title: "<?php echo $titleY; ?>"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
          
</body>

</html>
