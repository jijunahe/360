<?php
	// printVar(json_encode($organigrama, JSON_HEX_QUOT | JSON_HEX_TAG));exit;
	 //printVar($random); 
?>

<style>
	.ventanaBodyError {
	color: #990000;
	border: solid 1px #4F0000;
	padding: 3px;
	background-color: #FFF0E1;
	}
	
	.divGood {
	background-color: #E2FFDF;
	border: 1px solid #085500;
	padding: 5px;
	text-align: center;
	}
	
.datos{
margin-left: 94px;
	margin-top: -150px;	
	text-align: left;
	position: absolute;
	border-radius: 10px;
	padding: 11px;
	border: 1px solid #EDEDFB;
 	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;
	-moz-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;	
	
}
#welcome{
	background:#FFF !important;
}
#welcome, #gracias{
	width:70%;
	padding:2em;
	    padding-top: 1px;
	margin:0 auto;
	    margin-top: 10px;
 	border-radius: 10px;
 }
#aviancahome{
	float:left;
	width:70%
 }
#textohome{
	float:left;
	margin-left:1em;
	width:22%;
	background-color:#fff;
	border-radius: 10px;
	padding:1em;
}
#descripcion{
	float:left;
 	width:94%;
	background-color:#fff;
	border-radius: 10px;
	padding:1em;
	margin-top:1em;
}
 
#textgracias{
  	width:94%;
	background-color:#fff;
	border-radius: 10px;
	padding:2em;
}


#textohome p, #descripcion p ,#textgracias p{
	text-align:start;
}
.contentmenu,.ui-widget-header{display:none}
#org{
	margin-left:auto;
	margin-right:auto;
	margin-top: -110px;
	left:0;
	right:0;	
	width:88%;  
	padding:20px;    
	z-index: 999;
	background-color:#D2E0F2;
	border-radius: 10px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;
	position: absolute;
 	display:none; 	
}
@media screen and (max-width: 1206px) {
	#welcome{
		width:90%;
	}
	#aviancahome{
		width:62%;
	}
	#textohome{
		width:26%;
 		margin-left:1em;
	}
	#descripcion{
		width:90%;
		margin-top:2em;
	}
}
@media screen and (max-width: 650px) {
	#welcome{
		width:85%;
	}
	#aviancahome{
		width:98%;
	}
	#textohome{
		width:89%;
		margin-top:2em;
		margin-left:0px;
	}
	#descripcion{
		width:89%;
		margin-top:2em;
	}
}

@media screen and (max-width: 550px) {
	#welcome{
		width:82%;
	}
	#aviancahome{
		width:100%;
	}
	#textohome{
		width:80%;
		margin-top:2em;
		margin-left:0px;
	}
	#descripcion{
		width:80%;
		margin-top:-2.5em;
	}
}
#tituloenc{background:#DC2A23;color:#fff;width:96%;border-radius:0px;margin-top:0px;padding: 2em;}
#contenedor{    
	width: 77%;
    margin: 0 auto;
}
#leftitle{
	float:left;
	width:70%;
	 line-height: 0px;
}
#logo{
	float:left;
	width:30%;
 }
#logo img{
	width: 35%;
	float: right;	
}
.rcv{float:left; width:100%;}
@media screen and (max-width: 1000px) {
	.rcv{width:100%;}
}
@media screen and (max-width: 795px) {
	.rcv{width:100%;}
	#logo img{
		width: 100%;
 	}
}
@media screen and (max-width: 450px) {
	.rcv{width:100%;}
	#logo img{
 		width: 97%;
 	}
	#leftitle{
 		width:60%;
		font-size:12px;
	}
	#leftitle h2{
 		font-size:22px !important;
		line-height: 22px;
		text-align: center !important;  
	}
	#contenedor{
		width:100%;
	}
}
@media screen and (max-width: 350px) {
	.rcv{width:100%;}
	#logo img{
 		width: 97%;
 	}
	#leftitle{
 		width:60%;
		font-size:12px;
	}
	#leftitle h2{
 		font-size:14px !important;
		line-height: 20px;
		text-align: left !important;  
	}
	#contenedor{
		width:100%;
	}
}
.footer{display:none !important;}
.footer2{    text-align: center;
    margin: 0 auto;
    padding-top: 0.4em;
    border-top: 1px solid #eee;
    width: 98%;
    clear: both;}

</style>
 <script>
	jQuery(function(){
		controlEncuesta();
 	});
