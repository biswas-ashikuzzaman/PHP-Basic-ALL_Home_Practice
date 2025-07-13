<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $position = $_POST['position'];
    $password = $_POST['password'];
    $gender   = $_POST['gender'];

    // File upload handling
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true); // create uploads folder if not exists
    }

    $file_name = $_FILES['upload_file']['name'];
    $file_tmp  = $_FILES['upload_file']['tmp_name'];
    $file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed   = ['pdf', 'jpg', 'jpeg', 'png'];

    if (!in_array(strtolower($file_ext), $allowed)) {
        die("❌ Invalid file type. Only PDF, JPG, JPEG, PNG allowed. <a href='register.html'>Try again</a>");
    }

    $new_file_name = uniqid("file_", true) . "." . $file_ext;
    $destination = $upload_dir . $new_file_name;

    if (!move_uploaded_file($file_tmp, $destination)) {
        die("❌ Failed to upload file. <a href='register.html'>Try again</a>");
    }

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

    // Save user to file (including uploaded file name)
    $userData = "$name|$email|$position|$hashed_password|$gender|$new_file_name\n";
    file_put_contents($file_path, $userData, FILE_APPEND);

    echo "✅ Registration successful! <a href='login.html'>Login now</a>";
}
?>
