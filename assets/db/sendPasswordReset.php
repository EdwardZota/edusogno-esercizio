<?php

session_start();
require_once __DIR__ . './DB.php';

$email = $_POST['email'];

$connection = DB::getConnection();

//control if mail exist
$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);


if($result->num_rows === 1){
    $codeNewPassword = mt_rand(100000,999999);
    $_SESSION['currentEmail'] = $email;
    
    $query = "UPDATE `utenti` SET `codice_cambio_password` = '$codeNewPassword' WHERE `utenti`.`email` = '$email';";

    if($connection->query($query)){
        //send email
        $subject = 'Recupero Password';
        $message = 'Per reimpostare la tua password, inserisci il seguente codice di recupero: '.$codeNewPassword;
        $headers = 'From:update@edusogno.com';
        
        ini_set("SMTP", "smtp.freesmtpservers.com");
        ini_set("smtp_port", "25"); //link per il test: https://www.wpoven.com/tools/free-smtp-server-for-testing
        ini_set("sendmail_from", "update@edusogno.com");
    
        if(mail($email,$subject,$message,$headers)){
            $_SESSION['send_mail_success'] = 'E-mail di recupero password inviata con successo.';
            header("location: ../../codeNewPassword.php");
            exit;
        }
    }
    $connection->close();   

    }else{

        $connection->close();
        $_SESSION['send_mail_failed'] = 'E-mail inserita non esistente.';
        header("location: ../../forgotPassword.php");
        exit;
}
