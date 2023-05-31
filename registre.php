<?php
include("inc/connect.php");
include("inc/functions/webSiteInformations.php");
include("inc/functions/sqlFunctions.php");
include("inc/functions/functions.php");
require 'inc/lib/PHPMailer/src/Exception.php';
require 'inc/lib/PHPMailer/src/PHPMailer.php';
require 'inc/lib/PHPMailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer un compte</title>
     <link rel="stylesheet" href="style/css/forms.css" type="text/css">
      <link rel="stylesheet" href="style/indexStyle.css" type="text/css">
      <link rel="stylesheet" type="text/css" href="style/css/LoginRegsitre.css">
</head>
<body>
  <?php include("header.php");?>

      <form action="" method="post">
                <label for="">Nom:</label>
                <input type="text" name="nom" required="required" /><br>
                <label for="">Prenom:</label>
                <input type="text" name="prenom" required="required"/><br>
                <label for="">Email:</label>
                <input type="email" name="email" required="required"/><br>
                <label for="">Address:</label>
                <input type="text" name="address" required="required"/><br>
             <?php getVilles("select");?>
             <br></br>
                <label for="">Mobile:</label>
                <input type="number" name="mobile" required="required"/><br>
                <label for="">Date:</label>
                <input type="date" name="date" max="<?php echo(date("Y-m-d")); ?>" /><br>
        <label for="sexe">Sexe:</label>
<select  name="sexe" required>
  <option value="male">Male</option>
  <option value="female">Female</option>
</select> <br>
                <label for="">Mot de passe:</label>
                <input type="password" name="mdps" required="required"/><br>
                <button type="submit" name="create">Créer un compte</button>
            </form>
<?php
if(isset($_POST['create'])){
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$nom_c= $prenom." ".$nom;
$address = $_POST['address'];
$tel = $_POST['mobile'];
$email = $_POST['email'];
$ville = $_POST['ville'];
$dateN = $_POST['date'];
$convention = "none";
$pass = $_POST['mdps'];
$password= md5($pass) ;
$sexe = $_POST['sexe'];
if(isMobileNumber($tel)) {
$queryR = "insert into patient(nomP,prénomP,datenaissP,sexeP,adresseP,villeP,emailP,télP,MDPP) values(?,?,?,?,?,?,?,?,?)";
$stmtR= $conn->prepare($queryR);
$stmtR->execute([$nom,$prenom,$dateN,$sexe,$address,$ville,$email,$tel,$password]);
if($stmtR){
$resId = $conn->lastInsertId();
$Subject="Votre compte ";
$body = "Bienvenue ".$nom_c." sur notre plateforme<br>
Merci d'avoir choisi notre laboratoire<br>
Adresse e-mail :".$email."<br>
Mot de passe :".$pass."<br>
Nous vous recommandons de changer votre mot de passe dès que possible pour des raisons de sécurité. Pour cela, connectez-vous à votre compte et accédez à la section  ou Profil.
Si vous rencontrez des difficultés pour vous connecter ou si vous avez des questions, n'hésitez pas à nous contacter. Nous serons heureux de vous aider.
Nous sommes impatients de vous offrir un excellent service et nous vous remercions de votre confiance.
Cordialement,
".$nomLabo;
sendMail($nom_c,$email,$Subject,$body,$conn);
session_start();
$_SESSION["emailPatient"] = $email;
$_SESSION["NomPatient"] = $nom_c;
$_SESSION["sexeP"] = $sexe;
$_SESSION["idP"] = $conn->lastInsertId();;
header('Location:patientpanel/index.php');
} else {
echo"<div class='error-msg'>ERROR</div>";
header("Refresh: 5; url=registre.php");
}
}else {
echo"<div class='error-msg'>ERROR sur mobile</div>";
header("Refresh: 5; url=registre.php");
}
  }

?>
<hr>
 <div class="center">
  <button onclick="location.href='login.php'">Se Identifier</button>
<br></br>
<br></br>
<br></br>
<br></br>
</div>
        <?php include("footer.php"); ?>
</body>
</html>