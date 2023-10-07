<?php

session_start();
require_once __DIR__ . './DB.php';

$code = isset($_POST['code']) ? $_POST['code'] : '';
$email = $_SESSION['currentEmail'];

$connection = DB::getConnection();

//control if mail exist
$query = "SELECT * FROM `utenti` WHERE email = '$email'";
$result = $connection->query($query);

//validation
$length = strlen($code);
$fail = false;

if (empty($code)) {
    $fail = true;
    $_SESSION['code_error'] = 'Nessun codice inserito.';
} else if ((!preg_match("/^[0-9]*$/", $code) || ($length < 6 && $length > 6))) {
    $fail = true;
    $_SESSION['code_error'] = 'Codice inserito non valido.';
}

if ($fail) {
    $connection->close();
    header("location: ../../codeNewPassword.php");
    exit;
}
//end validation

if ($result->num_rows === 1) {
    //Fetches one row of data from the result set and returns it as an associative array
    $row = $result->fetch_assoc();
    $trueCode = $row['codice_cambio_password'];

    if ($trueCode == $code) {

        $query = "UPDATE `utenti` SET `codice_cambio_password` = NULL WHERE `email` = '$email'";
        $connection->query($query);
        $connection->close();

        header("location: ../../newPassword.php");
        exit;
    } else {
        $connection->close();
        $_SESSION['code_error'] = 'Codice inserito non valido.';
        header("location: ../../codeNewPassword.php");
        exit;
    }
}
