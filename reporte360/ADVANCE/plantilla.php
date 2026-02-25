<?php
     
$raiz='/var/www/html/reporte360/ADVANCE';
if(isset($_GET["html"])){
$raiz='.';
}
for($i=1;$i<=19;$i++){
	$w=749;
	$h=807;
	if($i>1){
		$w=750;
		$h=800;
	}
	?> 
	<img src="<?=$raiz?>/pag<?=$i?>.jpg" style="height:<?=$h?>;width:<?=$w?>px" />
	<div style="clear:both"></div>
	
	<?
	
}


