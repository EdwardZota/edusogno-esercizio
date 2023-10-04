<?php
    require_once __DIR__ . './assets/db/DBConfig.php';
    require_once __DIR__ .'./assets/db/Events.php';

    $events = Events::getEvents();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<body>
    <header>
        <div id="nav">
            <div class="logo">
                <img src="./assets/img/logo.svg" alt="logo">
            </div>
        </div>
    </header>
    <main>
        <div class="bg-container">
            <img class="right-circle" src="./assets/img/right-circle.svg" alt="right-circle">
            <img class="wave3" src="./assets/img/wave3.svg" alt="wave3">
            <img class="wave2" src="./assets/img/wave2.svg" alt="wave2">
            <img class="wave1" src="./assets/img/wave1.svg" alt="wave1">
            <img class="left-circle" src="./assets/img/left-circle.svg" alt="left-circle">
            <img class="rocket" src="./assets/img/rocket.svg" alt="rocket">
        </div>
        <div id="events">
            <h1 class="title">Ciao NOME ecco i tuoi eventi</h1>
            <div id="eventsBox">
                <?php foreach($events as $event) { ?>
                    <div class="eventsCard">
                        <h2><?php echo $event->nome_evento; ?></h2>
                        <p><?php echo $event->data_evento; ?></p>
                        <button>JOIN</button>
                    </div>
                <?php } ?>
                
            </div>
        </div>
        
    </main>


</body>

</html>