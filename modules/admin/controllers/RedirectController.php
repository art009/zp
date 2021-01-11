<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Redirect;
use app\models\Pages;
use app\modules\admin\components\AdminController;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use yii\web\Response;

/**
 * RedirectController implements the CRUD actions for Menu model.
 */
class RedirectController extends AdminController
{
    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $page_id integer
     * @param $model_name yii/db/ActiveRecord
     * @return mixed
     */
    public function actionControl($page_id, $model_name = 'Pages')
    {
        // разрешим только Ajax запрос
        if (!Yii::$app->request->isAjax)
            throw new NotFoundHttpException('Страница не найдена');

        $model = new Redirect();

        if (class_exists($model_name)) {
            $model_search = $model_name;
        } elseif (class_exists('\app\models\\'.$model_name)){
            $model_search = '\app\models\\'.$model_name;
        } else {
            throw new NotFoundHttpException('Модель '.$model_name.' не найдена');
        }

        $page = $model_search::findOne($page_id);

        if ($model->isNewRecord){
            $model->page_id = $page_id;
            $model->model_name = $model_name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Редирект успешно сохранен.');
            return $this->renderAjax('_succes');
        } else {
            if ($model->hasErrors())
                Yii::$app->session->setFlash('error',Html::errorSummary($model,[
                    'header' => 'Исправьте ошибки:'
                ]));
            return $this->renderAjax('_form', [
                'model' => $model,
                'page' => $page,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $is_delete = $this->findModel($id)->delete();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => $is_delete,
        ];

        //return $this->redirect(['index']);
    }

    /**
     * Найдем раздел редиректа, если такой есть иначе создадим новый редирект.
     * Если поиск для удаления, то вернем только модель, в случае ошибки вернем исключение.
     * @param integer $id
     * @return Redirect the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Redirect::findOne($id)) === null)
                throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        else
            return $model;
    }
}
