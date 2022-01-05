<?php 

class AppServiceProvider extends ServiceProvider{
	public function boot()
	{
		$dataUser = $this->db->table('user')->where('id' , '=', 1)->first();
		$data['userInfo'] = $dataUser;
		$data['coppyright'] = '2022';
		View::share($data);
	}

}