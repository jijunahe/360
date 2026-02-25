<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<style>
.ui-autocomplete{z-index:999999;} </style>   
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
	tempousuarios:[],
	 asignar:function(){
		 jQuery("[rel='asignar']").off();
		 jQuery("[rel='asignar']").on("click",function(){
			  acciones.tempousuarios=[];
			 jQuery("#asignarCred").find("[name='op']").val("get");
			 var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				//async: true,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/moneda/asignar",
				data:jQuery("#asignarCred").serialize(),
				success:function(res){ 
				acciones.tempousuarios=[];
					var template=jQuery("#asignarCredito").clone();
					template.find("#creditos").text(res[0]);
					
					//acciones.tempousuarios=
					jQuery.each(res[1],function(k,d){
						acciones.tempousuarios.push(d[2]);
					});
					template.find("#autoc").html('<label for="du"></label><input id="du">');
					jQuery.colorbox({html:"<div id='f_asignar'>"+template.html()+"</div>",width:"500px","height":"300px"});
					jQuery("#f_asignar").find( "#du" ).autocomplete({
						source: acciones.tempousuarios
					});   
					acciones.guardarasignar();   
 				}
			}).responseJSON;
			 
			     
		 });
	 },
	 guardarasignar:function(){
		 jQuery("[rel='guardar_asignar']").off();
		 jQuery("[rel='guardar_asignar']").on("click",function(){
			  acciones.tempousuarios=[];	
			//jQuery("#f_asignar").find( "#du" ).autocomplete( "destroy" );
			 jQuery("#asignarCred").find("[name='op']").val("save");
			 jQuery("#asignarCred").find("[name='creditos']").remove();
			 jQuery("#asignarCred").find("[name='email']").remove();
			if(jQuery("#colorbox").find("[name='creditos']").val()>0 && jQuery("#colorbox").find("#du").val()!=""  ){
				jQuery("#asignarCred").append('<input type="hidden" name="creditos" value="'+jQuery("#colorbox").find("[name='creditos']").val()+'"/>');
				jQuery("#asignarCred").append('<input type="hidden" name="email" value="'+jQuery("#colorbox").find("#du").val()+'"/>');
				     
				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					//async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/moneda/asignar",
					data:jQuery("#asignarCred").serialize(),
					success:function(res){ 
						var mensaje="Los créditos han sido asignados";
						 if(res[0]=="ok"){
							mensaje="Los créditos han sido asignados";
						 }
						 if(res[0]=="error"){
							mensaje=res[1];
						 }
						jQuery.colorbox({html:"<div id='f_asignar'>"+mensaje+"</div>",width:"300px","height":"200px"});
						  
						acciones.tempousuarios=[];       
					}
				}).responseJSON;
			}else{
				alert();
			}
		 });
	 }
	 
	
}
function eseValido(e){
	var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(e)) {
      return true;
    } else {
      return false;
    }
	
}
jQuery(function(){
	acciones.asignar();
 	<?
		if($mensaje!=""){
	?>//console.log("HOlaaaaaaaaaa");
	jQuery.colorbox({html:"<center><h2><?=$mensaje?></h2></center>",width:"500px","height":"300px"});
		<? } ?>
});
</script>
 <?php echo CHtml::form(array("admin/evaluacion/moneda/asignar"), 'post', array('class'=>'asignarCred', 'id'=>'asignarCred','target'=>'asignarCred','style'=>'display: none')); ?>
<input type="hidden" name="op" />
</form>
<div id="asignarCredito" style="display:none">
	<div class="col-lg-12 " > 
		<strong><?=$idioma->{"tiene_creditos"}?>:<span id="creditos"></span></strong>
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong>Cuantos créditos va a asignar?</strong></div>
			<div class="col-lg-7"><input type="text" name="creditos" style="width:100%"></div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong>Elija un usuario</strong></div>
			<div class="col-lg-7">
				<div class="ui-widget" id="autoc">
					
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		
	</div> 
	<div class="col-lg-2 text-right">
			<button  rel="guardar_asignar" >Guardar</button>
	</div>
</div>
 
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
												 <?php  if($usuariomodel->perfil==1){?>
						  <li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/moneda">
                                <div>
                                    <strong><?=$idioma->{"monedas"}?></strong> 
                                 </div>
                             </a>
                        </li>
                        <? } ?>  

                          
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
					<div class="col-lg-12" style="height:100%"> 
						<div class="panel panel-default" style="height:97%">
							<div class="panel-heading">
 									<i class="fa fa-bar-chart-o fa-fw"></i> <?=$idioma->{"monedas"}?>  
									<input type="button" value="  <?=$idioma->{"nueva_moneda"}?>" rel="" />
									<input type="button" value="  <?=$idioma->{"asignar_credito"}?>" rel="asignar" />
									 
								
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body" style="height:92%">
								 
								<div class="list-group" id="view_data" style="display: block;height:97% ;overflow-y:scroll"> 
								<? foreach($monedas as $k=>$datospro) {
									$nombre=$datospro->nombre;
									if(strlen ($datospro->nombre)>=25){
									$nombre=substr($datospro->nombre,1,25)."...";
									}
								?> 
	 
									<li class="list-group-item"  >
										<div style="width:90%;float:left">
											<div  style="clear:both;width:100%"><strong id="nombre_69KS8">   <?=$nombre?>,cantidad <?=$datospro->cantidad?>,   </strong> </div>
											<div  style="width:100%"><b><?=$datospro->fechacreacion?></b> </div>
											<div style="clear:both" ></div>
										</div>
										
										<div style="width:9%;float:left">
											<a href="javascript:;" id="avance_<?=$datospro->id?>" title="Avance" rel="avance_<?=$datospro->id?>"><i class="fa fa-search-plus fa-2x"></i></a>
											<a href="javascript:;" id="editarproyecto_<?=$datospro->id?>" title="<?=$idioma->{"editar"}?>" rel="proyecto_editar">
											<i class="fa fa-pencil-square-o fa-2x"></i>
											</a> 
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
		
