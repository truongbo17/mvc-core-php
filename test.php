<?php 
// new A();
class A{
	function __construct(){
		echo "OK 1";
		new B();
	}
}

new A();

class B{
	function __construct(){
		echo "OK 2";
	}
}


?>