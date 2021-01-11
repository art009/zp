<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "sliders".
 *
 * @property int $id
 * @property int $created_at Дата добавления
 * @property int $updated_at Дата изменения
 * @property int $created_by Автор
 * @property int $updated_by Модератор
 * @property string $images Картинка
 * @property string $name Название
 * @property string $description Описание
 * @property string $url URL
 * @property int $page_id Страница
 */
class Sliders extends \yii\db\ActiveRecord
{
    const PATH_SLIDER = '/uploads/sliders';
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sliders';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name' ], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'page_id'], 'integer'],
            [['images', 'name', 'description', 'url'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => ($this->images)?true:false, 'extensions' => 'png, jpg, bmp'],
            ['position', 'integer'],
	        ['depart', 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at'    => 'Дата добавления',
            'updated_at'    => 'Дата изменения',
            'created_by'    => 'Автор',
            'updated_by'    => 'Модератор',
            'images'        => 'Картинка',
            'name'          => 'Название',
            'description'   => 'Описание',
            'url'           => 'URL',
            'page_id'       => 'Страница',
            'position'      => 'Сортировка',
	        'depart'        => 'Подразделение',
            //--------------------
            'imageFile'     => 'Картинка на слайдер',
        ];
    }

    public function getCreater()
    {
        return $this->hasOne(User::className(),['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(),['id' => 'updated_by']);
    }

    public function getImgLink()
    {
        $path = Yii::getAlias('@webroot') . self::PATH_SLIDER;
        $file_link = Yii::getAlias('@web/img/default_slider.jpg');
        if (is_file($path . DIRECTORY_SEPARATOR . $this->images))
            $file_link = Yii::getAlias('@web') . self::PATH_SLIDER . '/' . $this->images;
        return $file_link;
    }

    public function upload()
    {
        $path = Yii::getAlias('@webroot/uploads/sliders');
        if(!is_dir($path))
            FileHelper::createDirectory($path,'0775',true);

        if ($this->validate() && $this->imageFile) {
            $new_file_name = time() . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($path . DIRECTORY_SEPARATOR . $new_file_name);
            $this->images = $new_file_name;
            return true;
        } elseif ($this->images && !$this->isNewRecord) {
            return true;
        } else {
            return false;
        }
    }
    // привязанная страница к слайдеру
    public function getPage()
    {
        return self::hasOne(Pages::className(),['id' => 'page_id']);
    }
    // ссылка на страницу у слайдера
    public function getLinkPage()
    {
        $link = '#';
        if ($this->page)
            $link = $this->page->getUrlPage();
        if ($this->url)
            $link = $this->url;

        return $link;
    }

    public function getDep()
    {
    	return $this->hasOne(Depart::className(),['id'=>'depart']);
    }
}
