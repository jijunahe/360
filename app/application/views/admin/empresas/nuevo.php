<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
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
    
 
  </style>
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>

  
<script  > 
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
 

var idioma=jQuery.parseJSON( '<?=json_encode($idioma)?>');
//console.log(idioma); 
 
 function redondeo(numero, decimales)
{
var flotante = parseFloat(numero);
var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
return resultado;
}

function showMessage(message){
    jQuery("#colorbox").find(".messages").html("").show();
    jQuery("#colorbox").find(".messages").html(message);
}
 
 
$(document).ready(function(){
	
	 jQuery("#formCrear").validate(acciones.criterios);
	$("#formCrear").on('submit', function (e) {console.log(1234567);
	  e.preventDefault();
 	 
 	});	
	
		jQuery("[rel='cancelar_empresa']").click(function(){
			document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/empresas/";
		});
	
	 
	 
}); 
 
 
 
 
 
 
 
 
 
 
 var acciones={
 	 
	criterios:{
		rules: {
			nombreempresa: {
				required: true,
				minlength: 5
			},
			nit: {
				required: true,
				minlength: 5
			},
			nombrerepresentante: {
				required: false,
				minlength: 5
			},
			telefonocontacto: {
				required: false,
				minlength: 7
 			},
			emailresponsable: {
				required: false,
				email: true
			},

			pais: {
				required: true,
				min:1
			},
			region: {
				required: true,
				minlength:1
			}, 
			ciudad: {
				required: false,
				min:1
			}, 
 		},
		messages: { 
			nombreempresa: {
				required: "Por favor, ingrese el nombre de la empresa",
				minlength: "El nombre debe ser de minimo cinco caracteres"
			},
			
			nit: {
				required: "Por favor, ingrese el NIT",
				minlength: "El NIT debe ser de minimo cinco caracteres"
			},
			
			nombrerepresentante: {
				required: "Por favor, ingrese el nombre del representante legal",
				minlength: "El nombre debe ser de minimo cinco caracteres"
			},
			
			
			telefonocontacto: {
				required: "Por favor, ingrese el telefono de contacto del representante legal",
				minlength: "El telefono debe ser de minimo siete caracteres"
			},
 			emailresponsable: "Por favor ingrese un email válido",
 			pais: "Seleccione un país",
			ciudad: "Seleccione una ciudad",
			region: "Seleccione un departamento o región", 
 		},submitHandler: function(form){
			acciones.validarempresa();
			
			setTimeout(function(){
				if(acciones.existeempresa==false){ 
					 
					var url=$("#formCrear").attr("action");
					var objdata=$("#formCrear").serialize();
					// console.log(objdata);console.log(234567);
					jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					url: url,
					data:objdata,
					success:function(res){
						
					 
						if(res[0]=="ok"){
							if(jQuery("#idempresa").val()==""){
							jQuery.colorbox({html:"La empresa ha sido creada exitosamente"});
							}else{
								jQuery.colorbox({html:"La empresa ha sido actualizada exitosamente"});
							}
							jQuery("#idempresa").val(res[1]);
							jQuery("[name='nit']").attr({"readonly":"readonly"});
							jQuery("[name='nit']").hide();
							jQuery("[name='nit']").parent().parent().hide();

						}
						
					}});
				}else{
					jQuery("[name='nit']").attr({"class":"error"});
					if(jQuery("#nit-error").size()==0){
						var msj='<label id="nit-error" class="error" for="nit" style="display: block;">El nit ya existe</label>';
						jQuery("[name='nit']").parent().append(msj);
					}else{
						jQuery("#nit-error").attr({"class":"error"});
						jQuery("#nit-error").show();
						jQuery("#nit-error").html("El nit ya existe");
					}
				}
			},300);				
		}
	},	 
	existeempresa:false,
	validarempresa:function(){
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/empresas/validarempresa",
			data:{
				nit:jQuery("#formCrear").find("[name='nit']").val()
 			},
			success:function(res){
				
				 if(res[0]=="no"){
					 acciones.existeempresa=false;
				 }
				 if(res[0]=="existe"){
					if(jQuery("#idempresa").val()>0){acciones.existeempresa=false;
					}else{
					 acciones.existeempresa=true;
					}
				 }
			}
		}).responseJSON;		
		
		
		
		
	},	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 	filtraregiones:function(){
		jQuery("[name='region']").off();
		jQuery("[name='region']").on("change",function(){
			var idpais=jQuery("[name='pais']").val();
			var idregion=jQuery(this).val();
			if(parseInt(idpais)>0 && parseInt(idregion)>0){
 				//jQuery("[name='ciudad']").html("<option>Seleccione una ciudad</option>");
				//jQuery("[name='empresar']").html("<option>Seleccione una ciudad</option>");
  				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getorganizaciones",
					data:{
						idpais:idpais,
						idregion:idregion
					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option>Seleccione una empresa</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='empresar']").html(html);
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("[name='empresar']").html("<option>Seleccione un sector económico</option>");
  				//jQuery("[name='empresar']").html("<option>Seleccione un departamento o región</option>");
			}
		});
		
	},
	filtrapaises:function(){
		jQuery("[name='pais']").off();
		jQuery("[name='pais']").on("change",function(){
			var idpais=jQuery(this).val();
 			if(parseInt(idpais)>0){
				jQuery("[name='region']").html("<option>Seleccione un departamento o región</option>");
				jQuery("[name='ciudad']").html("<option>Seleccione un departamento o región</option>");
				//jQuery("[name='empresar']").html("<option>Seleccione un departamento o región</option>");
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
							 var html='<option>Seleccione un departamento o región</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='region']").html(html);
							 acciones.filtraregiones();
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("[name='region']").html("<option>Seleccione un pais</option>");
				jQuery("[name='ciudad']").html("<option>Seleccione un pais</option>");
				//jQuery("[name='empresar']").html("<option>Seleccione un pais</option>");
			}
		});	
	},
	filtraciudades:function(){
		jQuery("[name='ciudad']").off();
		jQuery("[name='ciudad']").on("change",function(){
			var idpais=jQuery("[name='pais']").val();
			var idregion=jQuery("[name='region']").val();
			var idciudad=jQuery(this).val();
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
							 var html='<option>Seleccione una empresa</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							// jQuery("[name='empresar']").html(html);
 						 }else{
							 
						 }
					}
				}).responseJSON;				
 			}else{
   				//jQuery("[name='empresar']").html("<option>Seleccione una ciudad</option>");
			}
		});		
		
	},
	guardar:function(){
		jQuery("[rel='guardar_empresa']").off();
		jQuery("[rel='guardar_empresa']").on("click",function(){
				var pref=jQuery("#formulario");
				data['nombre']=pref.find("[name='nombreempresa']").val();
				data['nit']=pref.find("[name='nit']").val();
				data['nombrerepresentante']=pref.find("[name='nombrerepresentante']").val();
				data['telefonocontacto']=pref.find("[name='telefonocontacto']").val();
				data['emailresponsable']=pref.find("[name='emailresponsable']").val();
				data['pais']=pref.find("[name='pais']").val();
				data['region']=pref.find("[name='region']").val();
				data['ciudad']=pref.find("[name='ciudad']").val();
			
		});
	}
}
 
 
 
 
 jQuery(function(){
	 acciones.filtrapaises();
 });
 
 
 
 
 
 
 
 
 
 
