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
            <?php
            $goBack = $_SERVER['HTTP_REFERER']; // Obtiene la URL de la página anterior
            echo "<a href=".$goBack." class='link'>←Return</a>";
            ?>
            <div class="flex">
                <div class="flex columnDiv prodDet">
                    <?php
                    $value = $_POST["productId"];
                    $productId = $value;

                    require_once 'MyFirebase.php';

                    use MyFirebase\Firebase as Fb;

                    $project = 'myfirebase-a99eb-default-rtdb';
                    $firebase = new Fb($project);
                    $res = $firebase->getDetails($productId);

                    if (!is_null($res)) {
                        $title = $res['Title'];
                        $author = $res['Author'];
                        $publicationDate = $res['Publication Date'];
                        $publisher = $res['Publisher'];
                        echo "<p class='title noMargin'>" . $title . "</p>";
                        echo "<p class='sub2'>Author: " . $author . "</p>";
                        echo "<p>Product ID: " . $productId . "</p>";
                        echo "<p>Publication Date: " . $publicationDate . "</p>";
                        echo "<p>Publisher: " . $publisher . "</p>";
                        echo "<p class='justifyText'>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum
                        nostrum dolore reprehenderit totam deleniti blanditiis quis soluta
                        exercitationem? Pariatur ex aspernatur doloribus beatae tenetur labore
                        consectetur obcaecati totam quae explicabo.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum
                        nostrum dolore reprehenderit totam deleniti blanditiis quis soluta
                        exercitationem? Pariatur ex aspernatur doloribus beatae tenetur labore
                        consectetur obcaecati totam quae explicabo.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum
                        nostrum dolore reprehenderit totam deleniti blanditiis quis soluta
                        exercitationem? Pariatur ex aspernatur doloribus beatae tenetur labore
                        consectetur obcaecati totam quae explicabo.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum
                        nostrum dolore reprehenderit totam deleniti blanditiis quis soluta
                        exercitationem? Pariatur ex aspernatur doloribus beatae tenetur labore
                        consectetur obcaecati totam quae explicabo.
                        </p>";
                    } else {
                        echo '<br>No se encontraron resultados<br>';
                    }
                    ?>
                    <button class="book sub2" id="myBtn">View content</button>

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <iframe src="src/lorem.pdf" width="100%" height="590px"></iframe>
                            <!--
                            -->
                        </div>
                    </div>
                    <script>
                        var modal = document.getElementById("myModal");
                        var btn = document.getElementById("myBtn");
                        var span = document.getElementsByClassName("close")[0];
                        btn.onclick = function() {
                            modal.style.display = "block";
                        }
                        span.onclick = function() {
                            modal.style.display = "none";
                        }
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
                </div>
                <div class="prodImg">
                    <?php
                    $ruta_imagen = "img/" . $productId . ".jpg";
                    // Verificamos si el archivo existe y es un archivo
                    if (file_exists($ruta_imagen) && is_file($ruta_imagen)) {
                        // Si existe, mostramos la imagen
                        echo "<img class='productImg' src='$ruta_imagen'>";
                    } else {
                        // Si no existe, mostramos un mensaje
                        echo "<img class='productImg' src='img/null.png'>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</body>

</html>