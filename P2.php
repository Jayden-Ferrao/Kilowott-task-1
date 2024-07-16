<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Month Extractor</title>
</head>
<body>
    <form method="post">
        <label for="date">Enter date (dd-mm-yyyy):</label>
        <input type="text" id="date" name="date" required>
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        
        function getMonthName($date) {
            // Extract the month part from the date string
            $month = substr($date, 3, 2);

            // Use switch case to determine the month name
            switch ($month) {
                case '01':
                    echo "It's January!";
                    break;
                case '02':
                    echo "It's February!";
                    break;
                case '03':
                    echo "It's March!";
                    break;
                case '04':
                    echo "It's April!";
                    break;
                case '05':
                    echo "It's May!";
                    break;
                case '06':
                    echo "It's June!";
                    break;
                case '07':
                    echo "It's July!";
                    break;
                case '08':
                    echo "It's August!";
                    break;
                case '09':
                    echo "It's September!";
                    break;
                case '10':
                    echo "It's October!";
                    break;
                case '11':
                    echo "It's November!";
                    break;
                case '12':
                    echo "It's December!";
                    break;
                default:
                    echo "Oh no! The month is out of this world!";
                    break;
            }
        }

        getMonthName($date);
    }
    ?>
</body>
</html>