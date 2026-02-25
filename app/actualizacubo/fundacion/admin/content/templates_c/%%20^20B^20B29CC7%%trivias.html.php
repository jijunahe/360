<?php /* Smarty version 2.6.6, created on 2012-10-24 17:56:57
         compiled from C:%5CAppServ%5Cwww%5Cwebmovil%5Cmartesdemarcas%5Cpublication%5Cadmin/content/templates/trivias.html */ ?>
 <div class="contentForm" style="width:inherit;">
<?php if ($this->_tpl_vars['obj']->modo == 'agregar'): ?> <script type="text/javascript" src="js/ftrivias.js"></script>
        <input type="hidden" name="itemId" id="itemId" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
" />
        <input type="hidden" name="type" id="type" value="<?php echo $this->_tpl_vars['obj']->modo; ?>
" />
        <div id="TRIVIA" class="left">
			<input type="hidden" id="idPreguntaTemp" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
"/>
		        <div class="left Items" id="item_1">
					<div class="left content_field">
						<label for="fecha" class="font14 fontgris">Preguntas</label><br>
						<input type="text" class="rounded3 nombre" id="nombre_1" name="nombre_1" rel="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
" value="<?php echo $this->_tpl_vars['obj']->mDetalle['pregunta']; ?>
"/>
						<?php if ($this->_tpl_vars['obj']->mDetalle['idTipoPregunta'] != ""): ?><br>
						  Tipo de Pregunta 
							<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->tipopreguntas) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
								<?php if ($this->_tpl_vars['obj']->mDetalle['idTipoPregunta'] == $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->id): ?>
									<div id="TipoPregVal"><?php echo $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->nombre; ?>

										<input type="hidden" id="tipoPreguntaSelectes" value="<?php echo $this->_tpl_vars['obj']->mDetalle['idTipoPregunta']; ?>
">
									</div>
								<?php endif; ?>
							<?php endfor; endif; ?>
						<?php endif; ?>
 					</div>
					<div class="left content_field" >
						<label for="dia" class="font14 fontgris">Tipo pregunta</label><br>
						<select name="nivel_1" id="nivel_1" class="tipo">
								<option value="" selected > Selecciona el tipo de pregunta</option>
							<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->tipopreguntas) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->id; ?>
"  > <?php echo $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->nombre; ?>
</option>
							<?php endfor; endif; ?>
						</select>
					</div>  
					<div class="left content_field" >
						<label for="dia" class="font14 fontgris">Nivel de Juego</label><br>
						<select name="nivel_2" id="nivel_2" class="nivel">
								<option value="" selected > Selecciona el Nivel de juego</option>
							<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->Niveles) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['obj']->Niveles[$this->_sections['k']['index']]->id; ?>
"  > <?php echo $this->_tpl_vars['obj']->Niveles[$this->_sections['k']['index']]->nombre; ?>
</option>
							<?php endfor; endif; ?>
						</select>
					</div>  
					<div class="left content_field Configelementos" >
							<?php if ($this->_tpl_vars['obj']->mDetalle['idTipoPregunta'] == 1): ?>
							<img src="../images/logos/<?php echo $this->_tpl_vars['obj']->elements['logo'][1]; ?>
" style="width: 80;"/>
							<?php else: ?>
								<ul style="width: 303px;">
								 <?php unset($this->_sections['k2']);
$this->_sections['k2']['name'] = 'k2';
$this->_sections['k2']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->elements['respuestas']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k2']['show'] = true;
$this->_sections['k2']['max'] = $this->_sections['k2']['loop'];
$this->_sections['k2']['step'] = 1;
$this->_sections['k2']['start'] = $this->_sections['k2']['step'] > 0 ? 0 : $this->_sections['k2']['loop']-1;
if ($this->_sections['k2']['show']) {
    $this->_sections['k2']['total'] = $this->_sections['k2']['loop'];
    if ($this->_sections['k2']['total'] == 0)
        $this->_sections['k2']['show'] = false;
} else
    $this->_sections['k2']['total'] = 0;
