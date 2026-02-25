 
<style type="text/css"> 
#content-box{
	width:940px;
}
#tableContent{
    border:1px solid #CCCCCC;
    border-collapse:collapse;
	font-size:11px;
}
#tableContent th {
    border:1px solid #CCCCCC;
    font-size:11px;
}

#tableContent td {
    border:1px solid #CCCCCC;
    font-size:11px;
}
</style>
  <script type="text/javascript">

//jQuery(function(){ 
var evals = <?=json_encode($critsComps)?>;
var tiposEval = <?=json_encode($tEvals)?>;
var idConTec = <?=$parTec?>;
 var firstG = {cats:[],series:[],catsNoms:[]};
var otrasG = [];
var obj = 0;

	 obj = {
		promByTipoCrit : function(){
				var i = 0;
				var j = 0;
				var k = 0;
				var prom = 0;
				var van = 0;
				var val = 0;
				for(i=0;i<evals.length-1;i++){
					prom = 0;
					van = 0;
					var tcri = evals[i];
					for(j=0;j<tcri.cris.length;j++){
						var cri = tcri.cris[j];
						var crt_id = tcri.crt_id;
						for(k=0;k<cri.inds.length;k++){
							var ind = cri.inds[k];
							for(m=0;m<tiposEval.length;m++){
								if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
									val = parseFloat(ind[tiposEval[m].col]);
									if(isNaN(val)){
											val = 0;
									}
									prom += val; 
									van++;
								}else{
									val = parseFloat(ind[tiposEval[m].col]);
									if(isNaN(val)){
											val = 0;
									}
									prom += val; 
									van++;
								}
							}
						}
					}
					prom = prom / van;
					if(isNaN(prom)){
						prom = 0;
					}
					prom = Math.round(prom*Math.pow(10,2))/Math.pow(10,2);
					 ////console.log(prom);
					//evals[i].prom = prom;
					jQuery("#divProgrees"+i).html(prom+"");
					jQuery("#imgProgrees"+i).css({width:(prom*10)+"%"});
				}
				for(var p=evals.length-1;p<evals.length;p++){
					for(j=evals[p].cris.length-1;j<evals[p].cris.length;j++){
						prom = 0;
						var van = 0;
						var dt = evals[p].cris[j];
						var crt_id = evals[p].crt_id;
						for(k=0;k<dt.inds.length;k++){
							prom += parseFloat(dt.inds[k].prom);
							van++;
						}
	//                    prom = prom;
	//                    prom = prom / van;
						prom = Math.round(prom)/10;
						if(isNaN(prom)){
							prom = 0;
						}
					}
				}
				jQuery("#divProgrees"+i).html(prom+"");
				jQuery("#imgProgrees"+i).css({width:(prom*10)+"%"});
		},
		fgCats : function (datos){
			var i = 0;
			var j = 0;
			var letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
			var lpos = 0;
			 ////////console.log(datos);
			for(i=0;i<datos.length;i++){
				for(j=0;j<datos[i].cris.length;j++){
					if(lpos >= letras.length){
						lpos = 0;
					}
					firstG.cats.push(""+letras[lpos]);
					firstG.catsNoms.push("<b>"+letras[lpos]+"</b>. "+datos[i].cris[j].cr_nombre);
					lpos++;
				}
			}	
		},
		fgSeries : function(datos){
			var i = 0;
			var j = 0;
			var k = 0;
			var m = 0;
			var n = 0;
			
			for(m=0;m<tiposEval.length;m++){
				var dat = {name:tiposEval[m].nom,data:[]};
				firstG.series.push(dat);
			}
			
			for(m=0;m<tiposEval.length;m++){
				for(i=0;i<datos.length;i++){
					for(j=0;j<datos[i].cris.length;j++){
						var prom = 0;
						var van = 0;
						var dt = datos[i].cris[j];
						var crt_id = datos[i].crt_id;
						 
						for(k=0;k<dt.inds.length;k++){
							//if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
								
							//}else{
								prom += parseFloat(dt.inds[k][tiposEval[m].col]);
 								van++;
								
							//}
							
						}
						
						prom = prom / van; 
						if(isNaN(prom)){
							prom = 0;
						}
						 //console.log( prom);
						//if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
							
						//}else{
							firstG.series[m].data.push(Math.round(prom*Math.pow(10,2))/Math.pow(10,2));
							
						//}
					}
				}
			}
		},
		pintarFg: function(datos){
			var chart;
			
			chart = new Highcharts.Chart({
			  chart: {
				 renderTo: 'divFirstG',
				 defaultSeriesType: 'line',
				 marginRight: 130
			  },
			  xAxis: {
				 categories: datos.cats
			  },
			  yAxis: {
				 title: {
					text: 'Punjate '
				 },
				 plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				 }]
			  },
			  tooltip: {
				 formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.y +'';
				 }
			  },
			  title: {
				 text: 'Gráfico por competencias',
				 x: -20 //center
			  },
			  colors: ["#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92"],
			  credits:{
				enabled: false
			  },
			  legend: {
				 layout: 'vertical',
				 align: 'right',
				 verticalAlign: 'top',
				 x: -10,
				 y: 100,
				 borderWidth: 0
			  },
			  series: datos.series
		   });	   
		},
		pintarFgLeyend: function(datos){
			var i = 0;
			var j = 0;
			var html1 = "";
			var html2 = "";
			var html3 = "";
			var dividir = Math.floor(datos.length/3);
			for(i=0;i<datos.length;i++){
				if(i <= dividir){
					html1 += datos[i]+"</br>";
				}else if(i <= (dividir*2)){
					html2 += datos[i]+"</br>";
				}else{
					html3 += datos[i]+"</br>";
				}
				
			}
			jQuery("#tdFirstLeyend1").html(html1);
			jQuery("#tdFirstLeyend2").html(html2);
			jQuery("#tdFirstLeyend3").html(html3);
		},
		fOtreasG : function(datos){
			otrasG = [];
			var i = 0;
			var j = 0;
			var k = 0;
			var m = 0;
			var n = 0;
			for(i=0;i<datos.length-1;i++){
				for(j=0;j<datos[i].cris.length;j++){
					var dt = datos[i].cris[j];
					var crt_id = datos[i].crt_id;
					var dato = {cats:[],series:[],"ij":i+":"+j};
					for(m=0;m<tiposEval.length;m++){
					//	//console.log(tiposEval[m].col)
						if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
							
						}else{
							dato.series.push({name:tiposEval[m].nom,data:[]});
						}
					}
					
					for(k=0;k<dt.inds.length;k++){
						dato.cats.push(dt.inds[k].co_nombre);
						for(m=0;m<tiposEval.length;m++){
							var val = parseFloat(dt.inds[k][tiposEval[m].col]);
							//console.log(val);
							if(isNaN(val)){
								val = 0;
							}
						//	//console.log(tiposEval[m].col)
							if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
								
							}else{
								dato.series[m].data.push(val);
							}
						}
					}
					 
					otrasG.push(dato);
				}
			}
			
			for(i=datos.length-1;i<datos.length;i++){
				for(j=0;j<datos[i].cris.length;j++){
					var dt = datos[i].cris[j];
					///console.log(dt);
					var crt_id = datos[i].crt_id;
					var dato = {cats:[],series:[],"ij":i+":"+j};
					for(m=0;m<tiposEval.length;m++){
						if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
							dato.series.push({name:tiposEval[m].nom,data:[]});
						}else{
							dato.series.push({name:tiposEval[m].nom,data:[]});
						}
					}
					for(k=0;k<dt.inds.length;k++){
						dato.cats.push(dt.inds[k].co_nombre);
						//console.log(tiposEval);
						//for(m=0;m<tiposEval.length-2;m++){
						for(m=0;m<tiposEval.length;m++){
							var val = parseFloat(dt.inds[k][tiposEval[m].col]);
 							if(isNaN(val)){
								val = 0;
							}
							if(tiposEval[m].col == "resc" && parseInt(crt_id,10) == idConTec){
 								 dato.series[m].data.push(val);
							}else{
								dato.series[m].data.push(val);
							}
						}
					}
					otrasG.push(dato);
				}
			}
		},
		getProm : function(datos){
				var m = 0;
				var i = 0;
				var prom = 0;
				var sobre = 0;
				for(m=0;m<firstG.series.length;m++){
						var dat = firstG.series[m];
						for(i=0; i<dat.data.length ;i++){
								////console.log(dat.data[i]);
								prom += dat.data[i];
								sobre++;
						}
				}
				prom = prom / sobre;
				if(isNaN(prom)){
						prom = 0;
				}
				return Math.round(prom*Math.pow(10,2))/Math.pow(10,2);
		},
		recorrerOtras : function(datos){
			var i = 0;
			for(i=0;i<datos.length;i++){
				this.pintarOtrasG(datos[i]);
			}
		},
		pintarOtrasG : function(datos){
			var chart;
			chart = new Highcharts.Chart({
			  chart: {
				 renderTo: 'divGraf:'+datos.ij,
				 defaultSeriesType: 'bar',
				 margin:[5,20,20,200]
			  },
			  title: {
				 text: null
			  },
			  xAxis: {
				 categories: datos.cats,
				 title: {
					text: null
				 }
			  },
			  yAxis: {
				 min: 0,
				 max: 10,
				 title: {
					text: 'Puntaje',
					align: 'high'
				 }
			  },
			  tooltip: {
				 formatter: function() {
					return ''+
						this.series.name +': '+ this.y +'';
				 }
			  },
			  plotOptions: {
				 bar: {
					dataLabels: {
					   enabled: true
					}
				 }
			  },
			  colors: ["#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92"],
			  credits:{
				enabled: false
			  },
			  legend: {
				 enabled: false 
			  },
			  credits: {
				 enabled: false
			  },
				   series: datos.series
		   });
		}
	}
	
	
   
	
	obj.fgCats(evals);
	obj.fgSeries(evals);
	obj.fOtreasG(evals);
	 
	var prom = obj.getProm(firstG);	
	var prom2 = obj.getProm();	
