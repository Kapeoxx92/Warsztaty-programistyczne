<?php

session_start();

$id = $_GET['id'];

$car = $_SESSION['cars'][$id];

$pricePLN = null;

if (isset($_POST['calculate'])) {

    $rate = $_POST['rate'];

    $pricePLN = $car->calculatePrice($rate);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Details</title>
    <link rel="stylesheet" href="zad5.css">
</head>

<body>

<div class="container">

    <h1>Car Details</h1>

    <p><b>Type:</b> <?= $car->getType() ?></p>

    <p><b>Model:</b> <?= $car->getModel() ?></p>

    <p><b>Price EURO:</b> <?= $car->getPriceEuro() ?></p>

    <form method="post">

        <label>Exchange rate PLN:</label>

        <input type="number" step="0.01" name="rate" required>

        <button name="calculate">
            Calculate PLN
        </button>

    </form>

    <?php if ($pricePLN !== null): ?>

        <h2>Price PLN: <?= $pricePLN ?></h2>

    <?php endif; ?>

    <a href="index.php" class="btn">
        Back
    </a>

</div>

</body>
</html>