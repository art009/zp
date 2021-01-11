<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redirect".
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $old_url
 */
class Redirect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'old_url', 'model_name'], 'required'],
            [['page_id'], 'integer'],
            [['old_url'], 'string', 'max' => 255],
            ['model_name', 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Страница',
            'old_url' => 'Старая ссылка',
            'model_name' => 'Модель',
        ];
    }

    public function getPage()
    {
        return $this->hasOne($this->model_name,['id' => 'page_id']);
    }
}
