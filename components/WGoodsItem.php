<?php

namespace app\components;
use yii\base\Widget;

class WGoodsItem extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
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
                    <div class="price"><?=$this->model->price?> р. <?=($this->model->price_d > 0) ? '<span class="price-discount">'.$this->model->price_d.' р.</span>' : ''?></div>
                    <div class="button_green js-add-card" data-good-id="<?=$this->model->id?>" onclick="addBasket('<?=$this->model->id?>');"><div>Купить</div></div>
                </div>
            </div>
        <?php
        }
    }
}

