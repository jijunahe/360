<?php

class Trivias {

    public $DBObject = "mdmPregunta";
    public $modo = "listado";
    public $mPagination = NULL;
    public $mPage = 1;
    public $mCantidad = 10;
    public $mLista = NULL;
	public $mTextSearch = "";
	public $mErrorMessage = "";
	public $elements = NULL;
 
    public function __construct() {        
		require( DB_DIR . "db.mdmPregunta.php" );
		require( DB_DIR . "db.mdmPreguntaRespuesta.php" );        
		require( DB_DIR . "db.mdmTipoPregunta.php" );        
		require( DB_DIR . "db.mdmLogo.php" );        
		require( DB_DIR . "db.mdmPresNivel.php" );        
        require_once CLASS_DIR . "classGeneralInc.php";  //clase de usuario
        //Pagina Actual del sitio
        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $this->mPage = $_GET['page']; // $pg es la pagina actual
        }
		
		if(isset($_GET['searchText'])){
			$this->mTextSearch = ($_GET['searchText']);
		}
		
        if (!isset($_GET['seccion'])) {
            $_GET['seccion'] = '';
        }
		
		if(isset($_SESSION['mErrorMessage'])){
			//$this->mErrorMessage = $_SESSION['mErrorMessage'];
			//unset($_SESSION['mErrorMessage']);
		}
		 
        //Links de Agregar y Cancelar
		$this->mLinkAdd = Seccion($_GET['seccion'], 'agregar', 0, $this->mPage);
		$this->mLinkVolver = Seccion($_GET['seccion'], 'listado', 0, $this->mPage);

        if (isset($_GET['modo'])) {
            $this->modo = $_GET['modo'];
        }
		