if ($this->_sections['k2']['show']):

            for ($this->_sections['k2']['index'] = $this->_sections['k2']['start'], $this->_sections['k2']['iteration'] = 1;
                 $this->_sections['k2']['iteration'] <= $this->_sections['k2']['total'];
                 $this->_sections['k2']['index'] += $this->_sections['k2']['step'], $this->_sections['k2']['iteration']++):
$this->_sections['k2']['rownum'] = $this->_sections['k2']['iteration'];
$this->_sections['k2']['index_prev'] = $this->_sections['k2']['index'] - $this->_sections['k2']['step'];
$this->_sections['k2']['index_next'] = $this->_sections['k2']['index'] + $this->_sections['k2']['step'];
$this->_sections['k2']['first']      = ($this->_sections['k2']['iteration'] == 1);
$this->_sections['k2']['last']       = ($this->_sections['k2']['iteration'] == $this->_sections['k2']['total']);
?>
								 <li>
								     <input type="radio" name="rc" value="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][2]; ?>
" <?php if ($this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][1] == 'S'): ?>checked<?php endif; ?> />
									 <input type="text" id="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][1]; ?>
" value="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][0]; ?>
"/>
  									 <img rel="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][2]; ?>
" src="images/iconDelete.png" style="cursor:pointer"/>
								 </li>
								 <?php endfor; endif; ?>
								</ul>
							<?php endif; ?>
					</div> 

 				</div>
				<input type="hidden" id="logoSelected"/>
 		</div>
		
		<div class="btnAction">
            	<input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" id="guardarPreguntas" type="button" value="Guardar" >
            	<input class="clearfix submit_frm left" frmid="frmtplregistro" type="button" value="Cancelar" onclick="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
');">
        </div>
		
 
        <div class="left" id="errorField" style="color:#F00; margin:0 0 0 30px; display:none;"><div id="messageError"></div></div>
 	<iframe   id="puente" name="puente" style="display:none"></iframe>
<?php elseif ($this->_tpl_vars['obj']->modo == 'ver'): ?>
    	<div class="left">
            <div class="left content_field">
                <label for="fecha" class="font14 fontgris">Nombre</label><br>
                <?php echo $this->_tpl_vars['obj']->mDetalle['nombre']; ?>

            </div>
            <div class="left content_field">
                <label for="dia" class="font14 fontgris">Usuario</label><br>
                <?php echo $this->_tpl_vars['obj']->mDetalle['login']; ?>

            </div> 
            <div class="left content_field">
                <label for="dia" class="font14 fontgris">Email</label><br>
                <?php echo $this->_tpl_vars['obj']->mDetalle['email']; ?>

            </div>
            <div class="left content_field">
                <label for="perfil" class="font14 fontgris">Perfil</label><br>
                <?php echo $this->_tpl_vars['obj']->mDetalle['perfilName']; ?>

            </div>
            <div class="left btnAction" >            	
            	<input class="clearfix submit_frm left" frmid="frmtplregistro" type="button" value="Cancelar" onclick="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
');">
            </div>
        </div>
<?php elseif ($this->_tpl_vars['obj']->modo == 'listado'): ?>
	<div class="listado">
    	<div class="left pagelist" style="height:auto;">
        	<div class="pageNavigation">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="450">
                    <tr>
                        <td width="50"><?php echo $this->_tpl_vars['obj']->mPagination['mLinkPrimero']; ?>
</td>
                        <td width="60"><?php echo $this->_tpl_vars['obj']->mPagination['mLinkAtras']; ?>
</td>
                        <td align="center"><?php echo $this->_tpl_vars['obj']->mPagination['pagination']; ?>
</td>
                        <td width="50"><?php echo $this->_tpl_vars['obj']->mPagination['mLinkSiguiente']; ?>
</td>
                        <td width="50"><?php echo $this->_tpl_vars['obj']->mPagination['mLinkUltimo']; ?>
</td>
                    </tr>
                </table>
            </div>        
            <div class="search">
            	<form class="" action="" method="" onsubmit="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