jQuery(function(){
	obj.pintarFg(firstG);
	obj.promByTipoCrit();
	obj.pintarFgLeyend(firstG.catsNoms);
	 ////console.log(otrasG)
	obj.recorrerOtras(otrasG);
	jQuery("#divProgrees").html(prom+"");
	jQuery("#imgProgrees").css({width: (prom*10)+"%"});	
	jQuery("[rel='imprime']").click(function(){
		jQuery(".menubar").hide();
		jQuery("#content").attr("style","width:70%");
		jQuery(".footer").hide();
		var OBJ =jQuery(this);
		OBJ.hide();
		window.print(); 
		setTimeout(function(){jQuery(".menubar").show();OBJ.show();jQuery(".footer").show();jQuery("#content").attr("style","width:98%;margin:0 auto");},300);
 	});
});
 </script>
 
 
<div id="content" style="width:98%;margin:0 auto">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
	 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		 
		<tr>
                <td height="50" width="50" align="left"><a href='javascript:;' rel="imprime"><img src="<?=$imageurl?>impresora.png" alt=""  onmouseover="this.src='<?=$imageurl?>impresora2.png';"onmouseout="this.src='<?=$imageurl?>impresora.png';" title="Imprimir el reporte"></a></td>
<!--                <td><input type="button" name="imprimir" value="Imprimir" onclick="window.print();"></td>-->
        </tr>    
		<tr>
		<tr>
		<td>
			<div style="height:10px;"></div>
			<div style="color:#C00000;font-weight:bold; font-size:20px; text-align:center;padding:10px;">Reporte detallado valoración competencias</div>
			<div style="border:1px solid #666666; background-color:#DDDDDD ;padding:5px 10px;">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
			<td>Colaborador evaluado: <span style="color:#C00000;"><?=utf8_decode($datosc->nombres.' '.$datosc->apellidos)?></span></td>
			<td align="right">Fecha de Evaluaci&oacute;n: <span style="color:#C00000;"><?=$fecha?></span> </td>
			</tr>
			</table>
			</div>
			<div style="height:10px;"></div>
			<table width='100%' border='0' cellpadding="0" cellspacing="0">
			  <tr>
			    <td width="40%">
				   Unidad: <?=utf8_decode($datosc->nom_proceso)?><br />
				   Area o Proceso: <?=utf8_decode($datosc->nom_proyecto)?><br />
				   Cargo:  <?=utf8_decode($datosc->nom_cargo)?><br />
				</td>
				<td width="40%" style="text-align:right">
				  <img src="<?=$imageurl?>niveles.jpg" />
				</td>
			  </tr>
			</table>
			<div style="height:10px;"></div>
			<div style="border:1px solid #666666; background-color:#DDDDDD ;padding:5px 10px;">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			  <tr>
			    <td width="50%" style="color:#C00000; font-weight:bold;">Resultado comparativo de valoración competencias</td>
				<td width="50%">
				 <div style="padding:5px;background-color:#FFFFFF;border:1px solid #999999;">
				 <div style="height:20px;background-color:#DDDDDD;border:1px solid #999999;">
				 <img id="imgProgrees" src="<?=$imageurl?>progressBarRed.gif" style="width:<?=$total;?>%;  height: 20px;"  />
				 <div id="divProgrees" style="text-align:center;margin-top:-18px;color:#000099;"><?=$total;?></div>
				 </div>
				 </div>
				</td>
			  </tr>
			</table>
			</div>
			<div style="height:10px;"></div>
			<div id="divFirstG" style="height:350px;"></div>
			<div>
			<table cellpadding="2" cellspacing="0" border="0" width="100%">
			<tr valign="top">
			  <td style="font-size: 11px;" id="tdFirstLeyend1" width="33%"></td>
			  <td style="font-size: 11px;" id="tdFirstLeyend2" width="34%"></td>
			  <td style="font-size: 11px;" id="tdFirstLeyend3" width="33%"></td>
			</tr>
			</table>
			</div>
			<?PHP
			for($i=0;$i<count($critsComps);$i++){
				echo("<div style='height:10px;'></div><div style='border:1px solid #666666; background-color:#DDDDDD ;padding:5px 10px;'>");
				echo('
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
			    <td width="50%" style="color:#C00000;">Resultados gráficos por comportamientos y valoradores - '.utf8_decode($critsComps[$i]->crt_nombre).'</td>
				<td width="50%">
				 <div style="padding:5px;background-color:#FFFFFF;border:1px solid #999999;">
				 <div style="height:20px;background-color:#DDDDDD;border:1px solid #999999;">
				 <img id="imgProgrees'.$i.'" src="'.$imageurl.'progressBarRed.gif" style="width:<?=$total;?>%;height:20px"  />
				 <div id="divProgrees'.$i.'" style="text-align:center;margin-top:-18px;color:#000099;"></div>
				 </div>
				 </div></td></tr></table>');
				echo("</div>");
				for($j=0;$j<count($critsComps[$i]->cris);$j++){
					echo("
					<div style='height:1px;border-bottom: 1px solid #999999;margin:5px 0px;'></div>
					<table cellpadding='2' cellspacing='0' border='0' width='100%'>
					  <tr valign='top'>
					    <td width='50%'>
						   <div style='color: ".$colors[$j]."'>".utf8_decode($critsComps[$i]->cris[$j]->cr_nombre)."</div>
						   <div id='divGraf:".$i.":".$j."' style='height:".((count($critsComps[$i]->cris[$j]->inds)*17*count($tEvals))+25)."px;'></div>
						</td>");
					$j++;
					if($j < count($critsComps[$i]->cris)){
						echo("	<td width='50%'>
							   <div style='color: ".$colors[$j]."'>".utf8_decode($critsComps[$i]->cris[$j]->cr_nombre)."</div>
							   <div id='divGraf:".$i.":".$j."' style='height:".((count($critsComps[$i]->cris[$j]->inds)*17*count($tEvals))+25)."px;'></div>
							</td>
						");
					}else{
						echo("	<td width='50%'> </td> ");
					}
					echo("
					  </tr>
					</table>
					");
					
				}
			}
			?>
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
 </div>

 
 