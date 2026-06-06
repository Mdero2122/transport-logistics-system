<?php
session_start();

include('config/database.php');

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

if(isset($_POST['add_shipment'])){

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);

    $pickup_location = mysqli_real_escape_string($conn, $_POST['pickup_location']);

    $destination = mysqli_real_escape_string($conn, $_POST['destination']);

    $shipment_date = $_POST['shipment_date'];
    $driver = $_POST['driver'];

$vehicle = $_POST['vehicle'];

    $tracking_number = "TRK" . rand(100000,999999);

    $query = "INSERT INTO shipments
 (customer_name,pickup_location,destination,shipment_date,driver_name,vehicle_number,status,tracking_number)

    VALUES

  ('$customer_name',
 '$pickup_location',
 '$destination',
 '$shipment_date',
 '$driver',
 '$vehicle',
 'Pending',
 '$tracking_number')";

   if(mysqli_query($conn, $query)){

    echo "

    <div class='alert alert-success mt-3'>

        Shipment Added Successfully

    </div>";

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipments</title>

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
        <?php

if(isset($_GET['deleted'])){

    echo "

    <div class='alert alert-danger'>

        Shipment Deleted Successfully

    </div>";
}

?>

        <h2 class="mb-4">Shipment Management</h2>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Shipment Date</label>
                    <input type="date" name="shipment_date" class="form-control" required>
                </div>

            </div>

            <div class="mb-3">
                <label>Pickup Location</label>
                <input type="text" name="pickup_location" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Destination</label>
                <input type="text" name="destination" class="form-control" required>
            </div>
<div class="row">

    <div class="col-md-6 mb-3">
        <label>Driver</label>

        <select name="driver" class="form-control">

            <option value="">Select Driver</option>

            <?php

            $drivers = mysqli_query($conn,
            "SELECT driver_name FROM drivers");

            while($driver = mysqli_fetch_assoc($drivers)){

                echo "<option value='".$driver['driver_name']."'>".$driver['driver_name']."</option>";

            }

            ?>

        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>Vehicle</label>

        <select name="vehicle" class="form-control">

            <option value="">Select Vehicle</option>

            <?php

            $vehicles = mysqli_query($conn,
            "SELECT vehicle_number FROM vehicles");

            while($vehicle = mysqli_fetch_assoc($vehicles)){

                echo "<option value='".$vehicle['vehicle_number']."'>".$vehicle['vehicle_number']."</option>";

            }

            ?>

        </select>
    </div>

</div>
            <button type="submit" name="add_shipment" class="btn btn-dark">
                Add Shipment
            </button>

        </form>

        <hr>

        <h4 class="mb-3">Shipment Records</h4>
        <form method="GET" class="mb-4">

    <div class="row">

        <div class="col-md-10">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search customer, tracking number or destination">
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">
                Search
            </button>
        </div>

    </div>

</form>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Pickup</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Tracking Number</th>
                    <th>Driver</th>
<th>Vehicle</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php

           $search = "";

if(isset($_GET['search'])){

    $search = trim($_GET['search']);
$search = mysqli_real_escape_string($conn, $search);

    $shipments = mysqli_query($conn,

    "SELECT * FROM shipments

    WHERE

    customer_name LIKE '%$search%'
    OR tracking_number LIKE '%$search%'
    OR destination LIKE '%$search%'

    ORDER BY id DESC");

} else {

    $shipments = mysqli_query($conn,
    "SELECT * FROM shipments ORDER BY id DESC");
}

            while($row = mysqli_fetch_assoc($shipments)){

            ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['customer_name']; ?></td>

                    <td><?php echo $row['pickup_location']; ?></td>

                    <td><?php echo $row['destination']; ?></td>

                    <td><?php echo $row['shipment_date']; ?></td>

                    <td><?php echo $row['tracking_number']; ?></td>
                    <td><?php echo $row['driver_name']; ?></td>
<td><?php echo $row['vehicle_number']; ?></td>

                 <td>

<?php

if($row['status'] == "Pending"){

    echo "<span class='badge bg-warning'>
            Pending
          </span>";

}
elseif($row['status'] == "Assigned"){

    echo "<span class='badge bg-info'>
            Assigned
          </span>";

}
elseif($row['status'] == "In Transit"){

    echo "<span class='badge bg-primary'>
            In Transit
          </span>";

}

elseif($row['status'] == "Delivered"){

    echo "<span class='badge bg-success'>
            Delivered
          </span>";

}
elseif($row['status'] == "Cancelled"){

    echo "<span class='badge bg-danger'>
            Cancelled
          </span>";

}
?>

</td>4

                    <td>

                        <a href="edit_shipment.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-primary">
                           Edit
                        </a>

                        <a href="delete_shipment.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete Shipment?')">
                           Delete
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>