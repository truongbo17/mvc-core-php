<?php 
$sessionKey = Session::isInvaild();
$errors = Session::flash($sessionKey.'_errors');
$old = Session::flash($sessionKey.'_old');

if(!function_exists('form_error')){
	function form_error($filedName = '')
	{
		global $errors;
		if(!empty($errors) && array_key_exists($filedName, $errors)){
			return $errors[$filedName];
		}
		return false;
	}
}

if(!function_exists('old')){
	function old($filedName, $default = '')
	{
		global $old;
		if(!empty($old[$filedName])){
			return $old[$filedName];
		}
		return $default;
	}
}