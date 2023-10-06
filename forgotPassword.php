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