<?php
	// printVar(json_encode($organigrama, JSON_HEX_QUOT | JSON_HEX_TAG));exit;
	 // printVar($random); 
?>
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
	
.datos{
	margin-left: 94px;
	margin-top: -150px;	
	text-align: left;
	position: absolute;
	border-radius: 10px;
	padding: 11px;
	border: 1px solid #EDEDFB;
	background-color: #D2E0F2;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;
	-moz-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;	
	
}
.rcv{float:left; width:48%; margin-left:10px;}
@media screen and (max-width: 1000px) {
	.rcv{width:47%;}
}
@media screen and (max-width: 795px) {
	.rcv{width:100%;
	margin-left: 0px;
	}
}

	
</style>
 <script>
	jQuery(function(){
		jQuery("#empresa").change(function(){
			var valor=jQuery(this).val();
			if(valor!=""){
				jQuery("#form").find("[name='id']").val(valor);
				jQuery("#form").find("[name='option']").val("empresa");
				jQuery("#form").submit();
			}
 		});
		jQuery(".ver").click(function(){
			var valor=jQuery(this).attr("rel");
			jQuery("#form").find("[name='id']").val(jQuery("#empresa").val());
			jQuery("#form").find("[name='fecha']").val(valor);
			jQuery("#form").find("[name='option']").val("fecha"); 
			jQuery("#form").submit();
			
		});
	})
 </script>
<div id="content">
	<div style="clear:both" ></div> 
  
   <div class="divContentBlue">
		<!--h3><b><span id="r_titulo"></span></b></h3-->
		 
		<div class="divContentWhite">
			<!--div class="divContentBlue rcv"  >
				<div class="divContentWhite">
 					Encuesta
					<div style="clear:both"></div>
					<iframe  id="encuesta"  name="encuesta" src=""  style="width:96%;height:800px;border: none; overflow-y:scroll<? if($ides==NULL){echo "display:none";} ?>" ></iframe>
				</div>
			</div-->
			<?php echo CHtml::form(array("admin/unydos/diagnostico"), 'post', array('class'=>'fanexo' , 'id'=>'form')); ?>
				<input type="hidden" name="id" />
				<input type="hidden" name="fecha" />
				<input type="hidden" name="cluster" />
				<input type="hidden" name="sector" />
				<input type="hidden" name="option" />
			</form>

			<div class="divContentBlue"  > 
				<div class="divContentWhite">Diagnóstico
				 <br>
				<select id="empresa"><option>Seleccione una empresa</option>
					<?
 					 foreach($empresas as $data){$selected='';
						if(isset($_POST["id"])){
							if($_POST["id"]==$data->empresa){
								$selected=" selected='selected'";
							} 
 						} 
						echo "<option value='".$data->empresa."' ".$selected.">".$data->empresa."</option>";
					} 
				?>
				</select>
				 <br>
				 <?if(isset($_POST["option"])) { ?>
					<div class="divContentBlue"  > 
						 			 
					<? if($_POST["id"]!=""){  
						echo "<ul style='list-style:none'>";
 						foreach($empresa as $data){ 
							
							echo "<li ><input style='height:25px' type='button' class='ver' rel='".$data->id."' value='ver'> <b>Fecha de realización: ".$data->fecharegistro." </b></li>";
						} 
						echo "</ul>";
 					}?>	
					<? if(isset($_POST["fecha"]) and !empty($empresadatos)){ ?>
						<div class="divContentWhite">
						
						
							<style type="text/css">
							.tg  {border-collapse:collapse;border-spacing:0;}
							.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
							.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
							.tg .tg-u8hm{font-weight:bold;background-color:#ffffff;color:#00d2cb;vertical-align:top}
							.tg .tg-yw4l{vertical-align:top}
							</style>
							<table class="tg">
							  <tr>
								<th class="tg-u8hm">Fecha evaluación</th>
								<th class="tg-yw4l"><?=$empresadatos->fecharegistro?></th>
							  </tr>
							  <tr>
								<th class="tg-u8hm">Empresa</th>
								<th class="tg-yw4l"><?=$empresadatos->empresa?></th>
							  </tr>
							  <tr>
								<td class="tg-u8hm">Nit</td>
								<td class="tg-yw4l"><?=$empresadatos->nit?></td>
							  </tr>
							  <tr>
								<td class="tg-u8hm">Ciudad</td>
								<td class="tg-yw4l"><?=$empresadatos->ciudad?></td>
							  </tr>
							  <tr>
								<td class="tg-u8hm">Representante</td>
								<td class="tg-yw4l"><?=$empresadatos->representante?></td>
							  </tr>
							  <tr>
								<td class="tg-u8hm">Email de contacto</td>
								<td class="tg-yw4l"><?=$empresadatos->email?></td>
							  </tr>
							  <tr>
								<td class="tg-u8hm">Teléfono de contacto</td>
								<td class="tg-yw4l"><?=$empresadatos->telefono?></td>
							  </tr>
							  <tr>
								<td class="tg-u8hm">celular de contacto</td>
								<td class="tg-yw4l"><?=$empresadatos->celular?></td>
							  </tr>
							</table>						
 						<div style="clear:both"></div>
						</div>
					<?}?>
						<div style="clear:both"></div>
					</div>
				<? }?>
				<? if($token!=""){ ?>
				<iframe  id="pentaho"   name="pentaho" src="https://www.talentracking.co/node/304/?embed=1&token=<?=$token?>&paramempresa=<?=$empresadatos->empresa?>&paramfecharegistro=<?=$empresadatos->fecharegistro?>" style="width:100%;height:5500px;border: none; overflow-y:scroll<? if($ides==NULL){echo "display:none";} ?>" ></iframe>
 				<? }else if($tokenb!=""){?>
				<iframe  id="pentaho"   name="pentaho" src="https://www.talentracking.co/node/308/?embed=1&token=<?=$tokenb?>&cluster" style="width:100%;height:5500px;border: none; overflow-y:scroll<? if($ides==NULL){echo "display:none";} ?>" ></iframe>
				<?} ?>
				</div>
			</div>
			<div style="clear:both"></div> 
		</div>
		 
	</div>
	<div style="clear:both"></div>			 
</div>
