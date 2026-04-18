<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
function poleKola($r) {
    return pi() * $r * $r;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $promien = $_POST["promien"];

    if ($promien > 0) {
        $pole = poleKola($promien);
        echo "<p>Pole koła wynosi: $pole</p>";
    } else {
        echo "<p>Podaj poprawny promień!</p>";
    }
}
?>

<body>
    <form action="zadanie_1.2.php" method="post">
        <label>Podaj długość promienia:</label>
        <input type="number" name="promien" step="any"><br>
        <input type="submit" value="Oblicz pole koła">
    </form>
</body>
</html>