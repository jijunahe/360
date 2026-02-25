<?php /* Smarty version 2.6.18, created on 2014-04-03 02:42:43
         compiled from C:%5CAppServ%5Cwww%5Cismosite%5Cadmin/content/templates/contenidos.html */ ?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
</style>

<div class="contentForm" style="width:inherit;">

<div class="left pagelist" style="height: auto; width: 1660px;">
         
            <div class="btnAdd">
            	<a href="javascript:;" rel="agregar|seccion">
                	<img src="images/iconAddUser.png" border="0" align="absmiddle" class="left">
                    <span style="float:left; margin:7px 0 0 0;">Agregar Nuevo</span>
                </a>
            </div>
</div>




<div class="left itemlist" style="width: 1625px;">
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                <tbody>
				<tr>
					<th align="left">Id</th>
                    <th align="left" width="250">Titulo</th>                    
                    <th align="left" width="250">Contenido</th>                    
                      <th align="left">Visible</th>
                     <th align="left" width="150">&nbsp;</th>
				</tr>
                			</tbody>
				<?php $_from = $this->_tpl_vars['obj']->contenidos; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['contenido']):
?>	
					<tr>
						<td><?php echo $this->_tpl_vars['contenido']->id; ?>
</td>
						<td><?php echo $this->_tpl_vars['contenido']->titulo; ?>
</td>
						<td><?php echo $this->_tpl_vars['contenido']->texto; ?>
</td>
 						<td><?php echo $this->_tpl_vars['contenido']->visible; ?>
</td>
						<td align="center" class="btonActionItem" width="170">
							<a href="javascript:;" rel="editar|<?php echo $this->_tpl_vars['contenido']->id; ?>
">
							<img src="images/iconEditUser.png" border="0" align="middle" class="left">
							<span style="float:left; margin:7px 0 0 5px;">Editar</span>
							</a>
							<a href="javascript:;" rel="eliminar|<?php echo $this->_tpl_vars['contenido']->id; ?>
">
							<img src="images/iconDeleteUser.png" border="0" align="absmiddle" class="left">
							<span style="float:left; margin:7px 0 0 5px;">Eliminar</span>
							</a>                        
                        </td>
					</tr>
				<?php endforeach; endif; unset($_from); ?>
 			</table>
		</div>
</div> 
 
