<?php


session_start();

?>
<?php

include('config/database.php');$total_shipments = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM shipments")
);

$total_vehicles = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM vehicles")
);

$total_drivers = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM drivers")
);


if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$shipment_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM shipments"));

$vehicle_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM vehicles"));

$driver_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM drivers"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
   .stats-box{

    background:white;

    margin-top:20px;

    margin-left:310px;

    width:750px;

    padding:25px;

    border-radius:20px;

    border:2px solid #facc15;

    box-shadow:
        0 0 10px #facc15,
        0 0 20px rgba(250,204,21,0.5);

    animation:slideInLeft 1s ease;

    transition:0.3s ease;

}
.stats-box:hover{

    box-shadow:
        0 0 15px #facc15,
        0 0 30px #facc15,
        0 0 45px rgba(250,204,21,0.7);

    transform:translateY(-5px);

}
@keyframes slideInLeft{

    from{

        opacity:0;

        transform:translateX(-60px);

    }

    to{

        opacity:1;

        transform:translateX(0);

    }

}

}

.stats-box h3{

    color:#38bdf8;

    margin-bottom:20px;

}

.graph-item{

    margin-bottom:20px;

}

.bar{

    height:25px;

    border-radius:20px;

    animation:growBar 2s ease;

}

.shipments{

    width:90%;

    background:linear-gradient(90deg,#38bdf8,#2563eb);

}

.vehicles{

    width:65%;

    background:linear-gradient(90deg,#22c55e,#16a34a);

}

.drivers{

    width:80%;

    background:linear-gradient(90deg,#facc15,#eab308);

}

@keyframes growBar{

    from{

        width:0;

    }

}

  .clock-box{

    background:white;

    width:250px;

    padding:20px;

    border-radius:20px;

    margin-left:310px;

    margin-bottom:20px;

    color:#38bdf8;

    font-size:28px;

    font-weight:bold;

    text-align:center;

    border:2px solid #38bdf8;

    box-shadow:
        0 0 10px #38bdf8,
        0 0 20px rgba(56,189,248,0.5);

    animation:slideClock 1s ease;

    transition:0.3s ease;

}
.clock-box:hover{

    transform:translateY(-5px);

    box-shadow:
        0 0 15px #38bdf8,
        0 0 30px #38bdf8;

}
@keyframes slideClock{

    from{

        opacity:0;

        transform:translateX(-80px);

    }

    to{

        opacity:1;

        transform:translateX(0);

    }

}

}
}.progress{

    height:18px;

    border-radius:20px;

    overflow:hidden;

    background:#dbeafe;

}

.progress-bar{

    height:100%;

    background:linear-gradient(90deg,#2563eb,#38bdf8);

    animation:loadBar 2s ease;

}@keyframes loadBar{

    from{

        width:0;

    }

}
.cards-container{

    display:flex;

    gap:15px;

    flex-wrap:wrap;

    align-items:flex-start;

}

.card-box{

    width:220px;

    min-height:140px;

    background:white;

    padding:20px;

    border-radius:20px;

    margin:10px;

    text-align:center;

    box-shadow:0 5px 15px rgba(0,0,0,0.1);

    transition:0.3s ease;

    border:2px solid #38bdf8;

}

}
.cards-container{

    display:flex;

    gap:30px;

    flex-wrap:wrap;

    align-items:flex-start;

}
        .top-header{

    background:linear-gradient(
    90deg,
    #0f172a,
    #1e3a8a);

    padding:205px;

    border-radius:20px;

    margin-bottom:30px;
    margin-left:280px;

    box-shadow:
    0 0 20px rgba(30,58,138,0.4);
    text-shadow:

}
  .top-logo{

    width:100%;

    text-align:center;

    font-family:'Orbitron', sans-serif;

    font-size:80px;

    font-weight:bold;

    color:#38bdf8;

    letter-spacing:6px;

    text-transform:uppercase;

    padding:110px;

    margin-bottom:30px;

    background:linear-gradient(
    90deg,
    #0f172a,
    #1e3a8a);

    border-radius:20px;

    text-shadow:
    0 0 10px rgba(56,189,248,0.7),
    0 0 20px rgba(56,189,248,0.5);

}
}
  


    position:absolute;

    top:-8px;
    right:-10px;

    background:red;

    color:white;

    border-radius:50%;

    width:22px;
    height:22px;

    font-size:12px;

    display:flex;

    align-items:center;

    justify-content:center;

}

@keyframes ring{

    0%{
        transform:rotate(0deg);
    }

    25%{
        transform:rotate(10deg);
    }

    50%{
        transform:rotate(-10deg);
    }

    75%{
        transform:rotate(5deg);
    }

    100%{
        transform:rotate(0deg);
    }

}
body{

    background:
        linear-gradient(
            rgba(0,0,0,0.45),
            rgba(0,0,0,0.45)
        ),
        url('assets/images/truck-bg.jpg');

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;

}

}
   .sidebar{

    width:260px;
    min-height:100vh;

    background:
    linear-gradient(
    rgba(15,23,42,0.95),
    rgba(2,6,23,0.95)),



    background-size:cover;

    background-position:center;

    background-repeat:no-repeat;

    position:fixed;

    top:0;
    left:0;

    padding-top:25px;

    box-shadow:4px 0 20px rgba(0,0,0,0.4);

}
   .sidebar h2{

    color:#facc15;

    text-align:center;

    margin-bottom:40px;

    font-family:'Bebas Neue', sans-serif;

    font-size:60px;

    letter-spacing:3px;

    text-transform:uppercase;

    text-shadow:2px 2px 10px rgba(0,0,0,0.5);

}


}
.sidebar a{

    color:white;

    text-decoration:none;

    display:block;

    padding:15px 20px;

    font-size:18px;

    font-weight:bold;

    transition:0.3s ease;

}

