<?php

session_start();

$authenticated = false;
if(isset($_SESSION["email"])){
    $authenticated = true;
}

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$address = "";

$fname_err = "";
$Lname_err = "";
$email_err = "";
$pass_err = "";
$Cpass_err = "";


$error = false;

IF($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = $_POST['fname'];
    $last_name = $_POST['Lname'];
    $email = $_POST['em'];
    $password = $_POST['pass'];
    $confirmed_pass = $_POST['Cpass'];




    if(empty($first_name)){
        $fname_err = "First Name is required.";
        $error = true;
    }
    if(empty($last_name)){
        $Lname_err = "Last Name is required.";
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
    if ($statement->num_rows > 0){
        $email_err = "Email already used.";
        $error = true;
    }

    $statement->close();

    if(strlen($password) < 6){
        $pass_err = "Password must be greater than 7 characters.";
        $error = true;
    }
    if($confirmed_pass != $password){
        $Cpass_err = "Passwords do not match.";
        $error = true;
    }


    if(!$error){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbConnection->prepare(
            "INSERT INTO users (first_name, last_name, email, phone, address, password, created_at) ".
            "VALUES (?,?,?,?,?,?,?)"
        );

    $statement->bind_param('sssssss', $first_name,$last_name,$email,$phone,$address,$password,$created_at);

    $statement->execute();

    $insert_id = $statement->insert_id;
    $statement->close();



    $_SESSION["id"] = $insert_id;
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["email"] = $email;
    $_SESSION["created_at"] = $created_at;

    header("Location: menu.php");
    exit();
    }
}
if($authenticated){
    header("Location: login.php");
    exit();
} else {
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIDOY_LD1_FINALS</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url(https://thumbs.dreamstime.com/b/coastal-laundry-room-design-modern-stylish-decor-featuring-white-blue-cabinets-large-rug-comfortable-bench-suitable-351175525.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 65%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .toggle-password img {
            width: 20px;
            height: 20px;
        }

        .login-button, .create-account-button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button {
            background-color: #7851A9;
            color: white;
        }

        .login-button:hover {
            background-color: #9966CC;
        }

        .create-account-button {
            background-color: #4CAF50;
            color: white;
            margin-top: 10px;
        }

        .create-account-button:hover {
            background-color: #45a049;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #1877F2;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Log In</h2>
        <form id="login-form">
            <div class="input-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" value="<?= $first_name; ?>" required placeholder="Enter your First Name">
                <label for="Lname">Last Name</label>
                <input type="text" id="Lname" name="Lname" value="<?= $last_name; ?>" required placeholder="Enter your Last Name">
                <label for="em">Email</label>
                <input type="email" id="em" name="em" value="<?= $email; ?>" required placeholder="Enter your Last Name">
            </div>

            <div class="input-group">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" required placeholder="Enter your password">
                <button type="button" id="togglePassword" class="toggle-password">
                    <img id="eyeIcon" src="https://cdn-icons-png.flaticon.com/512/159/159604.png" alt="Show Password">
                </button>
                <label for="Cpass">Password</label>
                <input type="password" id="Cpass" name="Cpass" required placeholder="Enter your password">
                <button type="button" id="togglePassword" class="toggle-password">
                    <img id="eyeIcon" src="https://cdn-icons-png.flaticon.com/512/159/159604.png" alt="Show Password">
                </button>
            </div>

            <p class="forgot-password">
                <a href="#">Forgot Password?</a>
            </p>
            <a href="./login.php">
          <button type="submit" id="createAccountButton" class="create-account-button">Register</button>
                    </a> 
            <button type="button" id="createAccountButton" class="create-account-button">Login</button>
            <p id="error-message" class="error-message"></p>
        </form>
    </div>
</body>
</html>



<?php
}
?>
