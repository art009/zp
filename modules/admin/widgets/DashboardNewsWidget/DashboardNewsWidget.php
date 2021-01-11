<?php
namespace app\modules\admin\widgets\DashboardNewsWidget;

use yii\base\Widget;
use yii\helpers\Url;
use app\helpers\Pages;
use Yii;

class DashboardNewsWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $sql = 'SELECT COUNT(id) FROM {{%pages}} WHERE layout = :layout';
        $count_news = Yii::$app->db
            ->createCommand($sql)
            ->bindValue(':layout',Pages::LAYOUT_NEWS)
            ->queryScalar();
        $url = Url::toRoute('/admin/user/create');
        // echo $url;
        return $this->render('index', [
            'count_news' => $count_news,
            'url' => $url,
        ]);
    }
}



