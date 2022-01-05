<?php 

class User extends Controller{
	private $data = [];

	public function testhelper()
	{
		echo toSlug('Tah');
	}

	public function index()
	{
		//set session
		// Session::data('username',
		// 	[
		// 		'name' => 'Nguyen Quang Truong',
		// 		'age' => 15
		// 	]);
		// Session::data('job', 'IT');

		//delete session
		// Session::delete('job');

		//get session
		// $sesseionData = Session::data();

		//flash session
		// Session::flash('msg','them data thanh cong');
		// $msg = Session::flash('msg');
		// echo "<pre>";
		// var_dump($msg);
		// echo "</pre>";	
	}

	public function getuser(){
		$this->render('user/add',$this->data);
	}

	public function postuser(){
		$userId = 1;
		$request = new Request();
		if($request->isPost()){

		//set rules
			$request->rules([
				'fullname' => 'required|min:5|max:30',
				'email' => 'required|email|min:6|unique:user:email:id='.$userId,
				'age' => 'required|callback_check_age',
				'password' => 'required|min:3',
				'confirm_password' => 'required|match:password',
			]);

		//set message
			$request->message([
				'fullname.required' => 'Vui long nhap day du ho ten',
				'fullname.min' => 'Ho ten phai lon hon 5 ky tu',
				'fullname.max' => 'Ho ten phai nho hon 30 ky tu',
				'email.required' => 'Vui long nhap day du ho email',
				'email.email' => 'Dinh dang email khong hop le',
				'email.min' => 'Email phai lon hon 6 ky tu',
				'password.required' => 'Mat khau khong duoc de trong',
				'password.min' => 'Mat khau phai lon hon 3 ky tu',
				'confirm_password.required' => 'Mat khau nhap lai khong duoc de trong',
				'confirm_password.match' => 'Xac nhan mat khau khong khop',
				'email.unique' => 'Email da ton tai trong he thong',
				'age.required' => 'Vui long nhap tuoi',
				'age.callback_check_age' => 'Tuoi khong duoc nho hon 20',
			]);


			$validate = $request->validate();

			// var_dump(Session::flash('old'));die;
		}

		$response = new Response();
		$response->redirect('user/getuser');
	}

	public function check_age($age)
	{
		if($age >= 20){
			return true;
		}		
		return false;
	}
}