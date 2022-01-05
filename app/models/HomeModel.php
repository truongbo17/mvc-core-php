<?php 

class HomeModel extends Model{
	// public function index()
	// {
	// 	$data = $this->db->query("SELECT COUNT(*) as count_product FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);
	// 	return $data;
	// }

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
	
}