.sidebar a:hover{

    background:#1e3a8a;

    border-radius:10px;

   color:#facc15 !important;

    padding-left:25px;

}

}
.card-box{
box-shadow:0 0 15px #facc15;

animation:slideIn 1s ease;
    width:180px;

    min-height:120px;

    background:white;

    padding:15px;

    border-radius:20px;

    text-align:center;

    border:2px solid #38bdf8;

    transition:0.3s ease;

}
.card-box:hover{

    transform:translateY(-10px);

    box-shadow:0 0 25px #facc15;

}
@keyframes slideIn{

    from{

        opacity:0;

        transform:translateY(40px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}
        @media(max-width:768px){

    .sidebar{

   

}

.sidebar h2{

    color:#facc15;
    text-align:center;
    margin-bottom:40px;
    font-weight:bold;
    letter-spacing:1px;

}



}

.sidebar{

    width:260px;

    height:100vh;

    position:fixed;

    left:0;

    top:0;

    background:#0f172a;

    overflow-y:auto;

    z-index:1000;

}

.sidebar h2{

    color:#facc15;
    text-align:center;
    margin-bottom:40px;
    font-weight:bold;

}

.sidebar a,
.sidebar a:link,
.sidebar a:visited,
.sidebar a:hover,
.sidebar a:active{

    text-decoration:none !important;

    transition:0.3s ease;

}

.sidebar a{

    color:white !important;

    display:block;

    padding:15px 20px;

    font-size:18px;

    font-weight:bold;

}

.sidebar a:hover{

    background:#1e3a8a !important;

    border-radius:10px;

    color:#facc15 !important;

    padding-left:25px;

}
    }

.main-content{

    margin-left:280px;

    padding:30px;

    width:calc(100% - 280px);

}

}.welcome-text{

    margin-left:20px;

    margin-bottom:30px;

}
}
.dark-mode{

    background:#111827 !important;
    color:white !important;

}

.dark-mode .card-box{

    background:#1f2937;
    color:white;

}

.dark-mode .main-content{

    background:#111827;
    color:white;
@keyframes floatCard{

    0%{
        transform:translateY(0px);
    }

    50%{
        transform:translateY(-10px);
    }

    100%{
        transform:translateY(0px);
    }

}
}
.cards-container{

    display:flex;

    gap:20px;

    flex-wrap:nowrap;

   margin-left:300px;

}
    </style>

}

