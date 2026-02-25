<?php /* Smarty version 2.6.18, created on 2014-04-03 02:15:20
         compiled from C:%5CAppServ%5Cwww%5Cismosite%5Cadmin/content/templates/secciones.html */ ?>
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
                    <th align="left" width="135">IdPadre</th>
                     <th align="left">Visible</th>
                     <th align="left" width="150">&nbsp;</th>
				</tr>
                			</tbody>
				<?php $_from = $this->_tpl_vars['obj']->secciones; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['seccion']):
?>	
					<tr>
						<td><?php echo $this->_tpl_vars['seccion']->id; ?>
</td>
						<td><?php echo $this->_tpl_vars['seccion']->titulo; ?>
</td>
						<td><?php echo $this->_tpl_vars['seccion']->idPadre; ?>
</td>
						<td><?php echo $this->_tpl_vars['seccion']->visible; ?>
</td>
						<td align="center" class="btonActionItem" width="170">
							<a href="javascript:;" rel="editar|<?php echo $this->_tpl_vars['seccion']->id; ?>
">
							<img src="images/iconEditUser.png" border="0" align="middle" class="left">
							<span style="float:left; margin:7px 0 0 5px;">Editar</span>
							</a>
							<a href="javascript:;" rel="eliminar|<?php echo $this->_tpl_vars['seccion']->id; ?>
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
<div id="modales" style="display:none">
	<div id="editar" width="400">
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
 				<tr>
                     <td align="left" width="250">Titulo</td>                    
                    <td align="left" width="135">IdPadre</td>
				</tr>
                			 
 			</table>		
		
	</div>
</div>
<script>
jQuery("[rel^='editar']").click(function(){

	var item=jQuery(this).attr("rel").split("|");
	var OBJ=jQuery(this)
	var HTML='<div id="editar" width="600" >';
        HTML+='<table border="0" cellpadding="1" cellspacing="0" align="center" width="100%">';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Seccion Padre</td>';                    
        HTML+=' <td align="left" width="135"><select name="idPadre"><option value="0">Ninguno</option><?php $_from = $this->_tpl_vars['obj']->secciones; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['seccion']):
?><option value="<?php echo $this->_tpl_vars['seccion']->id; ?>
"><?php echo $this->_tpl_vars['seccion']->titulo; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Titulo</td>';                    
        HTML+=' <td align="left" width="135"><input type="text" name="titulo" value="'+jQuery(this).parent().parent().find("td:eq(1)").text()+'" /></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Visible:</td>';                    
        HTML+=' <td align="left" width="135"><select name="visible"><option value="S">S</option><option value="N">N</option></select></td>';
		HTML+='</tr>';
        HTML+='</table><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Actualizar"  rel="Actualizar|secciones"/><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Cancelar"  onclick="jQuery.colorbox.close()"/> </div>';		
 		
	
		jQuery.colorbox({html:HTML});
	
		jQuery("[rel^='Actualizar']").click(function(){
			var TIPO=jQuery(this).attr("rel").split("|");
			jQuery.ajax({
				type: "POST",
				url: "ajax.php",
				data: { tipo:TIPO[1],opcion:TIPO[0], id: item[1],titulo:jQuery("#editar [name='titulo']").val(),visible:jQuery("#editar [name='visible']").val(),idPadre:jQuery("#editar [name='idPadre']").val()}
			}).done(function( datos ) {
				 if(datos=="ok"){
					OBJ.parent().parent().find("td:eq(1)").text(jQuery("#editar [name='titulo']").val());
					OBJ.parent().parent().find("td:eq(3)").text(jQuery("#editar [name='visible']").val());
					OBJ.parent().parent().find("td:eq(2)").text(jQuery("#editar [name='idPadre']").val());
					jQuery.colorbox({html:"La sección ha sido actualizada"});
				}
			});
		});


});
jQuery("[rel^='agregar']").click(function(){

	var item=jQuery(this).attr("rel").split("|");
	var OBJ=jQuery(this)
	var HTML='<div id="agregar" width="600" >';
        HTML+='<table border="0" cellpadding="1" cellspacing="0" align="center" width="100%">';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Seccion Padre</td>';                    
        HTML+=' <td align="left" width="135"><select name="idPadre"><option value="0">Ninguno</option><?php $_from = $this->_tpl_vars['obj']->secciones; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['seccion']):
?><option value="<?php echo $this->_tpl_vars['seccion']->id; ?>
"><?php echo $this->_tpl_vars['seccion']->titulo; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Titulo</td>';                    
        HTML+=' <td align="left" width="135"><input type="text" name="titulo"  /></td>';
		HTML+='</tr>';
 		HTML+='<tr>';
        HTML+=' <td align="left" width="250" style="background: #999;color:#fff">Visible:</td>';                    
        HTML+=' <td align="left" width="135"><select name="visible"><option value="S">S</option><option value="N">N</option></select></td>';
		HTML+='</tr>';
        HTML+='</table><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Agregar"  rel="Agregar|secciones"/><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Cancelar"  onclick="jQuery.colorbox.close()"/> </div>';		
 		
	
		jQuery.colorbox({html:HTML});
	
		jQuery("[rel^='Agregar']").click(function(){
			var TIPO=jQuery(this).attr("rel").split("|");
			jQuery.ajax({
				type: "POST",
				url: "ajax.php",
				data: { tipo:TIPO[1],opcion:TIPO[0], id: item[1],titulo:jQuery("#agregar [name='titulo']").val(),visible:jQuery("#agregar [name='visible']").val(),idPadre:jQuery("#agregar [name='idPadre']").val()}
			}).done(function( datos ) {
				 if(datos=="ok"){
 					jQuery.colorbox({html:"La sección ha sido agregada"});
					setTimeout(function(){document.location="index.php?seccion=secciones"},1800);
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
        HTML+='</table><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Agregar"  rel="Elimina|secciones"/><input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Cancelar"  onclick="jQuery.colorbox.close()"/> </div>';		
 		
	
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
 					jQuery.colorbox({html:"La sección ha sido Eliminada"});
				}
			});
		});


});
</script>