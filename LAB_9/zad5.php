<?php
$file = 'opinie.txt';

if (!file_exists($file)) {
    touch($file);
}

if (isset($_POST['add_opinion']) && !empty(trim($_POST['opinion']))) {
    $new_opinion = str_replace(["\r", "\n"], " ", $_POST['opinion']);
    file_put_contents($file, htmlspecialchars($new_opinion) . PHP_EOL, FILE_APPEND);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['delete_id'])) {
    $id_to_delete = $_POST['delete_id'];
    $opinions = file($file);
    if (isset($opinions[$id_to_delete])) {
        unset($opinions[$id_to_delete]);
        file_put_contents($file, implode("", $opinions));
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['reset_all'])) {
    file_put_contents($file, "");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$all_opinions = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zad5.css">
    <title>Zarządzanie Opiniami</title>
</head>
<body>

    <h1>Zarządzanie Opiniami</h1>

    <form method="POST" class="main-form">
        <textarea name="opinion" placeholder="Wpisz swoją opinię" required></textarea>
        <button type="submit" name="add_opinion" class="btn btn-blue">Dodaj opinię</button>
    </form>

    <div class="opinions-container">
        <h2>Opinie:</h2>

        <?php if (empty($all_opinions)): ?>
            <p>Brak opinii do wyświetlenia.</p>
        <?php else: ?>
            <?php foreach ($all_opinions as $id => $text): ?>
                <div class="opinion-item">
                    <div class="opinion-text"><?php echo $text; ?></div>
                    <form method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-red">Usuń</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="reset-section">
            <form method="POST">
                <button type="submit" name="reset_all" class="btn btn-blue" style="width: auto; padding: 10px 30px;">Resetuj wszystko</button>
            </form>
        </div>
    </div>

</body>
</html>