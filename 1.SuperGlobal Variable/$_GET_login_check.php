<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$_GET Method</title>
</head>
<body>
    <form action="" method="get">
        <label for="Username">Username:
            <input type="text" name="Username" id="Username" required>
        </label> <br> <br>
        <label for="Password">Password:
            <input type="password" name="Password" id="Password" required>
        </label> <br> <br>
        <input type="submit" name="" id="" value="Login">
        </label>
    </form>
    <?php
    if (isset($_GET['Username']) && isset($_GET['Password'])){
        $username1=$_GET['Username'];
        $password1=$_GET['Password'];
        if ($username1 == "admin" && $password1 == "1234") {
            echo "<h2>Login successful!</h2>";
        } else {
            echo "<h2>Invalid credentials, please try again.</h2>";
        }
    }
    ?>
</body>
</html>