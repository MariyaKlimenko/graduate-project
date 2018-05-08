
<div class="uk-child-width-1-3 education-item-form" uk-grid>
    {{--Left column--}}
    <div>
        <div class="uk-margin">

            <label class="uk-form-label">
                Страна
                <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
            </label>
            <div class="uk-inline">
                <select name="education[{{ $index }}][country_id]" class="uk-select uk-form-width-large" required>
                    <option selected disabled>Выберите страну</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                <input class="uk-input uk-form-width-large" name="education[{{ $index }}][degree]"
                       placeholder="Уровень" type="text" autofocus required>
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
                <input class="uk-input uk-form-width-large" name="education[{{ $index }}][university]"
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
                    <select name="education[{{ $index }}][started_at]"
                            class="uk-select uk-form-width-large year-select" required>
                        <option value="" selected disabled>Выберите год</option>
                    </select>
                </div>
            </div>
            <div >
                <label class="uk-form-label">
                    Окончание обучения
                </label>

                <div class="uk-inline">
                    <select name="education[{{ $index }}][finished_at]" id="education-finished-at-input-{{ $index }}"
                            class="uk-select  uk-form-width-large year-select" required>
                        <option value="" selected disabled>Выберите год</option>
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
                <input class="uk-input uk-form-width-large" name="education[{{ $index }}][speciality]"
                       placeholder="Специальность" value="" type="text" autofocus required>
            </div>
        </div>
        <div class="" uk-grid>
            <div class="uk-width-auto@m">
                <br>
                <label class="uk-form-label education-is-not-finished-label" >
                    <input type="checkbox" class="education-is-not-finished-checkbox"
                           data-index="{{$index}}" name="education[{{ $index }}][is_not_finished]">
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