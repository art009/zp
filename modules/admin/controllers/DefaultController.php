<?php

namespace app\modules\admin\controllers;

use app\models\PriceList;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use app\modules\admin\components\AdminController;
use app\models\Pages;
use yii\db\Query;
use yii\helpers\Url;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    // загрузка файлов в CKEditor
    public function actionUpload(){
        $uploadedFile = UploadedFile::getInstanceByName('upload');

        $file = time()."_".$uploadedFile->name;

        $url = Yii::$app->urlManager->createUrl('/uploads/ckeditor/'.$file);
        $dir = Yii::getAlias('@webroot').'/uploads/ckeditor/';
        if (!is_dir($dir))
            FileHelper::createDirectory($dir,0775,true);
        $uploadPath = $dir.$file;

        if ($uploadedFile==null)
        {
            $message = "Файл не найден.";
        }
        else if ($uploadedFile->size == 0)
        {
            $message = "Файл пустой.";
        }
        else if ($uploadedFile->tempName==null)
        {
            $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        }
        else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);

            if(!$move)
            {
                $message = "Ошибка записи файла. Проверьте директорию для записи.";
            }
        }

        $funcNum = $_GET['CKEditorFuncNum'];

        \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

    public function actionPagesList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, title_page AS text')
                ->from('{{%pages}}')
                ->where(['like', 'title_page', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Pages::find($id)->name];
        }
        return $out;
    }

    public function actionStaffList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                ->from('{{%staff}}')
                ->where(['like', 'name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Staff::find($id)->name];
        }
        return $out;
    }

	public function actionPriceList($page_id,$q = null, $id = null) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];
		if (!is_null($q)) {
			$query = new Query;
			$query->select('id, title AS text')
				->from('{{%price_list}}')
				->where(['like', 'title', $q])
				->limit(20);
			$command = $query->createCommand();
			$data = $command->queryAll();

			foreach ($data as $id => $record) {
//				var_dump($data[$id]);exit;
				$data[$id]['delete_link'] = Url::to(['/admin/pages/delete-price','page_id' => 6,'price_id' => $data[$id]['id']]);
			}

			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = [
				'id' => $id,
				'text' => PriceList::find($id)->name,
				'delete_link' => Url::to(['delete-price','page_id' => 6,'price_id' => $id]),
			];
		}
		return $out;
	}
}
