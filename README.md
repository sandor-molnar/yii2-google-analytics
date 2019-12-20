# Yii2 Google Analytics
A simple package, what insert GTAG code in your website with the given `trackingId`.
## Installion
```
composer require sanyisasha/yii2-google-analytics
```
or add
```
"sanyisasha/yii2-google-analytics": "*"
```
in your `composer.json` file, the run `composer install`

## Config
Example config
```php
'bootstrap' => ['ga'],
'components' => [
    'ga' => [
        'class' => 'sanyisasha\yii2googleanalytics\components\Component',
        'trackingId' => 'UA-XXXXXXXXX-XX', // GA code, you can find it in administration
        'enabled' => YII_ENV_PROD, // bool or callable
    ]
]
```