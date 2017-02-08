<?php

namespace app\components\basket;
use yii\base\Widget;
use app\modules\core\models\MyHelper;
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
                     <td><b><?= MyHelper::money($this->model['money'])?> руб.</b></td>
                 </tr>
                 <tr>
                     <td>Доставка</td>
                     <td><b><?=MyHelper::money($this->model['price'])?> руб.</b></td>
                 </tr>
                 <tr>
                     <td>ИТОГО</td>
                     <td><b><?=MyHelper::money($this->model['total_money'])?> руб.</b></td>
                 </tr>
             </table>
             <?php
         }
    }
}
