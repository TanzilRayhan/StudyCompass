<?php
    require_once('../model/messagesModel.php');

    if(!isset($_COOKIE['admin']))
    {
        header("location: ../view/login.php");
    }
    $receivedEmail=$_REQUEST['email'];
    $message=$_REQUEST['response'];
    $receiverName=$_REQUEST['username'];
    //echo $receivedEmail. $senderEmail.$message;

    require "../assets/vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $mail= new PHPMailer(true);

   //$mail->SMTPDebug=SMTP::DEBUG_SERVER;

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host="smtp.gmail.com";
    $mail->SMTPSecure= PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port=587;

    $mail->Username="studycompassh083@gmail.com";
    $mail->Password="abwq fwsf bjff sjvq";
    
    $mail->setFrom("studycompass@gmail.com","study_compass");
    $mail->addAddress($receivedEmail,$receiverName);
    $mail->Subject="Reply from Study Compass";
    $mail->Body=$message;

    $mail->send();

    reply_messege($_REQUEST['id']);

    header("location: ../view/contractShow.php");
?>