
<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: admin_login.php");
    exit();
}

include "config.php";

$message = "";

// Add Owner
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["add_owner"])) {

    $owner_name = trim($_POST["owner_name"]);
    $instagram_id = trim($_POST["instagram_id"]);
    $position = "RC Owner";

    $photo_path = "";

    if (!empty($_FILES["photo"]["name"])) {

        $photo_name = $_FILES["photo"]["name"];
        $photo_tmp = $_FILES["photo"]["tmp_name"];

        $photo_ext = strtolower(
            pathinfo($photo_name, PATHINFO_EXTENSION)
        );

        $allowed_ext = ["jpg", "jpeg", "png", "webp"];

        if (in_array($photo_ext, $allowed_ext)) {

            $new_photo_name = time() . "_" .
                              bin2hex(random_bytes(4)) .
                              "." . $photo_ext;

            $photo_path = "uploads/" . $new_photo_name;

            move_uploaded_file(
                $photo_tmp,
                __DIR__ . "/" . $photo_path
            );
        }
    }

    $sql = "INSERT INTO owner
            (owner_name, photo, instagram_id, position)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $owner_name,
        $photo_path,
        $instagram_id,
        $position
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Owner added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Delete Owner
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["delete_owner"])) {

    $owner_id = intval($_POST["owner_id"]);

    $sql = "DELETE FROM owner WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $owner_id);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Owner deleted successfully!";
    } else {
        $message = "Delete failed!";
    }

    mysqli_stmt_close($stmt);
}

$result = mysqli_query(
    $conn,
    "SELECT * FROM owner ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Owner Management</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <style>

        body {
            font-family: Arial;
            background: #102a2a;
            color: white;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        form, table {
            background: white;
            color: #222;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        input, button {
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

        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .delete-btn {
            background: #c0392b;
            color: white;
        }

        .message {
            color: #90ee90;
            font-weight: bold;
        }

        @media (max-width: 600px) {

            table {
                display: block;
                overflow-x: auto;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <h1>Owner Management</h1>

    <?php if ($message != "") { ?>

        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php } ?>

    <form method="POST"
          enctype="multipart/form-data">

        <h2>Add Owner</h2>

        <input type="text"
               name="owner_name"
               placeholder="Owner Name"
               required>

        <input type="file"
               name="photo"
               accept="image/*"
               required>

        <input type="text"
               name="instagram_id"
               placeholder="Instagram ID (Example: @owner)"
               required>

        <input type="text"
               value="RC Owner"
               disabled>

        <button type="submit"
                name="add_owner">

            ADD OWNER

        </button>

    </form>

    <h2>Owner List</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Instagram</th>
            <th>Position</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td>
                <?php echo $row["id"]; ?>
            </td>

            <td>

                <?php if (!empty($row["photo"])) { ?>

                    <img src="<?php echo htmlspecialchars($row["photo"]); ?>">

                <?php } ?>

            </td>

            <td>
                <?php echo htmlspecialchars($row["owner_name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["instagram_id"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row["position"]); ?>
            </td>

            <td>

                <form method="POST"
                      style="padding:0; margin:0;">

                    <input type="hidden"
                           name="owner_id"
                           value="<?php echo $row["id"]; ?>">
                    <a href="edit_owner.php?id=<?php echo $row['id']; ?>"
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
                            name="delete_owner"
                            class="delete-btn"
                            onclick="return confirm('Delete this owner?');">

                        DELETE

                    </button>

                </form>

            </td>

        </tr>

        <?php } ?>

    </table>

    <p>
        <a href="admin_bookings.php"
           style="color:white;">

            ← Back to Bookings

        </a>
    </p>

</div>

</body>
</html>