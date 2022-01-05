<?php 
/**
 * class App xu ly route
 */
class App
{
	private $__controller, $__action , $__params, $__routes, $__db;

	static public $app;

	function __construct()
	{
		global $routes,$config; //biến routes từ configs/routes.php	

		self::$app = $this;
		
		$this->__routes = new Route();

		if(!empty($routes['default_controller'])){
			$this->__controller = $routes['default_controller'];
		}
		$this->__action = 'index';
		$this->__params = [];

		if(class_exists('DB')){
			$dbObject = new DB();
			$this->__db = $dbObject->db;
		}
		// var_dump($this->__db);

		$this->handleUrl();
	}

	//get Url
	public function getUrl()
	{
		if(!empty($_SERVER['PATH_INFO'])){
			$url = $_SERVER['PATH_INFO'];
		}else{
			$url = "/"; //url mặc định khi truy cập
		}

		return $url;
	}

	//xử lý url
	public function handleUrl()
	{

		$url = $this->getUrl();

		//xử lý route
		$url = $this->__routes->handleRoute($url);

		//middleware app
		$this->handleGlobalMiddleware($this->__db);
		$this->handleRouteMiddleware($this->__routes->getUri(), $this->__db);

		//app service provider
		$this->handleAppServiceProvider($this->__db);

		$urlArray = array_filter(explode('/',$url)); //lọc những phần tử trống trong mảng
		$urlArray = array_values($urlArray); //đưa về lại đúng key cho mảng
		
		$urlCheck = '';
		if(!empty($urlArray)){
				//kiểm tra xem có chứa thư mục hay không
			foreach ($urlArray as $key => $value) {
				$urlCheck.=$value.'/';
				$fileCheck = rtrim($urlCheck, '/');
				$fileArr = explode('/', $fileCheck); //chuyển thành mảng thông qua /

				//chuyển giá trị phần tử cuối cùng của mảng viết hoa chữ cái đầu(đường dẫn/controller -> admin/Dashboard)
				$fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);

				$fileCheck = implode('/', $fileArr);//chuyển mảng thành string nối nhau bằng /

				if(!empty($urlArray[$key-1])){
					// echo "<pre>";
					// var_dump($urlArray);
					unset($urlArray[$key-1]);//hủy phần tử là thư mục đứng trước controller
					// echo "<pre><b>";
					// var_dump($urlArray);
					// echo "</b></pre>";
				}

				if(file_exists('app/controllers/'.$fileCheck.'.php')){
					$urlCheck = $fileCheck;
					break;
				}		
			}

			// echo $urlCheck;
			$urlArray = array_values($urlArray); //set lại key cho mảng lưu url
			// var_dump($urlArray);
		}

		// --Xử lý controller
		if(!empty($urlArray[0])){
			//gán controller bằng phần tử đầu tiên trong mảng URL lấy được
			$this->__controller = ucfirst($urlArray[0]);
		}else{
			$this->__controller = ucfirst($this->__controller); //không có controller thì sẽ gọi đến đây
		}

		//xử lý khi url trống (index)
		if(empty($urlCheck)){
			$urlCheck = $this->__controller;
		}

		//nếu tồn tại file controller thì require
		if(file_exists('app/controllers/'.$urlCheck.'.php')){				
			require_once 'controllers/'.$urlCheck.'.php';

			//kiểm tra class $this->__controller tồn tại
			if(class_exists($this->__controller)){
				//khởi tạo đối tượng controller
				$this->__controller = new $this->__controller();

				unset($urlArray[0]); //hủy đi controller và action sẽ để lại các phần tử còn lại là param

				//db trong base Controller
				if(!empty($this->__db)){
					$this->__controller->db = $this->__db;
				}
				
			}else{
				$this->loadError();
			}
			
		}else{
			$this->loadError();
		}

		// --Xử lý action
		if(!empty($urlArray[1])){
			//gán action bằng phần tử thứ 2 trong mảng URL lấy được
			$this->__action = ucfirst($urlArray[1]);
			unset($urlArray[1]); //hủy đi controller và action sẽ để lại các phần tử còn lại là param
		}

		// --Xử lý param
		$this->__params = array_values($urlArray); //sau khi hủy index tại controller và action đi ta set lại key cho array từ 0

		//check phương thức
		if(method_exists($this->__controller, $this->__action)){
			call_user_func_array([$this->__controller, $this->__action], $this->__params); //hàm gọi function truyền vào param
		}else{
			$this->loadError();
		}

	}


	public function getCurrentController()
	{
		return $this->__controller;
	}

	//hien thị trang lỗi
	public function loadError($name = '404',$data = '')
	{
		if (!empty($data)) {
			extract($data);
		}
		require_once 'errors/'.$name.'.php';
	}

	public function handleRouteMiddleware($routeKey, $db)
	{
		global $config;

		$routeKey = trim($routeKey);
		 //middleware app
		if(!empty($config['app']['routeMiddleware'])){
			$routeMiddlewareArr = $config['app']['routeMiddleware'];

			foreach ($routeMiddlewareArr as $key => $middleware) {
				// echo $middleware;die; //class tương ứng với route
				if($routeKey == $key && file_exists('app/middleware/'.$middleware.'.php')){
					require_once('app/middleware/'.$middleware.'.php');
					if(class_exists($middleware)){					
						$middlewareObject = new $middleware();

						if(!empty($db)){
							$middlewareObject->db = $db;
						}

						$middlewareObject->handle();
					}
				}
			}

		}
	}

	public function handleGlobalMiddleware($db)
	{
		global $config;
		 //middleware app
		if(!empty($config['app']['globalMiddleware'])){
			$globalMiddlewareArr = $config['app']['globalMiddleware'];

			foreach ($globalMiddlewareArr as $key => $middleware) {
				if(file_exists('app/middleware/'.$middleware.'.php')){
					require_once('app/middleware/'.$middleware.'.php');
					if(class_exists($middleware)){					
						$middlewareObject = new $middleware();

						if(!empty($db)){
							$middlewareObject->db = $db;
						}
						
						$middlewareObject->handle();
					}
				}
			}

		}
	}

	public function handleAppServiceProvider($db)
	{
		global $config;

		if(!empty($config['app']['boot'])){
			$serviceProviderArr = $config['app']['boot'];

			foreach ($serviceProviderArr as $serviceName) {
				if(file_exists('app/core/'.$serviceName.'.php')){
					require_once('app/core/'.$serviceName.'.php');
					if(class_exists($serviceName)){					
						$serviceObject = new $serviceName();
						
						if(!empty($db)){
							$serviceObject->db = $db;
						}

						$serviceObject->boot();
					}
				}
			}

		}
	}

}