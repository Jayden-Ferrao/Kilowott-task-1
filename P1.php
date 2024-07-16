<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>If Else date</title>
</head>
<body>
    <!-- HTML Form -->
    <form method="post">
        <label for="date">Enter date ion this format (dd-mm-yyyy):</label>
        <input type="text" id="date" name="date" required>
        <input type="submit" value="Submit">
    </form>
    <?php
    // Check if form is submitted
    if ($_REQUEST["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        function extractMonthIfElse($date) {
            $month = substr($date, 3, 2); // basically 3 is the index and 2 is no.of characters taken
            if ($month == '01') {
                echo "It's January!";
            } elseif ($month == '02') {
                echo "It's February!";
            } elseif ($month == '03') {
                echo "It's March!";
            } elseif ($month == '04') {
                echo "It's April!";
            } elseif ($month == '05') {
                echo "It's May!";
            } elseif ($month == '06') {
                echo "It's June!";
            } elseif ($month == '07') {
                echo "It's July!";
            } elseif ($month == '08') {
                echo "It's August!";
            } elseif ($month == '09') {
                echo "It's September!";
            } elseif ($month == '10') {
                echo "It's October!";
            } elseif ($month == '11') {
                echo "It's November!";
            } elseif ($month == '12') {
                echo "It's December!";
            } else {
                echo "Invalid";
            }
        }
        extractMonthIfElse($date);
    }
    ?>
</body>
</html>