<?php
if (!isset($_GET['name']) || !isset($_COOKIE[$_GET['name']])) {
    die("Nieprawidłowe żądanie lub ciasteczko nie istnieje.");
}

$cookie_name = $_GET['name'];
$cookie_value = $_COOKIE[$cookie_name];

if (isset($_POST['zapisz'])) {
    $nowa_wartosc = $_POST['nowa_wartosc'];
    $nowa_data_str = $_POST['nowa_data'];
    
    $wygasa = 0;
    if (!empty($nowa_data_str)) {
        $wygasa = strtotime($nowa_data_str);
    }
    
    setcookie($cookie_name, $nowa_wartosc, $wygasa, "/");
    
    echo "<script>alert('Ciasteczko zostało zaktualizowane!'); window.opener.location.reload('zad5.php'); window.close();</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="zad5_edit.css">
    <title>Edytuj ciasteczko</title>
</head>
<body>

<div class="container">
    <h1>Edycja ciasteczka: <br><span style="color: #007bff;"><?php echo htmlspecialchars($cookie_name); ?></span></h1>
    <form method="post">
        <label style="text-align: left; display: block; font-size: 13px; color: #666;">Nowa wartość:</label>
        <input type="text" name="nowa_wartosc" value="<?php echo htmlspecialchars($cookie_value); ?>" required>
        
        <label style="text-align: left; display: block; font-size: 13px; color: #666; margin-top: 10px;">Nowa data wygaśnięcia (opcjonalnie):</label>
        <input type="datetime-local" name="nowa_data">
        
        <button type="submit" name="zapisz">Zapisz zmiany</button>
    </form>
    <a href="#" onclick="window.close(zad5_edit.php); return false;" class="back-link">Zamknij to okno</a>
</div>

</body>
</html>