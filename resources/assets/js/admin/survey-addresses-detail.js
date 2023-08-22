'use strict'

$(function () {

    $('.form-repeater-container').on('submit', function (e) {
        e.preventDefault();
    });

    let rowSurveyAddress = 2;
    let colSurveyAddress = 1;

    $('.survey_address-repeater').repeater({
        show: function () {
            let fromControl = $(this).find('.form-control, .form-select');
            let formLabel = $(this).find('.form-label');

            fromControl.each(function (i) {
                let id = 'form-repeater-' + rowSurveyAddress + '-' + colSurveyAddress;
                $(fromControl[i]).attr('id', id);
                $(formLabel[i]).attr('for', id);
                colSurveyAddress++;
            });

            rowSurveyAddress++;

            $(this).slideDown();
        },

        hide: function (e) {
            confirm('Are you sure you want to delete this element?') && $(this).slideUp(e);
        }
    });

});
