<?php

namespace app\modules\admin\components;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $template = '{update}&nbsp;{delete}';

    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'fas fa-eye',['class' => 'btn btn-success btn-xs btn-flat']);
        $this->initDefaultButton('update', 'fas fa-pencil-alt',['class' => 'btn btn-default btn-xs btn-flat']);
        $this->initDefaultButton('delete', 'fas fa-trash-alt', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
            'class' => 'btn btn-danger btn-xs btn-flat',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                if ( strripos($iconName,'fa') === false )
                    $icon = Html::tag('i', '', ['class' => "fa fa-$iconName"]);
				else
		            $icon = Html::tag('i', '', ['class' => $iconName]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}