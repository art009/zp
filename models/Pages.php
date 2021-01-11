<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\helpers\Pages as PagesHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $content
 * @property integer $status
 * @property integer $layout
 * @property string $url
 * @property string $title_page
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class Pages extends \yii\db\ActiveRecord
{
    public $persons_id;
	public $price_id;
    private $_persons_id;
	private $_price_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'title_page'], 'required'],

            ['url','filter', 'filter' => function ($value) {
                $value = str_replace('_','-',$value);
                return strtolower($value);
            }],
            [['url'], 'uniquePage', 'params' => ['targetAttribute' => 'layout']],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['url', 'title_page', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            [['meta_description'], 'string', 'max' => 1024],
            ['status', 'integer'],
            ['status', 'in', 'range' => array_keys(PagesHelper::getArrayStatus())],
            ['persons_id','safe'],
	        ['price_id','safe'],
            ['layout', 'integer'],
            ['layout', 'in', 'range' => array_keys(PagesHelper::getArrayLayoutName())],
        ];
    }

    public function uniquePage ($attribute, $params, $validator)
    {
        $targetAttribute = $params['targetAttribute'];
        $pages = self::find()->where([
            $attribute => $this->$attribute,
            $targetAttribute => $this->$targetAttribute,
        ])->one();
//        if ($this->url == 'cont-1-2-4')
//        {var_dump( ($pages && $this->isNewRecord) );exit;}
        if ($pages && $this->isNewRecord) {
            $this->addError($attribute, 'Url не уникален, измениете URL.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Автор',
            'updated_by' => 'Модератор',
            'content' => 'Содержание',
            'status' => 'Статус',
            'layout' => 'Шаблон',
            'url' => 'URL',
            'title_page' => 'Заголовок (H1)',
            'meta_title' => 'Заголовок (title)',
            'meta_keywords' => 'Ключевые слова',
            'meta_description' => 'Ключевое описание',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => BlameableBehavior::className(),
                'value' => 1,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function getCreater()
    {
        return User::findIdentity($this->created_by);
    }

    public function getUpdater()
    {
        return User::findIdentity($this->updated_by);
    }

    public function afterFind()
    {
	    $ids_staff_array = Yii::$app->db
            ->createCommand('SELECT staff_id FROM page_staff WHERE page_id = :page_id ORDER BY sort ASC')
            ->bindValue(':page_id', $this->id)
            ->queryColumn();

	    $ids_price_array = Yii::$app->db
		    ->createCommand('SELECT price_id FROM price_page WHERE page_id = :page_id')
		    ->bindValue(':page_id', $this->id)
		    ->queryColumn();

        $this->persons_id = $this->_persons_id = implode(',',ArrayHelper::getColumn($ids_staff_array,function ($element) {
            return $element;
        }));
	    $this->price_id = $this->_price_id = implode(',',ArrayHelper::getColumn($ids_price_array,function ($element) {
		    return $element;
	    }));

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->persons_id !== $this->_persons_id) {
            Yii::$app->db->createCommand()->delete('{{%page_staff}}','page_id = :page_id',[
                ':page_id' => $this->id,
            ])->execute();
            if ($this->persons_id)
                foreach (explode(',',$this->persons_id) as $key => $person_id) {
                    $fields = [
                    'page_id' => $this->id,
                        'staff_id' => $person_id,
                        'sort' => $key + 1,
                    ];
    //                var_dump($fields);exit;
                    Yii::$app->db->createCommand()->insert('{{%page_staff}}',$fields)->execute();
                }
        }

	    if ($this->price_id !== $this->_price_id) {
		    Yii::$app->db->createCommand()->delete('{{%price_page}}','page_id = :page_id',[
			    ':page_id' => $this->id,
		    ])->execute();
		    if ($this->price_id)
			    foreach (explode(',',$this->price_id) as $key => $price_id) {
				    $fields = [
					    'page_id' => $this->id,
					    'price_id' => $price_id,
				    ];
				    Yii::$app->db->createCommand()->insert('{{%price_page}}',$fields)->execute();
			    }
	    }

        parent::afterSave($insert, $changedAttributes);
    }

    public function getExtPage()
    {
        /*if (in_array($this->layout,[
            PagesHelper::LAYOUT_NEWS,
            PagesHelper::LAYOUT_ARTICLE,
            PagesHelper::LAYOUT_ACTION,
        ]))*/
            return $this->hasOne(ExtPage::className(),['page_id' => 'id']);
    }

    public static function listPages($depart = null) {
    	if ($depart == NULL) {
		    $deafault_depart = Depart::defaultDepart();
		    $depart = $deafault_depart->id;
	    }
        return ArrayHelper::map(
        	self::find()
		        ->where(['depart' => $depart])
		        ->joinWith('extPage')
		        ->orderBy('title_page')
		        ->all(),'id','title_page');
    }

    public function getRedirect()
    {
        return $this->hasMany(Redirect::className(),[
            'page_id' => 'id',
        ])->where(['model_name' => 'Pages',]);
    }
    // ссылка на страницу
    public function getUrlPage()
    {
	    $depart = NULL;
    	if ($this->depart) {
		    if ($this->depart->is_main != 1)
    		    $depart = $this->depart->slug;
	    }
	    $url = Url::to(['site/page','url' => $this->url, 'depart' => $depart],true);
        if ($this->layout == PagesHelper::LAYOUT_MAIN)
            $url = Url::home();
	    if ($this->layout == PagesHelper::LAYOUT_DEPART)
		    $url = Url::to(['site/depart','url' => $depart],true);
        if ($this->layout == PagesHelper::LAYOUT_ARTICLE)
            $url = Url::to(['article','url' => $this->url, 'depart' => $depart],true);
        if ($this->layout == PagesHelper::LAYOUT_NEWS)
            $url = Url::to(['news','url' => $this->url, 'depart' => $depart],true);
        if ( in_array($this->layout,[PagesHelper::LAYOUT_WORKER]))
            $url = Url::to(['staff','url' => $this->url, 'depart' => $depart],true);
        return $url;
    }
    // список сотрудников закрепленных на данной странице
    public function getStaff()
    {
        return Staff::find()
            ->join('LEFT JOIN','{{%page_staff}}','staff.id = page_staff.staff_id')
            ->where('page_staff.page_id = :page_id',[':page_id' => $this->id])
            ->orderBy(['sort' => SORT_ASC])
            ->all();
    }
	// список прайс листов закрепленных на данной странице
	public function getPrice()
	{
		return PriceList::find()
			->join('LEFT JOIN','{{%price_page}}','price_list.id = price_page.price_id')
			->where('price_page.page_id = :page_id',[':page_id' => $this->id])
			->all();
	}
    // страница сотрудник
    public function getWorker()
    {
        return $this->hasOne(Staff::className(), ['page_id' => 'id']);
    }
    // результат поиска контента
    public function getSearchContent($search)
    {
        $clear_tags = strip_tags($this->content);
        $pos_query = strpos($clear_tags,$search);
        $prefix = '...';
        if ($pos_query - 100 < 0) {
            $str_from = 0;
            $prefix = '';
        } else {
            $str_from = $pos_query - 100;
        }

        $char_count = 200 + strlen($search);
        $result = mb_substr($clear_tags,$str_from,$char_count);
//        return $str_from;
        return $prefix . str_replace($search,'<b>' . $search . '</b>',$result) . '...';
    }

    public function getDepart()
    {
    	return $this
		    ->hasOne(Depart::className(),['id'=>'depart'])
		    ->via('extPage');
    }

}
