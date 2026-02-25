<?php /* Smarty version 2.6.6, created on 2012-09-26 14:37:05
         compiled from C:%5CAppServ%5Cwww%5Cwebmovil%5Cmartesdemarcas%5Cpublication%5Cadmin/content/templates/menuLeft.html */ ?>
<ul>
	
   <?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->menuLinks) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <li><a href="<?php echo $this->_tpl_vars['obj']->menuLinks[$this->_sections['k']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['obj']->menuLinks[$this->_sections['k']['index']]['titulo']; ?>
	</a></li>
   <?php endfor; endif; ?>
	
    <li><a href="javascript:void(0);" onclick="confirmAction('¿Realmente desea cerrar la aplicasion?', '<?php echo $this->_tpl_vars['obj']->mLinkLogout; ?>
');">Salir</a></li>
</ul>