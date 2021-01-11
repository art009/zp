<?php
use yii\helpers\Html;
use app\models\Basket;
use app\models\Products;
/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $basket app\models\Basket */


?>
<div class="password-reset">
    <p>Добрый день!</p>

    <p>На сайте <?=Html::a(Yii::$app->name,Yii::$app->getHomeUrl())?> оформен заказ.</p>

    <h2>Данные заказа:</h2>

    <table>
        <tr>
            <th>Номер заказа</th>
            <td><?=$basket->id?> от <?=date('d.m.Y H:i',$basket->created_at)?></td>
        </tr>
        <tr>
            <th>ФИО клиента</th>
            <td><?=$basket->fio?></td>
        </tr>
        <tr>
            <th>Статус</th>
            <td><?=Basket::getStatusOrder()[$basket->status]?></td>
        </tr>
        <tr>
            <th>Статус оплаты</th>
            <td><?=Basket::getStatusPay()[$basket->status_pay]?></td>
        </tr>
        <tr>
            <th>Сумма заказа</th>
            <td><?=$basket->total_sum?></td>
        </tr>
        <tr>
            <th>Тип заказа</th>
            <td><?=Products::getTypes()[$basket->type]?></td>
        </tr>
        <tr>
            <th>Адрес доставки</th>
            <td><?=$basket->getFullAddress()?></td>
        </tr>
        <tr>
            <th>Конт. тел</th>
            <td><?=$basket->phone?></td>
        </tr>
        <tr>
            <th>Эл. почта</th>
            <td><?=$basket->email?></td>
        </tr>
        <tr>
            <th>Тип доставки</th>
            <td><?=Basket::getTypeDelivery()[$basket->type_delivery]?></td>
        </tr>
    </table>

    <h2>Информация о товарах в заказе:</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Название товара</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>Стоимость</th>
        </tr>
        <?php
        $n = 0;
        foreach($basket->productBaskets as $product):?>
            <tr>
                <td><?php $n++; echo $n;?></td>
                <td>
                    <?php if($product->product):?>
                        <?=Html::a($product->product_name,$product->product->urlPage)?>
                    <?php else:?>
                        <?=$product->product_name?>
                    <?php endif;?>
                </td>
                <td><?=$product->count?></td>
                <td><?=$product->price?></td>
                <td><?=$product->total_sum?></td>
            </tr>
        <?php endforeach;?>
        <tr>
            <td colspan="4"><b>Итого:</b></td>
            <td><?=$basket->total_sum?></td>
        </tr>
    </table>

</div>
