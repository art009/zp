<?php

namespace app\widgets\ContactWidget;

use Yii;
use app\widgets\ContactWidget\models\ContactForm;
use yii\base\Widget;

class ContactWidget extends Widget
{
    public $person;
    public $goal;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new ContactForm();
        if ($this->person)
            $model->person = $this->person;

        return $this->getView()->renderAjax('@app/widgets/ContactWidget/views/index.php', [
            'model' => $model,
            'goal' => $this->goal,
        ]);
    }
}
