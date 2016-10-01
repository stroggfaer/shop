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

        }
         ?>
            <div class="item">
                <div class="images"><a href="/"><img src="/files/goods/big1.jpg" alt=""> </a></div>
                <div class="block">
                    <div class="title">Lorem ipsum dolor sitamet<span class="min-title">women</span></div>
                    <div class="price">2 003 р. <span class="price-discount">1 000 р.</span></div>
                    <div class="button_green"><div>Купить</div></div>
                </div>
            </div>
        <?php
    }
}

