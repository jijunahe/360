<?php
	

error_reporting(E_ALL);
ini_set('display_errors', '1');
$system_path = "../../framework";
$application_folder =  "../../application";

	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	if (realpath($application_folder) !== FALSE)
	{
		$application_folder = realpath($application_folder).'/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';
	$application_folder = rtrim($application_folder, '/').'/';
 	// Is the system path correct?
	if (!is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}
	

	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	define('ROOT', dirname(__FILE__));

	// The PHP file extension
	define('EXT', '.php');

	// Path to the system folder
	define('BASEPATH', str_replace("\\", "/", $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

 	// The path to the "application" folder
	if (is_dir($application_folder))
	{
		define('APPPATH', $application_folder.'/');
	}
	else
	{
		if (!is_dir(BASEPATH . $application_folder . '/'))
		{
			exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}

		define('APPPATH', BASEPATH . $application_folder . '/');
	}
    if (file_exists(APPPATH.'config'.DIRECTORY_SEPARATOR.'config.php'))
    {
        $aSettings= include(APPPATH.'config'.DIRECTORY_SEPARATOR.'config.php');
    }
    else
    {
        $aSettings=array();
    }
    if (isset($aSettings['config']['debug']) && $aSettings['config']['debug']>0)
    {
        define('YII_DEBUG', true);
        error_reporting(E_ALL);
    }
    else
    {
        define('YII_DEBUG', false);
        error_reporting(0);
    }



require_once("requires.php");

require_once(CLASS_DIR."utils.php");
 //require_once(CLASS_DIR."/class.db.php");
 require_once CONTENT_DIR . "master.php";	
	
?>