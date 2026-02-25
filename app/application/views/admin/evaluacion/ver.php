<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<meta charset="utf-8"> 
<script type="text/javascript">
 function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
var acciones={
	editar:function(){
		jQuery("[rel^='proyecto_editar']").off();
		jQuery("[rel^='proyecto_editar']").on("click",function(){
			//setCookie("key", "", exdays)
			var keyid=jQuery(this).attr("id").split("_")[1];
			 

			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{keyid:keyid,mode:"ver"},
				success:function(res){
					if(res[0]=="ok"){
						setCookie("key",res[1]["keyid"], 0.2);
						setCookie("nombre",res[1]["nombre"], 0.2);
						setCookie("bienvenida",res[1]["bienvenida"], 0.2);
						setCookie("tipoproyecto",res[1]["tipoproyecto"], 0.2);
						setCookie("email",res[1]["email"], 0.2);
						document.location=document.location.origin+""+document.location.pathname+"?mode=nuevo&editar=1";
					}else{
						jQuery.colorbox({html:"<center><h2>No tiene permiso para este proyecto</h2></center>",width:"500px","height":"300px"});

					}
				}
			}).responseJSON;



			
		});
		jQuery("[rel^='idp_']").off();
		jQuery("[rel^='idp_']").on("click",function(){
			//setCookie("key", "", exdays)
			var tipo=jQuery(this).attr("rel").split("_")[1];
			 

			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{mode:"filtrar",tipo:tipo},
				success:function(res){
					if(res[0]=="ok"){
						
						var html='';
						jQuery.each(res[1],function(k,d){
							var nombre=d["nombre"].substring(1, 25);    
						
							html+='<li class="list-group-item">';
								html+='<div style="width:80%;float:left">';
								html+='	<div  style="clear:both;width:100%"><strong  >  '+nombre+'... </strong> </div>';
									html+='<div  style="width:100%"><b>'+d["fechacreacion"]+'</b> </div>';
									html+='<div style="clear:both" ></div>';
								html+='</div>';

								html+='<div style="width:18%;float:left">';
									html+='<a href="javascript:;" id="editarproyecto_'+d["keyid"]+'" title="<?=$idioma->{"editar"}?>" rel="proyecto_editar">';
									html+='<i class="fa fa-pencil-square-o fa-2x"></i>';
									html+='</a> ';
									html+='<a href="javascript:;" id="eliminar_'+d["keyid"]+'" title="<?=$idioma->{"eliminar"}?>" rel="proyecto_eliminar">';
									html+='<i class="fa fa-trash fa-2x"></i></a>  ';
									html+='<div style="clear:both" ></div>';
								html+='</div> ';
								html+='<div style="clear:both" ></div>';

 
						html+='</li>';
						});
						
						jQuery("#r_avance").html(html);
 						jQuery("#r_avancedetalle").append(htmltR); 
						acciones.editar(); 
					} 
					
					
					
				}
			}).responseJSON;
			

		});
					jQuery("[rel='nuevo']").click(function(){console.log(12345678)
				document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo";
			})
			

	},
	eliminar:function(){
		jQuery("[rel='proyecto_eliminar']").off();
		jQuery("[rel='proyecto_eliminar']").on("click",function(){
		var keyidproyecto=jQuery(this).attr("id").split("_")[1];
		var object=jQuery(this);
		var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{mode:'eliminarproyecto',keyid:keyidproyecto},
					success:function(res){
						if(res[0]=="ok"){
							object.parent().parent().remove();
							jQuery.colorbox({html:"El proyecto a pasado a estado inactivo"});
						}
					}}
					);
		});
		
		
		
		
	},
	avance:function(){
		
		
		
		jQuery("[rel^='avance_']").off();
		jQuery("[rel^='avance_']").on("click",function(){
		var keyidproyecto=jQuery(this).attr("rel").split("_")[1];
		var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{get:'evaluaciones_del_participante',key:keyidproyecto,mode:'get'},
					success:function(res){
 								 
						var htmlt=' <div class="list-group list-group-item"  >';
								htmlt+=' <div class="col-lg-10"><strong>Descargar Red</strong></div>';
								htmlt+=' <div class="col-lg-2"><a href="javascript:;" title="<?=$idioma->{"descargar"}?>" rel="evaluaciones_del_participante_descargar_red"><i class="fa fa-tasks fa-fw"></i></a></div>';
								htmlt+=' <div style="clear:both"></div>';
								htmlt+=' </div><div style="clear:both"></div><br>';
						var htmltR='';
							htmltR+=' <div class="list-group list-group-item"  >';
								htmltR+=' <div class="col-lg-6"><strong>Participantes</strong></div>';
								htmltR+=' <div class="col-lg-5"><strong>Evaluaciones Terminadas</strong></div>';
								htmltR+=' <div class="col-lg-1"><a href="javascript:;" title="<?=$idioma->{"descargar"}?>"  rel="evaluaciones_del_participante_descargar"><i class="fa fa-tasks fa-fw"></i></a></div>';
								htmltR+=' <div style="clear:both"></div>';
							htmltR+=' </div>';								
		
						
						var evaluados=res[2];
						jQuery.each(evaluados,function(k,d){
							var retro=d["retroalimentacion"];
							var color="#FFF";
							htmlt+=' <li class="list-group-item" style="background-color:'+color+'" >';
							htmlt+='<strong id="nombre_'+k+'">   '+d[0]["evaluado"][1];
							htmlt+='</strong> <span class="pull-right text-muted small">';
							htmlt+='<a href="javascript:;" id="evaluado_'+k+'" title="<?=$idioma->{"descargar"}?>" rel="revaluado_descargar"><i class="fa fa-tasks fa-2x"></i></a>'; 
							htmlt+='   <a href="javascript:;" id="evaluado_'+k+'" title="<?=$idioma->{"editar"}?>" rel="revaluado_ver"><i class="fa fa-search-plus fa-2x"></i></a>'; 
							htmlt+='  </span><div style="clear:both"></div><div class="col-lg-12  " id="desplegar_'+k+'" style="display:none">';
							jQuery.each(d,function(kk,dd){
								var estado='<div style="color:red"><b>Sin resolver</b></div>';
								if(parseInt(dd["estado"][0])==1){
									estado='<div style="color:green"><b>Resuelto '+dd["estado"][1]+'</b></div>';
								}
								
								htmlt+=' <div style="background-color:'+color+'" class="col-lg-12 list-group-item" >'+dd["evaluador"][1]+' <b>'+dd["relacion"]+' </b> '+estado+'</div>';
							})
							htmlt+='<div style="clear:both"></div></div><div style="clear:both"></div> </li>'; 
							
							
							
						});
						
						var participantes=res[1];
						jQuery.each(participantes,function(k,d){
							/*
							#FE2E2E rojo
							#F0FFF0 verde
							#FFEFD5 naranja
							*/
							//var color='#FE2E2E'; 
							/*if(d["terminado"]==0){
								color='#F5A9A9';
							}*/
							/*
							if(d["iniciado"]>0){
								color='#FFEFD5';
							}*/
							
							if(d["terminado"]>0 && (d["terminado"]==d["todos"])){
								var color='#F0FFF0';
								htmltR+=' <div class="list-group list-group-item"   id="nombre_'+d["keyid"]+'" style="background-color:'+color+'">';
								htmltR+=' <div class="col-lg-7"><strong>'+d["nombre"]+' '+d["apellido"]+'</strong></div>';
								htmltR+=' <div class="col-lg-5"><strong>'+d["terminado"]+' de '+d["todos"]+'</strong></div>';
								//htmltR+=' <div class="col-lg-2"><a href="javascript:;" rel="descargar_informe" id="'+d["keyid"]+'"><i class="fa fa-tasks fa-fw"></i></a> </div>';
								htmltR+=' <div style="clear:both"></div>';
								htmltR+=' </div>';
							}
						});
						
						jQuery.each(participantes,function(k,d){
							/*
							#FE2E2E rojo
							#F0FFF0 verde
							#FFEFD5 naranja
							*/
							var color='#F5A9A9'; 
							/*if(d["terminado"]==0){
								color='#F5A9A9';
							}*/
							/*
							if(d["iniciado"]>0){
								color='#FFEFD5';
							}*/
							
							if(d["terminado"]==0 || (d["terminado"]!=d["todos"])){
								htmltR+=' <div class="list-group list-group-item"   id="nombre_'+d["keyid"]+'" style="background-color:'+color+'">';
								htmltR+=' <div class="col-lg-7"><strong>'+d["apellido"]+' '+d["nombre"]+'</strong></div>';
								htmltR+=' <div class="col-lg-5"><strong>'+d["terminado"]+' de '+d["todos"]+'</strong></div>';
								//htmltR+=' <div class="col-lg-2"></div>';
								htmltR+=' <div style="clear:both"></div>';
								htmltR+=' </div>';
							}
						});
						
						//console.log(2345678);
						
						jQuery("#r_avance").html("");
 						jQuery("#r_avancedetalle").html(""); 
						jQuery("#r_avance").html(htmlt);
 						jQuery("#r_avancedetalle").html(htmltR); 

						acciones.desplegar(keyidproyecto);
					
					}
		});
		});
	
 	},
	desplegar:function(keyidproyecto){
		jQuery("[rel^='revaluado_ver']").off();
		jQuery("[rel^='revaluado_ver']").on("click",function(){
			var obs=jQuery("#view_data").find("[id^='desplegar_']");
			jQuery.each(obs,function(k,d){
				jQuery(d).hide();
			});
 			var id=jQuery(this).attr("id").split("_")[1];
			jQuery("#desplegar_"+id).fadeIn("slow");
 			
		});	
		
		jQuery("[rel^='revaluado_descargar']").off();
		jQuery("[rel^='revaluado_descargar']").on("click",function(){
			var id=jQuery(this).attr("id").split("_")[1];
			jQuery(".informered").append('<input type="hidden" name="mode" value="informedered" />');
			jQuery(".informered").append('<input type="hidden" name="key" value="'+keyidproyecto+'" />');
			jQuery(".informered").append('<input type="hidden" name="keyid" value="'+id+'" />');
			jQuery(".informered").submit();
			jQuery(".informered").find("[name='keyid']").remove();
			
		});	
		
		jQuery("[rel='evaluaciones_del_participante_descargar']").off();
		jQuery("[rel='evaluaciones_del_participante_descargar']").on("click",function(){
 			jQuery(".informe").append('<input type="hidden" name="mode" value="informedeavance" />');
			jQuery(".informe").append('<input type="hidden" name="key" value="'+keyidproyecto+'" />');
			jQuery(".informe").submit();
			
		});		
		
		jQuery("[rel='evaluaciones_del_participante_descargar_red']").off();
		jQuery("[rel='evaluaciones_del_participante_descargar_red']").on("click",function(){
 			jQuery(".informered").append('<input type="hidden" name="mode" value="informedered" />');
			jQuery(".informered").append('<input type="hidden" name="key" value="'+keyidproyecto+'" />');
			jQuery(".informered").submit();
			
		});			
		
	}
	
}
jQuery(function(){
	acciones.editar();
	acciones.avance();
	acciones.eliminar();
	<?
		if($mensaje!=""){
	?>//console.log("HOlaaaaaaaaaa");
	jQuery.colorbox({html:"<center><h2><?=$mensaje?></h2></center>",width:"500px","height":"300px"});
		<? } ?>
});
</script>
 <?php echo CHtml::form(array("admin/evaluacion/proyecto#reportes"), 'post', array('class'=>'descargarreporte', 'id'=>'descargarreporte','target'=>'descargar','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#evaluaciones_del_participante"), 'post', array('class'=>'informe', 'id'=>'informe','target'=>'descargar','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#evaluaciones_del_participante"), 'post', array('class'=>'informered', 'id'=>'informered','target'=>'descargar','style'=>'display: none')); ?>

</form>
 <div id="contenedor360"   >
  
         <!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
                <a class="navbar-brand" href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=ver" style="padding:0px">
				<img src="<?=Yii::app()->baseUrl?>/images/360evolution.png" style="width: 193px;" /></a>				
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
		<li> <b>&#161HOLA <?= strtoupper($usuariomodel->nombres) ?>&#33</b> Tienes <?=$creditosdisponibles ?> cr&#233ditos</li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo">
                                <div> 
                                    <strong><?=$idioma->{"nuevo_proyecto"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=ver">
                                <div>
                                    <strong><?=$idioma->{"mis_proyectos"}?></strong>
                                 </div>
                             </a>
                        </li>
                          
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                                <?php if($usuariomodel->perfil==1 or $usuariomodel->perfil==2){ ?> 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cogs fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/crear">
                                 <div> 
                                    <strong>Crear Cuenta</strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
			<li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/gestionar">
                                 <div>
                                    <strong>Gestionar Cuentas</strong>
                                 </div>
                             </a>
                        </li>
			<li class="divider"></li>
			<li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/historial">
                                 <div>
                                    <strong>Historial de Ventas</strong>
                                 </div>
                             </a>
                        </li>
			<!--<li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/paises">
                                 <div>
                                    <strong><?=$idioma->{"paises"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/regiones">
                                 <div>
                                    <strong><?=$idioma->{"regiones"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
                         <li> 
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/empresas">
                                 <div>
                                    <strong><?=$idioma->{"empresas"}?></strong>
                                 </div>
                             </a>
                        </li>-->
                          
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <?php } ?>
                
				
				<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
			<li style ="margin-left: 12%"><i class="fa fa-user fa-fw" style="color:#000000"></i> <form action="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/crear" method="POST" style="margin-top: -17%;margin-left: 6%;"><input type="hidden" name="idusuario" value="<?=$usuariomodel->id?>"><input type="submit" value="<?=$idioma->{"perfil_de_usuario"}?>" style="color:#000000" class="btn btn-link"></form></li>
                         <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> <?=$idioma->{"configuracion"}?></a>
                        </li>-->
			<li class="divider"></li>
			<li><a href="#">Créditos <i class="fa  fa-dollar fa-fw"></i> <?=$creditosdisponibles?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/sa/logout"><i class="fa fa-sign-out fa-fw"></i> <?=$idioma->{"salir"}?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
 			<?//$menulat ?>
         </nav> 	
 		
		

        <div id="page-wrapper">
            <div class="row" id="linea">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row" id="botones">
				<div class="col-lg-2"  id="tablero">
			
					<div class="col-lg-12 col-md-3">
						<div class="panel panel-primary">
							<div class="panel-heading" style="background-color:#FFF;color:#333">
								<div class="row">
									<div class="col-xs-3"  >
										<div class="huge"  > <i class="fa fa-newspaper-o fa-fw"></i></div>
 									</div>
									<div class="col-xs-9 text-right">
										
										<div class="huge" ><?=$idioma->{"tablero"}?></div> 
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					
				</div>	
				<div class="col-lg-10">	
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<!--div class="huge"><?=$tproyectos?></div-->
										<div class="huge"  > <i class="fa fa-tasks fa-fw"></i></div>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?=$idioma->{"proyectos"}?></div>
										 
									</div>
								</div>
							</div>
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=ver">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					
					
					
					
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									 
									<div class="col-xs-3">
										<div class="huge"> <i class="fa fa-folder-o fa-fw"></i></div>
 									</div>
									 
									<div class="col-xs-9">
 										<div class="huge"><?=$idioma->{"biblioteca_de_encuestas"}?></div>
									</div>
								</div>
							</div>
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=catalogo">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<div class="huge"> <i class="fa fa-pencil-square fa-fw"></i></div>
 									</div>
									<div class="col-xs-9 text-left">
										<div class="huge"><?=$idioma->{"lista_maestra"}?></div>
										 
									</div>
								</div>
							</div> 
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=archivos">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<div class="huge"> <i class="fa fa-crosshairs fa-fw"></i></div>
 									</div>
									<div class="col-xs-9 text-left">
										<div class="huge"><?=$idioma->{"guia360"}?></div>
 									</div>
								</div>
							</div>
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=guia360">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>
            </div>
            <!-- /.row -->
            <div class="row" style="padding-left:13px;padding-right:13px">
				<div  class="col-lg-12" id="contenedorbr">
					<div class="col-lg-6" style="height:100%"> 
						<div class="panel panel-default" style="height:97%">
							<div class="panel-heading">
 									<i class="fa fa-bar-chart-o fa-fw"></i> <?=$idioma->{"misproyectos"}?>   <input type="button" value="  <?=$idioma->{"nuevo_proyecto"}?>" rel="nuevo" />
									<div class="pull-right">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
												<?=$idioma->tiposproyecto?>
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu pull-right" role="menu">
											   <li><a href="javascript:;" rel="idp_0"><?=$idioma->todoslosproyectos?></a>
												</li>

											<? foreach($tipos as $tproyectos){ ?>
												<li><a href="javascript:;" rel="idp_<?=$tproyectos->id?>"><?=$tproyectos->nombre?></a>
												</li>
												 
											<? } ?>
											</ul>
										</div> 
 								</div>
								
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body" style="height:92%">
								 
								<div class="list-group" id="view_data" style="display: block;height:97% ;overflow-y:scroll"> 
								<? foreach($proyectos as $k=>$datospro) {
									$nombre=$datospro->nombre;
									if(strlen ($datospro->nombre)>=25){
									$nombre=substr($datospro->nombre,1,25)."...";
									}
								?> 
	 
									<li class="list-group-item"  >
										<div style="width:80%;float:left">
											<div  style="clear:both;width:100%"><strong id="nombre_69KS8">   <?=$nombre?> </strong> </div>
											<div  style="width:100%"><b><?=$datospro->fechacreacion?></b> </div>
											<div style="clear:both" ></div>
										</div>
										
										<div style="width:18%;float:left">
											<a href="javascript:;" id="avance_<?=$datospro->keyid?>" title="Avance" rel="avance_<?=$datospro->keyid?>"><i class="fa fa-search-plus fa-2x"></i></a>
											<a href="javascript:;" id="editarproyecto_<?=$datospro->keyid?>" title="<?=$idioma->{"editar"}?>" rel="proyecto_editar">
											<i class="fa fa-pencil-square-o fa-2x"></i>
											</a> 
											<a href="javascript:;" id="eliminar_<?=$datospro->keyid?>" title="<?=$idioma->{"eliminar"}?>" rel="proyecto_eliminar">
											<i class="fa fa-trash fa-2x"></i></a>  
											<div style="clear:both" ></div>
										</div> 
										<div style="clear:both" ></div>
									</li>
								<? } ?> 
								 
								</div>
								 
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					 </div>
					
					
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-bar-chart-o fa-fw"></i> <?=$idioma->{"avance"}?>
								<div class="pull-right">
 
								</div>
							</div>
							<!-- /.panel-heading -->
							<div style="height:300px;overflow-y:scroll;" class="panel-body" >
 							<div id="r_avance"></div>
							<div  id="r_avancedetalle">
 							</div>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					 </div>
					
				</div>	
				
				
				
				
            </div>
            <!-- /.row -->
        </div>
        </div>
        <!-- /#page-wrapper -->
		
	 <style>
   #formulario .note-editing-area p{
	   text-align:initial;
	   padding-bottom:0px;
   }
   
   #colorbox p{
	   text-align:initial;
	   padding-bottom:0px;
   }
   
   
   #formulario .note-editing-area{
	   border:1px solid #ddd;
   }
    
   #menu360 li{
	   border:0.04em solid;
	   border-color:#ddd;
	   border-top-left-radius:3px;
	   border-top-right-radius:3px;  
   }
   #contenedorbr{
 	   border:0.04em solid;
	   border-color:#ddd;
	   border-top-left-radius:6px;
	   border-top-right-radius:6px; 
	   padding-top:10px;	   
   }
   #page-wrapper{
	   margin:0px;
   }
      .page-header{
	   margin:10px 0 20px;
   }
   </style>
	
<script>
jQuery(function(){
	var h1=jQuery("[role='navigation']").height();
	var h2=jQuery("#botones").height();
	var h3=jQuery("#linea").height();
	var ht=h1+h2+h3+50;
	
	var hcontenedor=jQuery('body').height()-ht;
	jQuery("#contenedorbr").attr({"style":'height:'+hcontenedor+'px !important'});
	jQuery("#page-wrapper").height((h2+hcontenedor)-100);
	jQuery(".push").remove()
	setTimeout(function(){
	var hw=jQuery("#wrapper").height();
	jQuery("#wrapper").height((hw-20));
	
	},200);	
 });
</script>	
		
