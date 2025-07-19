<?php
class ExtendClass extends StudentInfo
{
    public $address, $photo;

    public function __construct($_name, $_id, $_email, $_phone, $_address, $_photo)
    {
        parent::__construct($_name, $_id, $_email, $_phone);
        $this->address = $_address;
        $this->photo = $_photo;
    }

    public function output()
    {
        return parent::output() . " | " . $this->address . " | " . $this->photo . PHP_EOL;
    }

    public static function print()
    {
        // Check if file path is set and file exists
        if (!isset(self::$file_path) || !file_exists(self::$file_path)) {
            echo "<p style='color:red; text-align:center;'>Data file not found.</p>";
            return;
        }

        $studentFile = file(self::$file_path, FILE_APPEND);

        echo "<h2 style='text-align:center; text-decoration:underline'>Student Information</h2>";
        echo "<table border='1' cellpadding='10' style='border-collapse:collapse; margin:30px auto; width:50%; background-color: #aec3b0; text-align:center'>";
        echo "<tr>
                <th>Name</th>
                <th>Id</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Address</th>
                <th>Photo</th>
              </tr>";

        foreach ($studentFile as $value) {
            list($name, $id, $email, $phone, $address, $photo) = explode(" | ", trim($value));


            echo "<tr>
                    <td>" . htmlspecialchars($name) . "</td>
                    <td>" . htmlspecialchars($id) . "</td>
                    <td>" . htmlspecialchars($email) . "</td>
                    <td>" . htmlspecialchars($phone) . "</td>
                    <td>" . htmlspecialchars($address) . "</td>
                    <td><img src='media/" . htmlspecialchars($photo) . "' width='100'\"></td>
                  </tr>";
        }

        echo "</table>";
    }
}
?>