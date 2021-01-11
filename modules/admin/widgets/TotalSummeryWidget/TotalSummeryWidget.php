<?php
namespace app\modules\admin\widgets\TotalSummeryWidget;

use yii\base\Widget;

class TotalSummeryWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->render('index');
        /*
        SELECT DATE(FROM_UNIXTIME(MyTimestamp)) AS ForDate,
        COUNT(*) AS NumPosts
         FROM   MyPostsTable
         GROUP BY DATE(FROM_UNIXTIME(MyTimestamp))
         ORDER BY ForDate
        */
    }
}



