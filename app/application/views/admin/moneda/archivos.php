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
	catalogo:function(){
		var res=jQuery.ajax({ 
		type: "POST",
		dataType: "json",
		async: false,
		url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
		data:{
 		mode:"get",
		get:"bibliotecaencuestas"
		},
		success:function(res){
		if(res[0]=="ok"){
			var html="";
			jQuery.each(res[1],function(k,d){
				var competencias='<ul style="padding-left:0px">';
				jQuery.each(d["competencias"],function(indice,valores){
					var preguntas='<ul>';
					jQuery.each(valores["preguntas"],function(indicep,valoresp){
						preguntas+='<li  style="cursor:pointer;display:none" rel="comp_'+valores["id"]+'" id="pregunta_'+valoresp["keyid"]+'">'+valoresp["enunciado"]+'</li>';
					});
					preguntas+='</ul>';
					competencias+='<li class="list-group-item ui-state-default"  style="background-color:#fff;border-color:#fafafa"  id="'+valores["id"]+'" rel="enc_'+d["id"]+'" ><strong style="cursor:pointer; " id="comp_'+valores["id"]+'">'+valores["nombre"]+'</strong><div style="clear:both"></div>'+preguntas+'</li>';
				});
				competencias+='</ul>';
				//html+='<li class="list-group-item ui-state-default"  ><input type="checkbox" id="selallcomp_'+d["id"]+'"><strong style="cursor:pointer" id="enc_'+d["id"]+'">'+d["nombre"]+'</strong><div style="clear:btoh"></div>'+competencias+'</li>';
				html+=competencias;
			})
			//html+='</ul></div></div></div>';
			jQuery("#formulario").html("<div   style='overflow:hidden;height:86%'>"+html+"</div>");
 			acciones.competencias();
			
		}
		}
		});	

	},
	competencias:function(){
 		
 		jQuery("[id^='enc_']").off();
		jQuery("[id^='enc_']").on("click",function(){ 
			var id=jQuery(this).attr("id");
			jQuery("[rel^='enc_']").hide();
			jQuery("[rel='"+id+"']").fadeIn();
  		});
		
		
 		jQuery("[id^='comp_']").off();
		jQuery("[id^='comp_']").on("click",function(){ 
			var id=jQuery(this).attr("id");
			//jQuery("[rel^='comp_']").hide();
			if(jQuery("[rel='"+id+"']:eq(0)").is(":visible")){
				jQuery("[rel='"+id+"']").fadeOut();
			}else{jQuery("[rel='"+id+"']").fadeIn();}
  		});
		
		jQuery("[id^='selallcomp_']").off();
		jQuery("[id^='selallcomp_']").on("click",function(){ 
			var idenc=jQuery(this).attr("id").split("_")[1];
			var objr=jQuery(this);
			
			jQuery.each(jQuery("[rel='enc_"+idenc+"']"),function(k,c){
				if(objr.is(":checked")){
					jQuery(c).find("input").addClass("selected_comp")
 				}else{
					jQuery(c).find("input").removeClass("selected_comp");
				}
					
			});
			
		});
		 
 	},
	dataproyect:{"nombre":"","clave":"","key":"","bienvenida":"","tipoproyecto":""}
	
}


