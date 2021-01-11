<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Reviews;
use app\modelsSearch\Reviews as ReviewsSearch;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AdminController;
use yii\web\Response;
use yii\helpers\Html;

/**
 * FaqController implements the CRUD actions for Reviews model.
 */
class FaqController extends AdminController
{
    /**
     * Lists all Reviews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewsSearch();
        $dataProvider = $searchModel->searchQuestion(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChangeStatus($id)
    {
        $model = $this->findModel($id);
        $status = false;
        $errors = [];
        if (($attribute = Yii::$app->request->post('attribute')) && ($value = Yii::$app->request->post('value'))) {
            $model->$attribute = $value;

            if ($model->save())
                $status = true;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => $status,
            'errors' => $errors,
        ];
    }

    /**
     * Creates a new Reviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reviews();
        $model->type = Reviews::TYPE_QUESTION;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','"Вопрос/ответ" успешно сохранен');
            return $this->redirect(['index']);
        }

        if ($model->hasErrors()){
            Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        Yii::$app->session->setFlash('success','"Вопрос/ответ" успешно сохранен');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviews::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
