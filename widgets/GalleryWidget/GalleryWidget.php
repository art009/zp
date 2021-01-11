<?php
namespace app\widgets\GalleryWidget;

use app\models\Gallery;
use yii\base\Widget;
use Yii;

class GalleryWidget extends Widget
{
    public $page_id;

    public function run()
    {
        if (!$this->page_id)
            return '';
        $images = Gallery::find()->where(['page_id' => $this->page_id])->all();
        if ($images)
            return $this->render('index',[
                'images' => $images,
            ]);
    }

    public function init()
    {
        return parent::init();
    }
}