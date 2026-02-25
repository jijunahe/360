<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/login";
	 
?>
 <style>
 #addUpdate{
	position:absolute;
	width:100%;
	display:none;
	margin-top:40px;
  }
  #modal{
	width:30%;
	background-color:#2E75B5 !important;
  }
  #titulo{
	color:#fff;
  }
  
  
@media (max-width: 900px) {
  #modal{
	width:50%;
   }
}  
@media (max-width: 600px) {
  #modal{
	width:70%;
   }
}   

@media (max-width: 500px) {
  #modal{
	width:95%;
   }
}   
  
 </style>

 
 
<? if($estado==1){ ?>

<style>
.datos{
	margin-left: 94px;
	margin-top: -150px;	
	text-align: left;
	position: absolute;
	border-radius: 10px;
	padding: 11px;
	border: 1px solid #EDEDFB;
	background-color: #D2E0F2;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;
	-moz-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;	
	
}
</style>
<script>
	window["nodo"]=310;
	window["nodos"]=[310,311,312,313];

	google.charts.load('current', {packages:["orgchart"]});
	google.charts.setOnLoadCallback(function(){
		//jQuery("#chart_div").show();
		//drawChart(jQuery(this).val());

 		drawChart();
		
	});
	var GLOBALAR=[];
 	var indexofids=[];
 	var usuarios=[];
 	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Name');
		data.addColumn('string', 'Manager');
		data.addColumn('string', 'ToolTip');

		// For each orgchart box, provide the name, manager, and tooltip to show.
		<? if($jsonorg!=""){ ?>
			if(GLOBALAR.length==0){
				var orgam= <?=json_encode($jsonorg,JSON_HEX_QUOT | JSON_HEX_TAG)?> ;
				GLOBALAR=orgam;
				
				var id=<?=$_GET["organizacion"]?>;
				var options=jQuery("[name='Estructura[idorganizacion]']").find("option");
				var eq=-1;
				jQuery.each(options,function(k,d){
					var obj=JSON.parse(jQuery(d).val());
					if(id==obj.id){
						eq=k;
					}
				});
			}
			jQuery("[name='Estructura[idorganizacion]']").find("option:eq("+eq+")").attr("selected","selected");
 		<? } else{?>
		var orgam=[];
		<? } ?>
 		/*var orgam=[
					[{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},'', 'The President'],
					[{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},'Mike', 'VP'],
					['Alice', 'Mike', ''],
					['Bob', 'Jim', 'Bob Sponge'],
					['Carol', 'Bob', '']
				];	*/
				<? $path=explode("www/admin",$_SERVER["PATH_TRANSLATED"]); ?>
		var action="<?=Yii::app()->baseUrl?>/index.php/admin/<?=$path[1]?>";
		<? if(isset($_GET["organizacion"])){ ?>
		var idorg=<?=$_GET["organizacion"]?>;
		var testid=JSON.parse(idorg);
 		if(testid["id"]!=undefined){
			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: action,
				data:{id:testid["id"]},
				success:function(res){
					usuarios=res;
				}
			});
 		}
	<? } ?>
		if((arguments[0]!=undefined && arguments[0]!=false) && arguments[1]==undefined){
 			orgam=[];
			var json=JSON.parse(arguments[0]);
 			var selectobj=jQuery('<div><?=$nivelhtml?></div>');
			selectobj.find("select").attr({"id":"padre_org-"+json.id,"name":json.nombre});
			var htmlbox='<div style="border:1px solid #EDEDFB;border-radius:10px">';
				htmlbox+='<b>Seleccione un nivel:</b>'+selectobj.html();
				htmlbox+='</div>';
 				
			var selus='<tr><td><b>Responsable:</b></td><td><div style="overflow-x:hidden;overflow-y:scroll;height:80px;color:#000;background-color:#fff;border-radius:8px;padding-left:3px">';
 				jQuery.each(usuarios,function(k,v){
					selus+='<input type="checkbox" name="usuario_org-'+json.id+'" value="'+v.id+'" />'+v.alias+'<br>';
				});
				selus+='</div></td></tr>';
				
			var nombre='<tr><td><b>Nombre:</b></td><td><input type="text" name="Estructura[org-'+json.id+'][nombre]" /></br></td></tr>';
			var descripcion='<tr><td><br><b>Descripción:</b></td><td><textarea name="Estructura[org-'+json.id+'][descripcion]" ></textarea></br></td></tr>';
 			var htmldatos=nombre+selus+descripcion;
 			var cerrar='<input type="image" src="<?=Yii::app()->baseUrl?>/img/bad.gif" style="float:right"   rel="cerrar_'+json.id+'" ><div style="clear:both"></div>';
 			var editar='<div style="clear:both"></div><b>Editar:</b><input type="image" src="<?=Yii::app()->baseUrl?>/img/edit.gif" style="float:right"   rel="editarinfo_org-'+json.id+'" >';
			var html='<div style="color:red; font-style:italic;"  >'
 				html+='<b>Agregar</b><input type="image" src="<?=Yii::app()->baseUrl?>/img/add.gif"  rel="event_org-'+json.id+'"   name="'+json.nombre+'" >';
 				html+='<div style="display:none;margin-top: -55px;" id="edita_org-'+json.id+'" class="datos">'+cerrar+htmlbox+'</div>';
 				html+=editar+'<div   id="datos_org-'+json.id+'"  class="datos" style="display:none">'+cerrar+'<table>'+htmldatos+'</table></div>';
				html+='</div>';
			
			
			orgam=[[{v:"org-"+json.id, f:'<div rel="titulo_org-'+json.id+'">'+json.nombre+'</div>'+html},"org-"+json.id, '']];
 			GLOBALAR=orgam;
		}
		//AgregarS
		if(arguments[0]==false && (arguments[1]!=undefined && arguments[1]!=false )){
			
			GLOBALAR.push(arguments[1]);
			orgam=GLOBALAR;
		}
		//ELIMINAR NODOS
		if(arguments[0]==false && arguments[1]==false && arguments[2]!=undefined){
  			orgam=GLOBALAR;
		}

		data.addRows(orgam);

		// Create the chart.
		var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
		// Draw the chart, setting the allowHtml option to true for the tooltips.
		chart.draw(data, {allowHtml:true});
		jQuery(".google-visualization-orgchart-node").css({"border":"none"});
				<? if($jsonorg!=""){ ?>
					event();
				<? } ?>
		getUrl();

 	}
 	jQuery(function(){
		jQuery("[name='Estructura[idorganizacion]']").change(function(){
			var idorg=jQuery(this).val();
			var jt=JSON.parse(idorg);
			var action="<?=Yii::app()->baseUrl?>/index.php/admin/estructuraorg/validaorg";
			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: action,
				data:{id:jt.id},
				success:function(res){
					if(res[0]!="n"){
						console.log(res[0]);
						document.location=res[0];
					}
				}
			});			
 		
		
		
			jQuery("#chart_div").show();
   			drawChart(idorg);
			event();
 		});

		
	});
