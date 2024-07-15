<?php
function getMonthName($date) {
    // Extract the month part from the date string
    $month = substr($date, 3, 2);
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
    }
}

// Get user input
echo "Enter a date in the format dd-mm-yyyy: ";
$date = trim(fgets(STDIN));
getMonthName($date);
?>