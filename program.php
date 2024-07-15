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

// PHP code for server-side processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the date input from the form
    $date = $_POST['date'];

    // Output JavaScript alert with the month name
    echo "<script>alert('" . getMonthName($date) . "');</script>";
}
?>

<!-- HTML form for user input -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Enter a date in the format dd-mm-yyyy:
    <input type="text" name="date">
    <input type="submit" value="Submit">
</form>