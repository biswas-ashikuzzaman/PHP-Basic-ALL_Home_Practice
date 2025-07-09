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
            <input type="text" name="Username" id="Username">
        </label> <br> <br>
        <label for="Password">Password:
            <input type="password" name="Password" id="Password">
        </label> <br> <br>
        <input type="submit" name="" id="" value="Login">
        </label>
    </form>
    <?php
    if (isset($_GET['Username']) && isset($_GET['Password'])) {
        $username = htmlspecialchars($_GET['Username']);
        $password = htmlspecialchars($_GET['Password']);
        echo "<h2>Submitted Data:</h2>";
        echo "Username: " . $username . "<br>";
        echo "Password: " . $password . "<br>";
    } else {
        echo "<h2>Please enter your credentials.</h2>";
    }
    
    ?>
</body>
</html>