<?php /* Smarty version 2.6.6, created on 2012-10-18 00:37:11
         compiled from master.html */ ?>
<!DOCTYPE>
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="css/style.css">
<link type="text/css" rel="stylesheet" href="css/colorbox.css">
<link type="text/css" rel="stylesheet" href="css/jquery-ui/jquery-ui-1.8.23.custom.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>

<!--[if lt IE 10]>
<script type="text/javascript" src="js/PIE.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="js/selectivizr.js"></script>
<![endif]-->
	
</head>

<body>  
  <!--preload de la pagina-->
  <div id="loader" class="border5">
    <div class="img_preload" align="center"><img src="images/loading.gif" alt="" width="50" height="50"></div>
  </div> 
  
  <?php if ($this->_tpl_vars['fileView'] == 'login'): ?>
  	
	<div id="contenedor">
	<?php echo $this->_tpl_vars['fileInclude']; ?>

	</div>
	
  <?php else: ?>  
  <!--preload de la pagina -->
  <div class="header">
  	<?php echo $this->_tpl_vars['header']; ?>
  	
  </div>
  <div class="contenido">
  	<!--Menu Izquierda-->
    <div class="menuLeft left">
  		<?php echo $this->_tpl_vars['menuLeft']; ?>

    </div>
    <div class="sombra1"></div>
    <!--Contenido-->
    <div class="seccion left"> 
    	<div class="left titleSeccion" style="background:#DDDDDD; margin:0 0 5px 0;">
            <h3 style="margin:0; padding:5px;">Seccion: <span style="font-weight:normal;"><?php echo $this->_tpl_vars['seccion']; ?>
</span></h3>
        </div>   	
		<?php echo $this->_tpl_vars['fileInclude']; ?>

    </div>
  </div>
  <div class="footer"></div>
  <?php endif; ?>   
  
</body>
</html>