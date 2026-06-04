<?php
include('config/database.php');

$shipment = null;

if(isset($_POST['track'])){

    $tracking_number = mysqli_real_escape_string($conn, $_POST['tracking_number']);

    $query = "SELECT * FROM shipments
              WHERE tracking_number='$tracking_number'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $shipment = mysqli_fetch_assoc($result);

    } else {

        echo "<script>alert('Tracking Number Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Shipment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

               body{
    background:#d1d5db;
}


        .track-box{
            width:600px;
            margin:60px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

    </style>

</head>
<body>

<div class="container">

    <div class="track-box">

        <h2 class="mb-4 text-center">
            Shipment Tracking
        </h2>

        <form method="POST">

            <div class="mb-3">
                <label>Tracking Number</label>
                <input type="text"
                       name="tracking_number"
                       class="form-control"
                       required>
            </div>

            <button type="submit"
                    name="track"
                    class="btn btn-dark w-100">
                Track Shipment
            </button>

        </form>

        <?php if($shipment){ ?>

        <div class="alert alert-success mt-4">

            <h5>Shipment Details</h5>

            <p>
                <strong>Customer:</strong>
                <?php echo $shipment['customer_name']; ?>
            </p>

            <p>
                <strong>Pickup:</strong>
                <?php echo $shipment['pickup_location']; ?>
            </p>

            <p>
                <strong>Destination:</strong>
                <?php echo $shipment['destination']; ?>
            </p>

            <p>
                <strong>Status:</strong>

                <?php

                $status = $shipment['status'];

                if($status == "Pending"){

                    echo "
                    <div class='progress mt-2'>

                        <div class='progress-bar bg-warning'
                             style='width:33%'>

                             Pending

                        </div>

                    </div>";
                }
elseif($status == "Assigned"){

    echo "
    <div class='progress mt-2'>

        <div class='progress-bar bg-info'
             style='width:50%'>

             Assigned

        </div>

    </div>";
}
                elseif($status == "In Transit"){

                    echo "
                    <div class='progress mt-2'>

                        <div class='progress-bar bg-primary'
                             style='width:66%'>

                             In Transit

                        </div>

                    </div>";
                }

                elseif($status == "Delivered"){

                    echo "
                    <div class='progress mt-2'>

                        <div class='progress-bar bg-success'
                             style='width:100%'>

                             Delivered

                        </div>

                    </div>";
                }
elseif($status == "Cancelled"){

    echo "
    <div class='progress mt-2'>

        <div class='progress-bar bg-danger'
             style='width:100%'>

             Cancelled

        </div>

    </div>";
}
                ?>

            </p>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>