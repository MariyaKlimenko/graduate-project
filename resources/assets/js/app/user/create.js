
export default {
    bindEvents () {
        const body = $('body');

        let educationIndex = 0;
        const divider = '<hr class="uk-divider-icon">\n';

        const today = new Date();
        const maxYear = today.getFullYear();
        const minYear = maxYear-35;
        let educationYear;

        /**
         * Sets education's year range into select options.
         */
        function setEducationYearOptions() {
            for(let i = maxYear; i >= minYear; i--) {
                educationYear += '<option value="' + i + '">' + i +'</option>';
            }

            $('.education-year-select').append(educationYear);
        }

        /**
         * Ajax request for deleting user.
         */
        body.on('click', '.delete-education-item-button', function () {
            const block = $(this).parents('div.education-item-form');

            if (block.prev('hr').length > 0) {
                block.prev('hr').remove();
            } else {
                if(block.next('hr').length > 0 ) {
                    block.next('hr').remove();
                }
            }
            block.remove();
        });

        /**
         * Enable/disable select item for finished-at year.
         */
        body.on('change', '.education-is-not-finished-checkbox', function () {
            let input = $('#education-finished-at-input-' + $(this).data('index'));
            if($(this).prop('checked')) {
                input.prop('disabled', true);
            } else {
                input.prop('disabled', false);
            }
        });

        /**
         * Ajax request for getting new education form view partial
         * and setting it to main form.
         */
        body.on('click', '#add-education-item-button', function () {
            educationIndex++;

            let edicationField = $('#education-field');

            $.ajax({
                url: '/users/getAddEducationItemPartial/' + educationIndex,
                type: "get",
                success: function(data) {
                    if (!edicationField.is(':empty')) {
                        edicationField.append(divider);
                    }

                    edicationField.append(data);
                    setEducationYearOptions();
                }
            });
        });

        /**
         * Ajax request for storing new user
         * and hsndling errors of validation.
         */
        body.on('click', '#submit-create-user-button', function () {

            $.each($('form#create-user-form :input'), function () {
                $(this).removeClass('uk-form-danger');
            });

            let errors = $('.create-user-errors');

            errors.text("");

            const data = $('#create-user-form').serializeArray();

            $.ajax({
                url: "/users/store",
                type: "POST",
                data: data,
                success: function(response) {
                    window.location.replace('/users/show/' + response.user.id);
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
    },

    init () {
        this.bindEvents();
    }
}