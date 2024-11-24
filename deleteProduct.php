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
            <div class="flex">
                <div>
                    <form class="flex columnDiv" action="dp.php" method="post">
                        <p class="title noMargin">Delete Product</p>
                        <input class="searchInput formInput" type="text" id="code" name="code" placeholder="Code" required>
                        <input class="searchInput formInput signIn" type="submit" value="Delete">
                    </form>
                </div>

                <div>
                    <p class="title noMargin">Products List</p>
                    <?php
                    require_once 'MyFirebase.php';

                    use MyFirebase\Firebase as Fb;

                    $project = 'myfirebase-a99eb-default-rtdb';
                    $firebase = new Fb($project);

                    $res = $firebase->productList();
                    if (!is_null($res)) {
                        foreach ($res as $key => $value) {
                            echo "<p>" . $key . "</p>";
                        }
                    } else {
                        echo '<br>No se encontraron resultados<br>';
                    }
                    ?>
                </div>
            </div>
            <div class="console">
                <p class="title noMargin">Console:</p>
                <?php
                session_start();
                if (isset($_SESSION['dpMsg'])) {
                    echo $_SESSION['dpMsg'];
                    unset($_SESSION["dpMsg"]);
                } else {
                    echo "...";
                }
                ?>
            </div>

        </div>
    </div>
</body>

</html>