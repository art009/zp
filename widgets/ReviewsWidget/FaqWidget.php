<?php

namespace app\widgets\ReviewsWidget;

use Yii;
use app\models\Reviews;
use app\modelsSearch\Reviews as ReviewsSearch;
use yii\base\Widget;

class FaqWidget extends Widget
{
    public $on_main = false;
    public $show = 3;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new ReviewsSearch();
        $model->status = Reviews::STATUS_ACTIVE;

        return $this->render('list', [
            'reviews' => $model->searchQuestion(),
            'itemView' => '_query',
        ]);
    }
}