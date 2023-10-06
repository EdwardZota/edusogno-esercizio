<?php

    require_once __DIR__ . './DB.php';

    $eventId = $_POST['event-id'];


    $connection = DB::getConnection();

    $query = "SELECT * FROM `eventi` WHERE `id` = '$eventId'";

    if($connection->query($query)->num_rows == 1){
        $query = "DELETE FROM `eventi` WHERE `id` = '$eventId'";
        if($connection->query($query)){
            $_SESSION['delete_event_success'] = 'Evento eliminato con successo.';
            $connection->close();
            header("location: ../../index.php");
            exit;
        }
    }
    $connection->close();
