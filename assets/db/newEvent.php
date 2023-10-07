<?php
session_start();
require_once __DIR__ . './DB.php';

$loggedUserEmail = $_SESSION['user_email'];
$eventName = isset($_POST['event-name']) ? $_POST['event-name'] : '';
$attendeesArea = isset($_POST['attendees']) ? $_POST['attendees'] : '';
$date = date("Y-m-d H:i:s");

$attendees = $loggedUserEmail;
if (!empty($attendeesArea)) {
    $attendees .= ',' . $attendeesArea;
}

if (substr($attendees, -1) === '.' || substr($attendees, -1) === ',') {
    $attendees = substr($attendees, 0, -1);
}
$attendeesArray = explode(',', $attendees);


$connection = DB::getConnection();

//validation
$fail = false;

if (empty($eventName) || empty($attendees)) {
    $fail = true;
    $_SESSION['new_event_error'] = 'Riempi tutti i campi.';
}else if (!preg_match('/^[a-zA-Z0-9 ]+$/', $eventName)) {
    $fail = true;
    $_SESSION['new_event_error'] = 'Il nome dell\'evento deve contenere solo lettere e numeri.';
}

if (count($attendeesArray) > 0) {
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    foreach ($attendeesArray as $attender) {
        if (!preg_match($pattern, $attender)) {
            $_SESSION['new_event_error'] = 'Nel campo dei partecipanti la mail:' . $attender . ' , non è valida.';
        }
        $query = "SELECT * FROM `utenti` WHERE email = '$attender'";

        if (!$connection->query($query)) {
            $_SESSION['new_event_error'] = 'Nel campo dei partecipanti la mail:' . $attender . ' , non esiste.';
        }
    }
}

if ($fail) {
    $connection->close();
    header("Location: ../../events/create.php");
    exit;
}
//end validation


//controllo che non esiste un evento con lo stesso nome
$query = "SELECT * FROM `eventi` WHERE nome_evento = '$eventName'";

if ($connection->query($query)->num_rows == 0) {
    $query = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('$attendees','$eventName','$date')";

    if ($connection->query($query)) {

        //invio mail a tutti gli attendees
        $subject = 'Creazione nuovo evento al quale fai parte';
        $message = 'Logga con il tuo account per vedere il nuovo evento';
        $headers = 'From:update@edusogno.com';

        ini_set("SMTP", "smtp.freesmtpservers.com");
        ini_set("smtp_port", "25"); //link per il test: https://www.wpoven.com/tools/free-smtp-server-for-testing
        ini_set("sendmail_from", "update@edusogno.com");

        foreach ($attendeesArray as $attender) {
            mail($attender, $subject, $message, $headers);
        }

        $connection->close();
        $_SESSION['new_event_success'] = 'Nuovo evento creato con successo.';
        header("location: ../../index.php");
        exit;
    }
} else {
    $connection->close();
    $_SESSION['new_event_error'] = 'Esiste già un\'evento con questo nome.';
    header("Location: ../../events/create.php");
    exit;
}
