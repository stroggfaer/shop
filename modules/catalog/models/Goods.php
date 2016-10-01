<?php

namespace app\modules\catalog\models;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property integer $variation_id
 * @property integer $image_id
 * @property integer $category_id
 * @property string $title
 * @property string $text
 * @property string $price
 * @property string $price_d
 * @property integer $show_main
 * @property string $data
 * @property integer $status
 *
 * @property Images $image
 * @property Category $category
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    // Загрузка все товары;
    public static function getGoodsAll()
    {
        return Goods::find()->where(['status'=> 1])->orderBy('date ASC')->all();
    }
    public function getItemGoods($params,$pageSize = 20){
        $query =  Goods::find()->where(['status'=> 1]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'attributes'=>[
                    'name',
                ]
            ],
            'pagination' => [
                'pageSize' => $pageSize,
                'defaultPageSize' => 20,
                'pageParam' => 'page',
                'forcePageParam' => false,
            ]
        ]);
        $this->load($params);
        return $dataProvider;
    }
}
