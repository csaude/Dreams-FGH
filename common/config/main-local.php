<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dreamsco_app',
            'username' => 'root',
            'password' => 'Maputo123#',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

 'assetManager' => [
//	'linkAssets' => true,
  //          'appendTimestamp' => true,
        ],
		
		    'request' => [
    'parsers' => [
        'application/json' => 'yii\web\JsonParser',
		]
				],

'urlManager' => [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
     'enableStrictParsing' => false,
     'suffix' => '.dreams',
     'showScriptName' => true,

        'rules' =>  [
        '' => 'site/index',
        '/' => 'site/index',
    'dashboard' => 'site/index',

    'POST <controller:[\w-]+>' => '<controller>/create',
    '<controller:[\w-]+>' => '<controller>/index',

    // 'user/settings/<controller:[\w-]+>' => '<controller>',

    'PUT <controller:[\w-]+>/<id:\d+>'    => '<controller>/update',
    'DELETE <controller:[\w-]+>/<id:\d+>' => '<controller>/delete',
    '<controller:[\w-]+>/<id:\d+>'        => '<controller>/view',
			  ['class' => 'yii\rest\UrlRule',
    'controller' => 'api',
    'patterns' => [
                'GET' => 'index' // removed ' index' in key
            ]

  ],
],
   
   /*  
    'rules' => [
        '/' => 'site/index',
        'login' => 'user/login',
      'membros/index' => 'membros/',
        'logout' => 'user/logout',
        'signup' => 'user/signup',
        'request-password-reset' => 'site/request-password-reset',
        'reset-password' => 'site/reset-password',
    ],*/
],


    ],

    
    'modules' => [ 

        'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['admin','sysadmin','gsaide','ematsinhe','vligorio','htimbe']
    ],
        'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ]

    
    ],



];
