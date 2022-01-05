<?php 
class Session{
	/*
	data(key,value) =>set session
	data(key) => get session
	*/
	static public function data($key = '', $value = '')
	{
		$sessionKey = self::isInvaild();

		if(!empty($value)){
			if(!empty($key)){
				$_SESSION[$sessionKey][$key] = $value; //set session
				return true;
			}
			return false;
		}else{
			if(empty($key)){
				if(isset($_SESSION[$sessionKey])){
					return $_SESSION[$sessionKey]; //get all session
				}
			}else{
				if(isset($_SESSION[$sessionKey][$key])){
					return $_SESSION[$sessionKey][$key]; //get session
				}
			}
			
		}
	}

	/*
	delete($key) => xóa session theo key
	delete($key = '') => xóa hết session
	*/
	static public function delete($key = '')
	{
		$sessionKey = self::isInvaild();

		if(!empty($key)){
			if(isset($_SESSION[$sessionKey][$key])){
				unset($_SESSION[$sessionKey][$key]);
				return true;
			}
			return false;
		}else{
			unset($_SESSION[$sessionKey]);
			return true;
		}
		return false;
	}

	static public function showError($message){
		$data = ['message' => $message];
		App::$app->loadError('exception', $data);
	}

	static public function isInvaild($value='')
	{
		global $config;
		if(!empty($config['session']))
		{
			$session_config = $config['session'];
			if(!empty($session_config['session_key'])){
				$sessionKey = $session_config['session_key'];
				return $sessionKey;
			}else{
				self::showError('Thiếu cấu hình session key,Vui lòng kiếm tra file config/session.php');
			}
		}else{
			self::showError('Thiếu cấu hình session,Vui lòng kiếm tra file config/session.php');
		}
	}

	//flash data
	/*
	set flash data giống như session
	get flash data cũng giống như session nhưng sẽ xóa luôn sau khi gọi (chỉ dùng 1 lần)
	*/
	static public function flash($key='', $value = '')
	{
		$dataFlash = self::data($key, $value);
		if(empty($value)){
			//get session flash
			self::delete($key);
		}

		return $dataFlash;
	}
}