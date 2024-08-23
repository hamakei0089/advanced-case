<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header__area">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger">
                <span class="line-1"></span>
                <span class="line-2"></span>
                <span class="line-3"></span>
            </label>
            <h1 class="header__logo"><a href="/">Rese</a></h1>
            <table class="slide-menu">
                <tr class="slide-menu__item">
                    <td>
                    <a class="slide-menu__link" href="/">Home</a>
                    </td>
                </tr>
                <tr class="slide-menu__item">
                    <td>
                    <a class="slide-menu__link" href="/register">Registration</a>
                    </td>
                </tr>
                <tr class="slide-menu__item">
                    <td>
                    <a class="slide-menu__link" href="/login">Login</a>
                    </td>
                </tr>
            </table>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>