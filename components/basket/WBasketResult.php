<?php

namespace app\components\basket;
use yii\base\Widget;

class WBasketResult extends Widget
{

    public $result;


    public function init() {

        if ($this->result === null) {
            $this->result = false;
        }
        parent::init();
    }
    public function run(){

        ?>
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

        <?php
    }
}
