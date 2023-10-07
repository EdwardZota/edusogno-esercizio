<?php

session_start();
require_once __DIR__ . './DB.php';

$password = isset($_POST['password']) ? $_POST['password'] : '';
$Passwordlength = strlen($password);

$new_hashed_password = password_hash($password, PASSWORD_DEFAULT);
$email = $_SESSION['currentEmail'];

//validation
$fail = false;
if (empty($password)) {
    $fail = true;
    $_SESSION['confirm_new_password_error'] = 'password non inserita.';
} else if ($Passwordlength < 4 && $Passwordlength > 20) {
    $fail = true;
    $_SESSION['confirm_new_password_error'] = 'La password deve essere tra i 4 e i 20 caratteri.';
}

if ($fail) {
    header("Location: ../../newPassword.php");
    exit;
}

// end validation

$connection = DB::getConnection();

//check email
$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);


if ($result->num_rows === 1) {
    $query = "UPDATE `utenti` SET `password` = '$new_hashed_password' WHERE email = '$email'";

    if ($connection->query($query)) {
        $_SESSION['change_password_success'] = 'Adesso puoi loggare con la nuova password.';
        header("location: ../../login.php");
        exit;
    }
}
