@extends('layouts.app')
@section('content')
    <div class="uk-cover-container" uk-height-viewport>
        <img src="{{ asset('images/office-table-background-01.jpg') }}" alt="" uk-cover>
        <div class="uk-overlay uk-light uk-position-center">

            <div class="uk-card-secondary card-background uk-card uk-card-body card-shadow uk-text-center">

                <h3 class="uk-heading-line uk-text-center uk-text-muted"><span>Log in</span></h4>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="uk-margin ">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input class="uk-input auth-input-width" name="email" placeholder="E-mail" type="email" value="{{ old('email') }}" required autofocus>

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
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input class="uk-input auth-input-width" placeholder="Password" type="password" name="password" required>

                                @if ($errors->has('password'))
                                    <br>
                                    <span class="uk-text-danger">
                                {{ $errors->first('password') }}
                            </span>
                                @endif
                            </div>
                        </div>
                        <p>Don`t have an account? <a class="uk-link-muted" href="{{ route('register') }}">Register</a></p>
                        <button class="uk-button uk-button-default" type="submit">Log in</button>
                    </form>
            </div>
        </div>
    </div>

@endsection