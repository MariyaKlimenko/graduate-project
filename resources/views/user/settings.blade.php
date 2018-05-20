@extends('layouts.app')

@section('content')

    <div class="main-heading" >
        <div uk-grid>
            <div class="uk-width-2-3">
                <h2 class="uk-heading">Настройки</h2>
            </div>
        </div>
    </div>
    <div class="main-body">

        <h3 class="uk-heading-divider">Конфигурация Jira</h3>
        <form action="" method="POST" id="configure-jira-form" class="uk-form-stacked">
            <div class="show-additional">
                <div class="uk-margin">
                    <label class="uk-form-label">URL</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="jira"
                               placeholder="example.atlassian.net" value="{{ $jira }}" type="text">
                    </div>
                </div>
            </div>
            {{ csrf_field() }}
            <button type="button" id="configure-jira-button" class="uk-button uk-button-primary change-password-button">Сохранить</button>
        </form>


        <h3 class="uk-heading-divider">Изменить пароль</h3>
        <form action="{{ route('password/change') }}" method="POST" id="change-password-form" class="uk-form-stacked">
            <div class="show-additional">
                <div class="uk-margin">
                    <label class="uk-form-label">Старый пароль</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="old_password"
                               placeholder="Старый пароль" type="password" autofocus>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Новый пароль</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="new_password"
                               placeholder="Новый пароль" type="password" autofocus>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Подтвердите новый пароль</label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="confirm_password"
                               placeholder="Подтвердите новый пароль" type="password" autofocus>
                    </div>
                </div>
                <div class="change-password-errors"></div>
            </div>
            {{ csrf_field() }}
            <button type="button" id="change-pass-button" class="uk-button uk-button-primary change-password-button">Сохранить</button>
        </form>

    </div>

@endsection