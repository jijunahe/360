<?php /* Smarty version 2.6.6, created on 2013-03-22 15:33:52
         compiled from /domains/home/brm/public_html/appmartesdemarcas/admin/content/templates/managerIp.html */ ?>
<div class="seccionModal bordergray2">
    <div>
    <form id="ipNuevo" name="ipNuevo" action="" method="POST">
    <b class="text">Ip nueva</b>
    <hr>
    <table>
        <tr>
            <td><label class="font14 fontgris">IP:</label></td><td><input class="rounded3 font12" name="ip" id="ip" type="text" />&nbsp;&nbsp;&nbsp;</td>
            <td><label class="font14 fontgris">Resumen:</label></td><td><input class="rounded3 font12" name="resumen" id="resumen" type="text" /></td>
            <td><a href="javascript:void(0);" onclick="validateSaveIp();"><img src="images/iconSave.png" border="0" align="" /></a></td>
        </tr>
    </table>	
    </form>
    </div>
    
    <div class="itemlist fontgris">
        <table border="0" cellpadding="0" cellspacing="0" align="center" width="600">
            <tr>
                <th align="left" width="40">ID</th>
                <th align="left" width="120">IP</th>
                <th align="left" width="305">RESUMEN</th>
                <th align="left" width="100">&nbsp;</th>
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
                <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->id; ?>
</td>
                <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->ip; ?>
</td>
                <td><?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->resumen; ?>
</td>
                <td align="center" class="btonActionItem">                
                    <a href="javascript:void(0);" onclick="deleteItem('¿Esta seguro de eliminar el registro?','managerIp', '<?php echo $this->_tpl_vars['obj']->mLista[$this->_sections['k']['index']]->id; ?>
');">
                        <img src="images/iconDelete.png" border="0" align="absmiddle" class="left" />
                        <span style="float:left; margin:7px 0 0 5px;">Eliminar</span>
                    </a>
                </td>
            </tr>
            <?php endfor; endif; ?>                
        </table>
    </div>
</div>
<div class="left" id="errorField" style="color:#F00; margin:0 0 0 30px; display:none;"><div id="messageError"></div></div>