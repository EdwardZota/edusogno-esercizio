<?php

    session_start();
    require_once __DIR__ . './DB.php';

    $eventId = $_POST['event-id'];
    $newEventName = $_POST['event-name'];
    $attendees = $_POST['attendees'];
    $loggedUserEmail = $_SESSION['userEmail'];
    $attendeesArray = explode(',',$attendees);

    $connection = DB::getConnection();

    $query = "SELECT * FROM `eventi` WHERE `id` = '$eventId'";

    if($connection->query($query)->num_rows == 1){
        $query = "UPDATE `eventi` SET `attendees` = '$attendees', `nome_evento` = '$newEventName' WHERE `id` = '$eventId'";
        if($connection->query($query)){

            //invio mail a tutti gli attendees
            $subject = 'Modifica evento al quale fai parte';
            $message = 'Logga con il tuo account per vedere le modifiche effettuate';
            $headers = 'From:'.$loggedUserEmail;
            
            ini_set("SMTP", "smtp.freesmtpservers.com");
            ini_set("smtp_port", "25"); //link per il test: https://www.wpoven.com/tools/free-smtp-server-for-testing
            ini_set("sendmail_from", "$loggedUserEmail");

            foreach($attendeesArray as $attender){
                mail($attender,$subject,$message,$headers);
            }

            $_SESSION['edit_event_success'] = 'Evento aggiornato con successo.';
            $connection->close();
            header("location: ../../index.php");
            exit;
        }
    }else{
        $_SESSION['edit_event_error'] = 'Esiste già un\'evento con questo nome.';
        header("Location: ../../events/create.php");
        exit;
    }
    