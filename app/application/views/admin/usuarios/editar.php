<script type="text/javascript" src="/bateria/scripts/yav1_4_1/js/yav.js"></script>
<script type="text/javascript" src="/bateria/scripts/yav1_4_1/js/yav-config-es.js"></script>
<link rel="stylesheet" href="/bateria/styles/formulario.css">

<style>
.limebutton{
	background-image:none;
}
	input, textarea, select, button {
     font-size: 100%;
     font-family: inherit;
}
	.ventanaBodyError {
	color: #990000;
	border: solid 1px #4F0000;
	padding: 5px;
	background-color: #FFF0E1;
	}
	
	.divGood {
	background-color: #E2FFDF;
	border: 1px solid #085500;
	padding: 5px;
 	text-align: center;
	}
	
	.divGoodOK {
	 
	}
	
.cotuni{
	padding:5px;
border: 1px solid #085500;
	border-radius: 10px;	
}	
	
	
.unidades{
	padding:2px;
	float:left;
	margin-left:5px;
	background-color: #E2FFDF;
	border: 1px solid #085500;
	border-radius: 10px;
}

.nombreunidad{
	padding:2px;
	float:left;
	color: #1F497D;
	font-weight: bold;
	margin-left:10px;
	font-size: 18px;
}

.eliminaunidad{
	text-align: center;
	color: red;
	font-weight: bold;
	text-rendering: optimizelegibility;
	font-size: 22px;
	float:left;
	cursor:pointer;

}	
	
	
	
	
	
	
</style>
<?php 
	$emptydata="";
	if($msg=="" ){ 

		$oRecord22= User::model()->findByPk($_SESSION['loginID']); 
		//printVar($oRecord);
		$dUsuario22 = EvalUsuarios::model()->findByPk($oRecord22->iduseval);	
		$estadoedit="";
		if($dUsuario22->id==$user->id){
			$estadoedit="auto";
		}
	
		if(($dUsuario22->id!=$user->id) or $oRecord22->uid==1){
			$estadoedit="administra";
		}
		 
	
		
		if(isset($user->id)){
			$usuario=EvalUsuarios::model()->selectUsuarioById($user->id);
			 
			//$dato = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			$validar=array("nom_cargo","pais","tipotrabajador","nom_area","postgrado","cargo","tarjetaprofesional","licencia","idprofesion","activo","alias","desofacemp","nom_unidad");				
			$estadodatos=true;
			
			$etiquetas=array(
			'id' => 'ID',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'alias' => 'Nombre de usuario:',
			'clave' => 'Clave',
			'documento' => 'Documento',
			'email' => 'Email',
 			'id_unidad' => 'Id Unidad',
			'id_area' => 'Seleccione el departamento, área o sección de la empresa en la que trabaja:',
 			'id_cargo' => 'Cargo',
     		'idtipo' => 'Seleccione el tipo de cargo que más se parece al que usted desempeña. Si tiene dudas pida apoyo a la persona que le entregó el cuestionario:',
			'genero' => 'Género',
			'fechanacimiento' => 'Fecha de nacimiento',
			'estadocivil' => 'Estado Civil:',
			'estrato' => 'Seleccione el estrato de los servicios públicos de su vivienda:',
			'tipovivienda' => 'Tipo vivienda:',
			'idnivelestudios' => 'Último nivel de estudios que alcanzó:',
			'lugarresidenciaactual' => 'Lugar de residencia:',
			'lugardetrabajoactual' => 'Lugar donde trabaja actualmente:',
			'idprofesion' => '¿Cúal es su ocupación profesión?',
			'anosempresa' => '¿Hace cuántos años que trabaja en esta empresa?',
 			'tipocontrato' => 'Seleccione el tipo de contrato que tiene actualmente:',
			'htrabajoemp' => '¿Hace cuántos años que desempeña el cargo u oficio actual en esta empresa?',
			'tiposalario' => 'Seleccione y marque el tipo de salario que recibe:',
			'personasacargo' => 'Número de personas que dependen económicamente de usted (aunque vivan en otro lugar)',
			'horasdiarias' => 'Indique cuántas horas diarias de trabajo están establecidas habitualmente por la empresa para su cargo:',
			'postgrado' => 'Postgrado',
			'cargo' => 'Cargo',
			'tarjetaprofesional' => 'Tarjeta profesional',
			'licencia' => 'Licencia',
			'lugarcedula' => 'Lugar de expedición de la cédula',
			);
			
			

			$etiquetas2=array(
			'id' => array(1,2,3,4),
			'nombres' =>array(1,2,3,4),
			'apellidos' =>array(1,2,3,4),
			'alias' =>array(1,2,3,4),
			'clave' =>array(1,2,3,4),
			'documento' =>array(1,2,3,4),
			'email' => array(1,2,3,4),
 			'id_unidad' => array(1,3,4),
			'id_area' => array(2),
 			'id_cargo' => array(2),
     		'idtipo' =>array(2),
			'genero' => array(1,2,3,4),
			'fechanacimiento' => array(1,2,3,4),
			'estadocivil' =>array(2),
			'estrato' =>array(2),
			'tipovivienda' => array(2),
			'idnivelestudios' => array(2),
			'lugarresidenciaactual' => array(2),
			'lugardetrabajoactual' =>array(2),
			'idprofesion' => array(2),
			'anosempresa' =>array(2),
 			'tipocontrato' => array(2),
			'htrabajoemp' => array(2),
			'tiposalario' =>array(2),
			'personasacargo' =>array(2),
			'horasdiarias' =>array(2),
			'postgrado' => array(1,3,4),
			'cargo' => array(1,3,4),
			'tarjetaprofesional' =>array(1,3,4),
			'licencia' => array(1,3,4),
			'lugarcedula' => array(1,3,4),
			);			
			
 			
			$emptydata="";
			foreach($usuario as $key=>$valor){ 
				if(!in_array($key,$validar) and $key!=""){ 
					if($valor=="" or $valor==NULL or empty($valor ) ){
						
						if($valor==0 and is_numeric($valor)){ } 
						else{  
							if(in_array($user->perfil,$etiquetas2[$key])){
								$emptydata.='<div style="display:block" class="ventanaBodyError">'.$etiquetas[$key].'</div><div style="clear:both"></div>';
							}
						}
					}
				}
			}	
			
		}
		//printVar($emptydata);
 	?>
	<script type="text/javascript">
		
function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){return false;}else{return true;}
 }		
		
		obj = {
			data: <?=json_encode($cunive);?>,
			evals: <?=json_encode($user->evals)?>,
			jefes: <?=json_encode($user->jefes)?>,
			colas: <?=json_encode($user->colas)?>,
			findPosID:function(laID){
				var i; var pos = 0;
				for(i=0; i < this.data.length; i++){
					if(this.data[i].id == laID)return i;
				}
				},	consultarUserName : function(){
				jQuery("#imgAccountGood").css("display","none");
				jQuery("#imgAccountBad").css("display","none");
				jQuery("#textUsrEval").val("-1");
				jQuery("#imgAccountLoad").css("display","");
				jQuery("#textUsr").value = jQuery("#textUsr").val().toLowerCase();
				var username = jQuery("#textUsr").val()+"";
				if(username.length == 0){
					jQuery("#imgAccountLoad").css("display","none");
					jQuery("#imgAccountBad").css("display","");
					alert("Debe escribir el nombre de usuario");
					jQuery("#textUsr").focus();
					return;
				}
				if(username.length < 8){
					jQuery("#imgAccountLoad").css("display","none");
					jQuery("#imgAccountBad").css("display","");
					alert("El nombre de usuario debe tener minimo 8 caracteres");
					jQuery("#textUsr").focus();
					return;
				}
				if(username.length > 100){
					jQuery("#imgAccountLoad").css("display","none");
					jQuery("#imgAccountBad").css("display","");
					alert("El nombre de usuario debe tener maximo 100 caracteres");
					jQuery("#textUsr").focus();
					return;
				}
				var permitidos = "abcdefghijklmnopqrstuvwxyz1234567890-_.";
				var i = 0;
				for(i=0;i<username.length;i++){
					if(permitidos.indexOf(username.charAt(i)) == -1){
						jQuery("#imgAccountLoad").css("display","none");
						jQuery("#imgAccountBad").css("display","");
						alert("Solo se permiten letras, numeros, punto, guion bajo y guion medio. No se permiten tildes, ñ, espacios.");
						jQuery("#textUsr").focus();
						return;
					}
				}
				var especiales = "-_.";
				if(especiales.indexOf(username.charAt(0)) != -1 || especiales.indexOf(username.charAt(username.length - 1)) != -1){
					jQuery("#imgAccountLoad").css("display","none");
					jQuery("#imgAccountBad").css("display","");
					alert("El nombre de usuario no puede empezar ni finalizar por (-_.)");
					jQuery("#textUsr").focus();
					return;
				}
				var aleatorio = Math.random()*1000000;
				
				var url="/bateria/index.php/admin/usuarios/";
				var pars = {account:username,alea:aleatorio,option:6};
				var res = jQuery.ajax({ 
					type: "POST",
					dataType: "html",
					async: false,
					url: url,
					data:pars 
				}).responseText;
				
				jQuery("#imgAccountLoad").css("display","none");
				jQuery("#imgAccountGood").css("display","none");
				jQuery("#imgAccountBad").css("display","none");
				if(res=="OK"){
					jQuery("#imgAccountGood").css("display","");
					jQuery("#textUsrEval").val("1");
					}else{
					
					jQuery("#imgAccountBad").css("display","");
					alert("El nombre de usuario "+username+" ya existe en la base de datos. \n"+
					"Le recomendamos usar las siguientes combinaciones:\n"+
					"nombre.apellido o nombre_apellido o nombre-apellido\n"+
					"nombre.apellido1970 o nombre_apellido1970 o nombre-apellido1970\n");
				}			
				
			},
			reestablecerDivError : function(){
				var i = 0;
				for(i = 0; i < rules.length; i++){
					var partes = rules[i].split("|");
					jQuery('#errorsDiv_'+partes[0]).html("");
					jQuery('#errorsDiv_'+partes[0]).attr("class","");
				}
			},
			
			enviarForm : function(){
				this.reestablecerDivError();
				var bool1 = performCheck('formCrear', rules, 'inline');
 				if(bool1 == true){
					return true;
					}else{
					return false;
				}
			},
			evaluarForm :function (){
				if(this.enviarForm()){
					var envio=true;
					if(jQuery("#textPas").size()>0){
						var pass1=jQuery("#textPas").val();
						var pass2=jQuery("#textPas2").val();
 						if(pass1.trim("")=="" || pass2.trim("")==""){
							jQuery.colorbox({html:"<h2>La contraseña no puede estar vacía</h2>"});
							envio=false;
						}	 			
						if(pass1.trim("")!=pass2.trim("")){
							jQuery.colorbox({html:"<h2>Las contraseña no coinciden</h2>"});
							envio=false;
						}
					}
					<?php if($user->perfil==1  || $user->perfil==3 ){?>
						var email=jQuery("#textMail").val();
						var empresa=jQuery("#textUnidadidentre").val();
 						var perfil=jQuery("#selectPerfil").val();
						var test=empresa.split(",");
						if(perfil==2){
 							if(test[0]>0){
								jQuery("#textUnidadidentre").val(test[0]);
							}else{
								jQuery.colorbox({html:"<h2>Por favor agregue una empresa</h2>"});
								envio=false;
							}
 						}
 						if(perfil!=2){
 							if(test[0]>0){
								jQuery("#textUnidadidentre").val(test[0]);
							}else{
								jQuery.colorbox({html:"<h2>Por favor agregue al menos una empresa</h2>"});
								envio=false;
							}
 						}
						if(validarEmail(email)==false){
							jQuery.colorbox({html:"<h2>El email no es válido</h2>"});
							envio=false;
						}
					<? }?>
 					if(envio==true){
 						jQuery('#formCrear').submit();
					}
				}
			}	
		}
 		
		var rules=new Array();
		var rulesItem = 0;
		rules[rulesItem]='textDoc|required|No puede dejar en blanco su numero de documento';rulesItem++;
		rules[rulesItem]='textDoc|numeric|Solo escriba numeros, sin puntos, comas o espacios';rulesItem++;
		rules[rulesItem]='textNom|required|No puede dejar en blanco su nombre';rulesItem++;
		rules[rulesItem]='textNom|alphaspace|Solo utilize letras del abecedario y vocales con tilde';rulesItem++;
		rules[rulesItem]='textApe|required|No puede dejar en blanco sus apelldos';rulesItem++;
		rules[rulesItem]='textApe|alphaspace|Solo utilize letras del abecedario y vocales con tilde';rulesItem++;
		rules[rulesItem]='textMail|required|Escriba su correo electronico';rulesItem++;
		rules[rulesItem]='textMail|email|Escriba su correo electronico en el siguiente formato: micorreo@ejemplo.com';rulesItem++;
		rules[rulesItem]='textPais|required|Escriba el pais donde trabaja el usuario';rulesItem++;
		
		
		jQuery(function(){
			$( "#textFn" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd",minDate: "-120Y",maxDate: "-18Y","yearSuffix":"CE","yearRange":"1920:2050"});
			
			jQuery("#textFn").keydown(function(e){
				var keyc=e.keyCode;
				console.log(keyc);
				var test=jQuery(this).val();
				var tamanio=test.length;
				if((keyc>=48 && keyc<=57) || (keyc>=96 && keyc<=105) || (keyc==8 || keyc==46) || (keyc==37 || keyc==39) ){
					
					if((keyc>=48 && keyc<=57) || (keyc>=96 && keyc<=105)){
 						
						if(tamanio==4){
							var ant=jQuery(this).val();
							var hoy = new Date();
 							var yyyy = hoy.getFullYear(); 
							
							var testa=yyyy-parseInt(ant);
							if(testa<18){
							
								alert("El año no es válido");
								jQuery(this).val("");
							}else{
							
								jQuery(this).val(ant+"-");
							}
						}
						
						if(tamanio==7){
							var ant=jQuery(this).val();
							jQuery(this).val(ant+"-");
						}
						
						if(tamanio>=9){
							var ant=jQuery(this).val();
							 ant=ant.substring(0, 9);
							jQuery(this).val(ant);
						}
 					}
					
				}else{
					return false;
				}
				
				
			});
			
			jQuery("#selectPerfil").change(function(){  
				var id=jQuery(this).val();
				 
				if(id==2 || id=='NULL'){
					jQuery(".entrevistador").hide();
					jQuery(".trabajador").show();
					
					}else if(id==1 || id==3  || id==4 ){
					jQuery(".entrevistador").show();
					jQuery(".trabajador").hide();
					jQuery(".empresaus").show();

				}
				<? if($estadoedit=="administra"){ ?>
					jQuery(".empresaus").show();
					
				<?}?>

				
			});
			<?php if($user->perfil==2){?> 
				jQuery(".entrevistador").hide();
				jQuery(".trabajador").show();
			<?php }?>
			<?php if($user->perfil==1  || $user->perfil==3 || $user->perfil==4){?>
				jQuery(".entrevistador").show();
 				jQuery(".trabajador").hide();
				
			<?php }?>
							<? if($estadoedit=="administra"){ ?>
					jQuery(".empresaus").show();
					console.log("entro");
				<?}?>

			
		});
		
		
$.expr[':'].icontains = function(obj, index, meta, stack){
return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
};		
		
		
function buscador(){
	jQuery("#bun").click(function(){
		var datobus=jQuery("#buscarunidad").val().toLowerCase();
 		var objsnoms=jQuery(".addunidad");
		jQuery('[id^="add_unidad_"]').parent().hide();
  		jQuery.each(objsnoms,function(key,data){
     		if(jQuery(data).parent().find(":icontains('"+datobus.trim(" ")+"')").text()!="" ){
 				jQuery(data).parent().show();
 			} 
 		});
	});
	jQuery("[id='refrescar']").click(function(){jQuery('[id^="add_unidad_"]').parent().show();});

}		
function add(){
	jQuery("[id^='add_unidad_']").click(function(){
		 var obj=jQuery(this);
		 var id=obj.attr("id").split("add_unidad_")[1];
		 var html=obj.text();
		 var ids=[];
 		 if(jQuery("#el_unidad_"+id).size()==0){
			obj.parent().remove();
			var htm='<span class="unidades eliminar"><span class="nombreunidad">'+html+'</span><span id="el_unidad_'+id+'" class="eliminaunidad">X</span></span>';
			jQuery("#added_contenedor").prepend(htm);
			elim();
 			var lelementos=jQuery("[id^='el_unidad_']");
			jQuery.each(lelementos,function(k,d){
				ids.push(jQuery(this).attr("id").split("el_unidad_")[1]);
			});
			if(ids[0]!=undefined){
				jQuery("#textUnidadidentre").val(ids.join(","));
			}
		 }
		 
	});
}	
function elim(){
	jQuery("[id^='el_unidad_']").click(function(){
		var obj=jQuery(this);
		var id=obj.attr("id").split("el_unidad_")[1];
		var html=obj.parent().find(".nombreunidad").text();
		var ids=[];
 		if(jQuery('#add_unidad_'+id).size()==0 && jQuery("[id^='el_unidad_']").size()>1){
			obj.parent().remove();
			var html='<span class="unidades adds"><span class="nombreunidad addunidad" id="add_unidad_'+id+'" style="cursor:pointer">'+html+'</span></span>';
			jQuery("#add_contenedor").prepend(html);
			add();
			buscador();
 			var lelementos=jQuery("[id^='el_unidad_']");
			jQuery.each(lelementos,function(k,d){
				ids.push(jQuery(this).attr("id").split("el_unidad_")[1]);
			});
			if(ids[0]!=undefined){
				jQuery("#textUnidadidentre").val(ids.join(","));
			}			
 		}
 	});
}
jQuery(function(){
	buscador();
	add();
	elim();
});		
		
		
</script>
	
	
	
	
	<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
	<?php if($validaini=="OK"){ ?>
 		<tr>
			<td>
				<?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formActivo', 'id'=>'formActivo','style'=>'float: left')); ?>
					<input type="hidden" id="option" name="option" value="1" />
					<input type="button" value="Activos"  onclick="jQuery(this).parent().submit();"   />
				</form>		
				<?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formIncativo', 'id'=>'formIncativo','style'=>'float: left')); ?>
					<input type="hidden" id="option" name="option" value="0" />
					<input type="button" value="Invactivos"  onclick="jQuery(this).parent().submit();"    />
				</form>		
				<?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formTodos', 'id'=>'formTodos','style'=>'float: left')); ?>
					<input type="hidden" id="option" name="option" value="2" />
					<input type="button" value="Todos" onclick="jQuery(this).parent().submit();"  />
				</form>		
				<input type="button" value="Crear" rel="editar_0" />
			</td>
		</tr>
 	<?php } ?>
	</table>
	
	<div style="clear:both"></div>
	
	
	 


<?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formCrear', 'onsubmit'=>"return obj.enviarForm();", 'id'=>'formCrear','style'=>'margin:0px; padding:0px;')); ?>

	<div id="form-main">
		<div id="form-div">
		
			<div class="divContentBlue">
				<div class="divContentWhite">			  
					<center><h3><b>FICHA DE DATOS GENERALES</b></h3></center>
					<p>
						Las siguientes son algunas preguntas que se refieren a información general de usted o su ocupación.
						<?php if($emptydata!=""  ){   ?><br><div class="ventanaBodyError"><b>*Por favor, asegurese de llenar todos los campos que están en rojo.</b></div><?php } ?>
					</p>  
					<?php if($emptydata=="" and !Permission::model()->getanOterpermision("administrador") ){ ?>
						<div style="display:<?=$msjDisplay?>" class="divGood">
							<h4 style=" font-size: 24px;line-height: 28px;">
								Sus datos han sido completados exitosamente, haga click 
								<u><b>
									<a href="/bateria/index.php/admin/survey/sa/index">aqu&iacute;</a>
									</b></u> para ir a los cuestionarios
							</h4>
							<?php 
 							if((Permission::model()->getanOterpermision("administrador"))){ ?><? }else{?> 
							<script>
								jQuery(function(){
									document.location="/bateria/index.php/admin/survey/sa/index#cin";
 								});
 							</script>
							<?php } ?>
						</div>	
					<?php }else  if($emptydata==""){?>
						<div style="display:<?=$msjDisplay?>" class="divGood">
							<h4 style=" font-size: 24px;line-height: 28px;">
								Datos estan actualizados 
								 
							</h4>
							 
						</div>					
					
					<?} ?>
				</div>			  
			</div>		
		
 			<br>
			<p  class="name <?php if($user->nombres==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>">
				<span class="titulo"> <b>1. Nombres completos:</b> </span>
				<input  name="textNom" id="textNom"  value="<?=($user->nombres)?>"  placeholder="Nombres"  type="text" class="validate[required,custom[onlyLetter],length[0,100]] campo feedback-input"/>
			</p>
 			
			<p  class="name <?php if($user->apellidos==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>" style="display:none">
				<span class="titulo"> <b>Apellidos:</b> </span>
				<input name="textApe" id="textApe"  value="NN"  placeholder="Apellidos"  type="text" class="validate[required,custom[onlyLetter],length[0,100]] campo feedback-input"/>
			</p>
			
			<?php if((Permission::model()->getanOterpermision("administrador"))){ ?> 
				<p  class="name <?php if($user->alias==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>">
					<span class="titulo"> <b>Usuario:</b> </span>
					<? if($user->alias!=""){ ?>
					<input  readonly value="<?=$user->alias?>"  onblur="obj.consultarUserName();" placeholder="Nombre de usuario"  type="text" class="validate[required,custom[onlyLetter],length[0,8]] campo feedback-input"/>
					<?php } else{?>
					Nombre de usuario que usara la persona para ingresar al sistema.<br />
					<input name="textUsr" id="textUsr"  onblur="obj.consultarUserName();" placeholder="Nombre de usuario"  type="text" class="validate[required,custom[onlyLetter],length[0,8]] campo feedback-input"/>

					<span id="imgAccountGood" style="display: none; "><img style="vertical-align: middle; width: 20px; height: 20px;" src="<?=$imageurl?>good.gif" /> disponible</span>
					<span id="imgAccountBad" style="display: none; "><img style="vertical-align: middle; width: 20px; height: 20px;" src="<?=$imageurl?>bad.gif" /> mal</span>
					<span id="imgAccountLoad" style="display: none; "><img style="vertical-align: middle; width: 20px; height: 20px;" src="<?=$imageurl?>ajax-loader.gif" /></span>
					<br />
					Solo se permiten letras, numeros, punto, guion bajo y guion medio. No se permiten tildes, ñ, espacios.
					<input type="hidden" name="textUsrEval" id="textUsrEval" value="-1">
					<? } ?>				
				</p>
			<?php } else{ echo "<input type='hidden' name='textUsr' value='".$user->alias."' />"; }?>	
 			
			<?php if((Permission::model()->getanOterpermision("administrador"))){ ?>
			<p class="name"><br>
				<span class="titulo"> <b>Perfil:</b> </span>
 				<select id="selectPerfil" name="selectPerfil" class="selectF" >
				<option value="-1" >Seleccione un rol</option>
 				<?=$pers?>
				</select>
					
			</p>
			<?php } else{ echo "<input type='hidden' name='selectPerfil' value='".$user->perfil."' />"; }?>		
			 
			<?php if((Permission::model()->getanOterpermision("administrador"))){ ?> 
				<p  class="name <?php if($user->clave==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
					<span class="titulo"> <b>Contraseña:</b> </span>
					<input name="textPas" id="textPas"  value="<?=($user->clave)?>"  placeholder="Contraseña"  type="password" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
				</p>

				<p   class="name <?php if($user->clave==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>">
					<span class="titulo"> <b>Repite la contraseña:</b> </span>
					<input name="textPas2" id="textPas2"  value="<?=($user->clave)?>"  placeholder="Contraseña"  type="password" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
				</p>
			<?php } else{ echo "<input type='hidden' name='textPas' value='".$user->clave."' />"; }?>	
			
 			<p class="name"> 
				<span class="titulo"> <b>2.G&eacute;nero:</b> </span>
 				
				<select id="textGenero" name="textGenero" class="selectF" >
					<option value="Femenino" <? if($user->genero=="Femenino"){?>selected="selected" <? } ?>>Femenino</option>
					<option value="Masculino"  <? if($user->genero=="Masculino"){?>selected="selected" <? }?>>Masculino</option>
				</select>
 			</p>			
						
 			<p  style="    height: 80px!important;"  class="name <?php if($user->documento=="" or $user->lugarcedula==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"> 
				<span class="titulo"> <b>No Documento:</b> </span>
 				<input name="textDoc" id="textDoc"  value="<?=($user->documento)?>" style="height:52px !important;width:45% !important;float:left"  placeholder="Sólo números"  type="number" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
				<span class="titulo" style="margin-left:15px;width:7% !important"> <b>de</b> </span> <input type="text" name="textLugarcedula" id="textLugarcedula"  style="width:45% !important;float:left"  maxlength="100" placeholder="ej. Bogotá"  value="<?=$user->lugarcedula?>" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
 			</p>
  			<?php if((Permission::model()->getanOterpermision("administrador"))){ ?> 
			<p  class="name <?php if($user->email==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
				<span class="titulo"> <b>Email:</b> </span>
				<input name="textMail" id="textMail"  value="<?=($user->email)?>"  placeholder="Email"  type="email" class="validate[required,custom[onlyLetter],length[0,20]] emailF feedback-input"/>
				<span style="clear:both"></span>
				<span id="errorsDiv_textMail"></span>
 			</p>
			<?php }else{?><input type="hidden" name="textMail"  value="<?=($user->email)?>"  /><?} ?>	

 			<p  class="name <?php if($user->fechanacimiento==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"> 
				<span class="titulo"> <b>3.Fecha de nacimiento:</b> </span>
				<input name="textFn" id="textFn"  value="<?=($user->fechanacimiento)?>"  placeholder="ej. 1984-01-01"  type="text" class="validate[required,custom[onlyLetter],length[0,20]] calendar feedback-input"/>
			</p>
 			
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			
			<p class="name trabajador">
				<span class="titulo"> <b>4.Estado civil:</b> </span>
				
				<select  name="textEstadocivil" id="textEstadocivil"  class="selectF"  >
					<? 
					$estados= Estadocivil::model()->findAll();
					foreach($estados as $estado){ ?>
					<option value="<?=$estado->id?>" <? if($user->estadocivil==$estado->id){ ?> selected="selected"<? } ?>><?=ucfirst($estado->nombre)?></option>
 					<? } ?>
				</select>				
  			</p>
  		
			<p class="name trabajador"><br>
				<span class="titulo"> <b>5.Último nivel de estudios que alcanzó:</b> </span>
				
				<select  name="textNivelestudio" id="textNivelestudio"   class="selectF"  >
					<?=$nivelestudios?>
				</select>				
  			</p>
 			<p class="name trabajador <?php if(  $user->profesion==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
				<span class="titulo"> <b>6.¿Cúal es su ocupación profesión?</b> </span>
				<input name="textProfesion" id="textProfesion"  value="<?=($user->profesion)?>"   type="text" class="validate[required,custom[onlyLetter],length[0,200]] numero feedback-input"/>
   			</p>
  			<p  class="name trabajador <?php if($user->lugarresidenciaactual==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
				<span class="titulo"> <b>7.Lugar de residencia:</b> </span>
				<input name="textLugarresidenciaactual" id="textLugarresidenciaactual"  value="<?=($user->lugarresidenciaactual)?>"  placeholder="ej. Bogotá"  type="text" class="validate[required,custom[onlyLetter],length[0,50]] numero feedback-input"/>
			</p>
  			<p class="name trabajador">
				<span class="titulo"> <b>8.Seleccione el estrato de los servicios públicos de su vivienda:</b> </span>
				
				<select  name="textEstrato" id="textEstrato"  class="selectF"  >
					<option value="No se" <? if($user->estadocivil=="No se"){ ?>  selected="selected" <? } ?> >No se</option>
					<option value="1" <? if($user->estrato=="1"){ ?>  selected="selected" <? } ?> >1</option>
					<option value="2" <? if($user->estrato=="2"){ ?>  selected="selected" <? } ?> >2</option>
					<option value="3" <? if($user->estrato=="3"){ ?>  selected="selected" <? } ?> >3</option>
					<option value="4" <? if($user->estrato=="4"){ ?>  selected="selected" <? } ?> >4</option>
					<option value="5" <? if($user->estrato=="5"){ ?>  selected="selected" <? } ?> >5</option>
					<option value="6" <? if($user->estrato=="6"){ ?>  selected="selected" <? } ?> >6</option>
					<option value="Finca" <? if($user->estrato=="Finca"){ ?>  selected="selected" <? } ?> >Finca</option>
				</select>				
  			</p>
				
				
 			<p class="name trabajador"><br>
				<span class="titulo"> <b>9.Tipo vivienda:</b> </span>
				
				<select name="textTipovivienda" id="textTipovivienda"  class="selectF"  >
					<option value="Propia" <? if($user->tipovivienda=="Propia"){ ?>  selected="selected" <? } ?> >Propia</option>
					<option value="En arriendo" <? if($user->tipovivienda=="En arriendo"){ ?>  selected="selected" <? } ?> >En arriendo</option>
					<option value="Familiar" <? if($user->tipovivienda=="Familiar"){ ?>  selected="selected" <? } ?> >Familiar</option>
				</select>				
  			</p>			

 		</div>
		
		
		
		
		<div id="form-div">
 			
 			<p  class="name trabajador <?php if($user->personasacargo==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"> <br>
				<span class="titulo"> <b>10.Número de personas que dependen económicamente de usted (aunque vivan en otro lugar)</b> </span>
				<input name="textPersonasacargo" id="textPersonasacargo" style="    height: 53px !important;" value="<?=($user->personasacargo)?>"  placeholder="solo números"   type="number"  min="1" max="3" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
			
 			
			<p class="name trabajador <?php if($user->lugardetrabajoactual==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>">
				<span class="titulo"> <b>11.Lugar donde trabaja actualmente:</b> </span>
				<input name="textLugardetrabajoactual" id="textLugardetrabajoactual"  value="<?=($user->lugardetrabajoactual)?>"  placeholder="ej. Bogotá"  type="text" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
			
			
 			<p  style="height:<?php if($user->anosempresa>1){ ?>160<?php }else{ echo 80;} ?>px" class="name trabajador <?php if($user->anosempresa==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
				<span class="titulo"> <b>12.¿Hace cuántos años que trabaja en esta empresa?</b> </span>
				
				<select name="tselhc" rel="textAnosempresa" id="tselhc"  class="selectF"  >
					<option value="" >Seleccione una opción</option>
					<option value="1" <? if($user->anosempresa==1){ ?>  selected="selected" <? } ?> >Menos de un año</option>
					<option value="mas" <? if($user->anosempresa>1){ ?>  selected="selected" <? } ?> >Más de un año</option>
 				</select>
 				<span class="titulo" id="tselhc_1" style="display:<? if($user->anosempresa>1){ ?> block <? }else{?>none <?} ?>"> <b>Indique cuántos</b> </span>
				<input type="number" name="tselhc_2" id="tselhc_2" maxlength="3"  style="height: 53px !important;display:<? if($user->anosempresa>1){ ?> block <? }else{?>none <?} ?>"   min="1" max="3" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input" placeholder="solo números"   value="<?=$user->anosempresa?>" />
				<input type="hidden" name="textAnosempresa" id="textAnosempresa" maxlength="50" style="width:300px"  value="<?=$user->anosempresa?>" />
 			</p>
 
				
 			<p class="name trabajador"><br>
				<span class="titulo"> <b>13.Seleccione el tipo de cargo que más se parece al que usted desempeña. Si tiene dudas pida apoyo a la persona que le entregó el cuestionario:</b> </span>
				
				<select name="selectTipocargo" id="selectTipocargo"  class="selectF"  >
 					<?
						$tcargos=TipoCargo::model()->findAll();
						foreach($tcargos as $tcargo){
						?>
						<option  value="<?=$tcargo->id?>" <? if($user->idtipo==$tcargo->id){ ?>  selected="selected" <? } ?>><?=$tcargo->nombre?></option>
						<?
						}
					?>					 
 				</select>				
  			</p>
			
  
 
 
 
 			<p  style="height:<?php if($user->htrabajoemp>1){ ?>160<?php }else{ echo 100;} ?>px"  class="name trabajador <?php if($user->htrabajoemp==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
				<span class="titulo"> <b>14.¿Hace cuántos años que desempeña el cargo u oficio actual en esta empresa?</b> </span>
				
				<select name="desemp" rel="textHtrabajoemp" id="desemp"  class="selectF"  >
					<option value=""   >Seleccione una opción</option>
					<option value="1" <? if($user->htrabajoemp==1){ ?>  selected="selected" <? } ?> >Menos de un año</option>
					<option value="mas" <? if($user->htrabajoemp>1){ ?>  selected="selected" <? } ?> >Más de un año</option>
 				</select>
 				<span class="titulo" id="desemp_1" style="display:<? if($user->htrabajoemp>1){ ?> block <? }else{?>none <?} ?>"> <b>Indique cuántos</b> </span>
				<input type="number" name="desemp_2" id="desemp_2" maxlength="3"  style="height: 53px !important;display:<? if($user->htrabajoemp>1){ ?> block <? }else{?>none <?} ?>"   min="1" max="3" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input" placeholder="solo números"   value="<?=$user->anosempresa?>" />
				<input type="hidden" name="textHtrabajoemp" id="textHtrabajoemp" maxlength="50"    value="<?=$user->htrabajoemp?>" />

  			</p> 
 
 		
 			<p class="name trabajador  <?php if(  $user->id_area==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>" style="height:<?php if($user->htrabajoemp>1){ ?>160<?php }else{ echo 100;} ?>px"> <br>
				<span class="titulo"> <b>15.Escriba el nombre del departamento, área o sección de la empresa en la que trabaja:</b> </span>
 				<?
 					$html="<option value='-1'>Seleccione un área o departamento</option>";
					foreach($areas as $a){
						$selected="";
						if($user->id_area==$a->id){
							$selected="selected='selected'";
						}
						$html.="<option value='".$a->id."' ".$selected.">".$a->nombre."</option>";
					}
 				?>
 				<select name="selectAreaid" id="selectAreaid" class="selectF" ><?=$html?></select>
    		</p>
			
 				
 			<p class="name trabajador  <?php if(  $user->id_cargo==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"  style="height:<?php if($user->htrabajoemp>1){ ?>160<?php }else{ echo 100;} ?>px"><br>
				<span class="titulo"> <b>16.¿Cuál es el nombre del cargo que ocupa en la empresa?</b> </span>
 				<?
 					$html="<option value='-1'>Seleccione un cargo</option>";
 					foreach($cargosxarea as $c){
						$selected="";
						if($user->id_cargo==$c->id){
							$selected="selected='selected'";
						}
						$html.="<option value='".$c->id."' ".$selected.">".$c->nombre."</option>";
 					}
 				?>	
				<select name="selectCargoid" id="selectCargoid"  class="selectF" ><?=$html?></select>
    			</p>
  			<p class="name trabajador"> 
				<span class="titulo"> <b>17.Seleccione el tipo de contrato que tiene actualmente:</b> </span>
 				<select name="selectTipocontrato" id="selectTipocontrato"  class="selectF"  >
 					<?=$tipocontrato?>
  				</select>				
  			</p>		
		
 			  
  			
			<p class="name trabajador <?php if($user->horasdiarias==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"><br>
				<span class="titulo"> <b>18.Indique cuántas horas diarias de trabajo están establecidas habitualmente por la empresa para su cargo:</b> </span>
				<input name="textHorasdiarias" id="textHorasdiarias" style="height: 53px !important;" value="<?=($user->horasdiarias)?>"  placeholder="Solo números"  type="number" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
 
  
 
 			<p class="name trabajador"> 
				<span class="titulo"> <b>19.Seleccione el tipo de salario que recibe:</b> </span>
 				<select name="selectTiposalario" id="selectTiposalario"  class="selectF"  >
 					<?=$tiposalario?>
  				</select>				
			</p>		
 
			<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

			
			<div  class="name entrevistador empresaus <?php if($user->id_unidad==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>">
 					<span class="titulo"> <b>Empresa:</b> </span>
 				<?php
					$unidad="";
					$idtu=explode(",",$user->id_unidad);
					$unidades=array();
					$oRecord2 = User::model()->findByPk($_SESSION['loginID']); 
					$dUsuario2 = EvalUsuarios::model()->findByPk($oRecord2->iduseval);
					if($oRecord2->uid==1 or ($dUsuario2->perfil==1 or $dUsuario2->perfil==2 or $dUsuario2->perfil==3)){
						if($oRecord2->uid==1 or $dUsuario2->perfil==1){
							$unidades="all";
						}
						
						if( $dUsuario2->perfil==3 or $dUsuario2->perfil==2){
							 
							$unidades=explode(",",$dUsuario2->id_unidad);
						}
						
					}
					
  					$unit=EvalUnidades::model()->findAllunidades($unidades);
 					$arruni=array();
  					$htmlunidad="";
					$selectunidad="";
					foreach($unit as $data){
						array_push($arruni,$data->id);
						if(in_array($data->id,$idtu)){
							$htmlunidad.="<span  class='unidades eliminar'>";
							$htmlunidad.="<span class='nombreunidad'>".$data->nombre."</span>";
							$htmlunidad.="<span id='el_unidad_".$data->id."' class='eliminaunidad'>X</span>";
							$htmlunidad.="</span>";
						}else{
 							$selectunidad.="<span  class='unidades adds'>";
							$selectunidad.="<span class='nombreunidad addunidad' id='add_unidad_".$data->id."' style='cursor:pointer'>".$data->nombre."</span>";
							$selectunidad.="</span>";
 						}
					}
 						
					 
 				?>	
 					<? if($selectunidad!=""){?>
					 <input type='text' id='buscarunidad' style="float: left;"  placeholder='Buscar empresa'/>
					 <input id="bun" type="button" value="Buscar"  style="float: left;"  />
					 <input id="refrescar" type="button" value="Refrescar"  style="float: left;"  />
					 <div style="clear:both" ></div>
 					<div class="cotuni" id="add_contenedor"   style="overflow-x: hidden;overflow-y: scroll;height:90px !important">
						<?=$selectunidad?>
						<div style="clear:both" ></div>
 					</div>
					<? } ?><br>
 					<div class="cotuni"  id="added_contenedor" >
						<?=$htmlunidad?>
						<div style="clear:both" ></div>
 					</div>
					<br>
 					<input name="textUnidadidentre" id="textUnidadidentre"  value="<?=($user->id_unidad)?>"   type="hidden" />
 			</div>
			
			<p  class="name entrevistador <?php if($user->cargo==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>">
				<span class="titulo"> <b>Profesi&oacute;n:</b> </span>
				<input name="textProfesionentre" id="textProfesionentre"  value="<?=($user->cargo)?>"   type="text" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
			
			<p   class="name entrevistador <?php if($user->postgrado==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"> 
				<span class="titulo"> <b>Postgrado:</b> </span>
				<input name="textPostgrado" id="textPostgrado"   value="<?=($user->postgrado)?>"   type="text" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
			
			
			<p  class="name entrevistador <?php if($user->licencia==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"> 
				<span class="titulo"> <b>No. Tarjeta Profesional:</b> </span>
				<input name="textLicencia" id="textLicencia"   value="<?=($user->licencia)?>"   type="text" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
			
			<p  class="name  entrevistador <?php if($user->tarjetaprofesional==""){ ?>ventanaBodyError<?php }else{ ?>divGoodOK<?php } ?>"> 
				<span class="titulo"> <b>No. Licencia en Salud Ocupacional:</b> </span>
				<input name="textTarjetaprofesional" id="textTarjetaprofesional"   value="<?=($user->tarjetaprofesional)?>"   type="text" class="validate[required,custom[onlyLetter],length[0,20]] numero feedback-input"/>
			</p>
			
			<?php if((Permission::model()->getanOterpermision("administrador"))){ ?>
 			<p class="name "> 
				<span class="titulo"> <b>Activo:</b> </span>
 				<select name="selectActivo" id="selectActivo"  class="selectF"  >
					<option value="1" <?PHP if($user->activo == 1){echo('selected="selected"');} ?>>Activo</option>
					<option value="0" <?PHP if($user->activo == 0){echo('selected="selected"');} ?>>Inactivo</option>
  				</select>				
			</p>		
 			<?php } ?>								 
 			<p>
			<div class="submit">
				<input type="button" value="Guardar"  onclick="return obj.evaluarForm();" id="button-blue"/>
				<div class="ease"></div>
			</div>
			</p>
			 
		</div>		
		
		
	</div>		
	<input type="hidden" name="textColas" id="textColas" value="-1:0" />
	<input type="hidden" name="textJefes" id="textJefes" value="-1:0" />
	<input type="hidden" name="textEvals" id="textEvals" value="-1:0" />
	<input type="hidden" name="textId" id="textId" value="<?=$user->id?>" />
	<input type="hidden" name="option"  value="10" />
	<input type="hidden" name="textAccion" value="insert" />
</form>	
	
 	
				<script>
				jQuery(function(){
					jQuery("#tselhc,#desemp").change(function(){
						var obj=jQuery(this);
						var valor=obj.val();
 						if(valor=="mas"){
							jQuery("#"+obj.attr("id")+"_1").show();
 							jQuery("#"+obj.attr("id")+"_2").show();
							jQuery("#"+obj.attr("id")+"_2").val("");
							jQuery("#"+obj.attr("id")+"_2").change(function(){
								jQuery("#"+obj.attr("rel")).val(jQuery(this).val());
							});
 							jQuery(this).parent().css({"height":"174px"});
 						}else{
							jQuery("#"+obj.attr("id")+"_1").hide();
							jQuery("#"+obj.attr("id")+"_2").hide();
							jQuery("#"+obj.attr("id")+"_2").val(1);
							jQuery("#"+obj.attr("rel")).val(1);
							jQuery(this).parent().css({"height":"100px"});
 						}
					});
					jQuery("#textPas2").change(function(){
						var pass1=jQuery("#textPas").val();
						if(pass1!=jQuery(this).val()){
							jQuery(this).parent().attr("class","name ventanaBodyError");
							jQuery("#textPas").parent().attr("class","name ventanaBodyError");
							alert("Las contraseñas no coinciden");jQuery(this).focus();
 						}else{
							jQuery(this).parent().attr("class","name");
							jQuery("#textPas").parent().attr("class","name");
 						}
 					});
 				});
				
				
			</script>
  
</div>
<div class="map_canvas"></div>
<?php }else{ ?>



<div id="content">
	<div class="divContentBlue">
		<h2><b>Perfil de usuario</b></h2>
		
		<div class="divContentWhite"><h3><b> <? echo $msg;?></b></h3></div>  			  
		
	</div>
</div>


<?php } ?>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

