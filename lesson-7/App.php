<?PHP
error_reporting(0);
require ("autoload.php");
try {
	App::init();	
	}
catch (Exception $e)
	{
	echo $e->getMessage();
	}
 ?>