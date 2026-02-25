 <link rel="stylesheet" href="/bateria/scripts/admin/colorbox/example1/colorbox.css" />
 <script src="/bateria/scripts/admin/colorbox/jquery.colorbox.js"></script>
<style type="text/css"> 
body{
	overflow-x:hidden
}
#content-box{
	width:940px;
}
#tableContent{
    border:1px solid #CCCCCC;
    border-collapse:collapse;
	font-size:11px;
}
#tableContent th {
    border:1px solid #CCCCCC;
    font-size:11px;
}

#tableContent td {
    border:1px solid #CCCCCC;
    font-size:11px;
}
.ventanaBodyError {
color: #990000;
border: solid 1px #4F0000;
padding: 5px;
background-color: #FFF0E1;
}
	.divGood {
	background-color: #E2FFDF;
	border: 1px solid #085500;
	padding: 5px;
	text-align: center;
	}
</style> 
  <div id="content">
<div class="divContentBlue">
 <div style="width:100%">
		<div style="float: left">
			<h2><b>Bienvenid<? if($usuario->genero=="Masculino"){echo "o";}else{echo "a";}?> <?=$usuario->nombres?></b></h2>	
		 <div style="clear:both"></div>
		</div>
		<div style="float: right">
			<a href="/bateria/index.php/admin/authentication/sa/logout" >
				<img src="/bateria/styles/darkblue/images/logout.png">
			</a>
		</div>
		<div style="float: right;    margin-right: 11px;   margin-top: 1px;">
			<img src="/bateria/img/ayuda.png" width="30" style="cursor:pointer" rel="ayuda" />	
		</div>
 </div>
 
 
 
 
 <div style="clear:both"></div>
		<div class="divContentWhite">
		
<div class="divContentBlue"><div class="divContentWhite">
	<? if($fi!="" and $ff!=""){ ?>
	<h3><center>Lo sentimos, esta encuesta está programada para <?=$fi?> y cierra <?=$ff?>. Esta sesión cerrará automáticamente</center></h3>
	<? }else{?>
	<h3><center>Lo sentimos, usted no tiene encuestas programadas. Esta sesión cerrará automáticamente.</center></h3>
	<?} ?>
 </div>		
</div> 
</div> 
<script>
	jQuery(function(){
		setTimeout(function(){
			document.location="/bateria/index.php/admin/authentication/sa/logout";
		},10000);
 	});
	</script>
  

 
 
 
 
 
 
 
 
 
 </div>
 </div>
 <div style="clear:both"></div>
