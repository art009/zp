<?php

namespace app\modelsSearch;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ModalWindow as ModalWindowModel;

/**
 * ModalWindow represents the model behind the search form of `app\models\ModalWindow`.
 */
class ModalWindow extends ModalWindowModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_from', 'date_to', 'type_show', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'content'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ModalWindowModel::find();

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
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'type_show' => $this->type_show,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
