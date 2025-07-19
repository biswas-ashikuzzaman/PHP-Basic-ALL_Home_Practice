<?php
class student {
    private $id;
    private $name;
    private $email;
    private $batch;

    public static $file_path = "csearch.txt";

    function __construct($_id, $_name, $_email, $_batch) {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->batch = $_batch;
    }

    public function info() {
        return $this->id . "," . $this->name . "," . $this->email . "," . $this->batch . PHP_EOL;
    }

    public function store() {
        file_put_contents(self::$file_path, $this->info(), FILE_APPEND);
    }

public static function display_result() {
    if(file_exists(self::$file_path)) {
        $desh = file(self::$file_path);
        echo "<h3 style='text-align: center;'>Student Information</h3>";
        echo "<table style='width: 600px; margin: auto; border-collapse: collapse; font-family: Arial, sans-serif;'>
                <thead>
                    <tr style='background-color: #4CAF50; color: white;'>
                        <th style='border: 1px solid #ddd; padding: 8px;'>ID</th>
                        <th style='border: 1px solid #ddd; padding: 8px;'>Name</th>
                        <th style='border: 1px solid #ddd; padding: 8px;'>Email</th>
                        <th style='border: 1px solid #ddd; padding: 8px;'>Batch</th>
                    </tr>
                </thead>
                <tbody>";
        
        foreach ($desh as $a) {
            $parts = explode(",", trim($a));
            if (count($parts) === 4) {
                list($id, $name, $email, $batch) = $parts;
                echo "<tr style='background-color: #f2f2f2;'>
                        <td style='border: 1px solid #ddd; padding: 8px;'>$id</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>$name</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>$email</td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>$batch</td>
                      </tr>";
            } else {
                echo "<tr><td colspan='4' style='border: 1px solid red; padding: 8px;'>Invalid line: $a</td></tr>";
            }
        }

        echo "</tbody></table>";
    } else {
        echo "<p style='text-align:center;'>No data file found.</p>";
    }
}
}
?>