<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $rok = 2026;
    $nrMiesiaca = 2;

    if ($nrMiesiaca == 2) {
        if (($rok % 4 == 0 && $rok % 100 != 0) || ($rok % 400 == 0)) {
            $dniMiesiaca = 29;
        } else {
            $dniMiesiaca = 28;
        }
    } elseif (in_array($nrMiesiaca, [4, 6, 9, 11])) {
        $dniMiesiaca = 30;
    } else {
        $dniMiesiaca = 31;
    }

    echo "Rok: $rok, numer miesiąca: $nrMiesiaca, liczba dni w miesiącu: $dniMiesiaca";
    ?>
</body>

</html>