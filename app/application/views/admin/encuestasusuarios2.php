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
function confirmarEliminar(mostrar,usuario)
	{
		if (confirm("Se eliminarán todos los datos del usuario incluyendo evaluaciones y reportes ¿Desea confirmar?"))
		{	//document.Eliminar.submit()
                        location.href="admUsuariosLista.php?s="+mostrar+" &id="+usuario+"&uActivo=3";
                }  else
			alert("El usuario no se ha eliminado...")
	}
</script>
<script type="text/javascript">
var listado = <?=json_encode($empl)?>;
var obj = {
	enviar : function(){
		var i = 0;
		var ids = "-1";
		for(i=0;i<listado.length;i++){
			if(document.getElementById("check"+i).checked){
				ids += ","+listado[i].id_user;
			}
		}
		if(ids == "-1"){
			alert("Debe seleccionar al menos un usuario para enviarle la contraseña");
			return;
		}
		document.getElementById("ids").value = ids;
		document.getElementById("formPass").submit();
	}
}
function Activa(){
	jQuery("[rel^='inactiva_'],[rel^='activa_']").click(function(){
	 
			var id=jQuery(this).attr("rel").split("_");
			var estado=1;
			var evento="inactiva";
			if(id[0]=="inactiva"){
				estado=0;
				evento="activa";
 			}
 			var url="/evalGenserbeta/index.php/admin/usuarios/";
			var pars = { id : id[1],option:3,activo:estado};
 			var res = jQuery.ajax({ 
			type: "POST",
			dataType: "html",
			async: false,
			url: url,
			data:pars 
			}).responseText;
			if(res=="OK"){
				if(estado==0){
 					jQuery(this).attr("src","<?=$imageurl?>bneg.png");
 					
				}else{
					jQuery(this).attr("src","<?=$imageurl?>bgre.png");
 				}
				jQuery(this).attr("rel",evento+"_"+id[1]);
				
 			}
			 	
 	});
	jQuery("[rel^='el_']").click(function(){
	
		if (confirm("Se eliminarán todos los datos del usuario incluyendo evaluaciones y reportes ¿Desea confirmar?"))
		{	//document.Eliminar.submit()
			
			
			var id=jQuery(this).attr("rel").split("_");
			 
			var url="/evalGenserbeta/index.php/admin/usuarios/";
			var pars = { id : id[1],option:4};
			var res = jQuery.ajax({ 
			type: "POST",
			dataType: "html",
			async: false,
			url: url,
			data:pars 
			}).responseText;
			if(res=="OK"){
				 
				jQuery(this).parent().parent().remove();
				alert("El usuario se ha eliminado...")		
				 
				
			}			
			
			
		}  else
		alert("El usuario no se ha eliminado...")	
 	
	});
	jQuery("[rel^='editar_']").click(function(){
		var id=jQuery(this).attr("rel").split("_");
		jQuery("#textId").val(id[1]);
		jQuery("#formEditar").submit();
	
	});

}
jQuery(function(){
	
	Activa();


});
</script>


<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
	<tr>
		<td>
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formActivo', 'id'=>'formActivo','style'=>'float: left')); ?>
				  <input type="hidden" id="option" name="option" value="1" />
				  <input type="button" value="Activos"  onclick="jQuery(this).parent().submit();"   />
			  </form>		
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formIncativo', 'id'=>'formIncativo','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="0" />
				  <input type="button" value="Invactivos"  onclick="jQuery(this).parent().submit();"    />
			  </form>		
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formTodos', 'id'=>'formTodos','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="2" />
				  <input type="button" value="Todos" onclick="jQuery(this).parent().submit();"  />
			  </form>		
			 <?php echo CHtml::form(array("admin/usuarios/crear"), 'post', array('class'=>'formTodos', 'id'=>'formTodos','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="5" />
				  <input type="button" value="Crear" onclick="jQuery(this).parent().submit();"  />
			  </form>		
		</td>
	
	</tr>
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Listado de personas <?=$show?>
			  <div class="divContentWhite">
			  <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formEditar', 'id'=>'formEditar')); ?>
 			  <input type="hidden"   name='option' value='10' />
			  <input type="hidden"   name='textId'   id='textId' value='' />
			  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
			    <tr>
				  <td width="40">Item</td>
				  <td>Documento</td>
				  <td>Nombre</td>
				  <td>Cargo</td>
				  <td>Usuario</td>
				  <td>Clave</td>
				  <td width="30"> </td>
				  <td width="30"> </td>
                                  <td width="30"> </td>
				</tr>
				<?PHP
				for($i=0;$i<count($empl);$i++){
					$datoAI = "A";
					if($empl[$i]->activo == 0){
						$datoAI = "I";
					}
                                        $img = $empl[$i]->activo==1?"<img src='".$imageurl."bgre.png' rel='inactiva_".$empl[$i]->id_user."'  alt='' style='cursor:pointer'>":"<img rel='activa_".$empl[$i]->id_user."' src='".$imageurl."bneg.png' alt=''  style='cursor:pointer'>";
					echo("
					<tr>
					  <td>".($i+1)."</td>
					  <td>
 						<input type='button' value='".$empl[$i]->documento."' rel='editar_".$empl[$i]->id_user."' style='width:100%' />
 					  </td>
					  <td>".($empl[$i]->nombres)."</td>
					  <td>".($empl[$i]->nom_cargo)."</td>
					  <td>".$empl[$i]->alias."</td>
					  <td>".$empl[$i]->clave."</td>
					  
					  <td align='center'><input type='checkbox' id='check".$i."' /></td>
                                          <td align='center'>$img</td> 
                                          <td align='center'><input type='image' src='".$imageurl."bad.gif' rel='el_".$empl[$i]->id_user."' value='Eliminar'></td>       
                                          <!-- <td align='center'><a href='admUsuariosLista.php?s=".$show."&id=".$empl[$i]->id_user."&uActivo=".'3'."'> <img src='img/bad.gif' alt=''> </a></td>  -->
                                              
					</tr>
					");
				}
				if(count($empl) == 0){
					echo("<tr><td colspan='5'>No hay ningun empleado</td></tr>");
				}
				?>
			  </table>
			  </form>
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formPass', 'id'=>'formPass')); ?>
				  <input type="hidden" id="ids" name="ids" value="" />
				  <input type="button" value="Enviar contrase&ntilde;as" onclick="obj.enviar();" />
			  </form>
			  </div>
			</div>
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