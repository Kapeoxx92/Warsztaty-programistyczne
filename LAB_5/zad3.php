<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
$zmienna = 8;

echo "<table border='1' cellpadding='5' cellspacing='0'>";

echo "<tr><th>*</th>";
for ($i = 1; $i <= $zmienna; $i++) {
    echo "<th>$i</th>";
}
echo "</tr>";

for ($x = 1; $x <= $zmienna; $x++) {
    echo "<tr>";
    echo "<th>$x</th>";

    for ($y = 1; $y <= $zmienna; $y++) {
        echo "<td>" . ($x * $y) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";
?>
</body>

</html>