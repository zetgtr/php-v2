<?PHP
require_once ("../lib/Twig/Autoloader.php");
Twig_Autoloader::register();

spl_autoload_register("NewStandarAutoloader");
function NewStandarAutoloader ($className)
{
	$dirs=['controller',
		   'model',
		   'data'];
	$found=false;
    foreach($dirs as $dir)
		{
		$filename=__DIR__ .'/'.$dir.'/'.$className.'.class.php';
		//echo $filename."<br>";
		if (is_file($filename))
			{
			require_once ($filename);
			$found=true;
			}
	
		}
	if (!$found)
		{	
			throw new Exception('Class did not loaded'.$className);
	}	
	return true;	
}

 ?>
