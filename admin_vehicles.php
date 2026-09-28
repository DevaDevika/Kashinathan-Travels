
<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: admin_login.php");
    exit();
}

include "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vehicle_name = $_POST["vehicle_name"];
    $vehicle_type = $_POST["vehicle_type"];
    $seat_capacity = intval($_POST["seat_capacity"]);
    $status = $_POST["status"];

    $sql = "INSERT INTO vehicles
            (vehicle_name, vehicle_type, seat_capacity, status)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssis",
        $vehicle_name,
        $vehicle_type,
        $seat_capacity,
        $status
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Vehicle added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Management</title>

    <style>
        body {
            font-family: Arial;
            background: #102a2a;
            color: white;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        form, table {
            background: white;
            color: #222;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background: #c49a52;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #c49a52;
        }

        .message {
            color: #90ee90;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Vehicle Management</h1>

    <?php
    if ($message != "") {
        echo "<p class='message'>$message</p>";
    }
    ?>

    <form method="POST">

        <h2>Add Vehicle</h2>

        <input type="text" name="vehicle_name"
               placeholder="Vehicle Name" required>

        <input type="text" name="vehicle_type"
               placeholder="Vehicle Type" required>

        <input type="number" name="seat_capacity"
               placeholder="Seat Capacity" min="1" required>

        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
        </select>

        <button type="submit">ADD VEHICLE</button>

    </form>

    <h2>Vehicle List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Seats</th>
            <th>Status</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo htmlspecialchars($row["vehicle_name"]); ?></td>
            <td><?php echo htmlspecialchars($row["vehicle_type"]); ?></td>
            <td><?php echo $row["seat_capacity"]; ?></td>
            <td><?php echo htmlspecialchars($row["status"]); ?></td>
        </tr>

        <?php } ?>

    </table>

    <p>
        <a href="admin_bookings.php" style="color:white;">
            ← Back to Bookings
        </a>
    </p>

</div>

</body>
</html>