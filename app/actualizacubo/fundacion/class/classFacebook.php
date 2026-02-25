<?php
//require LIBS_DIR.'facebook-php/facebook.php';
//require_once CLASS_DIR . "facebook.php";
/**
 * Clase para el trabajo con Facebook. 
 */
class Fb {
    
    private $fb;
	public $user_profile;

    /**
     * Constructor de la clase. Crea el objeto Facebook que utilizaremos
     * en los métodos que interactúan con la red social
     */
    function __construct() {
		
		$config = array();
		$config['appId'] = FACE_APP_ID;
		$config['secret'] = FACE_APP_SECRET;
		$config['cookie'] = true;
		$config['next'] = URL_FAN_PAGE; //url de tab facebook
		$config['cancel_url'] = "http://www.facebook.com/veetcolombia";
		$config['scope'] = 'email,status_update,offline_access,read_friendlists,read_stream,publish_stream';
			
		$this->fb = new Facebook($config);				
							  
							  
		$this->loginUrl   = $this->fb->getLoginUrl(
			array(
				'scope'         =>'email,status_update,offline_access,read_friendlists,read_stream,publish_stream',
				'redirect_uri'  => URL_FAN_PAGE
			)
		);	
    }
	

	
	//Funcion Utilizada para saber si el Usuario es fanpage
	function isFansPage(){
		$signed_request = $this->fb->getSignedRequest();
		
		if(isset($signed_request["page"]["liked"])){
			$like_status = $signed_request["page"]["liked"];
		}else{
			$like_status = false;
		}
		
		return $like_status;
	}
	
	//Funcion Utilizada para saber si el Usuario es fanpage
	function isStateApp(){
		$signed_request = $this->fb->getSignedRequest();
		return $signed_request;
	}
	
	function Login() {    
		$usuario = $this->fb->getUser();

		if($usuario){
			return true;
		}else{
		//	return  $this->loginUrl ;
        $test=$this->fb->getLoginUrl(
			array(
				'scope'         =>'email,status_update,offline_access,read_friendlists,read_stream,publish_stream',
				'redirect_uri'  => URL_FAN_PAGE
			)
		);			
		
			return  $test;
		}	  
    } 			
	
	/**
     * Metodo para consultar y traer datos del usuario
     * Facebook.
     */
	function getUser(){		
		//$user_profile ="";
		$user = $this->fb->getUser();
		
		if ($user) {
			try {
				// Proceed knowing you have a logged in user who's authenticated.
				$this->user_profile = $this->fb->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
				$user = NULL;
			}
		}			
		
		if ($user && $user!=NULL) {
			$logoutUrl = $this->fb->getLogoutUrl();
			return $this->user_profile;
			
		} else {
			$loginUrl = $this->fb->getLoginUrl();
			return $loginUrl;
		}
		
	}
		
	function estadoApp(){		
		//$user_profile ="";
 		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$datos = $this->fb->api('/'.FACE_APP_ID);
			return $datos;
		} catch (FacebookApiException $e) {
			error_log($e);
			$user = NULL;
			return false;
		}
 	}
		
	/**
     * Metodo para consultar y traer datos de token del usuario
     * Facebook.
     */
	function getInfoImp(){		
		$signed_request = $this->fb->getSignedRequest();			
		return $signed_request;		
	}		
	
	/**
     * Metodo para publicar en el muro del usuario
	 *$params (array) parametros para la publicacion en el muro
	 **/	
	function sendFeed($params){
		
		$parametros=array(
				  'message' => $params['message'],
				  'name' => $params['name'],
				  'caption' => $params['caption'],
				  'link' => $params['link'],
				  'description' => $params['description'],
				  'picture' => $params['picture']
		);
																			
		$this->fb->api('/me/feed','post',$parametros);			
	}
		
	/**
     * Metodo para traer datos personales como name,usernam
	 * de un determinado usuario de Facebook
	 * $user_id (int) identificador de facebook del usuario
	**/			
	function getProfileUsername($user_id){
			
		$fql = 'SELECT name,username from user where uid = ' . $user_id;
		$ret_obj = $this->fb->api(array(
                                  'method' => 'fql.query',
                                  'query' => $fql,
                                ));
       	return $ret_obj ;
	}		
	
	/**
     * Metodo para consultar y traer datos de los amigos
     * Facebook.
     */
	function getFriends($uid){		
	try {
		$friends = $this->fb->api(array('method' => 'friends.getAppUsers'));
		
				$fql = "SELECT uid2 FROM friend WHERE uid1=". $uid;  
				$response = $this->fb->api(array(  
					  'method' => 'fql.query',  
					  'query' =>$fql,  
					));  
		
		return $response;
		} catch (FacebookApiException $e) {
			error_log($e); 
			return "ERROR";
			// printVar($e);
		  }	
	}	
	
	/**
     * Metodo para los amigos facebook del usuario que hallan
	 * subido foto en la aplicacion
	 * $user_id (int) identificador de facebook del usuario
	**/		
	function userApp(){
					
		$users=$this->fb->api(array('method' => 'friends.getAppUsers'));	
		$html = '';
			
		for($x=0,$i=count($users);$x<$i;$x++){
				
			$profile = self::getProfileUsername($users[$x]);
			
			$user = new Usuario();
			$idUser = $user->getUsuarioidFacebook($users[$x]);
			
			
			$html .= '
			<a href="index.php?seccion=galeria&buscar='.$idUser.'" style="text-decoration:none;" >
				<div class="display_box" align="left">
					<div style="float:left; margin-right:6px;">
						<img src="https://graph.facebook.com/'.$profile[0]['username'].'/picture" width="60" height="60" />
					</div> 
					<div style="margin-right:6px;"><b>'.$profile[0]['name'].'</b></div>						
				</div>
			</a>';
			
		}			
		return $html ;
				
	}
	
	 /*DETECTA SI ALGUIEN ES FAN DE LA PAGINA*/
	 
	function parsePageSignedRequest() {
	//print_r($_REQUEST);
		if (isset($_REQUEST['signed_request'])) {
		  $encoded_sig = null;
		  $payload = null;
		  list($encoded_sig, $payload) = explode('.', $_REQUEST['signed_request'], 2);
		  $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
		  $data = json_decode(base64_decode(strtr($payload, '-_', '+/'), true));
		  
		  return $data;
		  }
		return false;
	  }	
	
}