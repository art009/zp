<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "modal_window".
 *
 * @property int $id
 * @property string $title Заголовок окна
 * @property string $content Содержания модального окна
 * @property int $date_from Дата начала показа
 * @property int $date_to Дата кончания показа
 * @property int $type_show Тип показа
 * @property int $created_at Дата добавления
 * @property int $updated_at Дата изменения
 * @property int $created_by Автор
 * @property int $updated_by Модератор
 */
class ModalWindow extends \yii\db\ActiveRecord
{
	const TYPE_ONE = 10;
	const TYPE_MULTI = 20;

	public $daterange;

	public function getType()
	{
		return [
			self::TYPE_ONE => 'Один раз',
			self::TYPE_MULTI => 'Постоянно',
		];
	}
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modal_window';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date_from', 'date_to'], 'required'],
            [['content'], 'string'],
            [['date_from', 'date_to', 'type_show', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
	        ['daterange', 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок окна',
            'content' => 'Содержания модального окна',
            'date_from' => 'Дата начала показа',
            'date_to' => 'Дата кончания показа',
            'type_show' => 'Тип показа',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Автор',
            'updated_by' => 'Модератор',
	        'daterange' => 'Период действия',
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
}
