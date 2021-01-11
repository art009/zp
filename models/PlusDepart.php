<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "plus_depart".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $content Контент
 * @property string $icon Иконка
 * @property int $depart_id Департамент
 * @property int $created_at Дата добавления
 * @property int $updated_at Дата изменения
 * @property int $created_by Автор
 * @property int $updated_by Модератор
 */
class PlusDepart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plus_depart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','depart_id','link'], 'required'],
            [['content'], 'string'],
            [['depart_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title','link'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'icon' => 'Иконка',
            'depart_id' => 'Департамент',
	        'link' => 'Ссылка',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Автор',
            'updated_by' => 'Модератор',
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
				'createdByAttribute' => 'created_by',
				'updatedByAttribute' => 'updated_by',
			],
		];
	}

	public function getDepart()
	{
		return $this
			->hasOne(Depart::className(),['id'=>'depart_id']);
	}
}
