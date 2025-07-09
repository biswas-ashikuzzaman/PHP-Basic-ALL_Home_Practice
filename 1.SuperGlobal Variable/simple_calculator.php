<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Calculator</title>
</head>
<body>
    <h2>🧮 Simple Calculator</h2>
    <form method="get" action="">
        <input type="number" name="num1" placeholder="Enter first number" required 
               value="<?= isset($_GET['num1']) ? $_GET['num1'] : '' ?>"> <br><br>
        
        <select name="operator" required>
            <option value="+">Addition (+)</option>
            <option value="-">Subtraction (-)</option>
            <option value="*">Multiplication (*)</option>
            <option value="/">Division (/)</option>
        </select> <br><br>

        <input type="number" name="num2" placeholder="Enter second number" required 
               value="<?= isset($_GET['num2']) ? $_GET['num2'] : '' ?>"> <br><br>

        <input type="submit" value="Calculate">
    </form>

    <?php
    if (isset($_GET['num1'], $_GET['num2'], $_GET['operator'])) {
        $num1 = (float) $_GET['num1'];
        $num2 = (float) $_GET['num2'];
        $op = $_GET['operator'];
        $result = null;

        switch ($op) {
            case '+': $result = $num1 + $num2; break;
            case '-': $result = $num1 - $num2; break;
            case '*': $result = $num1 * $num2; break;
            case '/':
                if ($num2 == 0) {
                    echo "<h3 style='color:red'>Error: Division by zero!</h3>";
                    exit;
                }
                $result = $num1 / $num2;
                break;
            default:
                echo "<h3 style='color:red'>Invalid operator selected.</h3>";
                exit;
        }

        echo "<h3>Result: $num1 $op $num2 = $result</h3>";
    }
    ?>
</body>
</html>
