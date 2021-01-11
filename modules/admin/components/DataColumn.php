<?php

namespace app\modules\admin\components;

use yii\grid\DataColumn as DataColumnMain;

class DataColumn extends DataColumnMain
{
    public $filterInputOptions = ['class' => 'form-control input-sm', 'id' => null];
}