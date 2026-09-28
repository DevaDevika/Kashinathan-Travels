
<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) ||
    $_SESSION["admin_logged_in"] !== true) {

    header("Location: admin_login.php");
    exit();
}

include "config.php";

$id = intval($_GET["id"] ?? 0);

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM owner WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$owner = mysqli_fetch_assoc($result);

if (!$owner) {
    die("Owner not found!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $owner_name = trim($_POST["owner_name"]);
    $instagram_id = trim($_POST["instagram_id"]);

    $photo_path = $owner["photo"];

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

            $new_photo_path = "uploads/" . $new_photo_name;

            if (move_uploaded_file(
                $photo_tmp,
                __DIR__ . "/" . $new_photo_path
            )) {

                $photo_path = $new_photo_path;

            }
        }
    }

    $sql = "UPDATE owner
            SET owner_name = ?,
                photo = ?,
                instagram_id = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssi",
        $owner_name,
        $photo_path,
        $instagram_id,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        header("Location: admin_owner.php");
        exit();

    } else {

        echo "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Owner</title>

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
            max-width: 500px;
            margin: auto;
        }

        form {
            background: white;
            color: #222;
            padding: 20px;
            border-radius: 12px;
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
        }

        img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Edit Owner</h1>

    <form method="POST"
          enctype="multipart/form-data">

        <label>Owner Name</label>

        <input type="text"
               name="owner_name"
               value="<?php echo htmlspecialchars($owner['owner_name']); ?>"
               required>

        <label>Current Photo</label>

        <br>

        <?php if (!empty($owner["photo"])) { ?>

            <img src="<?php echo htmlspecialchars($owner["photo"]); ?>">

        <?php } ?>

        <label>Change Photo (Optional)</label>

        <input type="file"
               name="photo"
               accept="image/*">

        <label>Instagram ID</label>

        <input type="text"
               name="instagram_id"
               value="<?php echo htmlspecialchars($owner['instagram_id']); ?>"
               required>

        <label>Position</label>

        <input type="text"
               value="RC Owner"
               disabled>

        <button type="submit">
            UPDATE OWNER
        </button>

    </form>

    <p>
        <a href="admin_owner.php"
           style="color:white;">
            ← Back to Owner
        </a>
    </p>

</div>

</body>
</html>