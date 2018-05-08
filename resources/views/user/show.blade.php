@extends('layouts.app')

@section('content')

<div class="main-heading" >
    <div uk-grid>
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
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Имя
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Фамилия
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->surname }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Позиция
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p">{{ $user->position }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Отдел
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
                <label class="uk-form-label show-user-label" for="form-stacked-text">
                    Местоположение
                </label>
                <div class="uk-inline">
                    <p class="show-user-p">{{ $user->info->location }}</p>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label show-user-label" for="form-stacked-text">
                    Телефон
                </label>
                <div class="uk-inline">
                    <p class="show-user-p">{{ $user->info->phone }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-margin">
                <label class="uk-form-label show-user-label" for="form-stacked-text">
                    Электронный адрес<
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
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Страна
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->country->name }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Уровень
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->degree }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Университет
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->university }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Период обучения
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
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Специальность
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $education->speciality }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <h3>Опыт</h3>

   @foreach($user->experiences as $experience)
        <span class="show-experience-item">
            <span class="show-experience-name">{{ $experience->name }}</span>
            {{ $experience->duration }} ч.
        </span>
   @endforeach


</div>
@endsection