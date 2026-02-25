<?php
// LIBRERIA DE SMARTY

/* Clase que extiende a smarty y hace la visualizacion */
class smartyConfig extends Smarty{
   // Class constructor
     public function __construct(){
		// LLamada a Smarty's constructor
		parent::Smarty();
		
		// Direccionamiento a directorios
		$this->left_delimiter = '{#';
		$this->right_delimiter = '#}';
		$this->template_dir = TEMPLATE_DIR;
		$this->compile_dir = COMPILE_DIR;	
		$this->plugins_dir[0] = SMARTY_DIR . 'plugins/';
		//$this->plugins_dir[1] = CONTENT_DIR . 'smarty_plugins';	
		$this->caching = false;
	}
		
}
?>