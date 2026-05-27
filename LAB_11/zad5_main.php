<?php

session_start();

require_once "Car.php";
require_once "NewCar.php";
require_once "InsuranceCar.php";

if (!isset($_SESSION['cars'])) {
    $_SESSION['cars'] = [];
}

if (isset($_POST['add'])) {

    $type = $_POST['type'];
    $model = $_POST['model'];
    $price = $_POST['price'];

    if ($type == "Car") {

        $car = new Car($model, $price);
    }

    elseif ($type == "NewCar") {

        $car = new NewCar(
            $model,
            $price,
            isset($_POST['alarm']),
            isset($_POST['radio']),
            isset($_POST['climatronic'])
        );
    }

    else {

        $car = new InsuranceCar(
            $model,
            $price,
            isset($_POST['alarm']),
            isset($_POST['radio']),
            isset($_POST['climatronic']),
            isset($_POST['firstOwner']),
            $_POST['years']
        );
    }

    $_SESSION['cars'][] = $car;
}

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    unset($_SESSION['cars'][$id]);

    $_SESSION['cars'] = array_values($_SESSION['cars']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Car Inventory</title>
    <link rel="stylesheet" href="zad5.css">
</head>

<body>

<div class="container">

    <h1>Car Inventory</h1>

    <p>Total cars: <?= count($_SESSION['cars']) ?></p>

    <form method="post">

        <label>Select car type:</label>

        <select name="type" id="typeSelect" onchange="changeForm()">

            <option value="Car">Car</option>
            <option value="NewCar">NewCar</option>
            <option value="InsuranceCar">InsuranceCar</option>

        </select>

        <h2>Add Car</h2>

        <label>Model:</label>
        <input type="text" name="model" required>

        <label>Price (EURO):</label>
        <input type="number" name="price" required>

        <div id="newCarFields" style="display:none;">

            <label>
                <input type="checkbox" name="alarm">
                Alarm
            </label>

            <label>
                <input type="checkbox" name="radio">
                Radio
            </label>

            <label>
                <input type="checkbox" name="climatronic">
                Climatronic
            </label>

        </div>

        <div id="insuranceFields" style="display:none;">

            <label>
                <input type="checkbox" name="firstOwner">
                First owner
            </label>

            <label>Years:</label>
            <input type="number" name="years">

        </div>

        <button type="submit" name="add">Add Car</button>

    </form>

    <h2>Car List</h2>

    <?php if (count($_SESSION['cars']) == 0): ?>

        <p>No cars added.</p>

    <?php endif; ?>

    <?php foreach ($_SESSION['cars'] as $index => $car): ?>

        <div class="card">

            <h3><?= $car->getType() ?></h3>

            <p><b>Model:</b> <?= $car->getModel() ?></p>

            <p><b>Price EUR:</b> <?= $car->getPriceEuro() ?></p>

            <a href="details.php?id=<?= $index ?>" class="btn">
                Details
            </a>

            <a href="edit.php?id=<?= $index ?>" class="btn">
                Edit
            </a>

            <a href="?delete=<?= $index ?>" class="btn delete">
                Delete
            </a>

        </div>

    <?php endforeach; ?>

</div>

<script>

function changeForm() {

    const type = document.getElementById("typeSelect").value;

    document.getElementById("newCarFields").style.display = "none";
    document.getElementById("insuranceFields").style.display = "none";

    if (type === "NewCar") {

        document.getElementById("newCarFields").style.display = "block";
    }

    if (type === "InsuranceCar") {

        document.getElementById("newCarFields").style.display = "block";
        document.getElementById("insuranceFields").style.display = "block";
    }
}

changeForm();

</script>

</body>
</html>