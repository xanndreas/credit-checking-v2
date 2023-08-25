'use strict'

$(function () {

    $('.form-repeater-container').on('submit', function (e) {
        e.preventDefault();
    });

    let rowSurveyAddress = 2;
    let colSurveyAddress = 1;

    let surveyAddressRepeater = $('.survey_address-repeater').repeater({
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

    let surveyAddressInit = null;
    if (surveyAddressRepeater !== 'undefined') {
        let creditType = $('#credit_type').val();
        if (creditType === 'individu') {
            surveyAddressInit = [{
                'address_type': 'domicile',
            }, {
                'address_type': 'guarantor',
            }, {
                'address_type': 'office',
            }];
        } else if (creditType === 'badan_usaha') {
            surveyAddressInit = [{
                'address_type': 'shareholder',
            }, {
                'address_type': 'office',
            }];
        }
    }

    surveyAddressRepeater.setList(surveyAddressInit);

    $('.btn-assign').on('click', function () {
        $('.request_credit_id').val($(this).data('request-credit-id'));
        $('.assign-form').attr('action', '/admin/survey-addresses/' + ($(this).data('survey-addresses-id')))
    });

});