<script src="/bateria/js/jquery.geocomplete.min.js"></script>

<script>
	$(function(){
		$("#textLugarresidenciaactual").geocomplete({
			map: ".map_canvas",
			details: "form",
			types: ["geocode"],
		});
		
		$("#textLugardetrabajoactual").geocomplete({
			map: ".map_canvas",
			details: "form",
			types: ["geocode"],
		});
		
		
		$("#textLugarcedula").geocomplete({
			map: ".map_canvas",
			details: "form",
			types: ["geocode"],
		});
		
		$("#find").click(function(){
			$("#textLugarresidenciaactual").trigger("geocode");
		});
		
		
		jQuery( "#textProfesion" ).autocomplete({source: <?=json_encode($profesiones)?>});
		
 		jQuery( "#selectArea" ).autocomplete({source: <?=json_encode($ares[0])?> });
 		jQuery( "#textUnidadentre" ).autocomplete({source: <?=json_encode($unis[0])?> });
		
		jQuery( "#selectAreaid" ).change(function(){
			var IDCOn=jQuery(this).val();
			if(IDCOn>0){
				var action="<?=$_SERVER["SCRIPT_NAME"]?>/admin/estructura/getCargos";
 				jQuery.getJSON(action,{idarea:IDCOn}).done(function(data){
						var html="<option value='-1'>Seleccione un cargo</option>";
						jQuery.each( data, function( key, val ) {
 							html+="<option value='"+val["id"]+"'>"+val["nombre"]+"</option>";
 						});
						jQuery("#selectCargoid").html(html);
				});	
			}else{
				jQuery("#selectCargoid").html("<option value='-1'>Seleccione un área o departamento</option>")
			
			} 
		});
		
		 jQuery( "#textUnidadentre" ).focusout(function(){
			var unis=<?=json_encode($unis[1])?>;
  			var indexa=0;
			var i=0;
			var test=true;
			while(test==true){
				var v=unis[i];
				var tam=unis.length
				if(v[1]==jQuery(this).val()){
 					indexa=v[0];
					test=false;
 				}
				else if(v[1]==undefined || i>=tam){
					test=false;
				}
				i++;
			}
 			if(indexa>0){
				jQuery( "#textUnidadidentre" ).val(indexa);
			}
 		});		
		
		
		
		
 	});
	</script>											