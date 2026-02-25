<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>  
<?
					$urls=Yii::app()->baseUrl."/files/pcos/".$url."/";

	?>
<style type="text/css"> 
	.navbar-default{
		z-index:999;
	}
   .messages{
        float: left;
        font-family: sans-serif;
        display: none;
    }
    .info{
        padding: 10px;
        border-radius: 10px;
        background: orange;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .before{
        padding: 10px;
        border-radius: 10px;
        background: blue;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .success{
        padding: 10px;
        border-radius: 10px;
        background: green;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .error{
        padding: 10px;
        border-radius: 10px;
        background: red;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
	
	
.custom-file-input {
		display: inline-block;
		position: relative;
		color: #533e00;
	}
	.custom-file-input input {
		visibility: hidden;
		width: 150px;
	}
	.custom-file-input:before {
		content: 'Choose File';
		display: block;
		background: -webkit-linear-gradient( -180deg, #ffdc73, #febf01);
		background: -o-linear-gradient( -180deg, #ffdc73, #febf01);
		background: -moz-linear-gradient( -180deg, #ffdc73, #febf01);
		background: linear-gradient( -180deg, #ffdc73, #febf01);
		border: 3px solid #dca602;
		border-radius: 10px;
		padding: 5px 0px;
		outline: none;
		white-space: nowrap;
		cursor: pointer;
		text-shadow: 1px 1px rgba(255,255,255,0.7);
		font-weight: bold;
		text-align: center;
		font-size: 10pt;
		position: absolute;
		left: 0;
		right: 0;
	}
	.custom-file-input:hover:before {
		border-color: #febf01;
	}
		.custom-file-input:active:before {
		background: #febf01;
	}
	.file-blue:before {
		content: 'Buscar archivo';
		background: -webkit-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: -o-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: -moz-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: linear-gradient( -180deg, #99dff5, #02b0e6);
		border-color: #57cff4;
		color: #FFF;
		text-shadow: 1px 1px rgba(000,000,000,0.5);
	}
	.file-blue:hover:before {
		border-color: #02b0e6;
	}
	.file-blue:active:before {
		background: #02b0e6;
	}	
	
	
</style>
 <script>
$(document).ready(function(){
 	 href();
	 <? if(!isset($_SESSION['loginID'])){?>
		jQuery(".maintitle").remove();
		jQuery(".footer").remove();
	 <? } ?>
	 jQuery("#anio").change(function(){
		 var ida=jQuery(this).val();
		 jQuery("#acciones").find("[name='anio']").val(ida);
		 jQuery("#acciones").submit(); 
	})
});
 
function href(){
	jQuery("[rel^='href_']").click(function(){
		var h=jQuery(this).attr("rel").split("_")[1];
		document.location="<?=Yii::app()->baseUrl?>/index.php/admin/pcos/"+h;
	});
	
}
</script>
<?php echo CHtml::form(array("admin/pcos/documentacion"), 'post', array('class'=>'acciones' , 'id'=>'acciones')); ?>
	<input type="hidden" name="anio" />
</form>  
<div id="content" style="padding:10px">
	<div class="col-xs-12  col-md-12">
		<div class="divContentBlue">
		<!--
		<? if($usuario->perfil==1 or $usuario->perfil==3 or $oRecord->uid==1){ ?>
		<input type="button" value="Gestores" style="float:left;" rel="href_gestores"/>
		<input type="button" value="Empresas" rel="href_empresas" style="float:left;margin-left:10px"/>
		<input type="button" value="Documentos" rel="href_documentos" style="float:left;margin-left:10px"/>
		<? }else if($usuario->perfil==6){?>
		<input type="button" value="Simulacro" style="float:left;" rel="href_simulacro"/>
		<input type="button" value="Auditoría Interna" rel="href_interno" style="float:left;margin-left:10px"/>
 		<?}else if($usuario->perfil==7){?>
		<input type="button" value="Simulacro" style="float:left;" rel="href_simulacro"/>
		<input type="button" value="Auditoría Externa" rel="href_externo" style="float:left;margin-left:10px"/>
 		<?} ?>
		-->  
		<div style="clear:both"></div>
		
		
		 <h3>Archivos disponibles</h3><div style="clear:both"></div>
			<div class="divContentWhite">
 				<div class="wpb_accordion_section group">
 						<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">
									<p>Descargue y revise los documentos básicos, los cuales ilustran sobre alcances y beneficios del programa. Luego diligencie el formulario de solicitud para recibir contraseña y tener acceso a los documentos de la guía de certificación.</p>
									<div style="clear:both" ></div>
									<b>Filtrar por año</b> <select id="anio"><option value="-1">Seleccione año...</option><option value="-1">Todos</option><? foreach($anio as $k=>$a){  ?>
									<option value="<?=$a?>"><?=$a?></option>
									<? } ?>
									</select><div style="clear:both" ></div><br>
									<ol>
 								<? foreach($archivos as $data){ 
									$ex=explode(".",$data->descriptcion);
								?>
								 <li>
  								<a href="<?=Yii::app()->baseUrl?>/files/pcos/documentos/<?=$data->descriptcion?>" target="_blanck"><span>
										<?=$data->nombre?></span></a> 
										</li>
								<? } ?>
								</ol>
 
							</div>
						</div>

 				</div>			
			
 			
 
				<div style="clear:both"></div>
			</div>
			 
			
			
			
			
			
			
		</div>
	</div>
 
</div>