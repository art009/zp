<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "category_menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class CategoryMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
	        [['depart'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'description' => 'Полное описание',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Автор',
            'updated_by' => 'Модератор',
	        'depart' => 'Подразделение',
        ];
    }

    /**
     * @inheritdoc
     */
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

    public function getCreater()
    {
        return User::findIdentity($this->created_by);
    }

    public function getUpdater()
    {
        return User::findIdentity($this->updated_by);
    }

    static public function getItemsMenu($category,$parent = NULL)
    {
        $res_array = [];

        $items = Menu::find()
            ->where([
                'parent' => $parent,
                'category_id' => $category,
            ])
            ->orderBy('position')
            ->all();

        foreach ($items as $item) {
            $menu_item = [
                'label' => $item->name,
                'url' => $item->realUrl,
            ];

            if ($item->children){
                $menu_item['items'] = self::getItemsMenu($category,$item->id);
            }

            $res_array[] = $menu_item;
        }

        return $res_array;
    }
}
