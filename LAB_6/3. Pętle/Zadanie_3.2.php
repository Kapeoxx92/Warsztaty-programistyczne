<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h2>Symulator rzutów kostką</h2>

<form method="post">
    <label>Podaj liczbę rzutów:</label>
    <input type="number" name="liczba" min="1">
    <input type="submit" value="Rzuć">
</form>

<?php
function rzutyKostka($liczbaRzutow) {
    $wyniki = [];

    for ($i = 0; $i < $liczbaRzutow; $i++) {
        $wyniki[] = rand(1, 6);
    }

    return $wyniki;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba = $_POST["liczba"];

    if ($liczba > 0) {
        $wyniki = rzutyKostka($liczba);

        echo "<p>Wyniki rzutów: " . implode(", ", $wyniki) . "</p>";
    } else {
        echo "<p>Podaj poprawną liczbę!</p>";
    }
}

?>

</body>
</html>