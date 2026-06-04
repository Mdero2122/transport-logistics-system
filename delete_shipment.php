<?php

include('config/database.php');

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM shipments WHERE id='$id'");

header("Location: shipments.php?deleted=1");

?>