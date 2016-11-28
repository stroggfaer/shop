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