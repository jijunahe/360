<?
	$nivelhtml='<select name="nivel"  id="nivel" ><option value="-1">Seleccione un nivel</option>';
	$jsonnivel=array();
	foreach($nivel as $datnivel){
		
		$jsonnivel[$datnivel->id]=array("id"=>$datnivel->id,"nombre"=>$datnivel->nombre);
 		$nivelhtml.='<option value="'.$datnivel->id.'">'.$datnivel->nombre.'</option>';
	}
	$nivelhtml.='</select>';
	$jsonnivel=json_encode($jsonnivel);
 ?>
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
	google.charts.load('current', {packages:["orgchart"]});
	google.charts.setOnLoadCallback(function(){
		//jQuery("#chart_div").show();
		//drawChart(jQuery(this).val());

 		drawChart();
		
	});
	var GLOBALAR=[];
 	var indexofids=[];
	var jsonnivel=JSON.parse('<?=$jsonnivel?>');
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
				
				var id=<?=$_GET["id"]?>;
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
		var action="<?=Yii::app()->baseUrl?>/index.php/admin/rcv/getusuariosorganizacion";
		var idorg=jQuery("[name='Estructura[idorganizacion]']").val();
		var testid=JSON.parse(idorg);
 		if(testid["id"]!=undefined){
			 
 		}
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
			var action="<?=Yii::app()->baseUrl?>/index.php/admin/rcv/validaorg";
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
	jQuery(".google-visualization-orgchart-node").css({"border":"none"})
 	jQuery("[rel^='event_']").click(function(){
		 
		var id=jQuery(this).attr("rel").split("_")[1];
		
		/* 
		var nombre=jQuery(this).attr("id");
		var selectobj=jQuery('<div><?=$nivelhtml?></div>');
		selectobj.find("select").attr({"id":"padre_"+id,"name":nombre});
		var htmlbox='<div style="border:1px solid #EDEDFB;border-radius:10px">';
			htmlbox+='<b>Seleccione un nivel:</b>'+selectobj.html();
			htmlbox+='</div>';
		jQuery.colorbox({html:htmlbox});
		 */
 		jQuery("#edita_"+id).show();
 		addnodo(id);
	});
	jQuery("[rel^='delete_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
		var valida=false;
		var totales=GLOBALAR.length;
		var i=0;
  		while(valida==false){
			var valor=GLOBALAR[i];
 			if(valor!=undefined){
				if(valor[0]["v"]==id){
					if(confirm("Está seguro de realizar esta acción?")){
						del(i);
 					}
				}
			}
 			if(i==(totales-1) || valor==undefined){
				//alert("El nodo no ha sido encontrado");
				valida=true;
			}
			i++;
		}
		
	});
	jQuery("[rel^='editarinfo_']").click(function(){
		var id=jQuery(this).attr("rel").split("_")[1];
		jQuery("#datos_"+id).show();
 	});
	 
	jQuery("[rel^='cerrar_']").click(function(){
		var obj=jQuery(this).parent();
		obj.hide();
 	});
	 
}
var tglobalchange=[];
function eliminardesendientes(id){
	jQuery.each(GLOBALAR,function(k,v){
		 
		if(v[1]!=undefined){
			if(v[1]==id){
				//console.log(v);
				//GLOBALAR.splice(k,1);
				setTimeout(function(){
					
					eliminardesendientes(v[0]["v"]);
					tglobalchange[k]=false;
					reordena(); 
				},300);
			}
		}
		 
 	});
	reordena();
 }
