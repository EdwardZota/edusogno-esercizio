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
        <!-- codice cambio password -->
        <div class="loginAndRegister" id="changePassword">
            <h1 class="title">Conferma codice di recupero!</h1>
            <form action="./assets/db/sendCodePasswordReset.php" method="post">
            <?php
                    if (isset($_SESSION['code_error'])) {
                        echo '<p id="code_error">' . $_SESSION['code_error'] . '</p>';
                        unset($_SESSION['code_error']);
                    }
                ?>
                    <label for="code">Inserisci codice</label>
                    <input type="number" id="code" name="code" min="100000" max="999999">
                    
                    <button type="submit">Conferma</button>
            </form>
        </div>
    </main>


    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>