<?php
namespace app\modules\admin\components;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;

/**
 * AdminController main controller for all controller for Admin module
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ];
    }

    // список сообщение статуса
    public function errorsMessage()
    {
        return [
            '404' => 'Запрашиваемая страница не найдена.',
        ];
    }
}