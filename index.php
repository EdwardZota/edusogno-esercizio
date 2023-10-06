<?php

session_start();

require_once __DIR__ . './assets/db/DBConfig.php';
require_once __DIR__ . './assets/db/Events.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("location: ./login.php");
    exit;
} else {
    $loggedUser = ucfirst(strtolower($_SESSION['logged_user']));
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
    <?php include './layout/header.php' ?>

    <main>
        <?php include './layout/background.php' ?>
        <div id="events">
            <h1 class="title">Ciao <?php echo $loggedUser ?> ecco i tuoi eventi</h1>
            <div id="eventsBox">
                <?php if (empty($events)) { ?>
                    <h1>Non ci sono eventi ai quale fai parte.</h1>
                    <?php   } else {
                    foreach ($events as $event) { ?>
                        <div class="eventsCard">
                            <h2><?php echo $event->nome_evento; ?></h2>
                            <p id="date"><?php echo $event->data_evento; ?></p>
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