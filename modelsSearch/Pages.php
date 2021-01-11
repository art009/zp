<?php

namespace app\modelsSearch;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pages as PagesModel;
use yii\helpers\ArrayHelper;

/**
 * Pages represents the model behind the search form about `app\models\Pages`.
 */
class Pages extends PagesModel
{
    // список шаблонов для фильтрации
    public $layouts;
    public $search_depart;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status', 'layout', 'search_depart'], 'integer'],
            [['content', 'url', 'title_page', 'meta_title', 'meta_keywords', 'meta_description'], 'safe'],
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

	public function attributeLabels()
	{
		$parent = parent::attributeLabels();
		$addons = [
			'search_depart' => 'Департамент',
		];
		return ArrayHelper::merge($parent,$addons);
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
        $query = PagesModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => 21,
            ],
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'layout' => $this->layout,
        ]);

        if ($this->layouts) {
            if (!is_array($this->layouts))
                $this->layouts[] = $this->layouts;
            $query->andFilterWhere(['in', 'layout', $this->layouts]);
        }

        if ( $this->search_depart ) {
	        $query
		        ->leftJoin('{{%ext_page}}','ext_page.page_id = pages.id')
		        ->leftJoin('{{%depart}}','depart.id = ext_page.depart')
		        ->andFilterWhere([
		            'depart.id'=>$this->search_depart
		        ]);
        }

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'title_page', $this->title_page])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description]);

        return $dataProvider;
    }
}
