<?php

namespace app\components\basket;
use yii\base\Widget;

class WBasketResult extends Widget
{

    public $model;


    public function init() {

        if ($this->model === null) {
            $this->model = false;
        }
        parent::init();
    }
    public function run(){
         if(empty($this->model)) {
             return false;
         }else {
             ?>
             <table class="table">
                 <tr>
                     <td>Стоимость</td>
                     <td><b><?=$this->model['money']?> руб.</b></td>
                 </tr>
                 <tr>
                     <td>Доставка</td>
                     <td><?=$this->model['price']?> руб.</td>
                 </tr>
                 <tr>
                     <td>ИТОГО</td>
                     <td><b><?=$this->model['total_money']?> руб.</b></td>
                 </tr>
             </table>
             <?php
         }
    }
}
