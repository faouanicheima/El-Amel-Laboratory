<?php

function randomePassword(){
    $passwordLength = 8;

// Define the character set for the password
$characterSet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?";

// Initialize an empty password string
$password = "";

// Generate a random password
for ($i = 0; $i < $passwordLength; $i++) {
    $password .= $characterSet[rand(0, strlen($characterSet) - 1)];
}
return $password;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($toName,$toEmail,$Subject,$Content,$conn ){
    include("webSiteInformations.php");
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = $emailLabo;
$mail->Password = $EmailPassword;
$mail->setFrom($emailLabo, $nomLabo);
$mail->addAddress($toEmail, $toName);
$mail->Subject = $Subject;
$mail->msgHTML($Content); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported';
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}
}

function isMobileNumber($mobile) {
    return (strlen($mobile) == 10 && (substr($mobile, 0, 2) == "05" || substr($mobile, 0, 2) == "06" || substr($mobile, 0, 2) == "07"));
}
function getCurrentTime (){
    $timezone = new DateTimeZone('Africa/Algiers');
$date = new DateTime('now', $timezone);
$date->setTimezone(new DateTimeZone('GMT+2'));
$current_time = $date->format('H:i');
return $current_time;
}

?>