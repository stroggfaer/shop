<?php

namespace app\components;
use app\modules\index\models\Pages;
use yii\base\Widget;

class WMenu extends Widget{
    public $key;
    public function run(){
        $pagesMenu = Pages::getPages();
         ?>
        <div class="menu">
            <div class="item"><a href="/" class="i open">Главная</a></div>
            <?php foreach($pagesMenu as $key=>$menu):?>
                <div class="item"><a href="/pages/<?=$menu['url'];?>" class="i"><?=$menu['title'];?></a></div>
            <?php endforeach; ?>
               <div class="item"><a href="/admin/" class="i">Админ</a></div>
        </div>
        <?php
    }
}

