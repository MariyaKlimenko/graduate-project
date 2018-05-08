<div class="label-item-form" uk-grid>
    <div class="uk-width-2-5">
        <input class="uk-input uk-form-width-large" name="project[{{ $index }}][labels][{{ $labelIndex }}][name]"
               placeholder="Название" type="text" autofocus required>
    </div>
    <div class="uk-width-2-5">
        <input class="uk-input uk-form-width-large" name="project[{{ $index }}][labels][{{ $labelIndex }}][count]"
               placeholder="Количество тасков" type="number" autofocus required>
    </div>
    <div class="uk-width-1-5">

        <button type="button"
                class="uk-button uk-button-danger delete-item-button delete-label-item-button">
            <i class="icon ion-close delete-label-button-icon uk-text-muted"></i>
        </button>
    </div>
</div>