@extends('layouts.app')

@section('content')
    <div class="main-heading">
        <h2 >Создать нового пользователя</h2>
    </div>
    <div class="main-body">

        <form method="POST" action="" id="create-user-form" class="uk-form-stacked">
            <div class="uk-child-width-1-3" uk-grid>
            {{-- column left --}}

                <div>
                    <div id="image-place" class="uk-inline uk-background-cover " style="background-image: url({{ asset('images/df.jpg') }});">
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
                        <label class="uk-form-label">
                            Имя
                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                        </label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="name" placeholder="Имя"
                                   type="text" value="{{ old('name') }}" required autofocus />
                        </div>
                        @if ($errors->has('name'))
                            <br>
                            <span class="uk-text-danger">
                                    {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">
                            Фамилия
                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                        </label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="surname" placeholder="Фамилия"
                                   type="text" value="{{ old('surname') }}" required autofocus>
                        </div>
                        @if ($errors->has('surname'))
                            <br>
                            <span class="uk-text-danger">
                                    {{ $errors->first('surname') }}
                                    </span>
                        @endif
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">
                            Электронный адрес
                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                        </label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="email" placeholder="Эл. адресс"
                                   type="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                            <br>
                            <span class="uk-text-danger">
                                    {{ $errors->first('email') }}
                                    </span>
                        @endif
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">
                            Роль
                            <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                        </label>
                        <div class="uk-margin uk-grid-small ">
                            @level($roleLevels['administrator'])
                                <label><input class="uk-radio" type="radio" name="role" value="moderator"> Сотрудник (модератор)</label><br>
                            @endlevel
                            <label><input class="uk-radio" type="radio" name="role"  value="employee" checked> Сотрудник</label><br>
                            <label><input class="uk-radio" type="radio" name="role" value="candidate"> Кандидат</label>
                        </div>
                    </div>
                </div>
                {{-- column right --}}
                <div>
                    <div class="uk-margin">
                        <label class="uk-form-label" >Позиция</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="position"
                                   placeholder="Позиция" type="text" value="{{ old('position') }}" autofocus>
                        </div>
                        @if ($errors->has('position'))
                            <br>
                            <span class="uk-text-danger">
                                    {{ $errors->first('position') }}
                            </span>
                        @endif
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Отдел</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="department"
                                   placeholder="Отдел" type="text" value="{{ old('department') }}" autofocus>
                        </div>
                        @if ($errors->has('department'))
                            <br>
                            <span class="uk-text-danger">
                                    {{ $errors->first('department') }}
                            </span>
                        @endif
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Местоположение</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="location"
                                   placeholder="Местоположение" type="text" value="{{ old('location') }}" autofocus>
                        </div>
                        @if ($errors->has('location'))
                            <br>
                            <span class="uk-text-danger">
                                    {{ $errors->first('location') }}
                                    </span>
                        @endif
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Моб. телефон</label>
                        <div class="uk-inline">
                            <input class="uk-input uk-form-width-large" name="phone" placeholder="Номер телефона"
                                   type="text" value="{{ old('phone') }}" autofocus>
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

            <div>
                <h3 class="uk-heading-divider">Образование</h3>
                <div id="education-field"></div>
                <button type="button" id="add-education-item-button"
                        class="uk-button uk-button-primary add-item-button">
                   <span class="add-item-icon">+</span>
                </button>
            </div>

            <div>
                <h3 class="uk-heading-divider">Опыт (технологии, языки, пр.)</h3>
                <div id="experience-field"></div>
                <button type="button" id="add-experience-item-button"
                        class="uk-button uk-button-primary add-item-button">
                    <span class="add-item-icon">+</span>
                </button>
            </div>

            <div>
                <h3 class="uk-heading-divider">Проекты</h3>
                <div id="project-field"></div>
                <button type="button" id="add-project-item-button"
                        class="uk-button uk-button-primary add-item-button">
                    <span class="add-item-icon">+</span>
                </button>
            </div>
            <div>
                <h3 class="uk-heading-divider">Дополнительная информация</h3>
                <div class="uk-inline">
                <textarea class="uk-textarea uk-form-width-large" rows="5" name="additional"
                          placeholder="Дополнительная информация">{{ old('additional') }}</textarea>
                </div>
            </div>
            <input type="hidden" name="photo" value="" id="user-photo-input">
        </form>

        <ul class="uk-list create-user-errors"></ul>

        <div class="create-user-buttons">
           <a class="uk-button uk-button-default create-user-button" href="{{ route('home') }}">Отмена</a>
           <button class="uk-button uk-button-primary create-user-button"
                   id="submit-create-user-button"> Создать</button>
       </div>
    </div>
    <br>
@endsection
