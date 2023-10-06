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
        <!-- new Password -->
        <div class="loginAndRegister" id="loginForm">
            <h1 class="title">Nuova Password</h1>
            <form action="./assets/db/confirmNewPassword.php" method="post">

                <label for="password">Inserisci la nuova password</label>
                <input type="password" id="password" name="password" placeholder="Scrivila qui" required>
                <div class="eye" id="eyeNewPassword">
                    <img src="./assets/img/eye.svg" alt="eye">
                </div>

                <button type="submit">Conferma nuova password</button>
            </form>
        </div>
    </main>


    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>