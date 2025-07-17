<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
</head>
<style>
    div {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    form {
        background-color: #aec3b0;
        padding: 20px;
        border-radius: 50px 5px 50px 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    input {
        border: none;
        border-bottom: 1px solid black;
        padding: 8px;
        outline: none;
        /* optional: removes blue outline on focus */
        background-color: transparent;

    }

    /* input::placeholder{
        color:black;
    } */

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    button {
        padding: 10px;
        border-radius: 3px 20px 3px 20px;
        border: none;
        font-weight: bold;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-family: arial;
        cursor: pointer;

    }
</style>

<body>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <legend><b>Student Personal Information</b></legend>
            <br>
            <input type="text" placeholder="Enter Your Name" name="name">
            <br>
            <br>
            <input type="text" placeholder="Write Your Id" name="id">
            <br>
            <br>
            <input type="email" placeholder="Enter Email" name="email">
            <br>
            <br>
            <input type="number" placeholder="Enter Contact no. " name="phone">
            <br>
            <br>
            <input type="text" placeholder="Address" name="add">
            <br>
            <br>
            <input type="file" name="upload">
            <br>
            <br>
            <button name="submit">Submit</button>
        </form>
    </div>


    <?php
    require_once 'studentClass.php';
    require_once 'ExtendClass.php';

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['add'];

        // handle file upload 
    
        $file_name = $_FILES['upload']['name'];
        $temp_name = $_FILES['upload']['tmp_name'];
        $uploadDir = 'media/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir); // create if this file not exists
        }

        move_uploaded_file($temp_name, $uploadDir . $file_name);
        // echo "<img src='media/$file_name' width='150'>";
    


        // Email and phone validation
    
        $isEmailValid = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,6}$/', $email);
        $isPhoneValid = preg_match('/^\+?[0-9]{7,11}$/', $phone);

        if ($isEmailValid && $isPhoneValid) {
            // echo "<h4 style='color:green'>Your Email and Phone number are valid</h4>";
    
            $data = new ExtendClass($name, $id, $email, $phone, $address, $file_name);
            $data->store(); // Save to data.txt
            
            echo "<p style='text-align:center;color:green;'>Data submitted successfully!</p>";
        } else {
            echo "<h4 style='color:red'>Your Email and/or Phone number are invalid</h4>";
        }
    }

    ExtendClass::print();

    ?>


</body>

</html>