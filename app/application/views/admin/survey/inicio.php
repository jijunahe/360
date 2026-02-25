<? $root=explode("/",$_SERVER["SCRIPT_NAME"]);$root="/".$root[1]."/"; ?>
 <link rel="stylesheet" href="<?=$root?>scripts/admin/colorbox/example1/colorbox.css" />
 <script src="<?=$root?>scripts/admin/colorbox/jquery.colorbox.js"></script>
<style type="text/css"> 
body{
	overflow-x:hidden
}
#content-box{
	width:940px;
}
#tableContent{
    border:1px solid #CCCCCC;
    border-collapse:collapse;
	font-size:11px;
}
#tableContent th {
    border:1px solid #CCCCCC;
    font-size:11px;
}

#tableContent td {
    border:1px solid #CCCCCC;
    font-size:11px;
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
</style> 
  <div id="content">
<div class="divContentBlue">
 <div style="width:100%">
		<div style="float: left">
			<h2><b>Bienvenid<? if($usuario->genero=="Masculino"){echo "o";}else{echo "a";}?> <?=$usuario->nombres?></b></h2>	
		</div>
		<div style="float: right">
			<a href="<?=$root?>index.php/admin/authentication/sa/logout" >
				<img src="<?=$root?>styles/darkblue/images/logout.png">
			</a>
		</div>
		<div style="float: right;    margin-right: 11px;   margin-top: 1px;">
			<img src="<?=$root?>img/ayuda.png" width="30" style="cursor:pointer" rel="ayuda" />	
		</div>
 </div>
 <div style="clear:both"></div>
		<div class="divContentWhite">
		
<div class="divContentBlue"><div class="divContentWhite">
	<h3><center>Introducción</center></h3>
Estamos comprometidos con su recurso humano, continuamos generando estrategias y actividades de mejoramiento continuo destinadas a promover la mejor condición de salud y prevenir enfermedades en sus trabajadores. En el cumplimiento de este compromiso se hace necesario conocer las distintas condiciones que podrían estar afectando la salud de nuestros trabajadores.
<br><br>A continuación encontrará unos cuestionarios diseñados especialmente para evaluar los riesgos psicosociales, los cuales invitamos a diligenciar con información verídica de su condición personal. Dicha información será manejada con cuidadosa confidencialidad.
<br><br>La aceptación y diligenciamiento del cuestionario bajo el concepto de "consentimiento informado", es fundamental para realizar este procedimiento.
<br><br>Los resultados obtenidos serán sometidos a un cuidadoso análisis que nos permitirá conocer la relación del trabajador con el medio laboral y tomar medidas para mejorarlas.
</div>		
</div>	
<br>
<div class="divContentBlue">
	<div class="divContentWhite">
	<h3><center>Instrucciones</center></h3>
<br>La información que usted nos suministra es muy importante para la evaluación de riesgos psicosociales para la empresa. 
<br>Inicialmente encontrará un formato de consentimiento informado, el cual es la aprobación de su participación en el diligenciamiento de los cuestionarios contenidos en este cuadernillo. 
<br>La información que usted nos brinda nos ayuda a mantener y/o mejorar las condiciones de seguridad en el ambiente laboral.	
	
	</div>		