function reordena(){
	var temporal=[];
 	jQuery.each(tglobalchange,function(k,v){
		 
		if(v!=false && v!=undefined){
 			 temporal.push(v);
 		}
  	});
	GLOBALAR=temporal;
}
function del(id){
	var key=GLOBALAR[id][0]["v"];
  	GLOBALAR.splice(id,1);
 	tglobalchange=GLOBALAR;
 	//eliminardesendientes(key);
	
	setTimeout(function(){	
		eliminardesendientes(key); 	
	},300);
	reordena();
	jQuery.each(GLOBALAR,function(k,d){reordena();});
	setTimeout(function(){		
  		drawChart(false,false,GLOBALAR);
		event();
	},1000);


}
function addnodo(id){ 
	jQuery("#padre_"+id).change(function(){ 
		var idpadre=jQuery(this).attr("id").split("_")[1];
		var id=jQuery(this).val();
		var idprev=jQuery(this).val();
		var nombre=jQuery(this).attr("name");
		var nombret=jsonnivel[id]["nombre"];
  		if(jQuery("[rel^='event_"+id+"-']").size()>0){
 			var tid=jQuery("[rel^='event_"+id+"-']").size();
 			id=id+"-"+(tid+1)+"-nodo";
		}else{
			id=id+"-0";
 		}
  		var selectobj=jQuery('<div><?=$nivelhtml?></div>');
		selectobj.find("select").attr({"id":"padre_"+id,"name":nombre});
		var htmlbox='<div style="border:1px solid #EDEDFB;border-radius:10px">';
			htmlbox+='<b>Seleccione un nivel:</b>'+selectobj.html();
			htmlbox+='</div>';		
  		
 		var selus='<tr><td><b>Responsable:</b></td><td><div style="overflow-x:hidden;overflow-y:scroll;height:80px;color:#000;background-color:#fff;border-radius:8px;padding-left:3px">';
			jQuery.each(usuarios,function(k,v){
				selus+='<input type="checkbox" name="usuario_'+id+'" value="'+v.id+'" />'+v.alias+'<br>';
				});
			selus+='</div></td></tr>';
 		var nombreestructura='<tr><td><b>Nombre:</b></td><td><input type="text" name="Estructura['+id+'][nombre]" /></br></td></tr>';
		var descripcion='<tr><td><br><b>Descripción:</b></td><td><textarea name="Estructura['+id+'][descripcion]" ></textarea></br></td></tr>';
 		var htmldatos=nombreestructura+selus+descripcion;
		var cerrar='<input type="image" src="<?=Yii::app()->baseUrl?>/img/bad.gif" style="float:right"   rel="cerrar_'+id+'" ><div style="clear:both"></div>';
		var editar='<div style="clear:both"></div><b>Editar:</b><input type="image" src="<?=Yii::app()->baseUrl?>/img/edit.gif" style="float:right"   rel="editarinfo_'+id+'" >';
 		var html='<input type="image" src="<?=Yii::app()->baseUrl?>/img/bad.gif"   style="float:right;width: 13px;"   rel="delete_'+id+'"  value="Eliminar"><div style="clear:both"></div>';
 			html+='<div rel="titulo_'+id+'"><b>'+nombret+'</b></div>';
			html+='<div style="color:red; font-style:italic;"  >'
 			html+='<b>Agregar:</b><input type="image" src="<?=Yii::app()->baseUrl?>/img/add.gif"  style="float:right"  rel="event_'+id+'"   name="'+nombret+'" >';
 			html+='<div style="display:none;margin-top: -55px;" id="edita_'+id+'" class="datos">'+cerrar+htmlbox+'</div>';
			html+=editar+'<div   id="datos_'+id+'" class="datos"  style="display:none">'+cerrar+'<table>'+htmldatos+'</table></div>';
			html+='</div>';
  		var datos=[{v:id, f:html},idpadre, ''];
		var str = JSON.stringify(datos);
		indexofids[id]=str;
		 
 		drawChart(false,datos);
		event();
		jQuery.colorbox.close();
	});
	
	
}
jQuery(function(){
	
	jQuery("[rel='Guardar']").click(function(){
		var bandera=false;
		var totales=GLOBALAR.length;
		var k=0;
		var datafin=[];
		while(bandera==false){
			var d=GLOBALAR[k];
			if(Array.isArray(d)){
				var id=(d[0].v).split("-");
				var idpadre=d[1];
				var objhtm=jQuery("<div>"+d[0].f+"</div>");
 				var nombre=$("[name='Estructura["+d[0].v+"][nombre]']").val();
				var titulo=$("[rel='titulo_"+d[0].f+"']").text();
				var descripcion=$("[name='Estructura["+d[0].v+"][descripcion]']").val();
				var objresp=jQuery("[name='usuario_"+d[0].v+"']:checked");
				console.log(d[0].v);
				var responsables=[];
				jQuery.each(objresp,function(kk,dd){
					responsables.push(jQuery(dd).val());
				});
				console.log("[name='Estructura["+d[0].v+"][nombre]']"); 
				var validar=true;
				var htmlalert="";
 				if((nombre=="" || nombre==undefined) && validar==true){
					validar=false; htmlalert+="<li><b>Debe agregar nombre, verifique los nodos "+titulo+"</b></li>";
				}
				
				if((descripcion==""  || descripcion==undefined) && validar==true){
					validar=false; htmlalert+="<li><b>Debe agregar descripcion, verifique los nodos "+titulo+"</b></li>";
				}
				
				if(responsables.length==0  && validar==true){
					validar=false; htmlalert+="<li><b>Debe seleccionar responsables, verifique los nodos "+titulo+"</b></li>";
				}
				
				if(validar==true){
					var jt=JSON.parse(jQuery("[name='Estructura[idorganizacion]']").val());
					var arrt={	'id':d[0].v,
								'idpadre':idpadre,
								'idorg':jt["id"],
								'nombre':nombre,
								'responsables':responsables,
								'descripcion':descripcion,
							 };
					datafin.push(arrt);
					console.log(arrt);
					console.log("------------------------------");
				}else{
					bandera=true;
					jQuery.colorbox({html:"<ul>"+htmlalert+"</ul>"});
 					datafin=datafin.splice(); 
				}
			}
			if(k>=totales){
				bandera=true;
			}
			k++;
		}
		//console.log(datafin);
 		if(datafin[0]!=undefined){	
			var action="<?=Yii::app()->baseUrl?>/index.php/admin/rcv/organigrama";
			var idorg=jQuery("[name='Estructura[idorganizacion]']").val();
 			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: action,
				data:{data:datafin},
				success:function(res){
					console.log(res);
					document.location=res[0];
				}
			});
 		
		}
		
		
	});
	
	
});
</script>

<div id="content">
	<div class="divContentBlue"><b>Organigrama</b>
		<div class="divContentWhite"> 
			<div style="float:left">
				<b>Seleccione una orgnización:</b>
				<select name="Estructura[idorganizacion]" >
					<option value="-1">Seleccione una orgnización</option>
				<?  
					foreach($organizaiones as $dat){
						$json=array();
						foreach($dat as $key=>$val){
							$json[$key]=$val;
						}
						?>
						<option value='<?=json_encode((object)$json)?>'><?=$dat->nombre?></option>
						<?
					} ?>
				</select>
			</div>
			<div style="float:left" ><input type="button" rel="Guardar" value="Guardar"/></div>
			<div style="clear:both"></div>
			<center>
				<div id="chart_div" <? if($jsonorg==""){ ?> style="display:none" <? } ?>></div>
			</center>
			<div style="clear:both"></div>
 		</div>
	</div>
</div>