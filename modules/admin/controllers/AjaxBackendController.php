<?php

namespace app\modules\admin\controllers;
use app\modules\admin\controllers\BackendController;
use app\modules\catalog\models\Goods;
use app\modules\catalog\models\Images;
use app\modules\basket\models\Basket;
use app\modules\basket\models\Address;
use app\modules\core\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

class AjaxBackendController extends BackendController
{
    // Загрузка несколько файлов;
    public function actionFileUpload()
    {
        // Ответ данные JSON-формат;
        $response = Yii::$app->response;
        $request = Yii::$app->request;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return $response->data = ['success' => true];
            }
        }
        return false;
    }
}