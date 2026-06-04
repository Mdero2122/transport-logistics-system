<?php

include('../config/database.php');

if(isset($_POST['register'])){

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO customers
    (full_name,email,password)

    VALUES

    ('$full_name','$email','$password')";

    mysqli_query($conn, $query);

    echo "<div style='color:green;text-align:center;'>
    Customer Registered Successfully
    </div>";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Customer Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.register-box{

    width:400px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);

}

</style>

</head>
<body>

<div class="register-box">

<h2 class="mb-4 text-center">
Customer Register
</h2>

<form method="POST">

<div class="mb-3">

<label>Full Name</label>

<input type="text"
       name="full_name"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
       name="email"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="password"
       name="password"
       class="form-control"
       required>

</div>

<button type="submit"
        name="register"
        class="btn btn-dark w-100">

Register

</button>

</form>

</div>

</body>
</html>