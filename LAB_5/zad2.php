<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
$a = 5;
$b = 3;
$c = 4;

$max = max($a, $b, $c);

if ($max == $a) {
    $x = $b;
    $y = $c;
} elseif ($max == $b) {
    $x = $a;
    $y = $c;
} else {
    $x = $a;
    $y = $b;
}

if ($x * $x + $y * $y == $max * $max) {
    echo "Spełniają twierdzenie Pitagorasa";
} else {
    echo "Nie spełniają";
}
?>
</body>
</html>