
<?php

include "config.php";

$booking = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $booking_id = intval($_POST["booking_id"]);
    $phone = trim($_POST["phone"]);

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM bookings WHERE id = ? AND phone = ?"
    );

    mysqli_stmt_bind_param($stmt, "is", $booking_id, $phone);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $booking = mysqli_fetch_assoc($result);

    } else {

        $error = "Booking not found. Check your ID and phone number.";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Check Booking Status</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .status-page {
            min-height: 100vh;
            padding: 120px 5% 60px;
            background: #f4f0e7;
        }

        .status-card {
            max-width: 550px;
            margin: auto;
            padding: 40px;
            background: white;
            box-shadow: 0 20px 60px rgba(24, 54, 56, 0.12);
        }

        .status-card h1 {
            margin-bottom: 25px;
            color: #183638;
            font-weight: normal;
        }

        .status-card label {
            display: block;
            margin: 15px 0 8px;
            font-family: Arial, sans-serif;
            font-size: 11px;
            letter-spacing: 1px;
            color: #183638;
        }

        .status-card input {
            width: 100%;
            padding: 13px;
            border: 1px solid #d8d2c6;
            background: #faf8f3;
        }

        .status-card button {
            width: 100%;
            margin-top: 25px;
            padding: 15px;
            border: none;
            background: #d9a441;
            color: #183638;
            font-weight: bold;
            cursor: pointer;
        }

        .booking-result {
            margin-top: 25px;
            padding: 20px;
            background: #f4f0e7;
            font-family: Arial, sans-serif;
            line-height: 2;
            color: #183638;
        }

        .error {
            margin-top: 20px;
            color: #a33a3a;
            font-family: Arial, sans-serif;
        }

    </style>

</head>

<body>

<section class="status-page">

    <div class="status-card">

        <h1>Check Booking Status</h1>

        <form method="POST">

            <label>BOOKING ID</label>

            <input
                type="number"
                name="booking_id"
                placeholder="Enter booking ID"
                required>

            <label>PHONE NUMBER</label>

            <input
                type="tel"
                name="phone"
                placeholder="Enter phone number"
                required>

            <button type="submit">
                CHECK STATUS
            </button>

        </form>

        <?php if ($booking): ?>

            <div class="booking-result">

                <strong>Booking Found</strong><br>

                Customer:
                <?php echo htmlspecialchars($booking["customer_name"]); ?>
                <br>

                Destination:
                <?php echo htmlspecialchars($booking["destination"]); ?>
                <br>

                Travel Date:
                <?php echo htmlspecialchars($booking["travel_date"]); ?>
                <br>

                Passengers:
                <?php echo htmlspecialchars($booking["passengers"]); ?>
                <br>

                Status:
                <strong>
                    <?php echo htmlspecialchars($booking["status"] ?? "Pending"); ?>
                </strong>

            </div>

        <?php endif; ?>

        <?php if ($error): ?>

            <p class="error">
                <?php echo htmlspecialchars($error); ?>
            </p>

        <?php endif; ?>

    </div>

</section>

</body>

</html>