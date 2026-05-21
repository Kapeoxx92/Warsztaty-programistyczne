<?php
$maxVisits = 8;

if (isset($_POST['reset'])) {
    setcookie("visits", 0, time() - 3600);
    header("Location: zad1.php");
    exit();
}

if (isset($_COOKIE['visits'])) {
    $visits = $_COOKIE['visits'] + 1;
} else {
    $visits = 1;
}

setcookie("visits", $visits, time() + (86400 * 30));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licznik odwiedzin</title>
    <link rel="stylesheet" href="zad1.css">
</head>
<body>

<div class="container">
    <h1>Liczba odwiedzin: <?php echo $visits; ?></h1>

    <?php if ($visits >= $maxVisits): ?>
        <p class="message">
            Osiągnięto maksymalną liczbę odwiedzin: <?php echo $maxVisits; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <button type="submit" name="reset">Resetuj licznik</button>
    </form>
</div>

</body>
</html>