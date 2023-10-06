<?php

    session_start();
    
    require_once __DIR__ . './assets/db/DBConfig.php';
    require_once __DIR__ .'./assets/db/Events.php';

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("location: ./login.php");
        exit;
    }else{
        $loggedUser = ucfirst(strtolower($_SESSION['logged_user'])) ;
    }
    $userEmail = $_SESSION['userEmail'];
    $events = Events::getEvents($userEmail);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <div id="nav">
            <div class="logo">
                <img src="./assets/img/logo.svg" alt="logo">
            </div>
            <div>
                <a href="./assets/db/Logout.php"><button>LOGOUT</button></a>
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
            <h1 class="title">Ciao <?php echo $loggedUser ?> ecco i tuoi eventi</h1>
            <div id="eventsBox">
                <a href="./events/create.php" id="createNewButton"><button>CREATE</button></a>
                <?php if (empty($events)) { ?>
                    <h1>Non ci sono eventi ai quale fai parte.</h1>
                <?php   } else {
                 foreach($events as $event) { ?>
                    <div class="eventsCard">
                        <h2><?php echo $event->nome_evento; ?></h2>
                        <p><?php echo $event->data_evento; ?></p>
                        <a href="./events/show.php?event-name=<?php echo $event->nome_evento ?>"><button>JOIN</button></a>
                        <a href="./events/edit.php?event-name=<?php echo $event->nome_evento ?>"><button>EDIT</button></a>
                        <form action="./assets/db/deleteEvent.php" method="post">
                            <input type="hidden" name="event-id" value="<?php echo $event->id ?>">
                            <button type="submit" id="deleteEvent"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </div>
                <?php } 
                } ?>
            </div>
        </div>
        
    </main>


</body>

</html>