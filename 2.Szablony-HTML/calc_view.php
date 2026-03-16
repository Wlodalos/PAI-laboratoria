<!DOCTYPE HTML>
<html>
    <head>
        <title>Kalkulator Kredytowy - PAI</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body class="no-sidebar is-preload">
        <div id="page-wrapper">

            <section id="header" class="wrapper">

                    <div id="logo">
                            <h1><a href="index.php">Kalkulator Kredytowy</a></h1>
                            <p>Projektowanie Aplikacji Internetowych</p>
                        </div>

                    <nav id="nav">
                            <ul>
                                <li class="current"><a href="index.php">Strona główna</a></li>
                                <li><a href="#footer">O autorze</a></li>
                            </ul>
                        </nav>

                </section>

            <div id="main" class="wrapper style2">
                    <div class="title">Oblicz swoją ratę</div>
                    <div class="container">

                        <div id="content">
                                <article class="box post">
                                    
                                    <form action="calc.php" method="post" style="max-width: 600px; margin: 0 auto; text-align: left;">
                                        
                                        <div class="row gtr-50">
                                            <div class="col-12">
                                                <label for="kwota">Kwota kredytu (zł):</label>
                                                <input type="text" name="kwota" id="kwota" placeholder="np. 200000" value="<?php echo isset($kwota) ? $kwota : ''; ?>" />
                                            </div>
                                            
                                            <div class="col-12">
                                                <label for="lata">Liczba lat:</label>
                                                <input type="text" name="lata" id="lata" placeholder="np. 15" value="<?php echo isset($lata) ? $lata : ''; ?>" />
                                            </div>
                                            
                                            <div class="col-12">
                                                <label for="oprocentowanie">Oprocentowanie roczne (%):</label>
                                                <input type="text" name="oprocentowanie" id="oprocentowanie" placeholder="np. 7.5" value="<?php echo isset($oprocentowanie) ? $oprocentowanie : ''; ?>" />
                                            </div>
                                            
                                            <div class="col-12">
                                                <ul class="actions" style="margin-top: 20px;">
                                                    <li><input type="submit" value="Oblicz ratę" class="button style1" /></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </form>

                                    <div style="max-width: 600px; margin: 30px auto 0 auto; text-align: left;">
                                        <?php
                                        if (isset($messages) && count($messages) > 0) {
                                            echo '<div style="padding: 20px; background-color: #ffe6e6; border-left: 5px solid #ff4d4d; border-radius: 4px;">';
                                            echo '<h3 style="color: #cc0000; margin-bottom: 10px;">Wystąpiły błędy:</h3>';
                                            echo '<ul style="color: #cc0000; margin: 0; padding-left: 20px;">';
                                            foreach ($messages as $msg) {
                                                echo '<li>' . $msg . '</li>';
                                            }
                                            echo '</ul>';
                                            echo '</div>';
                                        }

                                        if (isset($result)) {
                                            echo '<div style="padding: 20px; background-color: #e6ffe6; border-left: 5px solid #33cc33; border-radius: 4px; text-align: center;">';
                                            echo '<h3 style="color: #009900; margin: 0;">Miesięczna rata wynosi: <br><span style="font-size: 1.5em;">' . number_format($result, 2, ',', ' ') . ' zł</span></h3>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>

                                </article>
                            </div>

                    </div>
                </div>

            <section id="footer" class="wrapper">
                    <div class="title">Kontakt</div>
                    <div class="container">
                        <div id="copyright">
                            <ul>
                                <li>&copy; Bartłomiej Chyra. Wszelkie prawa zastrzeżone.</li>
                                <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                            </ul>
                        </div>
                    </div>
                </section>

        </div>

        <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.dropotron.min.js"></script>
            <script src="assets/js/browser.min.js"></script>
            <script src="assets/js/breakpoints.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>

    </body>
</html>