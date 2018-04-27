
<div class="uk-child-width-1-3 education-item-form" uk-grid>
    {{--Left column--}}
    <div>
        <div class="uk-margin">

            <label class="uk-form-label">Страна</label>
            <div class="uk-inline">
                <select name="education-country-id[{{ $index }}]" class="uk-select uk-form-width-large" required>
                    <option selected disabled>Выберите страну</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="uk-margin">

            <label class="uk-form-label">Уровень <i class="icon ion-help uk-text-muted"
                                                    uk-tooltip="Бакалавр, магистр и т.д."></i>
            </label>
            <div class="uk-inline">
                <input class="uk-input uk-form-width-large" name="education-degree[{{ $index }}]"
                       placeholder="Уровень" type="text" autofocus required>
            </div>
        </div>
    </div>

    {{--Middle column--}}
    <div>
        <div class="uk-margin">
            <label class="uk-form-label" >Название ВУЗа</label>
            <div class="uk-inline">
                <input class="uk-input uk-form-width-large" name="education-university[{{ $index }}]"
                       placeholder="Название ВУЗа"  type="text" autofocus required>
            </div>
        </div>
        <div class="uk-child-width-1-2" uk-grid>
            <div class="uk-margin">
                <label class="uk-form-label">Начало обучения</label>

                <div class="uk-inline">
                    <select name="education-started-at[{{ $index }}]"
                            class="uk-select uk-form-width-large education-year-select" required>
                        <option value="" selected disabled>Выберите год</option>
                    </select>
                </div>
            </div>
            <div >
                <label class="uk-form-label">Окончание обучения</label>

                <div class="uk-inline">
                    <select name="education-finished-at[{{ $index }}]"
                            class="uk-select  uk-form-width-large education-year-select" required>
                        <option value="" selected disabled>Выберите год</option>
                        <option value="is-not-finished">Еще не окончено</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    {{--Right column--}}
    <div>
        <div class="uk-margin">

            <label class="uk-form-label" >Специальность</label>
            <div class="uk-inline">
                <input class="uk-input uk-form-width-large" name="education-speciality[{{ $index }}]"
                       placeholder="Специальность" value="" type="text" autofocus required>
            </div>
        </div>
        <div class="uk-child-width-1-2 uk-flex-right" uk-grid>
            <div>
                <br>
                <button type="button" class="uk-button uk-button-danger delete-education-item-button">
                    Удалить
                </button>
            </div>
        </div>
    </div>
</div>