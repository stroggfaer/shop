<?php

namespace app\modules\admin\controllers;
use app\modules\core\models\UploadForm;
use app\modules\core\models\ImagesCore;
use app\modules\catalog\models\Images;
use yii\web\UploadedFile;
use Yii;

class AjaxBackendController extends BackendController
{
    // Загрузка несколько файлов;
    public function actionFileUpload()
    {
        $model = new UploadForm();
        // Путь по умолчание;
        $model->path = '/files/uploads/';

        // Ответ данные JSON-формат;
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $session->open();

        $image_id = Yii::$app->request->post('image_id');
        $file_id = Yii::$app->request->post('file_id');

        // Записываем сессия; id;
        if(Yii::$app->request->post('good_id') !== 'null' ) {
            // Путь директорий;
            $dirFiles = $_SERVER['DOCUMENT_ROOT'].Yii::$app->request->post('path');
            // Проверка на дирикторий;
            if(!is_dir($dirFiles)) {
                // Если нет папки то создаем;
                if (!mkdir($dirFiles,0777, true)) return 'Не удалось создать директории...';
                $model->path = Yii::$app->request->post('path');
            }else{
                $model->path = Yii::$app->request->post('path');
            }
        }else{
            // Создаем запись путь директорий;
            if(empty($_SESSION['fileImages'][$image_id])) {
                $_SESSION['fileImages'][$image_id]['image_id'] = true;
            }
        }

        // Загрузка фотография;
        if (Yii::$app->request->isPost) {

            // Объект параметрый изображения;
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($model->upload()) {
                     //$session['fileImages'] = $response->data['pathFiles'];
                    // Обработка путь директорий;
                    if($session['fileImages']) {
                        foreach($session['fileImages'] as $key=>$value) {
                            if($key == $image_id) {
                                $_SESSION['fileImages'][$image_id]['pathFiles'][$file_id] = $response->data['pathFiles'];
                            }else{
                                unset($_SESSION['fileImages'][$key]);
                            }
                        }
                    }
                    // Обновления запись;
                    if(Yii::$app->request->post('good_id') !== 'null' ) {
                        $fileName = explode('/',$response->data['pathFiles']);
                        $fileName = end($fileName);
                        Images::getInsertImages(Yii::$app->request->post('good_id'),$fileName);
                    }
                return true;
            }
        }
        return false;
    }


}