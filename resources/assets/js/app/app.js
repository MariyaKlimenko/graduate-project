
export default {
    bindEvents () {
        const body = $('body');

        body.on('click', '#logout-button', function () {
            $('#logout-form').submit();
        });

    },
    init () {
        this.bindEvents();
    }
}