</div>		
		<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent" style="display:block">
			<tbody>
			<tr>
				<td width="30%"><center><b><h4>Cuestionario</h4></b></center></td>
				<td width="15%"><center><b><h4>Fecha Inicio</h4></b></center></td>
				<td width="15%"><center><b><h4>Fecha Fin</h4></b></center></td>
				<td width="15%"><center><b><h4>Descripción</h4></b></center></td>
				<td width="15%"><b></b></td>
 			</tr>
					
 		<? 
		
		$i=0;
 		foreach($datos as $dato){
		$background='';
			if($i%2==0){$background='style="border: 1px solid #CCCCCC;background-color: #F2F2F2;"';}
		?>
			<tr <?=$background?>>
				<td width="40"><? echo $dato->titulo;?></td>
				<td><? echo $dato->fechaini;?></td>
				<td><? echo $dato->fechafin;?></td>
				<td><? echo $dato->descripcion;?></td>
				<td><center><b>
					<? if($dato->estado==0){ ?>
					<a href="javascript:;" rel="ir_<? echo $dato->sid;?>_<? echo $dato->idProgramacion;?>_<? echo $dato->id_area;?>_<? echo $dato->idUsuario;?>" title="<?=$dato->titulo?>"><img src="<?=$root?>img/Icono_encuesta.png" style="width: 60px;" /></a>
					<? }else{ echo "<div style='color:green'>Resuelto ".$dato->fechaactualizacion."</div>";} ?>
					</b>
					</center>
				</td>
 			</tr>
  		<? 
		$i++;	
		} ?>
			</tbody>
		</table>
		</div>
 	<div class="divContentWhite">
	<A NAME="cin"></A>
		<center><b><h3>CONSENTIMIENTO INFORMADO</h3></b></center>
		<br>
 <?php echo CHtml::form(array("admin/survey/sa/index"), 'post', array('class'=>'formPass', 'id'=>'formPass')); ?>
 <?php $fechahoy=date("Y-m-d");    ?>
		<input type="hidden" id="op" name="op" value="add" />
		<input type="hidden" id="idus" name="idus" value="<?=$usuario->id?>" />
		<input type="hidden" id="idcargo" name="idcargo" value="<?=$usuario->id_cargo?>" />
		<input type="hidden" id="idunidad" name="idunidad" value="<?=$usuario->id_unidad?>" />
		<input type="hidden" id="fecha" name="fecha" value="<?=$fechahoy?>" />
 			<center>
			<table width="80%">
				<?php    if($estadodatos==false){ ?>
				<tr><td><div style="display:block" class="ventanaBodyError"><center><h4>Sus datos no est&aacute;n completos, por favor haga click <a href="javascript:;" rel="editar_<?=$usuario->id?>"><b>aqu&iacute;</b></a> para actualizar sus datos</h4></center></div>
				</td><tr>
				<?php } ?>

				<tr>
				<?php
					
					$nomempresa="";
					$uni1 = new CDbCriteria;
					$uni1->condition = 'id='.$usuario->id_unidad;
					$unidades1 = EvalUnidades::model()->find($uni1);					
 					if(isset($unidades1->nombre)){
						$nomempresa=$unidades1->nombre;
 					}
				?>
					<td style="    font-size: 22px;    padding: 15px;">
						<p style=" font-size: 22px;     text-align: justify;">Yo <b><?=$usuario->nombres?></b>, identificad<? if($usuario->genero=="Masculino"){echo "o";}else{echo "a";}?> con C.C No <b><?=$usuario->documento?></b> de  <b><?=$usuario->lugarcedula?></b>, declaro que conozco los objetivos para los cuales se aplicará los cuestionarios y entrevistas, por lo cual autorizo que la informaci&oacute;n que suministro puede ser utilizada como insumo para gestionar el Programa/Sistema de Vigilancia del Factor de Riesgo Psicosocial, que desarrolla la Empresa <b><? if($nomempresa!=""){ 
							$empresa=$nomempresa;
 							?> 
							<input type="text" name="empresa" value="<? echo $empresa;?>" disabled="disabled" style="height:30px"/>
 							<?}else{?>
							<input type="text" name="empresa" style="height:30px" />
							<?}?></b></p> 
						<br>
						<p style=" font-size: 22px;     text-align: justify;">
							 Tiene personal a cargo? <b>Si <input type="radio" name="tipo" id="it_A" value="A"/></b> <b>No <input type="radio" name="tipo" id="it_B" value="B"/></b>
						</p>
						<p style=" font-size: 22px;     text-align: justify;">
							Cargo: <b><? 
										$cargo="";
										if($usuario->id_cargo>0){	
											$cargost=EvalCargos::model()->selecCargo($usuario->id_cargo);
											if(isset($cargost[0]->nombre)){$cargo=$cargost[0]->nombre;}
										}
								echo $cargo;
								
								
								?></b>
						</p>
						<p style=" font-size: 22px;     text-align: justify;">
							Fecha: <b><?=$fechahoy?></b>
						</p>
						<p>
							<?php
							$uni = new CDbCriteria;
							$uni->condition = 'activa=1';
							$unidades = EvalUnidades::model()->findAll($uni);
							
 							$arunidades=array();
 							$arunc=array();
 							foreach($unidades as $values){
								array_push($arunidades,$values->nombre);
								array_push($arunc,array($values->nombre,$values->id));
  							}
							
							if($estadodatos==true){
								$usmod = new CDbCriteria;
								$usmod->condition = 'idusval='.$usuario->id;
								$acepta = Aceptacion::model()->find($usmod);
 								if(!isset($acepta->id)){
								?>
								<script>
									jQuery(function(){
										var empresa = localStorage.getItem('empresa');
										var tipo = localStorage.getItem('tipoe');
										if(jQuery("#it_"+tipo).size()==1){
											jQuery("#it_"+tipo).attr("checked","checked");
										}
										if(empresa!="undefined" && empresa!=undefined){
										jQuery("[name='empresa']").val(empresa);
										}
  									});
								</script>
 									<input type="button" value="ACEPTAR"  id="aceptar" >
 								<? }else{ ?>
								<script>
									jQuery(function(){
										var dlocation=document.location.search;
										var rl=dlocation.split("nl=");
										if(rl[1]==undefined){
											jQuery.colorbox({html:"<center><div id='ciframe'><h4>Cargando Cuestionarios, un momento por favor</h4><br><br><div id='redir' style='font-size: 100px;'></div><br><br><br><br><br></div></center>"});
											autolink();
										}
   									});
								</script>							
								<? } ?>
							<?php }?>
								<script>
									jQuery(function(){
 										jQuery( "[name='empresa']" ).autocomplete({source: <?=json_encode($arunidades)?>});
 									});
								</script>								
 						</p>
					</td>
				</tr>
			</table>
			</center>
   </form>		

	</div>

 </div>	
