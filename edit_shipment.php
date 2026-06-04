<?php
session_start();

include('config/database.php');

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$id = $_GET['id'];

$shipment = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM shipments WHERE id='$id'")
);

if(isset($_POST['update_shipment'])){

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $pickup_location = mysqli_real_escape_string($conn, $_POST['pickup_location']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $shipment_date = $_POST['shipment_date'];
    $status = $_POST['status'];
    $driver_name = $_POST['driver_name'];
$vehicle_number = $_POST['vehicle_number'];

    $query = "UPDATE shipments SET

    customer_name='$customer_name',
    pickup_location='$pickup_location',
    destination='$destination',
    shipment_date='$shipment_date',
  driver_name='$driver_name',
vehicle_number='$vehicle_number',
status='$status'

    WHERE id='$id'";

    if(mysqli_query($conn, $query)){

    echo "

    <div class='alert alert-success mt-3'>

        Shipment Updated Successfully

    </div>";
}

    header("Location: shipments.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shipment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
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

        <h2 class="mb-4">Edit Shipment</h2>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Customer Name</label>
                    <input type="text"
                           name="customer_name"
                           class="form-control"
                           value="<?php echo $shipment['customer_name']; ?>"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Shipment Date</label>
                    <input type="date"
                           name="shipment_date"
                           class="form-control"
                           value="<?php echo $shipment['shipment_date']; ?>"
                           required>
                </div>

            </div>

            <div class="mb-3">
                <label>Pickup Location</label>
                <input type="text"
                       name="pickup_location"
                       class="form-control"
                       value="<?php echo $shipment['pickup_location']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Destination</label>
                <input type="text"
                       name="destination"
                       class="form-control"
                       value="<?php echo $shipment['destination']; ?>"
                       required>
            </div>
<div class="mb-3">

    <label>Assign Driver</label>

    <select name="driver_name" class="form-control">

        <option value="">Select Driver</option>

        <?php

        $drivers = mysqli_query($conn, "SELECT * FROM drivers");

        while($driver = mysqli_fetch_assoc($drivers)){

        ?>

            <option
            value="<?php echo $driver['driver_name']; ?>"

            <?php
            if($shipment['driver_name']==$driver['driver_name'])
            echo "selected";
            ?>>

                <?php echo $driver['driver_name']; ?>

            </option>

        <?php } ?>

    </select>

</div>

<div class="mb-3">

    <label>Assign Vehicle</label>

    <select name="vehicle_number" class="form-control">

        <option value="">Select Vehicle</option>

        <?php

        $vehicles = mysqli_query($conn, "SELECT * FROM vehicles");

        while($vehicle = mysqli_fetch_assoc($vehicles)){

        ?>

            <option
            value="<?php echo $vehicle['vehicle_number']; ?>"

            <?php
            if($shipment['vehicle_number']==$vehicle['vehicle_number'])
            echo "selected";
            ?>>

                <?php echo $vehicle['vehicle_number']; ?>

            </option>

        <?php } ?>

    </select>
<div class="mb-3">

    <label>Assign Driver</label>

    <select name="driver_name" class="form-control">

        <option value="">Select Driver</option>

        <?php

        $drivers = mysqli_query($conn, "SELECT * FROM drivers");

        while($driver = mysqli_fetch_assoc($drivers)){

        ?>

            <option
            value="<?php echo $driver['driver_name']; ?>"

            <?php
            if($shipment['driver_name']==$driver['driver_name'])
            echo "selected";
            ?>>

                <?php echo $driver['driver_name']; ?>

            </option>

        <?php } ?>

    </select>

</div>

<div class="mb-3">

    <label>Assign Vehicle</label>

    <select name="vehicle_number" class="form-control">

        <option value="">Select Vehicle</option>

        <?php

        $vehicles = mysqli_query($conn, "SELECT * FROM vehicles");

        while($vehicle = mysqli_fetch_assoc($vehicles)){

        ?>

            <option
            value="<?php echo $vehicle['vehicle_number']; ?>"

            <?php
            if($shipment['vehicle_number']==$vehicle['vehicle_number'])
            echo "selected";
            ?>>

                <?php echo $vehicle['vehicle_number']; ?>

            </option>

        <?php } ?>

    </select>

</div>
</div>
            <div class="mb-3">
                <label>Status</label>

                <select name="status" class="form-control">

                   <option <?php if($shipment['status']=="Pending") echo "selected"; ?>>
    Pending
</option>

<option <?php if($shipment['status']=="Assigned") echo "selected"; ?>>
    Assigned
</option>

<option <?php if($shipment['status']=="In Transit") echo "selected"; ?>>
    In Transit
</option>

<option <?php if($shipment['status']=="Delivered") echo "selected"; ?>>
    Delivered
</option>

<option <?php if($shipment['status']=="Cancelled") echo "selected"; ?>>
    Cancelled
</option>

                </select>

            </div>

            <button type="submit"
                    name="update_shipment"
                    class="btn btn-dark">
                Update Shipment
            </button>

        </form>

    </div>

</div>

</body>
</html>