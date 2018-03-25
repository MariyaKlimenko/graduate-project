
export default {
    bindEvents () {
        const body = $('body');

        body.on('click', '#submit-create-user-button', function () {
            $('#create-user-form').submit();
        });
    },

    init () {
        this.bindEvents();
    }
}