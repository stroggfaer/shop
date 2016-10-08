<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property integer $status
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Goods[] $goods
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    /*
    public function rules()
    {
        return [
            [['parent_id', 'status'], 'integer'],
            [['title'], 'required'],
            [['title', 'seo_title', 'seo_keywords'], 'string', 'max' => 128],
            [['seo_description'], 'string', 'max' => 400],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }*/

    /**
     * @inheritdoc
     */
    /*
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'status' => 'Status',
        ];
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['category_id' => 'id']);
    }
    static function getCategoryAll()
    {
        return Category::find()->where(['status'=> 1])->orderBy('id')->indexBy('id')->asArray()->all();
    }
    static function getCategoryRow($id)
    {
        //print_arr($this->id);
        return Category::find()->where(['status'=> 1,'id'=>$id])->one();
    }
    // Загрухзка дерево категория;
    static function getTree()
    {
        $category = self::getCategoryAll();
        $tree = [];
        foreach ($category as $id=>&$node) {
            if (empty($node['parent_id']) && !$node['parent_id']) {
                $tree[$id] = &$node;
            }else {
                 $category[$node['parent_id']]['group'][$node['id']] = &$node;
            }
        }
        return $tree;
    }


}
