<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AdminController;
use Yii;
use app\models\Depart;
use app\modelsSearch\Depart as DepartSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DepartController implements the CRUD actions for Depart model.
 */
class DepartController extends AdminController
{

    /**
     * Lists all Depart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Depart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Depart();

	    if ($model->load(Yii::$app->request->post())) {
		    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
		    if( $model->imageFile ) {
			    if ( $model->upload() && $model->save(false) ) {
				    return $this->redirect(['index']);
			    }
		    } else {
			    if ( $model->save() ) {
				    return $this->redirect(['index']);
			    }
		    }
	    }

	    if ($model->hasErrors()){
		    Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
	    }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Depart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
		    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
		    if( $model->imageFile ) {
			    if ( $model->upload() && $model->save(false) ) {
				    return $this->redirect(['index']);
			    }
		    } else {
			    if ( $model->save() ) {
				    return $this->redirect(['index']);
			    }
		    }

	    }

	    if ($model->hasErrors()){
		    Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
	    }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Depart model.
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
     * Finds the Depart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Depart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Depart::findOne($id)) !== null) {
            return $model;
        }

	    throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
