<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN KIOSKO</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="flex columnDiv centerDiv centerText">
        <h1 class="kioskoHome noMargin">KIOSKO</h1>
        <div class="vr"></div>
    </div>
    <div class="flex mainDiv">
        <div class="sidebar flex columnDiv">
            <?php
            require_once 'menuTools.php';
            $menu = new menu\MenuTools;
            $menu->menu();
            ?>
        </div>
        <div class="mainContent">
            <div>
                <form class="flex columnDiv" action="up.php" method="post">
                    <p class="title noMargin">Update Password</p>
                    <input class="searchInput formInput" type="text" id="user" name="user" placeholder="Username" required>
                    <input class="searchInput formInput" type="password" id="pass" name="pass" placeholder="New Password" required>
                    <input class="searchInput formInput signIn" type="submit" value="Update">
                </form>
            </div>

            <div class="console">
                <p class="title noMargin">Console:</p>
                <?php
                session_start();
                if (isset($_SESSION['upMsg'])) {
                    echo $_SESSION['upMsg'];
                    unset($_SESSION["upMsg"]);
                } else {
                    echo "...";
                }
                ?>
            </div>

        </div>
    </div>
</body>

</html>