<?php 
class Category extends Controller{
	protected $data = [];

	public function index()
	{
		$data = $this->model('CategoryModel')->find(1);

		$this->data['sub_content']['list_category'] = $data;
		$this->data['content'] = 'category/index';

		$this->render('layouts/client_layout',$this->data);
	}
}