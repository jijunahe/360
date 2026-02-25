<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/login"; 
	 
?>
<script>
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(function(){drawChart();});

      function drawChart() {
		var datacaht=JSON.parse('<?=json_encode($chart[0])?>');
		if(arguments[0]!=undefined){
			datacaht=arguments[0];
		}
        var data = google.visualization.arrayToDataTable(datacaht);
         var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Areas, dependencias, unidades de negocio, etc',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

		function selectHandler() {
			var selectedItem = chart.getSelection()[0];
			if (selectedItem) {
				var topping = data.getValue(selectedItem.row, 0);
				var value = data.getValue(selectedItem.row, selectedItem.column);
 				var datasplit=topping.split(":");
						
				var anio=datasplit[0];
				var idpadre=datasplit[2];
 				var action="<?=Yii::app()->baseUrl?>/index.php/admin/hseq/reportes";
 				chart={anioc:anio,idpadre:idpadre};
				jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: action,
					data:{"chart":chart},
					success:function(res){
						//console.log(res);
						var idestructura=res["idestructura"];
						var organizacion=res["organizacion"];
						var paramanioc=res["paramanioc"];
						var chart=res["chart"];
						var token=res["token"];
						//document.location=res[0];
						//console.log(chart);
 						if(paramanioc>0){
							paramanioc="&paramanioc="+paramanioc;
						}
 						var urlbase="https://www.talentracking.co/node/259?embed=1&idestructuraSrt="+idestructura+"&paramEmpresaSrt=<?=$idorg?>&paramempresaSrt=<?=$idorg?>&paramempresa=<?=$idorg?>&token="+token+paramanioc;
						drawChart(chart[0]);
						jQuery("#reporte").attr({"src":urlbase});
 					}
				});					
				
 			}
 		}		
 		
        var chart = new google.charts.Bar(document.getElementById('chart_div'));
		google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data, google.charts.Bar.convertOptions(options));
       }
jQuery(function(){
	jQuery("#reporte").attr({"style":"height:"+jQuery(document).height()+"px;width:100%;overflow-x:hidden"})
	jQuery(".link").click(function(){
		var link=jQuery(this).attr("rel");
		var titulo=jQuery(this).val();
		jQuery("#r_titulo").text(titulo);
		jQuery("#reporte").attr({"src":link});
	});
	jQuery("[name='anio']").change(function(){
		var anio=jQuery(this).val();
		var action="<?=Yii::app()->baseUrl?>/index.php/admin/rcv/reportes";
		var idorg=jQuery("[name='Estructura[idorganizacion]']").val();
		chart={anioc:anio};
		jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: action,
			data:{"chart":chart},
			success:function(res){
				//console.log(res);
				var idestructura=res["idestructura"];
				var organizacion=res["organizacion"];
				var paramanioc=res["paramanioc"];
				var chart=res["chart"];
				var token=res["token"];
				//document.location=res[0];
				//console.log(chart);
				
				if(paramanioc>0){
 					paramanioc="&paramanioc="+paramanioc;
				}
				
				var urlbase="https://www.talentracking.co/node/259?embed=1&idestructuraSrt="+idestructura+"&paramEmpresaSrt=<?=$idorg?>&paramempresa=<?=$idorg?>&token="+token+paramanioc;
 				drawChart(chart[0]);
				jQuery("#reporte").attr({"src":urlbase});

			}
		});			
 
		
	});
});	 
</script>
<div id="content">
   	<div class="divContentBlue">
		<h3><b><span id="r_titulo"></span></b></h3>
  		<div class="divContentWhite">
			<div style="clear:both"></div>
			Año:<select name="anio"><option value="-1">Todos</option>
			<? foreach($chart[1] as $anio) {?>
				<option value="<?=$anio?>"><?=$anio?></option>
			<?} ?>
			</select><br>
			<!--div id="chart_div"></div-->
			<br/>
			<input class="link" style="float:left;margin-left:5px" type="button" value="Seguimiento" rel="https://www.talentracking.co/node/286?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura; ?>&idestructuraSrt=<? echo $idestructura; ?><? } ?>&token=<?=$token?>"/>
			<input class="link" style="float:left;margin-left:5px" type="button" value="Análisis de resultados" rel="https://www.talentracking.co/node/259?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura; }?>&token=<?=$token?>&paramEmpresaSrt=<?=$idorg?>&paramempresa=<?=$idorg?>&idestructuraSrt=<?=$idestructura?>"/>
			<input class="link" style="float:left;margin-left:5px" type="button" value="Informe incapacidades" rel="https://www.talentracking.co/node/278?embed=1<? if($idestructura!=NULL){ ?>&idestructura=<? echo $idestructura;  ?>&idestructuraSrt=<? echo $idestructura;  ?>&paramempresa=<? echo $idorg;  ?><? } ?>&token=<?=$token?>"/>

			 <!--div id="chart_div"></div-->
			<iframe id="reporte" name="reporte" src="https://www.talentracking.co/node/286?embed=1&token=<?=$token?>&paramEmpresaSrt=<?=$idorg?>&paramempresa=<?=$idorg?>&idestructuraSrt=<?=$idestructura?>"  ></iframe>  
			<div style="clear:both"></div>
		</div>
 	</div>
	<div style="clear:both"></div>			 
</div>
<script>
	jQuery(function(){
		 jQuery("#reporte").attr({"style":"height:"+jQuery(document).height()+"px;width:100%;overflow-x:hidden"})
 	});
</script>
