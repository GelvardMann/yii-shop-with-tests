<?php

namespace common\modules\shop\models\backend\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\shop\models\backend\ProductTag;

/**
 * ProductTagSearch represents the model behind the search form of `common\modules\shop\models\backend\ProductTag`.
 */
class ProductTagSearch extends ProductTag
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['product_id', 'tag_id'], 'integer'],
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
        $query = ProductTag::find()->with(['product', 'tag']);

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
            'product_id' => $this->product_id,
            'tag_id' => $this->tag_id,
        ]);

        return $dataProvider;
    }
}
