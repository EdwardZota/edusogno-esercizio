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
<?php include './layout/header.php' ?>

<main>
    <?php include './layout/background.php' ?>
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