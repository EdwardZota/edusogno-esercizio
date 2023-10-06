<?php
    session_start();
    require_once __DIR__ . '/../assets/db/DBConfig.php';

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("location: ../login.php");
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
<?php include '../layout/headerIntoFolder.php' ?>

<main>
    <?php include '../layout/backgroundIntoFolder.php' ?>
        <!-- Login -->
        <div class="loginAndRegister" id="loginForm">
            <h1 class="title">Crea un nuovo evento!</h1>
            <form action="../assets/db/newEvent.php" method="post">
                <?php
                    if (isset($_SESSION['new_event_error'])) {
                        echo '<p id="new_event_error">' . $_SESSION['new_event_error'] . '</p>';
                        unset($_SESSION['new_event_error']);
                    }
                ?>
                    <label for="event-name">Inserisci nome evento</label>
                    <input type="text" id="event-name" name="event-name" placeholder="edusogno evento" required>

                    <label for="attendees">inserisci le mail di chi puo partecipare all'evento</label>
                    <textarea id="attendees" name="attendees" placeholder="esempio1@gmail.com,esempio2@gmail.com,esempio3@gmail.com"></textarea>
                    
                    <button type="submit">SALVA</button>
                
                </form>
        </div>
    </main>

</body>

</html>