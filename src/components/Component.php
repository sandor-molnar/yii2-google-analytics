<?php

namespace sanyisasha\yii2googleanalytics\components;

use yii\base\InvalidConfigException;

class Component extends \yii\base\Component
{
    /**
     * @var $trackingId string The tracking id. More info: https://support.google.com/analytics/thread/13109681
     */
    public $trackingId;
    /**
     * @var $enabled bool|callable Track the current load.
     */
    public $enabled;

    public function init()
    {
        if (is_callable($this->enabled)) {
            $this->enabled = call_user_func($this->enabled, $this);
        }

        if ($this->enabled === true) {
            if (empty($this->trackingId)) {
                throw new InvalidConfigException('You should set `trackingId` if the package is enabled.');
            }

            $this->register();
        } else {
            \Yii::warning('Google Analytics is loaded in config, but not enabled!');
        }

    }

    private function register() {
        \Yii::$app->view->registerJsFile('https://www.googletagmanager.com/gtag/js?id='.$this->trackingId);
        $js = <<<JS
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
        
            gtag('config', '$this->trackingId');
JS;
        \Yii::$app->view->registerJs($js);
    }
}