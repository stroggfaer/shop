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
        $response->format = \yii\web\Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $session->open();

        $model = new UploadForm();
       // print_arr(Yii::$app->request->post());
        if (Yii::$app->request->isPost) {

            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                     //$session['fileImages'] = $response->data['pathFiles'];
                $pathFiles = array();

                $pathFiles[Yii::$app->request->post('file_id')]['path'] = $response->data['pathFiles'];
                $session->setFlash('fileImages',$pathFiles);

                if(empty(Yii::$app->request->post('good_id')) &&  Yii::$app->request->post('file_id') > 0){
                   // echo 'A';
                }else{
                   // echo 'B';
                }



                // file is uploaded successfully
                return true;
            }
        }
        return false;
    }
}