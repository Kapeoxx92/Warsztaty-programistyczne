<?php
$podstrony = [
    [
        "nazwa" => "O nas",
        "link" => "onas",
        "tresc" => "Witaj na stronie O nas. Tu opis firmy -> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate accusamus ea aperiam dignissimos ipsa quaerat, iure recusandae cupiditate, nihil praesentium repudiandae non! Unde officiis consectetur doloremque explicabo officia, distinctio facere.."
    ],
    [
        "nazwa" => "Oferta",
        "link" => "oferta",
        "tresc" => "Nasza oferta obejmuje różne usługi."
    ],
    [
        "nazwa" => "Kontakt",
        "link" => "kontakt",
        "tresc" => "Skontaktuj się z nami: email: mojapierwszastronka@php.com, telefon: 893 574 289."
    ]
];

$aktualny_link = $_GET["link"] ?? "onas";

$aktualna_strona = null;

foreach ($podstrony as $strona) {
    if ($strona["link"] === $aktualny_link) {
        $aktualna_strona = $strona;
        break;
    }
}

if (!$aktualna_strona) {
    $aktualna_strona = [
        "nazwa" => "404",
        "tresc" => "Nie znaleziono strony."
    ];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moja strona PHP</title>
</head>
<body>

<h1>Moja pierwsza stronka PHP</h1>

<ul>
    <?php foreach ($podstrony as $strona): ?>
        <li>
            <a href="?link=<?= $strona["link"] ?>">
                <?= $strona["nazwa"] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<hr>

<h2><?= $aktualna_strona["nazwa"] ?></h2>
<p><?= $aktualna_strona["tresc"] ?></p>

</body>
</html>