<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common2.css') }}">
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
                @if (Auth::check())
                <tr class="slide-menu__item">
                    <td>
                        <a class="slide-menu__link" href="/">Home</a>
                    </td>
                </tr>
                <tr class="slide-menu__item">
                    <td>
                        <a class="slide-menu__link" href="/mypage">Mypage</a>
                    </td>
                </tr>
                <tr class="slide-menu__item">
                    <td>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="slide-menu__button">Logout</button>
                        </form>
                    </td>
                </tr>
                @endif
            </table>
        </div>

        <div class="search-bar">
            <div class="search-item">
                <select id="area-filter" class="filter">
                    <option value="all">All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->name }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-item">
                <select id="genre-filter" class="filter">
                    <option value="all">All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->name }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-item">
                <input type="text" id="search-box" class="search-box" placeholder="🔍Search...">
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ asset('js/search.js') }}"></script>

</body>

</html>
