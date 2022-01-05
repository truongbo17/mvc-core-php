<?php 

class Product extends Controller{

	private $data = [];

	public function index()
	{
		//get data from detail method
		// $data = $this->model('ProductModel');
		// $data = $this->model('ProductModel')->find(3);
		// echo "<pre>";
		// var_dump($data);

		// $this->data['sub_content']['product_list'] = $data;
		// $this->data['content'] = 'products/list';

		//render view
		// $this->render('layouts/client_layout', $this->data);
	}

	public function def()
	{
		$data = $this->db->table('products')->first();

		echo "<pre>";
		var_dump($data);
		echo "</pre>";

		if($this->db->table('category')->insert([
			"name" => "ao den mau hong",
			"created_at" => date('Y-m-d H:i:s'),
			"update_at" => date('Y-m-d H:i:s'),
		])){
			$lastID = $this->db->lastId();

			echo "<pre>";
			echo "insert success !";
			var_dump($lastID);
			echo "</pre>";
		}
	}

	public function abc()
	{
		echo "<pre>";
		var_dump($this->model('ProductModel')->getListPr());

		var_dump($this->model('ProductModel')->getDetail('Quan bo nam'));
		echo "</pre>";		

		echo "<hr>";
		echo "<pre>";
		var_dump($this->model('ProductModel')->find(1));
		echo "</pre>";	
	}

	public function getcategory(){
		$request = new Request();
		echo ("Method : ".$request->getMethod());

		echo "<hr>";

		$data = $request->getFields();
		echo ("Data : ");
		echo "<pre>";
			var_dump($data);
		echo "</pre>";	

		$this->render('category/add');
	}

	public function postcategory(){
		$request = new Request();
		// $data = $request->getFields();
		// echo ("Data : ");
		// echo "<pre>";
		// 	var_dump($data);
		// echo "</pre>";	


		// $response = new Response();
		// $response->redirect('product/getcategory');
	}

}