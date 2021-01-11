<?php
namespace app\widgets\GoogleReCaptcha;

use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\httpclient\Client as HttpClient;
use yii\httpclient\Request as HttpClientRequest;
use yii\validators\Validator;

class GoogleReCaptchaValidator extends Validator
{
    const SITE_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /** @var boolean Whether to skip this validator if the input is empty. */
    public $skipOnEmpty = false;

    /** @var string The shared key between your site and ReCAPTCHA. */
    public $secret;

    /** @var string */
    public $uncheckedMessage;

    /** @var \yii\httpclient\Request */
    public $httpClientRequest;

    public $acceptScore = 0.4;

    /** @var boolean */
    protected $isValid = false;

    public function init()
    {
        if ($this->skipOnEmpty)
            return ;
        parent::init();

        $params = Yii::$app->params['reCaptcha'];

        if (empty($this->secret)) {
            if ($params && !empty($params['secret'])) {
                $this->secret = $params['secret'];
            } else {
                throw new InvalidConfigException('Required `secret` param isn\'t set.');
            }
        }

        if ($params && $params['acceptScore'])
            $this->acceptScore = $params['acceptScore'];

        if (empty($this->httpClientRequest) || !($this->httpClientRequest instanceof HttpClientRequest)) {
            $this->httpClientRequest = (new HttpClient())->createRequest();
        }

        if ($this->message === null) {
            $this->message = Yii::t('yii', 'The verification code is incorrect.');
        }
    }

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     * @param \yii\web\View $view
     * @return string
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $message = addslashes($this->uncheckedMessage ?: Yii::t(
            'yii',
            '{attribute} cannot be blank.',
            ['attribute' => $model->getAttributeLabel($attribute)]
        ));

        return <<<JS
if (!value) {
     messages.push("{$message}");
}
JS;
    }

    /**
     * @param string|array $value
     * @return array|null
     * @throws Exception
     * @throws \yii\base\InvalidParamException
     */
    protected function validateValue($value)
    {
        if ($this->skipOnEmpty) {
            $this->isValid = true;
            return ;
        }

        if (!$this->isValid) {
            if (!empty($value)) {
                $response = $this->getResponse($value);

                if (!isset($response['success'])) {
                    throw new Exception('Invalid recaptcha verify response.');
                }

                if (key_exists('score',$response) && $this->acceptScore <= $response['score'])
                    $this->isValid = (boolean)$response['success'];
            } else {
                $this->isValid = false;
            }
        }

        return $this->isValid ? null : [$this->message, []];
    }

    /**
     * @param string $value
     * @return array
     * @throws Exception
     * @throws \yii\base\InvalidParamException
     */
    protected function getResponse($value)
    {
        $response = $this->httpClientRequest
            ->setMethod('GET')
            ->setUrl(self::SITE_VERIFY_URL)
            ->setData(['secret' => $this->secret, 'response' => $value, 'remoteip' => Yii::$app->request->userIP])
            ->send();

        if (!$response->isOk) {
            throw new Exception('Unable connection to the captcha server. Status code ' . $response->statusCode);
        }

        return $response->data;
    }
}
