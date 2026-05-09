<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="zad3.css">
    <title>Oblicz wiek i dni robocze</title>
</head>
<body>

<div class="container">
    <h1>Oblicz wiek i dni robocze</h1>

    <div class="card">
        <h2>Oblicz wiek i czas lokalny</h2>
        <form method="POST">
            <div class="form-row">
                <input type="text" name="birthdate" placeholder="Data urodzenia (d-m-Y)" required>
                <select name="timezone">
                    <?php
                    $timezones = DateTimeZone::listIdentifiers();
                    foreach ($timezones as $tz) {
                        $selected = ($tz == 'Europe/Warsaw') ? 'selected' : '';
                        echo "<option value=\"$tz\" $selected>$tz</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="calc_age">Oblicz wiek i czas</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>Oblicz dni robocze</h2>
        <form method="POST">
            <div class="form-row">
                <input type="text" name="start_date" placeholder="Data początkowa (d-m-Y)" required>
                <input type="text" name="end_date" placeholder="Data końcowa (d-m-Y)" required>
                <button type="submit" name="calc_workdays">Oblicz dni robocze</button>
            </div>
        </form>
    </div>

    <div class="results">
        <?php
        // LOGIKA FORMULARZA 1
        if (isset($_POST['calc_age'])) {
            $birthInput = $_POST['birthdate'];
            $tzInput = $_POST['timezone'];

            $birthDate = DateTime::createFromFormat('d-m-Y', $birthInput);
            if ($birthDate) {
                $now = new DateTime();
                $age = $now->diff($birthDate)->y;

                $localTime = new DateTime('now', new DateTimeZone($tzInput));
                
                echo "Wiek: $age lat.<br>";
                echo "Czas lokalny: " . $localTime->format('H:i:s') . ".";
            } else {
                echo "Błędny format daty urodzenia!";
            }
        }

        if (isset($_POST['calc_workdays'])) {
            $startInput = $_POST['start_date'];
            $endInput = $_POST['end_date'];

            $start = DateTime::createFromFormat('d-m-Y', $startInput);
            $end = DateTime::createFromFormat('d-m-Y', $endInput);

            if ($start && $end) {
                if ($start > $end) {
                    $temp = $start; $start = $end; $end = $temp;
                }

                $workDays = 0;
                $period = new DatePeriod($start, new DateInterval('P1D'), $end->modify('+1 day'));

                foreach ($period as $date) {
                    $dayOfWeek = $date->format('N'); // 1 (Mon) to 7 (Sun)
                    if ($dayOfWeek < 6) {
                        $workDays++;
                    }
                }
                echo "Liczba dni roboczych: $workDays.";
            } else {
                echo "Błędny format dat w obliczaniu dni roboczych!";
            }
        }
        ?>
    </div>
</div>

</body>
</html>