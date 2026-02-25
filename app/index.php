<?php
/*if($_SERVER["SERVER_NAME"]=="talentracking.com"   or $_SERVER["SERVER_NAME"]=="www.talentracking.com" ){
	 
	$query="";
	if($_SERVER["REQUEST_URI"]!=""){
		$query=$_SERVER["REQUEST_URI"];
	}
	header("Location: https://corazonresponsables.org".$query);exit;  
}*/
 if($_SERVER["REQUEST_URI"]=="/" or $_SERVER["REQUEST_URI"]=="/index.php"  ){ 
	
	header("Location: /admin");exit; 
	 
 }
 if(isset($_COOKIE["YII_CSRF_TOKEN"]) and ($_SERVER["REQUEST_URI"]=="/index.php/admin/" or $_SERVER["REQUEST_URI"]=="/index.php/admin")){
	
	header("Location: /index.php/admin/evaluacion");exit;  
 }
//printVar($_SESSION);exit;
/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
	$system_path = "framework";

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
	$application_folder = dirname(__FILE__) . "/application";

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
	// The directory name, relative to the "controllers" folder.  Leave blank
	// if your controller is not in a sub-folder within the "controllers" folder
	// $routing['directory'] = '';

	// The controller class file name.  Example:  Mycontroller.php
	// $routing['controller'] = '';

	// The controller function you wish to be called.
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------




/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */
	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if (!is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */


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
function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
 }
/**
	* simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * PHP 5.4.9
 *
 * this is a beginners template for simple encryption decryption
 * before using this in production environments, please read about encryption
 *
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string,$secret_key=80144347,$secret_iv=4) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
     // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
// round_up:
// rounds up a float to a specified number of decimal places
// (basically acts like ceil() but allows for decimal places)
function round_up ($value, $places=0) {
  if ($places < 0) { $places = 0; }
  $mult = pow(10, $places);
  return ceil($value * $mult) / $mult;
}
 function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// round_out:
// rounds a float away from zero to a specified number of decimal places
function round_out ($value, $places=0) {
  if ($places < 0) { $places = 0; }
  $mult = pow(10, $places);
  return ($value >= 0 ? ceil($value * $mult):floor($value * $mult)) / $mult;
}

function dirftimeminutes($strStart,$strEnd){
 	$dteStart = new DateTime($strStart); 
	$dteEnd   = new DateTime($strEnd); 
	$dteDiff  = $dteStart->diff($dteEnd); 
  return $dteDiff->format("%I");	
 }
 function diffecha($strStart,$strEnd){
 	$dteStart = new DateTime($strStart); 
	$dteEnd   = new DateTime($strEnd); 
	$dteDiff  = $dteStart->diff($dteEnd); 
	//DateInterval Object ( [y] => 0 [m] => 4 [d] => 28 [h] => 11 [i] => 7 [s] => 45 [invert] => 0 [days] => 148 )
  return $dteDiff;	
 }

 
	
function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
	{
		$source = 'abcdefghijklmnopqrstuvwxyz';
		if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		if($n==1) $source .= '1234567890';
		if($sc==1) $source .= '|@#~$%()=^*+&#91;&#93;{}-_';
		if($length>0){
			$rstr = "";
			$source = str_split($source,1);
			for($i=1; $i<=$length; $i++){
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,count($source));
				$rstr .= $source[$num-1];
			}
	 
		}
		return $rstr;
	}
 
 function sanear_string($string,$ext=TRUE)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç','¥','ï¿½'),
        array('n', 'N', 'c', 'C','N','N'),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
	if($ext==TRUE){
		 $string = str_replace(
			array("\\", "¨", "º", "-", "~",
				 "#", "@", "|", "!", "\"",
				 "·", "$", "%", "&", "/",
				 "(", ")", "?", "'", "¡",
				 "¿", "[", "^", "`", "]",
				 "+", "}", "{", "¨", "´",
				 ">", "< ", ";", ",", ":",
				 ".", " ","=",1,2,3,4,5,6,7,8,9,0),
			'',
			$string
		);
	}


    return trim($string," ");
}
function configCron(){
	$config=array("h"=>6);
	return $config;
}
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once BASEPATH . 'yii' . EXT;
require_once APPPATH . 'core/LSYii_Application' . EXT;

$config = require_once(APPPATH . 'config/internal' . EXT);

if (!file_exists(APPPATH . 'config/config' . EXT)) {    
    // If Yii can not start due to unwritable runtimePath, present an error    
    $runtimePath = $config['runtimePath'];
    if (!is_dir($runtimePath) || !is_writable($runtimePath)) {
        // @@TODO: present html page styled like the installer
        die (sprintf('%s should be writable by the webserver (755 or 775).', $runtimePath));
    }
}


Yii::createApplication('LSYii_Application', $config)->run();

/* End of file index.php */
/* Location: ./index.php */