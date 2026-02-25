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
	window["nodo"]=257;
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
function event(){ 
	jQuery(".google-visualization-orgchart-node").css({"border":"none"});
	<? if(isset($_GET['organizacion'])){?>jQuery("[name='organizacion']").val(<?=(int)$_GET['organizacion']?>);<?} ?>
 	 jQuery("[name='nodo']").click(function(){
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
			anio="&paramanio="+jQuery("[name='anio']").val();
		}
		var urlbase="https://www.talentracking.co/node/"+window["nodo"]+"?embed=1&idestructura="+strEstructuras+"&token=<?=$token?>"+anio;
 		jQuery("#reporte").attr({"src":urlbase}); 
		 
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
				anio="&paramanioc="+jQuery("[name='anio']").val();
			}
			var urlbase="https://www.talentracking.co/node/"+window["nodo"]+"?embed=1&idestructura="+strEstructuras+"&token=<?=$token?>"+anio;
			jQuery("#reporte").attr({"src":urlbase}); 
		}else{alert("Por favor seleccione una empresa");}
	 });
	 
	 
	 
}
var tglobalchange=[];
 
 
 
 
 
</script>

<? } ?>
<script>
jQuery(function(){
	jQuery("[name='organizacion']").change(function(){
 		jQuery("[id='selectorgam']").submit();
	});
  });	 
      
jQuery(function(){
	jQuery("#reporte").attr({"style":"height:"+jQuery(document).height()+"px;width:100%;overflow-x:hidden"})
	jQuery(".link").click(function(){
		var link=jQuery(this).attr("rel");
		var titulo=jQuery(this).val();
		jQuery("#r_titulo").text(titulo);
		jQuery("#reporte").attr({"src":link});
	});
	 
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
}</script>
 <div id="content">  
	<div style="clear:both" ></div>
	
	<img class="bannermodulo"  <?php if($demo==true){ ?>id="costos" style="cursor:pointer;width:100%;height:20%"<? } else{?> style="width:100%;height:20%" <? } ?> rel="controlmedico.png"  />
  	
	<div class="divContentBlue"> 
		<h3><b><span id="r_titulo"></span></b></h3>
		<div style="clear:both"></div>
		<!--Año:<select name="anio"><option value="-1">Todos</option>
		<? foreach($chart[1] as $anio) {?>
			<option value="<?=$anio?>"><?=$anio?></option>
		<?} ?>
		</select><br-->
		<div id="chart_divh"></div>
  		
		<!--input class="link" style="float:left;margin-left:5px" type="button" value="Monitoreo" rel="https://www.talentracking.co/node/252?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura; }?>&token=<?=$token?>"/>
		<input class="link" style="float:left;margin-left:5px" type="button" value="Resultados individuales" rel="https://www.talentracking.co/node/255?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura; }?>&token=<?=$token?>"/>
		<input class="link" style="float:left;margin-left:5px" type="button" value="Resultados consolidados" rel="https://www.talentracking.co/node/255?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura; }?>&token=<?=$token?>"/>
		<input class="link" style="float:left;margin-left:5px" type="button" value="Programación control medico" rel="https://www.talentracking.co/node/257?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura; }?>&token=<?=$token?>"/>
		<div style="clear:both"></div-->
		<div class="divContentWhite">
			<?php 
			$oRecord = User::model()->findByPk($_SESSION['loginID']); 
			$dUsuario = EvalUsuarios::model()->findByPk($oRecord->iduseval);
			$nextparam='&idestructura='.$ides2;
			if($dUsuario->perfil==3 or $oRecord->uid==1){
				//$nextparam='';
				//$idestructura=NULL;
			}
			//printVar($nextparam);exit; 
			?>
				<script>
					jQuery(function(){
						jQuery("#buscar").click(function(){
							if(jQuery("#cc").val()!=""){
 								jQuery("[name='cc']").val(jQuery("#cc").val());
								jQuery("#acciones").submit();
								}
 						});
						jQuery("#eliminar").click(function(){
							jQuery("[name='eliminar']").val(1);
							jQuery("#acciones").submit();
  						});
					});
				</script>
				<?php echo CHtml::form(array("admin/rcv/programacioncontrolmedico"), 'post', array('class'=>'acciones' , 'id'=>'acciones')); ?>
					<input type="hidden" name="cc" />
					<input type="hidden" name="eliminar" />
				</form> 
				<?php 
 				$buscando='';
				if($cc!=""){
 					$param="&param425936X35X1155=".$cc;
					$buscando='<h2>Esta buscando por cédula <b>'.$cc.'</b> .<a href="javascript:;" id="eliminar">Eliminar</a></h2>';
				} ?>
				
				<? if($estado==1){ ?>
				<center>
					<?=$organizaciones?>
					<div id="chart_div" <? if($jsonorg==""){ ?> style="display:none" <? } ?>></div>
				</center> 
				<? }else{ echo  $jsonorg; } ?>
				<br>
				<div style="display:none">
				Año:<select name="anio"><option value="-1">Seleccione un año</option> 
				<? foreach($anios as $anio) {?>
					<option value="<?=$anio?>"><?=$anio?></option>
				<?} ?>
				</select><br>				
				</div>
				
				<b>cédula:</b><input type="text" id="cc" /><input  type="button" id="buscar" value="Buscar" />
				<?=$buscando?>					
				<iframe  id="reporte"   name="reporte" src="https://www.talentracking.co//node/257?embed=1&token=<?=$token?>&idestructura=<?=$idestructura?><?=$param?>"  style="width:100%;height:4000px;border: none; overflow-y:scroll<? if($ides==NULL){echo "display:none";} ?>" ></iframe>
 
		</div>
	</div>
</div>
 
	