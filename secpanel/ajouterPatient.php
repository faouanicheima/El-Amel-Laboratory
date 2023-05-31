<?php
 include("../inc/connect.php");
    include("../inc/functions/functions.php");
     include("../inc/functions/webSiteInformations.php");
     require '../inc/lib/PHPMailer/src/Exception.php';
require '../inc/lib/PHPMailer/src/PHPMailer.php';
require '../inc/lib/PHPMailer/src/SMTP.php';

               $doctor= $_POST['doctor'];

                       $prenom = $_POST['prenom'];
                   $nom = $_POST['nom'];
                   $nom_c= $_POST['nom']." ".$_POST['prenom'];
          $address = $_POST['address'];
          $ville = $_POST['ville'];
          $tel = $_POST['tel'];
          $email = $_POST['email'];
          $date = $_POST['date'];
              $sexe = $_POST['sexe'];
          $password= randomePassword() ;
          $queryR = "insert into patient(nomP,prénomP,datenaissP,sexeP,adresseP,villeP,emailP,télP,MDPP) values(?,?,?,?,?,?,?,?,?)";
          $stmtR= $conn->prepare($queryR);
           $stmtR->execute([$nom,$prenom,$date,$sexe,$address,$ville,$email,$tel,md5($password)]);
             $last_id = $conn->lastInsertId();
            if($stmtR){
              $resId = $conn->lastInsertId();
              $Subject="Votre compte ";
          $body = "Bienvenue ".$nom_c." sur notre plateforme<br>
Merci d'avoir choisi notre laboratoire<br>
Adresse e-mail :".$email."<br>
Mot de passe :".$password."<br>
Nous vous recommandons de changer votre mot de passe dès que possible pour des raisons de sécurité. Pour cela, connectez-vous à votre compte et accédez à la section  ou Profil.
Si vous rencontrez des difficultés pour vous connecter ou si vous avez des questions, n'hésitez pas à nous contacter. Nous serons heureux de vous aider.
Nous sommes impatients de vous offrir un excellent service et nous vous remercions de votre confiance.
Cordialement,
".$nomLabo;
                sendMail($nom_c,$email,$Subject,$body);
$idP = $conn->lastInsertId();
$sql1 = "INSERT INTO `rendez_vous` (`idPatient`,`dateR`,heureR) VALUES (?,?,?)";
$num = $_POST['num'];
$date=date("Y-m-d");
$heur = getCurrentTime();
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
            }
        ?>