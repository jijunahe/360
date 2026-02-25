<?php
class Header{
	public $mErrorMessage = "";
	public $showManagerIp = false;
	
	public function __construct(){
		
	}
	
	public function init(){
		if(isset($_SESSION['mErrorMessage'])){
			$this->mErrorMessage = $_SESSION['mErrorMessage'];
			unset($_SESSION['mErrorMessage']);
		}
		
		if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']['perfil']==1){
			$this->showManagerIp = true;
		}
	}
	
}
?>