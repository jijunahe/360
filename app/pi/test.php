<?php
		error_reporting(E_ALL); ini_set('display_errors', '1');

$texto="al carajo todolllllllllllll";
				$i=array();
				   exec ("pandas.py  '".$texto."'",$i);
 				 echo $texto;  
 				print_r( $i); 
				
				
				?>