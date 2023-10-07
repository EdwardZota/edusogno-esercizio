<?php
session_start();

require_once __DIR__ . '/../assets/db/DBConfig.php';
require_once __DIR__ . '/../assets/db/Events.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("location: ../login.php");
    exit;
}
if (isset($_GET['event-name'])) {
    $eventName = $_GET['event-name'];

    $event = Events::show($eventName);
    if ($event) {
        $attendeesArray = explode(',', $event['attendees']);
    } else {
        echo "<h1>Pagina non trovata. Torna alla <a href='../index.php'>pagina principale</a>.</h1>";
        exit;
    }
}

$adminPermiss = $_SESSION['admin_permiss'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include '../layout/headerIntoFolder.php' ?>

    <main>
        <?php include '../layout/backgroundIntoFolder.php' ?>
        <div id="events">
            <h1 class="title">Dettagli Evento</h1>
            <div id="eventsBox">
                <div class="eventsCard">
                    <h2><?php echo $event['nome_evento']; ?></h2>
                    <p id="date"><?php echo $event['data_evento']; ?></p>
                    <h5>Partecipanti:</h5>
                    <?php foreach ($attendeesArray as $attender) { ?>
                        <div>
                            <p><?php echo $attender ?></p>
                        </div>
                    <?php } ?>

                    <?php if ($adminPermiss == true) { ?>
                        <a href="../events/edit.php?event-name=<?php echo $event['nome_evento'] ?>"><button>EDIT</button></a>
                        <form action="../assets/db/deleteEvent.php" method="post">
                            <input type="hidden" name="event-id" value="<?php echo $event['id'] ?>">
                            <button type="submit" id="deleteEvent"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>

    </main>


</body>

</html>