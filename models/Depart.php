<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "depart".
 *
 * @property int $id
 * @property string $name Название департамента
 * @property string $slug Slug
 * @property string $phone Телефон
 * @property string $email Email
 * @property string $address Адрес
 */
class Depart extends \yii\db\ActiveRecord
{
	const PATH_SLIDER = '/uploads/depart';
	public $imageFile;
	public $remove_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'depart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'address'], 'string', 'max' => 255],
            [['slug', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 25],
	        [['image'], 'string', 'max' => 255],
	        [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
	        [['is_main'], 'in', 'range'=>[0,1]],
	        [['is_main'], 'filter', 'filter' => [$this, 'setMain']],
	        ['remove_image','boolean'],
	        ['mails','string', 'max' => 255],
        ];
    }

	public function setMain($value) {
    	if ($value == 1) {
		    self::updateAll([
		    	'is_main' => 0
		    ]);
	    }
		return $value;
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name'          => 'Название департамента',
            'slug'          => 'Slug',
            'phone'         => 'Телефон',
            'email'         => 'Email',
            'address'       => 'Адрес',
	        'image'         => 'Картинка',
	        'imageFile'     => 'Картинка',
	        'is_main'       => 'Основное',
	        'remove_image' => 'Удалить картинку',
        ];
    }

	public function getImgLink()
	{
		$path = Yii::getAlias('@webroot') . self::PATH_SLIDER;
		$file_link = Yii::getAlias('@web/img/default_depart.jpg');
		if (is_file($path . DIRECTORY_SEPARATOR . $this->image))
			$file_link = Yii::getAlias('@web') . self::PATH_SLIDER . '/' . $this->image;
		return $file_link;
	}

	public function upload()
	{
		$path = Yii::getAlias('@webroot/uploads/depart');
		if(!is_dir($path))
			FileHelper::createDirectory($path,'0775',true);

		if ($this->validate() && $this->imageFile) {
			// удалим старый файл если такой есть
			if ($this->image) $this->deleteImage();

			$new_file_name = time() . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
			$this->imageFile->saveAs($path . DIRECTORY_SEPARATOR . $new_file_name);
			$this->image = $new_file_name;
			return true;
		} elseif ($this->image && !$this->isNewRecord) {
			return true;
		} else {
			return false;
		}
	}

	public function beforeSave($insert)
	{
		if ($this->remove_image) {
			$this->deleteImage();
			$this->image = NULL;
		}
		return parent::beforeSave($insert); // TODO: Change the autogenerated stub
	}

	public static function getDepartList()
	{
		return ArrayHelper::map(self::find()->orderBy('is_main DESC')->all(),'id','name');
	}

	public function beforeDelete()
	{
		$this->deleteImage();
		return parent::beforeDelete(); // TODO: Change the autogenerated stub
	}

	public function deleteImage()
	{
		$path = Yii::getAlias('@webroot/uploads/depart');
		$file = $path . DIRECTORY_SEPARATOR . $this->image;
		if (is_file($file)) {
			@unlink($file);
		}
	}

	public function getMainPage()
	{
		return $this->hasOne(Pages::className(), ['id' => 'page_id'])
			->where([
				'layout' => \app\helpers\Pages::LAYOUT_DEPART,
			])
			->via('extPage');
	}

	public function getExtPage()
	{
		return $this->hasMany(ExtPage::className(), ['depart' => 'id']);
	}

	public static function getList()
	{
		return ArrayHelper::map(self::find()->all(),'id','name');
	}

	public static function defaultDepart()
	{
		return self::find()->where([
			'is_main' => 1
		])->one();
	}

	public function getPage()
	{
		return $this->hasOne(Pages::className(), ['id' => 'page_id'])
			->via('extPage');
	}
}
