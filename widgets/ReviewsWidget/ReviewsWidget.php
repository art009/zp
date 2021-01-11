<?php
namespace app\widgets\ReviewsWidget;

use Yii;
use app\models\Reviews;
use app\modelsSearch\Reviews as ReviewsSearch;
use yii\base\Widget;

class ReviewsWidget extends Widget
{
    public $on_main = false;
    public $show = 2;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->on_main == true) {
            $reviews = Reviews::find()->where([
                'status'    => Reviews::STATUS_ACTIVE,
                'type'      => Reviews::TYPE_REVIEWS,
            ])
                ->limit($this->show)
                ->orderBy('created_at DESC')
                ->all();

            if ($reviews) {
                return $this->render('index', ['reviews' => $reviews]);
            }
        }

        if ($this->on_main == false) {
            $model = new ReviewsSearch();
            $model->status = Reviews::STATUS_ACTIVE;
            return $this->render('list',[
                'reviews' => $model->searchReviews(),
                'itemView' => '_item',
            ]);
        }

    }
}