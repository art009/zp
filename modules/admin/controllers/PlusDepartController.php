<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AdminController;
use Yii;
use app\models\PlusDepart;
use app\modelsSearch\PlusDepart as PlusDepartSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlusDepartController implements the CRUD actions for PlusDepart model.
 */
class PlusDepartController extends AdminController
{
    /**
     * Lists all PlusDepart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlusDepartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new PlusDepart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlusDepart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Updates an existing PlusDepart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        return $this->redirect(['index']);
        }

	    if ($model->hasErrors()){
		    Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
	    }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PlusDepart model.
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
     * Finds the PlusDepart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlusDepart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlusDepart::findOne($id)) !== null) {
            return $model;
        }

	    throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
