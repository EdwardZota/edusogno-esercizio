<?php
session_start();
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
        <!-- code change password -->
        <div class="loginAndRegister" id="changePassword">
            <h1 class="title">Conferma codice di recupero!</h1>
            <form action="./assets/db/sendCodeNewPassword.php" method="post">
                <?php
                if (isset($_SESSION['code_error'])) {
                    echo '<p id="code_error">' . $_SESSION['code_error'] . '</p>';
                    unset($_SESSION['code_error']);
                } else if (isset($_SESSION['send_mail_success'])) {
                    echo '<p id="send_mail_success">' . $_SESSION['send_mail_success'] . '</p>';
                    unset($_SESSION['send_mail_success']);
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