<?php
require_once 'libs/Smarty.class.php';

$kwota = isset($_POST['kwota']) ? $_POST['kwota'] : null;
$lata = isset($_POST['lata']) ? $_POST['lata'] : null;
$oprocentowanie = isset($_POST['oprocentowanie']) ? $_POST['oprocentowanie'] : null;

$messages = []; 
$result = null;

if (!($kwota === null && $lata === null && $oprocentowanie === null)) {

    if ($kwota == "") $messages[] = 'Nie podano kwoty kredytu.';
    if ($lata == "") $messages[] = 'Nie podano liczby lat.';
    if ($oprocentowanie == "") $messages[] = 'Nie podano oprocentowania.';

    if (empty($messages)) {
        if (!is_numeric($kwota)) {
            $messages[] = 'Kwota kredytu musi być liczbą (nie wpisuj liter).';
        } else if ($kwota <= 0) {
            $messages[] = 'Kwota kredytu musi być większa od zera.';
        }

        if (!is_numeric($lata)) {
            $messages[] = 'Liczba lat musi być liczbą.';
        } else if ($lata <= 0) {
            $messages[] = 'Liczba lat musi być większa od zera.';
        }

        if (!is_numeric($oprocentowanie)) {
            $messages[] = 'Oprocentowanie musi być liczbą.';
        } else if ($oprocentowanie <= 0) {
            $messages[] = 'Oprocentowanie musi być większe od zera.';
        }
    }

    if (empty($messages)) {
        $k = floatval($kwota);
        $n = intval($lata) * 12; 
        $p = floatval($oprocentowanie) / 100 / 12; 
        
        $result = $k * ($p * pow(1 + $p, $n)) / (pow(1 + $p, $n) - 1);
    }
}

$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$smarty->assign('kwota', $kwota);
$smarty->assign('lata', $lata);
$smarty->assign('oprocentowanie', $oprocentowanie);
$smarty->assign('messages', $messages);
$smarty->assign('result', $result);

$smarty->display('calc_view.tpl');
?>