<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_list".
 *
 * @property int $id
 * @property string $title Название
 *
 * @property PricePage[] $pricePages
 */
class PriceList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricePages()
    {
        return $this->hasMany(PricePage::className(), ['price_id' => 'id']);
    }

    public function getItems()
    {
    	return $this->hasMany(PriceItems::class, ['price_id' => 'id']);
    }
}
