<?php
namespace app\widgets\ArticlesWidget;

use app\helpers\Formats;
use app\models\Depart;
use yii\base\Widget;
use app\models\Pages;
use app\modelsSearch\Pages as PageSearch;
use app\helpers\Pages as PagesHelper;
use Yii;
use app\widgets\ArticlesWidget\assets\SlickAssets;

class ArticlesWidget extends Widget
{
    public $on_main = false;
    public $show = 4;

    private $_id_slider;

    public function run()
    {
        if ($this->on_main == true) {
	        $this->_id_slider = 'main_'.Formats::random();
            $articles = Pages::find()
	            ->where([
	                'status' => PagesHelper::STATUS_PUBLIC,
	                'layout' => PagesHelper::LAYOUT_ARTICLE,
//		            'ext_page.depart' => $depart,
	            ])
//	            ->joinWith('extPage')
                ->limit($this->show)
                ->orderBy('created_at DESC')
                ->all();
	        $actions = Pages::find()->where([
		        'status' => PagesHelper::STATUS_PUBLIC,
		        'layout' => PagesHelper::LAYOUT_ACTION,
	        ])
		        ->limit($this->show)
		        ->orderBy('created_at DESC')
		        ->all();

//	        $this->regeditJs();

            if ($articles) {
                return $this->render('index', [
                	'articles'  => $articles,
	                'actions'   => $actions,
	                'id_slider' => $this->_id_slider,
                ]);
            }
        }

        if ($this->on_main == false) {
            $model = new PageSearch();
//            $model->status = PagesHelper::STATUS_PUBLIC;
            $model->layout = PagesHelper::LAYOUT_ARTICLE;

            return $this->render('list',[
                'articles' => $model->search(null),
            ]);
        }

    }

    private function regeditJs()
	{
		$view = $this->view;
		SlickAssets::register($view);


		$js = <<<JS
let slider = $('#$this->_id_slider');
if (slider.length > 0) {
    console.log('Init slider');
    slider.slick({dots: true});
}
JS;
		$view->registerJs($js, $view::POS_READY, 'counter-reg');
	}

    public function init()
    {
        return parent::init();
    }
}