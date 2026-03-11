<?php
$kwota = isset($_POST['kwota']) ? $_POST['kwota'] : null;
$lata = isset($_POST['lata']) ? $_POST['lata'] : null;
$oprocentowanie = isset($_POST['oprocentowanie']) ? $_POST['oprocentowanie'] : null;

if (!($kwota === null && $lata === null && $oprocentowanie === null)) {
    $messages = []; 

    if ($kwota == "") $messages[] = 'Nie podano kwoty kredytu.';
    if ($lata == "") $messages[] = 'Nie podano liczby lat.';
    if ($oprocentowanie == "") $messages[] = 'Nie podano oprocentowania.';

    if (empty($messages)) {
        if (!is_numeric($kwota) || $kwota <= 0) {
            $messages[] = 'Kwota musi być liczbą dodatnią.';
        }
        if (!is_numeric($lata) || $lata <= 0) {
            $messages[] = 'Liczba lat musi być liczbą dodatnią.';
        }
        if (!is_numeric($oprocentowanie) || $oprocentowanie <= 0) {
            $messages[] = 'Oprocentowanie musi być liczbą dodatnią.';
        }
    }

    if (empty($messages)) {
        $k = floatval($kwota);
        $n = intval($lata) * 12; 
        $p = floatval($oprocentowanie) / 100 / 12; 
        
        $result = $k * ($p * pow(1 + $p, $n)) / (pow(1 + $p, $n) - 1);
    }
}

include 'calc_view.php';
?>