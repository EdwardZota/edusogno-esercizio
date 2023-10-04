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
        <!-- Registrazione -->
        <div class="loginAndRegister">
            <h1 class="title">Crea il tuo account</h1>
            <form action="./assets/db/Registration.php" method="post">
                <?php
                // Verifica se esiste un messaggio di errore nella variabile di sessione
                    if (isset($_SESSION['registration_error'])) {
                        echo '<p id="registration_error">' . $_SESSION['registration_error'] . '</p>';
                        // Rimuovi il messaggio di errore dalla variabile di sessione per evitare che venga visualizzato nuovamente dopo il refresh
                        unset($_SESSION['registration_error']);
                    }
                ?>
                <label for="name">Inserisci il nome</label>
                <input type="name" id="name" name="name" placeholder="Mario" required>

                
                <label for="surname">Inserisci il cognome</label>
                <input type="surname" id="surname" name="surname" placeholder="Rossi" required>

                
                <label for="email">Inserisci l'e-mail</label>
                <input type="email" id="email" name="email" placeholder="name@example.com" required>
                
                <label for="password">Inserisci la password</label>
                <input type="password" id="password" name="password" placeholder="Scrivila qui" required>
                <div class="eye" id="eyeRegistration">
                    <img src="./assets/img/eye.svg" alt="eye">
                </div>

                <button type="submit">REGISTRATI</button>
                
                <span>Hai già un'account? <a href="./login.php">Accedi</a></span>
            </form>
        </div>
    </main>


    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>