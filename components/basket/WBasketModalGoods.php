<?php

namespace app\components\basket;
use yii\base\Widget;

class WBasketModalGoods extends Widget
{

    public $basket;
    public $counts;
    public $money;

    public function init() {

        if ($this->basket === null) {
            $this->basket = false;
        }
        if ($this->counts === null) {
            $this->counts = false;
        }
        if ($this->money === null) {
            $this->money = false;
        }
        parent::init();
    }
    public function run(){

        ?>

            <div class="table-responsive" id="modal-table">
              <?php if(!empty($this->basket)): ?>
                <table class="table table-hover table-striped basket-modal-goods">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Удаления</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->basket as $id => $item):?>
                        <tr>
                            <td><img src="/files/goods/big1.jpg" alt="" class="img-rounded img"> </td>
                            <td><?= $item['name']?></td>
                            <td><?= $item['count']?></td>
                            <td><b><?= $item['price']?> р.</b></td>
                            <td><span onclick="return deleteBasket('<?= $id?>');" class="glyphicon glyphicon-remove del-item close text-danger" aria-hidden="true"></span></td>
                        </tr>
                    <?php endforeach?>
                    <tr>
                        <td colspan="4">Итого: </td>
                        <td><b><?=$this->counts?></b></td>
                    </tr>
                    <tr>
                        <td colspan="4">На сумму: </td>
                        <td><b><?=$this->money?> р.</b></td>
                    </tr>
                    </tbody>
                </table>
              <?php else: ?>
                  <div class="lead">Корзина пуста</div>
              <?php endif;?>
            </div>
        <?php
    }
}
