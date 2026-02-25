
<style type="text/css"> 
#content-box{
	width:1200px;
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
var evals = <?=json_encode($critsComps)?>;
var tiposEval = <?=json_encode($tEvals)?>;
var idConTec = <?=$parTec?>;

var firstG = {cats:[],series:[],catsNoms:[]};
var otrasG = [];
var obj = {
	promByTipoCrit : function(){
		var i = 0;
		var j = 0;
		var k = 0;
		var prom = 0;
		var van = 0;
		var val = 0;
		for(i=0;i<evals.length;i++){
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
			//evals[i].prom = prom;
			jQuery("#divProgrees"+i).html(prom+"");
			jQuery("#imgProgrees"+i).css("width",(prom*10)+"%");
		}
	},
	fgCats : function (datos){
		var i = 0;
		var j = 0;
		var letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		var lpos = 0;
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
		var dat = {name:"Prom",data:[]};
		var colors = ["#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92"];
		var poscolor = 0;
		for(i=0;i<datos.length;i++){
			for(j=0;j<datos[i].cris.length;j++){
				var prom = 0;
				var van = 0;
				var dt = datos[i].cris[j];
				var crt_id = datos[i].crt_id;
				for(k=0;k<dt.inds.length;k++){
					prom += parseFloat(dt.inds[k].prom);
					van++;
				}
				prom = prom / van;
				prom = Math.round(prom*Math.pow(10,2))/Math.pow(10,2);
				if(isNaN(prom)){
					prom = 0;
				}
				if(poscolor > colors.length){
					poscolor = 0;
				}
				dat.data.push({y: prom, color: colors[poscolor]});
				poscolor++;
			}
		}
		firstG.series.push(dat);
	},
	pintarFg: function(datos){
		var chart;
	    chart = new Highcharts.Chart({
		  chart: {
			 renderTo: 'divFirstG',
			 defaultSeriesType: 'column',
			 marginRight: 130
		  },
		  title: {
			 text: 'Gr\xe1fico por competencias'
		  },
		  xAxis: {
			 categories: datos.cats
		  },
		  yAxis: {
			 min: 0,
			 title: {
				text: 'Puntaje'
			 }
		  },
		  colors: ["#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92"],
		  credits:{
		  	enabled: false
		  },
		  legend: {
			 enabled : false
		  },
		  tooltip: {
			 formatter: function() {
				return ''+
				   this.x +': '+ this.y +'';
			 }
		  },
		  plotOptions: {
			 column: {
                                dataLabels: {
                                   enabled: true
                                },

				pointPadding: 0.2,
				borderWidth: 0
			 }
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
		document.getElementById("tdFirstLeyend1").innerHTML = html1;
		document.getElementById("tdFirstLeyend2").innerHTML = html2;
		document.getElementById("tdFirstLeyend3").innerHTML = html3;
	},
	fOtreasG : function(datos){
		otrasG = [];
		var i = 0;
		var j = 0;
		var k = 0;
		var m = 0;
		var n = 0;
		for(i=0;i<datos.length;i++){
			for(j=0;j<datos[i].cris.length;j++){
				var dt = datos[i].cris[j];
				var dato = {cats:[],series:[{name:"Prom",data:[]}],"ij":i+":"+j};
				for(k=0;k<dt.inds.length;k++){
					dato.cats.push(dt.inds[k].co_nombre);
					dato.series[0].data.push(dt.inds[k].prom);
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
				prom += dat.data[i].y;
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
		var colors = ["#0070C0", "#C00000", "#4F6228", "#E46C0A", "#3D96AE", "#DB843D", "#92A8CD", "#A47D7C", "#B5CA92"];
		var poscolor = 0;
		for(i=0;i<datos.length;i++){
			if(poscolor > colors.length){
				poscolor = 0;
			}
			this.pintarOtrasG(datos[i], colors[poscolor]);
			poscolor++;
		}
	},
	pintarOtrasG : function(datos, color){
		var chart;
	 	chart = new Highcharts.Chart({
		  chart: {
			 renderTo: 'divGraf:'+datos.ij,
			 type: 'bar',
			 margin:[5,10,20,200]
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
		  colors: [color],
		  credits:{
		  	enabled: false
		  },
		  legend: {
			 enabled: false 
		  },
		  series: datos.series
	   });
	}
}
obj.fgCats(evals);
obj.fgSeries(evals);
obj.fOtreasG(evals);
var prom = obj.getProm(evals);

jQuery(function(){
 
obj.pintarFg(firstG);
obj.pintarFgLeyend(firstG.catsNoms);
jQuery("#divProgrees").html(prom+"");
jQuery("#imgProgrees").css("width",(prom*10)+"%");


})

</script>


<div id="content" style="width:1200px;margin:0 auto">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
 
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
 
                    <tr>
                        <td>
                            <div style="height:10px;">
                            </div>
<!--                            <div style="color: #C00000;font-weight:bold; font-size:20px; text-align:center;padding:10px;">
                                MODULO DE CREACI&Oacute;N DE OBJETIVOS
                            </div>-->
                            <div style="height:10px;">
                            </div>
                            <table width='100%' border='0' cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="40%">
                                        Nombre de colaborador: <?=($datosc->nombres.' '.$datosc->apellidos)?><br />
                                        Cargo:  <?=($datosc->nom_cargo)?><br />
                                        <?PHP 
                                            $idJefe = $datosc->idJefeFuncional;
                                            $correoUsuario = $datosc->email;
                                            $correoJefe = $datosjefe->email;
                                            $nombreJefe = $datosjefe->nombres." ".$datosjefe->apellidos;
                                            $nombreUsuario = $datosc->nombres." ".$datosc->apellidos;
                                            echo "Jefe: ".($nombreJefe);
                                          
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div style="height:10px;">
                            </div>
                            <div class="divContentWhite" >
                                     <?PHP 
                                        // ACTIVA LOS MODULOS DEL SISTEMA
                                        $graficos = '<div style="border:1px solid #666666;background-color:#DDDDDD ;padding:5px 10px;">';
                                        $graficos .= '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
                                        $graficos .= '<tr>';
                                        $graficos .= ' <td width="50%" style="color:#C00000 ; font-weight:bold;">';
                                        $graficos .= 'Resultado consolidado de valoraci&oacute;n competencias';
                                        $graficos .= '</td>';
                                        $graficos .= '<td width="50%">';
                                        $graficos .= '<div style="padding:5px;background-color:#FFFFFF;border:1px solid #999999;">';
                                        $graficos .= '<div style="height:20px;background-color:#DDDDDD;border:1px solid #999999;">';
                                        $graficos .= '<img id="imgProgrees" src="'.$imageurl.'progressBarRed.gif" style="width:'.$total.';height:20px" />';
                                        $graficos .= '<div id="divProgrees" style="text-align:center;margin-top:-18px;color:#000099;"><?=$total;?></div>';
                                        $graficos .= '</div>';
                                        $graficos .= '</div>';
                                        $graficos .= '</td>';
                                        $graficos .= '</tr>';
                                        $graficos .= '</table>';
                                        $graficos .= '</div>';
                                        $graficos .= '<div style="height:10px;"></div>';
                                        $graficos .= '<div id="divFirstG" style="height:350px;"></div>';
                                        $graficos .= '<div>';
                                        $graficos .= '<table cellpadding="2" cellspacing="0" border="0" width="100%">';
                                        $graficos .= '<tr valign="top">';
                                        $graficos .= '<td style="font-size: 11px;" id="tdFirstLeyend1" width="33%"></td>';
                                        $graficos .= '<td style="font-size: 11px;" id="tdFirstLeyend2" width="34%"></td>';
                                        $graficos .= '<td style="font-size: 11px;" id="tdFirstLeyend3" width="33%"></td>';
                                        $graficos .= '</tr>';
                                        $graficos .= '</table>';
                                        $graficos .= '</div>';
                                        $graficos .= '<div class="divContentWhite">';
                                        $graficos .= '<div style="color:#003366;font-weight:bold; font-size:17px; text-align:center;padding:10px;">MODULO DE CREACION DE OBJETIVOS ';
                                        $graficos .= '<div class="divContentWhite">';
                                        $graficos .= '<div style="color:black;font-weight:normal; font-size:12px; text-align:left;padding:10px;"">';
                                        $graficos .= 'Antes de comenzar la creacion de sus objetivos de desarrollo y resultados seleccione el periodo para el cual los va a plantear, en la
                                            siguiente ventana desplegable seleccione este periodo y de click en el boton seleccionar.';
                                        $graficos .= '</div>';
                                        $graficos .= '</div>';
                                        $graficos .= '</div>';
                                        
                                        $select = '<select id="trimestre" style="border: 1px; border-style: solid; border-color:gray; font-size: 12px;">';
                                        foreach($rTri as $dato) 
                                        {
                                            $select .= '<option value="'.$dato->idTrimestre.'">';
                                            $select .= $dato->nombreTrimestre;
                                            $select .= '</option>';
                                        }
                                        $select .= "</select>";
                                        $select .= '<input type="button" name="seleccionarPeriodo" value="Seleccionar"/>';
                                        echo $graficos;
                                        echo $select;
                                    ?>
                             </div>
                        </div>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
	</div>
 
  <?php $FORMTEM= preg_replace('/\n+/', ' ', CHtml::form(array(""), 'post'));?>

 <script>

jQuery(function(){
 	jQuery("[name='seleccionarPeriodo']").click(function(){
 		var valor=jQuery("#trimestre").val();
 		var OBJ=jQuery('<?=$FORMTEM?><input type="hidden" name="trimestre" value="'+valor+'" ></form>');
 		var ruta="<?=$rbase?>index.php/admin/objetivos/trimestreFuncional/"; 
 		OBJ.attr("action",ruta);
		OBJ.submit();
 	})	
});
</script>