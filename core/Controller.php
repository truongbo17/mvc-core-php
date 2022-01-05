<?php 

//base controller
class Controller{
	public $db;
	public function model($model)
	{
		if(file_exists(_DIR_ROOT.'/app/models/'.$model.'.php')){
			require_once _DIR_ROOT.'/app/models/'.$model.'.php';
			if(class_exists($model)){
				$model = new $model();
				return $model; //object
			}
		}
		return false;
	}

	public function render($view, $data = [])
	{

		if(!empty(View::$dataShare)){
			$data = array_merge($data, View::$dataShare);
		}

		extract($data); //đổi key của mảng thành biến

		$contenView = null;

		if(preg_match('~^layouts~', $view)){
			if(file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')){
				require_once _DIR_ROOT.'/app/views/'.$view.'.php';
			}
		}else{
			if(file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')){
				$contenView =  file_get_contents(_DIR_ROOT.'/app/views/'.$view.'.php');
			}

			$template = new Template();
			$template->run($contenView, $data);
		}


	}

}