$(document).ready(function(){



});

// Добавления товар в корзину;
function addBasket(id) {
    $.ajax({
        url: '/ajax-basket/add-basket',
        type: 'POST',
        dataType:'JSON',
        data:{'addBasket' : true, 'id' : id},
        success: function(response){
            if(response.id) {
                $("div.cart .counts","#header").text(response.countsBasket);
                $("div.cart .money","#header").text(response.basketMoney + ' p.');
                modalBasketShow(response);
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
    $('#basket-modal .modal-body').html(response.id);
    $('#basket-modal').modal();
}