<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/login"; 
	$uds = User::model()->findByPk($_SESSION['loginID']); 
	$uds1 = EvalUsuarios::model()->findByPk($uds->iduseval);
?>
<script>
function accion(){
	jQuery("[rel^='accion']").change(function(){   
		var id=jQuery(this).attr("id");console.log(id);
		var valida=true;
		$(".formu").find('[name="'+id+'"]').val(jQuery(this).val());
		$(".formu").find('[name="idform"]').val(0);
		jQuery("#evaluacion").html('');

		if(id=="tipo" && jQuery("#idorg").val()==0){
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
						var url='https://www.talentracking.co/node/295?embed=1&token='+data["token"]+'&paramidform=<?=$evaluaciones[0]->id?>&paramidorg='+data["empresas"][0]["id"];
						//jQuery("#reporte").attr({"src":url});
						jQuery("#reporte").attr({"src":""});
						console.log(data)
						var evas='<ul>';
						jQuery.each(data["evaluaciones"],function(k,d){  
							evas+='<li><label ><button rel="accioneval" id="idform" value="'+d['id']+'">Ver</button><b>fecha:</b>'+d['fecha']+' <b>Tipo de auditoría:</b>'+d['tipoeval']+' <button rel="descargar" id="idform" value="'+d['id']+'"><img   src="//talentracking.com/clima/img/pdf.png" style="float:left;cursor:pointer" width="15" /></button><button rel="anexo" value="'+d['id']+'" style="    margin-left: 10px;">Anexos</button></label></li>';
						});
						evas+='<ul>';
						if(data["evaluaciones"].length>0){
						jQuery("#evaluaciones").html('<div class="divContentWhite"><b>Estas son las evaluaciones disponibles, seleccione una y haga click en ver para visualizar detalles</b>'+evas+"</div>"); 
						accionclick(); 
						}else{
						jQuery("#evaluaciones").html('<div class="divContentWhite"><b>No hay evaluaciones</b></div>'); 
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


var subg1=[];			
var subg2=[];			
var subg3=[];			
var subg4=[];			
var subg5=[];			
var subg6=[];			
var subg7=[];			
var subg8=[];			
var subg9=[];			
var subg10=[];			
var subg11=[];			
var subg12=[];			
var subg13=[];			
var subg14=[];			
var subg15=[];			
var subg16=[];			
var subg17=[];			
var subg18=[];			
var subg19=[];			
var subg20=[];

var subg1t=5;			
var subg2t=7;			
var subg3t=6;			
var subg4t=2;			
var subg5t=7;			
var subg6t=5;			
var subg7t=4;			
var subg8t=9;			
var subg9t=5;			
var subg10t=6;			
var subg11t=5;			
var subg12t=13;			
var subg13t=5;			
var subg14t=11;			
var subg15t=7;			
var subg16t=3;			
var subg17t=6;			
var subg18t=18;			
var subg19t=6;			
var subg20t=5;			

var g1=[];
var g2=[];
var g3=[];
var g4=[];
var g5=[];
var g6=[];
var g7=[];		

var g1t=1;
var g2t=3;
var g3t=5;
var g4t=3;
var g5t=2;
var g6t=4;
var g7t=2;	
function actionanexos(){
	jQuery("[rel='delanexo']").click(function(){
 		if(confirm("Desea eliminar este archivo?")){
		$(".validar").find("[name='id']").val(jQuery(this).val());
		$(".validar").find("[name='option']").val("del");
		var obj=jQuery(this);
		var formData = new FormData($(".validar")[0]);;
			$.ajax({
			url:$(".validar").attr("action"),  
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
				if(data[0]=="ok"){
					alert("El archivo ha sido eliminado");
					obj.parent().remove();
				}
				if(data[0]=="no"){
					alert(data[1]); 
 				}
			}
			});
		}
 	});
	jQuery("[rel='getanexo']").click(function(){
		var id=jQuery(this).val();
		$(".fanexo").find("[name='id']").val(id);
		$(".fanexo").find("[name='option']").val("get");
		$(".fanexo").submit();
	})
	
	
}

function accionclick(){
	
jQuery("[rel='anexo']").click(function(){
		var id=jQuery(this).val();
		$(".validar").find("[name='idform']").val(id);
		$(".validar").find("[name='option']").val("validar");
		var formData = new FormData($(".validar")[0]);
			$.ajax({
				url: $(".validar").attr("action"),  
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
				var archivos='';
				jQuery.each(data[3],function(k,d){
					var nombre=d["nombre"];
					var fecha=d["fecha"];
					var tipo=d["tipo"];
					var url=d["url"];
					var id=d["id"];
					<?php 
					if($uds1->perfil==1 or $uds1->perfil==3 or  $uds1->perfil==6 or   $uds1->perfil==7 or $uds->uid==1 ){
					?>
					archivos+='<div><button rel="delanexo" value="'+id+'" ><img src="<?=Yii::app()->baseUrl?>/img/bad.gif" width="20" /></button><button rel="getanexo" value="'+id+'" ><img src="<?=Yii::app()->baseUrl?>/img/'+tipo+'.png" width="20" /></button>'+nombre+'</div><br>';
					<?php }else{ ?>
					archivos+='<div><button rel="getanexo" value="'+id+'" ><img src="<?=Yii::app()->baseUrl?>/img/'+tipo+'.png" width="20" /></button>'+nombre+'</div><br>';
					<?php } ?>
				});
				var html="<div id='addarc'>"+archivos+"</div>";
				if(data[1]=="ok"){  
 					var html='<div class="divContentWhite"><div id="addarc">'+archivos+"</div>";
 					<?php 
						if($uds1->perfil==1 or $uds1->perfil==3 or  $uds1->perfil==6 or   $uds1->perfil==7 or $uds->uid==1 ){
					?>
					html+='<br><br><b>Subir Archivos</b>';
					html+='<form class="formulario" id="formCrear" style="margin:0px; padding:0px;" enctype="multipart/form-data" action="<?=Yii::app()->baseUrl?>/index.php/admin/pcos/cargar" method="post">';
 					html+='<input name="YII_CSRF_TOKEN" type="hidden" value="'+jQuery(".formu").find("[name='YII_CSRF_TOKEN']").val()+'" /><br /><br />';
					html+='<input name="idform" type="hidden" value="'+data[2]+'" id="idform" />';
 					html+='<input name="archivo" type="file" id="archivo" /><br /><br />';
					html+='<input type="button" id="canexo_'+data[2]+'" value="Subir Archivo" /><br />';
					html+='<input type="hidden" name="save" />';
					html+='</form>';
					html+='<div class="messages"></div><br /><br />';
					html+='<div class="showImage"></div>';					
					<?php } ?>
 					html+='</div>'; 
 					
				}
				
				var w=jQuery(window).width();
				var width="600px";
				var height="600px";
				if(w<=600){
					width="95%";
					height="80%";
				} 
				
				
				jQuery.colorbox({html:html,width:width,height:height});
				anexo(data[2]);
				actionanexos();	
				
				
			}});	
	
});	
	
jQuery("[rel^='accioneval'],[rel='descargar']").click(function(){ 
		var attr=jQuery(this).attr("rel");
 		var id=jQuery(this).attr("id");
		var valida=true;
		$(".formu").find('[name="'+id+'"]').val(jQuery(this).val());
		$(".formu").find('[name="resumen"]').val(attr);
		if(id=="visita" && jQuery("#idorg").val()==0){
			alert("Por favor seleccione una empresa");
			valida=false;
			jQuery(this).find("option:selected").attr({"selected":"false"});
			jQuery(this).find("option:selected").removeAttr("selected");
			jQuery(this).find("option:eq(0)").attr({"selected":"selected"});
		}
 		if(jQuery(this).val().trim(" ")!="" && valida==true){
		
	
		
			var objcontrol=[{
			"1907":["g1","subg1","CONTEXTO DE LA ORGANIZACIÓN"],
			"2041":["g1","subg1","CONTEXTO DE LA ORGANIZACIÓN"],
			"2042":["g1","subg1","CONTEXTO DE LA ORGANIZACIÓN"],
			"2043":["g1","subg1","CONTEXTO DE LA ORGANIZACIÓN"],
			"2044":["g1","subg1","CONTEXTO DE LA ORGANIZACIÓN"],

			"1910":["g2","subg2","Liderazgo"],
			"1911":["g2","subg2","Liderazgo"],
			"1912":["g2","subg2","Liderazgo"],
			"1913":["g2","subg2","Liderazgo"],
			"1914":["g2","subg2","Liderazgo"],
			"1915":["g2","subg2","Liderazgo"],
			"1916":["g2","subg2","Liderazgo"],

			"1917":["g2","subg3","Liderazgo"],
			"1918":["g2","subg3","Liderazgo"],
			"1919":["g2","subg3","Liderazgo"],
			"1920":["g2","subg3","Liderazgo"],
			"1921":["g2","subg3","Liderazgo"],
			"1922":["g2","subg3","Liderazgo"],

			"1923":["g2","subg4","Liderazgo"],
			"1924":["g2","subg4","Liderazgo"],

			"1925":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1926":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1927":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1928":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1929":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1930":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1931":["g3","subg5"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1932":["g3","subg6"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1933":["g3","subg6"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1934":["g3","subg6"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1935":["g3","subg6"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1936":["g3","subg6"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1937":["g3","subg7"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1938":["g3","subg7"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1939":["g3","subg7"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1940":["g3","subg7"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1941":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1942":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1943":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1944":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1945":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1946":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1947":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1948":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1949":["g3","subg8"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1950":["g3","subg9"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1951":["g3","subg9"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1952":["g3","subg9"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1953":["g3","subg9"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1954":["g3","subg9"," PLANIFICACIÓN DEL SISTEMA DE GESTIÓN DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1955":["g4","subg10","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1956":["g4","subg10","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1957":["g4","subg10","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1958":["g4","subg10","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1959":["g4","subg10","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1960":["g4","subg10","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1961":["g4","subg11","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1962":["g4","subg11","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1963":["g4","subg11","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1964":["g4","subg11","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1965":["g4","subg11","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1966":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1967":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1968":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1969":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1970":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1971":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1972":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1973":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1974":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1975":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1976":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1977":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1978":["g4","subg12","APOYO AL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1979":["g5","subg13","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1980":["g5","subg13","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1981":["g5","subg13","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1982":["g5","subg13","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1983":["g5","subg13","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1984":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1985":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1986":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1987":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1988":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1989":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1990":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1991":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1992":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1993":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1994":["g5","subg14","OPERACIÓN DEL SISTEMA DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"1995":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1996":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1997":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1998":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"1999":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2000":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2001":["g6","subg15","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"2002":["g6","subg16","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2003":["g6","subg16","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2004":["g6","subg16","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"2005":["g6","subg17","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2006":["g6","subg17","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2007":["g6","subg17","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2008":["g6","subg17","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2009":["g6","subg17","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2010":["g6","subg17","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"2012":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2013":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2014":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2015":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2016":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2017":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2018":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2019":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2020":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2021":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2022":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2023":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2024":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2025":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2026":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2027":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2028":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],
			"2029":["g6","subg18","EVALUACIÓN DEL DESEMPEÑO DEL SISTEMA  DE GESTIÓN DE DEL RIESGO DE ENFERMEDADES CARDIOVASCULARES Y OTRAS ENFERMEDADES CRÓNICAS NO TRANSMISIBLES"],

			"2030":["g7","subg19","MEJORA"],
			"2031":["g7","subg19","MEJORA"],
			"2032":["g7","subg19","MEJORA"],
			"2033":["g7","subg19","MEJORA"],
			"2034":["g7","subg19","MEJORA"],
			"2035":["g7","subg19","MEJORA"],

			"2036":["g7","subg20","MEJORA"],
			"2037":["g7","subg20","MEJORA"],
			"2038":["g7","subg20","MEJORA"],
			"2039":["g7","subg20","MEJORA"],
			"2040":["g7","subg20","MEJORA"],
			}];		
 		
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
					
							var v="";
							if(data["evaluaciones"][0]["vistaverificacion"]=="Y"){
								v="Verificación";
							}
							if(data["evaluaciones"][0]["vistaseguimiento"]=="Y"){
								v="Seguimiento";
							}
							if(data["evaluaciones"][0]["vistaadicional"]=="Y"){
								v="Adicional";
							}
							var htmleva='';
							if(attr=="descargar"){
								 htmleva+='<div style="float:right;width: 150px;"><button id="print" onclick="printDocument()" style="float:left;"><img id="print" onclick="printDocument()" src="//talentracking.com/clima/img/pdf.png"   width="30" /></button><button id="cerrar" onclick="jQuery.colorbox.close()" style="float:left;margin-left: 10px;margin-top: 5px;" >Cerrar</button></div>';
							}    
								htmleva+='<h2>Resumen de la Evaluación</h2><br><b>Tipo evaluación:</b>'+data["evaluaciones"][0]["tipoeval"]+"<br>";
 								htmleva+='<table style="width:100%;border: 1px solid #000;"><tr><td><b>Fecha:</b></td><td>'+data["evaluaciones"][0]["fecha"]+"</td></tr>";
								//htmleva+='<b>Tipo de visita:</b>'+v+"<br>";
								htmleva+='<tr><td><b>Empresa:</b></td><td>'+data["evaluaciones"][0]["nombreempresa"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Dirección:</b></td><td>'+data["evaluaciones"][0]["direccionempresa"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Ciudad y departamento:</b></td><td>'+data["evaluaciones"][0]["ciudaddepartamento"]+"<br></td></tr>";
								htmleva+='<tr><td><b>NIT:</b></td><td>'+data["evaluaciones"][0]["nit"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Teléfono:</b></td><td>'+data["evaluaciones"][0]["telefono"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Fax:</b></td><td>'+data["evaluaciones"][0]["fax"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Representante legal:</b></td><td>'+data["evaluaciones"][0]["representantelegal"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Documento representante legal:</b></td><td>'+data["evaluaciones"][0]["docrepresentante"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Contacto:</b></td><td>'+data["evaluaciones"][0]["nombrecontacto"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Documento Contacto:</b></td><td>'+data["evaluaciones"][0]["doccontacto"]+"<br></td></tr>";
								htmleva+='<tr><td><b>E-mail Contacto:</b></td><td>'+data["evaluaciones"][0]["emailcontacto"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Actividad económica:</b></td><td>'+data["evaluaciones"][0]["actividadeconomica"]+"<br></td></tr>";
								htmleva+='<tr><td><b>Alcance:</b></td><td>'+data["evaluaciones"][0]["alcance"]+"<br></td></tr>";
								var equipo=data["evaluaciones"][0]["jsonequipo"];
								var sede=data["evaluaciones"][0]["jsonsut"];
								equipo=jQuery.parseJSON(equipo);
								sede=jQuery.parseJSON(sede);
 								if(sede[0]!=undefined){
									htmleva+='<tr><td><br><b>Sedes</b><br></td><td></td></tr>';
									jQuery.each(sede,function(k,d){
										htmleva+='<tr><td><b>Nombre sede:</b></td><td>'+d["sede"]+"<br></td></tr>";
										htmleva+='<tr><td><b>Ubicación:</b></td><td>'+d["ubicacion"]+"<br></td></tr>";
										htmleva+='<tr><td><b>Número de trabajadores:</b></td><td>'+d["ntrab"]+"<br></td></tr>";
									});
								}
 								if(equipo[0]!=undefined){
									htmleva+='<tr><td><br><b>Datos del equipo evaluador</b><br></td><td></td></tr>';
									jQuery.each(equipo,function(k,d){
										htmleva+='<tr><td><b>Cargo:</b></td><td>'+d["cargo"]+"<br></td></tr>";
										htmleva+='<tr><td><b>Documento:</b></td><td>'+d["doc"]+"<br></td></tr>";
										htmleva+='<tr><td><b>Nombre:</b></td><td>'+d["nomev"]+"<br></td></tr>";
									});
								}
							htmleva+='</table>';
							
							var ch='<table style="width:100%;border: 1px solid #000;">';
							//ch+='<tr style="background:#BDBDBD"><td style="width:40%;border: 1px solid #000;"><b>Pregunta</b></td><td style="border: 1px solid #000;"><b>Respuesta</b></td><td style="border: 1px solid #000;"><b>Comentarios</b></td></tr>';
							var tevaluacion=0;
							var sumatoria=0;
							var contador=0;
							var objsbg=[{"4":["CONTEXTO DE LA ORGANIZACIÓN"]}];
							
							var contat=0;
							var contatsub=0;
							jQuery.each(data["checklist"],function(kk,dd){
								var id=dd["codigo"].split("X")[2];
								var res=dd["respuesta"];
								if(dd["respuesta"]=="N"){
									id=id.split("comment")[0];
									 
								} else{
 									id=dd["codigo"].split("X")[2];
									
									contatsub++;
 								} 
								if(objcontrol[0][id]!=undefined){
 									if(typeof(objcontrol[0][id][1])!=undefined){
 										if(contatsub<=eval(objcontrol[0][id][1]+"t")){
 											eval(objcontrol[0][id][1]+".push("+res+")");
 										}
										if(contatsub==eval(objcontrol[0][id][1]+"t")){
											contatsub=0;
											contat++;
										}
  									}
  									if(typeof(objcontrol[0][id][0])!=undefined){
 										if(eval(objcontrol[0][id][0]+".length")<eval(objcontrol[0][id][0]+"t")  && contat<=eval(objcontrol[0][id][0]+"t") && contatsub==0){  
  											eval(objcontrol[0][id][0]+".push("+objcontrol[0][id][1]+")");
											if(contat==eval(objcontrol[0][id][0]+"t")){contat=0;
											}
											 
										}
  									}
 								}					
 							}); 
							contat=0;
							contatsub=0;
							jQuery.each(data["checklist"],function(kk,dd){
								var a='';
								var b='';
								var res=dd["respuesta"];
								var com=dd["comentario"];
								var id=dd["codigo"].split("X")[2];
								if(dd["respuesta"]=="N"){
									id=id.split("comment")[0];
									dd["respuesta"]="";
									b='background:#D8D8D8'; 
									a='background:#D8D8D8';
									res='<b>Respuesta</b>';
									com='<b>Comentarios</b>';
									 
								} else{
									dd["respuesta"]=parseInt(dd["respuesta"]);
									res=dd["respuesta"];
									tevaluacion+=dd["respuesta"]; 
									id=dd["codigo"].split("X")[2];
									
									contatsub++;
								} 
								var subpromedio=0;
								var subcumplimiento=0;
								if(objcontrol[0][id]!=undefined ){
									if(kk==0){ 
 										ch+='<tr id="'+dd["codigo"]+'" style="'+b+'">';
										ch+='<td style="text-align: center;border: 1px solid #000;background:#BDBDBD" colspan="3"><b>'+objcontrol[0][id][2]+'</b></td>';
 										ch+='</tr>';
										ch+='<tr style="background:#BDBDBD"><td style="width:40%;border: 1px solid #000;"><b>Pregunta</b></td><td style="border: 1px solid #000;"><b>Respuesta</b></td><td style="border: 1px solid #000;"><b>Comentarios</b></td></tr>';

 									}
								}
 								
   								ch+='<tr id="'+dd["codigo"]+'" style="'+b+'">';
								ch+='<td style="width:40%;border: 1px solid #000;'+a+'"><b>'+dd["pregunta"]+'</b></td>';
								ch+='<td style="border: 1px solid #000;"><b>'+res+'</b></td>';
								ch+='<td style="border: 1px solid #000;"><b>'+com+'</b></td>';
								ch+='</tr>';

								 
								
								if(objcontrol[0][id]!=undefined ){
								
									if(contatsub==eval(objcontrol[0][id][1]+"t")){
										
										var acumular=0;
										  
										for(var i=0;i<eval(objcontrol[0][id][1]+"t");i++){
											
 											acumular=parseInt(acumular)+eval(objcontrol[0][id][1]+"["+i+"]");
 										}
 										subpromedio=acumular/eval(objcontrol[0][id][1]+"t"); 
 										subcumplimiento=(subpromedio/3)*100;
  										var a='background:#D8D8D8';
										var b='background:#FFF';
										
										ch+='<tr id="'+dd["codigo"]+'" style="background:#FFF">';
										ch+='<td style="width:40%;border: 1px solid #000;background:#FFF;font-size:16px"><b>Sub Total</b></td>'; 
										ch+='<td style="border: 1px solid #000;font-size:16px;background:#FFF"><b>Promedio:</b>'+round(subpromedio, 2)+'</td>';
										ch+='<td style="border: 1px solid #000;font-size:16px;background:#FFF"><b>Cumplimiento:</b> '+round(subcumplimiento, 2)+' %</td>';
										ch+='</tr>';
										contatsub=0;
										contat++;
									}  								
								
									if(contat==eval(objcontrol[0][id][0]+"t") && contatsub==0){
										var a1=0;
										for(var i=0;i<eval(objcontrol[0][id][0]+"t");i++){
											var a2=0;
											for(var j=0;j<eval(objcontrol[0][id][0]+"["+i+"].length");j++){
												a2+=eval(objcontrol[0][id][0]+"["+i+"]["+j+"]");
											}
											a2=a2/j;
											a1+=a2;
										}
										a1=a1/i;
										subpromedio=a1;
										subcumplimiento=(subpromedio/3)*100;
										
										var a='background:#D8D8D8';
										var b='background:#FFF';
										ch+='<tr id="'+dd["codigo"]+'" style="background:#FFF">';
										ch+='<td style="width:40%;border: 1px solid #000;background:#FFF;font-size:16px"><b>Total '+objcontrol[0][id][2]+'</b></td>';  
										ch+='<td style="border: 1px solid #000;font-size:16px;background:#FFF"><b>Promedio:</b>'+round(subpromedio, 2)+'</td>';
										ch+='<td style="border: 1px solid #000;font-size:16px;background:#FFF"><b>Cumplimiento:</b> '+round(subcumplimiento, 2)+' %</td>';
										ch+='</tr>';
  										if(objcontrol[0][parseInt(id)+1]!=undefined || parseInt(id)==2044){ 
											if(parseInt(id)==2044){
												id='1910';
 											} 
											ch+='<tr   style="#BDBDBD">';
											ch+='<td style="text-align: center;border: 1px solid #000;background:#BDBDBD;font-size:16px" colspan="3"><b>'+objcontrol[0][parseInt(id)+1][2]+'</b></td>';
											ch+='</tr>';
 										}
										contat=0;
 									} 
								}
								
								
								
  							});
							 

							ch+='<table>'; 
							var wscr = jQuery(window).width();							
 							var w1="width:40%";
 							var w2="width:50%";
							
							if(wscr<=600){
 							  w1="width:100%";
 							  w2="width:100%"; 
							}  
							
							if(attr=="accioneval"){
								jQuery("#evaluacion").html('<center><div class="divContentWhite" style="float:left;width:99%">'+htmleva+'</div></center>');
 							}else if(attr="descargar"){
								
								jQuery.colorbox({html:htmleva+'<div style="clear:both"></div>'+ch,width:wscr+"px",height:"9600px",fixed:false,top:"1px"});
							}
					
					   if(data["total"]>0 && attr=="accioneval"){
 							var url='https://www.talentracking.co/node/295?embed=1&token='+data["token"]+'&paramidorg='+data["evaluaciones"][0]["idorg"]+'&paramidform='+data["evaluaciones"][0]["id"]+'&datosEmpresa='+data["evaluaciones"][0]["nombreempresa"]+'&datosFecha='+data["evaluaciones"][0]["fecha"]+'&datosEvaluacion='+data["evaluaciones"][0]["tipoeval"];
							console.log(url);
							jQuery("#reporte").attr({"src":url,width:"96%",height:"90%","border-style": "none"});
					   
					   }else if(attr=="accioneval" && data["total"]<=0){ 
						alert("A esta evaluación no se le realizó lista de chequeo");
						jQuery("#reporte").attr({"src":""});
 					   }
						  
					}catch(e){console.log(e);
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
function round(value, exp) {
  if (typeof exp === 'undefined' || +exp === 0)
    return Math.round(value);

  value = +value;
  exp = +exp;

  if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
    return NaN;

  // Shift
  value = value.toString().split('e');
  value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

  // Shift back
  value = value.toString().split('e');
  return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}
function printDocument(option=false) {
	jQuery(".contentmenu").hide();
	jQuery(".maintitle").hide();
	jQuery("#reporte").hide();
	jQuery("#print").hide();
	jQuery("#cerrar").hide();
	jQuery("#titulocontenido").hide();
 		jQuery(".divContentWhite").hide();
     setTimeout(function(){
		window.print(); 
		jQuery(".contentmenu").show();
		jQuery(".maintitle").show();
		jQuery("#reporte").show();
		jQuery("#print").show();
		jQuery("#cerrar").show();
		jQuery("#titulocontenido").show();
 			jQuery(".divContentWhite").show();
 	},500);
}


function anexo(id){
	
 
    $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    var name = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#archivo")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
		name=fileName;
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
    $('#canexo_'+id).click(function(){
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
		var ida=jQuery(this).attr("id").split("_")[1];
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
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                message = $("<span class='before'>Subiendo archivo, por favor espere...</span>");
                showMessage(message)        
            },
            //una vez finalizado correctamente
            success: function(data){
                if(!isImage(fileExtension))
                {
					showMessage("El archivo con extención "+fileExtension+" no es válido");
                   // $(".showImage").html("<img src='files/"+data+"' />");
                }else{
 					message = $("<span class='success'>El archivo se ha cargado correctamente.</span>");
					showMessage(message);
					var archivos='<div><button rel="delanexo" value="'+ida+'" ><img src="<?=Yii::app()->baseUrl?>/img/bad.gif" width="20" /></button><button rel="getanexo" value="'+ida+'" ><img src="<?=Yii::app()->baseUrl?>/img/'+fileExtension+'.png" width="20" /></button>'+name+'</div><br>';
					jQuery("#addarc").append(archivos); 
					actionanexos();
 				}
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                showMessage(message);
            }
        });
    });	
	
	
	
}
//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
          case 'jpg':
            return true;
          case 'gif':
            return true;
          case 'png':
            return true;
          case 'doc':
            return true;
          case 'docx':
            return true;
          case 'pdf':
            return true;
          case 'xls':
            return true;
          case 'xlsx':
            return true;
          case 'ppt':
            return true;
          case 'pptx':
            return true;
        break;
        default:
            return false;
        break;
    }
}

</script>
<?php echo CHtml::form(array("admin/pcos/reportes"), 'post', array('class'=>'formu' , 'id'=>'formu')); ?>
	<input type="hidden" name="chart" value="1" />
	<input type="hidden" name="idorg" />
	<input type="hidden" name="visita" />
	<input type="hidden" name="tipo" />
	<input type="hidden" name="idform" />
	<input type="hidden" name="submitdate" />
	<input type="hidden" name="resumen" />
</form>
<?php echo CHtml::form(array("admin/pcos/cargar"), 'post', array('class'=>'validar' , 'id'=>'validar')); ?>
 	<input type="hidden" name="id" />
 	<input type="hidden" name="idorg" />
 	<input type="hidden" name="idform" />
 	<input type="hidden" name="option" />
</form>
<?php echo CHtml::form(array("admin/pcos/getanexo"), 'post', array('class'=>'fanexo' , 'id'=>'fanexo','target'=>"iframeanexo")); ?>
  	<input type="hidden" name="id" />
 	<input type="hidden" name="option" />
</form>
<iframe id="iframeanexo" name="iframeanexo" style="width:600px;height:800;display:none"></iframe>
<div id="content">
   	<div class="divContentBlue">
		<h3 id="titulocontenido">Reportes</h3>
		
  		<div class="divContentWhite">
			<div style="clear:both"></div>
			 <b>Seleccione una empresa</b>
			 <select id="idorg" rel="accion"><option value="0">----------</option>
			<? 
				foreach($empresas as $data){?>
				<option value="<?=$data->id?>"><?=$data->nombre?></option>
				
			<?}
			?></select>
			<!--
			 <b>Seleccione tipo visita</b>
			 <select id="visita" rel="accion"><option value="">----------</option>
				<option value="vistaverificacion">Verificación</option>
				<option value="vistaseguimiento">Seguimiento</option>
				<option value="vistaadicional">Adicional</option>
			 </select>
			 -->
			 <b>Seleccione tipo de auditoria</b>
			 <select id="tipo" rel="accion"><option value="">----------</option>
				<option value="simulacro">Simulacro</option>
				<option value="interno">Interno</option>
				<option value="Externo">Externo</option>
			 </select>
			<div style="clear:both"></div>
			<div id="evaluaciones" class="divContentBlue"></div>
			<div id="evaluacion" class="divContentBlue"></div>
			 
			<!--div id="chart_div"></div-->
  			 <!--div id="chart_div"></div-->
			<iframe id="reporte" name="reporte" src="https://www.talentracking.co/node/295?embed=1&token=<?=$token?>&paramidform=<?=$evaluaciones[0]->id?>"  scrolling="no"  ></iframe>  
			<div style="clear:both"></div>
		</div>
 	</div>
	<div style="clear:both"></div>			 
</div>



<script>
	jQuery(function(){
		 jQuery("#reporte").attr({"style":"height:2000px;width:100%;overflow-x:hidden;    border-style: none;"})
 	});
</script>