</div>
<div id="leftime" style="display:none"></div>
	
	<?php if($estadodatos==false){ ?>
	<?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formEditar2', 'id'=>'formEditar2')); ?>
			<input type="hidden"   name='option' value='10' />
			<input type="hidden"   name='empresasend' value='' />
			<input type="hidden"   name='id_unidad' value='<?=$usuario->id_unidad?>' />
 			<input type="hidden"   name='textId'   id='textId' value='' />
	</form>
	<script>
	jQuery(function(){
		jQuery("[rel^='editar_']").click(function(){ 
			var id=jQuery(this).attr("rel").split("_");
			jQuery("#textId").val(id[1]);
			
			var empresa=jQuery("[name='empresa']").val(); 
			if(empresa.trim(" ")!=""){	
				localStorage.setItem('empresa', empresa);
				localStorage.setItem('tipoe', jQuery("[name='tipo']:checked").val());
				jQuery("[name='empresasend']").val(empresa);
				var arunc=<?=json_encode($arunc)?>;
				var tamanio=arunc.length;
				var valida=false;
				var id_unidad=0;
				
 				if(tamanio>0){	
					var i=0;
					while(valida==false){
						var test=arunc[i];
						if(test[0]==empresa){
							valida=true;
							id_unidad=test[1];
						}
 						i++;
						if(i>=tamanio){
							valida=true;
 						}
 					} 
 					if(id_unidad==0){
						alert("La empresa ingresada no es válida");
						return false;
					}else if(id_unidad>0){
 						jQuery("[name='id_unidad']").val(id_unidad);
						jQuery("#formEditar2").submit();
					}
				}else{
					alert("Lo sentimos, no hay empresas para seleccionar. Por favor consulte al administrador de sistema");
				}
			}	else{
 				alert("Por favor, escriba el nombre de la empresa a la que pertenece.");
				jQuery("[name='empresa']").focus();
			}
 		});
	});
	</script>
	<?php } ?>	

  <?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array($rutasurvey), 'post',array("target"=>"_blank")));?>
