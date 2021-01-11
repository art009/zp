<?php

namespace app\modules\admin\widgets\LatestOrdersWidget;

use yii\base\Widget;

class LatestOrdersWidget extends Widget
{
    public function init()
    {

    }

    public function run()
    {
        /*
        SELECT DATE(FROM_UNIXTIME(MyTimestamp)) AS ForDate,
        COUNT(*) AS NumPosts
         FROM   MyPostsTable
         GROUP BY DATE(FROM_UNIXTIME(MyTimestamp))
         ORDER BY ForDate
        */
    }
}