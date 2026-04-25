<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="Zadanie_1.1.php" method="post">
        <label for="number">Wprowadź dwie liczby i wybierz znak</label>
        <br>
        <input type="number" name="number1" id="number1">
        <select name="char" id="char">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="number" name="number2" id="number2">
        <br>
        <input type="submit" value="Oblicz">
    </form>
</body>

</html>
<?php
$num1 = $_POST['number1'];
$num2 = $_POST['number2'];
$char = $_POST['char'];

if ($char == '+') {
    echo $num1 + $num2;
}
if ($char == '-') {
    echo $num1 - $num2;
}
if ($char == '*') {
    echo $num1 * $num2;
}
if ($char == '/') {
    echo $num1 / $num2;
}
?>