<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: admin_login.php");
    exit();
}

include "config.php";

$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Bookings - Kashinathan Travels</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .admin-page {
            min-height: 100vh;
            padding: 120px 5% 60px;
            background: #f4f0e7;
        }

        .admin-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .admin-heading span {
            font-family: Arial, sans-serif;
            font-size: 10px;
            letter-spacing: 3px;
            color: #b18227;
        }

        .admin-heading h1 {
            margin-top: 15px;
            font-size: 42px;
            font-weight: normal;
            color: #183638;
        }

        .table-container {
            max-width: 1200px;
            margin: auto;
            overflow-x: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 15px 45px rgba(24, 54, 56, 0.10);
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th {
            padding: 15px 12px;
            background: #183638;
            color: white;
            font-size: 11px;
            letter-spacing: 1px;
            text-align: left;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e0d6;
            color: #687777;
            font-size: 12px;
        }

        tr:hover {
            background: #faf8f3;
        }

        .status {
            color: #b18227;
            font-weight: bold;
        }

        .back-home {
            display: block;
            width: fit-content;
            margin: 30px auto 0;
            color: #687777;
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
    </style>

</head>

<body>

<section class="admin-page">

    <div class="admin-heading">

        <span>ADMIN PANEL</span>

        <h1>Booking Management</h1>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Starting Place</th>
                    <th>Destination</th>
                    <th>Passengers</th>
                    <th>Veg</th>
                    <th>Non-Veg</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                ?>

                <tr>

                    <td>
                        <?php echo htmlspecialchars($row['id']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['customer_name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['phone']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['travel_date']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['starting_place']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['destination']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['passengers']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['veg_passengers']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['nonveg_passengers']); ?>
                    </td>

                    <td class="status">
                        <?php echo htmlspecialchars($row['status'] ?? 'Pending'); ?>
                    </td>
                    <td>

    <form action="update_booking.php" method="POST">

        <input
            type="hidden"
            name="booking_id"
            value="<?php echo $row['id']; ?>">

        <select name="status" required>

            <option value="Pending"
                <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>
                Pending
            </option>

            <option value="Approved"
                <?php echo ($row['status'] == 'Approved') ? 'selected' : ''; ?>>
                Approved
            </option>

            <option value="Rejected"
                <?php echo ($row['status'] == 'Rejected') ? 'selected' : ''; ?>>
                Rejected
            </option>

        </select>

        <button type="submit">
            Update
        </button>

    </form>

</td>

                </tr>

                <?php

                    }

                } else {

                    echo "<tr><td colspan='11'>No bookings found.</td></tr>";

                }

                ?>

            </tbody>

        </table>

    </div>

    <a href="index.php" class="back-home">
        ← BACK TO HOME
    </a>

</section>

</body>

</html>