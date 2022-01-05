<?php 
class ParamMiddleware extends Middleware{
	public function handle()
	{
		if(!empty($_SERVER['QUERY_STRING'])){
			// die($_SERVER['QUERY_STRING']);
			$res = new Response();
			$res->redirect(Route::getFullUrl());
		}
		
	}
}