<?php

namespace app\modules\admin\controllers;

use app\models\Menu;
use Yii;
use app\models\CategoryMenu;
use app\modelsSearch\CategoryMenu as CategoryMenuSearch;
use app\modules\admin\components\AdminController;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends AdminController
{
    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
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
     * Deletes an existing Menu model.
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
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
    }

    public function actionAjaxTreeJs($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $items = $this->generateArrayMenuTree($id,NULL);
        return $items;
    }
    // генерировать меню в JSON
    private function generateArrayMenuTree($id,$parent = NULL)
    {
        $result_array = [];
        $models = Menu::find()
            ->where([
                'parent'        => $parent,
                'category_id'   => $id,
            ])
            ->orderBy(['position' => SORT_ASC])
            ->all();
        foreach ($models as $model){
            $item = [];
            $item['id'] = 'js_tree_' . $model->id;
            $item['text'] = $model->name;
            $children = $this->generateArrayMenuTree($id,$model->id);
            if (!empty($children))
                $item['children'] = $children;
            $result_array[] = $item;
        }
        return $result_array;
    }
    // добавить раздел меню
    public function actionAddPoint()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ((Yii::$app->request->post('id_category') != null) &&
                Yii::$app->request->post('menu_name') &&
                Yii::$app->request->post('id_parent')
            ){
            $model = new Menu();
            $model->category_id = Yii::$app->request->post('id_category');
            $parent_id = (Yii::$app->request->post('id_parent') == '#') ? NULL :str_replace('js_tree_','',Yii::$app->request->post('id_parent'));
            $model->parent = $parent_id;
            $model->name = Yii::$app->request->post('menu_name');
            if ($model->save())
                return [
                    'id' => $model->id,
                    'form_data' => $this->renderAjax('_menu_item',['model' => $model]),
                ];
            else {
                return ['error' => 'Возникла ошибка при сохранение'];
            }
        } else {
            return ['error' => 'Не заполнено поле.'];
        }
    }
    // обновление пункта меню
    public function actionUpdatePoint($id)
    {
        $model = $this->findModelPoint($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//var_dump( $model->type );exit;
            Yii::$app->session->setFlash('success','Пункт меню успешно сохранен.');
        }
        if ($model->hasErrors()){
            Yii::$app->session->setFlash('error',Html::errorSummary($model,['header','Исправьте ошибки:']));
        }
        return $this->renderAjax('_menu_item',['model' => $model]);
    }
    // Переименовать раздел меню
    public function actionRenamePoint()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ((Yii::$app->request->post('id_record') != null)) {
            $id = str_replace('js_tree_', '', Yii::$app->request->post('id_record'));
            $model = $this->findModelPoint($id);
            if (Yii::$app->request->post('menu_name')) {
                $model->name = Yii::$app->request->post('menu_name');
                if (!$model->save())
                    return ['error' => 'Возникла ошибка при сохранение'];
                else
                    return ['success' => 'Изменение сохранено.'];
            }
            return [
                'form_data' => $this->renderAjax('_menu_item', ['model' => $model]),
            ];
        } else {
            return ['error' => 'Нет выбранной записи.'];
        }
    }
    // Удалить раздел меню
    public function actionRemovePoint($id_remove)
    {
        $id = str_replace('js_tree_','',$id_remove);
        $this->findModelPoint($id)->delete();
        return true;
    }
    // сохранить изменения по сортировки
    public function actionOrderMenu()
    {
        $parent = Yii::$app->request->post('parent_id');
        $parent_id = ($parent == '#')? NULL : $this->clear_id($parent);
        if ( Yii::$app->request->post('childrens') !== NULL)
            $childrens_array = Yii::$app->request->post('childrens');
        else
            $childrens_array = [];

        $childrens = array_map(array($this,"clear_id"),$childrens_array);
        $start_pos = 1;
        foreach ($childrens as $children_id){
            $model = Menu::findOne($children_id);
            $model->position = $start_pos;
            $model->parent = $parent_id;
            $model->save();
            $start_pos++;
        }
    }

    protected function findModelPoint($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
    }
    // очистка ид от ключа
    private function clear_id($id)
    {
        return str_replace('js_tree_','',$id);
    }
}
