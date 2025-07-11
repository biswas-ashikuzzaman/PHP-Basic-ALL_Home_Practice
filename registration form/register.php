<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password

    // Simulating a DB insert (you should use a real database like MySQL)
    echo "<h3>Registration Successful!</h3>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    // Note: Don't display the password!
} else {
    echo "Invalid Request.";
}
?>
