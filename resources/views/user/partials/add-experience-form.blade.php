<div class="uk-child-width-1-3 experience-item-form" uk-grid>
    {{--Left column--}}
    <div>
        <div class="uk-margin" uk-grid>
            <div class="uk-width-2-3">
                <input class="uk-input" name="experience[{{ $index }}][name]"
                       placeholder="Название" type="text" autofocus required>
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
                <input class="uk-input uk-form-width-large" name="experience[{{ $index }}][duration]"
                       placeholder="Время" min="0" type="number" autofocus required>
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