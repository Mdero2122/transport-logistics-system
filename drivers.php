<?php
session_start();

include('config/database.php');

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

if(isset($_POST['add_driver'])){

    $driver_name = mysqli_real_escape_string($conn, $_POST['driver_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $license_number = mysqli_real_escape_string($conn, $_POST['license_number']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO drivers
    (driver_name,phone,license_number,status)

    VALUES

    ('$driver_name','$phone','$license_number','$status')";

    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drivers</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .status-online{

    background:#22c55e;

    color:white;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:bold;

    box-shadow:
    0 0 10px rgba(34,197,94,0.6);

}

.status-delivering{

    background:#eab308;

    color:white;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:bold;

    box-shadow:
    0 0 10px rgba(234,179,8,0.6);

}

.status-offline{

    background:#ef4444;

    color:white;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:bold;

    box-shadow:
    0 0 10px rgba(239,68,68,0.6);

}

              body{
    background:#d1d5db;
}

       .container-box{

    background:white;

    padding:25px;

    border-radius:20px;

    border:2px solid #facc15;

    box-shadow:
        0 0 15px #facc15,
        0 0 30px rgba(250,204,21,0.5);

    animation:driverGlow 2s infinite alternate;

}

    </style>

</head>
<body>

<div class="container mt-5">

    <div class="container-box">

        <h2 class="mb-4">Driver Management</h2>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Driver Name</label>
                    <input type="text" name="driver_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>License Number</label>
                    <input type="text" name="license_number" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option>Available</option>
                        <option>On Delivery</option>
                        <option>Off Duty</option>

                    </select>

                </div>

            </div>

            <button type="submit" name="add_driver" class="btn btn-dark">
                Add Driver
            </button>

        </form>

        <hr>

        <h4 class="mb-3">Driver Records</h4>

        <table class="table table-bordered">

            <thead>
              <tr>
    <th>ID</th>
    <th>Driver Name</th>
    <th>Phone Number</th>
    <th>License Number</th>
    <th>Availability</th>
    <th>Online Status</th>
</tr>
            </thead>

            <tbody>

            <?php

            $drivers = mysqli_query($conn, "SELECT * FROM drivers ORDER BY id DESC");

            while($row = mysqli_fetch_assoc($drivers)){

            ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['driver_name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['license_number']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>

    <span class="status-online">

        Online

    </span>

</td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>