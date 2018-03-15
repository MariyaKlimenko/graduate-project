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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Play" rel="stylesheet">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @auth
        <div class="tm-sidebar-left">
            <ul class="uk-nav uk-nav-primary uk-nav-left uk-margin-auto-vertical">
                <li class="uk-nav-header"></li>
                <li><a href="#" class="nav-item"><span class="uk-margin-small-right" uk-icon="icon: home"></span > Home</a></li>
                <li><a href="#" class="nav-item">
                        <span class="uk-margin-small-right" uk-icon="icon: user"></span> Profile
                        <span class="uk-badge warning-badge" uk-tooltip="title: You need to complete your CV.; pos: right">!</span>
                    </a>
                </li>
                @role('administrator')
                    <li><a href="{{ route('showUserCreateForm') }}" class="nav-item"><span class="uk-margin-small-right" uk-icon="icon: plus"></span> Add user</a></li>
                @endrole
                <li><a href="#" class="nav-item"><span class="uk-margin-small-right" uk-icon="icon: users"></span> All CVs</a></li>
                <li><a href="#" class="nav-item"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Settings</a></li>
                <li><a href="#" class="nav-item"><span class="uk-margin-small-right" uk-icon="icon: question"></span> Help</a></li>
                <li class="uk-nav-divider "></li>
                <li><a id="logout-button" class="nav-item"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Log out</a>
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



<!-- Scripts -->
{{--
    <script src="{{ asset('js/app.js') }}"></script>
--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>


{{--
Custom scripts
--}}

    <script>
        $(function () {
            $('body').on('click', '#logout-button', function () {
                console.log('LL');
                $('#logout-form').submit();
            });
        });

    </script>
</body>
</html>