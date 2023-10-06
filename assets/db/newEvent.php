<?php
session_start();
require_once __DIR__ . './DB.php';

$loggedUserEmail = $_SESSION['userEmail'];
$eventName = isset($_POST['event-name']) ? $_POST['event-name'] : '';
$attendeesArea = isset($_POST['attendees']) ? $_POST['attendees'] : '';
$attendees = $loggedUserEmail . ',' . $attendeesArea;
$date = date("Y-m-d H:i:s");
$attendeesArray = explode(',', $attendees);

$connection = DB::getConnection();

//validation

if (empty($eventName) || empty($attendees)) {
    $connection->close();
    $_SESSION['new_event_error'] = 'Riempi tutti i campi.';
    header("Location: ../../events/create.php");
    exit;
} else if (!preg_match("/^[a-zA-z]*$/", $eventName)) {
    $connection->close();
    $_SESSION['new_event_error'] = 'Il campo nome evento non è valido.';
    header("Location: ../../events/create.php");
    exit;
}

$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
foreach ($attendeesArray as $attender) {
    if (!preg_match($pattern, $attender)) {
        $connection->close();
        $_SESSION['new_event_error'] = 'Nel campo dei partecipanti la mail:' . $attender . ' , non è valida.';
        header("Location: ../../events/create.php");
        exit;
    }
    $query = "SELECT * FROM `utenti` WHERE email = '$attender'";

    if (!$connection->query($query)) {
        $connection->close();
        $_SESSION['new_event_error'] = 'Nel campo dei partecipanti la mail:' . $attender . ' , non esiste.';
        header("Location: ../../events/create.php");
        exit;
    }
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
