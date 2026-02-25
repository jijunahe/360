<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/login"; 
	 
?>
<script>
	window["turl"]="<?=Yii::app()->baseUrl?>/index.php/admin/";
function salir(){
	var action="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/sa/logout"; 
	jQuery.ajax({ 
		type: "POST",
		dataType: "json",
		async: false,
		url: action,
		data:{"salir":"salir"},
		success:function(res){
 		}
	});
	setTimeout(function(){document.location=window["turl"];},300);
	

}  
function acciones(){
	
jQuery("[rel='action']").click(function(){
		var valida=jQuery(this).val();
		var action="<?=Yii::app()->baseUrl?>/index.php/admin/fundacion/encuestacorazones"; 
  		if(valida=="Si"){
 			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: action,
				data:{"option":"validar"},
				success:function(res){
					if(res["r"]!="n"){
						window["turl"]=res["r"];
						setTimeout(function(){salir();},300);
						
 					}else{
						alert("Lo sentimos, no hay encuestas programadas.");
 					}

				}
			});	
		}else{
 		 document.location="<?=Yii::app()->baseUrl?>/index.php/admin/survey/sa/index"; 
		
		}
 
		
	});	
	
}
jQuery(function(){
		var w="450px";
		var h="330px";
		if(jQuery(window).width()<=500){
			w="90%";
			h="40%";
 		}
		jQuery.colorbox({html:jQuery("#content").clone().html(),width:w,height:h}); 
	acciones();
});	 
</script>
<div id="content">
	<center>
   	<div class="divContentBlue" style="width:80%" > 
   		<div class="divContentWhite">
		<h4>En este momento usted se encuentra con un usuario registrado dentro de la Plataforma PCOS, la Encuesta de la Cultura del Cuidado está diseñada para diligenciarse anónimamente,  si desea completar la encuesta su sesión debe cerrarse, desea continuar?</h4>
		 <div style="clear:both"></div>
		<input type="button" rel="action" value="Si"   />
		<input type="button" rel="action" value="No" style="margin-left:10px" />
 			 <div style="clear:both"></div>
		</div>
 	</div>
	</center>
	<div style="clear:both"></div>			 
</div>
 
