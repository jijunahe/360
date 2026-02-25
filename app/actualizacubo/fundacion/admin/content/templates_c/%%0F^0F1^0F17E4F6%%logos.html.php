<?php /* Smarty version 2.6.6, created on 2012-10-18 01:51:42
         compiled from C:%5CAppServ%5Cwww%5Cwebmovil%5Cmartesdemarcas%5Cpublication%5Cadmin/content/templates/logos.html */ ?>
 <script type="text/javascript" src="js/flogos.js"></script>
 <div class="contentForm" style="width:inherit;">
<?php if ($this->_tpl_vars['obj']->modo == 'editar' || $this->_tpl_vars['obj']->modo == 'agregar'): ?>
         <input type="hidden" name="itemId" id="itemId" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
" />
        <input type="hidden" name="type" id="type" value="<?php echo $this->_tpl_vars['obj']->modo; ?>
" />
         <div id="LOGOS" class="left">
		        <div class="left Items" id="item_1">
					<div class="left content_field">
						<label for="fecha" class="font14 fontgris">Nombre Logo</label><br>
						<input type="text" class="rounded3 nombre" id="nombre_1" name="nombre_1" value="<?php echo $this->_tpl_vars['obj']->mDetalle['nombre']; ?>
"/>
					</div>
					<div class="left content_field">
						<label for="dia" class="font14 fontgris">Nivel</label><br>
						<select name="nivel_1" id="nivel_1" class="nivel">
						<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->niveles) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						   <?php if ($this->_tpl_vars['obj']->mDetalle['idNivel'] > 0): ?>
							<option value="<?php echo $this->_tpl_vars['obj']->niveles[$this->_sections['k']['index']]->id; ?>
" <?php if ($this->_tpl_vars['obj']->mDetalle['idNivel'] == $this->_tpl_vars['obj']->niveles[$this->_sections['k']['index']]->id): ?>selected<?php endif; ?> > <?php echo $this->_tpl_vars['obj']->niveles[$this->_sections['k']['index']]->nombre; ?>
</option>
						   <?php else: ?>
							<option value="<?php echo $this->_tpl_vars['obj']->niveles[$this->_sections['k']['index']]->id; ?>
" <?php if ($this->_tpl_vars['obj']->niveles[$this->_sections['k']['index']]->id == 1): ?>selected<?php endif; ?> > <?php echo $this->_tpl_vars['obj']->niveles[$this->_sections['k']['index']]->nombre; ?>
</option>
							<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</div> 
					<div class="left content_field" style="width: 500px;">
						<form action="upload.php" method="POST" target="puente" enctype='multipart/form-data' style="float: left;" >
							<label for="dia" class="font14 fontgris">Imagen</label><br>
							<input type="file" name="imglogo_1" class="logo" id="imglogo_1"/>
							<input type="hidden" class="count" name="count" value="1"/>
 						</form>
						<div class="images" style="margin-top: -11px;float: left;margin-left: 52px;">
						<?php if ($this->_tpl_vars['obj']->mDetalle['archivo'] != ""): ?>
						<img src="../images/logos/<?php echo $this->_tpl_vars['obj']->mDetalle['archivo']; ?>
" style="width: 118;"/>
						<?php endif; ?>
						</div>
						<?php if ($this->_tpl_vars['obj']->mDetalle['archivo'] != ""): ?>
						<input type="hidden" class="itemID" name="itemID" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
"/>
						<input type="hidden" class="update" name="update" value="1"/>
						<?php else: ?>
						<input type="hidden" class="update" name="update" value="0"/>
						<?php endif; ?>
					</div> 
					
				</div>
 		</div>
		
		<div class="btnAction">
            	<input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" id="guardar" type="button" value="Guardar" >
            	<input class="clearfix submit_frm left" frmid="frmtplregistro" type="button" value="Cancelar" onclick="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
');">
        </div>
		
		<div id="AgregarItem" style="cursor:pointer;float: left;">Agregar Item</div>

        <div class="left" id="errorField" style="color:#F00; margin:0 0 0 30px; display:none;"><div id="messageError"></div></div>
 	<iframe   id="puente" name="puente" style="display:block"></iframe>
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
            <div class="left btnAction">            	
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
                	<img src="images/iconAddUser.png" border="0" align="absmiddle" class="left" />
                    <span style="float:left; margin:7px 0 0 0;">Agregar Nuevo</span>
                </a>
            </div>
        </div>
        <div class="left itemlist">
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                <tr>
                    <th align="left" width="250">Nombre Log</th>
                    <th align="left">Nivel</th>
                    <th align="left">Archivo</th>
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
                    <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->nombre; ?>
</td>
                    <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->idNivel; ?>
</td>
                    <td><img src="../images/logos/<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->archivo; ?>
" style="width: 118;"/> </td>
                    <td align="center" class="btonActionItem" width="170">
                    	
                        <a href="<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->linkEditar; ?>
">
                        	<img src="images/iconEditUser.png" border="0" align="middle" class="left" />
                            <span style="float:left; margin:7px 0 0 5px;">Editar</span>
                        </a>
                        <a href="javascript:void(0);" onclick="confirmAction('¿Esta seguro de eliminar el registro?, tenga en cuenta que toda actividad asociada al mismo, serán eliminados','<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->linkEliminar; ?>
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
    <?php endif; ?>
</div>