<?php

namespace app\widgets\StaffWidget;

use app\models\Pages;
use Yii;

class StaffWidget extends \yii\base\Widget
{
    public $page;

    private $goals = [
        288 => 'uzi', // Узи
        735 => 'sgv', // Служба грудного вскармливания
        912 => 'agro', // Акушеры-гинекологи родильного отделения
    ];

    public function run()
    {
        $page = Pages::findOne($this->page);

        if ($page->staff) {

            return $this->render('index', [
                'staff' => $page->staff,
                'goal' => $this->getGoal($page),
            ]);
        }

        return null;
    }

    public function init()
    {
        return parent::init();
    }

    private function getGoal($page)
    {
        if (!empty($this->goals[$this->page])) {
            $goalName = ucfirst($this->goals[$this->page]);
        } else {
            $goalName = 'Staff';
        }

        return [
            'form' => $goalName ? implode('', ['form', $goalName]) : null,
            'button' => $goalName ? implode('', ['button', $goalName]) : null,
        ];
    }
}