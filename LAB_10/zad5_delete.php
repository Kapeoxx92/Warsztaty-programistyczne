<?php
if (!isset($_GET['name'])) {
    die("Nie wybrano ciasteczka do usunięcia.");
}

$cookie_name = $_GET['name'];

if (isset($_POST['potwierdz_usun'])) {
    setcookie($cookie_name, "", time() - 3600, "/");
    header("Location: zad5.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="zad5_delete.css">
    <title>Potwierdzenie usunięcia</title>
</head>
<body>

<div class="container">
    <h1>Potwierdzenie usunięcia</h1>
    <p>Czy na pewno chcesz bezpowrotnie usunąć ciasteczko o nazwie: <br><strong><?php echo htmlspecialchars($cookie_name); ?></strong>?</p>
    
    <form method="post">
        <a href="zad5.php" class="btn-cancel">Anuluj</a>
        <button type="submit" name="potwierdz_usun">Tak, usuń</button>
    </form>
</div>

</body>
</html>