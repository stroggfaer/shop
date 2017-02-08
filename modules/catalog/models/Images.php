<?php

namespace app\modules\catalog\models;
use app\modules\catalog\models\Goods;
use app\modules\core\models\ImagesCore;
use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $good_id
 * @property string $hash
 * @property integer $type
 * @property string $exp
 * @property integer $status
 *
 * @property Goods $good
 */
class Images extends \yii\db\ActiveRecord
{

    public $images;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['good_id', 'type', 'status'], 'integer'],
            [['hash'], 'string', 'max' => 32],
            [['exp'], 'string', 'max' => 12],
            ['exp','default', 'value' => 'jpg'],
            [['good_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['good_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'good_id' => 'Good ID',
            'hash' => 'Hash',
            'type' => 'Type',
            'exp' => 'Exp',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGood()
    {
        return $this->hasOne(Goods::className(), ['id' => 'good_id']);
    }
    // Обновления запись изображения;
    public static function getInsertImages($good_id,$hash = false) {
        if($good_id) {
            // Добавить запись
            $imagesUpdate = new Images();
            $imagesUpdate->good_id = $good_id;
            $imagesUpdate->hash = $hash;
            $imagesUpdate->type = 1;
            $imagesUpdate->status = 1;
            $imagesUpdate->save();

            // Обработка изображения;
            if ($imagesUpdate->id) {
                    $dirNameGoods = Yii::$app->params['img_max'];
                    // Обработка изображения;
                    $imagesCore = new ImagesCore($dirNameGoods . Goods::image_dir($good_id) . '/' . $imagesUpdate->hash);
                    //Параметры  (options: exact, portrait, landscape, auto, crop);
                    $imagesCore->resizeImage(Yii::$app->params['width_max'], Yii::$app->params['height_max'], 'auto');
                    //Качество избражения: 100;
                    $imagesCore->saveImage($dirNameGoods . Goods::image_dir($good_id) . '/' . $imagesUpdate->hash, Yii::$app->params['quality']);
                    return false;
            }
        }else{
            return false;
        }
    }

}
