<?php /* Smarty version 2.6.6, created on 2013-03-21 07:50:58
         compiled from /domains/home/brm/public_html/appmartesdemarcas/admin/content/templates/header.html */ ?>
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