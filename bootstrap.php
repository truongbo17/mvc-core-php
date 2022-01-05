<?php
define('_DIR_ROOT', __DIR__);

/*
-Xử lý http root
---Start
*/
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
	$web_root = 'https://'.$_SERVER['HTTP_HOST'];
}else{
	$web_root = 'http://'.$_SERVER['HTTP_HOST'];
}


$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']),'',str_replace('\\','/',strtolower(_DIR_ROOT)));

$web_root = $web_root.$folder;

define('_WEB_ROOT', $web_root);

/*
-Xử lý http root
---End
*/

/*
-Tự động load config
---Start
*/
$config_dir = scandir('configs');
if (!empty($config_dir)) {
	foreach ($config_dir as $item) {
		if($item != '.' && $item != '..' && file_exists('configs/'.$item)){
			require_once 'configs/'.$item;
		}
	}
}
/*
-Tự động load config
---End
*/


//load service
if(!empty($config['app']['service'])){
	$allServices = $config['app']['service'];

	if(!empty($allServices)){
		foreach ($allServices as $serviceName) {
			if(file_exists('app/core/'.$serviceName.'.php')){
				require_once('app/core/'.$serviceName.'.php');
			}
		}
	}
}

//Load Service Provider
require_once 'core/ServiceProvider.php';

//load view class
require_once 'core/View.php';

//load support middleware
require_once 'core/Load.php';
//middleware
 require_once 'core/Middleware.php';

//load core
require_once 'core/Route.php';

require_once 'core/Session.php';

//kiểm tra config và load database
if(!empty($config['database'])){
	$db_config = $config['database'];

	if(!empty($db_config)){
		require_once 'core/Connection.php';
		require_once 'core/QueryBuilder.php';
		require_once 'core/Database.php';
		require_once 'core/DB.php';
	}
}

//load core helper
require_once 'core/Helper.php';

//load helper
$allHelpers = scandir('app/helpers/');
if (!empty($allHelpers)) {
	foreach ($allHelpers as $item) {
		if($item != '.' && $item != '..' && file_exists('app/helpers/'.$item)){
			require_once 'app/helpers/'.$item;
		}
	}
}

require_once 'app/App.php';

//load base 

require_once 'core/Model.php';

require_once 'core/Template.php';

require_once 'core/Controller.php';

require_once 'core/Request.php';

require_once 'core/Response.php';