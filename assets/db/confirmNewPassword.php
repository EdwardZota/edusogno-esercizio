<?php 

session_start();
require_once __DIR__ . './DB.php';


$new_hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_SESSION['currentEmail'];

$connection = DB::getConnection();

$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);


if($result->num_rows === 1){
    $query = "UPDATE `utenti` SET `password` = '$new_hashed_password' WHERE email = '$email'";
    
    if($connection->query($query)){
        $_SESSION['change_password_success'] = 'Adesso puoi loggare con la nuova password.';
        header("location: ../../login.php");
        exit;
    }
}