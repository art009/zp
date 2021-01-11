<?php
namespace app\helpers;

use app\models\Basket;
use yii\helpers\Html;
use yii\helpers\Url;

class OrderHelper
{
    // список лейблов статусов
    public static function listLabel()
    {
        return [
            Basket::STATUS_HOSTED => 'Новый',
            Basket::STATUS_ACCEPTED => 'Принят',
            Basket::STATUS_RESERVED => 'Резерв',
            Basket::STATUS_SENDED => 'Отправлен',
            Basket::STATUS_DELETED => 'Удален',
        ];
    }
    // вывод статуса
    public static function showLabel($status)
    {
        $label_list = self::listLabel();
        if (array_key_exists($status,$label_list))
            return $label_list[$status];
        else
            return 'не определен';
    }
    // список кнопок для смены статуса
    public static function buttonChangeStatus($id)
    {
        return [
            Basket::STATUS_HOSTED => Html::button('Новый',[
                'class' => 'btn btn-default btn-xs btn-flat',
                'data-value' => Basket::STATUS_HOSTED,
                'data-attribute' => 'status',
                'data-url' => Url::to(['/admin/basket/change-record','id' => $id]),
                'data-id-order' => $id,
                'onclick' => 'chStatusRecord(this)',
                ]),//'<span class="label label-default">Новый</span>',
            Basket::STATUS_ACCEPTED => Html::button('Принят',[
                'class' => 'btn btn-success btn-xs btn-flat',
                'data-value' => Basket::STATUS_ACCEPTED,
                'data-attribute' => 'status',
                'data-url' => Url::to(['/admin/basket/change-record','id' => $id]),
                'data-id-order' => $id,
                'onclick' => 'chStatusRecord(this)',
            ]),
            //'<span class="label label-success">Принят</span>',
            Basket::STATUS_RESERVED => Html::button('Резерв',[
                'class' => 'btn btn-primary btn-xs btn-flat',
                'data-value' => Basket::STATUS_RESERVED,
                'data-attribute' => 'status',
                'data-url' => Url::to(['/admin/basket/change-record','id' => $id]),
                'data-id-order' => $id,
                'onclick' => 'chStatusRecord(this)',
            ]),//'<span class="label label-primary">Резерв</span>',
            Basket::STATUS_SENDED => Html::button('Отправлен',[
                'class' => 'btn btn-info btn-xs btn-flat',
                'data-value' => Basket::STATUS_SENDED,
                'data-attribute' => 'status',
                'data-url' => Url::to(['/admin/basket/change-record','id' => $id]),
                'data-id-order' => $id,
                'onclick' => 'chStatusRecord(this)',
            ]),// '<span class="label label-info">Отправлен</span>',
            Basket::STATUS_DELETED => Html::button('Удален',[
                'class' => 'btn btn-warning btn-xs btn-flat',
                'data-value' => Basket::STATUS_DELETED,
                'data-attribute' => 'status',
                'data-url' => Url::to(['/admin/basket/change-record','id' => $id]),
                'data-id-order' => $id,
                'onclick' => 'chStatusRecord(this)',
            ]),//'<span class="label label-warning">Удален</span>',
        ];
    }
}