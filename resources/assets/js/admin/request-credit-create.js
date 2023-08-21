'use strict';

$(function () {
    const select2 = $('.select2'),
        selectPicker = $('.selectpicker');

    if (selectPicker.length) {
        selectPicker.selectpicker();
    }

    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
        });
    }
    let dealers = $('#attr_dealer_text'),
        brands = $('#attr_brand_text'),
        downPayment = $('#attr_down_payment_text'),
        dealerText = $('.attr_dealer_text_other-container'),
        brandsText = $('.attr_brand_text_other-container'),
        downPaymentText = $('.attr_down_payment_text_other-container');

    if (dealers.select2('data').pop().text === 'Other') dealerText.show();
    else dealerText.hide();

    if (downPayment.select2('data').pop().text === 'Other') downPaymentText.show();
    else downPaymentText.hide()

    if (brands.select2('data').pop().text === 'Other') brandsText.show()
    else brandsText.hide()

});

(function () {
    const wizardIconsModern = document.querySelector('.wizard-modern-icons'),
        creditTypes = $("input[name='credit_type']");

    console.log($("input[name='credit_type']:checked").val())
    disableByTypes($("input[name='credit_type']:checked").val());

    if (typeof wizardIconsModern !== undefined && wizardIconsModern !== null) {
        const wizardIconsModernBtnNextList = [].slice.call(wizardIconsModern.querySelectorAll('.btn-next')),
            wizardIconsModernBtnPrevList = [].slice.call(wizardIconsModern.querySelectorAll('.btn-prev')),
            wizardIconsModernBtnSubmit = wizardIconsModern.querySelector('.btn-submit');

        const modernIconsStepper = new Stepper(wizardIconsModern, {
            linear: false
        });

        if (wizardIconsModernBtnNextList) {
            wizardIconsModernBtnNextList.forEach(wizardIconsModernBtnNext => {
                wizardIconsModernBtnNext.addEventListener('click', event => {
                    modernIconsStepper.next();
                });
            });
        }
        if (wizardIconsModernBtnPrevList) {
            wizardIconsModernBtnPrevList.forEach(wizardIconsModernBtnPrev => {
                wizardIconsModernBtnPrev.addEventListener('click', event => {
                    modernIconsStepper.previous();
                });
            });
        }
    }

    let dealers = $('#attr_dealer_text'),
        brands = $('#attr_brand_text'),
        downPayment = $('#attr_down_payment_text'),
        dealerText = $('.attr_dealer_text_other-container'),
        brandsText = $('.attr_brand_text_other-container'),
        downPaymentText = $('.attr_down_payment_text_other-container');

    downPayment.on("change", function (e) {
        if (downPayment.select2('data').pop().text === 'Other') {
            downPaymentText.show()
        } else {
            downPaymentText.hide()
        }
    });

    dealers.on("change", function (e) {
        if (dealers.select2('data').pop().text === 'Other') {
            dealerText.show()
        } else {
            dealerText.hide()
        }
    });

    brands.on("change", function (e) {
        if (brands.select2('data').pop().text === 'Other') {
            brandsText.show()
        } else {
            brandsText.hide()
        }
    });

    creditTypes.on('change', function (e) {
        disableByTypes($(this).val());
    });

    $("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        }
    });
    function disableByTypes(types) {
        let personalSelector = $('.personal-container'),
            businessSelector = $('.business-container');

        if (types === 'individu') {
            personalSelector.find('input').prop('disabled', false);
            personalSelector.find('select').prop('disabled', false);

            businessSelector.find('input').prop('disabled', true);
            businessSelector.find('select').prop('disabled', true);

            businessSelector.hide();
            personalSelector.show();
        } else if (types === 'badan_usaha') {
            personalSelector.find('input').prop('disabled', true);
            personalSelector.find('select').prop('disabled', true);

            businessSelector.find('input').prop('disabled', false);
            businessSelector.find('select').prop('disabled', false);

            businessSelector.show();
            personalSelector.hide();
        }
    }

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function formatCurrency(input, blur) {
        var input_val = input.val();
        if (input_val === "") {
            return;
        }

        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");

        if (input_val.indexOf(".") >= 0) {
            var decimal_pos = input_val.indexOf(".");

            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            left_side = formatNumber(left_side);
            right_side = formatNumber(right_side);

            if (blur === "blur") {
                right_side += "00";
            }

            right_side = right_side.substring(0, 2);

            input_val = left_side + "." + right_side;

        } else {
            input_val = formatNumber(input_val);
            if (blur === "blur") {
                input_val += ".00";
            }
        }

        input.val(input_val);

        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

})();
