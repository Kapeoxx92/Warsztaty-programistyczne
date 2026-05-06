<?php
// Logika backendowa
$result = "";
$statusClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST['inputText'] ?? '';
    $pattern = $_POST['regexPattern'] ?? '';
    $operation = $_POST['operation'] ?? '';
    $replacement = $_POST['replacementText'] ?? '';

    if (@preg_match($pattern, null) === false) {
        $result = "Błąd: Nieprawidłowa składnia wyrażenia regularnego (pamiętaj o delimiterach, np. /wzór/).";
        $statusClass = "error";
    } else {
        switch ($operation) {
            case 'match':
                preg_match_all($pattern, $inputText, $matches);
                $count = count($matches[0]);
                $result = $count > 0 
                    ? "Znaleziono <strong>$count</strong> dopasowań: " . htmlspecialchars(implode(", ", $matches[0]))
                    : "Brak dopasowań.";
                $statusClass = "success";
                break;

            case 'positions':
                preg_match_all($pattern, $inputText, $matches, PREG_OFFSET_CAPTURE);
                if (!empty($matches[0])) {
                    $lines = [];
                    foreach ($matches[0] as $m) {
                        $lines[] = "Match found at position <strong>{$m[1]}</strong>: " . htmlspecialchars($m[0]);
                    }
                    $result = implode("<br>", $lines);
                } else {
                    $result = "Brak dopasowań.";
                }
                $statusClass = "success";
                break;

            case 'replace':
                $replaced = preg_replace($pattern, $replacement, $inputText);
                $result = "Tekst po zamianie:<br><strong>" . htmlspecialchars($replaced) . "</strong>";
                $statusClass = "success";
                break;

            case 'validate':
                $isValid = preg_match($pattern, $inputText);
                $result = $isValid ? "Tekst jest <strong>zgodny</strong> ze wzorcem." : "Tekst <strong>nie jest zgodny</strong> ze wzorcem.";
                $statusClass = $isValid ? "success" : "error";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Regex Analyser & Transformer</title>
    <link rel="stylesheet" href="zad3.css">
</head>
<body>

<div class="container">
    <h2>Analyser and Transformer of Text with Regex in PHP</h2>
    
    <form method="post">
        <div class="form-group">
            <label for="inputText">Enter text:</label>
            <input type="text" name="inputText" id="inputText" required><?php echo htmlspecialchars($_POST['inputText'] ?? ''); ?></input>
        </div>

        <div class="form-group">
            <label for="regexPattern">Enter Regex Pattern:</label>
            <input type="text" name="regexPattern" id="regexPattern" placeholder="/[a-z]/" value="<?php echo htmlspecialchars($_POST['regexPattern'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="operation">Choose Operation:</label>
            <select name="operation" id="operation">
                <option value="match" <?= ($_POST['operation'] ?? '') == 'match' ? 'selected' : '' ?>>Find Matches</option>
                <option value="positions" <?= ($_POST['operation'] ?? '') == 'positions' ? 'selected' : '' ?>>Find Matches with Positions</option>
                <option value="replace" <?= ($_POST['operation'] ?? '') == 'replace' ? 'selected' : '' ?>>Replace Text</option>
                <option value="validate" <?= ($_POST['operation'] ?? '') == 'validate' ? 'selected' : '' ?>>Validate Pattern</option>
            </select>
        </div>

        <div class="form-group">
            <label for="replacementText">Enter Replacement (only for Replace operation):</label>
            <input type="text" name="replacementText" id="replacementText" value="<?php echo htmlspecialchars($_POST['replacementText'] ?? ''); ?>">
        </div>

        <button type="submit" class="btn-execute">Execute</button>
    </form>

    <?php if ($result): ?>
        <div class="result-box <?= $statusClass ?>">
            <strong>Result:</strong><br>
            <?php echo $result; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>