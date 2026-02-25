<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
	<div style="width: 1200px !important;margin: auto;">
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
		<h4><strong>Gestionar Cuentas</strong></h4>
		<br>
		<!-- inicio de tabla-->
		<div style="height: 27em !important; overflow-y: auto;">
			<table class="table table-bordered">
				<thead class="bg-primary">
				   <div class="row">
					<th class="col-md-2">Empresa</th>
					<th class="col-md-3">Email</th>
					<th class="col-md-2">Cr&#233ditos</th>
					<th class="col-md-3"></th>
					<th class="col-md-2"></th>
				  </div>
				</thead>
				<tbody id="contenido">
					
				</tbody>
			</table>
		</div>
		<!-- fin de tabla-->

        </div>
        <!-- /#page-wrapper -->
	<div>
	<!-- fin de contenedor360 -->
	
	
	<script>
		var usuarios = <?=$usuarios?>;
		var contenido;
		jQuery.each(usuarios,function(key,value){
		contenido += '<tr><div class="row">'+
			'<td class="col-md-2">'+value.nombres+'</td>'+
			'<td class="col-md-3" id="email_'+value.id+'">'+value.email+'</td>'+
			'<td class="col-md-2 text-center" id="creditos_'+value.id+'" >'+value.creditos+'</td>'+
			'<td class="col-md-2">'+'<div class="row"><div class="col-md-5"><input type="text" name="creditos_'+value.id+'" class="form-control" placeholder="Cr&#233ditos"></div><div class="col-md-1"><!--</div><div class="col-m-2" style="display:none;"><button class="btn btn-link pull-right" rel="retirar_'+value.id+'">Retirar</button></div>--><div class="col-md-2"> <button class="btn btn-link" rel="adicionar_'+value.id+'">Adicionar</button></div></div>'+'</td>'+
			'<td class="col-md-2">'+'<form action="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/crear" method="POST"><input type="hidden" name="idusuario" value="'+value.id+'"><input type="submit" value="Editar" class="btn btn-link"></form>'+'</td>'+
			'</tr></div>';
		});
	jQuery("#contenido").html(contenido);

	jQuery("[rel^='adicionar_']").click(function(){
		var id = jQuery(this).attr('rel').split('_')[1];
		var creditos = jQuery('[name=creditos_'+id+']').val();
		var email = jQuery('#email_'+id).text();
		console.log("adicionar "+id,creditos,email);
		if(creditos == ""){
			jQuery.colorbox({html:"<center><h2>El campo de Cr&#233ditos no puede estar vacio</h2></center>"});
			return;	
		}
		jQuery.post("<?=Yii::app()->baseUrl?>/index.php/admin/moneda/asignar",{op:"save",email:email,creditos:creditos},function(response){
			response = JSON.parse(response);
			if(response[0] == "ok"){
				jQuery.colorbox({html:"<center><h2>Cr&#233ditos Adicionados Correctamente</h2></center>"});
				jQuery("#creditos_"+id).text(parseInt(jQuery("#creditos_"+id).text()) + parseInt(creditos));
			}
			console.log(response);
		});
	});
	jQuery("[rel^='retirar_']").click(function(){
		var id = jQuery(this).attr('rel').split('_')[1];
		var creditos = jQuery('[name=creditos_'+id+']').val();
		var email = jQuery('#email_'+id).text();
		console.log("retirar "+id,creditos,email);
		jQuery.colorbox({html:"<center><h2>No tiene permiso para este proyecto</h2></center>"});
	});
	</script>
<style>
   #page-wrapper{
	   margin:0px;
   }
   .page-header{
	   margin:10px 0 20px;
   }
   .huge{font-size:38px;}
   #footer{
	display:none;
   }

 </style>