&searchText='+jQuery('#inputSearch').val()); return false;">
                	<input class="left rounded3" type="text" name="inputSearch" id="inputSearch" value="<?php echo $this->_tpl_vars['obj']->mTextSearch; ?>
" />
                    <a href="javascript:void(0);" onclick="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
&searchText='+jQuery('#inputSearch').val()); return false;" class="left"><img src="images/iconSearch.png" border="0" align="absbottom" /></a>
                </form>
            </div>
            <div class="btnAdd">
            	<a href="<?php echo $this->_tpl_vars['obj']->mLinkAdd; ?>
">
                	<img src="images/iconAdd.png" border="0" align="absmiddle" class="left" />
                    <span style="float:left; margin:7px 0 0 0;">Agregar Nuevo</span>
                </a>
            </div>
        </div>
        <div class="left itemlist">
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                <tr>
                    <th align="left" width="250">Pregunta</th>
                    <th align="left">Tipo</th>
                    <th align="left">Archivo</th>
                    <th align="left">Nivel</th>
                    <th align="left" width="150">&nbsp;</th>
                </tr>
                <?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->mLista) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
				
                <tr>
                    <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['pregunta']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['idTipoPregunta']; ?>
</td>
					
                    <td>
					<?php if ($this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['idTipoPregunta'] == 1): ?>
					<img src="../images/logos/<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['logo'][1]; ?>
" style="width: 80;"/>
					<?php else: ?>
						<ul>
					     <?php unset($this->_sections['k2']);
$this->_sections['k2']['name'] = 'k2';
$this->_sections['k2']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['respuestas']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k2']['show'] = true;
$this->_sections['k2']['max'] = $this->_sections['k2']['loop'];
$this->_sections['k2']['step'] = 1;
$this->_sections['k2']['start'] = $this->_sections['k2']['step'] > 0 ? 0 : $this->_sections['k2']['loop']-1;
if ($this->_sections['k2']['show']) {
    $this->_sections['k2']['total'] = $this->_sections['k2']['loop'];
    if ($this->_sections['k2']['total'] == 0)
        $this->_sections['k2']['show'] = false;
} else
    $this->_sections['k2']['total'] = 0;
if ($this->_sections['k2']['show']):

            for ($this->_sections['k2']['index'] = $this->_sections['k2']['start'], $this->_sections['k2']['iteration'] = 1;
                 $this->_sections['k2']['iteration'] <= $this->_sections['k2']['total'];
                 $this->_sections['k2']['index'] += $this->_sections['k2']['step'], $this->_sections['k2']['iteration']++):
$this->_sections['k2']['rownum'] = $this->_sections['k2']['iteration'];
$this->_sections['k2']['index_prev'] = $this->_sections['k2']['index'] - $this->_sections['k2']['step'];
$this->_sections['k2']['index_next'] = $this->_sections['k2']['index'] + $this->_sections['k2']['step'];
$this->_sections['k2']['first']      = ($this->_sections['k2']['iteration'] == 1);
$this->_sections['k2']['last']       = ($this->_sections['k2']['iteration'] == $this->_sections['k2']['total']);
?>
						 <li><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['respuestas'][$this->_sections['k2']['index']]; ?>
</li>
						 <?php endfor; endif; ?>
						</ul>
					<?php endif; ?>
					</td>
					<td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['idNivelTrivia']; ?>
</td>
                    <td align="center" class="btonActionItem" width="170">
                    	
                        <a href="<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['linkEditar']; ?>
">
                        	<img src="images/iconEditUser.png" border="0" align="middle" class="left" />
                            <span style="float:left; margin:7px 0 0 5px;">Editar</span>
                        </a>
                        <a href="javascript:void(0);" onclick="confirmAction('¿Esta seguro de eliminar el registro?, tenga en cuenta que toda actividad asociada al mismo, serán eliminados','<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]['linkEliminar']; ?>
