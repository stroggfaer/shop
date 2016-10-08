<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 04.10.2016
 * Time: 20:35
 */

namespace app\components;
use app\modules\catalog\models\Category;
use yii\base\Widget;

class WCategory extends Widget{

    public $category;

    public function run(){
        // Загрузка категрия;
        $category = Category::getTree();
        ?>
        <div class="navbar">
            <div class="nav">
                <?php foreach ($category as $key=>$item): ?>
                  <div class="item <?= (isset($item['group']) && !empty($item['group']) ? 'groups': '')?>">
                      <a href="/catalog/<?=$item['id']; ?>"><?php if(isset($item['group']) && !empty($item['group'])): ?>  <span class="open-down"></span><?php endif;?><?=$item['title']?></a>
                       <?php if(isset($item['group']) && !empty($item['group'])):?>
                           <?php foreach ($item['group'] as $k=>$i): ?>
                               <?=\app\components\html\WTree::widget(['group'=>$i,'parent_id'=>$i['id']])?>
                           <?php endforeach;?>
                       <?php endif;?>
                  </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php
    }
}
