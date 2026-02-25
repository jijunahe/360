<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>  
<style type="text/css"> 
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
	<script>
$(document).ready(function(){
 
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
		if(fileExtension.toUpperCase()!="CSV"){
			message = $("<span class='error'>El archivo debe ser de formato CSV</span>");
			showMessage(message);
			
		}
    });
 
    //al enviar el formulario
    $(':button').click(function(){
		if(fileExtension.toUpperCase()=="CSV"){
			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = ""; 
			//hacemos la petición ajax  
			$.ajax({
				url: $(".formulario").attr("action"),  
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
					console.log();
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
						message = $("<span class='success'>Los datos ha sido cargados exitosamente</span>");
						showMessage(message);
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
})
 
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
         case 'csv':
            return true;
        break;
        default:
            return false;
        break;
    }
}
</script>



<div id="content">
	 <div class="divContentBlue">
		<h3>Carga masiva</h3>
		<div class="divContentWhite">
			<?php echo CHtml::form(array("admin/rcv/cargar"), 'post', array('class'=>'formulario' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;','enctype'=>'multipart/form-data')); ?>
			<ul>
				<li><b>Seleccione un archivo tipo CSV:</b> <input name="archivo" type="file" id="imagen" /></li>
				<li><b>Seleccione un delimitador: </b><select name="delimitador"> 
				<option value=";">;</option>
				<option value=",">,</option>
 				</select></li>
				<li><b>Áreas o unidades</b> <select name="areas"><option value="-1">Seleccione area o unidad</option>
				<? foreach($estructura as $data){
					?>
					<option value="<?=$data->id?>"><?=$data->nombre?></option>
					<?
				} ?>
				</select>
				
				</li>
								<li><b>Enviar email al paciente?</b><br>Si <input type="radio" name="email" value="Si"/> <br>No <input type="radio" name="email" value="No"/></li>

				<li><div class="messages"></div></li>
				<li><div class="showImage"></div></li>
			</ul>
 				<br /> 
				<input type="button" value="Subir" /><br />
				<input type="hidden" name="save" />
			</form>
			<br /><br />
			<!--div para visualizar en el caso de imagen-->
					

		</div>
	</div>
</div>
