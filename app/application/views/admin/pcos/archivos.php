<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<?
					$urls=Yii::app()->baseUrl."/files/pcos/".$url."/";

	?>
<style type="text/css"> 
	.navbar-default{
		z-index:999;
	}
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
	
	
.custom-file-input {
		display: inline-block;
		position: relative;
		color: #533e00;
	}
	.custom-file-input input {
		visibility: hidden;
		width: 150px;
	}
	.custom-file-input:before {
		content: 'Choose File';
		display: block;
		background: -webkit-linear-gradient( -180deg, #ffdc73, #febf01);
		background: -o-linear-gradient( -180deg, #ffdc73, #febf01);
		background: -moz-linear-gradient( -180deg, #ffdc73, #febf01);
		background: linear-gradient( -180deg, #ffdc73, #febf01);
		border: 3px solid #dca602;
		border-radius: 10px;
		padding: 5px 0px;
		outline: none;
		white-space: nowrap;
		cursor: pointer;
		text-shadow: 1px 1px rgba(255,255,255,0.7);
		font-weight: bold;
		text-align: center;
		font-size: 10pt;
		position: absolute;
		left: 0;
		right: 0;
	}
	.custom-file-input:hover:before {
		border-color: #febf01;
	}
		.custom-file-input:active:before {
		background: #febf01;
	}
	.file-blue:before {
		content: 'Buscar archivo';
		background: -webkit-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: -o-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: -moz-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: linear-gradient( -180deg, #99dff5, #02b0e6);
		border-color: #57cff4;
		color: #FFF;
		text-shadow: 1px 1px rgba(000,000,000,0.5);
	}
	.file-blue:hover:before {
		border-color: #02b0e6;
	}
	.file-blue:active:before {
		background: #02b0e6;
	}	
	
	
</style>
 <script>
$(document).ready(function(){
		$( "#fechainicio" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
		$( "#fechafin" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
		$( ".fechaformat" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd" });
	
		$( "#fechainicio,#fechafin" ).change(function(){
			var test1=jQuery("#fechainicio").val().split("-");
			var test2=$( "#fechafin" ).val().split("-");
			var fechaInicial = new Date(test1[0], test1[1], test1[2]), 
			valorFechai = fechaInicial.valueOf(),
			fechaFinal = new Date(test2[0], test2[1], test2[2]),
			valorFechaf = fechaFinal.valueOf();
			diferencia=valorFechaf-valorFechai;
			if(diferencia<0){
				alert("La fecha final debe ser mayor que la fecha inicial");
				jQuery(this).val("");
			}
		});	
	
	
	
	
	
 
    $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
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
    });
 
    //al enviar el formulario
     $('#guardar,#actualizar').click(function(event){
		 event.preventDefault();
		 var item=jQuery(this).attr("id");
		if(item=="guardar"){
			jQuery("#id").val(""); 
		}
        //información del formulario
		var nombre=jQuery("[name='nombre']").val();	
		if(nombre!=""){
			if(jQuery("[name='fechafin']").val()!="" &&  jQuery("[name='fechainicio']").val()==""){
				alert("Por favor ingrese la fecha de inicio");
			}else{
 				var formData = new FormData($(".formulario")[0]);
				var message = ""; 
				//hacemos la petición ajax  
				$.ajax({
					url: $(".formulario").attr("action"),  
					type: 'POST',
					// Form data
					//datos del formulario
					data: formData,
					//necesario para subir archivos via ajax
					cache: false,
					dataType: "json",
					contentType: false,
					processData: false,
					//mientras enviamos el archivo
					beforeSend: function(){
						if(item=="guardar"){
							message = $("<span class='before'>Subiendo archivo, por favor espere...</span>");
						}else{
							message = $("<span class='before'>Enviando datos, por favor espere...</span>");
						}
						showMessage(message)        
					},
					//una vez finalizado correctamente
					success: function(data){console.log(data);
					
						if(item=="guardar"){
							message = $("<span class='success'>El archivo se ha cargado correctamente.</span>");
							jQuery("input[type='text']").val("");
						}else{
							message = $("<span class='before'>Los datos han sido actualizados</span>");
						}
					
						showMessage(message);
 						var html='';
						var images=["jpg","jpeg","png","gif","gift"];
						var documentos=["doc","docx","xls","xlsx","pdf","ppt","pptx"];
 						jQuery.each(data[0],function(k,d){
							var extension=(d.descriptcion).split(".");
							extension=extension[(extension.length)-1];
							extension=extension.toLowerCase();
							if(images.indexOf(extension)>-1){	
								html+='<div class="col-xs-4 col-md-3" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;" id="element_'+d.id+'">';
									html+='<img src="<?=$urls?>/'+d.descriptcion+'" style="width:98%;height:80%;" id="'+d.id+'"  />';
									html+='<div style="margin-left: 30%;width: 100%;">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/add.gif" rel="accion_add" id="'+d.id+'" style="cursor:pointer;">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" rel="accion_update" id="'+d.id+'" style="cursor:pointer;">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" rel="accion_del" id="'+d.id+'" style="cursor:pointer;">';
									html+='</div>';
									html+='<div style="clear:both"></div><span style="font-size:9pt"><b>'+d.nombre+'</b></span>';
 								html+='</div>';
							}else if(documentos.indexOf(extension)>-1){	
								html+='<div class="col-xs-4 col-md-3" style="height:190px; padding: 0.3em; border: 1px solid #EDEDFB;" id="element_'+d.id+'">';
								html+='<img src="<?=Yii::app()->baseUrl?>/img/'+extension+'.png" style="width:98%;height:80%;cursor:pointer"  id="'+d.id+'"  />';
									html+='<div style="margin-left: 30%;width: 100%;">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/add.gif" rel="accion_add" id="'+d.id+'" style="cursor:pointer;">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" rel="accion_update" id="'+d.id+'" style="cursor:pointer;">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" rel="accion_del" id="'+d.id+'" style="cursor:pointer;">';
									html+='</div>';
								html+='<div style="clear:both"></div><span style="font-size:9pt"><b>'+d.nombre+'</b></span>';
 								html+='</div>';
							}
						});
						
						jQuery("#arch").html(html+'<div  id="results" style="display:none">'+data[1]+'</div>');actions();
						jQuery("#activos_arch").html(data[1]); 
						 
						
					},
					//si ha ocurrido un error
					error: function(){
						message = $("<span class='error'>Ha ocurrido un error.</span>");
						showMessage(message);
					}
				});
				
			}
		}else{
 			alert("Por favor escriba el nombre.");
		}
    });
	actions();
	 href();
});

function actions(){
	
	jQuery("[rel^='accion_']").click(function(event){
		event.preventDefault();
		var option=jQuery(this).attr("rel").split("_")[1];
		var id=jQuery(this).attr("id");
		switch(option){
			case "add":
  			
				var datas=jQuery("#results").html();
				var temp=jQuery.parseJSON(datas);
				var atoms=eval('temp.id_'+id);
				jQuery(this).parent().parent().remove();
				
				var images=["jpg","jpeg","png","gif","gift"];
				var documentos=["doc","docx","xls","xlsx","pdf","ppt","pptx","html","htm","txt"];
				var extension=(atoms.descriptcion).split(".");
				extension=extension[(extension.length)-1];
				extension=extension.toLowerCase();
				var archivo="<?=$urls?>/"+atoms.descriptcion;
				if(documentos.indexOf(extension)>-1){
					archivo="<?=Yii::app()->baseUrl?>/img/"+extension+".png";
				}
 				
 				var html='<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;">';
					html+='<img src="'+archivo+'" style="width:100%;height:80%;cursor:pointer" id="'+atoms.id+'" />';
						html+='<div style="margin-left: 30%;width: 100%;">';
 						html+='<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" rel="accion_update2" id="'+atoms.id+'" style="cursor:pointer;">';
						html+='<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" rel="accion_remove" id="'+atoms.id+'" style="cursor:pointer;">';
						html+='</div>';
					html+='<div style="clear:both"></div><span style="font-size:9pt"><b>'+atoms.nombre+'</b></span>';
 					html+='</div>';	
				if(jQuery("#activos").find("#"+atoms.id).size()==0){
 					jQuery("#activos").append(html);
 				
					if($(".acciones").find("[name='id']").size()==0){console.log("NADA");
						$(".acciones").append('<input type="hidden" name="id" value="'+atoms.id+'" />');
						$(".acciones").append('<input type="hidden" name="tipo" value="<?=$url?>" />');
						$(".acciones").append('<input type="hidden" name="action" value="add" />');
					}else{
						$(".acciones").find("[name='id']").val(id);
						$(".acciones").find("[name='tipo']").val('<?=$url?>');
						$(".acciones").find("[name='action']").val("add");
					}
					var formData = new FormData($(".acciones")[0]);
 					$.ajax({
						url: $(".acciones").attr("action"),  
						type: 'POST',
						// Form data
						//datos del formulario
						data: formData,
						//necesario para subir archivos via ajax
						cache: false,
						dataType: "html",
						contentType: false,
						processData: false,
						//mientras enviamos el archivo
						beforeSend: function(){
							message = $("<span class='before'>Agregado a la lista</span>");
							showMessage(message)        
						},
						//una vez finalizado correctamente
						success: function(data){
								message = $("<span class='success'>El elemento ha sido agregado</span>");
 								showMessage(message);
						
						},
							//si ha ocurrido un error
						error: function(){
								message = $("<span class='error'>Ha ocurrido un error.</span>");
								showMessage(message);
						}
					});
 					actions();
				}else{
					console.log("NO HAY NADA");
				
				}
				
 				
 			break;
			case "remove":
				var datas=jQuery("#activos_arch").html();
				var temp=jQuery.parseJSON(datas);
				var atoms=eval('temp.id_'+id);
 				var documentos=["doc","docx","xls","xlsx","pdf","ppt","pptx","html","htm","txt"];
				var extension=(atoms.descriptcion).split(".");
				extension=extension[(extension.length)-1];
				extension=extension.toLowerCase();
				var archivo="<?=$urls?>/"+atoms.descriptcion;
				if(documentos.indexOf(extension)>-1){
					archivo="<?=Yii::app()->baseUrl?>/img/"+extension+".png";
				}
 				
 				jQuery(this).parent().parent().remove();
 				var html='<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;"  id="element_'+atoms.id+'">';
					html+='<img src="'+archivo+'" style="width:100%;height:80%;cursor:pointer" id="'+atoms.id+'" />';
					html+='<div style="margin-left: 30%;width: 100%;">';
						html+='<img src="<?=Yii::app()->baseUrl?>/img/add.gif" 	rel="accion_add" 	id="'+atoms.id+'" style="cursor:pointer;float:left;margin-left:1px">';
						html+='<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" 	rel="accion_update" id="'+atoms.id+'" style="cursor:pointer;float:left;margin-left:1px">';
						html+='<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" 	rel="accion_del"    id="'+atoms.id+'" style="cursor:pointer;float:left;margin-left:1px">';
 					html+='</div>';
					html+='<div style="clear:both"></div><span style="font-size:9pt"><b>'+atoms.nombre+'</b></span>';
  					html+='</div>';
					if(jQuery("#arch").find("#element_"+atoms.id).size()==0){
						jQuery("#arch").append(html);
						if($(".acciones").find("[name='id']").size()==0){console.log("NADA");
							$(".acciones").append('<input type="hidden" name="id" value="'+atoms.id+'" />');
							$(".acciones").append('<input type="hidden" name="tipo" value="<?=$url?>" />');
							$(".acciones").append('<input type="hidden" name="action" value="remove" />');
						}else{
							$(".acciones").find("[name='id']").val(id);
							$(".acciones").find("[name='tipo']").val('<?=$url?>');
							$(".acciones").find("[name='action']").val("remove");
						}
						var formData = new FormData($(".acciones")[0]);
						$.ajax({
							url: $(".acciones").attr("action"),  
							type: 'POST',
							// Form data
							//datos del formulario
							data: formData,
							//necesario para subir archivos via ajax
							cache: false,
							dataType: "html",
							contentType: false,
							processData: false,
							//mientras enviamos el archivo
							beforeSend: function(){
								message = $("<span class='before'>Removiendo de la lista</span>");
								showMessage(message)        
							},
							//una vez finalizado correctamente
							success: function(data){
								message = $("<span class='success'>El elemento ha sido removido</span>");
 								showMessage(message);
							},
								//si ha ocurrido un error
							error: function(){
									message = $("<span class='error'>Ha ocurrido un error.</span>");
									showMessage(message);
							}
						});						
						
						actions();
					}
 			break;
			case "update2":
				var datas=jQuery("#activos_arch").html();
				var temp=jQuery.parseJSON(datas);
				var atoms=eval('temp.id_'+id);
				jQuery("#nombre").val(atoms.nombre);
				jQuery("#id").val(atoms.id);
				jQuery("#fechainicio").val(atoms.fechaini);
				jQuery("#fechafin").val(atoms.fechafin);
				jQuery("#actualizar").show();
				jQuery("#cancelar").show();
				jQuery("#guardar").hide();
				jQuery("#cancelar").click(function(){
					jQuery("#nombre").val("");
					jQuery("#id").val("");
					jQuery("#fechainicio").val("");
					jQuery("#fechafin").val("");
					jQuery("#actualizar").hide();
					jQuery(this).hide();
					jQuery("#guardar").show();
				})
			
			
			break;
			case "update":
				var datas=jQuery("#results").html();
				var temp=jQuery.parseJSON(datas);
				var atoms=eval('temp.id_'+id);
				jQuery("#nombre").val(atoms.nombre);
				jQuery("#id").val(atoms.id);
				jQuery("#fechainicio").val(atoms.fechaini);
				jQuery("#fechafin").val(atoms.fechafin);
				jQuery("#actualizar").show();
				jQuery("#cancelar").show();
				jQuery("#guardar").hide();
				jQuery("#cancelar").click(function(){
					jQuery("#nombre").val("");
					jQuery("#id").val("");
					jQuery("#fechainicio").val("");
					jQuery("#fechafin").val("");
					jQuery("#actualizar").hide();
					jQuery(this).hide();
					jQuery("#guardar").show();
				})
				
			break;
			
			case "del":
				if(confirm("Desea eliminar definitivamente este archivo?")){ 
					if($(".acciones").find("[name='id']").size()==0){
						$(".acciones").append('<input type="hidden" name="id" value="'+id+'" />');
						$(".acciones").append('<input type="hidden" name="tipo" value="<?=$url?>" />');
						$(".acciones").append('<input type="hidden" name="action" value="del" />');
					}else{
						$(".acciones").find("[name='id']").val(id)
						$(".acciones").find("[name='tipo']").val('<?=$url?>')
						$(".acciones").find("[name='action']").val("del")
					}
					var formData = new FormData($(".acciones")[0]);
 					$.ajax({
						url: $(".acciones").attr("action"),  
						type: 'POST',
						// Form data
						//datos del formulario
						data: formData,
						//necesario para subir archivos via ajax
						cache: false,
						dataType: "json",
						contentType: false,
						processData: false,
						//mientras enviamos el archivo
						beforeSend: function(){
							message = $("<span class='before'>Eliminando archivo...</span>");
							showMessage(message)        
						},
						//una vez finalizado correctamente
						success: function(data){
							message = $("<span class='success'>El archivo ha sido eliminado...</span>");
							showMessage(message)        
							var html='';
							var images=["jpg","jpeg","png","gif","gift"];
							var documentos=["doc","docx","xls","xlsx","pdf","ppt","pptx"];
  							jQuery.each(data[0],function(k,d){
  								var extension=(d.descriptcion).split(".");
								extension=extension[(extension.length)-1];
								extension=extension.toLowerCase();
								if(images.indexOf(extension)>-1){	
									html+='<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;" id="element_'+d.id+'">';
										html+='<img src="<?=$urls?>/'+d.descriptcion+'" style="width:100%;height:80%;" id="'+d.id+'"  />';
										html+='<div style="margin-left: 30%;width: 100%;">';
										html+='<img src="<?=Yii::app()->baseUrl?>/img/add.gif" rel="accion_add" id="'+d.id+'" style="cursor:pointer;">';
										html+='<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" rel="accion_update" id="'+d.id+'" style="cursor:pointer;">';
										html+='<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" rel="accion_del" id="'+d.id+'" style="cursor:pointer;">';
										html+='</div>';
										html+='<div style="clear:both"></div><span style="font-size:9pt"><b>'+d.nombre+'</b></span>';
									html+='<div style="clear:both"></div></div>';
								}else if(documentos.indexOf(extension)>-1){	
									html+='<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;" id="element_'+d.id+'">';
									html+='<img src="<?=Yii::app()->baseUrl?>/img/'+extension+'.png" style="width:100%;height:80%;cursor:pointer"  id="'+d.id+'"  />';
										html+='<div style="margin-left: 30%;width: 100%;">';
										html+='<img src="<?=Yii::app()->baseUrl?>/img/add.gif" rel="accion_add" id="'+d.id+'" style="cursor:pointer;">';
										html+='<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" rel="accion_update" id="'+d.id+'" style="cursor:pointer;">';
										html+='<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" rel="accion_del" id="'+d.id+'" style="cursor:pointer;">';
										html+='</div>';
									html+='<div style="clear:both"></div><span style="font-size:9pt"><b>'+d.nombre+'</b></span>';
									html+='<div style="clear:both"></div></div>';
								}
							});
							
						jQuery("#arch").html(html+'<div  id="results" style="display:none">'+data[1]+'</div>');actions();
						jQuery("#activos_arch").html(data[1]); 

						},
						//si ha ocurrido un error
						error: function(){
							message = $("<span class='error'>Ha ocurrido un error.</span>");
							showMessage(message);
						}
					});	
 				}
			break;
			
		}
		
	});
	
	
}
 

//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
          case 'zip':
            return true;
        break;
        default:
            return false;
        break;
    }
}
function href(){
	jQuery("[rel^='href_']").click(function(){
		var h=jQuery(this).attr("rel").split("_")[1];
		document.location="<?=Yii::app()->baseUrl?>/index.php/admin/pcos/"+h;
	});
	
}
</script>
<?php echo CHtml::form(array("admin/pcos/action"), 'post', array('class'=>'acciones' , 'id'=>'acciones')); ?>
</form>
<div id="content" style="padding:10px">
	<div class="col-xs-12  col-md-6">
		<div class="divContentBlue">
		
		<!--input type="button" value="Gestores" style="float:left;" rel="href_gestores"/>
		<input type="button" value="Empresas" rel="href_empresas" style="float:left;margin-left:10px"/>
		<input type="button" value="Documentos" rel="href_documentos" style="float:left;margin-left:10px"/-->
		<div style="clear:both"></div>
		
		
		 <h3>Adición de <?=$titulo?></h3><div style="clear:both"></div>
			<div class="divContentWhite">
				<?php echo CHtml::form(array("admin/pcos/filesup"), 'post', array('class'=>'formulario' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;','enctype'=>'multipart/form-data')); ?>
					<center>	 
					<table>
					<tr>
						<td><b>Nombre:</b></td>
						<td><input name="nombre" type="text" id="nombre" /><input name="id" type="hidden" id="id" /></td>
					</tr>
					<tr>
					  <td><b>Fecha de inicio:</b></td>
					  <td><input type="text" id="fechainicio" name="fechainicio"   />
						  </td>
					</tr>
					 
					<tr>
					  <td><b>Fecha de finalización:</b></td>
					  <td><input type="text" id="fechafin" name="fechafin"   />
						  </td>
					</tr>
 					
					
					<tr>
						<td><b>Archivo:</b></td>
						<td><label  class="custom-file-input file-blue">
							<input name="archivo" type="file" id="imagen" />
							</label>
						</td>
					</tr>
					</table><br>
					<input type="button" value="Guardar" id="guardar"/>
					<input type="button" value="Actualizar" id="actualizar" style="display:none;"/>
					<input type="button" value="Cancelar" id="cancelar" style="display:none"/><br />
					<input type="hidden" name="save" />
					<input type="hidden" name="idorg" value="<?=$idorg?>" />
					<input type="hidden" name="tipo" value="<?=$url?>" />
					</center>
				</form>
				<br />
				<div class="messages"></div><div style="clear:both"></div><br>
				<!--div para visualizar en el caso de imagen-->
					
				<div style="clear:both"></div>
			</div>
			<div class="divContentBlue">
				<h3>Activos</h3><div style="clear:both"></div>
				<div  class="divContentWhite" >
					<div id="activos">

						<?
							$images=array("jpg","jpeg","png","gif");
							$docs=array("pdf","ppt","pptx","doc","docx","xls","xlsx","html","htm","txt");
							foreach($activos[0] as $data){ 
								$archivor=$urls."/".$data->descriptcion;
								$extencion=explode(".",$data->descriptcion);
								$extencion=strtolower($extencion[count($extencion)-1]);
								if(in_array($extencion,$docs)){
									$archivor=Yii::app()->baseUrl."/img/".$extencion.".png";
								}
								?>
								<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;">
									<img src="<?=$archivor?>" style="width:100%;height:80%;cursor:pointer" id="<?=$data->id?>" />
									
									<div style="margin-left: 30%;width: 100%;">
 										<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" 	rel="accion_update2" id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
										<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" 	rel="accion_remove"    id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
									</div><div style="clear:both"></div>
									<span style="font-size:9pt"><b><label title="<?=$data->nombre?>"><?= substr($data->nombre, 0, 14)."..."?></label></b></span>
 								</div> 	
						<? }
							if($activos[1]=="[]"){
								$activos[1]=$json;
							}
 						?>

						<div style="display:none" id="activos_arch"><?=$activos[1]?></div><div style="clear:both"></div>
					</div>						
					<div style="clear:both"></div>
	
				</div>
				<div style="clear:both"></div>
			</div>			
			
			
			
			
			
			
			
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="divContentBlue  ">
			<h3>Archivos</h3><div style="clear:both"></div>
			<div class="divContentWhite" style="padding-top:5px;padding-bottom: 45px;" >
				<div id="arch">
				<? 
				$images=array("jpg","jpeg","png","gif");
				$docs=array("pdf","ppt","pptx","doc","docx","xls","xlsx","html","htm","txt");
 				foreach($archivos[0] as $data){
 					$extencion=explode(".",$data->descriptcion);
					$extencion=strtolower($extencion[count($extencion)-1]);
					?>
					
					<?
					if(in_array($extencion,$images)){
					?>
					<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;" id="element_<?=$data->id?>">
						<img src="<?=$urls?>/<?=$data->descriptcion?>" style="width:100%;height:80%;cursor:pointer" id="<?=$data->id?>" />
						<div style="margin-left: 30%;width: 100%;">
 							<img src="<?=Yii::app()->baseUrl?>/img/add.gif" 	rel="accion_add" 	id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
							<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" 	rel="accion_update" id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
							<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" 	rel="accion_del"    id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
						</div><div style="clear:both"></div>
						<span style="font-size:9pt"><b><?=$data->nombre?></b></span>
  					</div>
					<? 
					}else if(in_array($extencion,$docs)){
					?>
					<div class="col-xs-4 col-md-3 col-sm-2" style="height:190px;padding: 0.3em; border: 1px solid #EDEDFB;"  id="element_<?=$data->id?>">
						<img src="<?=Yii::app()->baseUrl?>/img/<?=$extencion?>.png" style="width:100%;height:80%;cursor:pointer" id="<?=$data->id?>"  /><br>
						<div style="margin-left: 30%;width: 100%;">
 							<img src="<?=Yii::app()->baseUrl?>/img/add.gif" 	rel="accion_add" 	id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
							<img src="<?=Yii::app()->baseUrl?>/img/edit.gif" 	rel="accion_update" id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
							<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" 	rel="accion_del"    id="<?=$data->id?>" style="cursor:pointer;float:left;margin-left:1px">
						</div><div style="clear:both"></div>
 						<span style="font-size:9pt"><b><?=$data->nombre?></b></span>
					</div>
					<? 
					} 
					?>
					
					<?
				} 
 				if($archivos[1]=="[]"){
					$archivos[1]=$json;
				}
				?><div   id="results" style="display:none"><?=$archivos[1]?></div>
				</div>
				<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div><div style="clear:both"></div>
</div>