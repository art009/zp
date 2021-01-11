<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ModalWindow;
use app\modelsSearch\ModalWindow as ModalWindowSearch;
use app\modules\admin\components\AdminController;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModalWindowController implements the CRUD actions for ModalWindow model.
 */
class ModalWindowController extends AdminController
{
    /**
     * Lists all ModalWindow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModalWindowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ModalWindow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModalWindow();

        if ($model->load(Yii::$app->request->post())) {
        	if ($model->daterange) {
        		$daterange = explode(' - ',$model->daterange);
        		list($model->date_from,$model->date_to) = $daterange;
		        $model->date_from = strtotime($model->date_from);
		        $model->date_to = strtotime($model->date_to);
	        }
	        if ($model->save()) {
		        Yii::$app->session->setFlash('success','Данные успешно сохранены.');
		        return $this->redirect(['index']);
	        } else {
		        Yii::$app->session->setFlash('error',Html::errorSummary($model,['header'=>'']));
	        }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModalWindow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        var_dump($model->attributes);exit;
	    $model->daterange = date('d.m.Y',$model->date_from) . ' - ' . date('d.m.Y',$model->date_to);
	    if ($model->load(Yii::$app->request->post())) {
		    if ($model->daterange) {
			    $daterange = explode(' - ',$model->daterange);
			    list($model->date_from,$model->date_to) = $daterange;
			    $model->date_from = strtotime($model->date_from);
			    $model->date_to = strtotime($model->date_to);
		    }
		    if ($model->save()) {
			    Yii::$app->session->setFlash('success','Данные успешно сохранены.');
			    return $this->redirect(['index']);
		    } else {
			    Yii::$app->session->setFlash('error',Html::errorSummary($model,['header'=>'']));
		    }
	    }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModalWindow model.
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
     * Finds the ModalWindow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModalWindow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModalWindow::findOne($id)) !== null) {
            return $model;
        }

	    throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
