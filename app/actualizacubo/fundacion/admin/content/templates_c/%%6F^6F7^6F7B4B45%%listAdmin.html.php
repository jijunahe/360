<?php /* Smarty version 2.6.6, created on 2012-09-28 17:55:22
         compiled from C:%5CAppServ%5Cwww%5Cwebmovil%5Cmartesdemarcas%5Cpublication%5Cadmin/content/templates/listAdmin.html */ ?>
<div class="contentForm" style="width:inherit;">
    <?php if ($this->_tpl_vars['obj']->modo == 'editar' || $this->_tpl_vars['obj']->modo == 'agregar'): ?>
    <form action="" method="post" name="editaAdmin">
        <input type="hidden" name="itemId" id="itemId" value="<?php echo $this->_tpl_vars['obj']->mDetalle['id']; ?>
" />
        <input type="hidden" name="type" id="type" value="<?php echo $this->_tpl_vars['obj']->modo; ?>
" />
        <div class="left">
            <div class="left content_field">
                <label for="fecha" class="font14 fontgris">Nombre</label><br>
                <input type="text" class="rounded3" id="nombre" name="nombre" value="<?php echo $this->_tpl_vars['obj']->mDetalle['nombre']; ?>
"/>
            </div>
            <div class="left content_field">
                <label for="dia" class="font14 fontgris">Usuario</label><br>
                <input type="text" class="rounded3" id="user" name="user" value="<?php echo $this->_tpl_vars['obj']->mDetalle['login']; ?>
"/>
            </div> 
            <div class="left content_field">
                <label for="dia" class="font14 fontgris">Email</label><br>
                <input type="text" class="rounded3" id="email" name="email" value="<?php echo $this->_tpl_vars['obj']->mDetalle['email']; ?>
"/>
            </div> 
            <div class="left content_field">
                <label for="perfil" class="font14 fontgris">Perfil</label><br>
                <select class="rounded3" name="perfil" id="perfil">
                	<option value="0">Seleccione un perfil</option>
                    <?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->mListPerfil) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    	<?php if ($this->_tpl_vars['obj']->mDetalle['perfil'] == $this->_tpl_vars['obj']->mListPerfil[$this->_sections['k']['index']]->id): ?>
                    	<option value="<?php echo $this->_tpl_vars['obj']->mListPerfil[$this->_sections['k']['index']]->id; ?>
" selected="selected"><?php echo $this->_tpl_vars['obj']->mListPerfil[$this->_sections['k']['index']]->perfil; ?>
</option>
                        <?php else: ?>
                        <option value="<?php echo $this->_tpl_vars['obj']->mListPerfil[$this->_sections['k']['index']]->id; ?>
"><?php echo $this->_tpl_vars['obj']->mListPerfil[$this->_sections['k']['index']]->perfil; ?>
</option>
                        <?php endif; ?>
                    <?php endfor; endif; ?>
                </select>
            </div>
            <?php if ($this->_tpl_vars['obj']->modo == 'editar'): ?>
            <div class="left content_field">
                <label for="oldpass" class="font14 fontgris">Antigua clave</label><br>
                <input type="password" class="rounded3" id="oldpass" name="oldpass" value=""/>
            </div>
            <?php endif; ?>
            <div class="left content_field">
                <label for="newpass" class="font14 fontgris">Nueva clave</label><br>
                <input type="password" class="rounded3" id="newpass" name="newpass" value=""/>
            </div>
            <div class="left btnAction">
            	<input class="clearfix submit_frm left" style="margin-right:5px;" frmid="frmtplregistro" type="button" value="Guardar" onclick="return validaFormEditaAdmin('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
');">
            	<input class="clearfix submit_frm left" frmid="frmtplregistro" type="button" value="Cancelar" onclick="makeRedirect('<?php echo $this->_tpl_vars['obj']->mLinkVolver; ?>
');">
            </div>
        </div>
        <div class="left" id="errorField" style="color:#F00; margin:0 0 0 30px; display:none;"><div id="messageError"></div></div>
    </form>
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
                    <th align="left" width="250">Nombre</th>
                    <th align="left">Email</th>
                    <th align="left">Perfil</th>
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
                    <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->email; ?>
</td>
                    <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->perfilName; ?>
</td>
                    <td align="center" class="btonActionItem" width="170">
                    	<?php if ($this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->id == $_SESSION['adminUser']['id'] || $_SESSION['adminUser']['perfil'] == 1): ?>
                        <a href="<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->linkEditar; ?>
">
                        	<img src="images/iconEditUser.png" border="0" align="middle" class="left" />
                            <span style="float:left; margin:7px 0 0 5px;">Editar</span>
                        </a>
                        <a href="javascript:void(0);" onclick="confirmAction('¿Esta seguro de eliminar el registro?','<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->linkEliminar; ?>
');">
                        	<img src="images/iconDeleteUser.png" border="0" align="absmiddle" class="left" />
                        	<span style="float:left; margin:7px 0 0 5px;">Eliminar</span>
                        </a>                        
                        <?php else: ?>
                        <a href="<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->linkVer; ?>
">
                        	<img src="images/iconEditUser.png" border="0" align="middle" class="left" />
                            <span style="float:left; margin:7px 0 0 5px;">Ver</span>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endfor; endif; ?>                
            </table>
		</div>
    </div>
    <?php endif; ?>
</div>