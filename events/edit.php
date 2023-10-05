<?php
    session_start();
    require_once __DIR__ . '/../assets/db/DBConfig.php';
    require_once __DIR__ . '/../assets/db/Events.php';

    if(isset($_GET['event-name'])){
        $eventName = $_GET['event-name'];

        $event = Events::show($eventName);

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
        <!-- Login -->
        <div class="loginAndRegister" id="loginForm">
            <h1 class="title">Modifica evento!</h1>
            <form action="../assets/db/editEvent.php" method="post">
                    <input type="hidden" name="event-id" value="<?php echo $event['id'] ?>">

                    <label for="event-name">Modifica nome evento</label>
                    <input type="text" id="event-name" name="event-name" value="<?php echo $event['nome_evento'] ?>" placeholder="edusogno evento" required>

                    <label for="attendees">Modifica le mail di chi puo partecipare all'evento</label>
                    <textarea id="attendees" name="attendees" placeholder="esempio1@gmail.com,esempio2@gmail.com,esempio3@gmail.com"><?php echo $event['attendees'] ?>
                    </textarea>
                    
                    <button type="submit">SALVA MODIFICHE</button>
                
                </form>
        </div>
    </main>

</body>

</html>