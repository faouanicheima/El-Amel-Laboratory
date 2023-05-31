<footer>
     <div class="upper-footer">
      <div class = "footer-column">

                <h3>Info</h3>
                <ul class="fa-ul">
<li><span class="fa-li"><i class="fa fa-phone" aria-hidden="true"></i></span> <p>Mobile : <?php  echo($telLabo); ?></p></li>
<li><span class="fa-li"><i class="fa fa-fax" aria-hidden="true" ></i></span> <p>Fax : <?php  echo($faxLabo); ?></p></li>
<li><span class="fa-li"><i class="fa fa-fax" aria-hidden="true" ></i></span> <p>Fix : <?php  echo($fixeLabo); ?></p></li>
<li><span class="fa-li"><i class="fa fa-envelope" aria-hidden="true" ></i></span> <p><?php  echo($emailLabo); ?></p></li>
<li><span class="fa-li"><i class="fa fa-location-arrow" aria-hidden="true" ></i></span> <p>Address: <?php  echo($adressLC); ?></p></li>

                </ul>
            </div>

            <div class = "footer-column">
                <h3>Liens</h3>
<ul class="fa-ul">
<li><span class="fa-li"><i class="fa fa-link"></i></span><a href="index.php">Page d'accuile</a></li>
<li><span class="fa-li"><i class="fa fa-link"></i></span><a href="index.php#q">Vos Questions</a></li>
<li><span class="fa-li"><i class="fa fa-link"></i></span><a href="index.php#s">Services</a></li>

<?php
if (isset($_SESSION['emailPatient'])) {
      echo"<li><span class='fa-li'><i class='fa fa-link'></i></span><a href='patientpanel/index.php'>Espace Patient</a></li>";
} else {
 echo"<li><span class='fa-li'><i class='fa fa-link'></i></span><a href='login.php'>Se Identifier</a></li>";
 echo"<li><span class='fa-li'><i class='fa fa-link'></i></span><a href='registre.php'>Créer un compte</a></li>";

}
?>
                </ul>
            </div>

            <div class = "footer-column">
                <h3>à propos de nous</h3>
                <p></p>Le choix du bon laboratoire médical est un facteur important à prendre en compte qui influence de manière significative le traitement d'un patient.</p>
                            <div class="social-icons">
    <ul class="horizontal-list">
      <i class="fa-brands fa-facebook"></i><a href="<?php echo($facebook);?>">Facebook</a>
  <i class="fa-brands fa-twitter"></i><a href="<?php echo($twiter);?>">Twiter</a>   
    </ul>
</div>
            </div>

     </div>
   
            <div cllass="lower-footer"><p>©CopyRights to <?php echo($nomLabo."-".date("Y"));?></p>  </div>
</footer>
