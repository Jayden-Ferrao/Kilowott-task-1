<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>If Else Date</title>
</head>
<body>
    <form method="post" action="">
        <label for="date">Enter a date in dd-mm-yy: </label>
        <input type="text" id="date" name="date" required>
        <button type="submit">Submit</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST["date"];
        function printMonthIfElse($date) {
            $month = substr($date, 3, 2);
            $monthInt = (int)$month; // converting string to int
            if ($monthInt == 1) {
                echo "It's January!";
            } elseif ($monthInt == 2) {
                echo "It's February!";
            } elseif ($monthInt == 3) {
                echo "It's March!";
            } elseif ($monthInt == 4) {
                echo "It's April!";
            } elseif ($monthInt == 5) {
                echo "It's May!";
            } elseif ($monthInt == 6) {
                echo "It's June!";
            } elseif ($monthInt == 7) {
                echo "It's July!";
            } elseif ($monthInt == 8) {
                echo "It's August!";
            } elseif ($monthInt == 9) {
                echo "It's September!";
            } elseif ($monthInt == 10) {
                echo "It's October!";
            } elseif ($monthInt == 11) {
                echo "It's November!";
            } elseif ($monthInt == 12) {
                echo "It's December!";
            } else {
                echo "Invalid";
            }
        }
        printMonthIfElse($date);
    }
    ?>
</body>
</html>