<? $root=explode("/",$_SERVER["SCRIPT_NAME"]);$root="/".$root[1]."/"; ?>
 <link rel="stylesheet" href="<?=$root?>scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=$root?>scripts/admin/colorbox/jquery.colorbox.js"></script>
 <script> 
jQuery(function(){
	var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/rcv/simulador/";
 	 
	
	jQuery("#guardar").click(function(){
		jQuery("#add").submit();
 	});
	
	jQuery("[rel^='action_']").click(function(){
		var option=jQuery(this).attr("rel").split("_")[1];
		var values=jQuery(this).attr("id");
		window["values"]=values;
		var html='<input type="hidden" name="option" value="'+option+'" />';
			html+='<input type="hidden" name="id" value="'+values+'" />';
		jQuery("#"+option).html(html);
		var opserialize=jQuery("#"+option).serialize();
		var dataobj=getObject(opserialize);
		var valida=true;
 		if(option=="eliminar"){
			if(!confirm("Esta seguro de eliminar esta simulación?")){
				valida=false;
			}
 		}
 		if(option=="ejecutar"){
			if(!confirm("Esta seguro de ejecutar esta simulación?")){
				valida=false;
			}
 		}
 		if(valida==true){
			jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: url,
			data:dataobj,
				success:function(res){
					if(res[0]=="ok"){
						var estadoej='<div style="height: 100px;width: 98%;border: 2px solid #74DF00;"><div id="avance" style="height: 100px;  " ><center><div id="atext" style="font-weight: bold;text-align: center;padding: 36px;font-size: 20px;"></div></center></div></div>';
						jQuery.colorbox({html:estadoej,width:"400px",height:"200px"});	
						jQuery("#atext").text(res[1]);
						if(res[2]=="redir"){
							document.location="<?=Yii::app()->baseUrl?>/index.php/admin/rcv/simulador";
						}
					}else if(res[0]=="error"){
						alert(res[0][1]);
					}
				}
			});	
	 
			var estadoej='<div style="height: 100px;width: 98%;border: 2px solid #74DF00;border-radius: 30px;"><div id="avance" style="height: 100px;width:1px;background-color: #81F781; border-radius: 30px;" ><center><div id="atext" style="font-weight: bold;text-align: center;padding: 36px;font-size: 33px;">Cargando...</div></center></div></div>';
			jQuery.colorbox({html:estadoej,width:"400px",height:"200px"});	
			//avance(url);
		
		}
		
	});
	 
});
function avance(url){
	var interval=setInterval(function(){	
		jQuery.ajax({ 
		type: "POST",
		dataType: "json",
		async: true,
		url: url,
		data:{"option":"estado","id":window["values"]},
			success:function(res){
			console.log(res);
				if(res[0]<res[1]){
					var porcen=(res[1]*100)/res[0];
					jQuery("#avance").css({width:(Math.round(porcen))+"%"});
					jQuery("#atext").text(res[1]+"/"+res[0]);
				}else if(res[0]==res[1]){
				
					jQuery("#avance").css({width:"100%"});
					jQuery("#atext").text("El proceso ha terminado!");
					clearInterval(interval);
				}
				 
			}
		});
	},5000); 	
	
}


function getObject(obj){
	var atoms=obj.split("&");
	var data={};
	jQuery.each(atoms,function(k,d){
		var temp=d.split("=");
		data[temp[0]]=temp[1];
	});
	return data;
}	
	
	
	
 </script>
 <style>
	.cell{
		padding: 9px;
		background: #eee;
		border-radius: 5px;
	}
	.contenedor{
 		background:#F2F2F2;
		border-radius: 5px;
		width:350px;
		padding:1em;
		float: left;
		margin-left:1em;
    }
	.actions{
	
    float: right;
    width: 14%;
    height: 29px;
    clear: both;	
	
	}
 </style>
<?php echo CHtml::form(array("admin/rcv/simulador/"), 'post', array('class'=>'ejecutar', 'id'=>'ejecutar')); ?>
</form>
<?php echo CHtml::form(array("admin/rcv/simulador/"), 'post', array('class'=>'eliminar', 'id'=>'eliminar')); ?>
</form>
<div id="content">
		<div class="divContentBlue"><h3>Simulaciones</h3>
			 <div class="divContentWhite">
				<select name="empresafiltro" >
				<option value='-1'>Filtrar por empresa</option>
				<?  
				foreach($unidades as $empresas){
				echo "<option value='".$empresas['id']."'>".$empresas['nombre']."</option>";
				}

				?>
				</select>				
<?php echo CHtml::form(array("admin/rcv/simulador/"), 'post', array('class'=>'filtro', 'id'=>'filtro')); ?>
	<input type="hidden" name="filtro" />
</form>				
<br>
<?php if($mensaje!=""){ ?>
	 <?=$mensaje?>
<?php } ?>
<br>				
<?php 
	
	foreach($simulacion as $key=>$valores){
		$u=Organizacion::model()->findByPk($valores->idunidad);
 		$queryc = "SELECT `425936X35X1151`,simulacro FROM {{survey_".$encuesta."}} where `425936X35X1151`=".$valores->idunidad." and simulacro='Y'";
		$gcrt = dbExecuteAssoc($queryc);
		$preguntas = $gcrt->readAll();
		$total=count($preguntas);											
		 
		 
?>
	<div class="contenedor"> 
		<div class="actions">
			<img rel="action_eliminar"  id="<?=$valores->id?>" src="<?=Yii::app()->baseUrl?>/img/bad.gif" style="width:20px;cursor:pointer"/>
			<img rel="action_ejecutar"  id="<?=$valores->id?>" src="<?=Yii::app()->baseUrl?>/styles/darkblue/images/do.png"   style="width:20px;cursor:pointer"/>
		</div>
		<div class="cell">
			<b>Nombre:</b> <?=$valores->nombre?><br>
 			<b>Organización:</b> <?  echo $u->nombre; ?><br>
			<b>Cantidad Usuarios:</b> <?=$total?>/<?=$valores->cantidad?><br>
			<b>Fecha de creación:</b> <?=$valores->fechacreacion?> <br>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
	</div>
  <?php } ?> 
 


<?php echo CHtml::form(array("admin/rcv/simulador/"), 'post', array('class'=>'add', 'id'=>'add')); ?>
				<div style="display:none">
 					<input type="hidden" value="add" name="option">
				</div>
			<? if(EvalUsuarios::vaidausr((int)$_SESSION["loginID"])=="OK") {?>	
			<div style="clear:both"></div>
			<h3><b>Agregar</b></h3> 
  			<table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
				<tbody>
					<tr>
  						<td><b>Organización</b></td>
   						<td><b>Nombre</b></td>
  						<td><b>Cantidad de pacientes</b></td>
  						<td><b>Guardar</b></td>
 					</tr>
				</tbody>
					<tr>
  						<td>
							<select name="idunidad" rel="filtro_bateria" >
								<option value='-1'>Seleccione una empresa</option>
						<?  
							foreach($unidades as $empresas){
								echo "<option value='".$empresas['id']."'>".$empresas['nombre']."</option>";
							}
							
							?>
							</select>
						</td>
   						<td><input type="text" name="nombre" /></td>
 						<td><input type="number" name="cantidad" /></td>
 						<td><input type="button" id="guardar" value="Guardar"/></td>
 					</tr>
			</table>
			<? } ?>
			<div style="clear:both"></div>
			<div style="display:none">
				<input type="hidden" id="poblacion" name="poblacion" />
				<input type="hidden" id="encuestas" name="encuestas" />
			</div>
 			</form>

 			</div>		
		</div>		
</div>