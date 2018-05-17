export default {
    bindEvents () {

        const body = $('body');

        body.on('click', '.sync-jira-submit', function () {
            const data = $('#sync-jira-form').serializeArray();
            console.log(data);
            $('#sync-jira-form').submit();
        })

    },
    
    init () {
        this.bindEvents();
    }
}
    