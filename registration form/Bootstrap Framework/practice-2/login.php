<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $found = false;
    $file_path = "users.txt";

    if (file_exists($file_path)) {
        $lines = file($file_path);
        foreach ($lines as $line) {
            list($name, $stored_email, $position, $hashed_password, $gender) = explode("|", trim($line));
            if ($email === $stored_email && password_verify($password, $hashed_password)) {
                $found = true;

                $_SESSION['user'] = [
                    'name' => $name,
                    'email' => $stored_email,
                    'position' => $position,
                    'gender' => $gender
                ];

                header("Location: welcome.php");
                exit();
            }
        }
    }

    if (!$found) {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style_login.css">
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
      <div class="error-alert"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
      <label>Email:</label>
      <input type="email" name="email" required><br><br>

      <label>Password:</label>
      <input type="password" name="password" required><br><br>

      <input type="submit" value="Login">
    </form>

    <a href="register.html">Don't have an account? Register</a>
  </div>
</body>
</html>
