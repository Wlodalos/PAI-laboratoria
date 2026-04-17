<!DOCTYPE HTML>
<html>
    <head>
        <title>Kalkulator Kredytowy - Laravel</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    </head>
    <body class="no-sidebar is-preload">
        <div id="page-wrapper">

            <section id="header" class="wrapper">
                <div id="logo">
                    <h1><a href="{{ url('/') }}">Kalkulator Kredytowy</a></h1>
                    <p>Projektowanie Aplikacji Internetowych</p>
                </div>
                <nav id="nav">
                    <ul>
                        <li class="current"><a href="{{ url('/') }}">Strona główna</a></li>
                        <li><a href="#footer">O autorze</a></li>
                    </ul>
                </nav>
            </section>

            <div id="main" class="wrapper style2">
                <div class="title">Oblicz swoją ratę</div>
                <div style="text-align: right; padding-right: 20px;">
    @if(session('user_login'))
        Zalogowany jako: <strong>{{ session('user_login') }}</strong> (Rola: {{ session('user_rola') }}) | 
        <a href="{{ url('/logout') }}">Wyloguj się</a>
    @endif
</div>
                <div class="container">
                    <div id="content">
                        <article class="box post">
                            
                            <form action="{{ url('/calc') }}" method="post" style="max-width: 600px; margin: 0 auto; text-align: left;">
                                @csrf <div class="row gtr-50">
                                    <div class="col-12">
                                        <label for="kwota">Kwota kredytu (zł):</label>
                                        <input type="text" name="kwota" id="kwota" placeholder="np. 200000" value="{{ $kwota ?? '' }}" />
                                    </div>
                                    <div class="col-12">
                                        <label for="lata">Liczba lat:</label>
                                        <input type="text" name="lata" id="lata" placeholder="np. 15" value="{{ $lata ?? '' }}" />
                                    </div>
                                   <div class="col-12">
    <label for="oprocentowanie">Oprocentowanie roczne (%):</label>

    @if(session('user_rola') == 'menadzer')
        <input type="text" name="oprocentowanie" id="oprocentowanie" placeholder="np. 7.5" value="{{ $oprocentowanie ?? '' }}" />
        <p style="font-size: 0.8em; color: green; margin: 5px 0 0 0;">Zalogowano jako Administrator. Masz prawo edytować oprocentowanie.</p>
    @elseif(session('user_rola') == 'pracownik')
        <input type="hidden" name="oprocentowanie" value="8" />
        <input type="text" disabled value="8 (Opcja zablokowana)" />
        <p style="font-size: 0.8em; color: red; margin: 5px 0 0 0;">Jako pracownik nie możesz zmieniać oprocentowania (sztywno 8%).</p>
    @else
        <input type="hidden" name="oprocentowanie" value="10" />
        <input type="text" disabled value="10 (Tylko do odczytu)" />
        <p style="font-size: 0.8em; color: orange; margin: 5px 0 0 0;">Zaloguj się jako Menadżer, aby zmienić oprocentowanie. <a href="{{ url('/login') }}">Zaloguj się</a></p>
    @endif
</div>
                                    <div class="col-12">
                                        <ul class="actions" style="margin-top: 20px;">
                                            <li><input type="submit" value="Oblicz ratę" class="button style1" /></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>

                            <div style="max-width: 600px; margin: 30px auto 0 auto; text-align: left;">
                                @if(isset($messages) && count($messages) > 0)
                                    <div style="padding: 20px; background-color: #ffe6e6; border-left: 5px solid #ff4d4d; border-radius: 4px;">
                                        <h3 style="color: #cc0000; margin-bottom: 10px;">Wystąpiły błędy:</h3>
                                        <ul style="color: #cc0000; margin: 0; padding-left: 20px;">
                                        @foreach($messages as $msg)
                                            <li>{{ $msg }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(isset($result))
                                    <div style="padding: 20px; background-color: #e6ffe6; border-left: 5px solid #33cc33; border-radius: 4px; text-align: center;">
                                        <h3 style="color: #009900; margin: 0;">Miesięczna rata wynosi: <br><span style="font-size: 1.5em;">{{ number_format($result, 2, ',', ' ') }} zł</span></h3>
                                    </div>
                                @endif
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

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dropotron.min.js') }}"></script>
        <script src="{{ asset('assets/js/browser.min.js') }}"></script>
        <script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/util.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>