function getUrl(){
	jQuery("#reporte").attr({"src":"<?=Yii::app()->baseUrl?>/images/loader.gif"}); 
	setTimeout(function(){	
		var tab=jQuery("[class*='ui-state-active']").find("a").attr("href").split("-")[1];
		var versus=jQuery("[name='versus']:checked").val();
		var estructuras= jQuery("[name='nodo']:checked");
		var estrselected=[];
		 jQuery.each(estructuras,function(k,d){
			var atom=jQuery(d).val(); 
			 estrselected.push(atom);
		 });
		var strEstructuras=  getEstructuras(true);
		var paranmA=getAtoms(true);
		var obj=[{'estructura':strEstructuras,'ikey':"rcv",'filtros':paranmA,'base':tab,'versus':versus,'idorg':<?=(int)$_GET['organizacion']?>}];
		//var urlbase="https://www.talentracking.co/node/"+window["nodo"]+"?embed=1&idestructura="+strEstructuras+"&token=<?=$token?>"+paranmA;
		var urlbase="https://talentracking.com/reportes/index.php?mode=getdata&token="+btoa(JSON.stringify(obj));
		jQuery("#reporte").attr({"src":urlbase}); 
	},300);
	//cargando(); 
 }
function event(){ 
	jQuery(".google-visualization-orgchart-node").css({"border":"none"});
	<? if(isset($_GET['organizacion'])){?>jQuery("[name='organizacion']").val(<?=(int)$_GET['organizacion']?>);<?} ?>
 	 jQuery("[name='nodo']").click(function(){
		getUrl() 
		 
	 });
	 jQuery("[name='versus']").click(function(){
		getUrl() 
		 
	 });
	 jQuery("[name='anio']").change(function(){
		if(jQuery("[name='organizacion']").val()>-1){ 
			var estructuras= jQuery("[name='nodo']:checked");
			var estrselected=[];
			 jQuery.each(estructuras,function(k,d){
				var atom=jQuery(d).val(); 
				 estrselected.push(atom);
			 });
			 
			var strEstructuras= "<?=$idestructura?>";
			if(estrselected.length>0){
				strEstructuras=estrselected.join(",");
			} 
			var anio="";
			if(jQuery("[name='anio']").val()>0){
				anio="&anio="+jQuery("[name='anio']").val();
			}
			var urlbase="https://www.talentracking.co/node/"+window["nodo"]+"?embed=1&idestructura="+strEstructuras+"&token=<?=$token?>"+anio;
			jQuery("#reporte").attr({"src":urlbase}); 
		}else{alert("Por favor seleccione una empresa");}
	 });
	 
	 jQuery("[name='organizacion']").change(function(){
		 var id=jQuery(this).val();
		 var ptrotocol=document.location.protocol;
		 var host=document.location.host;
		 var path=document.location.pathname;
		 var hrefnex='organizacion='
		 document.location=ptrotocol+"//"+host+path+"?"+hrefnex+id;
	 })
	 
	 jQuery("[rel^='atom']").click(function(){
		getUrl();
 	 }); 
 }
