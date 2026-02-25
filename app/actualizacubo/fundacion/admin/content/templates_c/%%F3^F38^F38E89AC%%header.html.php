<?php /* Smarty version 2.6.6, created on 2012-09-26 14:37:05
         compiled from C:%5CAppServ%5Cwww%5Cwebmovil%5Cmartesdemarcas%5Cpublication%5Cadmin/content/templates/header.html */ ?>
<?php if ($this->_tpl_vars['obj']->mErrorMessage != ""): ?>
	<script>
    	alert('<?php echo $this->_tpl_vars['obj']->mErrorMessage; ?>
');
    </script>
<?php endif; ?>
<div class="logo"><a href="index.php"><img src="images/logo.png" border="0" /></a></div>
<div class="menuTopRight">
	<?php if ($this->_tpl_vars['obj']->showManagerIp): ?>
	<div class="right"><a id="managerIP" href="javascript:void(0);"><img src="images/IP.png" border="0" width="35" /></a></div>
    <?php endif; ?>
</div>