<?php
session_start();

include('config/database.php');

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

if(isset($_POST['add_vehicle'])){

    $vehicle_number = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $vehicle_type = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO vehicles
    (vehicle_number,vehicle_type,capacity,status)

    VALUES

    ('$vehicle_number','$vehicle_type','$capacity','$status')";

    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
    background:#d1d5db;
}

        .container-box{
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

    </style>

</head>
<body>

<div class="container mt-5">

    <div class="container-box">

        <h2 class="mb-4">Vehicle Management</h2>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Vehicle Number</label>
                    <input type="text" name="vehicle_number" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Vehicle Type</label>
                    <input type="text" name="vehicle_type" class="form-control" required>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Capacity</label>
                    <input type="text" name="capacity" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option>Available</option>
                        <option>Busy</option>
                        <option>Maintenance</option>

                    </select>

                </div>

            </div>

            <button type="submit" name="add_vehicle" class="btn btn-dark">
                Add Vehicle
            </button>

        </form>

        <hr>

        <h4 class="mb-3">Vehicle Records</h4>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle Number</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php

            $vehicles = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY id DESC");

            while($row = mysqli_fetch_assoc($vehicles)){

            ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['vehicle_number']; ?></td>
                    <td><?php echo $row['vehicle_type']; ?></td>
                    <td><?php echo $row['capacity']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>