</script>
 <div id="contenedor360"   >

<?php echo CHtml::form(array("admin/evaluacion/proyecto"), 'post', array('class'=>'saveproyect', 'id'=>'saveproyect','style'=>'display: none')); ?>

</form>
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
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario">
                                 <div> 
                                    <strong><?=$idioma->{"usuarios"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
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
                        </li>
                          
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?=$idioma->{"perfil_de_usuario"}?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> <?=$idioma->{"configuracion"}?></a>
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
            <div class="row">
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
			<div class="row">
				<div class="col-lg-12">
					 <div class="pull-left" id="pannel-menu"  style="display:none">
 							
								<ul class="nav navbar-top-links navbar-left in" id="menu360" rel="menu360"  >
												 
									<!-- /.dropdown -->
									<li class="dropdown">
										<a class="dropdown-toggle" title="<?=$idioma->{"participantes"}?>"   href="#participantes">
											<!--i class="fa fa-user-plus fa-2x"></i--> 
											<img src="<?=Yii::App()->baseUrl?>/images/icon/participantes.png" style="width:60px"/>
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									<!-- /.dropdown -->
									<li class="dropdown">
										<a class="dropdown-toggle" title="<?=$idioma->{"relaciones"}?>"   href="#relaciones">
											<!--i class="fa fa-exchange fa-2x"></i--> 
											<img src="<?=Yii::App()->baseUrl?>/images/icon/relaciones.png" style="width:60px"/>											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"asignaciones"}?>"  href="#asignaciones">
											<!--i class="fa  fa-users   fa-2x"></i-->  
											<img src="<?=Yii::App()->baseUrl?>/images/icon/redes.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"competencias"}?>"  href="#competencias">
											<!--i class="fa fa-group  fa-2x"></i-->  
											<img src="<?=Yii::App()->baseUrl?>/images/icon/competencia.png" style="width:60px"/>	
										</a>
										
										<!-- /.dropdown-user -->
									</li>
																	
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"competenciasxevaluado"}?>"  href="#competenciasxevaluado">
											<!--i class="glyphicon glyphicon-th-list" style="font-size:20px;"></i--> 
											<img src="<?=Yii::App()->baseUrl?>/images/icon/evaluador.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
																	
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"escalas"}?>"  href="#escalas">
											<!--i class="fa fa-list-ol  fa-2x"></i--> 
											<img src="<?=Yii::App()->baseUrl?>/images/icon/escalas.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"preguntas_abiertas"}?>"   href="#preguntas_abiertas">
											<!--i class="fa fa-question-circle  fa-2x"></i--> 
											<img src="<?=Yii::App()->baseUrl?>/images/icon/preguntas.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"mailing"}?>"   href="#mailing">
											<!--i class="fa fa-envelope-o  fa-2x"></i-->  
											<img src="<?=Yii::App()->baseUrl?>/images/icon/notificaciones.png" style="width:60px"/>											

										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"evaluaciones_del_participante"}?>"  href="#evaluaciones_del_participante">
											<!--i class="fa  fa-floppy-o fa-2x"></i-->  
											<img src="<?=Yii::App()->baseUrl?>/images/icon/progreso.png" style="width:60px"/>											

										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"reportes"}?>"  href="#reportes">
											<!--i class="fa  fa-line-chart fa-2x"></i-->  
											<img src="<?=Yii::App()->baseUrl?>/images/icon/reporte.png" style="width:60px"/>	
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
					 
						<div class="panel panel-default">
							<div class="panel-heading">
							
								<div class="pull-left"  > <strong><?=$idioma->{"nuevaempresa"}?></strong> <br>
									
									
								</div>
								   
								
								
								 
							   <div style="clear:both"></div>
							</div>    
							<!-- /.panel-heading -->
							<div class="panel-body" id="formulario">
								<?php echo CHtml::form(array("admin/empresas/nuevo"), 'post', array('class'=>'formCrear' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;',"autocomplete"=>"off")); ?>
									<input type="hidden" name="save" />
									<input type="hidden" name="idusuario" id="idempresa" <? if(isset($empresa->id)){?>value="<?=$empresa->id?>"<?}?>  />

 									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->nombreempresa?></strong></div>
										<div class="col-lg-7"><input type="text" name="nombreempresa" <? if(isset($empresa->nombre)){?>value="<?=$empresa->nombre?>"<?}?> style="width:100%"></div>
										<div style="clear:both"></div>
									</div>
									 
									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->nit?></strong></div>
										<div class="col-lg-7"><input type="text" name="nit" <? if(isset($empresa->nit)){?>value="<?=$empresa->nit?>"<?}?>  style="width:100%"></div>
										<div style="clear:both"></div>
									</div>
									 
									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->nombrerepresentante?></strong></div>
										<div class="col-lg-7"><input type="text" name="nombrerepresentante" <? if(isset($empresa->nombrerepresentante)){?>value="<?=$empresa->nombrerepresentante?>"<?}?>  style="width:100%"></div>
										<div style="clear:both"></div>
									</div>
									 
									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->telefonocontacto?></strong></div>
										<div class="col-lg-7"><input type="text" name="telefonocontacto"  <? if(isset($empresa->telefono)){?>value="<?=$empresa->telefono?>"<?}?>  style="width:100%"></div>
										<div style="clear:both"></div>
									</div>
									 
									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->emailresponsable?></strong></div>
										<div class="col-lg-7"><input type="text" name="emailresponsable"  <? if(isset($empresa->email)){?>value="<?=$empresa->email?>"<?}?>  style="width:100%"></div>
										<div style="clear:both"></div>
									</div>
									 
									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->paises?></strong></div>
										<div class="col-lg-7">
											<select name="pais" style="width:100%;"><option value="-1">Seleccione un país</option>
											<? foreach($paises as $pais){ 
												$checked="";
												if(isset($empresa->id_pais)){
													if($empresa->id_pais==$pais->id){
														$checked=" selected='selected' ";
													}
												}
											?>
													
															<option <?=$checked?> value="<?=$pais->id?>"><?=$pais->nombre?></option>
											<? } ?>
															
 															</select>
										</div>
										<div style="clear:both"></div>
									</div>
									<div class="list-group list-group-item">
										<div class="col-lg-5"><strong><?=$idioma->regiones?></strong></div>
										<div class="col-lg-7">
											<select name="region" style="width:100%;">
											 	<? if(isset($region->id)){ ?>
													 <option value="<?=$region->id?>" selected="selected"><?=$region->nombre?></option>
													
												<? }else{ ?>									
											
												 <option value="-1">Seleccione un país</option>
															
												<? } ?>			
											</select>
										</div>
										<div style="clear:both"></div>
									</div>
									<div class="list-group list-group-item" style="display:none">
										<div class="col-lg-5"><strong><?=$idioma->ciudades?></strong></div>
										<div class="col-lg-7">
											<select name="ciudad" style="width:100%;">
											 	<? if(isset($ciudad->id)){ ?>
													 <option value="<?=$ciudad->id?>" selected="selected"><?=$ciudad->nombre?></option>
													
												<? }else{ ?>									
											
												 <option value="-1">Seleccione un país</option>
															
												<? } ?>
											</select>
										</div>
										<div style="clear:both"></div>
									</div>
 

									<div class="list-group list-group-item">
										<div class="col-lg-5"><input type="submit" value="<?=$idioma->guardar?>" rel="guardar_empresa"  ></div>
										<div class="col-lg-7"><input type="button" value="<?=$idioma->cancelar?>" rel="cancelar_empresa"  ></div>
										<div style="clear:both"></div>
									</div>
								</form>
  							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					  
					<!-- /.col-lg-8 -->
					 <div style="clear:both"></div>
                </div>
                <!-- /.col-lg-4 -->
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
   #formulario p{
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
		
