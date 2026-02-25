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
 
 
  </style>
  <script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>
<script>
	/*
	$.validator.setDefaults({
		submitHandler: function() {
			acciones.validarusuario();
			setTimeout(function(){
				if(acciones.existeusuario==false){
					 
					var url=$("#formCrear").attr("action");
					var objdata=$("#formCrear").serialize();
					 
					jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					url: url,
					data:objdata,
					success:function(res){
						
						alert(res[0]);
						jQuery("#idusuario").val(res[1]);
						
					}}); 
				}else{
					jQuery("[name='usuario']").attr({"class":"error"})
					jQuery("#usuario-error").attr({"class":"error"});
					jQuery("#usuario-error").show();
					jQuery("#usuario-error").html("El nombre de usuario ya existe");
				}
			},300);
		}
	});*/ 
	
$(document).ready(function(){
	
	 jQuery("#formCrear").validate(acciones.criterios);
	$("#formCrear").on('submit', function (e) {console.log(1234567);
	  e.preventDefault();
 	 
 	});	
	
		jQuery("[rel='volver']").click(function(){
			document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/admusuario";
		});
	
	
	
	jQuery("[name='empresa']").click(function(){
		var valor=jQuery(this).val();
		var objs=jQuery("[name='empresa']:checked");
		var checked=[];
		jQuery.each(objs,function(k,d){
			 var dato=jQuery(d).val();
			 checked.push(dato);
		});
		jQuery("#empresar").val(checked.join(","));
		
	});
	acciones.validarperfil();
	<? if((int)$idusuario>0){ ?>
				jQuery("#usuario").parent().parent().hide();
		<? }else{ ?>
	<? } ?>
});
var  acciones={//acciones.criterios["rules"][""]["required"]=
	criterios:{
			rules: {
 				nombres: {
					required: true,
					minlength: 5
				},
 				usuario: {
					required: true,
					minlength: 5
				},
				password: {
					required: true,
					minlength: 5
				},
				password2: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
 
				perfil: {
 					required: true,
					min:1
				},
				documento: {
 					required: true,
					minlength: 4
				}, 
				pais: {
 					required: false,
					min:1
 				}, 
				ciudad: {
 					required: false,
					min:1
  				} ,
				region: {
 					required: false,
					min:1
 				} ,
				empresar: {
 					required: false,
					min:1
 				} 
			},
			messages: { 
 				nombres: {
					required: "Por favor, ingrese el nombre del usuario",
					minlength: "El nombre debe ser de minimo cinco caracteres"
				},
 				
 				usuario: {
					required: "Por favor, ingrese el usuario",
					minlength: "El usuario debe ser de minimo cinco caracteres"
				},
				password: {
					required: "Por favor ingrese el password",
					minlength: "El password debe ser de al menos cinco caracteres"
				},
				password2: {
					required: "Por favor confirme el password",
					minlength: "El password debe ser de al menos cinco caracteres",
					equalTo: "Los password no coinciden"
				},
				email: "Por favor ingrese un email válido",
 				perfil: "Seleccione el perfil de usuario",
 				pais: "Seleccione un país",
 				ciudad: "Seleccione una ciudad",
 				region: "Seleccione un departamento o región", 
 				empresar: "Seleccione una empresa",
				documento: "Por favor ingrese el documento de cédula o identidad",
			},submitHandler: function(form){
				<? if((int)$idusuario>0){ ?>
				
				<? }else{ ?>acciones.validarusuario();
				<? } ?>
				setTimeout(function(){
					if(acciones.existeusuario==false){ 
						 
						var url=$("#formCrear").attr("action");
						var objdata=$("#formCrear").serialize();
						// console.log(objdata);console.log(234567);
						jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						url: url,
						data:objdata,
						success:function(res){
							
							alert(res[0]);
							jQuery("#idusuario").val(res[1]);
							
						}});
					}else{
						jQuery("[name='usuario']").attr({"class":"error"});
						if(jQuery("#usuario-error").size()==0){
							var msj='<label id="usuario-error" class="error" for="usuario" style="display: block;">El nombre de usuario ya existe</label>';
							jQuery("[name='usuario']").parent().append(msj);
						}else{
							jQuery("#usuario-error").attr({"class":"error"});
							jQuery("#usuario-error").show();
							jQuery("#usuario-error").html("El nombre de usuario ya existe");
						}
					}
				},300);				
 			}
		},
	perfil:-1,
	existeusuario:false,
	validarusuario:function(){
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/validarusuario",
			data:{
				alias:jQuery("#formCrear").find("[name='usuario']").val()
 			},
			success:function(res){
				 if(res[0]=="no"){
					 acciones.existeusuario=false;
				 }
				 if(res[0]=="existe"){
					 acciones.existeusuario=true;
				 }
			}
		}).responseJSON;		
		
		
		
		
	},
 	validarperfil:function(){
		jQuery("tr[id^='r_']").hide();
		jQuery("#perfil").change(function(){
			jQuery("tr[id^='r_']").hide();
			var id=jQuery(this).val();
			if(id==2){
				acciones.criterios["rules"]["ciudad"]["required"]=false;
				acciones.criterios["rules"]["empresar"]["required"]=false;
				acciones.criterios["rules"]["pais"]["required"]=false;
				acciones.criterios["rules"]["region"]["required"]=false;
			}
			if(id==3){
				jQuery("#r_pais").show();
				jQuery("#r_region").show();
				acciones.filtraregiones();
				acciones.filtrapaises();
				acciones.criterios["rules"]["ciudad"]["required"]=false;
				acciones.criterios["rules"]["empresar"]["required"]=false;
				acciones.criterios["rules"]["pais"]["required"]=true;
				acciones.criterios["rules"]["region"]["required"]=true;
 			}
			
			if(id==5){
				jQuery("#r_pais").show();
				jQuery("#r_region").show();
				jQuery("#r_ciudad").show();
				acciones.filtraregiones();
				acciones.filtrapaises();
				acciones.filtraciudades();
				acciones.criterios["rules"]["ciudad"]["required"]=true;
				acciones.criterios["rules"]["empresar"]["required"]=false;
				acciones.criterios["rules"]["pais"]["required"]=true;
				acciones.criterios["rules"]["region"]["required"]=true;
 			}
			if(id==4){
				jQuery("#r_pais").show();
				jQuery("#r_region").show();
				jQuery("#r_ciudad").show();
				jQuery("#r_organizacion").show();
				acciones.filtraregiones();
				acciones.filtrapaises();
				acciones.filtraorganizaciones();
				acciones.filtraciudades();
				acciones.criterios["rules"]["ciudad"]["required"]=true;
				acciones.criterios["rules"]["empresar"]["required"]=true;
				acciones.criterios["rules"]["pais"]["required"]=true;
				acciones.criterios["rules"]["region"]["required"]=true;

			}
			
		});
		
		
		/*
		//console.log("<?=$id_pais");
		jQuery("tr[id^='r_']").hide();
		var id=jQuery('#perfil').val();
		if(id==2){
			acciones.criterios["rules"]["ciudad"]["required"]=false;
			acciones.criterios["rules"]["empresar"]["required"]=false;
			acciones.criterios["rules"]["pais"]["required"]=false;
			acciones.criterios["rules"]["region"]["required"]=false;
		}
		if(id==3){
			jQuery("#r_pais").show();
			jQuery("#r_region").show();
			acciones.filtraregiones();
			acciones.filtrapaises();
			acciones.criterios["rules"]["ciudad"]["required"]=false;
			acciones.criterios["rules"]["empresar"]["required"]=false;
			acciones.criterios["rules"]["pais"]["required"]=true;
			acciones.criterios["rules"]["region"]["required"]=true;
		}
		
		if(id==5){
			jQuery("#r_pais").show();
			jQuery("#r_region").show();
			jQuery("#r_ciudad").show();
			acciones.filtraregiones();
			acciones.filtrapaises();
			acciones.filtraciudades();
			acciones.criterios["rules"]["ciudad"]["required"]=true;
			acciones.criterios["rules"]["empresar"]["required"]=false;
			acciones.criterios["rules"]["pais"]["required"]=true;
			acciones.criterios["rules"]["region"]["required"]=true;
		}
		if(id==4){
			jQuery("#r_pais").show();
			jQuery("#r_region").show();
			jQuery("#r_ciudad").show();
			jQuery("#r_organizacion").show();
			acciones.filtraregiones();
			acciones.filtrapaises();
			acciones.filtraorganizaciones();
			acciones.filtraciudades();
			acciones.criterios["rules"]["ciudad"]["required"]=true;
			acciones.criterios["rules"]["empresar"]["required"]=true;
			acciones.criterios["rules"]["pais"]["required"]=true;
			acciones.criterios["rules"]["region"]["required"]=true;

		}		
		
		
		<? if((int)$usuario->id_pais>0){ ?>
		jQuery("[name='pais']").val();
		<? } ?>
		
		<? if((int)$usuario->id_region>0){ ?>
		jQuery("[name='region']").val();
		<? } ?>
		
		<? if((int)$usuario->id_ciudad>0){ ?>
		jQuery("[name='ciudad']").val();
		<? } ?>
		
		<? if((int)$usuario->id_unidad>0){ ?>
		jQuery("[name='empresar']").val();
		<? } ?>
		
		*/
		
		
		
		
		
		
	},
	filtraregiones:function(){
		jQuery("[name='region']").off();
		jQuery("[name='region']").on("change",function(){
			var idpais=jQuery("[name='pais']").val();
			var idregion=jQuery(this).val();
			if(parseInt(idpais)>0 && parseInt(idregion)>0){
 				jQuery("[name='ciudad']").html("<option>Seleccione una ciudad</option>");
				jQuery("[name='empresar']").html("<option>Seleccione una ciudad</option>");
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
							 var html='<option>Seleccione una ciudad</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='ciudad']").html(html);
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("[name='ciudad']").html("<option>Seleccione un departamento o región</option>");
  				jQuery("[name='empresar']").html("<option>Seleccione un departamento o región</option>");
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
				jQuery("[name='empresar']").html("<option>Seleccione un departamento o región</option>");
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
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("[name='region']").html("<option>Seleccione un pais</option>");
				jQuery("[name='ciudad']").html("<option>Seleccione un pais</option>");
				jQuery("[name='empresar']").html("<option>Seleccione un pais</option>");
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
 							 jQuery("[name='empresar']").html(html);
 						 }else{
							 
						 }
					}
				}).responseJSON;				
 			}else{
   				jQuery("[name='empresar']").html("<option>Seleccione una ciudad</option>");
			}
		});		
		
	},
	filtraorganizaciones:function(){
		
	}
}
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
<div id="formas" style="display:none">
 
 
	
	
	
	
	
	
	
	<div rel="participantes">
		<div class="list-group list-group-item" rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"apellido"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="apellido" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"primer_nombre"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="primer_nombre" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"email"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="email" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"genero"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="genero" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($genero as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"edad"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="edad" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($edad as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"antiguedad"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="antiguedad" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($antiguedad as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"ecivil"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="ecivil" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($ecivil as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"nacademico"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="nacademico" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($nacademico as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		
		<div class="list-group list-group-item" style="display:none">
			<div class="col-lg-5"><strong><?=$idioma->{"usuario"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="usuario" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		
		<div class="list-group list-group-item" rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"clave"}?></strong></div>
			<div class="col-lg-7"><input type="password" name="clave" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		 <div class="list-group list-group-item">
			<div class="col-lg-1"><input type="checkbox" name="retroalimentacion"  /></div>
			<div class="col-lg-11"><strong class="enunciadoretro"><?=$idioma->{"retroalimentacion"}?></strong></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5">
			<input type="button" value="<?=$idioma->{"agregar"}?>" rel="agregar_participantes" />
 			<input type="button" value="<?=$idioma->{"actualizar"}?>" rel="editar_participantes" id="keyid" style="display:none"/>
			</div>
			<div class="col-lg-7"><input type="button" value="<?=$idioma->{"cargamasiva"}?>" rel="cargamasiva" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		
  	</div> 
	
	<div rel="proyecto">
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombre_proyecto"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="nombreproyecto" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"emailproyecto"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="emailproyecto" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"tipoproyecto"}?></strong></div>
			<div class="col-lg-7">
				<select  name="tipoproyecto" style="width:100%;" />
				<? foreach($tipoproyecto as $tipo){ ?>
				<option value="<?=$tipo->id?>" ><?=$tipo->nombre?></option>
				<? }?>
				</select>
 			</div>
			<div style="clear:both"></div>
		</div>
	
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"bienvenida"}?></strong></div>
			<div class="col-lg-12"   >
				<textarea name="bienvenida" style="width:100%;height:100%" ></textarea>
 			</div>
			<div style="clear:both"></div>
		</div>
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><input type="button" value="<?=$idioma->{"guardar"}?>" rel="guardar_proyecto" /></div>
			<div class="col-lg-7"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_proyecto" /></div>
			<div style="clear:both"></div>
		</div>
	
	</div>
		
	<div rel="mailing">
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombremailing"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="nombre" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"participantes"}?></strong></div>
			<div class="col-lg-7">
				<input type="button"  rel="mailing_participantes"  value="<?=$idioma->participantes?>">
 			</div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"concopia"}?></strong></div>
			<div class="col-lg-7">
				<input type="text" autocomplete="off"  name="concopia" style="width:100%"  >
 			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"asunto"}?></strong></div>
			<div class="col-lg-12">
				<input type="text" autocomplete="off" name="asunto" style="width:100%" />
 			</div>
			<div style="clear:both"></div>
		</div>		
		
		
		
		
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"contenidomailing"}?></strong></div>
			<div class="col-lg-12"><strong><?=$idioma->{"nota"}?></strong><?=$idioma->{"notavariables"}?></div>
			<div class="col-lg-12">
				<textarea name="html" style="width:100%;height:250px" ></textarea>
 			</div>
			<div style="clear:both"></div>
		</div>

 		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"guardar"}?>" rel="mailing_guardar" /></div>
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="mailing_cancelar" /></div>
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"biblioteca"}?>" rel="mailing_biblioteca" /></div>
			<div class="col-lg-6"><input type="button" value="<?=$idioma->{"enviar"}?>" rel="mailing_enviar" /></div>

 			<div style="clear:both"></div>
		</div>
	
	</div>
	
	<div rel="relaciones">
	
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombredelarelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="nombredelarelacion" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"abreviacionrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="abreviacionrelacion" maxlength="6" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item" style="display:none">
			<div class="col-lg-5"><strong><?=$idioma->{"descripcionrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="descripcionrelacion" value="NR" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item" style="display:none">
			<div class="col-lg-5"><strong><?=$idioma->{"colorrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="color" name="colorrelacion" style="width:100%" /><input type="hidden" name="idorigen"   /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5">
			<input type="button" value="<?=$idioma->{"agregarrelacion"}?>" rel="agregar_relacion" />
			<input type="button" value="<?=$idioma->{"cancelarrelacion"}?>" rel="cancelar_relacion" />
			<input type="button" value="<?=$idioma->{"actualizarrelacion"}?>" rel="editar_relacion" id="keyid" style="display:none"/>
			</div>
			<div class="col-lg-7"></div>
			<div style="clear:both"></div>
		</div>
	
 	
	
	
	
	
	</div>
	
	<div rel="asignaciones">
	</div>
	
	<div rel="competencias">
		<div class="list-group list-group-item">
			
			<div class="col-lg-12">
				<div class="col-lg-12">
					<strong><?=$idioma->{"tipodeencuesta"}?></strong><div style="clear:both"></div>
				</div><br><br>
				<div style="clear:both"></div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-1">
					<input type="radio" name="tenc" value="1" checked="checked" ><div style="clear:both"></div>
				</div>
				<div class="col-lg-11">
					<strong><?=$idioma->{"mostrarcategorias"}?></strong><div style="clear:both"></div>
				</div><div style="clear:both"></div>
			</div>
			 
				
			<div class="col-lg-12">
				<div class="col-lg-1">
				<input type="radio" name="tenc"  value="2" ><div style="clear:both"></div>
				</div>
				<div class="col-lg-11">
				<strong><?=$idioma->{"ocultarcategorias"}?></strong><div style="clear:both"></div>
				</div><div style="clear:both"></div>
			</div>
				
			<div class="col-lg-12">
				<div class="col-lg-1">
				<input type="radio" name="tenc"   value="3" ><div style="clear:both"></div>
				</div>
				<div class="col-lg-11">
				<strong><?=$idioma->{"encuestaaleatoria"}?></strong><div style="clear:both"></div>
				</div><div style="clear:both"></div>
			</div>
				
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"competencia"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="nombrecompetencia" style="width:100%;" /></div>
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"descripcion"}?></strong></div>
			<div class="col-lg-7"><textarea name="descripcioncompetencia" style="width:100%;height:60px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"agregarcompetencia"}?>" rel="agregar_competencia" /></div>
			<div class="col-lg-7">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_competencia" />
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="eliminar_competencia" style="display:none" />
			<input type="hidden" name="keyid" />
			</div>
			<div class="col-lg-3"><input type="button" value="<?=$idioma->{"biblioteca_de_encuestas"}?>" rel="biblioteca_de_encuestas" /></div>
			<div style="clear:both"></div> 
		</div>
		
		<div class="list-group list-group-item" >
			<div class="col-lg-12"><a href="javascript:;" rel="agregarpregunta"><i class="fa fa-plus" aria-hidden="true"></i><b>Agregar pregunta</b></a></div>
			<div style="clear:both"></div> 
 		</div>
		<div class="list-group list-group-item" id="lista_preguntas">
			
			<div class="col-lg-12">
				
				<ul class="sortable">
					<li class="ui-state-default" rel="pregunta"> 1<br> <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
					<textarea style="width:94%;margin-right:5px;height:60px" ></textarea>
					<a href="javascript:;" rel="eliminarpregunta"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</li>

 
				</ul>			
				<div style="clear:both"></div>
			
			</div>
			<div style="clear:both"></div> 
		</div>
		
	</div>
	
	<div rel="escalas">
	
	
 
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"escala"}?></strong></div>
			<div class="col-lg-7"><textarea name="escala" style="width:100%;height:100px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"abreviacionescala"}?></strong></div>
			<div class="col-lg-7"><input type="text" autocomplete="off" name="abreviacionescala" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"preguntaescala"}?></strong></div>
			<div class="col-lg-7"><textarea name="preguntaescala" style="width:100%;height:100px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"rangoescala"}?></strong></div>
			<div class="col-lg-7"><select name="rangoescala" style="width:50px" >
			<option value="2">2 </option>
			<option value="3">3 </option>
			<option value="4">4 </option>
			<option value="5">5 </option>
			<option value="6">6 </option>
			<option value="7">7 </option>
			<option value="8">8 </option>
			<option value="9">9 </option>
			<option value="10">10 </option>
			<option value="11">11 </option>
			<option value="12">12 </option>
			</select>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="checkbox" name="aplicar"/></div>
			<div class="col-lg-10">
			<strong><?=$idioma->{"activarescala"}?></strong>
			</div>
 			<div style="clear:both"></div> 
 		</div>
		
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><input type="button" value="<?=$idioma->{"agregarescala"}?>" rel="agregar_escala" /></div>
			<div class="col-lg-7">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_escala" />
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="eliminar_escala" style="display:none" />
			<input type="hidden" name="keyid" />
			</div>
 			<div style="clear:both"></div> 
		</div>
		
		<div class="list-group list-group-item" >
			<div class="col-lg-12"><a href="javascript:;" rel="agregardescriptor"><i class="fa fa-plus" aria-hidden="true"></i><b>Agregar descriptor</b></a></div>
			<div style="clear:both"></div> 
 		</div>
		<div class="list-group list-group-item" id="lista_descriptores">
			
			<div class="col-lg-12">
				
				<ul class="sortable">
					<li class="ui-state-default" rel="descriptor"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
					<input type="text" autocomplete="off" style="width:94%;"/>
					<a href="javascript:;" rel="eliminardescriptor"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</li>

 
				</ul>			
				<div style="clear:both"></div>
			
			</div>
			<div style="clear:both"></div> 
		</div>	
 	
	</div>
	
	<div rel="preguntas_abiertas">
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"enunciado"}?></strong></div>
			<div class="col-lg-7"><textarea name="enunciado" style="width:100%;height:100px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 
		
 		<div class="list-group list-group-item">
			<div class="col-lg-4"><input type="button" value="<?=$idioma->{"agregarpa"}?>" rel="preguntas_abiertas_agregarpa" /></div>
			<div class="col-lg-4">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="preguntas_abiertas_cancelarpa" />
			
			<input type="hidden" name="keyid" />
			</div>
			<div class="col-lg-4">
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="preguntas_abiertas_eliminarpa"   />
			</div>
 			<div style="clear:both"></div> 
		</div>	
	
	
	
	
	
	</div>
	
	<div rel="evaluaciones_del_participante">
	</div>
	
	<div rel="reportes">
	</div>
 </div>
  
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
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/ciudades">
                                 <div>
                                    <strong><?=$idioma->{"ciudades"}?></strong>
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
 
		
		
		<input type="button" value="Volver" rel="volver" />
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Crear usuario
			  <div class="divContentWhite">
				<?php echo CHtml::form(array("admin/admusuario/crear"), 'post', array('class'=>'formCrear' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;',"autocomplete"=>"off")); ?>
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
 
 
 				  <tr valign="top">
					 <td><b>Nombre y apellido</b></td>
					 <td>
 						<input type="text" autocomplete="off" name="nombres" id="nombres" <? if(is_object($usuario)){?>value="<?=$usuario->nombres?>"<?}?> maxlength="255"   >
  					 </td>
				  </tr>
 
 				  <tr valign="top">
					 <td><b>Nombre de usuario</b></td>
					 <td>
						<b>Nombre de usuario que usara la persona para ingresar al sistema.</b><br />
						<input type="text" autocomplete="off" name="usuario" id="usuario" <? if(is_object($usuario)){?>value="<?=$usuario->alias?>"<?}?> maxlength="100"  >
						<br />
						<b>Solo se permiten letras, numeros, punto, guion bajo y guion medio. No se permiten tildes, ñ, espacios.
						</b>
					</td>
				  </tr>
				  <tr valign="top">
				     <td><b>No Documento</b></td>
					 <td>
					 	<input type="number" name="documento" id="documento" <? if(is_object($usuario)){?>value="<?=$usuario->documento?>"<?}?> maxlength="20" >
						<div id="errorsDiv_documento"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td><b>Contraseña</b></td>
					 <td>
					 	<input type="password" name="password" id="password" <? if(is_object($usuario)){?>value="<?=$usuario->clave?>"<?}?>  maxlength="20" >
						<div id="errorsDiv_password"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td><b>Repite Contraseña</b></td>
					 <td>
					 	<input type="password" name="password2" id="password2" <? if(is_object($usuario)){?>value="<?=$usuario->clave?>"<?}?> maxlength="20" >
						<div id="errorsDiv_password"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td><b>Email</b></td>
					 <td>
					 	<input type="email" name="email" id="email" <? if(is_object($usuario)){?>value="<?=$usuario->email?>"<?}?> maxlength="50"  >
						<div id="errorsDiv_email"></div>
					 </td>
				  </tr>
				  
 				  <tr valign="top">
				     <td><b>Perfil</b></td>
					 <td>
					 	<select id="perfil" name="perfil">
							<option  >Seleccione un perfil de ususario</option>
						<?
							foreach($perfiles as $datap){
								$selected='';
								if(is_object($usuario)){
									if($datap->id==$usuario->perfil){
										$selected=' selected="selected" ';
									}
									
								}
								echo '<option value="'.$datap->id.'" '.$selected.'>'.$datap->nombre.'</option>';
							}
						?>
						</select>
					 </td>
				  </tr>				  
				  
				  
				  
				  
				  
				  
				  
				  
				  <tr valign="top" id="r_pais" style="display:none">
				     <td><b>Pais</b></td>
					 <td>
					 	
						<select name="pais"  autocomplete="off" >
						<option value="-1"  selected='selected'>
						Seleccione...
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
 						<div id="errorsDiv_email"></div>
					 </td>
				  </tr>				  
				  <tr valign="top"  id="r_region" style="display:none">
				     <td><b>Región o departamento</b></td>
					 <td>
					 	
						<select name="region"  autocomplete="off" >
							<option>Seleccione un pais</option>
						</select> 						
 						<div id="errorsDiv_email"></div>
					 </td>
				  </tr>	
				  <tr valign="top"  id="r_ciudad" style="display:none">
				     <td><b>Ciudad o municipio</b></td>
					 <td>
					 	
						<select name="ciudad" autocomplete="off" >
							<option>Seleccione un pais</option>
						</select> 						
 						<div id="errorsDiv_email"></div>
					 </td>
				  </tr>	


 				  <tr valign="top"  id="r_organizacion" style="display:none">
				     <td><b>Organización</b></td>
					 <td>
					 	 
						<?	
							 
							
								echo '<select name="empresar"><option value="-1">Seleccione un pais</option>';
								foreach($empresas as $datae){
 									 
									echo '<option value="'.$datae->id.'" '. $che.' />'.$datae->nombre.'</option>';
									$contar++;
								}							
							echo '</select>';
 							 
						?><br><div style="clear:both"></div>
 						<input type="hidden" name="save" />
 						<input type="hidden" name="idusuario" id="idusuario" value="<?=$idusuario?>" />
					 </td>
					 
				  </tr>
 
 				  <tr valign="top">
				     <td></td>
					 <td><input type="submit" value="Guardar"   /></td>
				  </tr>
                </table>
 				</form>
			  </div>
			</div>
 	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
								
								 
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



	
	
	
	
	
	
	
	