<? 
	$ides=NULL;
	if(count($totalnodos)>=1){ ?>
	
	google.charts.load('current', {packages:["orgchart"]});
	google.charts.setOnLoadCallback(function(){
		//jQuery("#chart_div").show();
		//drawChart(jQuery(this).val());
		drawChart();
		event();
	});
  	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Name');
		data.addColumn('string', 'Manager');
		data.addColumn('string', 'ToolTip');

		// For each orgchart box, provide the name, manager, and tooltip to show.
		var orgam=   <?=json_encode($organigrama,JSON_HEX_QUOT | JSON_HEX_TAG)?>  ;
 		/*var orgam=[
					[{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},'', 'The President'],
					[{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},'Mike', 'VP'],
					['Alice', 'Mike', ''],
					['Bob', 'Jim', 'Bob Sponge'],
					['Carol', 'Bob', '']
				];	*/
		// console.log(orgam);

		data.addRows(orgam);

		// Create the chart.
		var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
		// Draw the chart, setting the allowHtml option to true for the tooltips.
		//chart.draw(data, {allowHtml:true});
 	}
 <? if(count($totalnodos)==1){ ?>
// window["idestructura"]=<?=$totalnodos[0]?>;
 <? }else{ ?>
	// window["idestructura"]="";
 <? } ?>
	function event(){
		jQuery(".google-visualization-orgchart-node").css({"border":"none"});
		jQuery("[rel^='estruc_']").click(function(){ 
			var id=jQuery(this).attr("rel").split("_")[1];//console.log(id);
			window["idestructura"]=id;
			//var src="<?=$_SERVER["SCRIPT_NAME"]?>/751388/lang-es?idestructura="+id+"&random=<?=$random?>";
			jQuery("#encuesta").show();
			jQuery("#org").hide("slow");
			//jQuery("#encuesta").removeAttr("src");
			//jQuery("#encuesta").attr({"src":src});
		});
		
	}
	window["modeljson"]=JSON.parse('<?=$organigramajson?>');
	
	jQuery(function(){
		jQuery("[rel='cerrar']").click(function(){
			jQuery(this).parent().hide("slow");
 		});
		var initpadre=modeljson[0][0]["key"];
		
		//jQuery("#chart_div2").html('<select id="'+init+'"');
		
		var obj=getElements(initpadre);
		var selector=getSelector(obj,initpadre);
		jQuery("#chart_div2").append(selector);
 		events();
		jQuery("[rel='enviar']").click(function(){ 
			var id=jQuery(jQuery("[name^='nodos_']:checked").last());//console.log(id); 
			window["idestructura"]=id.val().split("_")[0];
			var src="<?=$_SERVER["SCRIPT_NAME"]?>/<?=$sid?>/lang-es";
			var iframe='<div id="ciframe"  ><iframe  id="encuesta"  name="encuesta" src="'+src+'"  style="width:96%;height:95%;border: none; overflow-y:scroll" ></iframe></div>';
			jQuery("#org").hide("slow");
			jQuery.colorbox({html:iframe,width:"100%",height:jQuery("body").height()+"px"});
 			//jQuery("#encuesta").show();
			jQuery("#org").hide("slow");
			 
			//jQuery("#cboxOverlay").css({"opacity":"0","display":"none","z-index":"111"});

			//jQuery("#encuesta").removeAttr("src");
			//jQuery("#encuesta").attr({"src":src});
		});
		jQuery("[rel='cambiar']").click(function(){
			jQuery("#org").show("slow");
			jQuery("#cboxOverlay").css({"opacity":"1","display":"block","z-index":"111"});

		});
	});
 	function events(){
		jQuery("[name^='nodos_']").unbind();
		jQuery("[name^='nodos_']").bind("click",function(){
			var initpadre=jQuery(this).val().split("_");
			if(initpadre[0]>0){
				var obj=getElements(initpadre[0]);
				var selector=getSelector(obj,initpadre[0],initpadre[1]);
 				var html="";
 				jQuery("[rel='"+initpadre[1]+"']").remove();
				if(jQuery("[rel='"+initpadre[1]+"']").size()>1){
					jQuery("[rel='"+initpadre[1]+"']").remove();
 				}				
				if(selector==""){
					html="";
				}else{
					html=selector;
					
				}
				jQuery("#chart_div2").append(html);
				console.log(jQuery("[rel='"+initpadre[1]+"']").size())
				
  				events();
			}
		});		
	}
	function getSelector(obj,initpadre,abuelo){
		var html='';
		//console.log(jQuery("[id='nivel_"+initpadre+"']").size());
		if(jQuery("[id='nivel_"+initpadre+"']").size()==0){
			html='<div id="nivel_'+initpadre+'" rel="'+abuelo+'" style="background-color:#fff;padding:10px"><span>Seleccione...</span><div style="clear:both"></div>';
			var contador=0;
			jQuery.each(obj,function(k,d){
				html+='<input type="radio" name="nodos_'+initpadre+'" value="'+d["key"]+'_'+initpadre+'" />'+d["nivel"]+'-'+d["nodo"]+'</br>';
				contador++;
			});
			html+='</div>';
			if(contador==0){
				html="";
			}
		}
		return html;
	}
	function getElements(idpadre){
		var obj={};
		jQuery.each(modeljson,function(k,d){
			if(d[1]==idpadre && idpadre!=undefined){console.log(d[1]+"="+idpadre);
				obj[d[0]["key"]]=d[0];
			}
		});
		return obj;
	}
