<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $a = 0;
    $b = 8;
    $c = 2;
    $x = 0;

    while ($x <= $b) {
        if ($x % $c == 0) {
            echo $x;
            echo " ";
        }
        $x++;
    }
    ?>
</body>

</html>