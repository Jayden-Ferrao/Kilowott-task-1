<?php
function getMonthName($date) {
    // Extract the month part from the date string
    $month = substr($date, 3, 2);

    // Determine the month name using switch case
    switch ($month) {
        case '01':
            return "It's January!";
        case '02':
            return "It's February!";
        case '03':
            return "It's March!";
        case '04':
            return "It's April!";
        case '05':
            return "It's May!";
        case '06':
            return "It's June!";
        case '07':
            return "It's July!";
        case '08':
            return "It's August!";
        case '09':
            return "It's September!";
        case '10':
            return "It's October!";
        case '11':
            return "It's November!";
        case '12':
            return "It's December!";
        default:
            return "Oh no! The month is out of this world!";
    }
}
// JavaScript alert
echo "<script>alert('Enter a date in the format dd-mm-yyyy:" . getMonthName($date) . "');</script>";
$date = trim(fgets(STDIN));
echo "<script>alert('".$month. "');</script>";
?>