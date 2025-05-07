<?php

session_start();

if(isset($_SESSION["email"])){
    header("location: ./menu.php");
    exit;
}


$email = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['em-auth']);
    $password = trim($_POST['pass-auth']);

    if(empty($email) || empty($password)){
        $error = "Email and/or Password is required.";
    } else{
        include "tools/db.php";
        $dbConnection = getDBConnection();
     
        $statement = $dbConnection->prepare(
            "SELECT id, first_name, last_name, password, createdAt FROM users WHERE email = ?"
        );

        $statement->bind_param('s',$email);
        $statement->execute();


        $statement->bind_result($id, $first_name, $last_name, $stored_password, $createdAt);




        

        if($statement->fetch()){

            if(password_verify($password,$stored_password)){
                $_SESSION["id"] = $id;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["email"] = $email;
                $_SESSION["createdAt"] = $createdAt;
                
                header("location: ./menu.php");
                exit;
            }
        }

        $statement->close();

        $error = "Email or Password Invalid";
    }
}

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
        <form method="post" id="login-form">
            <div class="input-group">
                        <label for="em-auth">Email Address:</label>
                        <input type="email" id="em-auth" name="em-auth" value="<?= $email; ?>" required>
            </div>

            <div class="input-group">
                <label for="pass-auth">Password:</label>
                <input type="password" id="pass-auth" name="pass-auth" required>
            </div>

            <p class="forgot-password">
                <a href="#">Forgot Password?</a>
            </p>
                     <a href="./menu.php">
                <button type="submit">Log In</button>
                     </a>
                      <a href="./index.php">
            <button type="button" id="createAccountButton" class="create-account-button">Create New Account</button>
                      </a>
            <p id="error-message" class="error-message"></p>
        </form>
    </div>
</body>
</html>
