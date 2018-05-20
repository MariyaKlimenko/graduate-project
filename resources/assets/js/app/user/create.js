import UIkit from './../../uikit.min.js';

export default {
    bindEvents () {


        const body = $('body');

        let delPhotoBut = '<div class="uk-position-top-right uk-overlay uk-overlay-default delete-photo-button">\n' +
            '        <button type="button" class="uk-close-large" uk-close></button>\n' +
            '    </div>\n';



        $('#upload-file-input').change(function () {

            let imagePlace = $('#image-place');
            let formData = new FormData();

            let file = $('#upload-file-input')[0].files;

            let fileSize =$('#max-file-size').value;

            formData.append('MAX_FILE_SIZE', fileSize);

            formData.append('image', file[0], file[0].name);

            $.ajax({
                url: "/users/picture/upload",
                type: "POST",
                processData: false,
                contentType:false,
                dataType: 'json',
                data: formData,
                success: function(response) {
                    imagePlace.html(response.html);
                    imagePlace.append(delPhotoBut);
                    $('#user-photo-input').val(response.imageName);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
        });



        let educationIndex = 0;
        let experienceIndex = 0;
        let projectIndex = 0;
        let labelIndex = 0;

        const divider = '<h5 class="uk-heading-divider divider"></h5>\n';

        const today = new Date();
        const maxYear = today.getFullYear();
        const minYear = maxYear-35;
        let educationYear;

        /**
         * Sets education's year range into select options.
         */
        function setYearOptions() {
            for(let i = maxYear; i >= minYear; i--) {
                educationYear += '<option value="' + i + '">' + i +'</option>';
            }

            $('.year-select').append(educationYear);
        }

        /**
         * Ajax request for deleting education item.
         */
        body.on('click', '.delete-education-item-button', function () {
            const block = $(this).parents('div.education-item-form');

            if (block.prev('h5').length > 0) {
                block.prev('h5').remove();
            } else {
                if(block.next('h5').length > 0 ) {
                    block.next('h5').remove();
                }
            }
            block.remove();
        });

        body.on('click', '.delete-project-item-button', function () {
            const block = $(this).parents('div.project-item-form');

            block.next('h5').remove();

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
                    setYearOptions();
                }
            });
        });


        body.on('click', '#add-label-item-button', function () {
            labelIndex++;
            let index = $(this).data('index');

            let labelField = $('.label-field[data-index="' + index +'"]');

            $.ajax({
                url: '/users/getAddLabelItemPartial/' + index + '/' + labelIndex,
                type: "get",
                success: function(data) {
                    labelField.append(data);
                }
            });
        });


        body.on('click', '#add-project-item-button', function () {
            projectIndex++;

            let projectField = $('#project-field');

            $.ajax({
                url: '/users/getAddProjectItemPartial/' + projectIndex,
                type: "get",
                success: function(data) {
                    projectField.append(data);
                    projectField.append(divider);

                    setYearOptions();
                }
            });
        });


        body.on('click', '#add-experience-item-button', function () {
            experienceIndex++;

            let experienceField = $('#experience-field');

            $.ajax({
                url: '/users/getAddExperienceItemPartial/' + experienceIndex,
                type: "get",
                success: function(data) {
                    experienceField.append(data);
                }
            });
        });

        body.on('click', '.delete-experience-item-button', function () {
            $(this).parents('div.experience-item-form').remove();
        });

        body.on('click', '.delete-label-item-button', function () {
            $(this).parents('div.label-item-form').remove();
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

            console.log(data);
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

        body.on('click', '.delete-photo-button', function () {
            console.log('kik');
            $('#user-photo-input').val('');
            $('#image-place').empty();
        });

    },

    init () {
        this.bindEvents();
    }
}