
<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: admin_login.php");
    exit();
}

include "config.php";

$message = "";


// Add staff
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["add_staff"])) {

    $staff_name = trim($_POST["staff_name"]);
    $instagram_id = trim($_POST["instagram_id"]);
    $role = implode(", ", $_POST["role"]);

    $photo_name = $_FILES["photo"]["name"];
    $photo_tmp = $_FILES["photo"]["tmp_name"];

    $photo_ext = strtolower(
        pathinfo($photo_name, PATHINFO_EXTENSION)
    );

    $allowed_ext = ["jpg", "jpeg", "png", "webp"];

    if (!in_array($photo_ext, $allowed_ext)) {

        $message = "Only JPG, PNG and WEBP images allowed!";

    } else {

        $new_photo_name = time() . "_" .
                          bin2hex(random_bytes(4)) .
                          "." . $photo_ext;

        $photo_path = "uploads/staff/" . $new_photo_name;

        $full_photo_path = __DIR__ . "/" . $photo_path;

        if (move_uploaded_file($photo_tmp, $full_photo_path)) {

            $sql = "INSERT INTO staff
                    (staff_name, photo, instagram_id, role)
                    VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "ssss",
                $staff_name,
                $photo_path,
                $instagram_id,
                $role
            );

            if (mysqli_stmt_execute($stmt)) {
                $message = "Staff added successfully!";
            } else {
                $message = "Database error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);

        } else {

            $message = "Photo upload failed!";

        }
    }
}

// Delete staff
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["delete_staff"])) {

    $staff_id = intval($_POST["staff_id"]);

    $sql = "DELETE FROM staff WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $staff_id);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Staff deleted successfully!";
    } else {
        $message = "Delete failed: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

$result = mysqli_query(
    $conn,
    "SELECT * FROM staff ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Management</title>

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

        .delete-btn {
            background: #c0392b;
            color: white;
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

.role-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin: 12px 0;
}

.role-options label {
    background: #f1eadc;
    padding: 12px;
    border-radius: 8px;
    color: #222;
    cursor: pointer;
}

.role-options input {
    width: auto;
    margin-right: 8px;
}
    </style>
</head>

<body>

<div class="container">

    <h1>Faculty / Staff Management</h1>

    <?php
    if ($message != "") {
        echo "<p class='message'>" .
             htmlspecialchars($message) .
             "</p>";
    }
    ?>

    <form method="POST" enctype="multipart/form-data">

        <h2>Add Staff</h2>

        <input type="text"
               name="staff_name"
               placeholder="Staff Name"
               required>

        <input type="file"
       name="photo"
       accept="image/*"
       required>

        <input type="text"
               name="instagram_id"
               placeholder="Instagram ID (Example: @arun)"
               required>

        
<label>Select Roles</label>


<label>Select Roles</label>

<div class="role-options">

    <label>
        <input type="checkbox" name="role[]" value="Driver">
        Driver
    </label>

    <label>
        <input type="checkbox" name="role[]" value="Cleaner">
        Cleaner
    </label>

    <label>
        <input type="checkbox" name="role[]" value="Guide">
        Guide
    </label>

    <label>
        <input type="checkbox" name="role[]" value="Manager">
        Manager
    </label>

</div>

<small>
    Ctrl press cheythu multiple roles select cheyyam.
</small>

        <button type="submit" name="add_staff">
            ADD STAFF
        </button>

    </form>

    <h2>Staff List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Instagram ID</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td>
                <?php echo $row["id"]; ?>
            </td>

            <td>
    <img src="<?php echo htmlspecialchars($row["photo"]); ?>"
         width="80"
         height="80"
         style="object-fit: cover; border-radius: 10px;">
</td>

            <td>
                <?php echo htmlspecialchars($row["staff_name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["instagram_id"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["role"]); ?>
            </td>

            <td>
                <form method="POST" style="padding:0; margin:0;">

                    <input type="hidden"
                           name="staff_id"
                           value="<?php echo $row["id"]; ?>">

                    <a href="edit_staff.php?id=<?php echo $row['id']; ?>"
                        style="display:block;
                        background:#2878a8;
                        color:white;
                        padding:10px;
                        text-align:center;
                        text-decoration:none;
                        border-radius:5px;
                        margin-bottom:8px;">
                    EDIT
                    </a>

                    <button type="submit"
                            name="delete_staff"
                            class="delete-btn"
                            onclick="return confirm('Delete this staff?');">
                        DELETE
                    </button>

                </form>
            </td>
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