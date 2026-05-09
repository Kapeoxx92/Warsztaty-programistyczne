<?php
$file = 'licznik.txt';

if (!file_exists($file)) {
    file_put_contents($file, '0');
}

if (isset($_POST['reset'])) {
    $count = 0;
    file_put_contents($file, $count);
} else {
    $count = (int)file_get_contents($file);
    $count++;
    file_put_contents($file, $count);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zad2.css">
    <title>Licznik odwiedzin</title>
</head>
<body>

    <h1>Licznik odwiedzin witryny</h1>

    <div class="counter-box">
        Odwiedzin: <strong><?php echo $count; ?></strong>
    </div>

    <form method="post">
        <button type="submit" name="reset" class="reset-btn">Resetuj licznik</button>
    </form>

</body>
</html>