<?php

session_start();
require_once __DIR__ . './DB.php';

$connection = DB::getConnection();

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//controllo che non esiste una mail gia registrata
$query = "SELECT * FROM `utenti` WHERE email = '$email'";

if($connection->query($query)->num_rows == 0){
    $query = "INSERT INTO utenti (nome, cognome, email, password) VALUES ('$name','$surname','$email','$hashed_password')";
    
    if($connection->query($query)){
        $_SESSION['registration_success'] = 'Adesso puoi loggare con il tuo nuovo account.';
        header("location: ../../login.php");
        exit;
    }
}else{
    $_SESSION['registration_error'] = 'La e-mail da te inserita esiste già.';

    header("Location: ../../registration.php");
    exit;
}

