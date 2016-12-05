<?php

namespace app\components;
use yii\base\Widget;
use app\modules\index\models\MyHelper;

class WGoodsItem extends Widget{
    public $model;
    public $key;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
        if ($this->key === null) {
            $this->key = false;
        }
    }
    public function run(){
        if(!$this->model){
            return false;
        }else {

            ?>
            <div class="item">
                <div class="images"><a href="/catalog/good/<?=$this->model->id?>"><img src="/files/goods/big1.jpg" alt=""> </a></div>
                <div class="block">
                    <div class="title"><?=$this->model->name?>  <?=$this->model->count_max?><span class="min-title">women</span></div>
                    <div class="price"><?=MyHelper::money($this->model->price)?> р. <?=($this->model->price_d > 0) ? '<span class="price-discount">'.MyHelper::money($this->model->price_d).' р.</span>' : ''?></div>
                    <div class="button_green js-add-card" onclick="addBasket('<?=$this->model->id?>',true);"><div>Купить</div></div>
                </div>
            </div>
        <?php
        }
    }
}

