<?php 

$config['app'] = [
	'service' => [
		HtmlHelper::class
	],

	'globalMiddleware' => [
		ParamMiddleware::class
	],

	'routeMiddleware' => [
		'san-pham' => AuthMiddleware::class
	],
	'boot' => [
		AppServiceProvider::class
	]
];