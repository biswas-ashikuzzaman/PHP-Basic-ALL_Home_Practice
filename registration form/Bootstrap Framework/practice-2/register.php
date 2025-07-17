<!DOCTYPE html>
<html>
<head>
    <title>Registration with Display</title>
    <style>
        form {
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 6px 10px;
        }
        th {
            background: #f0f0f0;
        }
        img {
            height: 60px;
        }
        iframe {
            height: 60px;
            width: 100px;
        }
    </style>
</head>
<body>

<h2>Register Here</h2>
<form action="" method="post" enctype="multipart/form-data">
    Name:     <input type="text" name="name" required><br><br>
    Email:    <input type="email" name="email" required><br><br>
    Position: <input type="text" name="position" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Gender: 
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female"> Female<br><br>
    Upload File: <input type="file" name="upload_file" required><br><br>
    <input type="submit" value="Register">
</form>

<?php
$file_path = "users.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $position = $_POST['position'];
    $password = $_POST['password'];
    $gender   = $_POST['gender'];

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_name = $_FILES['upload_file']['name'];
    $file_tmp  = $_FILES['upload_file']['tmp_name'];
    $file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed   = ['pdf', 'jpg', 'jpeg', 'png'];

    if (!in_array(strtolower($file_ext), $allowed)) {
        echo "<p style='color:red;'>❌ Invalid file type. Only PDF, JPG, JPEG, PNG allowed.</p>";
    } else {
        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $destination = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $destination)) {

            $exists = false;
            if (file_exists($file_path)) {
                $lines = file($file_path);
                foreach ($lines as $line) {
                    $fields = explode("|", trim($line));
                    if ($fields[1] === $email) {
                        $exists = true;
                        break;
                    }
                }
            }

            if ($exists) {
                echo "<p style='color:red;'>❌ Email already registered.</p>";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $userData = "$name|$email|$position|$hashed_password|$gender|$new_file_name\n";
                file_put_contents($file_path, $userData, FILE_APPEND);
                echo "<p style='color:green;'>✅ Registration successful!</p>";
            }

        } else {
            echo "<p style='color:red;'>❌ File upload failed.</p>";
        }
    }
}

// Display table
if (file_exists($file_path)) {
    $lines = file($file_path);
    if (count($lines) > 0) {
        echo "<h3>All Registered Users</h3>";
        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Gender</th>
                    <th>Uploaded File Preview</th>
                </tr>";
        foreach ($lines as $line) {
            $fields = explode("|", trim($line));
            $file = "uploads/" . $fields[5];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            echo "<tr>
                    <td>{$fields[0]}</td>
                    <td>{$fields[1]}</td>
                    <td>{$fields[2]}</td>
                    <td>{$fields[4]}</td>
                    <td>";

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                echo "<img src='$file' alt='Image'>";
            } elseif ($ext == 'pdf') {
                echo "<iframe src='$file'></iframe>";
            } else {
                echo "File";
            }

            echo "</td></tr>";
        }
        echo "</table>";

        // 🔗 Link to register form (refresh current page)
        // 🔗 Link to main register page (e.g., register.html)
echo "<br><a href='register.html'>➕ Go to Register Form</a>";

    }
}
?>

</body>
</html>
