<?php

namespace app\modelsSearch;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Basket as BasketModel;

/**
 * Basket represents the model behind the search form of `app\models\Basket`.
 */
class Basket extends BasketModel
{
    public $user;
    public $created_at_from;
    public $created_at_to;

    public $created_at_range;
    public $product;
    public $category;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'status_pay', 'type', 'type_pay', 'created_at', 'updated_at'], 'integer'],
            [['fio'], 'safe'],
            ['user','string'],
            ['created_at_from','safe'],
            ['created_at_to','safe'],
            ['created_at_range','safe'],
            [['total_sum'], 'number'],
            [['product'], 'string'],
            [['comment'], 'string'],
            [['category'],'integer'],
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
//        var_dump($params);exit;
        $query = BasketModel::find();

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
        // фильтр по пользователю
        if ($this->user) {
            $query->join('left join','user u',['basket.user_id' => 'id']);
            $query->andFilterWhere([
                'or',
                ['like', 'u.email', $this->user],
                ['like', 'u.username', $this->user],
                ['like', 'basket.fio', $this->user],
                ['like', 'basket.phone', $this->user],
                ['like', 'basket.email', $this->user],
            ]);
        }

        // фильтр по товарам
        if($this->product){
            $query->join('left join','product_basket pb','basket.id = pb.basket_id');
            $query->andFilterWhere(['like', 'pb.product_name', trim($this->product)]);
        }
        // фильтр по категории
        if ($this->category) {
            $query->join('inner join','product_basket pb','basket.id = pb.basket_id');
            $query->join('left join','category_product cp','pb.product_id = cp.product_id');
            $query->andFilterWhere(['cp.category_id' => $this->category]);
        }

        // фильт при задание created_at_range
        if ($this->created_at_range){
            $range = explode('-',$this->created_at_range);
            $this->created_at_from = strtotime(trim($range[0]) . ' 00:00');
            $this->created_at_to = strtotime(trim($range[1]) . ' 23:59');
        }

        // фильтр по дате заказа от
        if ($this->created_at_from)
            $query->andFilterWhere(['>=', 'created_at', $this->created_at_from]);
        // фильтр по дате заказа до
        if ($this->created_at_to)
            $query->andFilterWhere(['<=', 'created_at', $this->created_at_to]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'status_pay' => $this->status_pay,
            'total_sum' => $this->total_sum,
            'type' => $this->type,
            'type_pay' => $this->type_pay,
//            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        $query->orderBy('created_at DESC');
//        var_dump($query->sql);exit;
        return $dataProvider;
    }
}