<? }else if(count($totalnodos)==1){
	$ides=$totalnodos[0];
	?>
	// window["idestructura"]=<?=$ides?>;
	<?
} 
?>

	jQuery(function(){
		//alert(navigator.appName+" "+navigator.appVersion);
		jQuery("[rel='cerrar']").click(function(){
			jQuery(this).parent().hide("slow");
			jQuery("#cboxOverlay").css({"opacity":"0","display":"none","z-index":"111"});

 		});
		
		
		//jQuery.each(modeljson,function(k,d){});
		jQuery("#aceptaterminos").click(function(){
 			//jQuery("#welcome").hide("slow");
			var src="https://www.talentracking.com<?=$_SERVER["SCRIPT_NAME"]?>/<?=$sid?>/lang-es";
			//var iframe='<iframe  id="encuesta"  name="encuesta" src="'+src+'?referencia=<?=$org->id?>&idtoken=<?=$idtoken?>"  style="width:96%;height:95%;border: none; overflow-y:scroll" ></iframe>';
			//jQuery("#org").hide("slow");
			var test=(navigator.appVersion).split("iPhone");
			//if(test[1]!=undefined){
				document.location=src+'?referencia=<?=$org->id?>&idtoken=<?=$idtoken?>';
			//}else{
			//	jQuery.colorbox({html:iframe,width:"96%",height:jQuery("body").height()+"px",});
			//	jQuery("#cboxClose").remove();
			//}
 		});
		jQuery("#verterminos").click(function(){
			var html=jQuery("#textTerminos").html();
			jQuery.colorbox({html:html,width:'90%',height:jQuery("body").height()+"px"});
  		});
		jQuery(".contentmenu,.ui-widget-header").remove();
		jQuery(".maintitle").remove();
		jQuery("#content").css("margin-top","0px");
	});
	
function controlEncuesta(){	
	window["refreshIntervalId"] = setInterval(function(){ 
		if(jQuery("#encuesta").size()>0){
			if(jQuery("#encuesta").contents().find("#completed").size()>=1){ console.log("test-listo");  
 				clearInterval(window["refreshIntervalId"]);
				setTimeout(function(){
					jQuery.colorbox.close(); 
					jQuery("#welcome").hide("slow");
					jQuery("#gracias").show("slow");
					autolink();
				},2000);
			}
 		}
	},500);	
}
function autolink(){
	
	
	window["conta"]=5;
	var tim=setInterval(function(){
		
		if(window["conta"]>=0){
			jQuery("#redir").html("<b style='font-size:17px'>Revisa tu correo tu diagnóstico esta llegando!</b><br><br><b style='font-size:30px'> "+window["conta"]+"</b>");
			window["conta"]--;
		}
		if(window["conta"]==0){
			clearInterval(tim);
			document.location="http://www.talentracking.com";
		}
		
	}, 1000);	
	
	
	
}
	
	


</script>

