<?php 
/**
 * 
 */
class Home extends Controller
{
	private $model_home;
	private $data = [];

	public function index()
	{
		//get data from detail method
		$data = $this->model('HomeModel')->count();
		// var_dump($data);

		$this->data['sub_content']['count_product'] = $data['count'];
		$this->data['content'] = 'home/index';
		
		//render view
		$this->render('layouts/client_layout', $this->data);
	}

}