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
            <p class="subtitle">User Menu</p>
            <a class="sideList link" href="viewUsers.php">View All Users</a>
            <a class="sideList link" href="addUsers.php">Add User</a>
            <a class="sideList link" href="updatePass.php">Update Password</a>
            <a class="sideList link" href="deleteUser.php">Delete User</a>
            <p class="subtitle">Products Menu</p>
            <a class="sideList link" href="viewProducts.php">View All Products</a>
            <a class="sideList link" href="addProduct.php">Add Products</a>
            <a class="sideList link" href="">Update Products</a>
            <a class="sideList link" href="deleteProduct.php">Delete Products</a>
            <p class="subtitle"><a class="link" href="index.html">Log Out</a></p>
        </div>
        <div class="mainContent">
            <?php
            $logFile=__DIR__.'/log/webhookLog.txt';
            $logs=file_get_contents($logFile);
            ?>
            <div>
                <p class="sub2">Logs</p>
            <?php
                    echo "<pre>" . htmlspecialchars($logs?$logs:"EMPTY LOGS") . "</pre>";
                ?>
                
            </div>
            
            
        </div>
    </div>
</body>
</html>