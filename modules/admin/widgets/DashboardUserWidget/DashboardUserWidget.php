<?php
namespace app\modules\admin\widgets\DashboardUserWidget;

use yii\base\Widget;
use yii\helpers\Url;
use Yii;

class DashboardUserWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $sql = 'SELECT COUNT(id) FROM {{%user}}';
        $count_users = Yii::$app->db->createCommand($sql)->queryScalar();
        $url = Url::toRoute('/admin/user/create');
        // echo $url;
        return $this->render('index', [
            'count_users' => $count_users,
            'url' => $url,
        ]);
    }
}



