<?php

$result = null;
$operation = $_POST['operation'] ?? '';
$inputText = $_POST['text'] ?? '';
$sortOrder = $_POST['sort_order'] ?? 'asc';

function extractWords($text) {
    $cleanText = mb_strtolower(preg_replace('/[^\p{L}\s]/u', '', $text));
    return preg_split('/\s+/', $cleanText, -1, PREG_SPLIT_NO_EMPTY);
}

function customBubbleSort(&$array, $order = 'asc') {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            $condition = ($order === 'asc') 
                ? strcoll($array[$j], $array[$j + 1]) > 0 
                : strcoll($array[$j], $array[$j + 1]) < 0;
            
            if ($condition) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($inputText)) {
    setlocale(LC_COLLATE, 'pl_PL.utf8');
    $words = extractWords($inputText);

    switch ($operation) {
        case 'frequency':
            $counts = array_count_values($words);
            arsort($counts);
            $result = ['type' => 'table', 'data' => $counts, 'title' => 'Częstotliwość słów'];
            break;

        case 'sort':
            customBubbleSort($words, $sortOrder);
            $result = ['type' => 'list', 'data' => $words, 'title' => 'Posortowane słowa'];
            break;
            
        case 'stats':
            $stats = [
                'Liczba znaków (ze spacjami)' => mb_strlen($inputText),
                'Liczba znaków (bez spacji)' => mb_strlen(str_replace(' ', '', $inputText)),
                'Liczba słów' => count($words),
                'Liczba unikalnych słów' => count(array_unique($words))
            ];
            $result = ['type' => 'stats', 'data' => $stats, 'title' => 'Statystyki tekstu'];
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zad2.css">
    <title>Zaawansowana analiza ciągów znaków</title>
</head>
<body>

<div class="container">
    <h2>Zaawansowana analiza ciągów znaków</h2>
    
    <form method="POST">
        <div class="form-group">
            <label for="text">Wpisz tekst:</label>
            <input type="text" name="text" id="text" value="<?= htmlspecialchars($inputText) ?>" required>
        </div>

        <div class="options-grid">
            <div class="form-group">
                <label for="operation">Wybierz operację:</label>
                <select name="operation" id="operation">
                    <option value="frequency" <?= $operation == 'frequency' ? 'selected' : '' ?>>Ekstrakcja unikalnych słów i częstotliwość</option>
                    <option value="sort" <?= $operation == 'sort' ? 'selected' : '' ?>>Sortowanie alfabetyczne słów</option>
                    <option value="stats" <?= $operation == 'stats' ? 'selected' : '' ?>>Ogólne statystyki tekstu</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn-submit">Analizuj</button>
    </form>

    <?php if ($result): ?>
        <div class="result-container">
            <h3 style="margin-top:0"><?= $result['title'] ?>:</h3>
            
            <?php if ($result['type'] === 'table'): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Słowo</th>
                            <th>Częstotliwość</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result['data'] as $word => $count): ?>
                            <tr>
                                <td><?= htmlspecialchars($word) ?></td>
                                <td><?= $count ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif ($result['type'] === 'list'): ?>
                <div style="background: white; padding: 15px; border-radius: 4px;">
                    <?= implode(', ', array_map('htmlspecialchars', $result['data'])) ?>
                </div>

            <?php elseif ($result['type'] === 'stats'): ?>
                <ul>
                    <?php foreach ($result['data'] as $label => $value): ?>
                        <li><strong><?= $label ?>:</strong> <?= $value ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>