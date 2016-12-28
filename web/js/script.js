$(document).ready(function(){
    // Слайдер;
    $('div.slides div.items').owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        autoPlay : false,
        singleItem :true,

        itemsTabletSmall: false,
    });
    // Карусель для миниатюр;
    $('div.images-carousel div.items').owlCarousel({
        items: 3,
        responsive: true,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsMobile : [479,1]
    });

    /*Закрываем область*/
    $("#br-shadow").on('click',function(){
        $('#header div.menu-content,#br-shadow').hide();
        $("#nav-toggle").removeClass('active');
    });
    /*Меню закрыть раскрыть*/
    $('#nav-toggle').on('click',function(){
        $(this).toggleClass('active');
        $('#header div.menu-content').slideToggle();
        //$('#br-shadow').toggle();
    });
    /**/

});
/*Каталог открыть вложеный или закрыть*/
$(document).on('click','div.navbar div.groups',function(){
  //  $(this).children('div.i').toggle();
  //  return false;
});


/*Чекпоинт*/
$(window).resize(function() {
    var winWidth = $(window).width();
    if(winWidth >= 991) {
        $('#header div.menu-content').css('display','block');
        $("#nav-toggle").removeClass('active');
    }else if(winWidth <= 991){
        $('#header div.menu-content').css('display','none');
    }
});


// Выбор доставки;
$(document).on("change","#address-delivery_id input", function(event) {
    event.preventDefault();
    $.pjax.reload({
        method: "POST",
        url: '/ajax-basket/result-money',
        container: "#pjax-delivery_id",
        replace: false,
        data: {'delivery_id': $(this).val()},
        success:function(data){
            console.log("Success works!");
        },
    });
});

// Вход ЛК;
$(document).on("submit", '#login-form', function(event) {
    event.preventDefault();
    return $.pjax.submit(event,'#pjax-container-logon',{"url":"/site/login","push": false,"replace":false,"scrollTo":false});
});
//jQuery(document).pjax("#w0 a", "#w0", {"push":true,"replace":false,"timeout":1000,"scrollTo":false});
//jQuery(document).on('submit', "#w0 form[data-pjax]", function (event) {jQuery.pjax.submit(event, '#w0', {"push":true,"replace":false,"timeout":1000,"scrollTo":false});});
$(document).on('ready pjax:success', function() {

});
