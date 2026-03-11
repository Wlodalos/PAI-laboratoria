<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Kredytowy</title>
</head>
<body>
    <h2>Kalkulator Kredytowy</h2>
    
    <form action="calc.php" method="post">
        <label for="kwota">Kwota kredytu (zł):</label>
        <input type="text" name="kwota" id="kwota" value="<?php echo isset($kwota) ? $kwota : ''; ?>"><br><br>
        
        <label for="lata">Liczba lat:</label>
        <input type="text" name="lata" id="lata" value="<?php echo isset($lata) ? $lata : ''; ?>"><br><br>
        
        <label for="oprocentowanie">Oprocentowanie roczne (%):</label>
        <input type="text" name="oprocentowanie" id="oprocentowanie" value="<?php echo isset($oprocentowanie) ? $oprocentowanie : ''; ?>"><br><br>
        
        <input type="submit" value="Oblicz ratę">
    </form>

    <?php
    if (isset($messages) && count($messages) > 0) {
        echo '<div style="color: red; margin-top: 20px;">';
        echo '<b>Wystąpiły błędy:</b><br>';
        foreach ($messages as $msg) {
            echo '- ' . $msg . '<br>';
        }
        echo '</div>';
    }

    if (isset($result)) {
        echo '<div style="color: green; margin-top: 20px; font-size: 18px;">';
        echo '<b>Miesięczna rata wynosi: ' . round($result, 2) . ' zł</b>';
        echo '</div>';
    }
    ?>
</body>
</html>