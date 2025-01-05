<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'CastCompass',
    'name' => 'Cast&Compass',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ApiModule',
        ],
    ],
    'components' => [
      'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/user',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/profile',
                    'extraPatterns' => [
                        'GET count' => 'count',
                        'GET procurarnomes' => 'procurarnomes',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/produto',
                    'extraPatterns' => [
                        'GET count' => 'count',
                        'GET procurarnomes' => 'procurarnomes',
                        'GET countproducts' => 'countproducts',
                        'GET filtrarporcategoria' => 'filtrarporcategoria',
                        'GET {id}/nome' => 'nome',
                        'GET {id}/marca' => 'marca',
                        'GET {id}/preco' => 'preco',
                        'GET {id}/stock' => 'stock',
                        'GET {id}/descricao' => 'descricao',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/iva',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/categoria',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/metodopagamento',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/metodoexpedicao',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/favoritos',
                    'extraPatterns' => [
                        'GET count' => 'count',
                        'GET profilefavoritos' => 'profilefavoritos',
                        'GET countfavoritos' => 'countfavoritos',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/carrinho',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/itenscarrinho',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/linhafatura',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/fatura',
                    'extraPatterns' => [
                        'GET count' => 'count',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
