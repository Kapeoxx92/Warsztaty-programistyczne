<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Sprawdź swoją narodowość</h2>

<form method="post">
    <label>Podaj kraj:</label>
    <input type="text" name="kraj">
    <input type="submit" value="Sprawdź">
</form>

<?php

function sprawdzNarodowosc($kraj) {
    $narodowosci = [
        "polska" => "Polak",
        "niemcy" => "Niemiec",
        "francja" => "Francuz",
        "wlochy" => "Włoch",
        "hiszpania" => "Hiszpan",
        "usa" => "Amerykanin",
        "japonia" => "Japończyk"
    ];

    $kraj = strtolower($kraj);

    if (isset($narodowosci[$kraj])) {
        return $narodowosci[$kraj];
    } else {
        return "Nie znam takiej narodowości";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kraj = $_POST["kraj"];
    $wynik = sprawdzNarodowosc($kraj);

    echo "<p>Twoja narodowość: $wynik</p>";
}

?>

</body>
</html>