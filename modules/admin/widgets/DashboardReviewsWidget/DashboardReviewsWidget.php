<?php
namespace app\modules\admin\widgets\DashboardReviewsWidget;

use app\models\Reviews;
use yii\base\Widget;
use yii\helpers\Url;
use Yii;

class DashboardReviewsWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $reviews = Reviews::find()->where('status = :status OR type = :type',[
            ':status' => Reviews::STATUS_NEW,
            ':type' => Reviews::TYPE_MODERATE,
        ])->limit(10)->all();
        return $this->render('index', [
            'reviews' => $reviews,
        ]);
    }
}



