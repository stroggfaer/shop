$(document).ready(function(){



});

// Добавления товар в корзину;
function addBasket(id,modal) {
    $.ajax({
        url: '/ajax-basket/add-basket',
        type: 'POST',
        data:{'addBasket' : true, 'id' : id},
        success: function(response){
            if(response.length > 0) {
                if(modal) modalBasketShow(response);
                updateBasket();
            }else{
                console.log("Ошибка");
                return false;
            }
        },
        error: function(){
            alert('Error!');
        }
    });

 return false;
}
// Модальная окно корзины;
function modalBasketShow(response){
    $('#basket-modal .modal-body').html(response);
    $('#basket-modal').modal();
}
// Удалить товар с корзины;
function deleteBasket(id) {
    $.post('/ajax-basket/delete-basket',{'deleteBasket':true,'modal':true,'id':id},function(response){
        $("#modal-table").html(response);
        updateBasket();
    });
}
// Очистить товар с корзины;
function clearBasket() {
    $("#modal-table").load('/ajax-basket/delete-basket #modal-table',{'clearBasket':true},function(response){
        updateBasket();
    });
}
// Обновления корзины;
function updateBasket() {
    $.post(window.location.href,function(html){
         $("div.cart","#header").html($(html).find("div.cart","#header").html());
         if($("#basket").length) $("#basket").html($(html).find("#basket").html());
        return false;
    });
}