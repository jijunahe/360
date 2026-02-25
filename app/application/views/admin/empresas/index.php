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
var acciones={
	objparticipantes:{},
	empresas:function(){
		jQuery("#nuevaempresa").off();
		jQuery("#nuevaempresa").on("click",function(){
			document.location="<?=Yii::app()->baseUrl?>/index.php/admin/empresas/nuevo"; 
		});
		
	},
	editar:function(){
		jQuery("[rel^='empresa_']").off();
		jQuery("[rel^='empresa_']").on("click",function(){
			var option=jQuery(this).attr("rel").split("_")[1];
			switch(option){
				case "editar":
					var id=jQuery(this).attr("id").split("_")[1];
					jQuery("#nuevo").append('<input type="hidden" name="nit" value="'+id+'" />');
					jQuery("#nuevo").submit();
				break;
				
			}
			
		});
		
	}
	
}


var idioma=jQuery.parseJSON( '<?=json_encode($idioma)?>');
//console.log(idioma); 
 jQuery(function(){
	 
	acciones.empresas();
	acciones.editar();

	
 });
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
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
         case 'csv':
            return true;
        break;
        default:
            return false;
        break;
    }
}

function cargar(){
	 
   jQuery("#colorbox").find(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    jQuery("#colorbox").find(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = jQuery("#colorbox").find("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
		if(fileExtension.toUpperCase()!="CSV"){
			message = $("<span class='error'>El archivo debe ser de formato CSV</span>");
			showMessage(message);
			
		}
    });
 
    //al enviar el formulario
    jQuery("#colorbox").find(':button').off()
    jQuery("#colorbox").find(':button').on("click",function(){console.log("ACAAAAAAAAAAAAAAA");
		if(fileExtension.toUpperCase()=="CSV"){
			//información del formulario
			var formData = new FormData(jQuery("#colorbox").find(".formulario")[0]);
			var message = ""; 
			//hacemos la petición ajax  
			$.ajax({
				url: jQuery("#colorbox").find(".formulario").attr("action"),  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				dataType: "json",
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					message = $("<span class='before'>Subiendo archivo, por favor espere...</span>");
					showMessage(message)        
				},
				//una vez finalizado correctamente success
				success: function(data){
					message = $("<span class='info'>Analizando archivo, por favor espere. Esto puede tardar varios minutos.</span>");
					showMessage(message);
					console.log(data);
					if(data["estado"]=="error"){
						var htmlerr="<span class='error'>Los datos precentan errores, por favor verificar lo siguiente:</span>";
						htmlerr+="<ul>";
						jQuery.each(data["errores"],function(k,d){
							htmlerr+="<li>";
							htmlerr+=d;
							htmlerr+="</li>";
						});
						htmlerr+="</ul>";
						message = $(htmlerr);
						showMessage(message);
						
					}
					if(data["estado"]=="ok"){
						
						if(data[1]>0){
							var htmlerr="<span class='error'>Existen inconsistencias en cuanto a los valores correspondientes a colesterol, triglicéridos, glicemia y tensión (diastólica y sistólica)</span>";
							htmlerr+="<ul>";
							jQuery.each(data[2],function(k,d){
								htmlerr+="<li>";
								htmlerr+=d;
								htmlerr+="</li>";
							});
							htmlerr+="</ul><br><b>Por favor corrija la informacion erronea y carguelo nuevamente. Si cree que los valores son correctos, marque 'Si' en 'Ignorar valores fuera de rago (trigliceridos, glicemia, tensión, colesterol )'</b>";
							showMessage(htmlerr);
							jQuery("a[href='#participantes']").click();
						}else{

						
							message = $("<span class='success'>Los datos ha sido cargados exitosamente</span>");
							showMessage(message);
						}
					}
					 
				},
				//si ha ocurrido un error
				error: function(){
					message = $("<span class='error'>Ha ocurrido un error.</span>");
					showMessage(message);
				}
			});
		}else{
			message = $("<span class='error'>El archivo debe ser de formato CSV</span>");
			showMessage(message);
						
		}
    });
}

</script>
 <div id="contenedor360"   >

<?php echo CHtml::form(array("admin/empresas/nuevo"), 'post', array('class'=>'nuevo', 'id'=>'nuevo','style'=>'display: none')); ?>

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
							
								<div class="pull-left"  > <strong><?=$idioma->{"empresas"}?></strong> <Input type ='button' value="<?=$idioma->nuevaempresa?>" id="nuevaempresa" /><br>
									
									
								</div>
								   
								
								
								 
							   <div style="clear:both"></div>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body" id="formulario" style="height:97%">
								
								<div class="list-group" id="view_data" style="display: block; overflow-y:scroll;height:400px"> 
								<? foreach($empresas as $k=>$datospro) {
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
											<a href="javascript:;" id="editarempresa_<?=$datospro->id?>" title="<?=$idioma->{"editar"}?>" rel="empresa_editar">
											<i class="fa fa-pencil-square-o fa-2x"></i>
											</a> 
											<a href="javascript:;" id="eliminar_<?=$datospro->id?>" title="<?=$idioma->{"eliminar"}?>" rel="empresa_eliminar">
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
					  
					<!-- /.col-lg-8 -->
					 <div style="clear:both"></div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        </div>
        <!-- /#page-wrapper -->
		
		
		
   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
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
		
