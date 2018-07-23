<?php
return [
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'language' => 'en',
  'sourceLanguage' => 'en',
	'bootstrap' => [
			'common\components\Bootstrap',
			],
	'modules'=>[
      'user' => [
          'class' => 'dektrium\user\Module',
		        'modelMap' => [
              'User' => 'app\models\Reguser',
		          'RegistrationForm' => 'app\models\RegistrationForm',
              ],
            'confirmWithin' => 21600,
            'cost' => 12,
            'enableFlashMessages' => false,
            'admins' => ['{admin_user}']
              ],

	],
  'components' => [
        'assetManager' => [
        //'basePath' => 'cache',
            'class' => 'yii\web\AssetManager',
            'forceCopy' => true,
        ],
        'common' => [
            'class' => 'app\components\Common',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		    'jwplayer' => [
            'class' => 'wadeshuler\jwplayer\JWConfig',
            'key' => 'IzEqVjRNGbvR6o5C9Fa0V+d5RKsU6WMks6OoUQ==',  // <-- Your Key Here!!
         ],
         'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enableDefaultLanguageUrlCode' => false,
            'enableLanguagePersistence' => false,
            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => [ 'en', 'sr'],
			      'baseurl' => '/',
        ],
        'i18n' => [
            'translations' => [
                'frontend' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
];
