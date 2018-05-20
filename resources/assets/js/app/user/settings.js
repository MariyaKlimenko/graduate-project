import UIkit from "../../uikit.min";

export default {
    bindEvents () {

        if(localStorage.getItem('status')){
            UIkit.notification({message: 'Изменения сохранены.', status: 'success', pos: 'top-right'});
            localStorage.clear();
        }

        const body = $('body');

        body.on('click', '#change-pass-button', function () {
            const data = $('#change-password-form').serializeArray();
            $.ajax({
                url: "/password/change",
                type: "POST",
                data: data,
                success: function(response) {
                    window.location.replace('/settings');
                },
                error: function (response) {
                    $('.change-password-errors').html('<p class="uk-text-danger">' +
                        '<i class="icon ion-alert uk-text-danger"></i> ' + response.responseJSON.error + '</p>')

                }
            });
        });

        body.on('click', '#configure-jira-button', function () {
            const data = $('#configure-jira-form').serializeArray();
            $.ajax({
                url: "/jira/configure",
                type: "POST",
                data: data,
                success: function(response) {
                    localStorage.setItem('status', 'saved');
                    location.reload();
                },
                error: function (response) {

                }
            });
        });

    },

    init () {
        this.bindEvents();
    }
}
