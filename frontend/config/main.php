<?php

use \yii\web\Request;

$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'on beforeRequest' => function () {

        $pathInfo = Yii::$app->request->pathInfo;

        if (!empty($pathInfo) && ($pathInfo === 'site/index' || $pathInfo === 'site/contacts' )) {
            Yii::$app->response->redirect(Yii::$app->homeUrl, 301);
        }

    },
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'kovkasnab',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(index|contacts)>' => 'site/<action>',
                'post' => 'post/index',
                'post/<slug>' => 'post/view',
                'product' => 'product/index',
                'product/<slug>' => 'product/view',
                'category/<slug>' => 'product/category',
                'sitemap.xml' => 'site/sitemapxml',
                'sitemap' => 'site/sitemap',
                'conditions' => 'site/conditions',
            ],
        ],
    ],
    'params' => $params,
];
