@extends('layouts.app')

@section('content')

<div class="main-heading" uk-grid>
    <div class="uk-width-2-3">
        <h2 class="uk-heading">{{ $user->name }} {{ $user->surname }}
            @if(auth()->user()->id == $user->id)
                <small> (мой профиль)</small>
            @endif
            @level($roleLevels['moderator'])
            <p class="uk-text-muted heading-role"> {{ $userRoleName }} </p></small>
            @endlevel
        </h2>
    </div>
    <div class="uk-width-1-3 show-user-updated-at">
        Обновлено {{ date_format($user->updated_at, 'd.m.Y H:i:s') }}
    </div>


</div>
<div class="main-body">

    <h3>Общая информация
        @if($authUserRole->level >= $roleLevels['moderator'] && $authUserRole->level > $userRoleLevel)
            <i class="icon ion-compose table-icon-button update-general-info-button" data-id="{{$user->id}}"></i>
        @endif
    </h3>
    <div id="general-info">
        <div class="uk-child-width-1-2 show-user-section"  uk-grid>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Имя</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Фамилия</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->surname }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Позиция</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->position }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Отдел</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->department }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>Контакты</h3>
    <div class="uk-child-width-1-2 show-user-section" uk-grid>
        <div>
            <div class="uk-margin">
                <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                    <small>Местоположение</small>
                </label>
                <div class="uk-inline">
                    <p class="show-user-p">{{ $user->info->location }}</p>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                    <small>Телефон</small>
                </label>
                <div class="uk-inline">
                    <p class="show-user-p">{{ $user->info->phone }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-margin">
                <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                    <small>Электронный адрес</small>
                </label>
                <div class="uk-inline">
                    <p class="show-user-p">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Образование</h3>

    @foreach($user->education as $education)
        @if((count($user->education) > 1) && ($loop->iteration !=1))
            <hr class="uk-divider-icon show-user-section">
        @endif
        <div class="uk-child-width-1-3 show-user-section" uk-grid>

            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Страна</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->country->name }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Уровень</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->degree }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Университет</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->university }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Период обучения</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->started_at }}
                            -
                        @if($education->is_not_finished)
                            настоящее время
                        @else
                            {{$education->finished_at}}
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label uk-text-uppercase" for="form-stacked-text">
                        <small>Специальность</small>
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->speciality }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection