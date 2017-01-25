/**
 * Created by Strogg on 20.11.2016.
 */
$(document).ready(function(){


});

// Обработка полей;
$(document).on('focus','input.placeholder[placeholder]',function(){
    $(this).attr('placeholder','');
    return false;
});
$(document).on('blur','input.placeholder[placeholder]',function(){
    $(this).attr('placeholder',$(this).attr('data-text'));
    return false;
});
// +7
$(document) .on('focus','input.phone',function() {
    $(this).parents('.form-group').siblings('span.phone').show();
    $(this).siblings('span.phone').show();
    $(this).css("padding-left","25px");
}).on('blur','input.phone',function() {
    if($(this).val() == '') {
        $(this).parents('.form-group').siblings('span.phone').hide();
        $(this).siblings('span.phone').hide();
        $(this).css("padding-left","12px");
    }
});

// Ввод цифр;
$(document).on("keypress", "input.number", function(e) {
    var charCode = (e.which) ? e.which : event.keyCode;
    if (charCode != 8 && (charCode < 48 || charCode > 57)) return false;
    return true;
});

// Ввод номера телефона;
$(document).on("keypress", "input.phone", function(e) {
    var charCode = (e.which) ? e.which : event.keyCode;
    if (charCode != 8 && charCode != 43 && (charCode < 48 || charCode > 57)) return false;
    return true;
});
// Запрет спецсимвол;
$(document).on("keypress", "input.special", function(e) {
    return specialCharacter(this,/^[a-zа-я]*$/i);
});

function specialCharacter(id,regex) {
    var element = id;
    if (element) {
        var lastValue = element.value;
        if (!regex.test(lastValue))
            lastValue = '';
        setInterval(function () {
            var value = element.value;
            if (value != lastValue) {
                if (regex.test(value))
                    lastValue = value;
                else
                    element.value = lastValue;
            }
        }, 10);
    }
}
