<?php



$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
use common\components\MyHelpers;
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'modules' => [
      'user' => [
        // following line will restrict access to profile, recovery, registration and settings controllers from backend
        'as backend' => 'dektrium\user\filters\BackendFilter',
      ],
    ],
    'components' => [
		'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/almasaeed2010/adminlte/pages',
                '@dektrium/user/views' => '@app/views/user'
				 ],
			 ],
		],
		'assetManager' => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					'skin' => 'skin-red-light',
				],
			],
		],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],*/
        'user' => [
        'identityCookie' => [
            'name'     => '_backendIdentity',
            'path'     => '/admin',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        'name' => 'BACKENDSESSID',
        'cookieParams' => [
            'httpOnly' => true,
            'path'     => '/admin',
        ],
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
            'errorAction' => 'site/index',
        ],

        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/

    ],
    'params' => $params,
];
