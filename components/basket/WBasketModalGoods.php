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
        <?php if(!empty($this->basket)): ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
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
                            <td>+</td>
                            <td><?= $item['name']?></td>
                            <td><?= $item['count']?></td>
                            <td><b><?= $item['price']?> р.</b></td>
                            <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
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
            </div>
        <?php else: ?>
            <h3>Корзина пуста</h3>
        <?php endif;?>
        <?php
    }
}
