<?php
namespace app\modules\admin\widgets\DashboardStaffWidget;

use yii\base\Widget;
use yii\helpers\Url;
use Yii;

class DashboardStaffWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $sql = 'SELECT COUNT(id) FROM {{%staff}}';
        $count_users = Yii::$app->db->createCommand($sql)->queryScalar();
        $url = Url::toRoute('/admin/staff/create');
        // echo $url;
        return $this->render('index', [
            'count_person' => $count_users,
            'url' => $url,
        ]);
    }
}



