<?php

session_start();
require_once __DIR__ . './DB.php';

$connection = DB::getConnection();

$name = isset($_POST['name']) ? $_POST['name'] : '';
$surname = isset($_POST['surname']) ? $_POST['surname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$Passwordlength = strlen($password);

//check that didn't exist same email inside the database
$query = "SELECT * FROM `utenti` WHERE email = '$email'";

//validation
$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
$fail = false;
if (empty($name) || empty($surname) || empty($email) || empty($password)) {
    $fail = true;
    $_SESSION['registration_error'] = 'Riempi tutti i campi.';
} else if ((!preg_match("/^[a-zA-z]*$/", $name)) || (!preg_match("/^[a-zA-z]*$/", $surname))) {
    $fail = true;
    $_SESSION['registration_error'] = 'Nel campo nome e cognome si accettano solo lettere.';
} else if (!preg_match($pattern, $email)) {
    $fail = true;
    $_SESSION['registration_error'] = 'Nel campo dell\'email si accettano solo email.';
} else if ($Passwordlength < 4 && $Passwordlength > 20) {
    $fail = true;
    $_SESSION['registration_error'] = 'La password deve essere tra i 4 e i 20 caratteri.';
}

if ($fail) {
    $connection->close();
    header("Location: ../../registration.php");
    exit;
}


// end validation

if ($connection->query($query)->num_rows == 0) {
    //check if is first email into database
    $query = "SELECT COUNT(*) as count FROM `utenti`";
    $result = $connection->query($query);

    if ($result->fetch_assoc()['count'] == 0) {
        $query = "INSERT INTO utenti (nome, cognome, email, password, permessi_admin) VALUES ('$name','$surname','$email','$hashed_password',true)";
    } else {
        $query = "INSERT INTO utenti (nome, cognome, email, password) VALUES ('$name','$surname','$email','$hashed_password')";
    }

    if ($connection->query($query)) {
        $connection->close();
        $_SESSION['registration_success'] = 'Adesso puoi loggare con il tuo nuovo account.';
        header("location: ../../login.php");
        exit;
    }
} else {
    $connection->close();
    $_SESSION['registration_error'] = 'La e-mail da te inserita esiste già.';
    header("Location: ../../registration.php");
    exit;
}
