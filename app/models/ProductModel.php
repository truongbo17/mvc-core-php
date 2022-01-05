<?php 

class ProductModel extends Model{
	
	//ten table
	function tableFill(){
		return 'products';
	}
	//những cột nào được lấy
	function fieldFill(){
		return '*';
	}
	//khóa chính
	function primaryKey(){
		return 'id';
	}

	// public function index()
	// {
	// 	$data = $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);

	// 	return $data;
	// }

	function getListPr(){
		return $this->db->table('products')->where('id','>',0)->whereLike('name', '%n%')->select('*')->limit(3,1)->orderBy('id', 'DESC')->get();

		// return $this->db->table('products')->join('category', 'products.category_id = category.id')->select('products.*')->get();

		// if($this->db->table('category')->insert([
		// 	"name" => "ao den mau hong",
		// 	"created_at" => date('Y-m-d H:i:s'),
		// 	"update_at" => date('Y-m-d H:i:s'),
		// ])){
		// 	return $this->db->lastId();
		// }


		// if($this->db->table('category')->update([
		// 	"name" => "Áo haha",
		// 	"update_at" => date('Y-m-d H:i:s'),
		// ])){
		// 	return "Update success ! ";
		// }

		// if($this->db->table('category')->where('id', '=', '3')->delete()){
		// 	return "Delete success ! ";
		// }
	}

	function getDetail($name){
		return $this->db->table('products')->where('name','=',$name)->select('name')->first();
	}
} 