<?php
include('../config/database.php');

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users(name,email,password)
              VALUES('$name','$email','$password')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Registration Successful');</script>";
    } else {
        echo "<script>alert('Registration Failed');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="container">

    <div class="login-container">

        <h2 class="text-center mb-4">
            Create Account
        </h2>

        <form method="POST">

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="register" class="btn btn-dark w-100">
                Register
            </button>

            <p class="mt-3 text-center">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </form>

    </div>

</div>

</body>
</html>