<?php
session_start();

include('config/database.php');

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$locations = mysqli_query($conn,
"SELECT * FROM truck_locations");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Tracking Map</title>

    <link rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <script
    src="https://unpkg.com/leaflet/dist/leaflet.js">
    </script>

    <style>

        body{
            margin:0;
            padding:0;
        }

        #map{
            height:100vh;
            width:100%;
        }

    </style>

</head>
<body>

<div id="map"></div>

<script>

var map = L.map('map').setView([-1.286389, 36.817223], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

    attribution: '&copy; OpenStreetMap contributors'

}).addTo(map);

<?php while($row = mysqli_fetch_assoc($locations)){ ?>

L.marker([
    <?php echo $row['latitude']; ?>,
    <?php echo $row['longitude']; ?>
])

.addTo(map)

.bindPopup(

    "<b>Vehicle:</b> <?php echo $row['vehicle_number']; ?>"

);

<?php } ?>

</script>
<script>

setInterval(function(){

    location.reload();

}, 5000);

</script>

</body>
</html>