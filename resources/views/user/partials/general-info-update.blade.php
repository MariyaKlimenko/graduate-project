<form method="POST" action="{{ route('users/updateGeneralInfo') }}" id="update-general-info-user-form" class="uk-form-stacked"> {{ csrf_field() }}
    <input name="id"  type="hidden" value="{{ $user->id }}" required>
    <div class="uk-child-width-1-2" uk-grid>
        <div>
            <div class="uk-margin">
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">
                        Имя
                        <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                    </label>
                    <div class="uk-inline">
                        <input class="uk-input uk-form-width-large" name="name" placeholder="Имя" type="text" value="{{ $user->name }}" required autofocus>
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">
                    Фамилия
                    <span class="uk-text-danger uk-text-bold" uk-tooltip="Обязательное поле для заполнения.">*</span>
                </label>
                <div class="uk-inline">
                    <input class="uk-input uk-form-width-large" name="surname" placeholder="Фамилия" type="text" value="{{ $user->surname }}" required autofocus>
                </div>
            </div>
        </div>

        <div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Позиция</label>
                <div class="uk-inline">
                    <input class="uk-input uk-form-width-large" name="position" placeholder="Позиция" type="text" value="{{ $user->position }}" autofocus>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-uppercase" for="form-stacked-text">Отдел</label>
                <div class="uk-inline">
                    <input class="uk-input uk-form-width-large" name="department" placeholder="Отдел" type="text" value="{{ $user->department }}" autofocus>
                </div>
            </div>
        </div>
    </div>
</form>
<ul class="uk-list update-general-info-errors"></ul>
<br>
<div class="create-user-buttons">
    <a class="uk-button uk-button-default create-user-button" id="cancel-update-user-button">Отмена</a>
    <button class="uk-button uk-button-primary create-user-button" id="submit-update-user-button"> Сохранить</button>
</div>