');">
                        	<img src="images/iconDeleteUser.png" border="0" align="absmiddle" class="left" />
                        	<span style="float:left; margin:7px 0 0 5px;">Eliminar</span>
                        </a>                        

                       
                    </td>
                </tr>
                <?php endfor; endif; ?>                
            </table>
		</div>
    </div>
<?php elseif ($this->_tpl_vars['obj']->modo == 'editar'): ?> <script type="text/javascript" src="js/ftriviaseditar.js"></script>
 
          <input type="hidden" name="itemId" id="itemId" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
" />
        <input type="hidden" name="type" id="type" value="<?php echo $this->_tpl_vars['obj']->modo; ?>
" />
         <div id="TRIVIA" class="left">
		 <input type="hidden" id="idPreguntaTemp" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
"/>
		        <div class="left Items" id="item_1">
					<div class="left content_field">
						<label for="fecha" class="font14 fontgris">Preguntas</label><br>
						<input type="text" class="rounded3 nombre" id="nombre_1" name="nombre_1" rel="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
" value="<?php echo $this->_tpl_vars['obj']->mDetalle['pregunta']; ?>
"/>
					
					</div>
					<div class="left content_field" >
						<label for="dia" class="font14 fontgris">Tipo pregunta</label><br>
						 
					<?php if ($this->_tpl_vars['obj']->mDetalle['idTipoPregunta'] != ""): ?><br>
					 <?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->tipopreguntas) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
					  <?php if ($this->_tpl_vars['obj']->mDetalle['idTipoPregunta'] == $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->id): ?>
					  <div id="TipoPregVal"><?php echo $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->nombre; ?>

					  <input type="hidden" id="tipoPreguntaSelectes" value="<?php echo $this->_tpl_vars['obj']->mDetalle['idTipoPregunta']; ?>
">
						</div><?php endif; ?>
									   <?php endfor; endif; ?>
					<?php endif; ?>
					<div style="display: none">
 						<select name="nivel_1" id="nivel_1" class="tipo">
							<option value="" selected > Seleccion el tipo de pregunta</option>
						<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->tipopreguntas) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
							<option value="<?php echo $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->id; ?>
"  > <?php echo $this->_tpl_vars['obj']->tipopreguntas[$this->_sections['k']['index']]->nombre; ?>
</option>
 						<?php endfor; endif; ?>
						</select>
 					</div>
					</div> 
					
					<div class="left content_field" style="margin-left:-40px;">
						<label for="dia" class="font14 fontgris">Nivel de Juego</label><br>
						<select name="nivel_2" id="nivel_2" class="nivel">
								<option value="" selected > Selecciona el Nivel de juego</option>
							<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->Niveles) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['obj']->Niveles[$this->_sections['k']['index']]->id; ?>
"  > <?php echo $this->_tpl_vars['obj']->Niveles[$this->_sections['k']['index']]->nombre; ?>
</option>
							<?php endfor; endif; ?>
						</select>
					</div> 					
					
					<div class="left content_field Configelementos" >
							<?php if ($this->_tpl_vars['obj']->mDetalle['idTipoPregunta'] == 1): ?>
							<img src="../images/logos/<?php echo $this->_tpl_vars['obj']->elements['logo'][1]; ?>
" style="width: 80;"/>
							<?php else: ?>
								<ul style="width: 303px;">
								 <?php unset($this->_sections['k2']);
$this->_sections['k2']['name'] = 'k2';
$this->_sections['k2']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->elements['respuestas']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k2']['show'] = true;
$this->_sections['k2']['max'] = $this->_sections['k2']['loop'];
$this->_sections['k2']['step'] = 1;
$this->_sections['k2']['start'] = $this->_sections['k2']['step'] > 0 ? 0 : $this->_sections['k2']['loop']-1;
if ($this->_sections['k2']['show']) {
    $this->_sections['k2']['total'] = $this->_sections['k2']['loop'];
    if ($this->_sections['k2']['total'] == 0)
        $this->_sections['k2']['show'] = false;
} else
    $this->_sections['k2']['total'] = 0;
