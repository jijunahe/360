 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
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
.paginaselected{
	
	padding-left: 16px;
	padding-right: 16px;
	padding-top: 4px;
	padding-bottom: 3px;
	display: inline-block;
	border-radius: 7px;
	border: 1px solid rgb(109,92,157);
	background: #ABC;
	text-align: center;
	
}
.divContentBlue{
	    padding: 5px;
}
.crearorigenes{
	float:left;
 	width: 45%;
	
}
.origenes{
	float:left;
	margin-left:20px;
	width: 45%
}
</style>
<script>
var origenes=[];
<?php if(count($origenes)>0){
	echo "origenes=".json_encode($origenes).";";
}
?>
var acciones={
	enviar:function(){
		var verificacion=acciones.verificar();
		if(typeof verificacion=='object'){
			if(verificacion.responseText=="ok"){
 				jQuery("#formg").submit();
  			}else{
				jQuery.colorbox({html:"Ha ocurrido un erro al conectar.<br> Por favor verifique los datos de conexión y que el servidor de base de datos permita conexiónes remotas"});
			}
		}else{
				jQuery.colorbox({html:"Ha ocurrido un erro al conectar.<br> Por favor verifique los datos de conexión y que el servidor de base de datos permita conexiónes remotas"});
		}			
 	},
	editar:function(k){

		var datos=origenes[k];
		var config=["password","usuario","origendedatos","ip"];
		
		jQuery.each(datos,function(id,dato){
 			if(config.indexOf(id)>-1){
				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/origenes",
					data:{dato:dato,option:"decript"},
					success:function(res){
					}
				}).responseJSON;				
				dato=res[0];
 			}
			jQuery("[name='"+id+"']").val(dato);
		});
		//jQuery("[name='option']").val("editar");
		jQuery("[name='cancelar']").show();
	 
	},
	eliminar:function(k){
		if(confirm("Eliminar?")){
 			var datos=origenes[k];
			jQuery.each(datos,function(id,dato){
				jQuery("[name='"+id+"']").val(dato);
			});
			jQuery("[name='option']").val("eliminar");
			jQuery("#formg").submit();			
 		}
	},
	cancelar:function(){
		var txt=jQuery("#formg").find("[type='text']");
		jQuery.each(txt,function(k,obj){
			jQuery(obj).val("");
		});
		
	},
	verificar:function(k=null){
		var objetoenvio={}
		if(k!=null){
			objetoenvio=origenes[k];
		}else{
			var datos=jQuery("#formg").find("input");
			jQuery.each(datos,function(kd,obj){
				var valor=jQuery(obj).val();
				var id=jQuery(obj).attr("name");
				objetoenvio[id]=valor;
			});
		}
		objetoenvio["option"]="Test";
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/origenes",
			data:objetoenvio,
			success:function(res){
				 
			}
		});
		return res; 
	}
}
jQuery(function(){
	jQuery(".editar").click(function(){
		var id=jQuery(this).attr("id");
		var k=jQuery(this).attr("target");
		acciones.editar(k);
 	});
	jQuery("[name='cancelar']").click(function(){
		acciones.cancelar();
		jQuery(this).hide();
	});
	jQuery(".eliminar").click(function(){
		if(confirm("Esta seguro de eliminar este origen de datos?. Todos los reportes asociados a este origen pueden ser afectados")){
			var id=jQuery(this).attr("id");
			var k=jQuery(this).attr("target");
			acciones.eliminar(k);
		}
	});
	
	jQuery(".guardar").click(function(){
 		acciones.enviar();
 	});
	
	jQuery(".test").click(function(){
		var verificacion=acciones.verificar();
		if(typeof verificacion=='object'){console.log(verificacion)
			if(verificacion.responseText=="ok"){
				jQuery.colorbox({html:"La conexión funciona!"});
  			}else{
				jQuery.colorbox({html:"Ha ocurrido un erro al conectar.<br> Por favor verifique los datos de conexión y que el servidor de base de datos permita conexiónes remotas"});
			}
		}else{
				jQuery.colorbox({html:"Ha ocurrido un erro al conectar.<br> Por favor verifique los datos de conexión y que el servidor de base de datos permita conexiónes remotas"});
		}			
 	});
	

})
</script>
 
<div id="content" style="position:relative">
  
		<div class="crearorigenes">
			<div class="divContentBlue">
				<div class="divContentWhite"> 
					<?php echo CHtml::form(array("admin/origenes"), 'post', array('class'=>'formg', 'id'=>'formg','style'=>'float: left')); ?>
						Nombre<br> <input type="text" name="nombre"  placeholder='Nombre de conexión' /><br><br>
						Tipo<br><select name="id_motor" >
							<option value="1">MySql</option>
						</select><br><br>
						IP o dominio servidor<br> <input type="text" name="ip"  placeholder='IP o dominio servidor' /><br><br>
						Base de Datos<br> <input type="text" name="origendedatos"  placeholder='Base de datos' /><br><br>
						Usuario<br> <input type="text" name="usuario"  placeholder='Usuario' autocomplete="off"/><br><br>
						Contraseña<br> <input type="password" name="password"  placeholder='******' autocomplete="off" /><br><br>
						Puerto<br> <input type="text" name="puerto"  value="3306" autocomplete="off" /><br><br>
						<input type='button' value='Guardar' name="guardar"  class="guardar" /> 
						<input type='button' value='Test' name="test" class="test"  /> 
						<input type='button' value='Cancelar' name="cancelar" style="display:none" /> 
						<input type='hidden'  name='option' value='crear'/>
						<input type='hidden'  name='id' value=''/>
					</form>
				 <div style="clear:both"></div>
				</div>
			</div>
		</div>
		<div class="origenes">
			<div class="divContentBlue">
				<h1>Origenes</h1>
				<div class="divContentWhite">
					<ul>
					
					<?php
 						foreach($origenes as $k=>$origen){
							?>
							<li>
							 
							<div style="float:left; width:45%"><?=$origen->nombre?></div>
							<div style="float:left; width:45%">
								<div style="float:left; width:45%; cursor:pointer" target="<?=$k?>" class="editar" id="<?=$origen->nombre?>">Editar</div>
								<div style="float:left; width:45%; cursor:pointer" target="<?=$k?>" class="eliminar" id="<?=$origen->nombre?>">Eliminar</div>
							</div>
 							</li>
							<?php
						}
					
					
					?>
					</ul>
				</div>
			</div>
		</div>
		
		<div style="clear:both"></div>
	 
</div>
