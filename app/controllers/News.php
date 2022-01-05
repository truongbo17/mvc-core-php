<?php 

class News extends Controller{
	public $data = [];
	public function index()
	{
		$this->data['sub_content']['new_title'] = 'Tin tuc 1';
		$this->data['sub_content']['new_content'] = '<h2>Noi dung 1';
		$this->data['sub_content']['new_abc'] = '<h1>ABC</h1>';
		$this->data['content'] = 'news/list';

		$this->render('layouts/client_layout', $this->data);
	}
}