<script>
jQuery("[rel^='editar']").click(function(){

	var item=jQuery(this).attr("rel").split("|");
	var OBJ=jQuery(this)
	var HTML='<div id="editar" width="600" >';
        HTML+='<table  class="tg" align="center" width="100%">';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" class="tg-031e">Seccion</td>';                    
        HTML+=' <td align="left" width="135"><select name="idSeccion"><option value="0">Ninguno</option><?php $_from = $this->_tpl_vars['obj']->secciones; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['seccion']):
?><option value="<?php echo $this->_tpl_vars['seccion']->id; ?>
"><?php echo $this->_tpl_vars['seccion']->titulo; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250"class="tg-031e">Titulo</td>';                    
        HTML+=' <td align="left" width="135"><input type="text" name="titulo" value="'+jQuery(this).parent().parent().find("td:eq(1)").text()+'" /></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" class="tg-031e">Contenido:</td>';                    
        HTML+=' <td align="left" width="135"><textarea rows="10" cols="50" name="texto">'+jQuery(this).parent().parent().find("td:eq(2)").text()+'</textarea></td>';
		HTML+='</tr>'; 		
		HTML+='<tr>';
        HTML+=' <td align="left" width="250" class="tg-031e">Visible:</td>';                    
        HTML+=' <td align="left" width="135"><select name="visible"><option value="S">S</option><option value="N">N</option></select></td>';
		HTML+='</tr>';
         HTML+='</table><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Actualizar"  rel="Actualizar|contenidos"/><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Cancelar"  onclick="jQuery.colorbox.close()"/> </div>';		
		
	
		jQuery.colorbox({html:HTML,width:"924px" });
	
		jQuery("[rel^='Actualizar']").click(function(){
			var TIPO=jQuery(this).attr("rel").split("|");
			jQuery.ajax({
				type: "POST",
				url: "ajax.php",
				data: { tipo:TIPO[1],opcion:TIPO[0], id: item[1],titulo:jQuery("#editar [name='titulo']").val(),visible:jQuery("#editar [name='visible']").val(),texto:jQuery("#editar [name='texto']").val(),idSeccion:jQuery("#editar [name='idSeccion']").val()}
			}).done(function( datos ) {
				 if(datos=="ok"){
					OBJ.parent().parent().find("td:eq(1)").text(jQuery("#editar [name='titulo']").val());
					OBJ.parent().parent().find("td:eq(3)").text(jQuery("#editar [name='visible']").val());
					OBJ.parent().parent().find("td:eq(2)").text(jQuery("#editar [name='texto']").val());
					jQuery.colorbox({html:"El contenido ha sido actualizado"});
				}
			});
		});


});
jQuery("[rel^='agregar']").click(function(){

	var item=jQuery(this).attr("rel").split("|");
	var OBJ=jQuery(this)
	var HTML='<div id="agregar" >';
        HTML+='<table class="tg" align="center" width="900">';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" class="tg-031e">Seccion</td>';                    
        HTML+=' <td align="left" width="135"><select name="idSeccion"><option value="0">Ninguno</option><?php $_from = $this->_tpl_vars['obj']->secciones; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['seccion']):
?><option value="<?php echo $this->_tpl_vars['seccion']->id; ?>
"><?php echo $this->_tpl_vars['seccion']->titulo; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" class="tg-031e">Titulo</td>';                    
        HTML+=' <td align="left" width="135"><input type="text" name="titulo"  /></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Contenido:</td>';                    
        HTML+=' <td align="left" width="135"><textarea rows="20" cols="20" name="texto"></textarea></td>';
		HTML+='</tr>'; 		
		
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" class="tg-031e">Visible:</td>';                    
        HTML+=' <td align="left" width="135"><select name="visible"><option value="S">S</option><option value="N">N</option></select></td>';
		HTML+='</tr>';
 		 
        HTML+='</table><div style="cursor:pointer" rel="Agregar|contenidos">Agregar</div><br>   <div style="cursor:pointer" onclick="jQuery.colorbox.close()">Cancelar</div></div>';		
		
	
		jQuery.colorbox({html:HTML,width:"924px" });
	
		jQuery("[rel^='Agregar']").click(function(){
			var TIPO=jQuery(this).attr("rel").split("|");
			jQuery.ajax({
				type: "POST",
				url: "ajax.php",
				data: { tipo:TIPO[1],opcion:TIPO[0], id: item[1],titulo:jQuery("#agregar [name='titulo']").val(),visible:jQuery("#agregar [name='visible']").val(),idSeccion:jQuery("#agregar [name='idSeccion']").val(),texto:jQuery("#agregar [name='texto']").val()}
			}).done(function( datos ) {
				 if(datos=="ok"){
 					jQuery.colorbox({html:"El contenido ha sido agregado"});
					setTimeout(function(){document.location="index.php?seccion=contenidos"},1800);
				}
			});
		});


});
jQuery("[rel^='eliminar']").click(function(){

	var item=jQuery(this).attr("rel").split("|");
	var OBJ=jQuery(this)
	var HTML='<div id="editar" width="600" >';
        HTML+='<table border="0" cellpadding="1" cellspacing="0" align="center" width="100%">';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Seguro decea eliminar esta seción?</td>';                    
 		HTML+='</tr>';
  		 
        HTML+='</table><div style="cursor:pointer" rel="Elimina|contenidos">Aceptar</div><br>   <div style="cursor:pointer" onclick="jQuery.colorbox.close()">Cancelar</div></div>';		
		
	
		jQuery.colorbox({html:HTML});
	
		jQuery("[rel^='Elimina']").click(function(){
			var TIPO=jQuery(this).attr("rel").split("|");
			jQuery.ajax({
				type: "POST",
				url: "ajax.php",
				data: { tipo:TIPO[1],opcion:TIPO[0], id: item[1]}
			}).done(function( datos ) {
				 if(datos=="ok"){
					OBJ.parent().parent().remove();
 					jQuery.colorbox({html:"El contenido ha sido Eliminado"});
				}
			});
		});


});
</script>