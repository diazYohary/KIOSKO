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
                <form class="flex columnDiv" action="ap.php" method="post">
                    <p class="title noMargin">Add Products</p>
                    <label class="subtitle" for="prod">Product type:</label>
                    <select class="searchInput formInput" name="prod" id="prod">
                        <option value="Books">Books</option>
                        <option value="Comics">Comics</option>
                        <option value="Magazines">Magazines</option>
                        <option value="Mangas">Mangas</option>
                        <option value="Newspaper">Newspaper</option>
                    </select>
                    <input class="searchInput formInput" type="text" id="title" name="title" placeholder="Title" required>
                    <input class="searchInput formInput" type="text" id="author" name="author" placeholder="Author" required>
                    <input class="searchInput formInput" type="text" id="publisher" name="publisher" placeholder="Publisher Name" required>
                    <input class="searchInput formInput" type="date" id="pdate" name="pdate" placeholder="Publication Date" required>
                    <input class="searchInput formInput signIn" type="submit" value="Add Product">
                </form>
            </div>

            <div class="console">
                <p class="title noMargin">Console:</p>
                <?php
                session_start();
                if (isset($_SESSION['apMsg'])) {
                    echo $_SESSION['apMsg'];
                    unset($_SESSION["apMsg"]);
                } else {
                    echo "...";
                }
                ?>
            </div>

        </div>
    </div>
</body>

</html>