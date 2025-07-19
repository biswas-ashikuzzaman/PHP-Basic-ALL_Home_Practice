<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="file_upload_1.php" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile"> <br> <br>
        <input type="submit" name="submit" value="upload file">
    </form>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
$filename= $_FILES ['myfile'] ['name'];
$tmpname= $_FILES['myfile'] ['tmp_name'];
$upload='uploads/'.$filename;
move_uploaded_file($tmpname,$upload);
}
?>