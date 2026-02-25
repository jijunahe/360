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
  		var urlbase="https://www.talentracking.co/node/198?embed=1&paramreferenciaSrt=<?=$idorg?>&paramidtokenSrt="+anio;
 		jQuery("#reporte").attr({"src":urlbase});
 	});
});	 
</script>
<div id="content">

	
	
   	<div class="divContentBlue">
		<!--div   id="tituloenc" > 
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
		</div-->		
	
	
   		<div class="divContentWhite">
			<div style="clear:both"></div>
			Encuesta:<select name="anio"><option value="-1">Todos</option>
			<? foreach($encuestas as $enc) {?>
				<option value="<?=$enc->id?>"><?=$enc->nombre?> (<?=$enc->fechainicio?> <?=$enc->fechafin?>)</option>
			<?} ?>
			</select><br>
			<div id="chart_div"></div>
			<br/>		
			 
			<iframe id="reporte" name="reporte" src="https://www.talentracking.co/node/198?embed=1&token=<?=$token?>&paramreferenciaSrt=<?=$idorg?>"    ></iframe> 
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
