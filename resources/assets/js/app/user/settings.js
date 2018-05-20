export default {
    bindEvents () {

        const body = $('body');

        body.on('click', '#change-pass-button', function () {
            const data = $('#change-password-form').serializeArray();
            $.ajax({
                url: "/password/change",
                type: "POST",
                data: data,
                success: function(response) {
                    console.log('success');

                    console.log(response);

                    //window.location.replace('/users/show/' + response.user.id);
                },
                error: function (response) {
                    console.log(response);
                    $('.change-password-errors').html('<p class="uk-text-danger">' +
                        '<i class="icon ion-alert uk-text-danger"></i> ' + response.responseJSON.error + '</p>')

                }
            });
        });

    },

    init () {
        this.bindEvents();
    }
}
