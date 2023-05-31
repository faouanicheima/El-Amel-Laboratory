<?php
$querySI = "SELECT * FROM `laboratoire` where codeLabo='1' ";
          $qSI = $conn->query($querySI);
          $qSI->setFetchMode(PDO::FETCH_ASSOC);
            while($row= $qSI->fetch()) {
               $nomLabo= $row['nomLabo'];
               $addressL = $row['adresseLabo'];
               $villeL = $row['villeLabo'];
               $LogoL = $row['logoLabo'];
               $emailLabo = $row['emailLabo'];
               $telLabo = "0".$row['télLabo'];
               $fixeLabo = "0".$row['fixeLabo'];
               $faxLabo = "0".$row['faxLabo'];
               $villeLabo = $row['villeLabo'];

            }
$adressLC = $addressL.",".$villeL;
$lien = "";
$EmailPassword = "sgvlwsqtmwlygecc";
$facebook="";
$twiter="";
?>