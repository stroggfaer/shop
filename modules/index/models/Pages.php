<?php

namespace app\modules\index\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $text
 * @property integer $status
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url',], 'required'],
            [['text'], 'string'],
            [['status'], 'integer'],
            [['title', 'url', 'seo_title'], 'string', 'max' => 128],
            [['seo_keywords'], 'string', 'max' => 258],
            [['seo_description'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'text' => 'Text',
            'status' => 'Status',
        ];
    }
    public static function getPages()
    {
        return Pages::find()->where(["status"=> 1])->orderBy(['id'=>SORT_ASC,])->asArray()->all();
    }
    public static function getPageRow($url)
    {
        return Pages::find()->where(["url"=>$url,"status"=> 1])->limit(1)->asArray()->one();;
    }
}
