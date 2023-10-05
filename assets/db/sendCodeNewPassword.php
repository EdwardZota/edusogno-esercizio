<?php

session_start();
require_once __DIR__ . './DB.php';

$code = $_POST['code'];
$email = $_SESSION['currentEmail'];

$connection = DB::getConnection();

$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);

if($result->num_rows === 1){
    $row = $result->fetch_assoc();
    $trueCode = $row['codice_cambio_password'];

    if($trueCode == $code){

        $query="UPDATE `utenti` SET `codice_cambio_password` = NULL WHERE `email` = '$email";
        $connection->query($query);

        header("location: ../../newPassword.php");
        exit;
        
    }else{
        $_SESSION['code_error'] = 'Codice inserito non valido.';
        header("location: ../../codeNewPassword.php");
        exit;
    }
}