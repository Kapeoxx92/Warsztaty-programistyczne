<?php
session_start();

$month = isset($_GET['m']) ? (int)$_GET['m'] : date('n');
$year = isset($_GET['y']) ? (int)$_GET['y'] : date('Y');

if (isset($_POST['generate'])) {
    $month = (int)$_POST['m_input'];
    $year = (int)$_POST['y_input'];
}

if (isset($_POST['add_event'])) {
    $day = $_POST['event_day'];
    $text = htmlspecialchars($_POST['event_text']);
    $_SESSION['events'][$year][$month][$day][] = $text;
}

$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$daysInMonth = date('t', $firstDayOfMonth);
$dayOfWeek = date('w', $firstDayOfMonth);
$monthNames = ["", "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="zad4.css">
    <title>Generator Kalendarza</title>
</head>
<body>

    <h1>Generuj kalendarz</h1>

    <div class="form-container">
        <form method="POST" style="display: flex; gap: 10px;">
            <input type="number" name="m_input" placeholder="Miesiąc (mm)" min="1" max="12" required>
            <input type="number" name="y_input" placeholder="Rok (yyyy)" min="1900" max="2100" required>
            <button type="submit" name="generate" class="btn">Generuj kalendarz</button>
        </form>
    </div>

    <div class="calendar-title"><?php echo $monthNames[$month] . " " . $year; ?></div>

    <table>
        <thead>
            <tr>
                <th>Niedziela</th><th>Poniedziałek</th><th>Wtorek</th><th>Środa</th><th>Czwartek</th><th>Piątek</th><th>Sobota</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                for ($i = 0; $i < $dayOfWeek; $i++) {
                    echo "<td></td>";
                }

                for ($d = 1; $d <= $daysInMonth; $d++) {
                    if (($i + $d - 1) % 7 == 0 && ($d > 1)) {
                        echo "</tr><tr>";
                    }
                    echo "<td>";
                    echo "<span class='day-num'>$d</span>";
                    
                    if (isset($_SESSION['events'][$year][$month][$d])) {
                        echo "<ul class='event-list'>";
                        foreach ($_SESSION['events'][$year][$month][$d] as $ev) {
                            echo "<li>• $ev</li>";
                        }
                        echo "</ul>";
                    }
                    echo "</td>";
                }

                while (($i + $daysInMonth) % 7 != 0) {
                    echo "<td></td>";
                    $i++;
                }
                ?>
            </tr>
        </tbody>
    </table>

    <div class="nav-container">
        <a href="?m=<?php echo $prevMonth; ?>&y=<?php echo $prevYear; ?>" class="btn">Poprzedni miesiąc</a>
        <a href="?m=<?php echo $nextMonth; ?>&y=<?php echo $nextYear; ?>" class="btn">Następny miesiąc</a>
    </div>

    <div class="event-form">
        <h3>Dodaj wydarzenie do obecnego widoku:</h3>
        <form method="POST">
            <input type="number" name="event_day" placeholder="Dzień" min="1" max="<?php echo $daysInMonth; ?>" required>
            <input type="text" name="event_text" placeholder="Nazwa wydarzenia" required>
            <button type="submit" name="add_event" class="btn">Dodaj</button>
        </form>
    </div>

</body>
</html>