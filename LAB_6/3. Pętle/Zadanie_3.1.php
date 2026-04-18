<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Znajdź maksymalną wartość (różne pętle)</h2>

<form method="post">
    <input type="submit" value="Losuj i oblicz">
</form>

<?php

function maxFor() {
    $tab = [];
    for ($i = 0; $i < 10; $i++) {
        $tab[$i] = rand(1, 100);
    }

    echo "<p>FOR tablica: " . implode(", ", $tab) . "</p>";

    $max = $tab[0];
    for ($i = 1; $i < count($tab); $i++) {
        if ($tab[$i] > $max) {
            $max = $tab[$i];
        }
    }
    return $max;
}

function maxWhile() {
    $tab = [];
    $i = 0;

    while ($i < 10) {
        $tab[$i] = rand(1, 100);
        $i++;
    }

    echo "<p>WHILE tablica: " . implode(", ", $tab) . "</p>";

    $max = $tab[0];
    $i = 1;

    while ($i < count($tab)) {
        if ($tab[$i] > $max) {
            $max = $tab[$i];
        }
        $i++;
    }
    return $max;
}

function maxDoWhile() {
    $tab = [];
    $i = 0;

    do {
        $tab[$i] = rand(1, 100);
        $i++;
    } while ($i < 10);

    echo "<p>DO WHILE tablica: " . implode(", ", $tab) . "</p>";

    $max = $tab[0];
    $i = 1;

    do {
        if ($tab[$i] > $max) {
            $max = $tab[$i];
        }
        $i++;
    } while ($i < count($tab));

    return $max;
}

function maxForeach() {
    $tab = [];

    for ($i = 0; $i < 10; $i++) {
        $tab[] = rand(1, 100);
    }

    echo "<p>FOREACH tablica: " . implode(", ", $tab) . "</p>";

    $max = $tab[0];

    foreach ($tab as $liczba) {
        if ($liczba > $max) {
            $max = $liczba;
        }
    }

    return $max;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h3>Wyniki:</h3>";

    echo "<p>FOR max: " . maxFor() . "</p>";
    echo "<p>WHILE max: " . maxWhile() . "</p>";
    echo "<p>DO WHILE max: " . maxDoWhile() . "</p>";
    echo "<p>FOREACH max: " . maxForeach() . "</p>";
}

?>

</body>
</html>