var idioma=jQuery.parseJSON( '<?=json_encode($idioma)?>');
//console.log(idioma); 
 jQuery(function(){
	 
 	//acciones.catalogo();

	
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

<?php echo CHtml::form(array("admin/evaluacion/proyecto"), 'post', array('class'=>'saveproyect', 'id'=>'saveproyect','style'=>'display: none')); ?>

</form>
<? //printVar($idioma->{"nombredelarelacion"}); ?>
<div id="formas" style="display:none">
 
	<div rel="cargar">
		<?php echo CHtml::form(array("admin/evaluacion/proyecto"), 'post', array('class'=>'formulario' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;','enctype'=>'multipart/form-data')); ?>
		 
		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-12"><?=$idioma->{"indicaciones"}?></div>
 				<div style="clear:both"></div>
			</div>		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"archivocsv"}?></strong></div>
				<div class="col-lg-7"><input name="archivo" type="file" id="imagen" /><input name="keyproyecto" type="hidden" id="keyproyecto" /></div>
				<div style="clear:both"></div>
			</div>		
		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"seleccionetipocsv"}?></strong></div>
				<div class="col-lg-7">
					<select name="delimitador"> 
					<option value=";">;</option>
					<option value=",">,</option>
					</select>				
				</div>
				<div style="clear:both"></div>
			</div>		
		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-12"><div class="messages"></div><div class="showImage"></div></div>
 				<div style="clear:both"></div>
			</div>		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-5"><input type="button" value="<?=$idioma->subir?>" /><br />
				<input type="hidden" name="save" /></div>
				<div class="col-lg-7"> </div>
				<div style="clear:both"></div>
			</div>		
 			
		</form>
 	</div>
	
	
	
	
	
	
	
	<div rel="participantes">
		<div class="list-group list-group-item" rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"apellido"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="apellido" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"primer_nombre"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="primer_nombre" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"email"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="email" style="width:100%" /></div>
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
			<div class="col-lg-7"><input type="text" name="usuario" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		
		<div class="list-group list-group-item" rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"clave"}?></strong></div>
			<div class="col-lg-7"><input type="password" name="clave" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		 <div class="list-group list-group-item">
			<div class="col-lg-1"><input type="checkbox" name="retroalimentacion"  /></div>
			<div class="col-lg-11"><strong><?=$idioma->{"retroalimentacion"}?></strong></div>
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
			<div class="col-lg-7"><input type="text" name="nombreproyecto" style="width:100%" /></div>
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
			<div class="col-lg-6"><input type="button" value="<?=$idioma->{"guardar"}?>" rel="guardar_proyecto" /></div>
			<div class="col-lg-6"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_proyecto" /></div>
			<div style="clear:both"></div>
		</div>
	
	</div>
		
	<div rel="mailing">
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombremailing"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="nombre" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
 		<div class="list-group list-group-item">
			<div class="col-lg-6"><strong><?=$idioma->{"participantes"}?></strong></div>
			<div class="col-lg-6">
				<input type="button"  rel="mailing_participantes"  value="<?=$idioma->participantes?>">
 			</div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"concopia"}?></strong></div>
			<div class="col-lg-7">
				<input type="text"  name="concopia" style="width:100%"  >
 			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"asunto"}?></strong></div>
			<div class="col-lg-12">
				<input type="text" name="asunto" style="width:100%" />
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
			<div class="col-lg-3"><input type="button" value="<?=$idioma->{"guardar"}?>" rel="mailing_guardar" /></div>
			<div class="col-lg-3"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="mailing_cancelar" /></div>
			<div class="col-lg-3"><input type="button" value="<?=$idioma->{"enviar"}?>" rel="mailing_enviar" /></div>
			<div class="col-lg-3"><!--input type="button" value="<?=$idioma->{"biblioteca"}?>" rel="mailing_biblioteca" /--></div>
 			<div style="clear:both"></div>
		</div>
	
	</div>
	
	<div rel="relaciones">
	
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombredelarelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="nombredelarelacion" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"abreviacionrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="abreviacionrelacion" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"descripcionrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="descripcionrelacion" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
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
			<div class="col-lg-7"><textarea name="nombrecompetencia" style="width:100%;height:100px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"descripcion"}?></strong></div>
			<div class="col-lg-7"><textarea name="descripcioncompetencia" style="width:100%;height:100px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"agregarcompetencia"}?>" rel="agregar_competencia" /></div>
			<div class="col-lg-6">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_competencia" />
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="eliminar_competencia" style="display:none" />
			<input type="hidden" name="keyid" />
			</div>
			<div class="col-lg-4"><input type="button" value="<?=$idioma->{"biblioteca_de_encuestas"}?>" rel="biblioteca_de_encuestas" /></div>
			<div style="clear:both"></div> 
		</div>
		
		<div class="list-group list-group-item" >
			<div class="col-lg-12"><a href="javascript:;" rel="agregarpregunta"><i class="fa fa-plus" aria-hidden="true"></i><b>Agregar pregunta</b></a></div>
			<div style="clear:both"></div> 
 		</div>
		<div class="list-group list-group-item" id="lista_preguntas">
			
			<div class="col-lg-12">
				
				<ul class="sortable">
					<li class="ui-state-default" rel="pregunta"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
					<textarea style="width:94%;margin-right:5px;height:100px" ></textarea>
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
			<div class="col-lg-7"><input type="text" name="abreviacionescala" style="width:100%" /></div>
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
			<div class="col-lg-6"><input type="button" value="<?=$idioma->{"agregarescala"}?>" rel="agregar_escala" /></div>
			<div class="col-lg-6">
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
					<input type="text" style="width:94%;"/>
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
			<div class="col-lg-6"><input type="button" value="<?=$idioma->{"agregarpa"}?>" rel="agregar_pa" /></div>
			<div class="col-lg-6">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_pa" />
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="eliminar_pa" style="display:none" />
			<input type="hidden" name="keyid" />
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
							
								<div class="pull-left" > <strong><?=$idioma->{"lista_maestra"}?></strong><br>
									<?=$idioma->descripcionlista_maestra?>
									
								</div>
								
								
								
								 
							   <div style="clear:both"></div>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body" id="formulario">
								 
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
