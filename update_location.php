<?php

include('config/database.php');

$vehicle = "KDA 345T";

$latitude = -1.286389 + (rand(-100,100) / 1000);

$longitude = 36.817223 + (rand(-100,100) / 1000);

mysqli_query($conn,

"UPDATE truck_locations SET

latitude='$latitude',
longitude='$longitude'

WHERE vehicle_number='$vehicle'");

echo "Truck location updated";

?>