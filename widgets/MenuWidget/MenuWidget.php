<?php
namespace app\widgets\MenuWidget;

use app\models\CategoryMenu;
use app\models\Menu;
use yii\base\Widget;
use Yii;

class MenuWidget extends Widget
{
    public $menu_id = NULL;
    public $depth = 1;
    public $view = 'index';
    public $itemOptions;
    public $linkTemplate;
    public $options;
    public $submenuTemplate;
	public $encodeLabels = false;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
	    $menu_id = NULL;
        if ($this->menu_id === NULL) {
	        $depart = Yii::$app->params['depart'];
	        $catgory_menu = CategoryMenu::findOne(['depart' => $depart]);
	        if ($catgory_menu)
		        $menu_id = $catgory_menu->id;
        }
        if ($this->menu_id) {
	        $menu_id = $this->menu_id;
        }
//var_dump($menu_id);exit;
        if ($menu_id != NULL) {
            $items = $this->getMenuArray($menu_id, NULL, $this->depth);
//var_dump($items);exit;
	        if ($items) {
	            $params['items'] = $items;
	            if ( $this->itemOptions ) {
	                $params['itemOptions'] = $this->itemOptions;
	            }
	            if ( $this->linkTemplate ) {
	                $params['linkTemplate'] = $this->linkTemplate;
	            }
		        if ( $this->submenuTemplate ) {
			        $params['submenuTemplate'] = $this->submenuTemplate;
		        }
	            if ( $this->options ) {
		            $params['options'] = $this->options;
	            }
//	            if ($this->encodeLabels)
	            $params['encodeLabels'] = $this->encodeLabels;

	            return $this->render($this->view,['params'=>$params]);
	        }
        }
    }

    private function getMenuArray($category_id, $parent =0, $depth = 2)
    {
        $result = [];
        $menus = Menu::find()
            ->where([
                'category_id' => $category_id,
                'parent' => $parent,
            ])
            ->orderBy(['position' => SORT_ASC])
            ->all();

        $_menu = NULL;
        $_resolve = Yii::$app->request->resolve();

        if (isset($_resolve[1]['url']))
            $_menu = $_resolve[1]['url'];

        foreach ($menus as $menu)
        {
            if ($depth > 0 && $menu->getChildren()) {
                $items = $this->getMenuArray($category_id, $menu->id,$depth - 1);
            }

            $_res['active'] = ($menu->pageRelativ)?($_menu == $menu->pageRelativ->url):false;
            $_res['url'] = $menu->getRealUrl();
	        if ( is_array($this->itemOptions) && key_exists('class', $this->itemOptions) )
		        $_res['options']['class'] = $this->itemOptions['class'];

            if (empty($items)) {
                $_res['label'] = $menu->name ;//. ' - ' . $menu->pageRelativ->layout;
                if (isset($_res['items']))
                    unset($_res['items']);
            } else {
                $_res['label'] = $menu->name ;//. ' - ' . $menu->pageRelativ->layout;
	            if ( is_array($this->itemOptions) && key_exists('class', $this->itemOptions) )
		            $_res['options']['class'] = $this->itemOptions['class'] . ' dropdown';
	            else
		            $_res['options']['class'] = '';
//	            $_res['template'] = '<a href="{url}">{label}</a>';
                if ($depth == 2 && $this->depth >= 3) {
                    $_res['label'] = '<i class="fa fa-caret-right"></i>' . $menu->name;
                    $_res['url'] = '#';
                }

                $_res['items'] = $items;
                //$_res['label'] = $menu->name . '<span class="pull-right-container"><span class="label label-primary pull-right" onclick="showSubMenu(this,event)">' . count($items) . '</span></span>';
            }
            $result[] = $_res;
        }
        return $result;
    }
}