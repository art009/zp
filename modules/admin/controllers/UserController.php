<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\modelsSearch\User as SearchUser;
use app\modules\admin\components\AdminController;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use budyaga\users\models\forms\AssignmentForm;
use yii\web\Response;

class UserController extends AdminController
{
    public $_model = false;
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUser;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

	/**
	 * Форма смены пароля
	 * @param $id
	 * @return array
	 * @throws NotFoundHttpException
	 */
    public function actionChangePassword($id)
    {
        $user = $this->findModel($id);
        $user->scenario = User::SCENARIO_CHANGE_PASSWORD;
        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            Yii::$app->session->setFlash('success','Пароль изменен успешно');
        }

        if($user->hasErrors())
        {
            Yii::$app->session->setFlash('danger',Html::errorSummary($user));
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => true,
            'content' => $this->renderAjax('change-password',['user' => $user]),
        ];
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPermissions($id)
    {
        $modelForm = new AssignmentForm;
        $modelForm->model = $this->findModel($id);

        if ($modelForm->load(Yii::$app->request->post()) && $modelForm->save()) {
            Yii::$app->session->setFlash('success', Yii::t('users', 'SUCCESS_UPDATE_PERMISSIONS'));
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('permissions', [
            'modelForm' => $modelForm
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($this->_model === false) {
            $this->_model = User::findOne($id);
        }
        if ($this->_model !== null) {
            return $this->_model;
        }

        throw new NotFoundHttpException($this->errorsMessage()[404]);
    }

}
