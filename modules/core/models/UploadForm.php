<?php
namespace app\modules\core\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif', 'maxFiles' => 250],
        ];
    }

    public function upload($path = '/files/uploads/')
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        // Путь к пвпке;
        $pathFiles = $_SERVER['DOCUMENT_ROOT'].$path;
        // Загрузка Файлов;
        if ($this->validate()) {
            $path = array();
            foreach ($this->imageFiles as $file) {
                $filename = self::getRandomFileName($pathFiles.$file->baseName,$file->extension);
                $file->saveAs($pathFiles.$filename.'.'.$file->extension);
                $path = $pathFiles.$filename.'.'.$file->extension;
            }
            return $response->data = ['upload'=> true,'pathFiles'=>$path];
        } else {
            return false;
        }
    }

    // Генерация уникального имени файла;
    public  function getRandomFileName($path, $extension='',$params = 10)
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        do {
            $name = substr(md5(microtime() . rand(0, 9999)), 0, $params);
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }

}



