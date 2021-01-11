<?php

namespace app\modules\admin\controllers;

use app\helpers\Formats;
use app\models\Pages;
use app\helpers\Pages as HelperPage;
use Yii;
use app\models\Staff;
use app\modelsSearch\Staff as StaffSearch;
use app\modules\admin\components\AdminController;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends AdminController
{
    /**
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Staff();
        $page = new Pages();
        $page->layout = HelperPage::LAYOUT_WORKER;

        if ($model->load(Yii::$app->request->post()) && $page->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $page->url = Formats::generateUrl($model->name);
            $page->title_page = $model->name;
            $page->status = HelperPage::STATUS_PUBLIC;
            $page->save();
            $model->page_id = $page->id;
            if ($model->upload() && $model->save(false)) {
                Yii::$app->session->setFlash('success','Сотрудник успешно добавлен');
                return $this->redirect(['index']);
            }
        }

        if ($model->hasErrors()){
            Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
        }

        return $this->render('create', [
            'model' => $model,
            'page' => $page,
        ]);
    }

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->page)
            $page = $model->page;
        else
            $page = new Pages();

//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $page->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $page->layout = HelperPage::LAYOUT_WORKER;
            $page->url = Formats::generateUrl($model->name);
            $page->title_page = $model->name;
            $page->status = HelperPage::STATUS_PUBLIC;
            $page->save();
            $model->page_id = $page->id;
            if ($model->upload() && $model->save(false)) {
                Yii::$app->session->setFlash('success','Данные сотрудника успешно сохранены.');
                return $this->redirect(['index']);
            }
        }

        if ($model->hasErrors()){
            Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
        }

        return $this->render('update', [
            'model' => $model,
            'page' => $page,
        ]);
    }

    /**
     * Deletes an existing Staff model.
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
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
