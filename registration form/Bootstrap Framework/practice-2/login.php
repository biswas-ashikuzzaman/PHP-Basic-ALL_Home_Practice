<?php
session_start();

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

                // Store user info in session
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
        echo "❌ Invalid email or password. <a href='login.html'>Try again</a>";
    }
}
?>
