<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../config/database.php');

$customer_name = $_SESSION['customer_name'];

$shipment_query = mysqli_query(
    $conn,
    "SELECT * FROM shipments
     WHERE customer_name = '$customer_name'
     ORDER BY id DESC
     LIMIT 1"
);

$shipment = mysqli_fetch_assoc($shipment_query);

$driver_phone = "Not Available";

if($shipment){

    $driver_name = $shipment['driver_name'];

    $driver_query = mysqli_query(
        $conn,
        "SELECT * FROM drivers
         WHERE driver_name='$driver_name'
         LIMIT 1"
    );

    $driver = mysqli_fetch_assoc($driver_query);

    if($driver){
        $driver_phone = $driver['phone'];
    }
}
?>


<!DOCTYPE html>
<html>

<head>

<title>Customer Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{
    background:#d1d5db;
}

.top-bar{

    background:#0f172a;

    color:white;

    padding:20px;

    text-align:center;

    font-size:30px;

    font-weight:bold;

}

.dashboard-box{

    background:white;
    border-radius:25px;
    padding:30px;
    position:relative;
    overflow:hidden;

    animation:slideUp 1s ease-out;
    

}
@keyframes slideUp{

    from{
        opacity:0;
        transform:translateY(100px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}
.dashboard-box::before{

    content:'';

    position:absolute;

    top:-3px;
    left:-3px;
    right:-3px;
    bottom:-3px;

    border-radius:25px;

    background:linear-gradient(
        90deg,
        red,
        orange,
        yellow,
        lime,
        cyan,
        blue,
        violet,
        red
    );

    background-size:400% 400%;

    z-index:-1;

    animation:snakeGlow 5s linear infinite;

}
@keyframes snakeGlow{

    0%{
        background-position:0% 50%;
    }

    100%{
        background-position:400% 50%;
    }

}

.track-box{

    background:#38bdf8;

    color:white;

    padding:20px;

    border-radius:15px;

    margin-top:20px;

}


</style>

</head>

<body>

<div class="top-bar">

    CUSTOMER DASHBOARD

</div>

<div class="dashboard-box">

    <h2>

        Welcome,
<?php echo $_SESSION['customer_name']; ?>

    </h2>

    <div class="track-box">
<?php if($shipment){ ?>

<p>
    Tracking Number:
    <?php echo $shipment['tracking_number']; ?>
</p>

<p>
    Status:
    <?php echo $shipment['status']; ?>
</p>

<p>
    Destination:
    <?php echo $shipment['destination']; ?>
</p>

<p>
    Driver:
    <?php echo $shipment['driver_name']; ?>
</p>

<p>
    Driver Phone:
    <?php echo $driver_phone; ?>
</p>

<?php } else { ?>

<p>No shipment assigned yet.</p>

<?php } ?>

    </div>

</div>

</body>

</html>