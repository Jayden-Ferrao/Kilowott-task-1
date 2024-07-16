<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>switch date</title>
</head>
<body>
    <form action="date.php" method="post">
        <label for="date">Enter date in this format (dd-mm-yyyy):</label>
        <input type="text" id="date" name="date" required>
        <input type="submit" value="Submit">
    </form>

 <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    MonthSwitch($date);
}
function MonthSwitch($date) {
    $month = substr($date, 3, 2);
    switch ($month) {
        case '01':
            echo "Its January!";
            break;
        case '02':
            echo "Its February!";
            break;
        case '03':
            echo "Its March!";
            break;
        case '04':
            echo "Its April!";
            break;
        case '05':
            echo "Its May!";
            break;
        case '06':
            echo "Its June!";
            break;
        case '07':
            echo "Its July!";
            break;
        case '08':
            echo "Its August!";
            break;
        case '09':
            echo "Its September!";
            break;
        case '10':
            echo "Its October!";
            break;
        case '11':
            echo "Its November!";
            break;
        case '12':
            echo "Its December!";
            break;
        default:
        echo "Invalid";
            break;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    extractMonthSwitch($date);
}
?>
</body>
</html>