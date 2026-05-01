<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zad1.css">
    <title>Document</title>
</head>

<body>
    <form action="zad1.php" method="post">
        <div class="container">
            <label for="text" class="text">Wpisz tekst:</label>
            <br>
            <input type="text" name="userText" id="userText">
        </div>
        <div class="container">
            <label for="text" class="text">Wybierz operację:</label>
            <br>
            <select>
                <option value="1">Odwrócenie ciągu znaków</option>
                <option value="2">Zamiana wszystkich liter na wielkie</option>
                <option value="3">Zamiana wszystkich liter na małe</option>
                <option value="4">Liczenie liczby znaków</option>
                <option value="5">Usuwanie białych znaków z początku i końca ciągu</option>
            </select>
        </div>
        <input type="submit" value="Wykonaj">
    </form>
</body>

</html>