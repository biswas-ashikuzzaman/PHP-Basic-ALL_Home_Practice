<?php
    class StudentInfo{
        public $name, $id, $email, $phone;

        public static $file_path = "data.txt";

        public function __construct($_name, $_id, $_email, $_phone){
            $this->name = $_name;
            $this->id = $_id;
            $this->email = $_email;
            $this->phone =$_phone;
        }

        public function output(){
            return $this->name. " | " .$this->id. " | " .$this->email. " | " .$this->phone.PHP_EOL;
        }

        function store(){
            file_put_contents(self::$file_path, $this->output(), FILE_APPEND | LOCK_EX);
        }

        public static function print(){
            $studentData = file(self::$file_path);
            echo"<h2 style='text-align:center; text-decoration:underline'>Student Information</h2>";
            echo"<table border='1' cellpadding ='10' style='border-collapse:collapse; margin:30px auto; width:50%; background-color: #aec3b0 ; text-align:center'>";
                echo "<tr>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Contact No</th>
                </tr>";
            

        foreach($studentData as $value){
            list($name, $id, $email, $phone) = explode("|",trim($value));
             echo "<tr>
                    <td>" . htmlspecialchars($name) . "</td>
                    <td>" . htmlspecialchars($id) . "</td>
                    <td>" . htmlspecialchars($email) . "</td>
                    <td>" . htmlspecialchars($phone) . "</td>
                </tr>";

        }
        echo"</table>";
        }

    }
?>