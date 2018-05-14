<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    --}}

    <link href="{{ asset('css/uikit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Play" rel="stylesheet">
</head>
<body>
{{--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
--}}

    @auth
        <div class="tm-sidebar-left">
            <ul class="uk-nav uk-nav-primary uk-nav-left uk-margin-auto-vertical">
                <li class="uk-nav-header"></li>
                <li><a href="{{ route('home') }}" class="nav-item"><i class="icon ion-home icon-nav-size"></i> Главная</a></li>
                <li><a href="{{ route('users/show', [ 'id' => auth()->user()->id ]) }}" class="nav-item">
                        <i class="icon ion-person icon-nav-size"></i> Моё CV
                        <span class="uk-badge warning-badge" uk-tooltip="title: Заполните свое CV.; pos: right">!</span>
                    </a>
                </li>
                @level($roleLevels['moderator'])
                     <li>
                         <a href="{{ route('showUserCreateForm') }}" class="nav-item">
                             <i class="icon ion-person-add icon-nav-size"></i>
                              Создать CV
                         </a>
                     </li>
                @endlevel
                @level($roleLevels['employee'])
                <li><a href="{{ route('showAllUsers') }}" class="nav-item">
                        <i class="icon ion-person-stalker icon-nav-size"></i>
                         Все CV
                    </a>
                </li>
                @endlevel
                <li><a href="#" class="nav-item">
                        <i class="icon ion-settings icon-nav-size"></i>
                         Настройки
                    </a>
                </li>
                <li><a href="#" class="nav-item">
                        <i class="icon ion-help-circled icon-nav-size"></i>
                         Помощь
                    </a>
                </li>
                <li class="uk-nav-divider "></li>
                <li><a id="logout-button" class="nav-item ">
                        <i class="icon ion-log-out icon-nav-size"></i>
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
        <div class="main-block">
            @yield('content')
        </div>
    @endauth

    @guest
        @yield('content')
    @endguest

    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/uikit.min.js') }}"></script>

</body>
</html>