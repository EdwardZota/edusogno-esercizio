<?php

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
$showLogoutButton = true;
    }else{
        $showLogoutButton = false;
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
    <header>
        <div id="nav">
            <div class="logo">
                <img src="./assets/img/logo.svg" alt="logo">
            </div>
            <?php if($showLogoutButton){ ?>
            <div>
                <a href="./index.php"><button id="eventsButton">EVENTI</button></a>
                <a href="./assets/db/Logout.php" id="logoutButton"><button>LOGOUT</button></a>
            </div>
            <?php } ?>
        </div>
    </header>

</body>

</html>