<?php

namespace app\widgets\ReviewsWidget;

use app\modelsSearch\Reviews;
use yii\base\Widget;
use Yii;

class ReviewsFormWidget extends Widget
{
    public $view;
    public $goal = NULL;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new Reviews();

        return $this->render($this->view, [
            'model' => $model,
            'goal' => $this->goal
        ]);
    }
}