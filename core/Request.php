<?php 

class Request{

	private $__rules = [], $__messages = [], $__errors = [];
	public $db;
	/*
		method
		body content
	*/
		function __construct(){
			$this->db = new Database();
		}

		public function getMethod()
		{
			return strtolower($_SERVER['REQUEST_METHOD']);
		}

		public function isPost()
		{
			if($this->getMethod() == 'post'){
				return true;
			}

			return false;
		}

		public function isGet()
		{
			if($this->getMethod() == 'get'){
				return true;
			}

			return false;
		}

		public function getFields()
		{
			$dataFields = [];

			if($this->isGet()){
			//lấy dữ liệu với GET
				if(!empty($_GET)){
					foreach ($_GET as $key => $value) {
						if(is_array($value)){
							$dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
						}else{
							$dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
						}
					}
				}

			}

			if($this->isPost()){
			//lấy dữ liệu với GET
				if(!empty($_POST)){
					foreach ($_POST as $key => $value) {
						if(is_array($value)){
							$dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
						}else{
							$dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
						}
					}
				}

			}

			return $dataFields;
		}


	//set rules
		public function rules($rules=[])
		{
			$this->__rules = $rules;	
		}
	//set message
		public function message($messages=[])
		{
			$this->__messages = $messages;
		}
	//run validat
		public function validate()
		{
			$this->__rules = array_filter($this->__rules);

			$checkValidate = true;

		//đọc dữ liệu rule
			if(!empty($this->__rules)){

			//lấy dữ liệu từ from nhập lên
				$dataFields = $this->getFields();
				if(empty($dataFields)){
					return false;
				}
				// echo "<pre>";
				// var_dump($dataFields);
				// echo "</pre>";	

				foreach ($this->__rules as $fieldname => $ruleItem){
					$ruleItemArr = explode('|', $ruleItem);

					foreach ($ruleItemArr as $rules){

						$ruleName = null;
						$ruleValue = null;	

						$rulesArr = explode(':', $rules);

					$ruleName = reset($rulesArr); //trả về phần tử đầu tiên trong mảng

					//nếu có 2 phần tử (ví dụ- min:3,match:password)
					if(count($rulesArr) > 1){
						$ruleValue = end($rulesArr); //trả về phần tử cuối cùng của mảng
					}

					//check rule
					if($ruleName == 'required'){
						//required
						if(empty(trim($dataFields[$fieldname]))){
							$this->setError($fieldname,$ruleName);
							$checkValidate = false;
						}
					}
					if($ruleName == 'min'){
						//min
						if(strlen(trim($dataFields[$fieldname])) < $ruleValue){
							$this->setError($fieldname,$ruleName); 
							$checkValidate = false;
						}
					}
					if($ruleName == 'max'){
						//max
						if(strlen(trim($dataFields[$fieldname])) > $ruleValue){
							$this->setError($fieldname,$ruleName); 
							$checkValidate = false;
						}
					}
					if($ruleName == 'email'){
						//max
						if(!filter_var($dataFields[$fieldname], FILTER_VALIDATE_EMAIL)){
							$this->setError($fieldname,$ruleName); 
							$checkValidate = false;
						}
					}
					if($ruleName == 'match'){
						//max
						if(trim($dataFields[$fieldname]) != trim($dataFields[$ruleValue])){
							$this->setError($fieldname,$ruleName); 
							$checkValidate = false;
						}
					}
					if($ruleName == 'unique'){
						$tableName = null;
						$fieldCheck = null;
						//unique:user:email => phần tử thứ 1 là user (table)

						if(!empty($rulesArr[1])){
							$tableName = $rulesArr[1];
						}
						if(!empty($rulesArr[2])){
							$fieldCheck = $rulesArr[2];
						}

						$conditionWhere = isset($rulesArr[3]) ? ' AND '.str_replace('=', '<>', $rulesArr[3]) : '';

						if(!empty($tableName) && !empty($fieldCheck)){
							$checkExist = $this->db->query("SELECT * FROM $tableName WHERE $fieldCheck = '$dataFields[$fieldname]' $conditionWhere")->rowCount();
							if(!empty($checkExist)){
								$this->setError($fieldname,$ruleName); 
								$checkValidate = false;
							}
						}
					}

					//callback validate (validate tự tạo)
					if(preg_match('~^callback_(.+)~is', $ruleName, $callbackArr)){
						if(!empty($callbackArr[1])){
							$callbackName = $callbackArr[1];
							$controller = App::$app->getCurrentController();//gọi đến controller hiện tại đang xử lý

							//check tồn tại phương thwusc trong controller
							if(method_exists($controller, $callbackName)){
								$checkCallback = call_user_func_array([$controller, $callbackName], [trim($dataFields[$fieldname])]);
								if(!$checkCallback){
									$this->setError($fieldname,$ruleName); 
									$checkValidate = false;
								}
							}
						}
					}

				}
			}
		}

		//set key session
		$sessionKey = Session::isInvaild();
		Session::flash($sessionKey.'_errors', $this->errors());
		Session::flash($sessionKey.'_old', $this->getFields());

		if(!$checkValidate){
			return $this->errors();
		}
	}
	//errors
	public function errors($fieldname='')
	{
		if(!empty($this->__errors)){
			if(empty($fieldname)){
				$errorsArr = [];
				foreach ($this->__errors as $key => $error) {
					$errorsArr[$key] = reset($error); //trả về lỗi đầu tiên
				}
				return $errorsArr;
			}

			return reset($this->__errors[$fieldname]);
		}

		return false;
	}


	public function setError($fieldname,$ruleName)
	{
		$this->__errors[$fieldname][$ruleName] = $this->__messages[$fieldname.'.'.$ruleName];
	}

}