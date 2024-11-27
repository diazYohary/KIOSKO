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
                <p class="sub2">Logs</p>
                <pre id="logContainer">Cargando logs...</pre>

            </div>
        </div>
    </div>
    <script>
       // GET LOGS
       async function fetchLogs() {
           try {
               const response = await fetch('getLogs.php'); // Ruta al endpoint creado
               if (response.ok) {
                   const logs = await response.text(); // Obtener el contenido del log
                   document.getElementById('logContainer').textContent = logs; // Actualizar el contenido
               } else {
                   console.error('Error al obtener los logs:', response.status);
               }
           } catch (error) {
               console.error('Error al realizar la solicitud:', error);
           }
       }
       // Actualizar los logs cada 5 segundos
       setInterval(fetchLogs, 5000);
       // Cargar los logs inicialmente
       fetchLogs();
   </script>
</body>

</html>