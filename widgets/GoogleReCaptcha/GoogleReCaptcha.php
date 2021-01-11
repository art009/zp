<?php
namespace app\widgets\GoogleReCaptcha;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use app\widgets\GoogleReCaptcha\assets\ReCaptchaAsset;

class GoogleReCaptcha extends InputWidget
{
    const JS_API_URL = '//www.google.com/recaptcha/api.js';

    /** @var string Your sitekey. */
    public $siteKey;

    /** @var string Your secret. */
    public $secret;

    /** @var string The color theme of the widget. [[THEME_LIGHT]] (default) or [[THEME_DARK]] */
    public $theme;

    /** @var string The type of CAPTCHA to serve. [[TYPE_IMAGE]] (default) or [[TYPE_AUDIO]] */
    public $type;

    /** @var string The size of the widget. [[SIZE_NORMAL]] (default) or [[SIZE_COMPACT]] or [[SIZE_INVISIBLE]] */
    public $size;

    /** @var integer The tabindex of the widget */
    public $tabIndex;

    /** @var string Your JS callback function that's executed when the user submits a successful CAPTCHA response. */
    public $jsCallback;

    /**
     * @var string Your JS callback function that's executed when the recaptcha response expires and the user
     * needs to solve a new CAPTCHA.
     */
    public $jsExpiredCallback;

    /** @var string Your JS callback function that's executed when reCAPTCHA encounters an error (usually network
     * connectivity) and cannot continue until connectivity is restored. If you specify a function here, you are
     * responsible for informing the user that they should retry.
     */
    public $jsErrorCallback;

    /** @var array Additional html widget options, such as `class`. */
    public $widgetOptions = [];

    public function run()
    {
        $view = $this->view;
        ReCaptchaAsset::register($view);

        $view->registerJs(
            <<<'JS'
var recaptchaOnloadCallback = function() {
    jQuery(".g-recaptcha").each(function() {
        var reCaptcha = jQuery(this);
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcYOGkUAAAAADLmdjXVy0tHfmDWiq3oMk0z2YML').then(function(token) {
                reCaptcha.val(token);
            });
        });
    });
};
JS
            , $view::POS_END, 'recaptcha-onload');

        if (Yii::$app->request->isAjax) {
            $view->registerJs(<<<JS
if (typeof grecaptcha !== "undefined") {
    recaptchaOnloadCallback();
}
JS
                , $view::POS_END
            );
        }

        $this->customFieldPrepare();
    }

    protected function getReCaptchaId()
    {
        if (isset($this->widgetOptions['id'])) {
            return $this->widgetOptions['id'];
        }

        if ($this->hasModel()) {
            return Html::getInputId($this->model, $this->attribute);
        }

        return $this->id . '-' . $this->name;
    }

    protected function customFieldPrepare()
    {
        $inputId = $this->getReCaptchaId();

        if ($this->hasModel()) {
            $inputName = Html::getInputName($this->model, $this->attribute);
        } else {
            $inputName = $this->name;
        }

        echo Html::input('hidden', $inputName, null, ['id' => $inputId,'class' => 'g-recaptcha']);
    }
}
