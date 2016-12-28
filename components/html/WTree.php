<?php
namespace app\components\html;

use yii\base\Widget;
class WTree extends Widget{

    public $group;
    public $parent_id;

    public function init(){

        parent::init();

        if( $this->group === null ){
            $this->group = false;
        }
        if( $this->parent_id === null ){
            $this->parent_id = false;
        }

    }
    public function run(){?>
        <div class="i <?= (isset($this->group['group']) && !empty($this->group['group']) ? 'groups': '')?>">
            <a href="/catalog/<?=$this->group['id']; ?>"><?=$this->group['title']?><?php if(isset($this->group['group']) && !empty($this->group['group'])): ?>  <span class="open-down"></span><?php endif;?></a>
                <?php if(isset($this->group['group']) && !empty($this->group['group'])):?>
                     <?php foreach ($this->group['group'] as $k=>$i): ?>
                        <?=\app\components\html\WTree::widget(['group'=>$i,'parent_id'=>$i['id']])?>
                     <?php endforeach;?>
                <?php endif;?>
          </div>
        <?php
    }
}