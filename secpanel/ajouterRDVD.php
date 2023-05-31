 <html>
<head>
  <title>Ajouter Un RDV</title>
    <link rel="stylesheet" type="text/css" href="style/css/messages.css">
</head>
<body>
<?php
include("../inc/connect.php");
include("../inc/functions/functions.php");
   $idP= $_POST['idP'];
   $doctor= $_POST['doctor'];
     $num = $_POST['num'];
     $date=date("Y-m-d");
     $heur = getCurrentTime();
     $sql1 = "INSERT INTO `rendez_vous` (`idPatient`,`dateR`,heureR) VALUES (?,?,?)";
$stmt1= $conn->prepare($sql1);
$stmt1->execute([$idP,$date,$heur]);
$sql2 = "INSERT INTO `test` (noTest,médecinTraitant,dateTest,idPatient) VALUES (?,?,?,?)";
$stmt2= $conn->prepare($sql2);
$stmt2->execute([$num,$doctor,$date,$idP]);
$idT = $conn->lastInsertId();
          if($stmt1){
              header("Location:ajouterNoms.php?id=".$idT."&num=".$num);
             ob_end_flush();
              exit(); 
         }else {
         echo"<div class='error-msg'>ERROR</div>";
         header("Refresh: 5; url=index-sec.php");
        }
?>
</body>
</html>