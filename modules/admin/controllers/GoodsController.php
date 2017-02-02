<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\catalog\models\Goods;
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
        $dirNameGoods = $_SERVER['DOCUMENT_ROOT'].'/files/goods/';
        //Путь к миниатюра;
        $dirNameThumbs = $_SERVER['DOCUMENT_ROOT'].'/files/goods/thumbs/';

        $model = new Goods();
        // Загрузка изображения;
        $model_images = new UploadForm();
        // Загрузка связующий категорий;

        if ($model->load(Yii::$app->request->post()) ) {
            // Валидаций;
          //  $isValid = $model_images->validate(false);
            $session = Yii::$app->session;

            print_arr($session->getFlash('fileImages'));
            print_arr(Yii::$app->request->post());
        //   print_arr($model_images);

            die('StoP A ');
           // Обработка изображения;
           $imagesCore = new ImagesCore($dirNameGoods.'test.jpg');
           //Параметры  (options: exact, portrait, landscape, auto, crop);
           $imagesCore->resizeImage(730, 297, 'auto');
           //Качество избражения: 100;
           $imagesCore->saveImage($dirNameGoods.'test.jpg', 200);


            die('StoP B ');

            $isValid = $model->validate();
            // Добавляем запись товара;
            if($isValid) {
                if($model->save()){
                    // Добавляем запись категорий;
                    if(!empty($model->category_id)) {
                        $categoryDetails = new CategoryDetails();
                        $categoryDetails->category_id = $model->category_id;
                        $categoryDetails->good_id = $model->id;
                        $categoryDetails->status = 1;
                        $categoryDetails->save();
                    }
                }

                /*
                // Обработка изображения;
                $imagesCore = new ImagesCore($dirNameGoods.'test.jpg');
                //Параметры  (options: exact, portrait, landscape, auto, crop);
                $imagesCore->resizeImage(730, 297, 'auto');
                //Качество избражения: 100;
                $imagesCore->saveImage($dirNameGoods.'test.jpg', 200);*/
            }

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
                $categoryDetails = new CategoryDetails();
                $categoryDetails->category_id = $model->category_id;
                $categoryDetails->good_id = $model->id;
                $categoryDetails->status = 1;
                $categoryDetails->save();
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
