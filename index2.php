<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIOSKO</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="flex centerContent columnDiv centerText">
        <h1 class="kioskoTitle noMargin">KIOSKO</h1>
        <form class="flex columnDiv" action="login.php" method="post">
            <h2>Login</h2>
            <p>
            <?php
            session_start();
            echo $_SESSION['msg'];
            ?>
            </p>
            <input type="text" name="user" id="user" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <input class="signIn" type="submit" value="Sign In">
        </form>
        <a class="link" href="signup.html">Create Account</a>
    </div>
</body>

</html>