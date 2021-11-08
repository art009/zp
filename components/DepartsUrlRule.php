<?php

namespace app\components;

use app\models\Depart;
use app\models\Pages;
use Yii;
use yii\web\UrlRuleInterface;
use yii\web\UrlNormalizerRedirectException;

class DepartsUrlRule implements UrlRuleInterface
{
	public function createUrl($manager, $route, $params)
	{
		$url = Yii::getAlias('');// . $params['url'];
		if ($route === 'site/depart') {
			if (isset($params['url'])) {
				$url .= '/' . $params['url'];
			}
			return $url;
		}
		if ($route === 'site/news') {
			if (isset($params['depart'])) {
				$url .= $params['depart'].'/';
			}
			if (isset($params['url'])) {
				$url .= 'news/' . $params['url'];
			}
			return $url;
		}
		if ($route === 'site/article') {
			if (isset($params['depart'])) {
				$url .= $params['depart'].'/';
			}
			if (isset($params['url'])) {
				$url .= 'article/' . $params['url'];
			}

			return $url;
		}

		if ($route === 'site/staff') {
			if (isset($params['depart'])) {
				$url .= $params['depart'].'/';
			}
			if (isset($params['url'])) {
				$url .= 'staff/' . $params['url'];
			}
			return $url;
		}
		if ($route === 'site/faq-views') {
			if (isset($params['depart'])) {
				$url .= $params['depart'].'/';
			}
			if (isset($params['id'])) {
				$url .= 'faq_view_'. $params['id'] . '.htm';
			}
			return $url;
		}
		if ($route === 'site/page') {
			if (isset($params['depart'])) {
				if ( is_int($params['depart']) )
					$url .= !empty(Yii::$app->params['depart_slug'])?Yii::$app->params['depart_slug'].'/':'/';
				else
					$url .= $params['depart'].'/';
			}
			if (isset($params['url'])) {
				$url .=  $params['url'] . '.htm';
			}
			if (isset($params['page']) && $params['page'] != 1) {
				$url .= '?page=' . $params['page'];
				$url .= '&per-page=21';
			}
			return $url;
		}

		return false;  // данное правило не применимо
	}

	public function parseRequest($manager, $request)
	{
//		$requestUrl = $request->getAbsoluteUrl();

		$requestUrl = $request->pathInfo;

		$depart = Depart::findOne([
			'slug' => $requestUrl
		]);

		if ($depart) {
			$route = 'site/depart';
			$params['url'] = $depart->slug;
			return [$route,$params];
		}

		if (preg_match('~([^\/]*)\.htm~i', $requestUrl, $page)) {
			if( strpos($page[1],'faq_view_') !== FALSE )  {
				$route = 'site/faq-views';
				$params = [
					'id' => str_replace('faq_view_','',$page[1])
				];
				return [$route,$params];
			}
			$page_ar = Pages::findOne(['url'=>$page[1]]);
			if ($page_ar) {
				$default_depart = Depart::defaultDepart();
				$route = 'site/page';
				$params['url'] = $page[1];
				$params['depart'] = $default_depart->id;
				return [$route,$params];
			}
		}
		$array_static = $this->_staticPageUrl();
		$path_array = explode('/',$requestUrl);
		if ( in_array($path_array[0],$array_static) ) {
			$route = 'site/'.$path_array[0];
			$params['url'] = $path_array[1];
			$params['depart'] = !empty(Yii::$app->params['depart'])?Yii::$app->params['depart']:null;
			return [$route,$params];
		}
		if ( !empty(Yii::$app->params['depart_slug'])
			&& $path_array[0] == Yii::$app->params['depart_slug']
		) {
//			var_dump($path_array[1]);
//			var_dump(in_array($path_array[1],['news','article','staff','faq-views']));exit;
			if (in_array($path_array[1],$array_static)) {
				$route = 'site/'.$path_array[1];
				$params['url'] = $path_array[2];
				$params['depart'] = !empty(Yii::$app->params['depart'])?Yii::$app->params['depart']:null;
				return [$route,$params];
			}
		}

		return false; // this rule does not apply
	}

	private function _staticPageUrl()
	{
		return [
			'news',
			'article',
			'staff',
			'faq-views'
		];
	}
}