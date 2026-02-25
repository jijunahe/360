<link rel="stylesheet" href="/bateria/scripts/admin/colorbox/example1/colorbox.css" />
<script src="/bateria/scripts/admin/colorbox/jquery.colorbox.js"></script>
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
		<?php if($validaini=="OK"){ ?>
			var id=jQuery(this).attr("rel").split("_");
			var estado=1;
			var evento="inactiva";
			if(id[0]=="inactiva"){
				estado=0;
				evento="activa";
 			}
 			var url="<?=Yii::app()->baseUrl?>/admin/admusuario/";
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
		<?php } ?>	 	
 	});
	jQuery("[rel^='el_']").click(function(){
		<?php if($validaini=="OK"){ ?>
		if (confirm("Se eliminarán todos los datos del usuario incluyendo evaluaciones y reportes ¿Desea confirmar?"))
		{	//document.Eliminar.submit()
			
			
			var id=jQuery(this).attr("rel").split("_");
			 
			var url="<?=Yii::app()->baseUrl?>/admin/admusuario/";
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
				alert("El usuario se ha eliminado.")		
				 
				
			}else if(res=="OK"){
				alert("No tiene permiso para realizar esta accion.");
			}else if(res=="OK2"){
				alert("El usuario no ha sido eliminado. Este usuario ha diligenciado encuestas, detal manera que solo se le ha bloquedo el acceso.");
			}			
 		}
		<?php }?>
			 
 	
	});
	jQuery("[name^='editar_']").click(function(){
		var id=jQuery(this).attr("name").split("_");
  		jQuery("#formEditarus").append("<input type='hidden' name='idusuario' value='"+id[1]+"' />");
		jQuery("#formEditarus").submit();
	
	});

}
jQuery(function(){
	
	Activa();


});
</script>


