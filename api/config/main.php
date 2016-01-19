<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), 
        require(__DIR__ . '/../../common/config/params-local.php'), 
        require(__DIR__ . '/params.php'), 
        require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'yii2-restful-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'   // here is our v1 modules
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
    ],
    'components' => [
        'request' => [
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ], // config error handling
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],
        // UserIdentity
        'user' => [
            'identityClass' => 'api\common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        // Logging
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // Caching
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,  // Disable r = routes
            'enableStrictParsing' => true,
            'showScriptName' => false, // Disable index.php
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/country', 'v1/user', 'v1/category', 'v1/post'], // our api rule,
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET search' => 'search',
                    ],
                ],
                'controller/test/<parameter:\w+>' => 'controller/test', //REST Yii2 activecontroller passing a text parameter
            ],
        ]
    ],
    'params' => $params,
];

return $config;
