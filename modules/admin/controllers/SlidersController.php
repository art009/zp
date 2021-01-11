<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Sliders;
use app\modelsSearch\Sliders as SlidersSearch;
use app\modules\admin\components\AdminController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * SlidersController implements the CRUD actions for Sliders model.
 */
class SlidersController extends AdminController
{
    /**
     * Lists all Sliders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlidersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Sliders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sliders();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save(false)) {
                return $this->redirect(['index']);
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
     * Updates an existing Sliders model.
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
            if ($model->upload() && $model->save(false)) {
                return $this->redirect(['index']);
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
     * Deletes an existing Sliders model.
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
     * Finds the Sliders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sliders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sliders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
