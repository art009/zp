<?php

namespace app\components;

use app\models\Redirect;
use yii\web\UrlRuleInterface;
use yii\web\UrlNormalizerRedirectException;

class RedirectUrlRule implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        return false; // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $requestUrl = $request->getAbsoluteUrl();

        $redirect = Redirect::findOne([
            'old_url' => $requestUrl
        ]);

        if ($redirect) {
            $model_name = $redirect->model_name;

            if (class_exists($model_name)) {
                $model_search = $model_name;
            } elseif (class_exists('\app\models\\'.$model_name)){
                $model_search = '\app\models\\'.$model_name;
            } else {
                return false;
            }
            $redirect->model_name = $model_search;
            throw new UrlNormalizerRedirectException($redirect->page->urlPage,301);
        }

        return false; // this rule does not apply
    }
}