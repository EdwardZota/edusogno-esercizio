<?php

session_start();

require_once __DIR__ . './assets/db/DBConfig.php';
require_once __DIR__ . './assets/db/Users.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("location: ./login.php");
    exit;
} else {
    $loggedUser = ucfirst(strtolower($_SESSION['logged_user']));
}
$userEmail = $_SESSION['user_email'];
$adminPermiss = $_SESSION['admin_permiss'];
$users = Users::getUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include './layout/header.php' ?>

    <main>
        <?php include './layout/background.php' ?>
        <div id="events">
            <h1 class="title">Ciao <?php echo $loggedUser ?> ecco i tuoi eventi</h1>
            <div id="eventsBox">
                    <?php foreach ($users as $user) { 
                        if($user->email != $userEmail) {   ?>
                        <div class="eventsCard">
                            <p>Name:<?php echo $user->nome; ?></p>
                            <p>Surname:<?php echo $user->cognome; ?></p>
                            <p>Email:<?php echo $user->email; ?></p>
                            <p>Permessi da Admin:<?php echo $user->permessi_admin?'Si':'No'; ?></p>
                            <form action="./assets/db/giveRemoveAdminPermission.php" method="post">
                                <input type="hidden" name="user-id" value="<?php echo $user->id ?>">
                                <button type="submit" id="giveRemoveAdminPermission">GIVE/REMOVE ADMIN PERMISSION</button>
                            </form>
                        </div>
                <?php } 
                } ?>
            </div>
        </div>

    </main>


</body>

</html>