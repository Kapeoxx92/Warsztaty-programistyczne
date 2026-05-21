<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $imie = trim($_POST['imie']);
    $nazwisko = trim($_POST['nazwisko']);
    $email = trim($_POST['email']);
    $haslo = trim($_POST['haslo']);

    $regex = "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{6,}$/";

    if (!preg_match($regex, $haslo)) {

        $message = "Hasło musi składać się z co najmniej 6 znaków, zawierać co najmniej 1 wielką literę, cyfrę oraz znak specjalny.";

    } else {

        $plik = "zad4.txt";

        $emailExists = false;

        if (file_exists($plik)) {

            $zad4 = file($plik);

            foreach ($users as $user) {

                $data = explode(";", trim($user));

                if ($data[2] == $email) {
                    $emailExists = true;
                    break;
                }
            }
        }

        if ($emailExists) {

            $message = "Podany email już istnieje!";

        } else {

            $line = $imie . ";" . $nazwisko . ";" . $email . ";" . $haslo . PHP_EOL;

            file_put_contents($plik, $line, FILE_APPEND);

            $message = "Rejestracja zakończona sukcesem!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="zad4.css">
</head>
<body>

<div class="container">

    <?php if ($message != ""): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <h1>Rejestracja</h1>

    <form method="POST">

        <input type="text" name="imie" placeholder="Imię" required>

        <input type="text" name="nazwisko" placeholder="Nazwisko" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="haslo" placeholder="Hasło" required>

        <button type="submit">Zarejestruj</button>

    </form>

    <p>
        Masz konto? Zaloguj się tu: 
        <a href="zad4_login.php">Zaloguj się</a>
    </p>

</div>

</body>
</html>