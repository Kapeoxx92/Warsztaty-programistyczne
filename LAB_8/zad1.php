<?php
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["userText"] ?? "";
    $operation = $_POST["operation"] ?? "";

    if (empty($text)) {
        $error = "Pole tekstowe nie może być puste!";
    } else {
        switch ($operation) {
            case "1":
                $result = strrev($text);
                break;
            case "2":
                $result = strtoupper($text);
                break;
            case "3":
                $result = strtolower($text);
                break;
            case "4":
                $result = strlen($text);
                break;
            case "5":
                $result = trim($text);
                break;
            default:
                $error = "Nie wybrano poprawnej operacji.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Operacje na ciągach</title>
    <link rel="stylesheet" href="zad1.css?v=1">
</head>
<body>

<div class="box">
    <form method="post">
        <label>Wpisz tekst:</label>
        <input type="text" name="userText" value="<?= htmlspecialchars($text ?? '') ?>">

        <label>Wybierz operację:</label>
        <select name="operation">
            <option value="1">Odwróć ciąg znaków</option>
            <option value="2">Zamień na wielkie litery</option>
            <option value="3">Zamień na małe litery</option>
            <option value="4">Policz znaki</option>
            <option value="5">Usuń białe znaki</option>
        </select>

        <button type="submit">Wykonaj</button>
    </form>
</div>

<?php if ($result !== ""): ?>
    <div class="result">Wynik: <?= htmlspecialchars($result) ?></div>
<?php elseif ($error !== ""): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

</body>
</html>