<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
		<?php if($validaini=="OK"){ ?>

	<tr>
		<td>
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'formActivo', 'id'=>'formActivo','style'=>'float: left')); ?>
				  <input type="hidden" id="option" name="option" value="1" />
				  <input type="button" value="Activos"  onclick="jQuery(this).parent().submit();"   />
			  </form>		
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'formIncativo', 'id'=>'formIncativo','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="0" />
				  <input type="button" value="Invactivos"  onclick="jQuery(this).parent().submit();"    />
			  </form>		
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'formTodos', 'id'=>'formTodos','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="2" />
				  <input type="button" value="Todos" onclick="jQuery(this).parent().submit();"  />
			  </form>		
  				  <input type="button" value="Crear" rel="editar_0" />
 		</td>
	
	</tr>
		<?php } ?>
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">
				<div style="float:left">
 					
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'filtrounidades', 'id'=>'filtrounidades','style'=>'float: left')); ?>
							<? // printVar($empl[3]); ?>
							<input type="hidden" id="option" name="option" value="<?=$option?>" />
							Empresa:<select name="unidades">
									<option value="-1"  <? if($unidadesr==-1){echo "selected='selected'";} ?>>
									Todos
									</option>
								<?php 
								foreach($listaempresas as $unidad){ 
										$selected="";
										if($unidad->id==$unidadesr){
										$selected="selected='selected'";
										}									
									?>
								<option value="<?=$unidad->id?>"  <?=$selected?> >
									<?=$unidad->nombre?>
								</option>
								<?php
								}
								?>
							</select> 
							<input type="hidden" name="buscar" value="<?=$buscar?>" />
							<input type="hidden" name="perfilusuario" value="<?=$perfilusuarior?>" />
						</form>
					</div>
					
					
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'filtroperfil', 'id'=>'filtroperfil','style'=>'float: left')); ?>
							 <input type="hidden" id="option" name="option" value="<?=$option?>" />
							Perfilde usuario:<select name="perfilusuario">
								<option value="-1" <? if($perfilusuarior==-1){echo "selected='selected'";} ?>>
								Todos
								</option>								
								<?php 
								foreach($listaperfiles as $perfil){
									$selected="";
									if($perfil->id==$perfilusuarior){
										$selected="selected='selected'";
									}
									?>
								<option value="<?=$perfil->id?>" <?=$selected?> >
									<?=$perfil->nombre?>
								</option>
								<?php
								}
								?>
							</select> 
							<input type="hidden" name="buscar" value="<?=$buscar?>" />
							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
						</form>
					</div>
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'filtroestado', 'id'=>'filtroestado','style'=>'float: left')); ?>
							 <input type="hidden" id="option" name="option" value="<?=$option?>" />
							 <? 
								 $selecteda="";
								 $selectedb="";
								 $selectedc="";
								 if($estado==-1){$selecteda="selected=selected";}
								 if($estado==1){$selectedb="selected=selected";}
								 if($estado==0){$selectedc="selected=selected";}
								?>
							Estado:<select name="estado">
									<option value="-1" <?=$selecteda?> >
									Todos
									</option>								
								 
									<option value="1"  <?=$selectedb?> >Activo
										 
									</option>
									 
									 
									<option value="0"   <?=$selectedc?>>Inactivo
										 
									</option>
								 
								 
							</select> 
							<input type="hidden" name="buscar" value="<?=$buscar?>" />
							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
						</form>
					</div>
					
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
					<?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'buscarForm', 'id'=>'buscarForm','style'=>'float: left')); ?>
						 <input type="hidden" id="option" name="option" value="<?=$option?>" />
						Buscar: <input type="text" name="buscar" value="<?=$buscar?>" placeholder="cédula,nombre o email" /><input type="button" id="buscarbutton"  value="Buscar" /><input type="button" id="refrescar"  value="Refrescar"/> 
 							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
							<input type="hidden" name="perfilusuario" value="<?=$perfilusuarior?>" />
 					</form>
					</div>
					<div style="float:left;margin-top:10px;margin-left:10px" class="paginaselected">
						<?php echo CHtml::form(array("admin/rcv/crear"), 'post', array('class'=>'crear', 'id'=>'crear','style'=>'float: left')); ?>
							<input type="submit" value="Crear" />
						</form>
					</div>
				</div>
				<div style="float:right">
				<?
					$total_paginas=$paginacion[0];
					$pagina=$paginacion[1];
					$htmlpagina="";
					if ($total_paginas > 1) {
						if ($pagina != 1)
						  $htmlpagina.= '<input type="button"  rel="pagina_'.($pagina-1).'" value="<<"/>';
						  for ($i=1;$i<=$total_paginas;$i++) {
							 if ($pagina == $i)
								//si muestro el índice de la página actual, no coloco enlace
								$htmlpagina.=  "<div class='paginaselected'><b>".$pagina."</b></div>";
							 else
								//si el índice no corresponde con la página mostrada actualmente,
								//coloco el enlace para ir a esa página
								$htmlpagina.=  '  <input type="button"  rel="pagina_'.$i.'" value="'.$i.'"/>  ';
						  }
						  if ($pagina != $total_paginas)
							 $htmlpagina.=  '<input type="button"  rel="pagina_'.($pagina+1).'" value=">>"/>';
					}
					echo $htmlpagina;
				?>	
				</div>	 <div style="clear:both"></div>		  
			  <div class="divContentWhite">
			  <?php echo CHtml::form(array("admin/admusuario/crear"), 'post', array('class'=>'formEditarus', 'id'=>'formEditarus')); ?>
  			  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="tableContent">
			    <tr>
				  <td width="40" style="text-align:center"><b>Item</b></td>
  				  <td style="text-align:center"><b>Editar</b></td>
  				  <td style="text-align:center"><b>Empresa</b></td>
				  <td style="text-align:center"><b>Email</b></td>
				  <td style="text-align:center"><b>Perfil</b></td>
				  <td style="text-align:center"><b>Usuario</b></td>
				  <td style="text-align:center"><b>Clave</b></td>
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
					  <td>".$empl[$i]->id_user."</td>
					  <td>
 						<input type='button' value='Editar' name='editar_".$empl[$i]->id_user."' style='width:100%' />
 					  </td>
 					  <td>".($empl[$i]->empresa)."</td>
					  <td>".($empl[$i]->email)."</td>
					  <td><b>".($empl[$i]->perfil)."</b></td>
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
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'formPass', 'id'=>'formPass')); ?>
				  <input type="hidden" id="email" name="email" value="enviaremail" />
				  <input type="hidden" id="ids" name="ids" value="" />
				  <input type="button" value="Enviar contrase&ntilde;as" onclick="obj.enviar();" />
			  </form>
			 <?php echo CHtml::form(array("admin/admusuario/"), 'post', array('class'=>'paginar', 'id'=>'paginar')); ?>
				  <input type="hidden" id="tamanio" name="tamanio" value="10" />
				  <input type="hidden" id="pagina" name="pagina" value="" />
				  <input type="hidden" id="option" name="option" value="<?=$option?>" />
				  <input type="hidden" name="buscar" value="<?=$buscar?>" />
 							<input type="hidden" name="unidades" value="<?=$unidadesr?>" />
							<input type="hidden" name="perfilusuario" value="<?=$perfilusuarior?>" />
 			  </form> <div style="clear:both"></div>
			  </div>
			 
				<div style="float:right">
				<?
					echo $htmlpagina;		
				?>	
				</div> <div style="clear:both"></div>
			  <script>
				jQuery(function(){
					jQuery("[rel^='pagina_']").click(function(){
						var pagina=jQuery(this).attr("rel").split("_")[1];
						jQuery("#pagina").val(pagina);
						jQuery("#paginar").submit();
						
					});
					jQuery("#filtrounidades").find("[name='unidades']").change(function(){
  						jQuery("#filtrounidades").submit();
 					});
					jQuery("#filtroestado").find("[name='estado']").change(function(){
  						jQuery("#filtroestado").submit();
 					});
					jQuery("#filtroperfil").find("[name='perfilusuario']").change(function(){
  						jQuery("#filtroperfil").submit();
 					});
					jQuery("#buscarbutton").click(function(){
						var test=jQuery("#buscarForm").find("[name='buscar']").val();
						if(test!=""){
							
							jQuery("#buscarForm").submit();
						}else{
						
							jQuery.colorbox({html:"<h3>Por favor, agregue un criterio de búsqueda</h3>"});
						}
						
					});
					jQuery("#refrescar").click(function(){
						var test=jQuery("#buscarForm").find("[name='buscar']").val("");
 						jQuery("#buscarForm").submit();
 					});
					
				});
			  </script>
			  
			  
			</div>
		</td>
		</tr>
		<tr>
		<td>
 		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</div>