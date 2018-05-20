export default {
    bindEvents () {

        const body = $('body');

        body.on('click', '.sync-jira-submit', function () {
            const data = $('#sync-jira-form').serializeArray();
            console.log(data);
            $('#sync-jira-form').submit();
        });

        body.on('click', '.save-pdf-button', function () {
            window.location ="/users/pdf/" + $(this).data('id');
        });

        body.on('click', '.update-user-button', function () {
            window.location ="/user/update/" + $(this).data('id');
        });


    },
    
    init () {
        this.bindEvents();
    }
}
    