<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $position = $_POST['position'];
    $password = $_POST['password'];
    $gender   = $_POST['gender'];

    // Check if email already exists
    $file_path = "users.txt";
    if (file_exists($file_path)) {
        $lines = file($file_path);
        foreach ($lines as $line) {
            $fields = explode("|", trim($line));
            if ($fields[1] === $email) {
                die("❌ Email already registered. <a href='register.html'>Try again</a>");
            }
        }
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Save user to file
    $userData = "$name|$email|$position|$hashed_password|$gender\n";
    file_put_contents($file_path, $userData, FILE_APPEND);

    echo "✅ Registration successful! <a href='login.html'>Login now</a>";
}
?>
