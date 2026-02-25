<?php
	$dirname=explode("/",$_SERVER["PHP_SELF"]);
	$_SESSION["IDS"]=$IDS;
	shell_exec ('curl -d "id='.$IDS.'&sid='.(INT)$cod.'&mode=447232" http://'.$_SERVER["HTTP_HOST"].'/'.$dirname[1].'/actualizacubo/hseq/index.php');
 ?>
	