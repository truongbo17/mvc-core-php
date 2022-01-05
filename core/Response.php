<?php 
class Response{
	public function redirect($uri='')
	{
		if(preg_match('~^(https|http)~iss', $uri)){
			$url = $uri;
		}else{
			$url = _WEB_ROOT.'/'.$uri;
		}
		
		// echo $url;
		header("Location: ".$url);
		exit;
	}
}