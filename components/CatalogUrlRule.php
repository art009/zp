<?php
namespace app\components;
use app\models\Categories;
use app\models\Pages;
use app\helpers\Pages as HelperPages;
use yii\helpers\Json;
use Yii;
use yii\web\UrlRuleInterface;

class CatalogUrlRule implements UrlRuleInterface
{
    private $path_to_category;

    /**
     * Parses the given request and returns the corresponding route and parameters.
     * @param \yii\web\UrlManager $manager the URL manager
     * @param \yii\web\Request $request the request component
     * @return array|bool the parsing result. The route and the parameters are returned as an array.
     * If `false`, it means this rule cannot be used to parse this path info.
     */
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'catalog' || $route === 'catalog/index') {
            $page = false;
            if ($params['page']){
                $page = $params['page'];
            }

            if ($params['url']) {
                $this->path_to_category = [];
                $this->generateInnerRoute($params['url']);
                if ($page)
                    return 'catalog/' . implode('/',array_reverse($this->path_to_category)) . '?page=' . $page;
                else
                    return 'catalog/' . implode('/',array_reverse($this->path_to_category));
            } else {
                $page = Pages::findOne(['layout' => HelperPages::LAYOUT_CATALOG]);
                if ($page)
                    return $page->getUrlPage();
            }
        }

        return false;
    }

    private function generateInnerRoute($url)
    {
        $result = Categories::findOne(['url' => $url]);
        if ($result)
            $this->path_to_category[] = $result->url;
        $parent = $result->parentCat;
        if ($parent)
            $this->generateInnerRoute($parent->url);
    }

    /**
     * Parse request
     * @param \yii\web\Request|\yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|boolean
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        $categorys_array = explode('/',$pathInfo);

        if (array_shift($categorys_array) == 'catalog') {
            do {
                $url = array_shift($categorys_array);
                $category = Categories::findOne(['url' => $url]);
                if (!$category)
                    return false;
            } while ($categorys_array);

            return [ '/catalog/index', ['url' => $url]];
        }

        return false;
    }
}