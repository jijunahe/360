<?php


function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}

	error_reporting(E_ALL);
ini_set('display_errors', '1');
	
	
	include("class.db.php");
	$prefijo="lime_";
	
	$db=new db("mysql:host=162.243.250.47;port=3306;dbname=bateriaencuesta", "apps", "j1jun4h3");
	
	$results = $db->select($prefijo."eval_usuarios");
	
	foreach($results as  $d){
		
		printVar($d); 
		
	} 
	
?>	