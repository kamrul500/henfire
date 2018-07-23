<?php
return [
    'components' => [
      'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host={localhost};dbname={db_name}',
                'username' => '{db_username}',
                'password' => '{db_password}',
                'charset' => 'utf8',
                'tablePrefix' => '{table_prefix}',
            ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
			      'transport' => [
				           'class' => 'Swift_SmtpTransport',
				           'host' => '{mail_host}',
				           'username' => '{mail_username}',
				           'password' => '{mail_password}',
				           'port' => '{mail_port}',
				           'encryption' => 'ssl',
							             ],
					          ],

          ],
];
