<?php

require_once __DIR__ . './DB.php';

$userId = isset($_POST['user-id']) ? $_POST['user-id'] : '';

$connection = DB::getConnection();

$query = "SELECT `permessi_admin` FROM `utenti` WHERE `id` = '$userId'";
$result = $connection->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $admin_permission = $row['permessi_admin'];
    
    if($admin_permission == 0){
        $query = "UPDATE `utenti` SET `permessi_admin` = '1' WHERE `utenti`.`id` = '$userId'";
    }else{
        $query = "UPDATE `utenti` SET `permessi_admin` = '0' WHERE `utenti`.`id` = '$userId'";
    }
    if($connection->query($query)){
        $connection->close();
        header("location: ../../adminPermission.php");
        exit;
    }

} else {
    $connection->close();
    echo "<h1>Pagina non trovata. Torna alla <a href='../adminPermission.php'>pagina principale</a>.</h1>";
    exit;
}