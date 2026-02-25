   <style>
.ventanaBodyError {
color: #990000;
border: solid 1px #4F0000;
padding: 3px;
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
		<div class="divContentWhite">
				<? if($msg!="existe") { ?>
				 <h2><?=$msg?></h2>
				<? }else{?>
					<h2>El usuario ya existe, haga click <b><a>Aquí</a></b> para recuperar su acceso</h2>
 				<?} ?>
		</div>
	</div>
</div>
