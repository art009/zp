<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $name Название параметра
 * @property string $description Описание параметра
 * @property string $value Значение параметра
 * @property int $created_by Добавил
 * @property int $updated_by Изменил
 * @property int $created_at Дата создания
 * @property int $updated_at Дата изменения
 * @property string $key_param Ключ параметра
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'key_param'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'key_param'], 'string', 'max' => 50],
            [['description', 'value'], 'string', 'max' => 255],
            [['key_param'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name'          => 'Название параметра',
            'description'   => 'Описание параметра',
            'value'         => 'Значение',
            'created_by'    => 'Добавил',
            'updated_by'    => 'Изменил',
            'created_at'    => 'Дата добавления',
            'updated_at'    => 'Дата изменения',
            'key_param'     => 'Ключ',
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
