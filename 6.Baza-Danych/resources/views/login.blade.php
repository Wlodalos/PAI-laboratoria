<!DOCTYPE HTML>
<html>
    <head>
        <title>Logowanie do Kalkulatora</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    </head>
    <body class="no-sidebar is-preload">
        <div id="page-wrapper">
            <div id="main" class="wrapper style2" style="text-align: center; padding: 50px;">
                <div class="title">Zaloguj się</div>
                <div class="container" style="max-width: 400px; margin: 0 auto;">
                    
                    @if(session('error'))
                        <p style="color: #cc0000; font-weight: bold;">{{ session('error') }}</p>
                    @endif

                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <input type="text" name="login" placeholder="Login (np. admin lub pracownik)" required style="margin-bottom: 15px;" />
                        <input type="password" name="password" placeholder="Hasło" required style="margin-bottom: 15px;" />
                        <input type="submit" value="Zaloguj" class="button style1" style="width: 100%;" />
                    </form>
                    
                    <p style="margin-top: 20px;"><a href="{{ url('/') }}">Wróć do strony głównej</a></p>
                </div>
            </div>
        </div>
    </body>
</html>