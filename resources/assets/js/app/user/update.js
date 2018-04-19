import UIkit from "../../uikit.min";

export default {
    bindEvents () {
        const body = $('body');

        if(localStorage.getItem('status')){
            UIkit.notification({message: 'Изменения сохранены.', status: 'success', pos: 'top-right'});
            localStorage.clear();
        }

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

        body.on('click', '#submit-update-user-button', function () {

            const data = $('#update-general-info-user-form').serializeArray();

            $.ajax({
                url: "/users/updateGeneralInfo",
                type: "POST",
                data: data,
                success: function(response) {
                localStorage.setItem('status', 'saved');
                location.reload();
                }
            });
        });

        body.on('click', '#cancel-update-user-button', function () {
            location.reload();
        });
    },

    init () {
        this.bindEvents();
    }
}