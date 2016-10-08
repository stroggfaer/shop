<?php

namespace app\modules\catalog\models;
use app\modules\catalog\models\CategoryDetails;
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


    // Загрузка все товары;
    public static function getGoodsAll()
    {
        return Goods::find()->leftJoin(CategoryDetails::tableName(),'category_details.good_id = goods.id')->where(['category_details.status'=> 1,'goods.status'=>1])->orderBy('goods.date ASC')->all();
    }

    public static function getGoodsCategoryAll($id)
    {
        return Goods::find()->leftJoin(CategoryDetails::tableName(),'category_details.good_id = goods.id')->where(['category_details.status'=> 1,'goods.status'=>1,'category_details.category_id'=> $id])->orderBy('goods.date ASC')->all();
    }
    // Загрузка товаров каталог;
    public function getItemGoods($params,$pageSize = 20){
        $query = Goods::find()->leftJoin(CategoryDetails::tableName(),'category_details.good_id = goods.id')->where(['category_details.status'=> 1,'goods.status'=>1])->orderBy('goods.date ASC');
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
                'defaultPageSize' => false,
                'pageParam' => 'page',
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ]
        ]);
        $this->load($params);
        return $dataProvider;
    }
    // Загрузка товаров по категорией + пагинаций;
    public function getItemGoodsRow($params,$pageSize = 20,$id){
        $query = Goods::find()->leftJoin(CategoryDetails::tableName(),'category_details.good_id = goods.id')->where(['category_details.status'=> 1,'goods.status'=>1,'category_details.category_id'=> $id])->orderBy('goods.date ASC');

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
                'defaultPageSize' => false,
                'pageParam' => 'page',
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ]
        ]);
        $this->load($params);
        return $dataProvider;
    }
}
