<?php
    session_start();

    require_once __DIR__ . '/../assets/db/DBConfig.php';
    require_once __DIR__ . '/../assets/db/Events.php';

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("location: ../login.php");
        exit;
    }
    if(isset($_GET['event-name'])){
        $eventName = $_GET['event-name'];

        $event = Events::show($eventName);
        $attendeesArray = explode(',',$event['attendees']);


    }else{
        echo "<h1>Pagina non trovata. Torna alla <a href='../index.php'>pagina principale</a>.</h1>";
        exit;
    } 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
</head>

<body>
    <header>
        <div id="nav">
            <div class="logo">
                <img src="../assets/img/logo.svg" alt="logo">
            </div>
        </div>
    </header>
    <main>
        <div class="bg-container">
            <img class="right-circle" src="../assets/img/right-circle.svg" alt="right-circle">
            <img class="wave3" src="../assets/img/wave3.svg" alt="wave3">
            <img class="wave2" src="../assets/img/wave2.svg" alt="wave2">
            <img class="wave1" src="../assets/img/wave1.svg" alt="wave1">
            <img class="left-circle" src="../assets/img/left-circle.svg" alt="left-circle">
            <img class="rocket" src="../assets/img/rocket.svg" alt="rocket">
        </div>
        <div id="events">
            <h1 class="title">Dettagli Evento</h1>
            <div id="eventsBox">
                    <div class="eventsCard">
                        <h2><?php echo $event['nome_evento']; ?></h2>
                        <p id="date"><?php echo $event['data_evento']; ?></p>
                        <h5>Partecipanti:</h5>
                        <?php foreach($attendeesArray as $attender){ ?>
                            <div>
                                <p><?php echo $attender ?></p>
                            </div>
                        <?php } ?>
                    </div>
            </div>
        </div>
        
    </main>


</body>

</html>

