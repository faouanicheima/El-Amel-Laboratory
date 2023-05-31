<?php
include("inc/connect.php");
include("inc/functions/webSiteInformations.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Se Identifier</title>
     <link rel="stylesheet" href="style/css/forms.css" type="text/css">
      <link rel="stylesheet" href="style/indexStyle.css" type="text/css">
      <link rel="stylesheet" type="text/css" href="style/css/LoginRegsitre.css">
</head>
<body>
  <?php include("header.php");?>

      <form action="" method="post">
        <label for="username">Nom d’utilisateur :</label>
        <input type="text" id="username" name="email"><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="mdps"><br>

        <button type="submit" name="login">Connexion</button>
</form>
<?php
if(isset($_POST['login'])){
$email = $_POST["email"];
$password = md5($_POST["mdps"]);

$query = "SELECT * FROM patient WHERE emailP = '".$email."' AND MDPP = '".$password."'";
echo($query);
$statement = $conn->prepare($query);
$statement->execute();
$count = $statement->rowCount();

if ($count >0) {
    $row = $statement->fetch();
    session_start();
    $_SESSION["emailPatient"] = $email;
    $_SESSION["NomPatient"] = $row['nomP'] . " ". $row['prénomP'];
    $_SESSION["idP"] = $row['idPatient'];
    $_SESSION["sexeP"] = $row['sexeP'];
    header('Location:patientpanel/index.php');
    exit;
} else {
    echo "<div class='error-msg'>ERROR</div>";
    header("Refresh: 5; url=login.php");
    exit;
}
}

?>
<br></br>
<hr>
 <div class="center">
  <button onclick="location.href='registre.php'">Créer un compte</button>
<br></br>
<br></br>
<br></br>
<br></br>
</div>
        <?php include("footer.php"); ?>
</body>

</html>
