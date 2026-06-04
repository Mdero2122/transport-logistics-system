<?php

session_start();

if(!isset($_SESSION['driver_name'])){

    header("Location: login.php");
    exit();
}
include('../config/database.php');

$driver_name = $_SESSION['driver_name'];

$shipment_query = mysqli_query(
    $conn,
    "SELECT * FROM shipments
     WHERE driver_name = '$driver_name'
     ORDER BY id DESC
     LIMIT 1"
);

$shipment = mysqli_fetch_assoc($shipment_query);

?>
<!DOCTYPE html>
<html>

<head>

<title>Driver Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">
<style>

body{

    background:#d1d5db;

    font-family:Arial;

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
     margin-top:50px;

    position:relative;
    overflow:hidden;

    animation:slideUp 1s ease-out;

    box-shadow:
    0 0 20px rgba(255,0,0,.4),
    0 0 40px rgba(0,255,255,.4),
    0 0 60px rgba(255,255,0,.4);

}
.track-box{

    background:linear-gradient(
        135deg,
        #1565c0,
        #1e88e5,
        #42a5f5
    );

    color:white;

    padding:25px;

    border-radius:20px;

    margin-top:20px;

    box-shadow:0 0 20px rgba(30,136,229,.5);

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
@keyframes snakeGlow{

    0%{
        background-position:0% 50%;
    }

    100%{
        background-position:400% 50%;
    }

}

.status{

    background:#22c55e;

    color:white;

    padding:8px 15px;

    border-radius:20px;

    display:inline-block;

    margin-top:10px;

}

</style>

</head>

<body>

<div class="top-bar">

    DRIVER DASHBOARD

</div>

<div class="dashboard-box">

    <h2>

        Welcome,
        <?php echo $_SESSION['driver_name']; ?>

    </h2>

    <p class="mt-4">

<?php if($shipment){ ?>

<div class="track-box">

<p>
    Assigned Shipment:
    <?php echo $shipment['tracking_number']; ?>
</p>

<p>
    Customer:
    <?php echo $shipment['customer_name']; ?>
</p>

<p>
    Destination:
    <?php echo $shipment['destination']; ?>
</p>

<div class="status">
    <?php echo $shipment['status']; ?>
</div>

</div>

<?php } else { ?>

<p>No shipment assigned yet.</p>

<div class="status">
    Waiting
</div>

<?php } ?>

</div>

</body>

</html>
```
