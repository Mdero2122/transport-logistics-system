<?php

$conn = mysqli_connect(
    "sql310.infinityfree.com",
    "if0_42106029",
    "2122taliban",
    "if0_42106029_transport_logistics"
);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>