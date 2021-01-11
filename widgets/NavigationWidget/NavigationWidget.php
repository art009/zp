<?php
namespace app\widgets\NavigationWidget;

use Yii;
use app\models\Menu;
use yii\base\Widget;

class NavigationWidget extends Widget
{
    public $view;
    public $depth;
    public $group;

    public function run()
    {
        $items = $this->getArrayItems(NULL,$this->group,$this->depth);
        return $this->render($this->view,['items' => $items]);
    }

    private function getArrayItems($parent = NULL,$group,$depth = NULL)
    {
        $items = [];
        $menus = Menu::find()
            ->where([
                'category_id' => $group,
                'parent' => $parent
            ])
            ->all();
        foreach ($menus as $menu)
        {
            if ($depth && $menu->getChildren()->count() > 0)
            {
                $sub_items = $this->getArrayItems($menu->id,$group,$depth - 1);
            }
            $items[] = [
                'url' => $menu->getRealUrl(),
                'label' => $menu->name,
                'active' => ($menu->getRealUrl() == Yii::$app->request->baseUrl),
            ];
        }

        return $items;
    }
}