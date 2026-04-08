<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $a = 3;
        $b = 1;
        $c = 8;

        if (($a * $a) + ($b * $b) == ($c * $c)) {
            echo "Spełnia warunek z twierdzenia Pitarasa";
        } else {
            echo "Nie spełnia warunku z twierdzenia Pitarasa";
        }
    ?>
</body>
</html>