</head>
<body id="body">

<div class="sidebar">

  <div class="text-center">





</div>

    <a href="index.php">Dashboard</a>
    <a href="shipments.php">Shipments</a>
    <a href="vehicles.php">Vehicles</a>
    <a href="drivers.php">Drivers</a>
    <a href="fuel.php">Fuel Calculator</a>
   <a href="/logout.php">Logout</a>
    <a href="report.php"
   target="_blank">

    📄 Generate Reports

</a>
<a href="tracking_map.php">

    🗺️ Live Tracking Map

</a>
</div>

<div class="main-content">
    <div class="top-logo"
     data-aos="fade-down">

    TLS SYSTEM

</div>
 
    <div class="mb-4">

    <img src="assets/images/truck-banner.jpg"
         class="img-fluid rounded shadow">

</div>
<button onclick="toggleDarkMode()"
        class="btn btn-dark mb-3">

    Toggle Dark Mode

</button>
   
<div class="clock-box">

    <h2 id="clock"></h2>

</div>
<div class="cards-container">

   <div class="card-box">

    <h3>Total Shipments</h3>

    <?php
$shipment_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM shipments"));
?>

<h1><?php echo $shipment_count; ?></h1>

</div>

    <div class="card-box">

        <h3>Total Vehicles</h3>

       <?php
$vehicle_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM vehicles"));
?>

<h1><?php echo $vehicle_count; ?></h1>

    </div>

    <div class="card-box">

        <h3>Total Drivers</h3>

        <?php
$driver_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM drivers"));
?>

<h1><?php echo $driver_count; ?></h1>

    </div>

</div>
 <div class="stats-box">

    <h3>Graphical Statistics</h3>

    <div class="graph-row">

        <div class="graph-item">
            <p>drivers</p>
            <div class="bar drivers"></div>
        </div>

        <div class="graph-item">
            <p>Vehicles</p>
            <div class="bar vehicles"></div>
        </div>

        <div class="graph-item">
            <p>Shipments</p>
            <div class="bar shipments"></div>
        </div>

    </div>

</div>

    

</div>
       <div>
          <div class="card-box"
     data-aos="fade-up">
                <img src="assets/images/truck.png"
     width="50"
     class="mb-3">
                <h4>Total Vehicles</h4>
                <h1><?php echo $vehicle_count; ?></h1>
            </div>
        </div>

       <div>
            <div class="card-box"
     data-aos="fade-up">

    <img src="assets/images/driver.png"
         width="50"
         class="mb-3">

                <h4>Total Drivers</h4>
                <h1><?php echo $driver_count; ?></h1>
            </div>
        </div>
        </div>
        <div class="row mt-4">

    <div class="col-md-8">

        <div class="card-box">

            <h4 class="mb-4">System Analytics</h4>

            <canvas id="analyticsChart"></canvas>

        </div>

    </div>

</div>

    

</div>

</div>

<script>

const ctx = document.getElementById('analyticsChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Shipments', 'Vehicles', 'Drivers'],

        datasets: [{

            label: 'System Statistics',

            data: [

                <?php echo $shipment_count; ?>,
                <?php echo $vehicle_count; ?>,
                <?php echo $driver_count; ?>

            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {
                beginAtZero: true
            }

        }

    }

});

</script>

    </div>

</div>
<script>

function toggleDarkMode(){

    document.body.classList.toggle("dark-mode");

}

</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>

AOS.init();

</script>
</div>
<script>

function updateClock(){

    let now = new Date();

    document.getElementById("clock")
    .innerHTML = now.toLocaleTimeString();

}

setInterval(updateClock,1000);

updateClock();

</script>
</body>
<script>

function updateClock(){

    let now = new Date();

    document.getElementById("clock").innerHTML =

    now.toLocaleString();

}

setInterval(updateClock, 1000);

updateClock();

</script>
</html>