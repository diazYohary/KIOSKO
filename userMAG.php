<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIOSKO HOME</title>
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
            $menu->mainMenu();
            ?>
        </div>
        <div class="mainContent flex columnDiv">
            <!--FIRST LINE-->
            <div>
                <p class="title noMargin">Magazines</p>
                <?php
                require_once 'MyFirebase.php';

                use MyFirebase\Firebase as Fb;

                $project = 'myfirebase-a99eb-default-rtdb';
                $firebase = new Fb($project);
                $document = 'Magazines';

                $res = $firebase->getProducts($document);
                $cProd = 0;
                if (!is_null($res)) {
                    foreach ($res as $key => $value) {
                        $cProd++;
                    }
                    $cociente = intdiv($cProd, 5);
                    $residuo = $cProd % 5;
                    $newStart = 1;
                    
                    for ($i = 1; $i <= $cociente; $i++) {
                        $stackProd = $i * 5;
                        echo '<div class="flex spaceRow">';
                        for ($j = $newStart; $j <= $stackProd; $j++) {
                            $code = 'MAG00' . $j;
                            $title = $res[$code];

                            echo '<div class="flex columnDiv centerDiv centerText contCover">';

                            //img
                            $ruta_imagen = "img/" . $code . ".jpg";
                            if (file_exists($ruta_imagen) && is_file($ruta_imagen)) {
                                echo "<img class='cover' src='$ruta_imagen'>";
                            } else {
                                echo '<img class="cover" src="img/null.png">';
                            }

                            echo "<form action='prodDet.php' method='post'>";
                            echo "<input class='link textCover' type='submit' value=\"" . htmlspecialchars($title) . "\">";
                            echo "<input type='hidden' name='productId' value='" . $code . "'>";
                            echo "</form>";

                            echo '</div>';

                        }
                        $newStart = $stackProd + 1;
                        echo '</div>';
                    }
                    $leftProd=$cProd-$residuo+1;

                    echo '<div class="flex spaceRow">';
                    for($i=$leftProd; $i<=$cProd; $i++){
                        $code = 'MAG00' . $i;
                        $title = $res[$code];

                        echo '<div class="flex columnDiv centerDiv centerText contCover">';

                        //img
                        $ruta_imagen = "img/" . $code . ".jpg";
                        if (file_exists($ruta_imagen) && is_file($ruta_imagen)) {
                            echo "<img class='cover' src='$ruta_imagen'>";
                        } else {
                            echo '<img class="cover" src="img/null.png">';
                        }

                        echo "<form action='prodDet.php' method='post'>";
                        echo "<input class='link textCover' type='submit' value=\"" . htmlspecialchars($title) . "\">";
                        echo "<input type='hidden' name='productId' value='" . $code . "'>";
                        echo "</form>";

                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<br>No se encontraron resultados<br>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>