<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
include("../inc/connect.php");
 include("../inc/functions/functions.php");
  include("../inc/functions/sqlFunctions.php");
 $currentDate = date('Y-m-d');
$min = date('Y-m-d', strtotime('-130 years', strtotime($currentDate)));
?>
<html>
     <head>
  <title>Ajouter Un RDV</title>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" />
<link rel="stylesheet" href="style/css/style.css" type="text/css">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <style>
        /* Style for the tab buttons */
.tab button {
  background-color: #f2f2f2;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 10px 20px;
  font-size: 16px;
  margin-right: 5px;
  margin-bottom: 10px;
  border-radius: 5px 5px 0 0;
}

/* Change background color of active tab button */
.tab button.active {
  background-color: #ccc;
}

/* Style for the tab content */
.tabcontent {
  display: none;
  padding: 20px;
  border: 1px solid #ccc;
  border-top: none;
  border-radius: 0 5px 5px 5px;
}

/* Show tab content when tab button is clicked */
.tabcontent.show {
  display: block;
}

/* Style for input fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="date"],
select {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
  font-size: 16px;
}

/* Style for labels */
label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

/* Style for radio button */
input[type="radio"] {
  margin-right: 10px;
}

/* Style for submit button */
button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

/* Style for form box */
.boxAdminPanel {
  margin: 20px;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 5px;
}
    </style>
     <?php include("sidemenu.php"); ?>
        <section class="home-section">
 <nav>
 <div class="sidebar-button">
 <i class='bx bx-menu sidebarBtn'></i>
 <span class="dashboard">Ajouter Un RDV</span>
 </div>
            <div class="profile-details">
                <span class="admin_name"><?php echo($_SESSION['nom_c']); ?></span>
            </div>
        </nav>
            <div class="home-content">
         <div class="tab">
  <button class="tablinks" onclick="openTab(event, 'tab1')">a un compte</button>
  <button class="tablinks" onclick="openTab(event, 'tab2')">nouveau patient</button>
</div>
<div id="tab1" class="tabcontent">
    <div class="boxAdminPanel">
      <form method="post" action="ajouterRDVD.php">
     <label for="Nom">Nom</label>
     <select data-placeholder="Choose a name..." class="ch" id="resID" name="idP"  onchange="populateSecondSelect()">
           <option value="" selected disabled hidden>Select</option>
     <?php
            $queryP = "SELECT * FROM patient ";
      $qP = $conn->prepare($queryP);
      $qP->execute();
      $Count = $qP->rowCount();
        if($Count>0) while($rowP= $qP->fetch()){
            $nomP = $rowP['nomP']." ".$rowP['prénomP'];
            echo($nomP);
               echo"<option value=".$rowP['idPatient'].">".$nomP."</option> ";
          }
             ?>
             </select><br>
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
      <label for="">Convention</label><br>
      <select data-placeholder="Choose a name..." class="ch" name="doctor">
         <option value="" selected disabled hidden>Select</option>
              <?php
               $queryO = "SELECT * FROM organisme o INNER JOIN convention c on c.idOrg=o.idOrg where c.dateFC>'".date("Y-m-d")."';";
              $qO = $conn->query($queryO);
          $qO->setFetchMode(PDO::FETCH_ASSOC);
          $CountO = $qO->rowCount();
          if($CountO>0)  {
            while($rowO= $qO->fetch()) {
                echo'<option value='.$rowO['numConv'].'>'.$rowO['désignationOrg'].'</option>';
          }
          }
            ?>
                  </select><br>
     <label for="Numero">Numero</label>
     <input type="number" max="30" min="1" name="num"  required="required"/><br>
     <button type="submit" name="add">Add</button>
 </form>
    </div>
</div>
<div id="tab2" class="tabcontent">
<div class="boxAdminPanel">
  <form method="post" action="ajouterPatient.php">
        <label >Nom</label>
        <input type="text" name="nom"  /><br>
        <label >Prenom</label>
        <input type="text" name="prenom"  /><br>
        <label >Email</label>
        <input type="email" name="email"  /><br>
         <label >Address</label>
           <?php getVilles("select")?>
        <input type="text" name="address"  /><br>
         <label >Mobile</label>
        <input type="number" name="tel"  maxlength="10"  /><br>
        <label >Date</label>
        <input type="date" name="date" min="<?php echo($min); ?>"  max="<?php echo(date("Y-m-d")); ?>" /><br>
        <label for="sexe">Sexe:</label>
<select  name="sexe" required>
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
      <br>
            <label >Numero</label>
        <input type="number" name="num" required="required" min="1"  /><br>
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
       <button type="submit" name="ajouter">Ajouter</button>
    </form>
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
// Open the default tab on page load
document.getElementById("tab1").style.display = "block";

// Function to open a tab
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;

  // Hide all tab content
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the active class from all tab links
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the selected tab content
  document.getElementById(tabName).style.display = "block";

  // Add the active class to the button that opened the tab
  evt.currentTarget.className += " active";
}
$(document).ready(function () {
$(".ch").chosen({width: "30%",no_results_text: "Oups, rien trouvé !",allow_single_deselect: true,});
});
function populateSecondSelect() {
var resNom = document.getElementById('resID').value;
    var secondSelect = document.getElementById("paName");
    var note = document.getElementById("note");
    var link = document.getElementById("link");

    if (resNom !== "") {
      secondSelect.disabled = false;
      note.style.display = 'block';
      link.href = "ajouterM.php?nom=".resNom;
      link.search = "id=" + encodeURIComponent(resNom);
    } else {
      secondSelect.disabled = true;
      note.style.display = 'none';
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the options of the second select with the response from the server
            document.getElementById('paName').innerHTML = this.responseText;
        }
    };
    xhr.open('GET', 'getPersonnes.php?nom=' + resNom, true);
    xhr.send();

}
const radioButtons = document.querySelectorAll('input[name="question"]');
const myDiv = document.getElementById('Pa');

radioButtons.forEach(button => {
    button.addEventListener('change', () => {
        if (button.value === 'non') {
            myDiv.style.display = 'block';
        } else {
            myDiv.style.display = 'none';
        }
    });
});

</script>
</body>
</html>