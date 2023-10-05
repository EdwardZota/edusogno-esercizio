<?php

session_start();
require_once __DIR__ . './DB.php';

$connection = DB::getConnection();

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);

$connection->close();

if($result->num_rows === 1){

    $row = $result->fetch_assoc();
    $user= $row['nome'];
    $userEmail= $row['email'];
    $db_hashed_password = $row['password'];

    if(password_verify($password,$db_hashed_password)){
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $user;
        $_SESSION['userEmail'] = $userEmail;
        header("location: ../../index.php");
        exit;
    }else{
        $_SESSION['login_error'] = "la password inserita non è valida";
        header("Location: ../../login.php");
        exit;
    }

}else{
    // Credenziali non valide, memorizza il messaggio di errore nella variabile di sessione
    $_SESSION['login_error'] = "l'email inserita non e valida";

    // Reindirizza alla pagina di login
    header("Location: ../../login.php");
    exit;
}

