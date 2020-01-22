<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//Yii::setPathOfAlias('booster', dirname(__FILE__) . '/../extensions/booster');

$db_config = require(dirname(__FILE__) . '/db.php');

return CMap::mergeArray($db_config, array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SGE',
	'language'=>'pt_br',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'booster'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'ext.yii-mail.YiiMailMessage',
		//'ext.wrest.*',//API WREST - webservice/////////////
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'desenv',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('ext.booster.gii'),
		),

		'webshell' => array(
			'class' => 'application.modules.webshell.WebShellModule',

			// when typing 'exit', user will be redirected to this URL
			'exitUrl' => '/',

			// custom wterm options
			'wtermOptions' => array(
				// linux-like command prompt
				'PS1' => '%',
			),

			// additional commands (see below)
			'commands' => array(
				'test' => array('js:function(){return "Hello, world!";}', 'Just a test.'),
			),

			// uncomment to disable yiic
			// 'useYiic' => false,

			// adding custom yiic commands not from protected/commands dir
			/*'yiicCommandMap' => array(
				'email' => array(
					'class' => 'ext.mailer.MailerCommand',
					'from' => 'faxandre@gmail.com',
				),
			),*/
		),
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'caseSensitive' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                //API WREST - webservice///////////////////////////////////////////////////
                //array('api/<model>/delete', 'pattern'=>'api/<model:\w+>/<_id:\d+>', 'verb'=>'DELETE'),
                //array('api/<model>/update', 'pattern'=>'api/<model:\w+>/<_id:\d+>', 'verb'=>'PUT'),
                //array('api/<model>/list',   'pattern'=>'api/<model:\w+>',           'verb'=>'GET'),
                //array('api/<model>/get',    'pattern'=>'api/<model:\w+>/<_id:\d+>', 'verb'=>'GET'),
                //array('api/<model>/create', 'pattern'=>'api/<model:\w+>',           'verb'=>'POST'),
			),
		),

		//email
		'swiftMailer' => array(
		    'class' => 'ext.swiftMailer.SwiftMailer',
		),

		'errorHandler'=>array(
			//'errorAction'=>'site/error'
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(array(
				'class'=>'CFileLogRoute',
				'levels'=>'error, warning',
			),),
		),

		'booster' => array(
			'class'          => 'ext.booster.components.Booster',
			'responsiveCss'  => true,
			'fontAwesomeCss' => true,
			'enableJS'       => true,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'      => 'admin@map.com',
		'assinaturaEmail' => '<br><br><br><h5>Setor da Qualidade - QSCM<br>
							  Fone: 3635-5478<br>
							  Email: qualidade@map.com</h5>',
	),

));
