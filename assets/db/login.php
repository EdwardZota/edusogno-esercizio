<?php

session_start();
require_once __DIR__ . './DB.php';


$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

//validation
$fail = false;
$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

if (empty($email) || empty($password)) {
    $fail = true;
    $_SESSION['login_error'] = "Riempi tutti i campi.";
} else if (!preg_match($pattern, $email)) {
    $fail = true;
    $_SESSION['login_error'] = "l'email inserita non e valida";
}

if ($fail) {
    $connection->close();
    header("Location: ../../login.php");
    exit;
}
//end validation

$connection = DB::getConnection();

//check if email already exist
$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);

$connection->close();

if ($result->num_rows === 1) {

    $row = $result->fetch_assoc();
    $user = $row['nome'];
    $user_email = $row['email'];
    $db_hashed_password = $row['password'];
    $admin_permiss = $row['permessi_admin'];

    if (password_verify($password, $db_hashed_password)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $user;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['admin_permiss'] = $admin_permiss;
        header("location: ../../index.php");
        exit;
    } else {
        $_SESSION['login_error'] = "la password inserita non è valida";
        header("Location: ../../login.php");
        exit;
    }
} else {
    $_SESSION['login_error'] = "l'email inserita non e valida";
    header("Location: ../../login.php");
    exit;
}
