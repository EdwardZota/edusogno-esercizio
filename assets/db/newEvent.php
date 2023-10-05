<?php
    require_once __DIR__ . './DB.php';

    $eventName = $_POST['event-name'];
    $attendees = $_POST['attendees'];

    $connection = DB::getConnection();

    //controllo che non esiste un evento con lo stesso nome
    $query = "SELECT * FROM `eventi` WHERE nome_evento = '$eventName'";

    if($connection->query($query)->num_rows == 0){
        $query = "INSERT INTO eventi (attendees, nome_evento) VALUES ('$attendees','$eventName')";
        
        if($connection->query($query)){
            $_SESSION['new_event_success'] = 'Nuovo evento creato con successo.';
            header("location: ../../index.php");
            exit;
        }
    }else{
        $_SESSION['new_event_error'] = 'Esiste già un\'evento con questo nome.';
        header("Location: ../../events/create.php");
        exit;
    }