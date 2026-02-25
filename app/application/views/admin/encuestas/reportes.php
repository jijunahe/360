 <?php echo CHtml::form(array("admin/encuestas/reportes"), 'post', array('class'=>'formT', 'id'=>'formT')); ?>
	 <div id="vartipo" style="display:none">
	 <input type="hidden" id="node" name="node" />
 	 
	 <input name='empresa' type='hidden' <? if(isset($_SESSION["empresa"])){?>value='<?=$_SESSION["empresa"]?>'<?}?> />
	</div>
</form>
 <script>
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
	jQuery(function(){
 		jQuery("[rel^='nodo_']").click(function(){
			var id=jQuery(this).attr("rel").split("_")[1];
			jQuery("#node").val(id);
			var validar=true;
			 
			if(jQuery("[rel^='filtro_']").size()>0){
				jQuery.each(jQuery("[rel^='filtro_']"),function(k,d){
					var valor=jQuery(d).val();
					var nombre=jQuery(d).attr("rel").split("_")[1];
					if(valor.trim("")==-1){
						validar=false;
						alert("Por favor seleccione una "+nombre);
					}else{
						jQuery("#formT").append("<input type='hidden' name='"+nombre+"' value='"+valor.trim("")+"' />");
					}
 				});
 			}console.log(validar);
 			if(validar==true){
				var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/reportes";
				var id=jQuery(this).val();
				var  objdata=jQuery("#formT").serialize();
				jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: url,
					data:objdata,
					success:function(res){
						var data="https://www.talentracking.co/node/"+res[1]+"?embed=1&token=<?=$token?>&"+res[0];
						jQuery("#embed").attr("data",data);
					}
				});			
 			}
		});
		jQuery("[rel='filtro_empresa']").change(function(){	 
			var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/encuestas/getbaterias";
			var id=jQuery(this).val();
			var  objdata={id:id,valida:1};
			jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: url,
				data:objdata,
				success:function(res){
					var html="<option value='-1' >Seleccione una bateria</option>";
  					jQuery.each(res,function(k,d){
 							html+="<option value='"+d["id"]+"' >"+d["nombre"]+"</option>";
 					});
					jQuery("[name='bateria']").html(html);
				}
			});
					
		});
		
  	});
 	</script>
<style>
	.nodos{
		float:left;
		margin-left:5px;
	
	}
</style>
	<?php
	$filtrer="";
	$html="";
	
		$exunidades=explode(",",$unidades);
		$html="<b>Empresa:</b><select rel='filtro_empresa'  >";
		
		$html.="<option value='-1'>Seleccione una empresa</option>";
		foreach($exunidades as $datos){
				$u = EvalUnidades::model()->findByPk($datos);
				$html.="<option value='".$datos."'>".$u->nombre."</option>";
		}
		$html.="</select>";
 	
		if($username=="root"){
			$u = EvalUnidades::model()->findAll();
			$html="<b>Empresa:</b><select rel='filtro_empresa'  >";
			
			$html.="<option value='-1'>Seleccione una empresa</option>";
			foreach($u as $datos){
 					$html.="<option value='".$datos->id."'>".$datos->nombre."</option>";
			}
			$html.="</select>";
		}
		
		if($perfil==3){
 			
		}
		
		
		if($perfil==4){
			//$filtrer="&paramuidcreadorSrt=".$uid;
		}
		
  	?>


<div style="clear:both"></div>
<div id="content"  >
	<div class="divContentBlue"  >
		 <div class="divContentWhite">
			<div style="margin-left:2%">
					<div style="float:left;margin-left:15px"><?=$html?></div>
					<div style="float:left;margin-left:15px" id="bateria">
						<b>Batería:</b><select name='bateria' rel="filtro_bateria"></select></div>
					<div style="float:left;margin-left:15px">
						<input type="button" rel="nodo_216" value="Demografico"class="nodos" />
						<input type="button" rel="nodo_225" value="Intralaboral Forma A"class="nodos" />
						<input type="button" rel="nodo_226" value="Intralaboral Forma B"class="nodos" />
						<input type="button" rel="nodo_227" value="Extralaboral "class="nodos" />
						<input type="button" rel="nodo_228" value="Estrés "class="nodos" />
					</div>
			</div><br>

			<div style="clear:both"></div>
			<object id="embed" type="text/html" data="https://www.talentracking.co/node/<?=$node?>?embed=1&token=<?=$token?>&<?=$filtro?>" style="width:100%;height:1130px">
			</object>
 		</div>
	</div>
</div>
<script>
jQuery(function(){
	var he=jQuery(".wrapper").height();
	//jQuery("#embed").height(he);
	
	
});

</script>