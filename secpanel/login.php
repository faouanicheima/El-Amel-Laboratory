<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
     <link rel="stylesheet" href="style/css/login.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="img">
         <img src="style/images/login.png">
        </div>
        <div class="login-content">
            <form action="" method="post">
                <img src="style/images/logo.jpg">
                <h2 class="title">Bienvenu</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>email</h5>
           		   		<input type="text" class="input" name="email" required="required">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>mot de passe</h5>
           		    	<input type="password" class="input" name="password" required="required">
            	   </div>
            	</div>
            	<a href="#">Mot de passe oublié?</a>
            	<input type="submit" name="login" class="btn" value="Connextion">
            </form>
        </div>
    </div>
    <?php
    ob_start();

if (isset($_POST["login"])) {
    include("../inc/connect.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT * FROM `secrétaire` WHERE emailS = ? AND mdpS = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$email, md5($password)]);
    $count = $statement->rowCount();
    if ($count > 0) {
        $row = $statement->fetch();
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["nom_c"] = $row['nomS']." ".$row['prénomS'];
        $_SESSION["idS"] = $row['matriculeSecrétaire'];
            header('Location:index.php');
            exit;
            ob_end_flush();
    } else {
        echo "<label>l'email ou le mot de passe est erroné</label>";
    }
}
?>
    <script type="text/javascript" src="style/js/main.js"></script>
</body>
</html>