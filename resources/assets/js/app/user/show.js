export default {
    bindEvents () {

        const body = $('body');

        body.on('click', '.sync-jira-submit', function () {
            const data = $('#sync-jira-form').serializeArray();
            console.log(data);
        })

    },
    
    init () {
        this.bindEvents();
    }
}
    