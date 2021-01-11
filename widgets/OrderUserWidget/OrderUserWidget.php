<?php
namespace app\widgets\OrderUserWidget;

use app\models\forms\OrderForm;
use yii\base\Widget;
//use yz\shoppingcart\ShoppingCart;
//use app\helpers\Formats;
use \Yii;

class OrderUserWidget extends Widget
{
    public $view;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new OrderForm();

        return $this->render('index',[
            'model' => $model,
            'user' => Yii::$app->user->identity,
        ]);
    }
}
