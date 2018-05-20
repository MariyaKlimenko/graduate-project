@extends('layouts.app')

@section('content')
    <div class="main-heading">
        <h2>Редактирование</h2>
    </div>
    <div class="main-body">

        <form method="POST" action="" id="create-user-form" class="uk-form-stacked">
            <div class="uk-child-width-1-3" uk-grid>
                {{-- column left --}}

                <div>
                    <div id="image-place" class="uk-inline uk-background-cover " style="background-image: url({{ asset('images/df.jpg') }});">
                        @if($user->photo > "")
                            <img class="profile-image" src="{{ asset('images/' . $user->photo) }}">
                            <div class="uk-position-top-right uk-overlay uk-overlay-default delete-photo-button">
                                <button type="button" class="uk-close-large" uk-close></button></div>
                        @endif
                    </div>

                    <input type="hidden" id="max-file-size" name="MAX_FILE_SIZE" value="30000000" />
                    <div class="uk-margin">
                        <div uk-form-custom>

                            <input type="file" id="upload-file-input" name="image">
                            <button class="uk-button uk-button-default add-photo-button" type="button" tabindex="-1">Выберите фотографию</button>
                        </div>

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
                            Фамилия
                        </label>
                        <div class="uk-inline">
                            <p class="show-user-p-3">{{ $user->surname }}</p>
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
                    <br><br><br>
                </div>
                {{-- column right --}}
                <div>
                    <div class="uk-margin">
                        <label class="uk-form-label" >Позиция</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="position"
                                   placeholder="Позиция" type="text" value="{{ $user->position }}" autofocus>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Отдел</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="department"
                                   placeholder="Отдел" type="text" value="{{ $user->department  }}" autofocus>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Местоположение</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="location"
                                   placeholder="Местоположение" type="text" value="{{ $user->info->location }}" autofocus>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Моб. телефон</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="phone" placeholder="Номер телефона"
                                   type="text" value="{{ $user->info->phone }}" autofocus>
                        </div>
                    </div>

                </div>

                {{ csrf_field() }}
            </div>

            <div>
                <h3 class="uk-heading-divider">Образование</h3>
                <div id="education-field">
                    @foreach($user->education as $education)
                        @if((count($user->education) > 1) && ($loop->iteration !=1))
                            <hr class="uk-divider-icon show-user-section">
                        @endif
                            <div class="uk-child-width-1-3 education-item-form" uk-grid>
                                {{--Left column--}}
                                <div>
                                    <div class="uk-margin">

                                        <label class="uk-form-label">
                                            Страна
                                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                        </label>
                                        <div class="uk-inline">
                                            <select name="education[{{ $education->id }}][country_id]" class="uk-select uk-form-width-large" required>
                                                <option selected disabled>Выберите страну</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    <option value="{{ $education->country->id }}" selected="selected">{{ $education->country->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="uk-margin">

                                        <label class="uk-form-label">Уровень
                                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                            <i class="icon ion-help uk-text-muted" uk-tooltip="Бакалавр, магистр и т.д."></i>
                                        </label>
                                        <div class="uk-inline">
                                            <input class="uk-input uk-form-width-large" name="education[{{ $education->id }}][degree]"
                                                   placeholder="Уровень" value="{{ $education->degree }}" type="text" autofocus required>
                                        </div>
                                    </div>
                                </div>

                                {{--Middle column--}}
                                <div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" >
                                            Название ВУЗа
                                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                        </label>
                                        <div class="uk-inline">
                                            <input class="uk-input uk-form-width-large" value="{{ $education->university }}" name="education[{{ $education->id }}][university]"
                                                   placeholder="Название ВУЗа"  type="text" autofocus required>
                                        </div>
                                    </div>
                                    <div class="uk-child-width-1-2" uk-grid>
                                        <div class="uk-margin">
                                            <label class="uk-form-label">
                                                Начало обучения
                                                <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                            </label>

                                            <div class="uk-inline">
                                                <select name="education[{{ $education->id }}][started_at]"
                                                        class="uk-select uk-form-width-large year-select" required>
                                                    <option value="{{ $education->started_at }}" selected>{{ $education->started_at }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div >
                                            <label class="uk-form-label">
                                                Окончание обучения
                                            </label>

                                            <div class="uk-inline">
                                                <select name="education[{{ $education->id }}][finished_at]" id="education-finished-at-input-{{ $education->id }}"
                                                        class="uk-select  uk-form-width-large year-select" required>
                                                    <option value="{{ $education->finished_at }}" selected>{{$education->finished_at }}</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{--Right column--}}
                                <div>
                                    <div class="uk-margin">

                                        <label class="uk-form-label" >
                                            Специальность
                                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                        </label>
                                        <div class="uk-inline">
                                            <input class="uk-input uk-form-width-large" name="education[{{ $education->id }}][speciality]"
                                                   placeholder="Специальность" value="{{ $education->speciality }}" type="text" autofocus required>
                                        </div>
                                    </div>
                                    <div class="" uk-grid>
                                        <div class="uk-width-auto@m">
                                            <br>
                                            <label class="uk-form-label education-is-not-finished-label" >
                                                <input type="checkbox" class="education-is-not-finished-checkbox"
                                                       data-index="{{$education->id}}" name="education[{{ $education->id }}][is_not_finished]"
                                                @if($education->is_not_finished) checked @endif>
                                                Еще не окончено
                                            </label>
                                        </div>
                                        <div class="uk-width-expand@m">
                                            <br>
                                            <button type="button" class="uk-button uk-button-danger delete-education-item-button">
                                                Удалить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                <button type="button" id="add-education-item-button"
                        class="uk-button uk-button-primary add-item-button">
                    <span class="add-item-icon">+</span>
                </button>
            </div>

            <div>
                <h3 class="uk-heading-divider">Опыт (технологии, языки, пр.)</h3>
                <div id="experience-field">

                    @foreach($user->experiences as $experience)

                    <div class="uk-child-width-1-3 experience-item-form" uk-grid>
                        {{--Left column--}}
                        <div>
                            <div class="uk-margin" uk-grid>
                                <div class="uk-width-2-3">
                                    <input class="uk-input" name="experience[{{ $experience->id }}][name]"
                                           placeholder="Название" type="text" value="{{ $experience->name }}" required>
                                </div>
                                <div class="uk-width-1-3 experience-label">
                                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                    <i class="icon ion-help uk-text-muted" uk-tooltip="Бакалавр, магистр и т.д."></i>
                                </div>
                            </div>
                        </div>

                        {{--Middle column--}}
                        <div>

                            <div class="uk-margin" uk-grid>
                                <div class="uk-width-2-5">
                                    <input class="uk-input uk-form-width-large" name="experience[{{ $experience->id }}][duration]"
                                           placeholder="Время" min="0" type="number" value="{{ $experience->duration }}" required>
                                </div>
                                <div class="uk-width-2-5 experience-label">
                                    часов
                                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                    <i class="icon ion-help uk-text-muted" uk-tooltip="Сколько часов работали с технологией."></i>
                                </div>
                            </div>
                        </div>

                        {{--Right column--}}
                        <div>
                            <div class="uk-margin">
                                <div class="uk-width-auto@m">
                                    <button type="button" class="uk-button uk-button-danger delete-experience-item-button">
                                        Удалить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="add-experience-item-button"
                        class="uk-button uk-button-primary add-item-button">
                    <span class="add-item-icon">+</span>
                </button>
            </div>

            <div>
                <h3 class="uk-heading-divider">Проекты</h3>
                <div id="project-field">

                    @foreach($user->projects as $project)
                            <div class="project-item-form">
                                <div class="uk-child-width-1-2" uk-grid>
                                    <div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" >
                                                Название проэкта
                                                <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                            </label>
                                            <div class="uk-inline">
                                                <input class="uk-input uk-form-width-large" name="project[{{ $project->id }}][name]"
                                                       placeholder="Название проэкта"  type="text" value="{{ $project->name }}" required>
                                            </div>
                                        </div>
                                        <div class="uk-child-width-1-3" uk-grid>
                                            <div>
                                                <label class="uk-form-label">
                                                    Начало
                                                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                                </label>
                                                <div class="uk-inline">
                                                    <select name="project[][started_at]"
                                                            class="uk-select uk-form-width-large year-select" required>
                                                        <option value="{{ $project->started_at }}" selected >{{ $project->started_at }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="uk-form-label">
                                                    Окончание
                                                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                                    <i class="icon ion-help uk-text-muted" uk-tooltip="Если еще не окончен, укажите текущий год"></i>
                                                </label>
                                                <div class="uk-inline">
                                                    <select name="project[][finished_at]"
                                                            class="uk-select uk-form-width-large year-select" required>
                                                        <option value="{{ $project->finished_at }}" selected >{{ $project->finished_at }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="uk-form-label">
                                                    Длительность
                                                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                                    <i class="icon ion-help uk-text-muted" uk-tooltip="Сколько часов Вы отработали на проэкте"></i>
                                                </label>
                                                <div class="uk-inline">
                                                    <input class="uk-input uk-form-width-large" name="project[][duration]"
                                                           placeholder="Время" min="0" value="{{ $project->duration }}" type="text" autofocus required>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4>Технологии</h4>
                                            <div class="label-field" data-index="{{ $project->id }}">
                                            @foreach($project->labels as $label)
                                                <div class="label-item-form" uk-grid>
                                                    <div class="uk-width-2-5">
                                                        <input class="uk-input uk-form-width-large" name="project[{{ $project->id }}][labels][{{ $label->id }}][name]"
                                                               placeholder="Название" type="text" value="{{ $label->name }}" required>
                                                    </div>
                                                    <div class="uk-width-2-5">
                                                        <button type="button"
                                                                class="uk-button uk-button-danger delete-item-button delete-label-item-button">
                                                            <i class="icon ion-close delete-label-button-icon uk-text-muted"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button type="button" id="add-label-item-button" data-index="{{ $project->id }}"
                                                    class="uk-button uk-button-primary add-item-button">
                                                <span class="add-item-icon">+</span>
                                            </button>

                                        </div>

                                    </div>

                                    <div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" >
                                                Описание проэкта
                                                <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                                            </label>
                                            <div class="uk-inline">
                <textarea class="uk-textarea uk-form-width-large" rows="5" name="project[{{ $project->id }}][description]"
                          placeholder="Описание">{{ $project->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="uk-margin uk-align-right">
                                            <div class="uk-width-auto@m">
                                                <button type="button" class="uk-button uk-button-danger delete-project-item-button">
                                                    Удалить
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <hr class="uk-divider-icon show-user-section">
                    @endforeach
                </div>
                <button type="button" id="add-project-item-button"
                        class="uk-button uk-button-primary add-item-button">
                    <span class="add-item-icon">+</span>
                </button>
            </div>
            <div>
                <h3 class="uk-heading-divider">Дополнительная информация</h3>
                <div class="uk-inline">
                <textarea class="uk-textarea uk-form-width-large" rows="5" name="additional"
                          placeholder="Дополнительная информация">{{ $user->info->additional }}</textarea>
                </div>
            </div>
            <input type="hidden" name="photo" value="" id="user-photo-input">
        </form>

        <ul class="uk-list create-user-errors"></ul>

        <div class="create-user-buttons">
            <a class="uk-button uk-button-default create-user-button" href="{{ route('home') }}">Отмена</a>
            <button class="uk-button uk-button-primary create-user-button"
                    id="submit-create-user-button"> Сохранить</button>
        </div>
    </div>
    <br>
@endsection