var tglobalchange=[];
 
function getAtoms(arreglo=false){
	var obj=jQuery("[rel^='atom']:checked"); 
	var atoms=[];
	var Control={};
 	 jQuery.each(obj,function(k,d){
 			var data=(jQuery(d).attr("rel")).split("_");
			if(data[2]!="NaN"){
				atoms.push("param"+data[1]+"="+data[2]);
			}
			if( Control[data[1]]==undefined ){
  				Control[data[1]]=[data[2]];
			}else{
				var t=Control[data[1]];
				t.push(data[2]);
				Control[data[1]]=t;
			}
 	 });
	  
	 
	 var rat=[];
	 var objr={};
	 jQuery.each(Control,function(k,d){
		 rat.push("param"+k+"="+d);
		 objr[k]=d;
	 })
 	 
	 var respuesta="";
	 
	 if(arreglo==false){
		respuesta=rat.join("&");
	 }else if(arreglo==true){
		respuesta=[];
		respuesta=objr;
	 }
	 
	 return respuesta;
 }
 function getEstructuras(arreglo=false){
	var nodos=jQuery("[name='nodo']");
		var rnodos=[];
		jQuery.each(nodos,function(k,d){
			if(jQuery(d).is(":checked")){
				rnodos.push(jQuery(d).val());
			}
 		});
		
		if(rnodos.length<=0){
			rnodos=[];
 			var estructuras= jQuery("[name='nodo']");
 			 jQuery.each(estructuras,function(k,d){
				var atom=jQuery(d).val(); 
				 rnodos.push(atom);
			 });
   		} 	
		var strEstructuras="";
		if(rnodos.length>0 && arreglo==false){
			strEstructuras="&idestructura="+rnodos.join(",");
		}else{
			strEstructuras=[];
			strEstructuras=rnodos;
			
		}

	 return strEstructuras;
 }
function getTabs(){
	setNodo();
	jQuery("[id^='ui-id-']").click(function(){setNodo();
 		getUrl();
    });
		
}

