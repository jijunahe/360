<?php

		require_once "class/classAdmin.php";  //clase de usuario

		$classAdmin = new Admin();
		
		print_r($classAdmin->_getSaltedHash("123"));

	
?>