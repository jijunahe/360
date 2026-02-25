<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/login"; 
	 
?>
<script>
function accion(){
	jQuery("[rel^='accion']").change(function(){   
		var id=jQuery(this).attr("id");console.log(id);
		var valida=true;
		$(".formu").find('[name="'+id+'"]').val(jQuery(this).val());
		$(".formu").find('[name="idAnswer"]').val(0);
		jQuery("#evaluacion").html('');

		if(id=="visita" && jQuery("#idorg").val()==0){
			alert("Por favor seleccione una empresa");
			valida=false;
			jQuery(this).find("option:selected").attr({"selected":"false"});
			jQuery(this).find("option:selected").removeAttr("selected");
			jQuery(this).find("option:eq(0)").attr({"selected":"selected"});
		}
 		if(jQuery(this).val().trim(" ")!="" && valida==true){
			var formData = new FormData($(".formu")[0]);
			$.ajax({
				url: $(".formu").attr("action"),  
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
					//message = $("<span class='before'>Eliminando archivo...</span>");
					//showMessage(message)        
				},
				//una vez finalizado correctamente 
				success: function(data){ 
					try{
						if(data.evaluaciones.length>0){
							var url='https://www.talentracking.co/node/299?embed=1&token='+data["token"]+'&paramidAnswerSrt=<?=$evaluaciones[0]->idAnswer?>&paramidempresaSrt='+data["empresas"][0]["id"];
							//jQuery("#reporte").attr({"src":url});
							jQuery("#reporte").attr({"src":""});
							console.log(data)
							var evas='<ul>';
							jQuery.each(data["evaluaciones"],function(k,d){
								evas+='<li><label ><button rel="accioneval" id="idAnswer" value="'+d['idAnswer']+'">Ver</button><b>fecha de realización:</b>'+d['submitdate']+'</label></li>';
							});
							evas+='<ul>';
							jQuery("#evaluaciones").html('<div class="divContentWhite"><b>Estas son las evaluaciones disponibles, seleccione una y haga click en ver para visualizar detalles</b>'+evas+"</div>"); 
							accionclick();
						}else{
							jQuery("#evaluaciones").html('<div class="divContentWhite"><b>Esta empresa no tiene evaluaciones</b></div>'); 
						}
					}catch(e){
						alert("No se encontraron datos, por favor pruebe otros criterios de búsqueda.");
					}
					 

				},
				//si ha ocurrido un error
				error: function(){
					message = $("<span class='error'>Ha ocurrido un error.</span>");
					 
				}
			});	
		}
	});	
	
}
function accionclick(){
jQuery("[rel^='accioneval']").click(function(){  
		var id=jQuery(this).attr("id");console.log(id);
		var valida=true;
		$(".formu").find('[name="'+id+'"]').val(jQuery(this).val());
		if(id=="visita" && jQuery("#idorg").val()==0){
			alert("Por favor seleccione una empresa");
			valida=false;
			jQuery(this).find("option:selected").attr({"selected":"false"});
			jQuery(this).find("option:selected").removeAttr("selected");
			jQuery(this).find("option:eq(0)").attr({"selected":"selected"});
		}
 		if(jQuery(this).val().trim(" ")!="" && valida==true){
			var formData = new FormData($(".formu")[0]);
			$.ajax({
				url: $(".formu").attr("action"),  
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
					//message = $("<span class='before'>Eliminando archivo...</span>");
					//showMessage(message)        
				},
				//una vez finalizado correctamente
				success: function(data){
					try{
  							var url='https://www.talentracking.co/node/299?embed=1&token='+data["token"]+'&paramidempresaSrt='+data["evaluaciones"][0]["idempresa"]+'&paramidAnswerSrt='+data["evaluaciones"][0]["idAnswer"];
							console.log(url);
							jQuery("#reporte").attr({"src":url});
					   
 					}catch(e){
						alert("No se encontraron datos, por favor pruebe otros criterios de búsqueda.");
					}
					 

				},
				//si ha ocurrido un error
				error: function(){
					message = $("<span class='error'>Ha ocurrido un error.</span>");
					 
				}
			});	
		}
	});	
	
}            
jQuery(function(){
	 
	accion();
	$('#formu').submit(function() {
	  return false;
	});
});	 
</script>
<?php echo CHtml::form(array("admin/pcos/seguimientoreporte"), 'post', array('class'=>'formu' , 'id'=>'formu')); ?>
	<input type="hidden" name="chart" value="1" />
	<input type="hidden" name="idorg" />
	<input type="hidden" name="visita" />
	<input type="hidden" name="tipo" />
	<input type="hidden" name="idAnswer" />
	<input type="hidden" name="submitdate" />
</form>
<div id="content">
   	<div class="divContentBlue">
		<h3>Reporte epidemiológico consolidado de Organizaciones Saludables, el cual también puede consultarse por cada empresa que ha decidido compartir sus datos.</h3>
		
  		<div class="divContentWhite">
			<div style="clear:both"></div>
			 <b>Seleccione una empresa</b>
			 <select id="idorg" rel="accion"><option value="0">----------</option>
			<? 
				foreach($empresas as $data){if($data->id!=19){?>
				<option value="<?=$data->id?>"><?=$data->nombre?></option>
				
				<?}}
			?></select>
			  
			<div style="clear:both"></div>
			<div id="evaluaciones" class="divContentBlue"></div>
			<div id="evaluacion" class="divContentBlue"></div>
			 
			<!--div id="chart_div"></div-->
  			 <!--div id="chart_div"></div-->
 			<iframe id="reporte" name="reporte" src=""  ></iframe>  
			 
			<div style="clear:both"></div>
		</div>
 	</div>
	<div style="clear:both"></div>			 
</div>
<script>
	jQuery(function(){
		 jQuery("#reporte").attr({"style":"height:6000px;width:100%;overflow-x:hidden"})
 	});
</script>
