<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include('../config/database.php');

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM drivers
              WHERE email='$email'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $driver = mysqli_fetch_assoc($result);

        $_SESSION['driver_name'] = $driver['driver_name'];
        $_SESSION['role'] = 'driver';

        header("Location: dashboard.php");
        exit();

    } else {

        echo "<script>alert('Invalid Login');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Login</title>

    <style>

        body{
            background:#d1d5db;
            font-family:Arial, sans-serif;
        }

        .login-box{
            width:300px;
            background:white;
            padding:30px;
            border-radius:20px;
            margin:150px auto;
            text-align:center;
        }

        input{
            width:90%;
            padding:10px;
            margin:10px 0;
            border:1px solid #ccc;
            border-radius:8px;
        }

        button{
            width:100%;
            padding:12px;
            background:#2563eb;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
        }

    </style>

</head>

<body>

<div class="login-box">

    <h1>Driver Login</h1>

    <form method="POST">

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>