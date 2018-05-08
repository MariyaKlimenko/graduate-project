<div class="project-item-form">
    <div class="uk-child-width-1-2" uk-grid>
        <div>
            <div class="uk-margin">
                <label class="uk-form-label" >
                    Название проэкта
                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                </label>
                <div class="uk-inline">
                    <input class="uk-input uk-form-width-large" name="project[{{ $index }}][name]"
                           placeholder="Название проэкта"  type="text" autofocus required>
                </div>
            </div>
            <div class="uk-child-width-1-3" uk-grid>
                <div>
                    <label class="uk-form-label">
                        Начало
                        <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                    </label>
                    <div class="uk-inline">
                        <select name="project[{{ $index }}][started_at]"
                                class="uk-select uk-form-width-large year-select" required>
                            <option value="" selected disabled>Выберите год</option>
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
                        <select name="project[{{ $index }}][finished_at]"
                                class="uk-select uk-form-width-large year-select" required>
                            <option value="" selected disabled>Выберите год</option>
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
                        <input class="uk-input uk-form-width-large" name="project[{{ $index }}][duration]"
                               placeholder="Время" min="0" type="number" autofocus required>
                    </div>
                </div>
            </div>
            <div>
                <h4>Технологии</h4>
                <div class="label-field" data-index="{{ $index }}"></div>
                <button type="button" id="add-label-item-button" data-index="{{ $index }}"
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
                <textarea class="uk-textarea uk-form-width-large" rows="5" name="project[{{ $index }}][description]"
                          placeholder="Описание"></textarea>
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
