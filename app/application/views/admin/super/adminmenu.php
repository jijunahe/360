<? //printVar(Permission::model()->hasGlobalPermission('superadmin','read'));?>
<?  
	$permisos=Permission::model()->getPermissions((int)$_SESSION["loginID"]);
	$totalPermisos=count($permisos);
 ?>
 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
 
 

<div class='menubar'>
	
 
</div>
<div style="clear:both"></div>
 
<div class="contentmenu">
 	
</div>




 
<div style="clear:both"></div>
<p style='margin:0;font-size:1px;line-height:1px;height:1px;'>&nbsp;</p>