		$this->mDetalle = NULL;
    }

    public function init() {
		$classGeneral = new General();
		$this->logos = General::getTotalDatos('mdmLogo');
		$this->tipopreguntas = General::getTotalDatos('mdmTipoPregunta');
		$this->Niveles = General::getTotalDatos("mdmPresNivel");

		if (isset($_POST['type'])) {
			//Editamos Datos de Formulario
            if ($_POST['type'] == 'editar') {
				//Obtenemos detalle
				
				
				$mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>StripHtml($_POST['itemId'])));
				
				exit();	
            }
			
			//Agregamos Nuevo
			if ($_POST['type'] == 'agregar') {
 				 
 
 				exit();	
            }
			if($_POST['type']== "actualizacorrecta"){//
				$res=General::getTotalDatos("mdmPreguntaRespuesta",array("idPregunta","id")," idPregunta='".$_POST['idPregunta']."' and id='".$_POST['idRespuesta']."'");
				// printVar($res);
				if(is_array($res)){
				 //DB_DataObject::debugLevel(3);
				 $rest=General::updateData("mdmPreguntaRespuesta", array("idPregunta"=>$_POST['idPregunta']), array("respuestaCorrecta"=>"N"));
				 $updateRespuestas=General::updateData("mdmPreguntaRespuesta", array("idPregunta"=>$_POST['idPregunta'],"id"=>$res[0]->id), array("respuestaCorrecta"=>"S"));
				}exit();
			}	
			/*ELIMINA LAS RESPUESTAS UNA A UNA*/
			if($_POST['type']== "eliminares"){
				$res=General::getTotalDatos("mdmPreguntaRespuesta",array("idPregunta","id")," idPregunta='".$_POST['idPregunta']."' and id='".$_POST['idRespuesta']."'");
				if(is_array($res)){
				//DB_DataObject::debugLevel(3);
					$delete=General::unSetInstancia("mdmPreguntaRespuesta",$_POST['idRespuesta']);
					if($delete){
						echo "OK";
					}else{
						echo "NO";
					}

				}exit();
			}	/*ELIMINA TODAS LAS RESPUESTAS*/
			
			if($_POST['type']== "eliminarrespuestas"){
				$res=General::getTotalDatos("mdmPreguntaRespuesta",array("idPregunta","id")," idPregunta='".$_POST['idpregunta']."' ");
				if(is_array($res)){
				//DB_DataObject::debugLevel(3);
				$banderaElimin=false;
					for($i=0;$i<count($res);$i++){
						$delete=General::unSetInstancia("mdmPreguntaRespuesta",$res[$i]->id);
						if($delete){
							$banderaElimin=true;
						}
					}
					if($banderaElimin==true){
						echo "OK";
					}else{echo "NO";}
				}exit();
			}	
			if ($_POST['type'] == 'subirdatos'){
			/*echo "1<-----";*/
				$res="";
				if($_POST["idpregunta"]>0){ echo "2<-----";
					$res=$_POST["idpregunta"];
					$update=General::updateData($this->DBObject, array("id"=>$res), array("pregunta"=>$_POST["pregunta"],"idTipoPregunta"=>$_POST["case"]));
				
					$fields2=array(
						"idNivel"=>$_REQUEST["idNivel"]
					);
					//DB_DataObject::debugLevel(1);
					$update1=General::updateData("mdmPreguntaRespuesta", array("idPregunta"=>$_POST["idpregunta"]),$fields2);					
				
				/*echo "3<-----";*/
				}else{
					$classGeneral->pregunta=StripHtml($_POST["pregunta"]);
					$classGeneral->idTipoPregunta=$_POST["case"];
					$classGeneral->idNivel=$_POST["idNivel"];
					$res=$classGeneral->setInstancia($this->DBObject, array("dateReg"));
				}
				/*echo $_POST['case']."<---case";*/
				if($_POST['case']==1){/*echo "4<-----";*/
					$ok="NO";
					if($res){
					/*echo "5<-----";	 */
 						/*printVar($classGeneral);*/
 						$insert=false;
						//printVar($_POST["idpregunta"],"idpregunta");
						if($_POST['accion']=="update"){
							$fields1=array(
								"idPregunta"=>$_POST["idpregunta"],
								"idLogo"=>$_POST["logo"],
								"respuestaCorrecta"=>"S",
								"idNivel"=>$_POST["idNivel"]
							);
							$fields2=array(
								"idNivel"=>$_POST["idNivel"]
							);
							
							$update1=General::updateData("mdmPreguntaRespuesta", array("idPregunta"=>$_POST["idpregunta"]),$fields1);
							$update2=General::updateData("mdmPregunta", array("id"=>$_POST["idpregunta"]),$fields2);
						}else{
							$classGeneral->idPregunta=$res;
							$classGeneral->idLogo=$_POST["logo"];
							$classGeneral->respuestaCorrecta="S";
							$classGeneral->idNivel=$_POST["idNivel"];
							$insert=$classGeneral->setInstancia("mdmPreguntaRespuesta", array("dateReg"),$classGeneral);
						}
						/*echo "6<-----";	 */
						if($insert){$update=General::updateData($this->DBObject, array("id"=>$_POST["idpregunta"]), array("idTipoPregunta"=>1));
						}
					/*echo "7<-----";	 */
					}
 					echo $ok;
					exit();	
				}
				if($_POST['case']==2 and $_POST['valinsertres']=="S"){
					$respuestas= explode("|",$_POST["respuestas"]);
					$respuestaCorrecta=  explode("|",$_POST["correcto"]);
					$ok="NO";
					if($res){
 						$cantidadElementos=count($respuestas);
  						for($i=1;$i<($cantidadElementos-1);$i++){
							$classGeneral->idPregunta=$res;
							$classGeneral->respuesta=$respuestas[$i];
							$classGeneral->idLogo=0;
							$classGeneral->respuestaCorrecta=$respuestaCorrecta[$i];
							$classGeneral->idNivel=$_POST["idNivel"];
							$insert=$classGeneral->setInstancia("mdmPreguntaRespuesta", array("dateReg"));
						}
						if($insert){$ok="OK";
						}
 					}
					echo $ok;
					exit();	
				}
             }
        }
		if ($this->modo == "editar") {
            //Obtenemos Listado de Campos de la tabla
            $this->mDetalle = $classGeneral->getInstancia($this->DBObject, array('id'=>$_GET['item']));
            $this->mDetalle = Obj2ArrRecursivo($this->mDetalle);
            
	
				  	 $respuestas= General::getTotalDatos("mdmPreguntaRespuesta",array("respuesta","respuestaCorrecta","id"),"idPregunta='".$this->mDetalle['id']."' and idLogo=0");
				    if($this->mDetalle['idTipoPregunta']==2){
					$tempRes=array();
					   
					   for($j=0;$j<count($respuestas);$j++){
						   
					       $tempRes[]=array($respuestas[$j]->respuesta,$respuestas[$j]->respuestaCorrecta,$respuestas[$j]->id);
						}
					   
					   $elements["respuestas"]=$tempRes;
					}
					 
				    if($this->mDetalle['idTipoPregunta']==1){
					   $Logo= General::getTotalDatos("mdmPreguntaRespuesta","","idPregunta='".$this->mDetalle['id'] ."' and idLogo>0");
					   $GetLogo= General::getTotalDatos("mdmLogo",array("archivo","id"),"id='".$Logo[0]->idLogo."'");

					   $elements["logo"]=array($GetLogo[0]->id,$GetLogo[0]->archivo);
					}
				   
		   $this->elements=$elements;
		   //printVar($this->elements);
 		//Eliminamos Registro
 		}	
		elseif ($this->modo == "eliminar"){
			
			
			$classGeneral->unSetInstancia($this->DBObject, $_GET['item']);
			
			
			$classGeneral->unSetWhereAdd("mdmPreguntaRespuesta", " idPregunta='".$_GET['item']."'");
			
 			echo "<script>alert('Item Eliminado'); location.href = '".str_replace("amp;", "", Seccion($_GET['seccion'], 'listado', 0, $this->mPage, $this->mTextSearch))."'</script>";
			
			//Traemos datos para el listado
		} elseif ($this->modo == "listado"){
			
			$where = "";
			if($this->mTextSearch!=""){
				$where = " pregunta LIKE '%".utf8_decode($this->mTextSearch)."%'";
			}
			
			//Total de Registros
			$totalReg = $classGeneral->getTotalInstancia($this->DBObject, $where);
			
			//Obtenemos en un array la paginacion
			$this->mPagination = pagination( $this->mPage, $this->mCantidad, $totalReg, $this->mTextSearch );
			
			//Traemos listado de items por pagina
			$this->mLista = $classGeneral->getRowInstancia($this->DBObject, $where, 'id DESC', $this->mPage, $this->mCantidad);
 			$arrayTemp=array();
			for($i=0;$i<count($this->mLista);$i++){
				$elements=array();
			    foreach($this->mLista[$i] as $key=>$value){
 					if($key=="idTipoPregunta"){
						 $respuestas= General::getTotalDatos("mdmPreguntaRespuesta",array("respuesta","idNivel","idPregunta","idLogo"),"idPregunta='".$this->mLista[$i]->id."' and idLogo=0");
						if($value==2){
							$tempRes=array();
 						    for($j=0;$j<count($respuestas);$j++){
						   
							   $tempRes[]=$respuestas[$j]->respuesta;
							  // $tempRes[]=$respuestas[$j]->idNivel;
							}
 						   $elements["respuestas"]=$tempRes;
						   $nivel=General::getTotalDatos("mdmPresNivel","","id='".$respuestas[0]->idNivel."'");
						   //printVar($nivel);
 						   $elements["idNivelTrivia"]=$nivel[0]->nombre;
						   
						}
 						if($value==1){
						   $Logo= General::getTotalDatos("mdmPreguntaRespuesta","","idPregunta='".$this->mLista[$i]->id."' and idLogo>0");
						   $GetLogo= General::getTotalDatos("mdmLogo",array("archivo","id"),"id='".$Logo[0]->idLogo."'");

						   $elements["logo"]=array($GetLogo[0]->id,$GetLogo[0]->archivo);
						   $nivel=General::getTotalDatos("mdmPresNivel","","id='".$Logo[0]->idNivel."'");
						  // 	printVar($nivel);
 
						   $elements["idNivelTrivia"]=$nivel[0]->nombre;
						}
 				    }
				  $elements[$key]=$value;
				}
				$arrayTemp[]=$elements;
			}
			$this->mLista=$arrayTemp;
			if($this->mPagination['totalPaginas']<$this->mPage){
				return false;
			}
			for($i=0;$i<count($this->mLista);$i++){
					//Creamos un nuevo valor
					$this->mLista[$i]["pregunta"] = stripslashes($this->mLista[$i]["pregunta"]);
					$this->mLista[$i]["linkEditar"] = Seccion($_GET['seccion'], 'editar', $this->mLista[$i]["id"], $this->mPage);
					$this->mLista[$i]["linkVer"] = Seccion($_GET['seccion'], 'ver',$this->mLista[$i]["id"], $this->mPage);
					$this->mLista[$i]["linkEliminar"] = Seccion($_GET['seccion'], 'eliminar', $this->mLista[$i]["id"], $this->mPage);
				
			}
		}   
    }
}

?>