@extends('layouts.app')

@section('content')
    <h2 >Создать нового пользователя</h2>
    <form method="POST" action="{{ route('storeUser') }}" id="create-user-form" class="uk-form-stacked">
        <div class="uk-child-width-1-2" uk-grid>
        {{-- column left --}}
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">
                        Имя
                        <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                    </label>
                    <div class="uk-inline">
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
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">
                        Фамилия
                        <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                    </label>
                    <div class="uk-inline">
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
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">
                        Электронный адрес
                        <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                    </label>
                    <div class="uk-inline">
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
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">
                        Роль
                        <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                    </label>
                    <div class="uk-margin uk-grid-small ">
                        <label><input class="uk-radio" type="radio" name="role" value="moderator"> Сотрудник (модератор)</label><br>
                        <label><input class="uk-radio" type="radio" name="role"  value="employee" checked> Сотрудник</label><br>
                        <label><input class="uk-radio" type="radio" name="role" value="candidate"> Кандидат</label>
                    </div>
                </div>
            </div>
            {{-- column right --}}
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Позиция</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="position" placeholder="Позиция" type="text" value="{{ old('position') }}" autofocus>
                    </div>
                    @if ($errors->has('position'))
                        <br>
                        <span class="uk-text-danger">
                                {{ $errors->first('position') }}
                        </span>
                    @endif
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Отдел</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="department" placeholder="Отдел" type="text" value="{{ old('department') }}" autofocus>
                    </div>
                    @if ($errors->has('department'))
                        <br>
                        <span class="uk-text-danger">
                                {{ $errors->first('department') }}
                        </span>
                    @endif
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Местоположение</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="location" placeholder="Местоположение" type="text" value="{{ old('location') }}" autofocus>
                    </div>
                    @if ($errors->has('location'))
                        <br>
                        <span class="uk-text-danger">
                                {{ $errors->first('location') }}
                                </span>
                    @endif
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Моб. телефон</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="phone" placeholder="Номер телефона" type="text" value="{{ old('phone') }}" autofocus>
                    </div>
                    @if ($errors->has('phone'))
                        <br>
                        <span class="uk-text-danger">
                                {{ $errors->first('phone') }}
                        </span>
                    @endif
                </div>

            </div>

        {{ csrf_field() }}
        </div>
    </form>

   <div class="create-user-buttons">
       <a class="uk-button uk-button-default create-user-button" href="{{ route('home') }}">Отмена</a>
       <button class="uk-button uk-button-primary create-user-button" id="submit-create-user-button"> Создать</button>
   </div>

@endsection
