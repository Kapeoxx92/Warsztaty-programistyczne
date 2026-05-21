<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $haslo = trim($_POST['haslo']);

    $plik = "zad4.txt";

    if (file_exists($plik)) {

        $users = file($plik);

        foreach ($users as $user) {

            $data = explode(";", trim($user));

            if ($data[2] == $email && $data[3] == $haslo) {

                $_SESSION['user'] = $data[0];

                header("Location: zad4_login.php");
                exit();
            }
        }
    }

    $message = "Niepoprawny email lub hasło!";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="zad4.css">
</head>
<body>

<div class="container">

    <?php if (isset($_SESSION['user'])): ?>

        <h1>Witaj <?php echo $_SESSION['zad4']; ?>!</h1>

        <a class="logout" href="zad4_logout.php">Wyloguj</a>

    <?php else: ?>

        <?php if ($message != ""): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <h1>Logowanie</h1>

        <form method="POST">

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="haslo" placeholder="Hasło" required>

            <button type="submit">Zaloguj</button>

        </form>

        <p>
            Nie masz konta? Kliknij tu: 
            <a href="zad4_register.php">Zarejestruj się</a>
        </p>

    <?php endif; ?>

</div>

</body>
</html>