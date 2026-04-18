<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Sprawdź, czy liczba jest pierwsza</h2>

<form method="post">
    <label>Podaj liczbę:</label>
    <input type="number" name="liczba" min="0">
    <input type="submit" value="Sprawdź">
</form>

<?php

function czyPierwsza($n) {
    $iteracje = 0;

    if ($n < 2) {
        return ["wynik" => false, "iteracje" => $iteracje];
    }

    if ($n == 2) {
        return ["wynik" => true, "iteracje" => 1];
    }

    if ($n % 2 == 0) {
        return ["wynik" => false, "iteracje" => 1];
    }

    for ($i = 3; $i <= sqrt($n); $i += 2) {
        $iteracje++;

        if ($n % $i == 0) {
            return ["wynik" => false, "iteracje" => $iteracje];
        }
    }

    return ["wynik" => true, "iteracje" => $iteracje];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba = $_POST["liczba"];
    $wynik = czyPierwsza($liczba);

    if ($wynik["wynik"]) {
        echo "<p>$liczba jest liczbą pierwszą</p>";
    } else {
        echo "<p>$liczba nie jest liczbą pierwszą</p>";
    }

    echo "<p>Liczba iteracji: " . $wynik["iteracje"] . "</p>";
}

?>

</body>
</html>