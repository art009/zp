<?php
namespace app\widgets\ActionWidget;

use yii\base\Widget;
use app\models\Pages;
use app\modelsSearch\Pages as PageSearch;
use app\helpers\Pages as PagesHelper;
use Yii;

class ActionWidget extends Widget
{

    public function run()
    {
        $model = new PageSearch();
//        $model->status = PagesHelper::STATUS_PUBLIC;
        $model->layout = PagesHelper::LAYOUT_ACTION;
        return $this->render('list',[
            'actions' => $model->search(Yii::$app->request->queryParams),
        ]);
    }

    public function init()
    {
        return parent::init();
    }
}