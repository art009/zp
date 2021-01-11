<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_items".
 *
 * @property int $id
 * @property int $price_id Цена
 * @property string $item Наименование позиции
 * @property string $price Стоимость
 *
 * @property PriceItems $price0
 * @property PriceItems[] $priceItems
 */
class PriceItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_id', 'item', 'price'], 'required'],
            [['price_id'], 'integer'],
            [['item'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 55],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => PriceList::class, 'targetAttribute' => ['price_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price_id' => 'Прайс',
            'item' => 'Наименование позиции',
            'price' => 'Стоимость',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceList()
    {
        return $this->hasOne(PriceList::class, ['id' => 'price_id']);
    }
}
