<?php

namespace app\modules\admin\controllers;

use app\helpers\Formats;
use app\models\Pages;
use app\helpers\Pages as HelperPage;
use app\models\PriceItems;
use app\models\PriceList;
use Yii;
use app\models\Staff;
use app\modelsSearch\PriceList as PriceListSearch;
use app\modules\admin\components\AdminController;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class PriceController extends AdminController
{
    /**
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriceListSearch();
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
        $model = new PriceList();

	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    Yii::$app->session->setFlash('success','Прайс лист успешно сохранен');
		    return $this->redirect(['update', 'id' => $model->id]);
	    }

        return $this->render('create', [
            'model' => $model,
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
	    $item = new PriceItems();
	    $item->price_id = $id;

	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    Yii::$app->session->setFlash('success','Данные успешно сохранены');
		    return $this->redirect(['index']);
	    }

        if ($model->hasErrors()){
            Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
        }

        return $this->render('update', [
            'model' => $model,
	        'item' => $item,
	        'items' => $model->items,
        ]);
    }

    public function actionAddItem()
    {
	    $item = new PriceItems();
	    $result['status'] = false;
	    if ($item->load(Yii::$app->request->post()) && $item->save()) {
	    	$data = $item->attributes;
		    $data['delete_link'] = Url::to(['delete-item','id'=>$item->id]);
		    $result = [
		    	'status' =>  true,
			    'item' => $data,
		    ];
	    }

	    Yii::$app->response->format = Response::FORMAT_JSON;
//	    return $item->errors;
	    return $result;
    }

	public function actionDeleteItem($id)
	{
		if (($item = PriceItems::findOne($id)) === null) {
			throw new NotFoundHttpException($this->errorsMessage()[404]);
		}
		Yii::$app->response->format = Response::FORMAT_JSON;
		return ['status' => $item->delete()];
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
        if (($model = PriceList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException($this->errorsMessage()[404]);
    }
}
