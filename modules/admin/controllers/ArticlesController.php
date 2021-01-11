<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Pages;
use app\models\ExtPage;
use app\modelsSearch\Pages as PagesSearch;
use app\helpers\Pages as HelperPages;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AdminController;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * ArticlesController implements the CRUD actions for Pages model.
 */
class ArticlesController extends AdminController
{
    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $searchModel->layout = HelperPages::LAYOUT_ARTICLE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();
        $model->layout = HelperPages::LAYOUT_ARTICLE;
        $ext_page = new ExtPage();

        if ($model->load(Yii::$app->request->post()) && $ext_page->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save()) {
                $ext_page->page_id = $model->id;
                $ext_page->imageFile = UploadedFile::getInstance($ext_page, 'imageFile');
                $ext_page->imageMainFile = UploadedFile::getInstance($ext_page, 'imageMainFile');
                if ($ext_page->save()) {
                    // если сохранение прошло без ошибок, то коммитим транзакцию
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Новая статья добавлена.');
                    return $this->redirect(['index']);
                }
            }
            // если хоть одно из сохранений не удалось, то откатываемся
            $transaction->rollback();
        }

        if ($model->hasErrors()) {
            Yii::$app->session->setFlash('danger',Html::errorSummary($ext_page));
        }

        if ($ext_page->hasErrors()) {
            Yii::$app->session->setFlash('danger',Html::errorSummary($model));
        }

        return $this->render('create', [
            'model' => $model,
            'ext_page' => $ext_page,
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ext_page = $model->extPage;
        if ($ext_page == NULL)
            $ext_page = new ExtPage();

        if ($model->load(Yii::$app->request->post()) && $ext_page->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save()) {
                $ext_page->page_id = $model->id;
                $ext_page->imageFile = UploadedFile::getInstance($ext_page, 'imageFile');
                $ext_page->imageMainFile = UploadedFile::getInstance($ext_page, 'imageMainFile');
                if ($ext_page->save()) {
//                    var_dump($ext_page->errors);exit;
                    // если сохранение прошло без ошибок, то коммитим транзакцию

                    $transaction->commit();
//                    var_dump($ext_page);exit;
                    Yii::$app->session->setFlash('success', 'Изменения внесены успешно.');
                    return $this->redirect(['index']);
                }
            }
            // если хоть одно из сохранений не удалось, то откатываемся
            $transaction->rollback();
        }

        if ($model->hasErrors()) {
            Yii::$app->session->setFlash('danger',Html::errorSummary($ext_page));
        }

        if ($ext_page->hasErrors()) {
            Yii::$app->session->setFlash('danger',Html::errorSummary($model));
        }

        return $this->render('update', [
            'model' => $model,
            'ext_page' => $ext_page,
        ]);
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
