<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PHP Partie 9</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php

echo date('d/m/Y') . '<br>';
echo date('d-m-y') . '<br>';

$days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
$months = ['janver', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'décembre'];

echo 'Anglais : ' . date('l j F Y') . '<br>';
echo 'Français : ' . $days[date('w')] . ' ' . date('j') . ' ' . $months[date('n')] . ' ' . date('Y') . '<br>';

echo time() . '<br>';
echo strtotime('12 August 2016 15:00') . '<br>';

$may16 = strtotime('16 May 2016');
$r = $may16 - time();

echo 'Nombre de jour : ' . $r/86400 . '<br>';

echo date('t', strtotime('February 2016')) . '<br>';

echo date('l j F Y', strtotime('+ 20 days')) . '<br>';
echo date('l j F Y', strtotime('- 22 days')) . '<br>';


/* ** TP Calendrier ** */

function calendar($month, $year) {
    $days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $months = ['janver', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'décembre'];
    $monthsItem = $month - 1;

    $title = "$months[$monthsItem] $year<br>";
    $daysRender = '<tr>';
    $monthGapStart = date('w', strtotime($year . '-' . $month . '-' . '01'));
    $monthBlankStart = 0;
    $monthStart = '<tr>';
    $numberDays = date('t', strtotime($year . '-' . $month . '-' . '01'));
    $dayItem = 1;
    $weekItem = 0;
    $daysOfMonth = '';

    // Liste des jours de la semaine
    foreach($days as $d) {
        $daysRender .= "<td class=\"daysWeek\">$d</td>";
    }

    $daysRender .= '</tr>';

    // Décalage début de mois
    if ($monthGapStart > 0) {
        while ($monthBlankStart < $monthGapStart) {
            $monthStart .= '<td class="prevMonth"></td>';

            $weekItem += 1;

            if ($weekItem === 7)  {
                $monthStart .= '</tr><tr>';

                $weekItem = 0;
            }

            $monthBlankStart += 1;
        }
    }

    // Liste des jours du mois
    while ($dayItem <= $numberDays) {
        $daysOfMonth .= "<td class=\"day\">$dayItem</td>";

        $weekItem += 1;

        if ($weekItem === 7)  {
            $daysOfMonth .= '</tr><tr>';

            $weekItem = 0;
        }

        $dayItem += 1;
    }

    if ($weekItem !== 0) {
        while ($weekItem < 7) {
            $daysOfMonth .= '<td class="nextMonth"></td>';

            $weekItem += 1;
        }
    }

    $daysOfMonth .= '</tr>';

    return $title . '<table>' . $daysRender . $monthStart . $daysOfMonth . '</table><br>';
}

?>

<form action="/" method="get">
    <label for="month">Mois</label>
    <input type="number" min="1" max="12" step="1" value="<?= date('n'); ?>" name="month">
    <label for="year">Année</label>
    <input type="number" min="1970" max="2100" value="<?= date('Y'); ?>" name="year">
    <input type="submit" value="Valider">
</form><br>

<?php
echo (count($_GET) > 0)?calendar($_GET['month'], $_GET['year']):calendar(date('n'), date('Y'));
?>
</body>
</html>
