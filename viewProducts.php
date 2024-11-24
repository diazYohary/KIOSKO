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
            $menu=new menu\MenuTools;
            $menu->menu();
            ?>
        </div>
        <div class="mainContent">
            <p class="title noMargin">View All Products</p>
            <?php
            require_once 'MyFirebase.php';
            use MyFirebase\Firebase as Fb;

            $project = 'myfirebase-a99eb-default-rtdb';
            $firebase = new Fb($project);

            $document = 'Books';
            echo "<p class='sub2'>" . $document . "</p>";
            $res = $firebase->getProducts($document);
            if (!is_null($res)) {
                foreach ($res as $key => $value) {
                    $name = $key . ": " . $value;
                    echo "<form action='productDetails.php' method='post'>";
                    echo "<input class='link productList' type='submit' value=\"" . htmlspecialchars($name) . "\">";
                    echo "<input type='hidden' name='productId' value='" . $key . "'>";
                    echo "</form>";
                }
            } else {
                echo '<br>No se encontraron resultados<br>';
            }

            $document = 'Comics';
            echo "<p class='sub2'>" . $document . "</p>";
            $res = $firebase->getProducts($document);
            if (!is_null($res)) {
                foreach ($res as $key => $value) {
                    $name = $key . ": " . $value;
                    echo "<form action='productDetails.php' method='post'>";
                    echo "<input class='link productList' type='submit' value=\"" . htmlspecialchars($name) . "\">";
                    echo "<input type='hidden' name='productId' value='" . $key . "'>";
                    echo "</form>";
                }
            } else {
                echo '<br>No se encontraron resultados<br>';
            }

            $document = 'Magazines';
            echo "<p class='sub2'>" . $document . "</p>";
            $res = $firebase->getProducts($document);
            if (!is_null($res)) {
                foreach ($res as $key => $value) {
                    $name = $key . ": " . $value;
                    echo "<form action='productDetails.php' method='post'>";
                    echo "<input class='link productList' type='submit' value=\"" . htmlspecialchars($name) . "\">";
                    echo "<input type='hidden' name='productId' value='" . $key . "'>";
                    echo "</form>";
                }
            } else {
                echo '<br>No se encontraron resultados<br>';
            }

            $document = 'Mangas';
            echo "<p class='sub2'>" . $document . "</p>";
            $res = $firebase->getProducts($document);
            if (!is_null($res)) {
                foreach ($res as $key => $value) {
                    $name = $key . ": " . $value;
                    echo "<form action='productDetails.php' method='post'>";
                    echo "<input class='link productList' type='submit' value=\"" . htmlspecialchars($name) . "\">";
                    echo "<input type='hidden' name='productId' value='" . $key . "'>";
                    echo "</form>";
                }
            } else {
                echo '<br>No se encontraron resultados<br>';
            }

            $document = 'Newspaper';
            echo "<p class='sub2'>" . $document . "</p>";
            $res = $firebase->getProducts($document);
            if (!is_null($res)) {
                foreach ($res as $key => $value) {
                    $name = $key . ": " . $value;
                    echo "<form action='productDetails.php' method='post'>";
                    echo "<input class='link productList' type='submit' value=\"" . htmlspecialchars($name) . "\">";
                    echo "<input type='hidden' name='productId' value='" . $key . "'>";
                    echo "</form>";
                }
            } else {
                echo '<br>No se encontraron resultados<br>';
            }
            ?>
        </div>
    </div>
</body>

</html>