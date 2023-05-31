<style>
    .navbar ul li {
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    color: black ; /* set the default color to black */
    text-transform: uppercase; /* make the text uppercase */
}

.navbar ul li:hover {
    color: red; /* set the color to red when the user hovers over the element */
}
</style>
<div class="navbar">
    <img src="style/img/logo.jpg" width="200" height="50" alt="" />
 <ul>
     <li><a href="index.php#q">Vos Questions</a></li>
               <li><a href="index.php#s">Services</a></li>
               <?php
if (isset($_SESSION['emailPatient'])) {
      echo"<li><a href='patientpanel/index.php'>Espace Patient</a></li>";
      echo"<li><a href='logout.php'>Se deconnecter</a></li>";
} else {
 echo"<li><a href='login.php'>Se Identifier</a></li>";
 echo"<li><a href='registre.php'>Créer un compte</a></li>";
}
?>

           </ul>
</div>

