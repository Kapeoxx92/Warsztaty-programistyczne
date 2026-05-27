<?php

session_start();

$id = $_GET['id'];

$car = $_SESSION['cars'][$id];

if (isset($_POST['save'])) {

    $car->setModel($_POST['model']);
    $car->setPriceEuro($_POST['price']);

    $_SESSION['cars'][$id] = $car;

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit</title>
    <link rel="stylesheet" href="zad5.css">
</head>

<body>

<div class="container">

    <h1>Edit Car</h1>

    <form method="post">

        <label>Model:</label>

        <input
            type="text"
            name="model"
            value="<?= $car->getModel() ?>"
        >

        <label>Price:</label>

        <input
            type="number"
            name="price"
            value="<?= $car->getPriceEuro() ?>"
        >

        <button name="save">
            Save
        </button>

    </form>

</div>

</body>
</html>