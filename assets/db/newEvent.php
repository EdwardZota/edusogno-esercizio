<?php
    session_start();
    require_once __DIR__ . './DB.php';

    $loggedUserEmail = $_SESSION['userEmail'];
    $eventName = $_POST['event-name'];
    $attendees = $loggedUserEmail . ',' . $_POST['attendees'];
    $date = date("Y-m-d H:i:s"); 
    $attendeesArray = explode(',',$attendees);
    $connection = DB::getConnection();

    //controllo che non esiste un evento con lo stesso nome
    $query = "SELECT * FROM `eventi` WHERE nome_evento = '$eventName'";

    if($connection->query($query)->num_rows == 0){
        $query = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('$attendees','$eventName','$date')";
        
        if($connection->query($query)){

            //invio mail a tutti gli attendees
            $subject = 'Creazione nuovo evento al quale fai parte';
            $message = 'Logga con il tuo account per vedere il nuovo evento';
            $headers = 'From:update@edusogno.com';
            
            ini_set("SMTP", "smtp.freesmtpservers.com");
            ini_set("smtp_port", "25"); //link per il test: https://www.wpoven.com/tools/free-smtp-server-for-testing
            ini_set("sendmail_from", "update@edusogno.com");

            foreach($attendeesArray as $attender){
                mail($attender,$subject,$message,$headers);
            }
            
            $_SESSION['new_event_success'] = 'Nuovo evento creato con successo.';
            header("location: ../../index.php");
            exit;
        }
    }else{
        $_SESSION['new_event_error'] = 'Esiste già un\'evento con questo nome.';
        header("Location: ../../events/create.php");
        exit;
    }
    $connection->close();