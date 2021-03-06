@extends('layouts.app')
@section('content')
    <div class="uk-cover-container" uk-height-viewport>
        <img src="{{ asset('images/office-table-background-01.jpg') }}" alt="" uk-cover>
        <div class="uk-overlay uk-light uk-position-center">

            <div class="uk-card-secondary card-background uk-card uk-card-body card-shadow uk-text-center">

                <h3 class="uk-heading-line uk-text-center uk-text-muted"><span>Вход в систему</span></h3>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="uk-margin ">
                            <div class="uk-inline">
                                <span class="uk-form-icon"><i class="icon ion-email icon-nav-size"></i></span>
                                <input class="uk-input auth-input-width" name="email" placeholder="Эл. адресс" type="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <br>
                                <span class="uk-text-danger">
                            {{ $errors->first('email') }}
                        </span>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip"><i class="icon ion-locked icon-nav-size"></i></span>
                                <input class="uk-input auth-input-width" placeholder="Пароль" type="password" name="password" required>

                                @if ($errors->has('password'))
                                    <br>
                                    <span class="uk-text-danger">
                                {{ $errors->first('password') }}
                            </span>
                                @endif
                            </div>
                        </div>
                        <button class="uk-button uk-button-default" type="submit">Войти</button>
                    </form>
            </div>
        </div>
    </div>

@endsection