/**
 * For WordPress start
 */
function onChangeTitlePopup(service, formId) {
    let form = $(formId);
    let title = form.find('.js-change-title');
    let change = '';

    // заполняем попап тайтлом
    if (formId === '#know_more')
        change = 'Хотели бы узнать больше об услуге ' + service.toLowerCase() + '?';
    else if (formId === '#cost_modal')
        change = service;

    $(title).text(change);

    // находим кнопку и добавляем скрытое поле
    let input = createHiddenInput('order_title', change);
    if (form.find('input[name=order_title]').length)
        form.find('input[name=order_title]').val(change);
    else
        form.find('.js-btn').after(input);
}

function createHiddenInput(name, title) {
    let input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", name);
    input.setAttribute("value", title);

    return input;
}

function inputOnlyNumbers(input) {
    var value = input.value;
    var rep = /[-\.;":'a-zA-Zа-яА-Я]/;
    if (rep.test(value)) {
        value = value.replace(rep, '');
        input.value = value;
    }
}

document.addEventListener('DOMContentLoaded', function(){ // Аналог $(document).ready(function(){
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        $.fancybox.close();
        $.fancybox.open({href: '#conection'});
        setTimeout(function () {
            $('.order_form').trigger('reset').find('.focus').removeClass('focus');
        }, 300);
    }, false );

    // находим все input телефоны и отменяем ввод букв
    $('input[type=tel], input[name ^= tel]').on('keyup',function(){
        inputOnlyNumbers($(this));
    })
});

// для cf7: переносим все label прямо под input
$('form.wpcf7-form').each(function(e){
    var $form = $(this);

    $form.find('.form-group').each(function(){
        var label = $(this).find('label');
        $(this).find('input').after(label);
    });

});
/**
 * For WordPress end
 */