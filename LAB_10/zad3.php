<?php
session_start();

$poprawny_login = "login";
$poprawne_haslo = "haslo";

$error = "";

if (isset($_POST['zaloguj'])) {

    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    if ($login === $poprawny_login && $haslo === $poprawne_haslo) {

        $_SESSION['zalogowany'] = true;
        $_SESSION['user'] = $login;

        setcookie("user", $login, time() + 3600);

    } else {
        $error = "Błędny login lub hasło!";
    }
}

if (isset($_GET['akcja']) && $_GET['akcja'] == 'wyloguj') {

    session_unset();
    session_destroy();

    setcookie("user", "", time() - 3600);

    header("Location: zad3.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="zad3.css">
    <title>Logowanie</title>
</head>
<body>

<div class="container">

    <?php if (isset($_SESSION['zalogowany'])): ?>

        <h2 class="success">Zalogowano poprawnie!</h2>

        <p>Witaj, <?php echo $_SESSION['user']; ?>!</p>

        <a href="zad3.php?akcja=wyloguj">Wyloguj</a>

    <?php elseif ($error): ?>

        <h2 class="error">Błąd logowania</h2>

        <p><?php echo $error; ?></p>

        <a href="zad3.php">Powrót do formularza</a>

    <?php else: ?>

        <h2>Logowanie</h2>

        <form method="post" action="zad3.php">

            <input type="text" name="login" placeholder="Login" required>

            <input type="password" name="haslo" placeholder="Hasło" required>

            <button type="submit" name="zaloguj">Zaloguj</button>

        </form>

    <?php endif; ?>

</div>

</body>
</html>