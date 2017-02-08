<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\catalog\models\Goods;
use app\modules\catalog\models\Images;
use app\modules\catalog\models\CategoryDetails;
use app\modules\catalog\models\Category;
use app\modules\admin\models\PostSearchGoods;
use app\modules\admin\controllers\BackendController;
use app\modules\core\models\UploadForm;
use app\modules\core\models\ImagesCore;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearchGoods();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      //  $test = Images::getUpdateImages(1000040);

        //print_arr($test);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(!empty($model->categoryDetails[0])) {
            $model->title = Category::find()->where(['id'=>$model->categoryDetails[0]->category_id])->one()->title;
        }

        return $this->render('view', [
            'model' => $model,

        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //Путь изображения;
        $dirNameGoods = Yii::$app->params['img_max'];
        //Путь к миниатюра;
       // $dirNameThumbs = Yii::$app->params['img_min'];

        $model = new Goods();
        // Загрузка изображения;
        $model_images = new UploadForm();
        // Загрузка связующий категорий;

        if ($model->load(Yii::$app->request->post()) ) {
            $session = Yii::$app->session;

            // Добавляем запись товара;
            if($model->validate()) {
                if($model->save()){
                    // Добавляем запись категорий;
                    if(!empty($model->category_id)) {
                        $categoryDetails = new CategoryDetails();
                        $categoryDetails->category_id = $model->category_id;
                        $categoryDetails->good_id = $model->id;
                        $categoryDetails->status = 1;
                        $categoryDetails->save();
                    }
                    // Создаем директории;
                    if (!mkdir($dirNameGoods.$model->image_dir($model->id),0777, true)) {
                        $session->remove('fileImages');
                        return 'Не удалось создать директории...';
                    }
                    // Добавляем изображения
                    $fileSession = ($session['fileImages'] ? $session['fileImages'][key($session['fileImages'])] : false);
                    // Обработка файл в сессий;
                    if($fileSession['pathFiles']) {
                        foreach($fileSession['pathFiles'] as $key => $pathUploads) {
                            $fileName = explode('/',$pathUploads);
                            $fileName = end($fileName);
                            // Добавления запись;
                            if($model->id) {
                                $images = new Images();
                                $images->good_id = $model->id;
                                $images->hash = $fileName;
                                $images->type = 1;
                                $images->status = 1;
                                $images->save();
                                // Обработка изображения;
                                if($images->id) {
                                    // Поверка файл;
                                    if (!file_exists($_SERVER['DOCUMENT_ROOT'].$pathUploads)) {
                                        $session->remove('fileImages');
                                        return 'Не найден файл';
                                    }
                                    // Перемещаем файл;
                                    rename($_SERVER['DOCUMENT_ROOT'] . $pathUploads, $dirNameGoods . $model->image_dir($model->id) . '/' . $fileName);
                                    // Обработка изображения;
                                    $imagesCore = new ImagesCore($dirNameGoods . $model->image_dir($model->id) . '/' . $fileName);
                                    //Параметры  (options: exact, portrait, landscape, auto, crop);
                                    $imagesCore->resizeImage(Yii::$app->params['width_max'], Yii::$app->params['height_max'], 'auto');
                                    //Качество избражения: 100;
                                    $imagesCore->saveImage($dirNameGoods . $model->image_dir($model->id) . '/' . $fileName, Yii::$app->params['quality']);
                                }
                            }
                        }
                    }
                }
            }
            // Унистоженения сессия;
            if($session['fileImages']) $session->remove('fileImages');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model_images->validate(false);
            return $this->render('create', [
                'model' => $model,
                'model_images'=> $model_images,
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_images = new UploadForm();

        // Загрузка категория;
        if(!empty($model->categoryDetails[0])) {
            $model->category_id = $model->categoryDetails[0]->category_id;
        }
        if ($model->load(Yii::$app->request->post()) &&  $model->save()) {
            // Добавляем запись категорий;
            if(!empty($model->category_id)) {
                $categoryDetails = CategoryDetails::findOne($model->categoryDetails[0]->id);
                $categoryDetails->category_id = $model->category_id;
                $categoryDetails->good_id = $model->id;
                $categoryDetails->status = 1;
                $categoryDetails->save();
            }
            //Путь изображения;

            // Загрузка изображения;
            foreach($model->images as $key => $image) {
                // Обновления запись;
                if($image) {

//                    $imagesUpdate = Images::findOne($image->id);
//                    $imagesUpdate->good_id = $model->id;
//                    $imagesUpdate->hash = $image->hash;
//                    $imagesUpdate->type = 1;
//                    $imagesUpdate->status = 1;
//                    $imagesUpdate->save();
                    // Обработка изображения;
                    /*
                    if($imagesUpdate->id) {
                       // $model_images->upload($dirNameGoods.$image->hash);
                        $model_images->path = $dirNameGoods.$image->hash;
                        // Обработка изображения;
                        $imagesCore = new ImagesCore($dirNameGoods . $model->image_dir($model->id) . '/' . $image->hash);
                        //Параметры  (options: exact, portrait, landscape, auto, crop);
                        $imagesCore->resizeImage(Yii::$app->params['width_max'], Yii::$app->params['height_max'], 'auto');
                        //Качество избражения: 100;
                        $imagesCore->saveImage($dirNameGoods . $model->image_dir($model->id) . '/' . $image->hash, Yii::$app->params['quality']);
                    }*/

                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_images' => $model_images,
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
