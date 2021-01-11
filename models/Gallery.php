<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property int $page_id Страница
 * @property string $image Картинка
 * @property string $description Описание
 *
 * @property Pages $page
 */
class Gallery extends \yii\db\ActiveRecord
{
    const PATH_UPLOAD = '@webroot/uploads/gallery';
    const URL_IMAGE = '/uploads/gallery';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'image'], 'required'],
            [['page_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['file'], 'file', 'extensions' => 'gif, jpg, png'],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Страница',
            'image' => 'Картинка',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }
    // полный путь до файла
    public function getFullPath()
    {
        return Yii::getAlias(self::PATH_UPLOAD) . DIRECTORY_SEPARATOR . $this->page_id . DIRECTORY_SEPARATOR . $this->image;
    }
    // ссылка на картинку
    public function getUrlImage()
    {
        return self::URL_IMAGE . '/' . $this->page_id . '/' . $this->image;
    }
    // полный путь до директории с файлом
    public function getDirPath()
    {
        return Yii::getAlias(self::PATH_UPLOAD) . DIRECTORY_SEPARATOR . $this->page_id;
    }
    // возвращает ссылку на картинку
    public function getThumbnail($w,$h)
    {
        $link = Yii::$app->request->getBaseUrl() . Yii::$app->params['no-img'];
        $file = $this->getDirPath() . DIRECTORY_SEPARATOR . $this->image;
        if (is_file($file) && $w && $h) {
            $cache_dir = $this->getDirPath() . DIRECTORY_SEPARATOR . 'caches' . DIRECTORY_SEPARATOR;
            $file_name = $w . 'x' . $h . '_' . $this->image;
            $cache_file = $cache_dir . $file_name;

            if (!is_dir($cache_dir))
                FileHelper::createDirectory($cache_dir);

            if (!is_file($cache_file)) {
                Image::thumbnail($file, $w, $h, ManipulatorInterface::THUMBNAIL_INSET)
                    ->save($cache_file, ['quality' => 60]);
            }

            $link = Yii::$app->request->getBaseUrl() . self::URL_IMAGE . '/' . $this->page_id . '/caches/' . $file_name;
        }

        return $link;
    }

    public function beforeDelete()
    {
        $this->clearChacheFile();
        $file = $this->getDirPath() . DIRECTORY_SEPARATOR . $this->image;
        if (is_file($file))
            @unlink($file);
        return parent::beforeDelete();
    }
    // удаление кэша
    private function clearChacheFile()
    {
        $cache_dir = $this->getDirPath() . DIRECTORY_SEPARATOR . 'caches';
        if (is_dir($cache_dir)) {
            $files = FileHelper::findFiles($cache_dir,['only'=>['*' . $this->image]]);
            foreach ($files as $file){
                @unlink($file);
            }
        }
    }
}
