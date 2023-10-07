<?php
session_start();
require_once __DIR__ . './DB.php';

$eventId = isset($_POST['event-id']) ? $_POST['event-id'] : '';
$oldEventName = isset($_POST['old-event-name']) ? $_POST['old-event-name'] : '';
$newEventName = isset($_POST['event-name']) ? $_POST['event-name'] : '';
$attendeesArea = isset($_POST['attendees']) ? $_POST['attendees'] : '';
$loggedUserEmail = $_SESSION['user_email'];

if(str_contains($attendeesArea,$loggedUserEmail)){
    $attendees = $attendeesArea;
}else{
    $attendees = $loggedUserEmail . ',' . $attendeesArea;
}

if (substr($attendees, -1) === '.' || substr($attendees, -1) === ',') {
    $attendees = substr($attendees, 0, -1);
}
$attendeesArray = explode(',', $attendees);

$connection = DB::getConnection();

//validation
$fail = false;
if (empty($newEventName) || empty($attendees)) {
    $fail = true;
    $_SESSION['edit_event_error'] = 'Riempi tutti i campi.';
}

if(count($attendeesArray) > 0){
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    foreach ($attendeesArray as $attender) {
        if (!preg_match($pattern, $attender)) {
            $fail = true;
            $_SESSION['edit_event_error'] = 'Nel campo dei partecipanti la mail:' . $attender . ' , non è valida.';
        }
        $query = "SELECT * FROM `utenti` WHERE email = '$attender'";
        $result = $connection->query($query);
        if ($result->num_rows == 0) {
            $fail = true;
            $_SESSION['edit_event_error'] = 'Nel campo dei partecipanti la mail:' . $attender . ' , non esiste.';
        }
    }
}

if ($fail) {
    $connection->close();
    header("Location: ../../events/edit.php?event-name=$oldEventName");
    exit;
}

//end validation

$query = "SELECT * FROM `eventi` WHERE `id` = '$eventId'";

if ($connection->query($query)->num_rows == 1) {
    $query = "UPDATE `eventi` SET `attendees` = '$attendees', `nome_evento` = '$newEventName' WHERE `id` = '$eventId'";
    if ($connection->query($query)) {

        //invio mail a tutti gli attendees
        $subject = 'Modifica evento al quale fai parte';
        $message = 'Logga con il tuo account per vedere le modifiche effettuate';
        $headers = 'From:' . $loggedUserEmail;

        ini_set("SMTP", "smtp.freesmtpservers.com");
        ini_set("smtp_port", "25"); //link per il test: https://www.wpoven.com/tools/free-smtp-server-for-testing
        ini_set("sendmail_from", "update@edusogno.com");

        foreach ($attendeesArray as $attender) {
            mail($attender, $subject, $message, $headers);
        }

        $_SESSION['edit_event_success'] = 'Evento aggiornato con successo.';
        $connection->close();
        header("location: ../../index.php");
        exit;
    }
} else {
    $_SESSION['edit_event_error'] = 'Esiste già un\'evento con questo nome.';
    header("Location: ../../events/edit.php");
    exit;
}
