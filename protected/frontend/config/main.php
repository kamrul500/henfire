<?php
use common\components\MyHelpers;
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
    'modules' => [
      'user' => [
        // following line will restrict access to admin controller from frontend application
        'as frontend' => 'dektrium\user\filters\FrontendFilter',
       ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
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
			'i18n' => [
				  'translations' => [
					  'file-input*' => [
						  'class' => 'yii\i18n\PhpMessageSource',
						  'basePath' => dirname(__FILE__).'/../vendor/2amigos/yii2-file-input-widget/src/messages/',
					  ],
				  ],
			  ],

        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true, 'secure' => true],
        ],
        'session' => [
			       'class' => '\frontend\components\CustomDbSession',
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
			      'sessionTable' => '{{%session_frontend_user}}',
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
            'baseurl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array(

				          'hourlies/<tmpParam:[0-9a-zA-Z\-]+>-<id:\d+>' => 'hourlies/view',
            		  'job/<tmpParam:[0-9a-zA-Z\-]+>-<id:\d+>' => 'job/view',
            		  'profile/<tmpParam:[0-9a-zA-Z\-]+>-<id:\d+>' => 'profile/view',
            		  '<controller:\w+>/<id:\d+>' => '<controller>/view',
				          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

            ),
        ],

    ],
    'params' => $params,
];
