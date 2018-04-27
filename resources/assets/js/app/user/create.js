
export default {
    bindEvents () {
        const body = $('body');

        let educationIndex = 0;
        const divider = '<hr class="uk-divider-icon">\n';

        const today = new Date();
        const maxYear = today.getFullYear();
        const minYear = maxYear-35;
        let educationYear;

        function setEducationYearOptions() {
            for(let i = maxYear; i >= minYear; i--) {
                educationYear += '<option value="' + i + '">' + i +'</option>';
            }

            $('.education-year-select').append(educationYear);
        }

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

        body.on('click', '#submit-create-user-button', function () {
            $('#create-user-form').submit();
        });

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
    },

    init () {
        this.bindEvents();
    }
}