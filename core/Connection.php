<?php 
class Connection{

	private static $instance = null,$con = null;

	private function __construct($config)
	{
		$servername = $config['host'];
		$username = $config['user'];
		$password = $config['password'];
		$dbname = $config['database'];

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 			 // set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			self::$con = $conn;
		} catch(PDOException $e) {
			//fail
			App::$app->loadError('500',$e->getMessage());
			die();
		}
	} 

	public static function getInstance($config)
	{
		if (self::$instance == null)
		{
			$connection = new Connection($config);
			self::$instance = self::$con;
		}

		return self::$instance;
	}

}