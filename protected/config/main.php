<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => [
			'common\components\Bootstrap',
			],
	'modules'=>[
    'markdown' => [
       'class' => 'kartik\markdown\Module',
                  ],
	],
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'jwplayer' => [
        'class' => 'wadeshuler\jwplayer\JWConfig',
        'key' => 'IzEqVjRNGbvR6o5C9Fa0V+d5RKsU6WMks6OoUQ==',  // <-- Your Key Here!!
      ],
    'mhpaypal' => [
        'class' => 'matthough\mhpaypal\PPConfig',
        'state' => 'sandbox',  // <-- live or sandbox
        'clientId' => 'AbvSjVrQFi0aOLhKzZhc_GsURAN0xrapXIuLJmFS-rule4ZrfJhXk-jcD-7Kl7BX3EdL5pGCtPde9sOx',
        'secret' => 'EArFwFwkWSQjNTBV5JYaAdwUmK0lztfQXhpbLXwAnKe0p90O4jyK53Df-Re1f4pIvGqnKNUAbE-tjMIJ',
            			],
	'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
			'tablePrefix'      => 'mh_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],


    	],

];