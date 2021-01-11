<?php

namespace app\modelsSearch;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products as ProductsModel;
use app\models\CategoryProduct;
use yii\helpers\ArrayHelper;
use \app\models\Categories;

/**
 * Products represents the model behind the search form of `app\models\Products`.
 */
class Products extends ProductsModel
{
    public $category;
    public $price_from;
    public $price_to;
    public $product;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at', 'type'], 'integer'],
            [['name', 'description', 'article', 'article_inner', 'meta_title', 'meta_keywords', 'meta_description', 'url'], 'safe'],
            [['price'], 'number'],
            [['category'], 'integer'],
            [['price_from'], 'number'],
            [['price_to'], 'number'],
            ['product','safe'],
        ];
    }

    public function attributeLabels()
    {
        $attribute_labels = [
            'category' => 'Категория',
            'price_from' => 'Цена от',
            'price_to' => 'Цена до',
        ];
        return ArrayHelper::merge($attribute_labels, parent::attributeLabels());
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
        $query = ProductsModel::find();

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
        // фильтр по цене от
        if ($this->price_from) {
            $query->andFilterWhere([
                '>=','price', $this->price_from
            ]);
        }
        // фильтр по цене до
        if ($this->price_to) {
            $query->andFilterWhere([
                '<=','price', $this->price_to
            ]);
        }
        // фильтр по категориям
        if($this->category) {

            $query
                ->join('LEFT JOIN', CategoryProduct::tableName() . ' c2p', 'c2p.`product_id` = `products`.`id`')
                ->join('INNER JOIN', Categories::tableName(). ' cc', 'cc.`id` = c2p.`category_id`')
                ->join('LEFT JOIN', Categories::tableName(). ' cp', 'cp.`id` = cc.parent');

            $query->andFilterWhere([
                'or',
                ['cp.id' => $this->category],
                ['cc.id' => $this->category],
            ]);

            $query->andFilterWhere([
                'cp.status' => Categories::STATUS_ACTIVE,
                'cc.status' => Categories::STATUS_ACTIVE,
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'article_inner', $this->article_inner])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
    /*
     * Запрос к фронту
     *
     * @param array $params
     *
     * @return ActiveDataProvider     * */
    public function searchFront($params)
    {
        $query = ProductsModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
                'forcePageParam' => false,
//                'route' => '',
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // фильтр по цене от
        if ($this->price_from) {
            $query->andFilterWhere([
                '>=','price', $this->price_from
            ]);
        }
        // фильтр по цене до
        if ($this->price_to) {
            $query->andFilterWhere([
                '<=','price', $this->price_to
            ]);
        }
        // фильтр по категориям
        if($this->category) {

            $query
                ->join('LEFT JOIN', CategoryProduct::tableName() . ' c2p', 'c2p.`product_id` = `products`.`id`')
                ->join('LEFT JOIN', Categories::tableName(). ' cc', 'cc.`id` = c2p.`category_id`')
                ->join('LEFT JOIN', Categories::tableName(). ' cp', 'cp.`id` = cc.parent');

            $query->andFilterWhere([
                'or',
                ['cp.id' => $this->category],
                ['cc.id' => $this->category],
            ]);

            $query->andFilterWhere([
                'or',
                ['cp.status' => Categories::STATUS_ACTIVE],
                ['cc.status' => Categories::STATUS_ACTIVE],
            ]);
        }
/*
        $query->andFilterWhere([
            'or',
            [
                'products.type' => self::TYPE_PREORDER,
            ],
            [
                'products.type' => self::TYPE_PREORDER,
                ['>','products.amt',0],
            ],
        ]);
*/
        // grid filtering conditions
        $query->andFilterWhere([
            'products.id' => $this->id,
            'products.status' => $this->status,
//            'created_by' => $this->created_by,
//            'updated_by' => $this->updated_by,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//            'products.type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'article_inner', $this->article_inner])
//            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
//            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
//            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }

    /*
     * Запрос к фронту поиск
     *
     * @param array $params
     *
     * @return ActiveDataProvider     * */
    public function searchPage()
    {
        $query = ProductsModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
                'forcePageParam' => false,
//                'route' => '',
            ],
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'products.id' => $this->id,
            'products.status' => self::STATUS_ACTIVE
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
