<?php

namespace app\modules\catalog\models;
use app\modules\catalog\models\CategoryDetails;
use app\modules\core\models\UploadForm;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property integer $variation_id
 * @property integer $image_id
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

    public $category_id;
    public $title;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variation_id', 'image_id', 'show_main', 'count', 'count_max','category_id', 'status'], 'integer'],
            [['name','price'], 'required'],
            [['text'], 'string'],
            ['text','default', 'value' => ''],
            ['date', 'default', 'value' => date('Y-m-d H:s')],
            ['count','default', 'value' => 1],
            ['count_max','default', 'value' => 1],
            ['price_d','default', 'value' => 0],
            [['price', 'price_d'], 'number'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Images::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' =>"Категория",
            'variation_id' => 'Variation ID',
            'image_id' => 'Image ID',
            'name' => 'Name',
            'text' => 'Text',
            'price' => 'Price',
            'price_d' => 'Price D',
            'show_main' => 'Show Main',
            'count' => 'Count',
            'date' => 'Date',
            'count_max' => 'Count Max',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryDetails()
    {
        return $this->hasMany(CategoryDetails::className(), ['good_id' => 'id']);
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
