<?php
    session_start();
    require_once __DIR__ . './assets/db/DBConfig.php';


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
        <!-- cambio password -->
        <div class="loginAndRegister" id="changePassword">
            <h1 class="title">Cambio password!</h1>
            <form action="./assets/db/sendPasswordReset.php" method="post">
                <?php
                if(isset($_SESSION['send_mail_failed'])){
                    echo '<p id="send_mail_failed">' . $_SESSION['send_mail_failed'] . '</p>';
                    unset($_SESSION['send_mail_failed']);
                }
                ?>
                    <label for="email">Inserisci l'e-mail</label>
                    <input type="email" id="email" name="email">
                    
                    <button type="submit">Manda e-mail per cambio password</button>
            </form>
        </div>
    </main>


    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>