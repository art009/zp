<?php

namespace app\modules\admin\controllers;

use app\models\ExtPage;
use app\models\Gallery;
use app\models\PriceList;
use Yii;
use app\models\Pages;
use app\modelsSearch\Pages as PagesSearch;
use app\helpers\Pages as PagesHelper;
use app\modules\admin\components\AdminController;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\helpers\FileHelper;
use yii\helpers\Json;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends AdminController
{
    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $searchModel->layouts = array_keys( PagesHelper::getArrayLayout() );
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
				    Yii::$app->session->setFlash('success','Страница успешно сохранена');
				    return $this->redirect(['update', 'id' => $model->id]);
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

        $image = new Gallery();
        return $this->render('create', [
            'model' => $model,
            'image' => $image,
            'imageList' => Json::encode([]),
            'ext_page' => $ext_page,
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
				    // если сохранение прошло без ошибок, то коммитим транзакцию
				    $transaction->commit();
				    Yii::$app->session->setFlash('success','Страница успешно сохранена');
				    return $this->redirect(['index']);
			    }
		    }
		    // если хоть одно из сохранений не удалось, то откатываемся
		    $transaction->rollback();
	    }


	    if ($model->hasErrors()) {
		    Yii::$app->session->setFlash('danger',Html::errorSummary($ext_page,['header' => 'Исправьте следующие ошибки:']));
	    }

	    if ($ext_page->hasErrors()) {
		    Yii::$app->session->setFlash('danger',Html::errorSummary($model,['header' => 'Исправьте следующие ошибки:']));
	    }

        $image = new Gallery();
        return $this->render('update', [
            'model' => $model,
            'image' => $image,
	        'ext_page' => $ext_page,
            'imageList' => (key_exists('files',$this->arrayListImage($id)))?Json::encode($this->arrayListImage($id)['files']):Json::encode([]),
        ]);
    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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

    // добавление изображения к товару
    public function actionImageUpload($id)
    {
        $model = new Gallery();
        $model->page_id = $id;
        $imageFile = UploadedFile::getInstance($model, 'file');

        $directory = $model->dirPath . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            $model->image = $fileName;
            if ($imageFile->saveAs($filePath) && $model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $this->arrayListImage($model->page_id,$model->id);
            }
        }

        return '';
    }
    // удаление изображения
    public function actionImageDelete($id)
    {
        $model = Gallery::findOne(['id' => $id]);

        if ($model) {
            $model->delete();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['message' => 'Картинка удалена!'];
        }
    }
    // список картинок у товара
    public function actionListImage($page_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->arrayListImage($page_id)['files'];

        Yii::$app->end();
    }

    private function arrayListImage($id,$image_id = NULL)
    {
        if ($image_id != NULL)
            $models = Gallery::findAll(['id' => $image_id]);
        else
            $models = Gallery::findAll(['page_id' => $id]);
        $output = [];

        foreach ($models as $model) {
        	if (is_file($model->getFullPath())) {
		        $output['files'][] = [
			        'name' => ($model->description)?$model->description:$model->image,
			        'size' => filesize($model->getFullPath()),
			        'url' => $model->getUrlImage(),
			        'thumbnailUrl' => $model->getThumbnail(120,120),
			        'deleteUrl' => Yii::$app->urlManager->createUrl(['/admin/pages/image-delete', 'id' => $model->id]),
			        'modifUrl' => Yii::$app->urlManager->createUrl(['/admin/pages/image-update', 'id' => $model->id]),
			        'deleteType' => 'POST',
		        ];
	        }

        }

        return $output;
    }
    // изменение
    public function actionImageUpdate($id)
    {
        $model = Gallery::findOne(['id' => $id]);
        if (!$model)
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');

        if ($model->load(Yii::$app->request->post()) && $model->save())
            Yii::$app->session->setFlash('success','Данные сохранены');
        if ($model->hasErrors())
            Yii::$app->session->setFlash('error',Html::errorSummary($model,['header' => false]));

        return $this->renderAjax('_image',['model' => $model]);
    }

    public function actionDeletePrice($page_id,$price_id)
    {
	    $status = Yii::$app->db->createCommand()->delete('{{%price_page}}','page_id = :page_id AND price_id = :price_id',[
		    ':page_id' => $page_id,
		    ':price_id' => $price_id
	    ])->execute();
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    return [
	    	'status' => $status
	    ];
    }
}
