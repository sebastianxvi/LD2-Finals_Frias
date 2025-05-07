<?php
session_start();

$authenticated = false;
if (isset($_SESSION["email"])) {
    $authenticated = true;
}

$username = "";
$email = "";

$username_err = "";
$email_err = "";
$pass_err = "";
$Cpass_err = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Fixed: assign to $username
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmed_pass = $_POST['Cpass'];

    if (empty($username)) {
        $username_err = "Username is required.";
        $error = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Email format invalid.";
        $error = true;
    }

    include "tools/db.php";
    $dbConnection = getDBConnection();

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows > 0) {
        $email_err = "Email already used.";
        $error = true;
    }

    $statement->close();

    if (strlen($password) < 6) {
        $pass_err = "Password must be at least 6 characters.";
        $error = true;
    }

    if ($confirmed_pass != $password) {
        $Cpass_err = "Passwords do not match.";
        $error = true;
    }

    if (!$error) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbConnection->prepare(
            "INSERT INTO users (username, email, password, createdAt) VALUES (?, ?, ?, ?)"
        );
        $statement->bind_param('ssss', $username, $email, $password, $created_at);
        $statement->execute();
        $insert_id = $statement->insert_id;
        $statement->close();

        $_SESSION["id"] = $insert_id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["created_at"] = $created_at;

        header("Location: menu.php");
        exit();
    }
}

if ($authenticated) {
    header("Location: menu.php");
    exit();
} else {
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>BREWOLOGY</title>
    <link rel="stylesheet" href="registration-form.css">
</head>

<body>
    <div class="container">
        <div class="registration-form">
            <form method="POST">
                <label for="username" class="label">Username</label>
                <input type="text" id="username" name="username" class="textbox" placeholder="Enter username here" required>
                <span style="color:red;"><?php echo $username_err; ?></span><br><br>

                <label for="email" class="label">Email</label>
                <input type="email" id="email" name="email" class="textbox" placeholder="Enter email here" required>
                <span style="color:red;"><?php echo $email_err; ?></span><br><br>

                <label for="password" class="label">Password</label>
                <input type="password" id="password" name="password" class="textbox" placeholder="Enter password here" required>
                <span style="color:red;"><?php echo $pass_err; ?></span><br><br>

                <label for="Cpass" class="label">Confirm Password</label>
                <input type="password" id="Cpass" name="Cpass" class="textbox" placeholder="Re-enter password here" required>
                <span style="color:red;"><?php echo $Cpass_err; ?></span><br><br>

                <center><button type="submit" id="btn">Register</button></center>
                <center><a href="login.php" id="btn-link">Already have an account? Log In</a></center>
            </form>
        </div>
    </div>
</body>

</html>
<?php
}
?>
