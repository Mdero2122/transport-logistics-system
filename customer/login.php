<?php

session_start();

include('../config/database.php');

if(isset($_POST['login'])){

    $email = $_POST['email'];

    $password = $_POST['password'];

  $query = "SELECT * FROM customers WHERE email='$email'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){

    $customer = mysqli_fetch_assoc($result);

    if(password_verify($password, $customer['password'])){

        $_SESSION['customer_name'] = $customer['full_name'];

        header("Location: dashboard.php");
        exit();

    }else{

        echo "<script>alert('Invalid Login');</script>";

    }

}else{

    echo "<script>alert('Invalid Login');</script>";

}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Customer Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{

    background:#d1d5db;

    display:flex;

    justify-content:center;

    align-items:center;

    height:100vh;

}

.login-box{

    background:white;

    padding:40px;

    border-radius:20px;

    width:400px;

    box-shadow:0 0 20px rgba(0,0,0,0.1);

}

</style>

</head>

<body>

<div class="login-box">

    <h2 class="text-center mb-4">

        Customer Login

    </h2>

    <form method="POST">

        <input type="email"
               name="email"
               class="form-control mb-3"
               placeholder="Email"
               required>

        <input type="password"
               name="password"
               class="form-control mb-3"
               placeholder="Password"
               required>

        <button type="submit"
                name="login"
                class="btn btn-primary w-100">

            Login

        </button>

    </form>

</div>

</body>

</html>