<div id="content">
 <div id="textTerminos" style="display:none">
	<h1>AVISO DE PROTECCIÓN DE DATOS PERSONALES</h1>
			
			<p>Apreciado colaborador de <?=$nombreorganizacion?></p>
			
			<p>En virtud de la entrada en vigencia de la Ley Estatutaria 1581 del 2012 mediante la cual se dictan las disposiciones generales para la protección de datos personales, y su Decreto Reglamentario 1377 de 2013, <?=$nombreorganizacion?>, considerada como responsable y/o encargada del tratamiento de datos personales, requiere de su autorización para continuar con el tratamiento de sus datos personales almacenados en nuestras bases de datos, las cuales incluyen información que ustedes nos han reportado en desarrollo de las diferentes actividades realizadas por nuestra compañía, en particular los siguientes: nombres, número de documento de identificación, dirección, teléfono fijo y móvil, direcciones, correo electrónico, profesión.
				
			Finalidad: Los datos serán utilizados para:</p>
			<p>
				</p><ul>
					<li>- El cumplimiento de obligaciones legales o contractuales contraídas con usted </li> 
					<li>	- Adelantar procesos de evaluación - Proveer productos y servicios. </li> 
					<li>- Transferencia y transmisión de sus datos personales a terceros</li> 
				</ul>
			<p></p>
			<p>
			La información y datos personales suministrado, podrán ser procesados, recolectados, almacenados, usados, circulados, suprimidos, compartidos, actualizados, las actividades mencionadas las podremos realizar a través de diferentes medios tales como correo físico, electrónico, celular o dispositivo móvil, vía mensajes de texto (1\1 S y/o MMS), o a través de cualquier medio análogo y/o digital de comunicación, conocido o por conocer.
			
			Derechos: Los derechos que le asisten sobre sus datos personales son: conocer, actualizar y solicitar la rectificación o supresión de datos; conocer el uso que hace <?=$nombreorganizacion?> de sus datos personales y revocar en cualquier momento la autorización de la inclusión de sus datos personales en las bases de datos de <?=$nombreorganizacion?>, no recolecta ni maneja información sobre datos sensibles. En el evento de llegar a solicitar información sobre este tipo de datos, se deja constancia que la repuesta es totalmente facultativa.
			
			Autorización: Los Titulares podrán ejercer sus derechos de conocer, actualizar, rectificar y suprimir sus datos personales enviando su solicitud a al área de HSE de <?=$nombreorganizacion?>, dentro de los treinta días (30) siguientes a la fecha de este comunicado. Si usted no da respuesta entenderemos que ha autorizado a <?=$nombreorganizacion?> para continuar con el tratamiento de sus datos personales, tal como lo establece la ley 1581 de 2012.
			</p>
</div>
		<div   id="tituloenc" > 
			<div id="contenedor">
				<div id="leftitle">
				<?   
					
					$queryString = "
					SELECT 
					*
					FROM {{surveys_languagesettings}}
					WHERE surveyls_survey_id=".$sid; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$titulo = $eguresult->readAll();
					echo "<h2 style='text-align: center;font-weight: bold;'>".$titulo[0]["surveyls_title"]."</h2>";
					
				?>
				</div>
				<div id="logo">
					<a href="/" target="_blanck"><img src="<?=Yii::app()->baseUrl?>/upload/templates/skeletonquest2/images/logos.png"  ></a>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
<div id="gracias" class="divContentBlue" style="display:none">
		<div id="descripcion" style="padding:2em !important">
			  
				<center><div id="redir" >6</div></center>
			 
			 <div style="clear:both"></div>
		</div>	
		<div style="clear:both"></div>
</div>		
<div id="welcome" class="divContentBlue" style="display:block">

		<br>
		<br>
 		<div   id="aviancahome"> <img src="<?=Yii::app()->baseUrl?>/upload/templates/skeletonquest2/images/shutterstock_125105273_opt.jpg" width="100%"></div>
		<div   id="textohome">
			<p> 
				<b>Bienvenido</b>
			</p>
			<p>

			Después de contestar estas preguntas, sabrás si el cuidado es una prioridad en tu vida.
			</p>
		</div>
		
 		 	
		
		<div id="descripcion">
			<p>
			
Al finalizar la encuesta recibirás en tu correo electrónico el resultado de tu encuesta y una invitación para convertirte en Voluntario de Corazones Responsables. 			
			</p>
			<p>
			
Gracias por tu apoyo somos más Corazones Responsables.
			</p>
		</div>
		
		<div style="clear:both"></div>
		<input type="button" value="Acepto terminos y condiciones" id="aceptaterminos" style="float:left" /><input   style="float:left;" type="button" id="verterminos" value="Ver terminos y condiciones"/>
	<div style="clear:both"></div>
</div>	
 
 <? if($demo==false){ ?>
		<? }else{ ?>
		<script>
			jQuery(function(){
				
				jQuery.colorbox({html:"<h3>Su periodo de prueba ha terminado</h3>"});
			})
			
		</script>
		
		<?} ?>	

 
	<div style="clear:both"></div>			 
</div>
<div style="clear:both"></div>		
<div class="footer2"  >
Plataforma de análisis en tiempo real diseñada por Talentracking® copyright © 2016 -  Todos los derechos reservados.
</div>