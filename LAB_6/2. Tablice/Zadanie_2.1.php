<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Losowa wartość z tablicy</h2>

<form method="post">
    <label>Podaj indeks (0–9):</label>
    <input type="number" name="indeks" min="0" max="9">
    <input type="submit" value="Sprawdź">
</form>

<?php

function losowaWartosc($indeks) {
    $tablica = [];

    for ($i = 0; $i < 10; $i++) {
        $tablica[] = rand(1, 100);
    }

    // (opcjonalnie) pokazanie tablicy
    echo "<p>Tablica: " . implode(", ", $tablica) . "</p>";

    if (isset($tablica[$indeks])) {
        return $tablica[$indeks];
    } else {
        return "Niepoprawny indeks";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $indeks = $_POST["indeks"];
    $wynik = losowaWartosc($indeks);

    echo "<p>Wynik: $wynik</p>";
}

?>

</body>
</html>