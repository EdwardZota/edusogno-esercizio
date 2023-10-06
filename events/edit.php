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
        if($event === null){
            echo "<h1>Pagina non trovata. Torna alla <a href='../index.php'>pagina principale</a>.</h1>";
            exit;
        }
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
<?php include '../layout/headerIntoFolder.php' ?>

<main>
    <?php include '../layout/backgroundIntoFolder.php' ?>
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