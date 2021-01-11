<?php
namespace app\widgets\NewsWidget;

use yii\base\Widget;
use app\models\Pages;
use app\modelsSearch\Pages as PageSearch;
use app\helpers\Pages as PagesHelper;
use Yii;

class NewsWidget extends Widget
{
    public $on_main = false;
    public $show = 3;
    public $view = 'index';

    public function run()
    {
        if ($this->on_main == true) {
            $news = Pages::find()->where([
                'status' => PagesHelper::STATUS_PUBLIC,
                'layout' => PagesHelper::LAYOUT_NEWS,
            ])
                ->limit($this->show)
                ->orderBy('created_at DESC')
                ->all();

            if ($news) {
                return $this->render($this->view, ['news' => $news]);
            }
        }

        if ($this->on_main == false) {
            $model = new PageSearch();
            $model->layout = PagesHelper::LAYOUT_NEWS;
	        $params['sort'] = '-updated_by';
            $dataProvider = $model->search($params);
            $page = Yii::$app->request->get('page',1) - 1;
	        $dataProvider->pagination->page = $page;

	        return $this->render('list',[
                'articles' => $dataProvider
            ]);
        }

    }

    public function init()
    {
        return parent::init();
    }
}