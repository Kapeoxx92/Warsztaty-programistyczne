<?php
$wynik = "";
$blad = "";

// Pobieranie danych z URL
$a = $_GET["a"] ?? "";
$b = $_GET["b"] ?? "";
$dzialanie = $_GET["dzialanie"] ?? "";

// Sprawdzamy tylko jeśli coś zostało wysłane
if (isset($_GET["a"]) || isset($_GET["b"]) || isset($_GET["dzialanie"])) {

    if ($a === "" || $b === "" || $dzialanie === "") {
        $blad = "Wszystkie pola muszą być wypełnione!";
    } elseif (!is_numeric($a) || !is_numeric($b)) {
        $blad = "a i b muszą być liczbami!";
    } else {
        switch ($dzialanie) {
            case "dodawanie":
                $wynik = $a + $b;
                break;

            case "odejmowanie":
                $wynik = $a - $b;
                break;

            case "mnozenie":
                $wynik = $a * $b;
                break;

            case "dzielenie":
                if ($b == 0) {
                    $blad = "Nie można dzielić przez 0!";
                } else {
                    $wynik = $a / $b;
                }
                break;

            default:
                $blad = "Nieznane działanie!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator GET</title>
</head>
<body>

<h2>Kalkulator (GET)</h2>

<form method="GET">
    a: <input type="number" name="a" value="<?= $a ?>"><br><br>

    b: <input type="number" name="b" value="<?= $b ?>"><br><br>

    Działanie:
    <select name="dzialanie">
        <option value="">-- wybierz --</option>
        <option value="dodawanie" <?= $dzialanie=="dodawanie"?"selected":"" ?>>+</option>
        <option value="odejmowanie" <?= $dzialanie=="odejmowanie"?"selected":"" ?>>-</option>
        <option value="mnozenie" <?= $dzialanie=="mnozenie"?"selected":"" ?>>*</option>
        <option value="dzielenie" <?= $dzialanie=="dzielenie"?"selected":"" ?>>/</option>
    </select><br><br>

    <button type="submit">Oblicz</button>
</form>

<p style="color:red;"><?= $blad ?></p>

<?php if ($wynik !== "" && !$blad): ?>
    <p style="color:green;">Wynik: <?= $wynik ?></p>
<?php endif; ?>

</body>
</html>