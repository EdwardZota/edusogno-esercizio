<?php

    require_once __DIR__ . './DB.php';

    $eventId = $_POST['event-id'];
    $newEventName = $_POST['event-name'];
    $attendees = $_POST['attendees'];

    $connection = DB::getConnection();

    $query = "SELECT * FROM `eventi` WHERE `id` = '$eventId'";

    if($connection->query($query)->num_rows == 1){
        $query = "UPDATE `eventi` SET `attendees` = '$attendees', `nome_evento` = '$newEventName' WHERE `id` = '$eventId'";
        if($connection->query($query)){
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
    