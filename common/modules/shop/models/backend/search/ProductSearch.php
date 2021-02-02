<?php

namespace common\modules\shop\models\backend\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\shop\models\backend\Product;

/**
 * ProductSearch represents the model behind the search form of `common\modules\shop\models\backend\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'code', 'category_id', 'new', 'sale', 'active', 'status_id', 'percent', 'price', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'alias'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
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
    public function search(array $params): ActiveDataProvider
    {
        $query = Product::find()->with(['category', 'status', 'tags', 'images'])->joinWith('productTags', false);

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
            'code' => $this->code,
            'category_id' => $this->category_id,
            'new' => $this->new,
            'sale' => $this->sale,
            'active' => $this->active,
            'status_id' => $this->status_id,
            'percent' => $this->percent,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
