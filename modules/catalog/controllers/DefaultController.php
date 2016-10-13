<?php

namespace app\modules\catalog\controllers;
use app\modules\catalog\models\Category;
use app\modules\index\controllers\AppController;
use app\modules\catalog\models\Goods;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
/**
 * Default controller for the `catalog` module
 */
class DefaultController extends AppController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Goods;
        $dataProvider = $model->getItemGoods(Yii::$app->request->queryParams,20);
            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
    }
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $model = new Goods;
        $category = Category::getCategoryRow($id);
        if(empty($category)) throw new \yii\web\HttpException(404, 'Такого товара нет');
        $dataProvider = $model->getItemGoodsRow(Yii::$app->request->queryParams,20,$id);

        // Хлебная крошка;
        $breadcrumbsCatalog = '';

            return $this->render('view', [
                'model' => $model,
                'category' => $category,
                'dataProvider' => $dataProvider,
            ]);

    }
    public function actionGood($id)
    {
        $id = Yii::$app->request->get('id');
        return $this->render('good', [
            'model' => $this->findModel($id),

        ]);
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
