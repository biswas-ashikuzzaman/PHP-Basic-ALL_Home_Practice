<?php
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
                echo "✅ Login successful!<br>";
                echo "Welcome, <strong>$name</strong> ($position) - Gender: $gender";
                break;
            }
        }
    }

    if (!$found) {
        echo "❌ Invalid email or password. <a href='login.html'>Try again</a>";
    }
}
?>
