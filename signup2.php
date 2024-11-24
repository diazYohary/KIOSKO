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
        <form class="flex columnDiv" action="signup.php" method="post">
            <h2>Sign Up</h2>
            <p>
            <?php
            session_start();
            echo $_SESSION['msg'];
            ?>
            </p>
            <input type="text" name="user" id="user" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="password" name="password2" id="password2" placeholder="Confirm Password">
            <input class="signIn" type="submit" value="Sign Up">
        </form>
        <a class="link" href="index.html">Have an account? Log in</a>
    </div>
</body>

</html>