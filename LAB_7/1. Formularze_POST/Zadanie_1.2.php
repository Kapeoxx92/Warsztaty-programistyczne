<?php
$kraje = [
    "Polska" => 200,
    "Włochy" => 350,
    "Hiszpania" => 300,
    "Grecja" => 320,
    "Niemcy" => 250
];

$blad = "";
$wynik = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_start = $_POST["data_start"] ?? "";
    $data_koniec = $_POST["data_koniec"] ?? "";
    $osoby = $_POST["osoby"] ?? "";
    $kraj = $_POST["kraj"] ?? "";

    if (!$data_start || !$data_koniec || !$osoby || !$kraj) {
        $blad = "Wszystkie pola muszą być wypełnione!";
    } elseif ($data_start >= $data_koniec) {
        $blad = "Data rozpoczęcia musi być wcześniejsza niż zakończenia!";
    } else {
        $dni = (strtotime($data_koniec) - strtotime($data_start)) / (60 * 60 * 24);
        $cena_za_dzien = $kraje[$kraj];

        $cena = $dni * $osoby * $cena_za_dzien;
        $cena = round($cena, 2);

        $wynik = "Koszt wyjazdu: $cena zł (dni: $dni, osób: $osoby, kraj: $kraj)";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Biuro podróży</title>
</head>
<body>

<h2>Formularz wyjazdu</h2>

<form method="POST">
    Data rozpoczęcia:
    <input type="date" name="data_start" value="<?= $_POST["data_start"] ?? "" ?>"><br><br>

    Data zakończenia:
    <input type="date" name="data_koniec" value="<?= $_POST["data_koniec"] ?? "" ?>"><br><br>

    Liczba osób:
    <input type="number" name="osoby" min="1" value="<?= $_POST["osoby"] ?? "" ?>"><br><br>

    Kraj:
    <select name="kraj">
        <option value="">-- wybierz kraj --</option>
        <?php foreach ($kraje as $nazwa => $cena): ?>
            <option value="<?= $nazwa ?>" 
                <?= (($_POST["kraj"] ?? "") == $nazwa) ? "selected" : "" ?>>
                <?= $nazwa ?> (<?= $cena ?> zł/dzień)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Oblicz</button>
</form>

<p><?= $blad ?></p>
<p><?= $wynik ?></p>

</body>
</html>