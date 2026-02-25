<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>  
  <style>
  .sortable { list-style-type: none; margin: 0; padding: 0; width: 99%; }
  .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; }
  .sortable li span { position: absolute; margin-left: -1.3em; }

.selected_r{ background-color:rgb(128,255,255);}
.selected_comp{ background-color:#000;}



   .messages{
        float: left;
        font-family: sans-serif;
        display: none;
    }
    .info{
        padding: 10px;
        border-radius: 10px;
        background: orange;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .before{
        padding: 10px;
        border-radius: 10px;
        background: blue;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .success{
        padding: 10px;
        border-radius: 10px;
        background: green;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .error{
        padding: 10px;
        border-radius: 10px;
        background: red;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
 
  </style>
  <script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>

<script type="text/javascript">
function confirmarEliminar(mostrar,usuario)
	{
		if (confirm("Se eliminarán todos los datos del usuario incluyendo evaluaciones y reportes ¿Desea confirmar?"))
		{	//document.Eliminar.submit()
                        location.href="admUsuariosLista.php?s="+mostrar+" &id="+usuario+"&uActivo=3";
                }  else
			alert("El usuario no se ha eliminado...")
	}
</script>
<script type="text/javascript">
var listado = <?=json_encode($empl)?>;
var obj = {
	enviar : function(){
		var i = 0;
		var ids = "-1";
		for(i=0;i<listado.length;i++){
			if(document.getElementById("check"+i).checked){
				ids += ","+listado[i].id_user;
			}
		}
		if(ids == "-1"){
			alert("Debe seleccionar al menos un usuario para enviarle la contraseña");
			return;
		}
		document.getElementById("ids").value = ids;
		document.getElementById("formPass").submit();
	}
}
function Activa(){
	jQuery("[rel^='inactiva_'],[rel^='activa_']").click(function(){
		<?php if($validaini=="OK"){ ?>
			var id=jQuery(this).attr("rel").split("_");
			var estado=1;
			var evento="inactiva";
			if(id[0]=="inactiva"){
				estado=0;
				evento="activa";
 			}
 			var url="<?=Yii::app()->baseUrl?>/admin/admusuario/";
			var pars = { id : id[1],option:3,activo:estado};
 			var res = jQuery.ajax({ 
			type: "POST",
			dataType: "html",
			async: false,
			url: url,
			data:pars 
			}).responseText;
			if(res=="OK"){
				if(estado==0){
 					jQuery(this).attr("src","<?=$imageurl?>bneg.png");
 					
				}else{
					jQuery(this).attr("src","<?=$imageurl?>bgre.png");
 				}
				jQuery(this).attr("rel",evento+"_"+id[1]);
				
 			}
		<?php } ?>	 	
 	});
	jQuery("[rel^='eliminar_']").click(function(){ 
		<?php if(AnaRol::model()->validarrol(2)==true){ ?> 
		if (confirm("Se eliminarán todos los datos del usuario incluyendo evaluaciones y reportes ¿Desea confirmar?"))
		{	//document.Eliminar.submit()
			
			
			var id=jQuery(this).attr("rel").split("_");
			 
			var url="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/";
			var pars = { id : id[1],eliminar:"eliminar"};
			var res = jQuery.ajax({ 
			type: "POST",
			dataType: "html",
			async: false,
			url: url,
			data:pars 
			}).responseText;
  			if(res=="OK"){
				  
				jQuery(this).parent().parent().remove();
				alert("El usuario se ha eliminado.")		
				 
				
			}else if(res=="NO"){
				alert("No tiene permiso para realizar esta accion.");
			}else if(res=="NO2"){ 
				alert("El usuario no ha sido eliminado. Este usuario ha diligenciado encuestas, detal manera que solo se le ha bloquedo el acceso.");
			}			
 		}
		<?php }?>
			 
 	
	});
	jQuery("[name^='editar_']").click(function(){
		var id=jQuery(this).attr("name").split("_");
		console.log(id);
  		jQuery("#formEditarus").append("<input type='hidden' name='idusuario' value='"+id[1]+"' />");
		jQuery("#formEditarus").submit();
	
	});

}
var acciones={
		filtraregiones:function(){
 			var idpais=jQuery("[name='pais']").val();
			var idregion=jQuery("[name='region']").val();
			if(parseInt(idpais)>0 && parseInt(idregion)>0){
 				jQuery("[name='ciudad']").html("<option value=''>Seleccione una ciudad</option>");
				jQuery("[name='empresar']").html("<option value=''>Seleccione una ciudad</option>");
  				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getciudades",
					data:{
						idpais:idpais,
						idregion:idregion
					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option value="">Seleccione una ciudad</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='ciudad']").html(html);
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("[name='ciudad']").html("<option value=''>Seleccione un departamento o región</option>");
  				jQuery("[name='empresar']").html("<option value=''>Seleccione un departamento o región</option>");
			}
 		
	},
	filtrapaises:function(){
 			var idpais=jQuery("[name='pais']").val();
 			if(parseInt(idpais)>0){
				jQuery("[name='region']").html("<option  value=''>Seleccione un departamento o región</option>");
				jQuery("[name='ciudad']").html("<option  value=''>Seleccione un departamento o región</option>");
				jQuery("[name='empresar']").html("<option value=''>Seleccione un departamento o región</option>");
 				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getregiones",
					data:{
						idpais:idpais,
 					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option value="">Seleccione un departamento o región</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='region']").html(html);
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("[name='region']").html("<option  value=''>Seleccione un pais</option>");
				jQuery("[name='ciudad']").html("<option  value=''>Seleccione un pais</option>");
				jQuery("[name='empresar']").html("<option  value=''>Seleccione un pais</option>");
			}
 	},
	filtraciudades:function(){
 			var idpais=jQuery("[name='pais']").val();
			var idregion=jQuery("[name='region']").val();
			var idciudad=jQuery("[name='ciudad']").val();
			if(parseInt(idpais)>0 && parseInt(idregion)>0 && parseInt(idciudad)>0){
 				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getorganizaciones",
					data:{
						idpais:idpais,
						idregion:idregion,
						idciudad:idciudad
					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option value="">Seleccione una empresa</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='empresar']").html(html);
 						 }else{
							 
						 }
					}
				}).responseJSON;				
 			}else{
   				jQuery("[name='empresar']").html("<option  value=''>Seleccione una ciudad</option>");
			}
 		
	}
}
jQuery(function(){
	
	Activa();
	/*
	acciones.filtraciudades();
	acciones.filtrapaises();
	acciones.filtraregiones();*/
	<? if(isset($_POST["pais"])){?>
		jQuery("[name='pais']").val(<?=$_POST["pais"]?>);acciones.filtrapaises();
	<? } ?>	
	<? if(isset($_POST["region"])){?>jQuery("[name='region']").val(<?=$_POST["region"]?>);acciones.filtraregiones();
	<? } ?>	
	<? if(isset($_POST["ciudad"])){?>jQuery("[name='ciudad']").val(<?=$_POST["ciudad"]?>);acciones.filtraciudades();
	<? } ?>	
	<? if(isset($_POST["empresar"])){?>jQuery("[name='empresar']").val(<?=$_POST["empresar"]?>);
	<? } ?>	
});
</script>
 
 
 <div id="contenedor360"   >
<?php echo CHtml::form(array("admin/evaluacion/proyecto"), 'post', array('class'=>'saveproyect', 'id'=>'saveproyect','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#reportes"), 'post', array('class'=>'descargarreporte', 'id'=>'descargarreporte','target'=>'descargar','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#evaluaciones_del_participante"), 'post', array('class'=>'informe', 'id'=>'informe','target'=>'descargar','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#evaluaciones_del_participante"), 'post', array('class'=>'informered', 'id'=>'informered','target'=>'descargar','style'=>'display: none')); ?>

</form>
<iframe name="descargar" id="descargar" style="display:none"></iframe>
<? //printVar($idioma->{"nombredelarelacion"}); ?>
   
  
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
                <!-- /.dropdown -->
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
				<div class="col-lg-2" id="tablero">
			
					<div class="col-lg-12 col-md-3">
						<div class="panel panel-primary">
							<div class="panel-heading" style="background-color:#FFF;color:#333">
								<div class="row">
									<div class="col-xs-2 text-left" style="padding-top:12px">
										<div class="huge"  style="font-size:26px"> <i class="fa fa-newspaper-o fa-fw"></i></div>
 									</div>
									<div class="col-xs-10 text-left">
										
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
			<div class="row">
				<div class="col-lg-12">
					 <div class="pull-left" id="pannel-menu"  style="display:none">
 							
								<ul class="nav navbar-top-links navbar-left in" id="menu360" rel="menu360"  >
												 
									<!-- /.dropdown -->
									<li class="dropdown">
										<a class="dropdown-toggle" title="<?=$idioma->{"participantes"}?>"   href="#participantes">
											<!--i class="fa fa-user-plus fa-2x"></i--> 
											<img  title="<?=$idioma->{"participantes"}?>" src="<?=Yii::App()->baseUrl?>/images/icon/participantes.png" style="width:60px"/>
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									<!-- /.dropdown -->
									<li class="dropdown">
										<a class="dropdown-toggle" title="<?=$idioma->{"relaciones"}?>"   href="#relaciones">
											<!--i class="fa fa-exchange fa-2x"></i--> 
											<img title="<?=$idioma->{"relaciones"}?>"    src="<?=Yii::App()->baseUrl?>/images/icon/relaciones.png" style="width:60px"/>											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"asignaciones"}?>"  href="#asignaciones">
											<!--i class="fa  fa-users   fa-2x"></i-->  
											<img  title="<?=$idioma->{"asignaciones"}?>" src="<?=Yii::App()->baseUrl?>/images/icon/redes.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"competencias"}?>"  href="#competencias">
											<!--i class="fa fa-group  fa-2x"></i-->  
											<img title="<?=$idioma->{"competencias"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/competencia.png" style="width:60px"/>	
										</a>
										
										<!-- /.dropdown-user -->
									</li>
																	
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"competenciasxevaluado"}?>"  href="#competenciasxevaluado">
											<!--i class="glyphicon glyphicon-th-list" style="font-size:20px;"></i--> 
											<img  title="<?=$idioma->{"competenciasxevaluado"}?>" src="<?=Yii::App()->baseUrl?>/images/icon/evaluador.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
																	
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"escalas"}?>"  href="#escalas">
											<!--i class="fa fa-list-ol  fa-2x"></i--> 
											<img  title="<?=$idioma->{"escalas"}?>"   src="<?=Yii::App()->baseUrl?>/images/icon/escalas.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"preguntas_abiertas"}?>"   href="#preguntas_abiertas">
											<!--i class="fa fa-question-circle  fa-2x"></i--> 
											<img   title="<?=$idioma->{"preguntas_abiertas"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/preguntas.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"mailing"}?>"   href="#mailing">
											<!--i class="fa fa-envelope-o  fa-2x"></i-->  
											<img  title="<?=$idioma->{"mailing"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/notificaciones.png" style="width:60px"/>											

										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"evaluaciones_del_participante"}?>"  href="#evaluaciones_del_participante">
											<!--i class="fa  fa-floppy-o fa-2x"></i-->  
											<img title="<?=$idioma->{"evaluaciones_del_participante"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/progreso.png" style="width:60px"/>											

										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"reportes"}?>"  href="#reportes">
											<!--i class="fa  fa-line-chart fa-2x"></i-->  
											<img  title="<?=$idioma->{"reportes"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/reporte.png" style="width:60px"/>	
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									 
									<!-- /.dropdown -->
								</ul>							
							
								<div style="clear:both"></div>
							
 								
                            </div>
				</div>
			
			</div>
            <div class="row" style="padding-left:13px;padding-right:13px">
				<div  class="col-lg-12" id="contenedorbr">
					<div class="col-lg-12" style="height:100%">
						<div class="panel panel-default" style="height:97%;overflow-y:scroll">
							<div  id="formulario" >
							
 									
									
									
									
									
									
									
									
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
 
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">
				<div style="float:left">
 					
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'filtrounidades', 'id'=>'filtrounidades','style'=>'float: left')); ?>
							<? // printVar($empl[3]); ?>
							<input type="hidden" id="option" name="option" value="<?=$option?>" />
							<div class="form-inline">
							<div class="form-group">
							<label for="paises">Paises:</label>
							<select name="pais" style="width:180px" class="form-control input-sm" id="paises" >
									<option value=""   selected='selected'>
									Seleccione un país
									</option>
								<?php 
								 
								foreach($paises as $unidad){ 
										 									
									?>
								<option value="<?=$unidad->id?>"   >
									<?=$unidad->nombre?>
								</option>
								<?php
								}
								?>
								</select> 
							</div>
							<div class="form-group">
							<label for="regiones">Regiones:</label>
							<select name="region"  style="width:200px" class="form-control input-sm" id="regines">
									<option   value=""   selected='selected'>
									Seleccione un país
									</option>
								<?php /*
								foreach($regiones as $unidad){ 
										 									
									?>
								<option value="<?=$unidad->id?>"   >
									<?=$unidad->nombre?>
								</option>
								<?php
								}*/
								?>
								</select> 
							</div>
							<div class="form-group">
							<label for="ciudades">Ciudades:</label>
							<select name="ciudad"  style="width:200px" id="ciudades" class="form-control">
									<option   value=""   selected='selected'>
									Seleccione un país
									</option>
								<?php /*
								foreach($ciudades as $unidad){ 
										 									
									?>
								<option value="<?=$unidad->id?>"   >
									<?=$unidad->nombre?>
								</option>
								<?php
								}*/
								?>
								</select> 
							</div>
							</div>
							<br><br>
							<div class="form-inline">
							<div class="form-group">
							<label for="empresas">Empresas:</label>
							<select name="empresar"  style="width:200px" id="empresas" class="form-control">
									<option  value=""   selected='selected'>
									Seleccione un país
									</option>
								<?php /*
								foreach($ciudades as $unidad){ 
										 									
									?>
								<option value="<?=$unidad->id?>"   >
									<?=$unidad->nombre?>
								</option>
								<?php
								}*/
								?>
							</select> 
							</div>
							</div>
							<input type="hidden" name="buscar" value="<?=$buscar?>" />
							<input type="hidden" name="perfilusuario" value="<?=$perfilusuarior?>" />
						</form>
					</div>
					
					
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected  form-inline">
						<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'filtroperfil', 'id'=>'filtroperfil','style'=>'float: left')); ?>
							 <input type="hidden" id="option" name="option" value="<?=$option?>" />
							<div class="form-group" style="margin-top: 4%">
							<label for="perfil">Perfil de usuario:</label>
							<select name="perfilusuario" id="perfil" class="form-control">
								<option value="-1" <? if($perfilusuarior==-1){echo "selected='selected'";} ?>>
								Todos
								</option>								
								<?php 
								foreach($listaperfiles as $perfil){
									$selected="";
									if($perfil->id==$perfilusuarior){
										$selected="selected='selected'";
									}
									?>
								<option value="<?=$perfil->id?>" <?=$selected?> >
									<?=$perfil->nombre?>
								</option>
								<?php
								}
								?>
							</select> 
							<input type="hidden" name="buscar" value="<?=$buscar?>" />
							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
						</form>
					</div>
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'filtroestado', 'id'=>'filtroestado','style'=>'float: left')); ?>
							 <input type="hidden" id="option" name="option" value="<?=$option?>" />
							 <? 
								 $selecteda="";
								 $selectedb="";
								 $selectedc="";
								 if($estado==-1){$selecteda="selected=selected";}
								 if($estado==1){$selectedb="selected=selected";}
								 if($estado==0){$selectedc="selected=selected";}
								?>
							<div class="form-group">
							<label for="estado">Estado:</label>
							<select name="estado" class="form-control" id="estado">
									<option value="-1" <?=$selecteda?> >
									Todos
									</option>								
								 
									<option value="1"  <?=$selectedb?> >Activo
										 
									</option>
									 
									 
									<option value="0"   <?=$selectedc?>>Inactivo
										 
									</option>
								 
								 
							</select> 
							</div>
							<input type="hidden" name="buscar" value="<?=$buscar?>" />
							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
						</form>
					</div>
					
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
					<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'buscarForm', 'id'=>'buscarForm','style'=>'float: left')); ?>
						 <input type="hidden" id="option" name="option" value="<?=$option?>" />
						<div class="form-group">
						<label for="buscar">Buscar:</label>
						 <input type="text" name="buscar" value="<?=$buscar?>"  class="form-control" id="buscar" placeholder="cédula,nombre o email" /><input type="button" id="buscarbutton"  value="Buscar"  class="btn"/><input type="button"  class="btn" id="refrescar"  value="Refrescar"/> 
 							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
							<input type="hidden" name="perfilusuario" value="<?=$perfilusuarior?>" />
						</div>
 					</form>
					</div>
					</div>
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/admusuario/crear"), 'post', array('class'=>'crear', 'id'=>'crear','style'=>'float: left')); ?>
							<input type="submit" value="Crear"  class="btn" style="margin-top: 16%"/>
						</form>
					</div>
				</div>
				<div style="float:right">
				<?
					$total_paginas=$paginacion[0];
					$pagina=$paginacion[1];
					$htmlpagina="";
					if ($total_paginas > 1) {
						if ($pagina != 1)
						  $htmlpagina.= '<input type="button" class="btn"  rel="pagina_'.($pagina-1).'" value="<<"/>';
						  for ($i=1;$i<=$total_paginas;$i++) {
							 if ($pagina == $i)
								//si muestro el índice de la página actual, no coloco enlace
								$htmlpagina.=  "<div class='paginaselected'><b>".$pagina."</b></div>";
							 else
								//si el índice no corresponde con la página mostrada actualmente,
								//coloco el enlace para ir a esa página
								$htmlpagina.=  '  <input type="button" class="btn" rel="pagina_'.$i.'" value="'.$i.'"/>  ';
						  }
						  if ($pagina != $total_paginas)
							 $htmlpagina.=  '<input type="button" class="btn" rel="pagina_'.($pagina+1).'" value=">>"/>';
					}
					echo $htmlpagina;
				?>	
				</div>	 <div style="clear:both"></div>		  
			  <div class="divContentWhite">
			  <?php echo CHtml::form(array("admin/admusuario/crear"), 'post', array('class'=>'formEditarus', 'id'=>'formEditarus')); ?>
  			  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
			    <tr>
   				  <td style="text-align:left"><b>Editar</b></td>
 				  <td style="text-align:left"><b>Perfil</b></td>
				  <td style="text-align:left"><b>Usuario</b></td>
 				  <td  > </td>
				  <td  > </td>
                                  <td  > </td>
				</tr>
				<?PHP
				for($i=0;$i<count($empl);$i++){
					$datoAI = "A";
					if($empl[$i]->activo == 0){
						$datoAI = "I";
					}
                                        $img = $empl[$i]->activo==1?"<img src='".$imageurl."bgre.png' rel='inactiva_".$empl[$i]->id_user."'  alt='' style='cursor:pointer'>":"<img rel='activa_".$empl[$i]->id_user."' src='".$imageurl."bneg.png' alt=''  style='cursor:pointer'>";
					echo("
					<tr>
 					  <td><a href='javascript:;' name='editar_".$empl[$i]->id_user."' style='font-size:20px' ><i class='fa fa-pencil-square-o fa-fw'></i></a>
  					  </td>
 					  <td><b>".($empl[$i]->perfil)."</b></td>
					  <td>".$empl[$i]->alias."</td>
 					  
					   <!--<td align='center'><input type='checkbox' id='check".$i."' /></td>
                                         <td align='center'>$img</td> -->
                                          <td align='center'><img src='".$imageurl."bad.gif' rel='eliminar_".$empl[$i]->id_user."' style='cursor:pointer' ></td>       
                                          <!-- <td align='center'><a href='admUsuariosLista.php?s=".$show."&id=".$empl[$i]->id_user."&uActivo=".'3'."'> <img src='img/bad.gif' alt=''> </a></td>  -->
                                              
					</tr>
					");
				}
				if(count($empl) == 0){
					echo("<tr><td colspan='5'>No hay ningun usuario</td></tr>");
				}
				?>
			  </table>
			  </form>
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'formPass', 'id'=>'formPass')); ?>
				  <input type="hidden" id="email" name="email" value="enviaremail" />
				  <input type="hidden" id="ids" name="ids" value="" />
				  <!--input type="button" value="Enviar contrase&ntilde;as" onclick="obj.enviar();" /-->
			  </form>
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'paginar', 'id'=>'paginar')); ?>
				  <input type="hidden" id="tamanio" name="tamanio" value="10" />
				  <input type="hidden" id="pagina" name="pagina" value="" />
				  <input type="hidden" id="option" name="option" value="<?=$option?>" />
				  <input type="hidden" name="buscar" value="<?=$buscar?>" />
 							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
							<input type="hidden" name="perfilusuario" value="<?=$perfilusuarior?>" />
 			  </form> <div style="clear:both"></div>
			  </div>
			 
				<div style="float:right">
				<?
					echo $htmlpagina;		
				?>	
				</div> <div style="clear:both"></div>
			  <script>
				jQuery(function(){
					jQuery("[rel^='pagina_']").click(function(){
						var pagina=jQuery(this).attr("rel").split("_")[1];
						jQuery("#pagina").val(pagina);
						jQuery("#paginar").submit();
						
					});
					
					
					jQuery("#filtrounidades").find("[name='pais']").change(function(){
  						jQuery("#filtrounidades").submit();
 					});
					
					jQuery("#filtrounidades").find("[name='region']").change(function(){
  						jQuery("#filtrounidades").submit();
 					});
					
					jQuery("#filtrounidades").find("[name='ciudad']").change(function(){
  						jQuery("#filtrounidades").submit();
 					});
					
					jQuery("#filtrounidades").find("[name='empresa']").change(function(){
  						jQuery("#filtrounidades").submit();
 					});
					
					
					
					
					jQuery("#filtroestado").find("[name='estado']").change(function(){
  						jQuery("#filtroestado").submit();
 					});
					jQuery("#filtroperfil").find("[name='perfilusuario']").change(function(){
  						jQuery("#filtroperfil").submit();
 					});
					
					
					
					jQuery("#buscarbutton").click(function(){
						var test=jQuery("#buscarForm").find("[name='buscar']").val();
						if(test!=""){
							
							jQuery("#buscarForm").submit();
						}else{
						
							jQuery.colorbox({html:"<h3>Por favor, agregue un criterio de búsqueda</h3>"});
						}
						
					});
					jQuery("#refrescar").click(function(){
						var test=jQuery("#buscarForm").find("[name='buscar']").val("");
 						jQuery("#buscarForm").submit();
 					});
					
				});
			  </script>
			  
			  
			</div>
		</td>
		</tr>
		<tr>
		<td>
 		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
 
									
									
									
									
									
									
									
									
									
									
									
 								
								
								
								 
							   <div style="clear:both"></div>
 							<!-- /.panel-heading -->
								 
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					 </div>
					<!-- /.col-lg-8 -->
					 
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
		
</div>	





































  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
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
	   border-top-left-radius:6px;
	   border-top-right-radius:6px;  
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
   .huge{font-size:38px;}
   </style>


<script>
jQuery(function(){
	var h1=jQuery("[role='navigation']").height();
	var h2=jQuery("#botones").height();
	var h3=jQuery("#linea").height();
	var h4=jQuery("#menu360").height();
	var ht=h1+h2+h3+h4+50;
	   
	
	var hcontenedor=jQuery('body').height()-ht;
	//jQuery("#contenedorbr").height(hcontenedor);
	jQuery("#contenedorbr").attr({"style":'height:'+hcontenedor+'px !important'});
	
	
	jQuery("#page-wrapper").height((h2+h4+hcontenedor)-100);
	jQuery(".push").remove()
	setTimeout(function(){
	var hw=jQuery("#wrapper").height();
	jQuery("#wrapper").height((hw-20));
	
	},200);
	jQuery("[href='#participantes']").click();  
	
 });
</script>	


