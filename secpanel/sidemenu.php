<div class="sidebar">
   <?php
  include("../inc/functions/webSiteInformations.php");
     ?>
<div class="logo-details">
<i class="fas fa-flask"></i>
            <span class="logo_name"><?php echo($nomLabo); ?></span>
        </div>
         <ul class="nav-links">

 <li>
                    <a href='index.php'>
                        <i class='bx bx-grid-alt' ></i>
                        <span class='links_name'>Page d'accuile</span>
                    </a>
                </li>
                <li>
                    <a href="patients.php">
                        <i class='bx bx-box' ></i>
                        <span class="links_name">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class='bx bx-cog' ></i>
                        <span class="links_name">Profile</span>
                    </a>
                </li>
                <li class="log_out">
                    <a href="logout.php">
                        <i class='bx bx-log-out'></i>
                        <span class="links_name">Se déconnecter</span>
                    </a>
                </li>
            </ul>
    </div>