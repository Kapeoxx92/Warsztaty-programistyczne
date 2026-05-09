<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zad1.css">
    <title>Sprawdzanie rozmiaru plików</title>
</head>
<body>

    <h1>Wprowadź nazwę pliku lub katalogu</h1>

    <div class="container">
        <form method="POST">
            <input type="text" name="path" placeholder="np. index.php lub folder_test" required 
                   value="<?php echo isset($_POST['path']) ? htmlspecialchars($_POST['path']) : ''; ?>">
            <button type="submit">Wyślij</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['path'])) {
        $path = $_POST['path'];
        function getDirectorySize($dir) {
            $size = 0;
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)) as $file) {
                $size += $file->getSize();
            }
            return $size;
        }

        echo '<div class="results">';
        
        if (file_exists($path)) {
            $totalSize = is_dir($path) ? getDirectorySize($path) : filesize($path);

            // Obliczenia
            $kb = $totalSize / 1024;
            $mb = $kb / 1024;
            $gb = $mb / 1024;

            echo "<h2>Wyniki:</h2>";
            echo "Rozmiar: $totalSize bajtów<br>";
            echo "Rozmiar: $kb kilobajtów<br>";
            echo "Rozmiar: $mb megabajtów<br>";
            echo "Rozmiar: $gb gigabajtów<br>";
        } else {
            echo "<p class='error'>Błąd: Podany plik lub katalog nie istnieje.</p>";
        }
        
        echo '</div>';
    }
    ?>

</body>
</html>