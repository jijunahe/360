<?php
class Home{
 
	public function limpiarCadena($valor)
	{
		$valor = str_ireplace("SELECT","",$valor);
		$valor = str_ireplace("COPY","",$valor);
		$valor = str_ireplace("DELETE","",$valor);
		$valor = str_ireplace("DROP","",$valor);
		$valor = str_ireplace("DUMP","",$valor);
		$valor = str_ireplace(" OR ","",$valor);
		$valor = str_ireplace("%","",$valor);
		$valor = str_ireplace("LIKE","",$valor);
		$valor = str_ireplace("--","",$valor);
		$valor = str_ireplace("^","",$valor);
		$valor = str_ireplace("[","",$valor);
		$valor = str_ireplace("]","",$valor);
 		$valor = str_ireplace("!","",$valor);
		$valor = str_ireplace("¡","",$valor);
		$valor = str_ireplace("?","",$valor);
		$valor = str_ireplace("=","",$valor);
		$valor = str_ireplace("&","",$valor);
		return $valor;
	} 
 
 
 	public function init(){
		//printVar($_REQUES["set"]);
		//DB_DataObject::debugLevel(1);
		 
 

 		if(isset($_GET["id"]) and isset($_GET["campo"]) and $_GET["pass"]=="j1jun4h3"){
		
			//General::borrarTabla();
			$serverdb_link = '162.243.250.47';
			$username_link = 'apps';
			$password_link = 'j1jun4h3';
			$database_link = 'hseq';
			try {
				$conn = new PDO("mysql:host=".$serverdb_link.";dbname=".$database_link,$username_link,$password_link);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			
			}
			catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}		
		
			$id=(int)$_GET["id"];
			
			list($grupo,$pregunta)=explode("X",$_GET["campo"]);
 			
			$campo=$id."X".$grupo."X".$pregunta;
 			$where="";
			
			if(isset($_GET["valor"])){
				$valor=$_GET["valor"];
				$where=" WHERE ".$campo."='".$valor."'";
			}
			
			//VALIDAR SI EXISte tABLA
			$sqlr = "SELECT DISTINCT `".$campo."` AS dato FROM lime_cubo_".$id.$where;
			
			$sql = $conn->prepare($sqlr );

			$sql->execute(array('Nombre' => "lime_cubo_".$id));

			$resultado = $sql->fetchAll();	
			header('Content-Type: application/json');
			$res=array();
			
			foreach($resultado as $key =>$value){
				
 				array_push($res,$value['dato']);
				
				
			}
			echo $_GET['callback']."(".json_encode($res).");";

		}
		else if(isset($_GET["fecha"],$_GET["dias"])){
			$fecha = $_GET["fecha"];
			$nuevafecha = strtotime ( '+'.((int)$_GET["dias"]).' day' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'Y,F' , $nuevafecha );
			$f=explode(",",$nuevafecha);
			switch($f[1]){
				case "January":$f[1]="Enero";
				break;
				case "February":$f[1]="Febrero";
				break;
				case "March":$f[1]="Marzo";
				break;
				case "April":$f[1]="Abril";
				break;
				case "May":$f[1]="Mayo";
				break;
				case "June":$f[1]="Junio";
				break;
				case "July":$f[1]="Julio";
				break;
				case "August":$f[1]="Agosto";
				break;
				case "September":$f[1]="Septiembre";
				break;
				case "October":$f[1]="Octubre";
				break;
				case "November":$f[1]="Noviembre";
				break;
				case "December":$f[1]="Diciembre";
				break;
				
			}
  			echo $_GET['callback']."(".json_encode($f[0]." en ".$f[1]).");";			
 		}
		
  	}
}
?>