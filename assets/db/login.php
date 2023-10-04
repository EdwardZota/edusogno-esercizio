<?php

session_start();
require_once __DIR__ . './DB.php';

$connection = DB::getConnection();

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM `utenti` WHERE email = '$email' AND password = '$password'";

$result = $connection->query($query);

$connection->close();

if($result->num_rows > 0){
    header("location: ../../events.php");
    exit;
}else{
    // Credenziali non valide, memorizza il messaggio di errore nella variabile di sessione
    $_SESSION['login_error'] = "Email e/o password errati.";

    // Reindirizza alla pagina di login
    header("Location: ../../index.php");
    exit;
}

