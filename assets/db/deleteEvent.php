<?php

require_once __DIR__ . './DB.php';

$eventId = isset($_POST['event-id']) ? $_POST['event-id'] : '';


$connection = DB::getConnection();

$query = "SELECT * FROM `eventi` WHERE `id` = '$eventId'";

if ($connection->query($query)->num_rows == 1) {
    $query = "DELETE FROM `eventi` WHERE `id` = '$eventId'";
    if ($connection->query($query)) {
        $_SESSION['delete_event_success'] = 'Evento eliminato con successo.';
        $connection->close();
        header("location: ../../index.php");
        exit;
    }
} else {
    $connection->close();
    echo "<h1>Pagina non trovata. Torna alla <a href='../index.php'>pagina principale</a>.</h1>";
    exit;
}
