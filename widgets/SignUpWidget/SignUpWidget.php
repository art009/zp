<?php
/*
 * Register form
 *
 * */

namespace app\widgets\SignUpWidget;

use yii\base\Widget;
use app\widgets\SignUnWidget\models\SignupForm;

class SignUpWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new SignupForm();
        $this->render('index',['model' => $model]);
    }
}