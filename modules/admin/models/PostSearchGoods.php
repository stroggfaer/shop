<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Goods;
use app\modules\catalog\models\CategoryDetails;
use app\modules\catalog\models\Category;
/**
 * PostSearchGoods represents the model behind the search form about `app\modules\catalog\models\Goods`.
 */
class PostSearchGoods extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'variation_id', 'image_id', 'show_main', 'count', 'count_max', 'status'], 'integer'],
            [['name','title', 'text', 'date'], 'safe'],
            [['price', 'price_d'], 'number'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Goods::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'variation_id' => $this->variation_id,
            'image_id' => $this->image_id,
            'price' => $this->price,
            'price_d' => $this->price_d,
            'show_main' => $this->show_main,
            'count' => $this->count,
            'date' => $this->date,
            'count_max' => $this->count_max,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])->andFilterWhere(['like', 'text', $this->text]);

        $query->leftJoin(CategoryDetails::tableName(),'category_details.good_id = goods.id')
              ->leftJoin(Category::tableName(),'category_details.category_id = category.id');

        $query->select(['category.title','goods.*']);

        $query->andFilterWhere(['like', 'category.title', $this->title]);
        return $dataProvider;
    }
}
