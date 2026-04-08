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

    for ($x = $a; $x <= $b; $x++) {
        if ($x % $c == 0) {
            echo $x;
            echo " ";
        }
    }
    ?>
</body>

</html>