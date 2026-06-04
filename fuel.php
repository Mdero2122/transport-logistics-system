<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$fuel_used = "";
$total_cost = "";

if(isset($_POST['calculate'])){

    $distance = $_POST['distance'];
    $efficiency = $_POST['efficiency'];
    $fuel_price = $_POST['fuel_price'];

    $fuel_used = $distance / $efficiency;

    $total_cost = $fuel_used * $fuel_price;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuel Calculator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .fuel-box{

    background:white;

    padding:25px;

    border-radius:20px;

    border:2px solid #facc15;

    box-shadow:
        0 0 15px #facc15,
        0 0 30px rgba(250,204,21,0.5);

    animation:glowFuel 2s infinite alternate;

}

@keyframes glowFuel{

    from{

        box-shadow:
            0 0 15px #facc15,
            0 0 30px rgba(250,204,21,0.4);

    }

    to{

        box-shadow:
            0 0 25px #facc15,
            0 0 50px rgba(250,204,21,0.8);

    }

}

              body{
    background:#d1d5db;
}

        .container-box{
            width:500px;
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
    <div class="fuel-box">

    <div class="container-box">

        <h2 class="text-center mb-4">
            Fuel Calculator
        </h2>

        <form method="POST">

            <div class="mb-3">
                <label>Distance (KM)</label>
                <input type="number" step="0.01" name="distance" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Fuel Efficiency (KM/L)</label>
                <input type="number" step="0.01" name="efficiency" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Fuel Price Per Liter</label>
                <input type="number" step="0.01" name="fuel_price" class="form-control" required>
            </div>

            <button type="submit" name="calculate" class="btn btn-dark w-100">
                Calculate
            </button>

        </form>
        </div>

        <?php if($fuel_used != ""){ ?>

            <div class="alert alert-success mt-4">

                <h5>Results</h5>

                <p>
                    Fuel Used:
                    <strong>
                        <?php echo round($fuel_used,2); ?> Liters
                    </strong>
                </p>

                <p>
                    Total Fuel Cost:
                    <strong>
                        Ksh <?php echo round($total_cost,2); ?>
                    </strong>
                </p>

            </div>

        <?php } ?>

    </div>

</div>


</body>
</html>