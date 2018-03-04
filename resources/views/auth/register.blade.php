@extends('layouts.app')

@section('content')

    <div class="uk-cover-container" uk-height-viewport>
        <img src="{{ asset('images/office-table-background-01.jpg') }}" alt="" uk-cover>
        <div class="uk-overlay uk-light uk-position-center">

            <div class="uk-card-secondary card-background uk-card uk-card-body card-shadow uk-text-center">

                <h3 class="uk-heading-line uk-text-center uk-text-muted"><span>Registration</span></h3>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="uk-margin ">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input auth-input-width" name="name" placeholder="Name" type="text" value="{{ old('name') }}" required autofocus>

                        </div>
                        @if ($errors->has('name'))
                            <br>
                            <span class="uk-text-danger">
                                {{ $errors->first('name') }}
                                </span>
                        @endif
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input auth-input-width" name="surname" placeholder="Surname" type="text" value="{{ old('surname') }}" required autofocus>

                        </div>
                        @if ($errors->has('surname'))
                            <br>
                            <span class="uk-text-danger">
                                {{ $errors->first('surname') }}
                                </span>
                        @endif
                    </div>

                    <div class="uk-width-1-1@s ">
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
                        </div>
                        @if ($errors->has('password'))
                            <br>
                            <span class="uk-text-danger">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                            <input class="uk-input auth-input-width" placeholder="Confirm password" type="password" name="password_confirmation" required>
                        </div>

                    </div>

                    <p>Already have an account? <a class="uk-link-muted" href="{{ route('login') }}">Log in</a></p>
                    <button class="uk-button uk-button-default" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>

@endsection