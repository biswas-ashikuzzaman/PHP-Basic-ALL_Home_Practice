<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        img, iframe {
            margin-top: 10px;
            max-height: 100px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
    </style>
    
</head>
<body>

<h2>Register Form</h2>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Position: <input type="text" name="position" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Gender:
    <input type="radio" name="gender" value="Male" required> Male
    <input type="radio" name="gender" value="Female"> Female<br><br>
    
    Upload File: 
    <input type="file" name="upload_file" id="upload_file" accept=".jpg,.jpeg,.png,.pdf" required><br>
    <div id="preview"></div><br>

    <input type="submit" value="Register">
</form>

<hr>

<?php
$file_path = "users.txt";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $position = $_POST["position"];
    $password = $_POST["password"];
    $gender   = $_POST["gender"];

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file = $_FILES["upload_file"];
    $file_name = $file["name"];
    $tmp_name  = $file["tmp_name"];
    $file_size = $file["size"];
    $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed   = ["jpg", "jpeg", "png", "pdf"];
    $max_size  = 2 * 1024 * 1024; // 2MB

    if (!in_array($file_ext, $allowed)) {
        echo "<p style='color:red;'>❌ Invalid file type. Only JPG, JPEG, PNG, PDF allowed.</p>";
    } elseif ($file_size > $max_size) {
        echo "<p style='color:red;'>❌ File too large. Max 2MB allowed.</p>";
    } else {
        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $destination = $upload_dir . $new_file_name;

        if (move_uploaded_file($tmp_name, $destination)) {
            // Save to file
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $data = "$name|$email|$position|$hashed_password|$gender|$new_file_name\n";
            file_put_contents($file_path, $data, FILE_APPEND);
            echo "<p style='color:green;'>✅ Registration successful!</p>";
        } else {
            echo "<p style='color:red;'>❌ File upload failed.</p>";
        }
    }
}

// Display table
if (file_exists($file_path)) {
    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!empty($lines)) {
        echo "<h3>All Registered Users</h3>";
        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Gender</th>
                    <th>File Preview</th>
                </tr>";
        foreach ($lines as $line) {
            $fields = explode("|", $line);
            $file = "uploads/" . $fields[5];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            echo "<tr>
                    <td>{$fields[0]}</td>
                    <td>{$fields[1]}</td>
                    <td>{$fields[2]}</td>
                    <td>{$fields[4]}</td>
                    <td>";
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                echo "<img src='$file'>";
            } elseif ($ext === 'pdf') {
                echo "<iframe src='$file' width='100'></iframe>";
            } else {
                echo "File";
            }
            echo "</td></tr>";
        }
        echo "</table>";

        // ✅ Add link to main register page
        echo "<br><a href='register.html'>🔙 Go to Main Register Form</a>";
    }
}
?>