function setNodo(){
 	jQuery("[role='presentation']").click(function(){
		var idk=(jQuery(this).attr("href")).split("-")[1];
		window["nodo"]=window["nodos"][idk];
	});
}
 
 function cargando(){ 
	 jQuery("#reporte").attr({"style":"height:0px;width:100%;overflow-x:hidden"});
	 jQuery("#loadig").show(); 
	 setTimeout(function(){
		 jQuery("#loadig").hide(); 
		 	 jQuery("#reporte").attr({"style":"height:"+jQuery(document).height()+"px;width:100%;overflow-x:hidden"});

		 
	 },1500); 
	 
 }
 
</script>

<? } ?>
  
 
<div id="content">
   	<div class="divContentBlue">
		<h3><?=$titulo?></h3>
 		<div class="divContentWhite">
  			<div style="clear:both"></div>
				

				<? if($estado==1){ ?>
				<center>
					<?=$organizaciones?>
					<div id="chart_div" <? if($jsonorg==""){ ?> style="display:none" <? } ?>></div>
				</center> 
				<? }else{ echo  $jsonorg; } ?>
				<br>

				<div style="clear:both"></div>
 				
				
 
				<div id="tabs">
				  <ul>
 					<? foreach($criterios as $k=>$criterio){ ?>
						<li><a href="#tabs-<?=$k?>"><?=$criterio?></a></li>
					<?  } ?>					
				  </ul>
					<? foreach($criterios as $k=>$criterio){ ?>
 						<div id="tabs-<?=$k?>"></div>
					<?  } ?>				  
				   
				</div>	

				<script>
				$( function() {
				$( "#tabs" ).tabs();
				getTabs();
				} );
				</script>				
 				
				<div style="clear:both"></div>
		
				
				
				 <script>
				  $( function() {
					$( "#accordion" ).accordion({
					  collapsible: true,
					  heightStyle: "content"
					});
				  } );
				  </script>
				  
				<div id="accordion" style="width:20%;float:left">

					<? $listas=array();
						$validar=array('rangoedad','estadoCorporal','rangotrigliseridos','rangoglisemia','rangohdl','rangocolesterol','riesgom','riesgo','rangoScore');

						$titles=array('rangoedad'=>'Rango edad',
						'estadoCorporal'=>'Estado corporal',
						'rangotrigliseridos'=>'Rango Triglicéridos',
						'rangoglisemia'=>'Rango Glicemia',
						'rangohdl'=>'Rango HDL',
						'rangocolesterol'=>'Rango Colesterol',
						'riesgom'=>'Framingham Modificado',
						'riesgo'=>'Framingham (clásico)',
						'rangoScore'=>'Rango Score');

						foreach($dimensiones as $data){ array_push($listas,$data[0]);   ?>
						<h3>
						<?
						 if(in_array($data[1],$validar)){
							 echo $titles[$data[1]]; 
						 }else{ echo $data[1];}
						
						?>
						</h3>
						<ul><li><input type="radio" name="versus" value="<?=$data[0]?>" /> <b>Todos</b></li>
						<?foreach($data[2] as $option){ ?>
							<li><label><input type="checkbox" name="<?=$data[0]?>" rel="atom_<?=$data[0]?>_<?=$option?>" /><b><?=$option?></b></label></li>
						<? } ?>
 						</ul>
					<?} ?>

				 
				</div>				
				
				<div style="float:left;width:75%; margin-left:2px">
				<!--
 					<iframe id="reporte" name="reporte" src="https://www.talentracking.co/node/310?embed=1&paramempresa=<?=$_GET['organizacion']?>&token=<?=$token?>"  ></iframe>  
 				-->
						<center><div id="loadig" style="display:none"><img src='<?=Yii::app()->baseUrl?>/images/loader.gif' /></div>
						<iframe id="reporte" name="reporte" src="" ></iframe></center>
				</div>
 			<div style="clear:both"></div> 
		</div>
 	</div>
	<div style="clear:both"></div>			 
</div>
<? // printVar(join(",",$listas));?>
<script>
	jQuery(function(){
		 jQuery("#reporte").attr({"style":"height:"+jQuery(document).height()+"px;width:100%;overflow-x:hidden"});
		 
 	});
</script>
