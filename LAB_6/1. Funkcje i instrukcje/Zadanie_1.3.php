<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Kalkulator pól powierzchni</h2>

<form method="post">
    <label>Wybierz figurę:</label>
    <select name="figura">
        <option value="trojkat">Trójkąt</option>
        <option value="prostokat">Prostokąt</option>
        <option value="trapez">Trapez</option>
    </select>
    <br><br>

    <label>a:</label>
    <input type="number" step="any" name="a"><br>

    <label>b:</label>
    <input type="number" step="any" name="b"><br>

    <label>h:</label>
    <input type="number" step="any" name="h"><br><br>

    <input type="submit" value="Oblicz">
</form>

<?php

// funkcje
function poleTrojkata($a, $h) {
    return ($a * $h) / 2;
}

function poleProstokata($a, $b) {
    return $a * $b;
}

function poleTrapezu($a, $b, $h) {
    return (($a + $b) * $h) / 2;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $figura = $_POST["figura"];
    $a = $_POST["a"];
    $b = $_POST["b"];
    $h = $_POST["h"];

    switch ($figura) {
        case "trojkat":
            $pole = poleTrojkata($a, $h);
            echo "<p>Pole trójkąta: $pole</p>";
            break;

        case "prostokat":
            $pole = poleProstokata($a, $b);
            echo "<p>Pole prostokąta: $pole</p>";
            break;

        case "trapez":
            $pole = poleTrapezu($a, $b, $h);
            echo "<p>Pole trapezu: $pole</p>";
            break;

        default:
            echo "<p>Błąd wyboru figury</p>";
    }
}

?>

</body>
</html>