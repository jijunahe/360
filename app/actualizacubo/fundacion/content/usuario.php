<?php

class Usuario {

    public $modo = "";
	public $numeroDocumento = NULL;

    public function __construct() {
        require( DB_DIR . "db.".PREFIJO_TABLAS."UsuarioRegistrado.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."Invitado.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."Puntos.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."Puntosxusuario.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."LogsPuntos.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."RegaloUsuario.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."Regalo.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS.".php" );
         require( DB_DIR . "db.".PREFIJO_TABLAS."Xusuario.php" );
       // require( DB_DIR . "db.".PREFIJO_TABLAS."Invitado.php" );
       // require( DB_DIR . "db.".PREFIJO_TABLAS."UsuarioOportunidad.php" );
        require( DB_DIR . "db.".PREFIJO_TABLAS."Ciudad.php" );
        require_once CLASS_DIR . "class.General.inc.php";  //clase de usuario
        $this->mLink = 'index.php';
    }

    public function init() {
        $general = new General();
        //Listado de ciudades
		$this->ciudades=General::getTotalDatos(PREFIJO_TABLAS."Ciudad");
		if(isset($_SESSION["option"])){
			$op=$_SESSION["option"];
			if(isset($_POST["registro"]) and $_POST["registro"]==1){
				$op="registro";
			}
			 
			switch($op){
				case "formulario":
					//printVar($_SESSION['userFb'.SUFIJO]['id']);
					if ((Int)$_SESSION['userFb'.SUFIJO]['id']>0) {
						 $userFB = $general->getTotalDatos(PREFIJO_TABLAS."UsuarioRegistrado",array("id","idFacebook","numeroDocumento"), " idFacebook = '" . $_SESSION['userFb'.SUFIJO]['id'] . "'");            
							  
						 
						if(isset($userFB[0]->id)  ){
						
							echo "yaregistrado";
							exit;
						} else {
							$this->email = @$_SESSION['userFb'.SUFIJO]['email'];
							$this->nombres = utf8_encode(@$_SESSION['userFb'.SUFIJO]['first_name']." ".@$_SESSION['userFb'.SUFIJO]['middle_name']);
							$this->apellidos = utf8_encode(@$_SESSION['userFb'.SUFIJO]['last_name']);
 							$this->ciudades = $general->getRowInstancia(PREFIJO_TABLAS.'Ciudad');
						}
					}
  					
 					// printVar($this->ciudades);
 				break;				
				case "cedula":
				
					if ((Int)$_SESSION['userFb'.SUFIJO]['id']>0) {
						 $userFB = $general->getTotalDatos(PREFIJO_TABLAS."UsuarioRegistrado",array("id","idFacebook","numeroDocumento"), " numeroDocumento = '" . $_POST['texto']. "'");            
						
						if(!isset($userFB [0]->numeroDocumento)){
							echo "true";
						}else{
							echo "false";
						}
						 
					}else{
							echo "false";
					}
  					
 					//printVar($this->ciudades);
 				break;
				
				case "registro":
				
					if ((Int)$_SESSION['userFb'.SUFIJO]['id']>0) {
						 $userFB = $general->getTotalDatos(PREFIJO_TABLAS."UsuarioRegistrado",array("id","idFacebook","cedula"), " idFacebook = '" . $_SESSION['userFb'.SUFIJO]['id'] . "'");            
							  
						 
						if(isset($userFB[0]->id)  ){
							unset($_SESSION["option"]);
							echo "yaregistrado";
							exit;
						} 
					}
					if (isset($_POST['op']) and $_POST['op']=="registro") {
 						if ((Int)$_SESSION['userFb'.SUFIJO]['id']>0) {
							$cedula = $general->getTotalDatos(PREFIJO_TABLAS."UsuarioRegistrado",array("id","idFacebook","cedula"), " cedula = '" . $_POST['documento']. "'");            
 							
							if(isset($cedula[0]->id)  ){
								unset($_SESSION["option"]);
								echo "CEDULA||" . $this->mLink;
								exit;
							} 
							 
							$invitado = $general->getTotalDatos(PREFIJO_TABLAS."Invitado","", " idFacebookInvitado = '" . $_SESSION['userFb'.SUFIJO]['id'] . "'");
							$esInvitado=false;
							if(isset($invitado[0]->id)){
								$general->idFacebook = $invitado[0]->idFacebookInvita;
								$general->idUsuarioInvita = $invitado[0]->idUsuarioInvita;
								$general->tipoRegistro = "Invitado";
								$esInvitado=true;
							}else{
								$general->tipoRegistro = "Nuevo";
 							}
							if(isset($_SESSION['userFb'.SUFIJO]['username'] )){
							$general->usuarioFacebook = @$_SESSION['userFb'.SUFIJO]['username'];
							}
  							$general->idFacebook = @$_SESSION['userFb'.SUFIJO]['id'];
							$general->emailFacebook = @$_SESSION['userFb'.SUFIJO]['email'];
							$general->nombre = utf8_encode($_POST['nombre']);
							$general->apellido = utf8_encode($_POST['apellido']);
							$general->cedula = utf8_encode($_POST['documento']);
							$general->celular = utf8_encode($_POST['celular']);
							$general->email = utf8_encode($_POST['correo']);
 							$general->fechaNacimiento = utf8_encode($_POST['datepicker']);
							$general->direccion = utf8_encode($_POST['direccion']);
							$general->divipola = utf8_encode($_POST['ciudad']);
							$general->fecha = date("Y-m-d H:i:s");
  							$info_email="";
							if(isset($_POST['info_email'])){
								$info_email=$_POST['info_email'];
							}
 							$general->aceptoInfo = $info_email;
 							$comoteenteraste="";
							if(isset($_POST['comoteenteraste'])){
								$comoteenteraste=$_POST['comoteenteraste'];
							}
 							$general->comoteEnteraste = utf8_encode($comoteenteraste);
 							$resul = $general->setInstancia(PREFIJO_TABLAS.'UsuarioRegistrado');
							/*AGREGAR REGALOS INICIALES*/
							
							
							if($resul){
							
							
								/*ASIGNACION DE PUNTOS  ITEM 10*/
								/*
								ID	DESCRIPCION																			PUNTOS
								1	invitacion	Invitar amigas otorga un punto											1
								2	aceptar invitacion	Si una amigo acepta invitacion, otorga 3 puntos a quien invita	3	 
								3	dar regalo	Dar un regalo da un punto												1	 
								4	recibir regalo	recibir un regalo otorga 2 puntos									2	 
								5	Post diario	Cada post diario otorga 5 puntos										5	 
								6	Unirce a plan	Otorga 5 puntos al dueño de el plan									5	 
								10 otorga 5 puntos por registrarce
								*/
								$generalregistro=clone $general;
 								$PUNTOS = $generalregistro->getTotalDatos(PREFIJO_TABLAS."Puntos","", " id = '10'");
 								$generalregistro->idUsuario= $resul;
								$generalregistro->idFacebook=$_SESSION['userFb'.SUFIJO]['id'];
								$generalregistro->usuarioFacebook="";
								$generalregistro->idPuntos=$PUNTOS[0]->id;
								$generalregistro->puntos=$PUNTOS[0]->puntos;
								$generalregistro->idFacebookInvitado= "";
								$generalregistro->fecha= date("Y-m-d H:i:s");
 								$ResLogsRegistro=$generalregistro->setInstancia(PREFIJO_TABLAS.'LogsPuntos');								
							
							
								$regalos=General::getTotalDatos(PREFIJO_TABLAS."Regalo",""," visible='S'");
								
								if(isset($regalos[0]->id)){
									$datosUsuario=General::getTotalDatos(PREFIJO_TABLAS."UsuarioRegistrado",array("id","idFacebook"), " idFacebook = '" . $_SESSION['userFb'.SUFIJO]['id']. "'");     
									if(isset($datosUsuario[0]->id)){
										$generalCloneRegalos=clone $general;
										for($i=0;$i<count($regalos);$i++){
											$generalCloneRegalos->idUsuario=$datosUsuario[0]->id;
											$generalCloneRegalos->idFacebook= $_SESSION['userFb'.SUFIJO]['id'];
											$userName="";
											if(isset($_SESSION['userFb'.SUFIJO]['username'])){
												$userName=$_SESSION['userFb'.SUFIJO]['username'];
											}
											$generalCloneRegalos->usuarioFacebook=$userName;
											$generalCloneRegalos->idRegalo=$regalos[$i]->id;
											$generalCloneRegalos->tipoRegalo="inicial";
											$generalCloneRegalos->estado="S";
											$generalCloneRegalos->fechaActualizado=date("Y-m-d H:i:s");
											$generalCloneRegalos->fecha=date("Y-m-d H:i:s");
											$resRegalo=$generalCloneRegalos->setInstancia(PREFIJO_TABLAS.'RegaloUsuario');
										}
										
										/*CREAR PLAN DE VIAJE*/	
										$generalPlan=clone $general;
										$generalPlan->idUsuarioCreador=$datosUsuario[0]->id;
										$generalPlan->fecha=date("Y-m-d H:i:s");
										$resRegalo=$generalPlan->setInstancia(PREFIJO_TABLAS);	
									
									}
  								}
 							}
 							if($esInvitado==true and $resul){
								
								/*ASIGNACION DE PUNTOS  ITEM 2*/
								/*
								ID	DESCRIPCION																			PUNTOS
								1	invitacion	Invitar amigas otorga un punto											1
								2	aceptar invitacion	Si una amigo acepta invitacion, otorga 3 puntos a quien invita	3	 
								3	dar regalo	Dar un regalo da un punto												1	 
								4	recibir regalo	recibir un regalo otorga 2 puntos									2	 
								5	Post diario	Cada post diario otorga 5 puntos										5	 
								6	Unirce a plan	Otorga 5 puntos al dueño de el plan									5	 
								*/
								$generalClone=clone $general;
 								$PUNTOS = $generalClone->getTotalDatos(PREFIJO_TABLAS."Puntos","", " id = '2'");
 								$generalClone->idUsuario= $invitado[0]->idFacebookInvita;
								$generalClone->idFacebook=$invitado[0]->idUsuarioInvita;
								$generalClone->usuarioFacebook="";
								$generalClone->idPuntos=$PUNTOS[0]->id;
								$generalClone->puntos=$PUNTOS[0]->puntos;
								$generalClone->idFacebookInvitado= $_SESSION['userFb'.SUFIJO]['id'] ;
								$generalClone->fecha= date("Y-m-d H:i:s");
 								$ResLogsClone=$generalClone->setInstancia(PREFIJO_TABLAS.'LogsPuntos');								
 								
								
								$datosUsuarioInvitado=General::getTotalInstancia(PREFIJO_TABLAS."Xusuario",""," idUsuarioFacebook='". $invitado[0]->idFacebookInvita."' and idFacebookInvitado='". $_SESSION['userFb'.SUFIJO]['id'] ."'");
								if($datosUsuarioInvitado==0){	
 									/*VERIFICAMOS SI ESTA INSCRITO EN EL APP*/
										//printVar($datosUsuarioInvitado);
									
									
									if(isset($datosUsuarioInvitado[0]->id)){
										$generalInvita=new General();
										
										$GetMiPlan=General::getTotalDatos(PREFIJO_TABLAS,"",array("idUsuarioCreador"=>$invitado[0]->idUsuarioInvita));
										$generalInvita->idPlan=$GetMiPlan[0]->id;
										$generalInvita->idUsuario=$invitado[0]->idUsuarioInvita;
										$generalInvita->idUsuarioFacebook=$invitado[0]->idFacebookInvita;
										$generalInvita->usuarioFacebook="";
										$generalInvita->idUsuarioInvitado=$resul;
										$generalInvita->idFacebookInvitado= $_SESSION['userFb'.SUFIJO]['id'];
										$generalInvita->aceptado="P";
										$generalInvita->mostrar="N";
										$generalInvita->fecha=date("Y-m-d H:i:s");
										//DB_DataObject::debugLevel(1);	
										$Resplanxusuario=$generalInvita->setInstancia(PREFIJO_TABLAS.'Xusuario');	
										//printVar($ResPuntosAlOtro);
										if($Resplanxusuario){
							
											/*ASIGNACION DE PUNTOS  ITEM 9*/
											/*
											ID	DESCRIPCION																			PUNTOS
											1	invitacion	Invitar amigas otorga un punto											1
											2	aceptar invitacion	Si una amigo acepta invitacion, otorga 3 puntos a quien invita	3	 
											3	dar regalo	Dar un regalo da un punto												1	 
											4	recibir regalo	recibir un regalo otorga 2 puntos									2	 
											5	Post diario	Cada post diario otorga 5 puntos										5	 
											6	Unirce a plan	Otorga 5 puntos al dueño de el plan									5	 
											7	da dos puntos a la persona que le evia el regalo, solo si el regalo es aceptado		2
											8	Acepta invitacion a plan de viaje otorga un punto									1
											9	El usuario se gana un punto por invitar a otro a un plan							1	 
											*/
											$generalClone2=clone $general;
											$PUNTOS = $generalClone2->getTotalDatos(PREFIJO_TABLAS."Puntos","", " id = '9'");
											$generalClone2->idUsuario= $invitado[0]->idFacebookInvita;
											$generalClone2->idFacebook=$invitado[0]->idUsuarioInvita;
											$generalClone2->usuarioFacebook="";
											$generalClone2->idPuntos=$PUNTOS[0]->id;
											$generalClone2->puntos=$PUNTOS[0]->puntos;
											$generalClone2->idFacebookInvitado= $_SESSION['userFb'.SUFIJO]['id'] ;
											$generalClone2->fecha= date("Y-m-d H:i:s");
											$ResLogsClone=$generalClone2->setInstancia(PREFIJO_TABLAS.'LogsPuntos');
										} 
									}
								}								
								
  								if($ResLogsClone){
									echo "OK";	
								}else{
									echo "error";
								}
 							}elseif($resul){
								
								echo "OK";
							
							}
							
							
							//printVar($resul);
						}

					}
				break;
			}
		} 
    }

}

?>