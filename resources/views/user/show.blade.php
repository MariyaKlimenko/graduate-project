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

    <div id="general-info">
        <div class="uk-child-width-1-3 show-user-section"  uk-grid>
            <div>
                <div id="image-place" class="uk-inline uk-background-cover " style="background-image: url({{ asset('images/df.jpg') }});">
                @if($user->photo > "")
                        <img class="profile-image" src="{{ asset('images/' . $user->photo) }}">
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Имя
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->name }}</p>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Электронный адрес
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Телефон
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->info->phone }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Местоположение
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->info->location }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Фамилия
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->surname }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Позиция
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->position }}</p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Отдел
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p-3">{{ $user->department }}</p>
                    </div>
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

    <h3 class="show-projects-label">Проекты
        <button type="button" class="uk-button uk-button-primary uk-button-small sync-jira-button"
                uk-toggle="target: #sync-jira-modal">Синхронизировать с Jira</button>
    </h3>

    @foreach($user->projects as $project)
        @if((count($user->projects) > 1) && ($loop->iteration !=1))
            <hr class="uk-divider-icon show-user-section">
        @endif
        <div class="uk-child-width-1-2 show-user-section" uk-grid>

            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Название
                    </label>
                    <div class="uk-inline">
                        <p class="show-user-p"><b>{{ $project->name }}</b></p>
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-child-width-1-3" uk-grid>

                        <div>
                            <label class="uk-form-label show-user-label" for="form-stacked-text">
                                Начало
                            </label>
                            <div class="uk-inline">
                                <p class="show-user-p-2-3">{{ $project->started_at }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="uk-form-label show-user-label" for="form-stacked-text">
                                Окончание
                            </label>
                            <div class="uk-inline">
                                <p class="show-user-p-2-3">{{ $project->finished_at }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="uk-form-label show-user-label" for="form-stacked-text">
                                Часов на проекте
                            </label>
                            <div class="uk-inline">
                                <p class="show-user-p-2-3">{{ $project->duration }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-margin">
                    @foreach($project->labels as $label)
                        <span class="show-experience-item">
                            <span class="show-experience-name">{{ $label->name }}</span>
                        </span>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="uk-margin">
                    <label class="uk-form-label show-user-label" for="form-stacked-text">
                        Описание
                    </label>
                    <div class="uk-inline show-project-description">
                        <p class="">{{ $project->description }}</p>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
    <h3>Дополнительная информация</h3>
    <div class="uk-inline show-additional">
        <p class="show-additional-p">{{ $user->info->additional }}</p>
    </div>

</div>

<div id="sync-jira-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body sync-jira-modal">
        <h2 class="uk-modal-title">Авторизация в Jira</h2>
        <form action="{{ route('jira') }}" id="sync-jira-form" method="POST">
            {{ csrf_field() }}
            <div class="uk-margin">
                <input class="uk-input" name="login" type="text" placeholder="Логин">
            </div>
            <div class="uk-margin">
                <input class="uk-input" name="password" type="password" placeholder="Пароль">
            </div>
        </form>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
            <button class="uk-button uk-button-primary sync-jira-submit" type="button">ОК</button>
        </p>
    </div>
</div>
@endsection