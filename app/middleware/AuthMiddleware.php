<?php 
class AuthMiddleware extends Middleware{
	function handle(){

		$homeModel = Load::model('HomeModel');
		$data = $homeModel->all();
		var_dump($data);

		if(Session::data('admin_login')==null){
			$res = new Response();
			// $res->redirect('trang-chu');
		}
	}
}