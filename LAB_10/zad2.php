<?php
$cookieName = "voted";
$message = "";

$options = [
    "PHP" => 0,
    "JavaScript" => 0,
    "Python" => 0,
    "Java" => 0,
    "C#" => 0
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_COOKIE[$cookieName])) {
        $message = "Już oddałeś głos!";
    } else {

        if (isset($_POST['language'])) {

            $selected = $_POST['language'];

            setcookie($cookieName, $selected, time() + (86400 * 30));

            $message = "Dziękujemy za oddanie głosu na: " . $selected;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonda internetowa</title>
    <link rel="stylesheet" href="zad2.css">
</head>
<body>

<div class="container">

    <h1>Jaki jest Twój ulubiony język programowania?</h1>

    <?php if (!isset($_COOKIE[$cookieName])): ?>

        <form method="POST">

            <?php foreach ($options as $language => $value): ?>
                <label>
                    <input type="radio" name="language" value="<?php echo $language; ?>" required>
                    <?php echo $language; ?>
                </label>
                <br>
            <?php endforeach; ?>

            <button type="submit">Głosuj</button>

        </form>

    <?php else: ?>

        <p class="info">
            Już głosowałeś na:
            <strong><?php echo $_COOKIE[$cookieName]; ?></strong>
        </p>

    <?php endif; ?>

    <?php if ($message != ""): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

</div>

</body>
</html>