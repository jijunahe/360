<? //printVar(Permission::model()->hasGlobalPermission('superadmin','read'));?>
<?  
	$permisos=Permission::model()->getPermissions((int)Yii::app()->user->id);
	$totalPermisos=count($permisos);
 ?>
 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
 

<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
 
<div style="clear:both"></div>
 
 
 
  