<?php
	// printVar(json_encode($organigrama, JSON_HEX_QUOT | JSON_HEX_TAG));exit;
	 // printVar($random); 
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
	background-color: #D2E0F2;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;
	-moz-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;	
	
}
.rcv{float:left; width:48%; margin-left:10px;}
@media screen and (max-width: 1000px) {
	.rcv{width:47%;}
}
@media screen and (max-width: 795px) {
	.rcv{width:100%;
	margin-left: 0px;
	}
}

	
</style>
 <script>
<? 
	$ides=NULL;
	if(count($totalnodos)>1){ ?>
	
	google.charts.load('current', {packages:["orgchart"]});
	google.charts.setOnLoadCallback(function(){
		//jQuery("#chart_div").show();
		//drawChart(jQuery(this).val());
		//drawChart();
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
		chart.draw(data, {allowHtml:true});
 	}
 <? if(count($totalnodos)==1){ ?>
 window["idestructura"]=<?=$totalnodos[0]?>;
 <? }else{ ?>
	 window["idestructura"]="";
 <? } ?>
	function event(){
		jQuery(".google-visualization-orgchart-node").css({"border":"none"});
		jQuery("[rel^='estruc_']").click(function(){ 
			var id=jQuery(this).attr("rel").split("_")[1];//console.log(id);
			window["idestructura"]=id;
			var src="<?=$_SERVER["SCRIPT_NAME"]?>/425936/lang-es?IDESTRUCTURA="+id+"&random=<?=$random?>";
			jQuery("#encuesta").show();
			jQuery("#org").hide("slow");
			jQuery("#encuesta").removeAttr("src");
			jQuery("#encuesta").attr({"src":src});
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
			var src="<?=$_SERVER["SCRIPT_NAME"]?>/425936/lang-es?IDESTRUCTURA="+window["idestructura"]+"&random=<?=$random?>";
			jQuery("#encuesta").show();
			jQuery("#org").hide("slow");
			jQuery("#encuesta").removeAttr("src");
			jQuery("#encuesta").attr({"src":src});
		});
		jQuery("[rel='cambiar']").remove();
		/*jQuery("[rel='cambiar']").click(function(){
			jQuery("#org").show("slow");
		});*/
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
	 window["idestructura"]=<?=$ides?>;
	<?
} 
?>

	jQuery(function(){
		jQuery("[rel='cerrar']").click(function(){
			jQuery(this).parent().hide("slow");
 		});
		
		controlEncuesta();
		//jQuery.each(modeljson,function(k,d){});
ajustarbanner();
});
function ajustarbanner(){
	if(jQuery(".bannermodulo").size()>0){
		var urlimg="<?=Yii::app()->baseUrl?>/images/pcos/<?php if($demo!=true){ ?>pago<?}else{?>demo<?}?>/";
		var width=jQuery(window).width();
		if(width<=533){
			urlimg=urlimg+533+"/";
		}
		
		if(width>=534 && width<=820 ){
			urlimg=urlimg+820+"/";
		}
		
		if(width>=821  ){
			urlimg=urlimg+1080+"/";
		}
		jQuery(".bannermodulo").attr({"src":urlimg+jQuery(".bannermodulo").attr("rel")});
	}
}	
	
	window["refreshIntervalId"] = setInterval(function(){
		/*
		jQuery("#IDS",encuesta.document).each(function(){         
			if(jQuery(this).attr('id')=="IDS"){
				//clearInterval(window["refreshIntervalId
				//jQuery("#encuesta").attr("src","<?=$_SERVER["SCRIPT_NAME"]?>/425936/lang-es?idestructura="+window["idestructura"]+"&random=<?=$random?>");
				//jQuery("#iframe1").attr("src","https://www.talentracking.co/node/204?embed=1&token=<?=$token?>&idestructura=<?=$ides?>&paramidAnswer="+jQuery(this).val());
 				document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/rcv/herramienta?idAnswer="+jQuery(this).val()+"&idestructura="+window["idestructura"];
 			}
		});
		*/ 
	},1000);	
function controlEncuesta(){	
	window["refreshIntervalIdautolinck"] = setInterval(function(){ 
		if(jQuery("#encuesta").size()>0){
			if(jQuery("#encuesta").contents().find("#completed").size()>=1){ console.log("test-listo");  
 				clearInterval(window["refreshIntervalIdautolinck"]);
				setTimeout(function(){
 					 jQuery("#pentaho").attr("src","https://www.talentracking.co/node/204?embed=1");
 					 //jQuery("#encuesta").attr("src","");
				},2000);
			}
 		}
	},2000);	
}	
	


</script>
<? if(count($totalnodos)>1 and $demo==false){ ?>
 <div class="divContentBlue" id="org" style="width:80%;  padding:20px;    z-index: 999;position:absolute;background-color:#D2E0F2;    border-radius: 10px;-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;">
	<input type="image" src="<?=Yii::app()->baseUrl?>/img/bad.gif" style="float:right"   rel="cerrar" ><div style="clear:both"></div>
	<b>Por favor, seleccione algún nivel al que quiera aplicar la encuesta</b>
	<div style="clear:both"></div>
	<div id="chart_div2"  ></div>
	<div style="clear:both"></div>
	<input type="button" value="Enviar"  rel="enviar"/> 
	<div id="chart_div" style="display:none"  ></div>
</div>
<? } ?>
<div id="content">
	<div style="clear:both" ></div> 
	
	<img class="bannermodulo"  <?php if($demo==true){ ?>id="costos" style="cursor:pointer;width:100%;height:20%"<? } else{?> style="width:100%;height:20%" <? } ?> rel="moduloseguimientolineabase.png"  />
  
 <div class="divContentBlue">
		<h3><b><span id="r_titulo"></span></b></h3>
		<? if($demo==false){ ?>
		<div class="divContentWhite">
			<!--div class="divContentBlue rcv"  >
				<div class="divContentWhite">
 					Encuesta
					<div style="clear:both"></div>
					<iframe  id="encuesta"  name="encuesta" src=""  style="width:96%;height:800px;border: none; overflow-y:scroll<? if($ides==NULL){echo "display:none";} ?>" ></iframe>
				</div>
			</div-->
			<div class="divContentBlue"  > 
				<div class="divContentWhite">Pentaho
				<iframe  id="pentaho"   name="pentaho" src="https://www.talentracking.co/node/204?embed=1&token=<?=$token?>&idestructura=<?=$ides2?><? if((int)$idAnswer>0){ echo "&paramidAnswer=".$idAnswer;} ?>"  style="width:100%;height:4000px;border: none; overflow-y:scroll<? if($ides==NULL){echo "display:none";} ?>" ></iframe>
 				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<? }else{ ?>
		<script>
			jQuery(function(){
				
				jQuery.colorbox({html:"<h3>Su periodo de prueba ha terminado</h3>"});
			})
			
		</script>
		
		<?} ?>	
	</div>
	<div style="clear:both"></div>			 
</div>
