<!---Карточка товара-->
<div id="basket">
    <h1 class="title size-1">Оформление заказа</h1>
    <!--Список товара-->
    <div class="good-basket">
        <div class="item">
            <button type="button" class="close" aria-hidden="true" title="Удалить с корзины">&times;</button>
            <div class="row">
                <div class="image col-xs-2"><img src="/files/goods/big1.jpg"></div>
                <div class="block col-xs-10">
                    <div class="title">Lorem ipsum dolor sitamet</div>
                    <div class="min-title">women</div>
                    <div class="price">100 р.</div>
                    <div class="art">Артикул: 22-242</div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="item">
            <button type="button" class="close" aria-hidden="true" title="Удалить с корзины">&times;</button>
            <div class="row">
                <div class="image col-xs-2"><img src="/files/goods/big1.jpg"></div>
                <div class="block col-xs-10">
                    <div class="title">Lorem ipsum dolor sitamet</div>
                    <div class="min-title">women</div>
                    <div class="price">100 р.</div>
                    <div class="art">Артикул: 22-242</div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div> <!--Список товара-->

    <div class="row">
        <!--Офрмить заказ-->
        <div class="order-form col-sm-7">
            <div class="panel panel-default">
                <div class="panel-heading">Адресс доставки</div>
                <div class="panel-body">
                    <form role="form">
                        <div class="form-group">
                            <input type="text" name="fio" value=""  placeholder="ФИО" class="form-control" placeholder="Телефон" onfocus="$(this).attr('placeholder','')" onblur="$(this).attr('placeholder','ФИО')"  />
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" value=""  class="form-control"  placeholder="Телефон" onfocus="$(this).attr('placeholder','')" onblur="$(this).attr('placeholder','Телефон')" />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value=""  class="form-control"  placeholder="Email" onfocus="$(this).attr('placeholder','')" onblur="$(this).attr('placeholder','Email')" >
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" value="" class="form-control"  placeholder="Адрес" onfocus="$(this).attr('placeholder','')" onblur="$(this).attr('placeholder','Адрес')" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3" placeholder="Комментарий " onfocus="$(this).attr('placeholder','')" onblur="$(this).attr('placeholder','Комментарий')"></textarea>
                        </div>
                        <label>Способ Доставки</label>
                        <div class="radio form-group">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Почта россия - 300 p.
                            </label>
                        </div>
                        <div class="radio form-group">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Самовывоз - бесплатно.
                            </label>
                        </div>

                    </form>
                </div>
            </div>

        </div><!--/Офрмить заказ-->
        <div class="total col-sm-5">
            <table class="table">
                <tr>
                    <td>Стоимость</td>
                    <td><b>13 516 руб.</b></td>
                </tr>
                <tr>
                    <td>Доставка</td>
                    <td>бесплатно</td>
                </tr>
                <tr>
                    <td>ИТОГО</td>
                    <td><b>13 516 руб.</b></td>
                </tr>
            </table>
            <div class="button_vinous"><div>Оформить</div></div>
        </div>

    </div>
</div>
<!--Карточка товара-->
