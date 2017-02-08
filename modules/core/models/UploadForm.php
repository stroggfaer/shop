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
    public $path;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'extensions' => 'png, jpg, gif', 'maxFiles' => 250],
        ];
    }

    public function upload()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        // Путь к пвпке;
        $pathFiles = $_SERVER['DOCUMENT_ROOT'].$this->path;
        // Загрузка Файлов;
        if ($this->validate()) {
            $files = array();
            foreach ($this->imageFiles as $file) {
                $filename = self::getRandomFileName($pathFiles.$file->baseName,$file->extension);
                $file->saveAs($pathFiles.$filename.'.'.$file->extension);
                $files = $this->path.$filename.'.'.$file->extension;
            }
            return $response->data = ['upload'=> true,'pathFiles'=>$files];
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



