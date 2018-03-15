@extends('layouts.app')

@section('content')
    <h2 >Создать нового пользователя</h2>
<div class="uk-column-1-2">
    <form method="POST" action="{{ route('storeUser') }}" id="create-user-form" class="uk-form-stacked">

        <div class="uk-margin">
            <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Имя</label>
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large" name="name" placeholder="Имя" type="text" value="{{ old('name') }}" required autofocus>

            </div>
            @if ($errors->has('name'))
                <br>
                <span class="uk-text-danger">
                                {{ $errors->first('name') }}
                                </span>
            @endif
        </div>

        <div class="uk-margin">
            <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Фамилия</label>
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large" name="surname" placeholder="Фамилия" type="text" value="{{ old('surname') }}" required autofocus>
            </div>
            @if ($errors->has('surname'))
                <br>
                <span class="uk-text-danger">
                                {{ $errors->first('surname') }}
                                </span>
            @endif
        </div>

        <div class="uk-margin">
            <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Электронный адресс</label>
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: mail"></span>
                <input class="uk-input uk-form-width-large" name="email" placeholder="Эл. адресс" type="email" value="{{ old('email') }}" required autofocus>

            </div>
            @if ($errors->has('email'))
                <br>
                <span class="uk-text-danger">
                                {{ $errors->first('email') }}
                                </span>
            @endif
        </div>
        <div class="uk-margin">
            <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Позиция</label>
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: social"></span>
                <input class="uk-input uk-form-width-large" name="position" placeholder="Позиция" type="text" value="{{ old('position') }}" required autofocus>
            </div>
            @if ($errors->has('position'))
                <br>
                <span class="uk-text-danger">
                                {{ $errors->first('position') }}
                                </span>
            @endif
        </div>
        <div class="uk-margin">
            <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Местоположение</label>
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: location"></span>
                <input class="uk-input uk-form-width-large" name="location" placeholder="Местоположение" type="text" value="{{ old('location') }}" required autofocus>
            </div>
            @if ($errors->has('location'))
                <br>
                <span class="uk-text-danger">
                                {{ $errors->first('location') }}
                                </span>
            @endif
        </div>


        <div class="uk-margin">
            <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Роль</label>
            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label><input class="uk-radio" type="radio" name="role" value="moderator"> Модератор</label>
                <label><input class="uk-radio" type="radio" name="role"  value="employee" checked> Сотрудник</label>
                <label><input class="uk-radio" type="radio" name="role" value="candidate"> Кандидат</label>
            </div>
        </div>
        {{ csrf_field() }}

    </form>
    </div>
   <div class="create-user-buttons">
       <a class="uk-button uk-button-default create-user-button" href="{{ route('home') }}">Отмена</a>
       <button class="uk-button uk-button-primary create-user-button" id="submit-create-user-button"> Создать</button>
   </div>

    <script>
        $(function () {
            $('body').on('click', '#submit-create-user-button', function () {
               $('#create-user-form').submit();
            });
        });

    </script>
@endsection