if ($this->_sections['k2']['show']):

            for ($this->_sections['k2']['index'] = $this->_sections['k2']['start'], $this->_sections['k2']['iteration'] = 1;
                 $this->_sections['k2']['iteration'] <= $this->_sections['k2']['total'];
                 $this->_sections['k2']['index'] += $this->_sections['k2']['step'], $this->_sections['k2']['iteration']++):
$this->_sections['k2']['rownum'] = $this->_sections['k2']['iteration'];
$this->_sections['k2']['index_prev'] = $this->_sections['k2']['index'] - $this->_sections['k2']['step'];
$this->_sections['k2']['index_next'] = $this->_sections['k2']['index'] + $this->_sections['k2']['step'];
$this->_sections['k2']['first']      = ($this->_sections['k2']['iteration'] == 1);
$this->_sections['k2']['last']       = ($this->_sections['k2']['iteration'] == $this->_sections['k2']['total']);
?>
								 <li>
								     <input type="radio" name="rc" value="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][2]; ?>
" <?php if ($this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][1] == 'S'): ?>checked<?php endif; ?> />
									 <input type="text" id="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][1]; ?>
" value="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][0]; ?>
"/>
  									 <img rel="<?php echo $this->_tpl_vars['obj']->elements['respuestas'][$this->_sections['k2']['index']][2]; ?>
" src="images/iconDelete.png" style="cursor:pointer"/>
								 </li>
								 <?php endfor; endif; ?>
								</ul>
							<?php endif; ?>
					</div> 

 				</div>
				<input type="hidden" id="logoSelected"/>
 		</div>
		
		<div class="btnAction">
            	<input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" id="guardarPreguntas" type="button" value="Guardar" >
            	<input class="clearfix submit_frm left" frmid="frmtplregistro" type="button" value="Cancelar" onclick="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
');">
        </div>
		
 
        <div class="left" id="errorField" style="color:#F00; margin:0 0 0 30px; display:none;"><div id="messageError"></div></div>
 	<iframe   id="puente" name="puente" style="display:none"></iframe>
 <?php endif; ?>
</div>
 <div style="clear:both"></div><br>
<div id="itemConfi" style="border-bottom: 2px solid #999;">
	
	<div class="respuestas config"   style="display:none">
	   <div class="left itemlist">
			<div class="btnAction" style="min-height: 24px;" >
				<input type="button" class="clearfix submit_frm left" value="Agregar" style="float:left;margin-left: 10px;"/> 
			</div>
			<table border="1" cellpadding="0" cellspacing="0" align="center" style="float: left;">
				<tbody id="tbody">
					<tr>
						<th align="left" width="250">Respuesta
						</th>
						<th align="left">Estado</th>
						<th align="left"></th>
					</tr>
					<tr id="t1" class="resConf">
						<td><input type="text" style="float:left" class="inputRespueta"></td>
						<td><input type="radio" name="correcto" value="S" rel="1" /></td>
						<td>
							<div class="btnAction" style="min-height: 5px;width: 70px;margin-top:-1px" >
							<input type="button" class="clearfix submit_frm left" value="Eliminar" style="float:left;margin-left: 10px;"/>
							</div> 
						</td>
					</tr>
				</tbody>
			</table>	
	   </div>	
	</div>
	<div class="logos config"   style="display:none">
	
	   <div class="left itemlist">
			<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->logos) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
				<div class="ItemsImages" style="float:left; margin-left:20px; cursor:pointer" rel="<?php echo $this->_tpl_vars['obj']->logos[$this->_sections['k']['index']]->id; ?>
">		
					<img src="../images/logos/<?php echo $this->_tpl_vars['obj']->logos[$this->_sections['k']['index']]->archivo; ?>
" style="width: 118;"/> 
					<div style="clear:both"></div>
					<div class="nombreItem" ><?php echo $this->_tpl_vars['obj']->logos[$this->_sections['k']['index']]->nombre; ?>
</div>
				</div>
			<?php endfor; endif; ?>                
				
	   </div>
	</div>
 </div>