<?  
	$http="";
	if(isset($_SERVER["HTTPS"])){
	$https="s";
	}
	$urldir="http".$https."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."/admin/authentication/sa/login"; 
	 
?>
<style>
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
</style>
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
 				var action="<?=Yii::app()->baseUrl?>/index.php/admin/felicidad/reportes";
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
 						var urlbase="https://www.talentracking.co/node/274?embed=1&paramidempresaSrt=<?=$idorg?>&token="+token+paramanioc;
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
		var action="<?=Yii::app()->baseUrl?>/index.php/admin/felicidad/reportes";
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
				
				var urlbase="https://www.talentracking.co/node/274?embed=1&idestructuraSrt="+idestructura+"&paramidempresaSrt=<?=$idorg?>&token="+token+paramanioc;
 				drawChart(chart[0]);
				jQuery("#reporte").attr({"src":urlbase});

			}
		});			
 
		
	});
});	 
</script>
<div id="content">

	
	
   	<div class="divContentBlue">
		<div   id="tituloenc" > 
			<div id="contenedor">
				<div id="leftitle">
					<?   
					
					$queryString = "
					SELECT 
					*
					FROM {{surveys_languagesettings}}
					WHERE surveyls_survey_id=214322"; // printVar($queryString);exit;
					$eguresult = dbExecuteAssoc($queryString);
					$titulo = $eguresult->readAll();
					echo "<h2 style='text-align: center;font-weight: bold;'>".$titulo[0]["surveyls_title"]."</h2>";
					
				?>
				</div>
				<div id="logo">
					<a href="/" target="_blanck"><img src="<?=Yii::app()->baseUrl?>/upload/templates/felicidad/images/logo.jpg"  ></a>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>		
	
	
   		<div class="divContentWhite">
			<div style="clear:both"></div>
			Año:<select name="anio"><option value="-1">Todos</option>
			<? foreach($chart[1] as $anio) {?>
				<option value="<?=$anio?>"><?=$anio?></option>
			<?} ?>
			</select><br>
			<div id="chart_div"></div>
			<br/>		
			 
			<iframe id="reporte" name="reporte" src="https://www.talentracking.co/node/274?embed=1&token=<?=$token?>&paramidempresaSrt=<?=$idorg?>"    ></iframe> 
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
