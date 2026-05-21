<?php
if (isset($_POST['dodaj'])) {
    $nazwa = $_POST['nazwa_ciasteczka'];
    $wartosc = $_POST['wartosc_ciasteczka'];
    $wygasa_str = $_POST['data_wygasniecia'];

    $wygasa = 0;
    if (!empty($wygasa_str)) {
        $wygasa = strtotime($wygasa_str);
    }

    if (!empty($nazwa)) {
        setcookie($nazwa, $wartosc, $wygasa, "/");
        header("Location: zad5.php");
        exit();
    }
}

$szukana_fraza = isset($_POST['szukaj_fraza']) ? trim($_POST['szukaj_fraza']) : '';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="zad5.css">
    <title>Menadżer ciasteczek</title>
</head>
<body>

<div class="container">
    <h1>Menadżer ciasteczek</h1>
    
    <h2>Wyświetlanie wszystkich ciasteczek</h2>
    <ul>
        <?php
        $wyswietlono_jakiekolwiek = false;
        foreach ($_COOKIE as $key => $value) {
            if (!empty($szukana_fraza)) {
                if (strpos($key, $szukana_fraza) === false && strpos($value, $szukana_fraza) === false) {
                    continue;
                }
            }
            
            if ($key === 'PHPSESSID') continue; 

            $wyswietlono_jakiekolwiek = true;
            echo "<li>";
            echo "<strong>" . htmlspecialchars($key) . "</strong>: " . htmlspecialchars($value);
            echo " <span class='links'>";
            echo "<a href='zad5_edit.php?name=" . urlencode($key) . "'>Edytuj</a> ";
            echo "<a href='zad5_delete.php?name=" . urlencode($key) . "'>Usuń</a>";
            echo "</span>";
            echo "</li>";
        }
        
        if (!$wyswietlono_jakiekolwiek) {
            echo "<p style='color: #666; font-style: italic;'>Brak ciasteczek do wyświetlenia " . (!empty($szukana_fraza) ? "spełniających kryteria" : "") . ".</p>";
        }
        ?>
    </ul>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

    <h2>Dodanie ciasteczka</h2>
    <form method="post" action="zad5.php">
        <input type="text" name="nazwa_ciasteczka" placeholder="Nazwa ciasteczka" required>
        <input type="text" name="wartosc_ciasteczka" placeholder="Wartość ciasteczka">
        <input type="datetime-local" name="data_wygasniecia" title="Data wygaśnięcia (opcjonalnie)">
        <button type="submit" name="dodaj">Dodaj ciasteczko</button>
    </form>

    <h2>Wyszukanie ciasteczek</h2>
    <form method="post" action="zad5.php">
        <input type="text" name="szukaj_fraza" placeholder="Szukana nazwa/wartość" value="<?php echo htmlspecialchars($szukana_fraza); ?>">
        <button type="submit">Szukaj</button>
    </form>
    <?php if (!empty($szukana_fraza)): ?>
        <p><a href="zad5.php" style="font-size: 13px; color: #666;">Pokaż wszystkie (wyczyść filtr)</a></p>
    <?php endif; ?>
</div>

</body>
</html>