<script>
function cerrar(){
	
	jQuery("[rel='cerrarm']").click(function(){jQuery.colorbox.close();});
	
}
 jQuery(function(){
	<?php if(isset($acepta->id)){ ?>
	var dlocation=document.location.search;
	var rl=dlocation.split("nl=");
	if(rl[1]!=undefined){console.log(rl[1]);
		setTimeout(function(){jQuery("[rel='"+rl[1]+"']").click();},300)
  	}
	<?php } ?>
	jQuery("#aceptar").click(function(){
	//formPass
		var empresa= jQuery("[name='empresa']").val();
		
		if(!jQuery("[name='tipo']").is(":checked") || empresa.trim("")==""){
			if(!jQuery("[name='tipo']").is(":checked") &&  empresa.trim("")!=""){
				jQuery.colorbox({html:'<div style="float:right"><img rel="cerrarm" src="<?=$root?>img/cerrar.svg" style="    width: 41px;cursor:pointer" /></div><div style="clear:both"></div><h4>Por favor dinos si tienes o no personal a cargo</h4>',"width":"30%","height":"200px"});
			}
			if(!jQuery("[name='tipo']").is(":checked") &&  empresa.trim("")==""){
				jQuery.colorbox({html:'<div style="float:right"><img rel="cerrarm" src="<?=$root?>img/cerrar.svg" style="    width: 41px;cursor:pointer" /></div><div style="clear:both"></div><h4>Por favor dinos si tienes o no personal a cargo y escriba el nombre de la empresa a la que pertenece</h4>',"width":"30%","height":"200px"});
			}
			if(jQuery("[name='tipo']").is(":checked") &&  empresa.trim("")==""){
				jQuery.colorbox({html:'<div style="float:right"><img rel="cerrarm" src="<?=$root?>img/cerrar.svg" style="    width: 41px;cursor:pointer" /></div><div style="clear:both"></div><h4>Por escriba el nombre de la empresa a la que pertenece</h4>',"width":"30%","height":"200px"});
			}
		}else{
			jQuery("#formPass").submit();
 		}
		cerrar();
	});
	
 
 	jQuery("[rel*='ir_']").click(function(){
		var id=jQuery(this).attr("rel").split("_");
		window["rel"]=jQuery(this).attr("rel");
		<? 
		$c='#000';
			if($w>=33.3){
				 
				$c='#fff';
			}
			if($w>=99){
				$w=100;
 			}
			$t=$w;

		?>
		var w=<?=$w?>;
		var url="<?=$root?>index.php/"+id[1]+"/lang-es?programacion="+id[2]+"&area="+id[3]+"&idus="+id[4]+"&sid="+id[1];
		var htmlr='<div style="clear:both"></div><div style="width:100%;height:100%;overflow:hidden"><div style="width:100%;"><br><div style="float:left;width:100%;"><div style="float:left"><h4 >'+jQuery(this).attr("title")+'. <b>Tiene <span id="quedan" style="color:red"><?=$leftime?></span> minutos para resolver la encuesta</b><div style="clear:both"></div></h4></div><img src="<?=$root?>img/ayuda.png" width="30" style="cursor:pointer;float:right" rel="ayuda" /><div style="clear:both"></div></div>';
 		    htmlr+='<div style="clear:both"></div>';
		    htmlr+='<center><div style="width:25%;height:25px;border-radius:6px;border:1px solid "><div style="width:'+w+'%;height:25px;background-color:rgb(109, 92, 157);font-size:24px;color:<?=$c?>;border-radius:6px;float:left" id="porcentaje"><b><?=$t?>%</b><div style="clear:both"></div></div><div style="clear:both"></div></div></center>';
		    htmlr+='<div style="clear:both"></div></div>';
			htmlr+='<div id="ciframe"  ><iframe id="iframe" src="'+url+'" style="width:100% !important;height:100% !important"></iframe></div></div>';
		jQuery.colorbox({html:htmlr,width:"98%",height:"98%",scrolling:false});
		
		window["intervalo"]=setInterval(function()	{  
 														jQuery("#ciframe").attr({"style":"width:100%;height:90%;"});
														if(jQuery("#iframe").contents().find("#completed").size()>=1){
															clearInterval(window["intervalo"]);
															autolink();
 														}
													},500);
													
		<? if($tiempo>0){ ?>											
		var tiempoFuera=setInterval(function(){
			jQuery.get("<?=$root?>time.php",function(data){
				var milisec=data;										
				var mil_ini=<?=$tiempo?>;
				var mil=(milisec-mil_ini);
				var minutos=((milisec-mil_ini)/60);
				//console.log(minutos.toString().split(".")[0]);
				jQuery("#leftime").html(minutos.toString().split(".")[0]);
				var tiempo=90-jQuery("#leftime").text(); 
				jQuery("#quedan").text(tiempo);
				if(minutos>=90){
					clearInterval(tiempoFuera);
					jQuery.colorbox( {html:"<h4>El tiempo ha terminado, su sesión se cerrara automáticamente. Gracias</h4>"});
					setTimeout(function(){
						document.location="<?=$root?>index.php/admin/authentication/sa/logout";
						
						},5000);
				}
			});
		},1000);
		<? }else if($leftime<=0){?>
			jQuery.colorbox( {html:"<h4>El tiempo ha terminado, su sesión se cerrara automáticamente. Gracias</h4>"});
			setTimeout(function(){
			document.location="<?=$root?>index.php/admin/authentication/sa/logout";

			},5000);		
		<?} ?>
 		
		jQuery("#cboxClose").remove();
		jQuery("#cboxClose,#cboxOverlay,[rel='cerrar']").click(function(){document.location="<?=$root?>index.php/admin/survey/sa/index";});
 	});
	jQuery("[rel='ayuda']").click(function(){
		var url="http://www.estrategiasensalud.com.co/soporte";
		 window.open(url,"Ayuda","width=700,height=500,menubar =0,resizable=0");
	});
	
});
function autolink(){
	
	var objs=jQuery("[rel^='ir_']");
	window["link"]="";
	window["titulo"]="";
	jQuery.each(objs,function(k,d){
		if(jQuery(d).attr("rel")!=window["rel"] && link==""){
			window["link"]=jQuery(d).attr("rel");
			window["titulo"]=jQuery(d).attr("title");
		}
	});
 	setTimeout(function(){
		if(window["titulo"]!=""){
			var htr='<div class="divGood"><h4><a href="<?=$root?>index.php/admin/survey/sa/index?nl='+window["link"]+'">Continuar con: '+window["titulo"]+' </a></h4></div>';
			jQuery("#ciframe").html(htr+'<br><br><center><div id="redir" style="font-size: 190px;"></div></center>');
			window["conta"]=5;
			var tim=setInterval(function(){
				
				if(window["conta"]>=0){
					jQuery("#redir").html(window["conta"]);
					window["conta"]--;
				}
				if(window["conta"]==0){
					clearInterval(tim);
					document.location="<?=$root?>index.php/admin/survey/sa/index?nl="+window["link"];
				}
				
			}, 1000);
		
		}/*else if(window["titulo"]==""){jQuery.colorbox.close();}*/
 		else{
			var htr='<div class="divGood"><h4>No hay más cuestionarios, gracias por su colaboración, sus datos han sido guardados exitosamente.<br> Esta sesión se cerrara automáticamente.</h4></div>';
			jQuery("#ciframe").html(htr+'<br><br><center><div id="redir" style="font-size: 190px;"><a href="<?=$root?>index.php/admin/authentication/sa/logout" data-hasqtip="true" aria-describedby="qtip-4"><img src="<?=$root?>styles/darkblue/images/logout.png"></a></div></center>');
 			window["conta"]=10;
			var tim=setInterval(function(){
				jQuery("#porcentaje").removeAttr("style");
				jQuery("#porcentaje").attr({"style":"width:100%;height:25px;background-color:rgb(109, 92, 157);font-size:24px;color:#fff;border-radius:6px;float:left"});
				jQuery("#porcentaje b").html("100%");
				if(window["conta"]>=0){
 					window["conta"]--;
				}
				if(window["conta"]==0){
					clearInterval(tim);
					document.location="<?=$root?>index.php/admin/authentication/sa/logout";
				}
 			}, 1000);		
 		}
	},1000);	
	
}
</script>