
<?php
session_start();

$admin_username = "admin";
$admin_password = "12345";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == $admin_username && $password == $admin_password) {

        $_SESSION["admin_logged_in"] = true;

        header("Location: admin_bookings.php");
        exit();

    } else {

        $error = "Invalid username or password!";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Kashinathan Travels</title>

    <style>
        body {
            font-family: Arial;
            background: #102a2a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 300px;
            text-align: center;
        }

        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        button {
            background: #c49a52;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h2>Admin Login</h2>

    <?php
    if ($error != "") {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <input type="text" name="username"
               placeholder="Username" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit">LOGIN</button>

    </form>

</div>

</body>
</html>