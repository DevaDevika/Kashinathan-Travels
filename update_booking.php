
<?php

session_start();

if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: admin_login.php");
    exit();
}
?>
<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $booking_id = intval($_POST["booking_id"]);
    $status = $_POST["status"];

    $allowed_status = ["Approved", "Rejected", "Pending"];

    if (in_array($status, $allowed_status)) {

        $sql = "UPDATE bookings
                SET status = '$status'
                WHERE id = $booking_id";

        if (mysqli_query($conn, $sql)) {

            header("Location: admin_bookings.php");
            exit();

        } else {

            echo "Status update failed: " . mysqli_error($conn);

        }

    } else {

        echo "Invalid status.";

    }

}

?>