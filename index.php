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

    header("Location: home.php");
    exit();
    }
}
if($authenticated){
    header("Location: home.php");
    exit();
} else {
?>
