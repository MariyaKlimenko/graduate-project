import UIkit from "../../uikit.min";

export default {
    bindEvents () {
        const body = $('body');

        /**
         * Show notification.
         */
        if(localStorage.getItem('status')){
            UIkit.notification({message: 'Изменения сохранены.', status: 'success', pos: 'top-right'});
            localStorage.clear();
        }

        /**
         * Ajax request for getting user's general info form partial for updating it.
         */
        body.on('click', '.update-general-info-button', function () {

            const id = $(this).data('id');

            $.ajax({
                url: '/users/getUpdateGeneralInfoPartial/' + id,
                type: "get",
                success: function(data) {
                    $('#general-info').html(data);
                }
            });
        });

        /**
         * Ajax request for updating user's general info
         * and handling errors.
         */
        body.on('click', '#submit-update-user-button', function () {

            $.each($('form#update-general-info-user-form :input'), function () {
                   $(this).removeClass('uk-form-danger');
            });

            let errors = $('.update-general-info-errors');

            errors.text("");

            const data = $('#update-general-info-user-form').serializeArray();

            $.ajax({
                url: "/users/updateGeneralInfo",
                type: "POST",
                data: data,
                success: function(response) {
                    localStorage.setItem('status', 'saved');
                    location.reload();
                },
                error: function (response) {
                    $.each(response.responseJSON.errors, function (key, val) {
                        errors.append('<li class="uk-text-danger">' +
                            '<i class="icon ion-alert uk-text-danger"></i> ' + val + '</li>');
                        $( "input[name='" + key + "']" ).addClass('uk-form-danger');
                    });
                }
            });
        });

        /**
         * Cancel updating of user's general info.
         */
        body.on('click', '#cancel-update-user-button', function () {
            location.reload();
        });
    },

    init () {
        this.bindEvents();
    }
}