 <? if($error!=""){ ?>
	<center><h1><b><?=$error?></b> </h1></center>
	<? } 
	
	?>
	<style>
#contentlogin{
	z-index:999;
	position:relative
 }
 div.messagebox {
    width: 244px !important; 
 	float: right !important;
	margin: 37px 179px !important; 
    background-color: #FFF !important;
	
}
#s2id_loginlang{
	
	display:none;
}
@media (max-width: 1080px) {
	div.messagebox{
		margin: 40px auto !important;
		float: none;
		z-index:999;
		width: 100%!important;
		padding:10px !important;
	}
	#imgsalud{
		display:none;
	}
}
	</style>
<?php echo CHtml::form(array('admin/authentication/sa/login'), 'post', array('id'=>'loginform', 'name'=>'loginform',"autocomplete"=>"off"));?>
    <div class='messagebox ui-corner-all' class="contentlogin">
		<center>
			<img src="<?=Yii::app()->baseUrl?>/styles/darkblue/images/tracking.png"/>
			<div class="x_login">
				<div class='header ui-widget-header'><?php echo $summary; ?></div>
				<br />
				<ul style='  margin-left: auto; margin-right: auto' class="acceso">
					<?php 
					$pluginNames = array_keys($pluginContent);
					if (!isset($defaultAuth)) {
						// Make sure we have a default auth, if not set, use the first one we find
						$defaultAuth = reset($pluginNames);
					}
					if (count($pluginContent)>1) {
						$selectedAuth = App()->getRequest()->getParam('authMethod', $defaultAuth);
						if (!in_array($selectedAuth, $pluginNames)) {
							$selectedAuth = $defaultAuth;
						}
				  ?><li><label for='authMethod'><?php $clang->eT("Authentication method"); ?></label><?php
						$possibleAuthMethods = array();
						foreach($pluginNames as $plugin) {
							$info = App()->getPluginManager()->getPluginInfo($plugin);
							$possibleAuthMethods[$plugin] = $info['pluginName'];
						}
						$this->widget('bootstrap.widgets.TbSelect2', array(
							'name' => 'authMethod',
							'value' => $selectedAuth,
							'data' => $possibleAuthMethods,
							'options' => array(
								'onChange'=>'this.form.submit();'
							)
						));
					} else {
						echo CHtml::hiddenField('authMethod', $defaultAuth);
						$selectedAuth = $defaultAuth;
					}
				  ?></li><?php
					if (isset($pluginContent[$selectedAuth])) {
						$blockData = $pluginContent[$selectedAuth];
						/* @var $blockData PluginEventContent */
						echo $blockData->getContent();
					}

					$languageData = array(
						'default' => gT('Default')
					);
					foreach (getLanguageDataRestricted(true) as $sLangKey => $aLanguage)
					{
						$languageData[$sLangKey] =  html_entity_decode($aLanguage['nativedescription'], ENT_NOQUOTES, 'UTF-8') . " - " . $aLanguage['description'];
					}
					echo CHtml::openTag('li');
				   echo CHtml::label(gT('Language'), 'loginlang');
					$this->widget('bootstrap.widgets.TbSelect2', array(
						'name' => 'loginlang',
						'data' => $languageData,
						'options' => array(
							'width' => '230px'
						),
						'htmlOptions' => array(
							'id' => 'loginlang'
						),
						'value' => 'default'
					));
					echo CHtml::closeTag('li');
					
					?>
				</ul>
				<p><input type='hidden' name='action' value='login' />
					<input class='action' type='submit' name='login_submit' value='<?php $clang->eT("Login"); ?>' /><br />
					<br/>
					<?php
					if (Yii::app()->getConfig("display_user_password_in_email") === true)
					{
						?>
						<a href='<?php echo $this->createUrl("admin/authentication/sa/recuperar"); ?>'><?php $clang->eT("Forgot your password?"); ?></a><br />
						<?php
					}
					?>
				</p>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div><br><br>
			<table><tr><td><div style="width: 128px;">¿No eres cliente?</div></td><td><div id="linkw" style="color:#21618E;font-weight: bold;cursor:pointer;padding:4px;border: 2px solid; border-radius: 4px;    border-color: gainsboro; width: 128px;">Solicite un demo</div></td></tr></table>
		</center>
     </div>
<?php echo CHtml::endForm(); ?>
<script type='text/javascript'>
    document.getElementById('user').focus();
	<? if(isset($_GET["token"])){ ?>
	jQuery(function(){
		 jQuery("#loginform").hide();
		 jQuery("#user").attr("type","hidden");
		 jQuery("#password").attr("type","hidden");
		jQuery("#user").val("<?=$us?>");
		jQuery("#password").val("<?=$pw?>");
	//	jQuery("#loginform").submit();
		<? if($us!="" and $pw!=""){ ?>
		jQuery("[name='login_submit']").click();
		<? } ?>
		
		 
	});
	<? } ?>
	jQuery(function(){
 		jQuery("li").find("label").hide();
		jQuery(".footer").remove();
		jQuery(".maintitle").remove();
		var lis=jQuery(".acceso").find("li");
		console.log(lis);
		jQuery.each(lis,function(k,d){
			var texto=jQuery(d).find("label").text();
			var element=jQuery(d);
			var icon="";
			if(texto=="Nombre de usuario"){
				icon="user";
				element.find("input").attr({"placeholder":texto,"autocomplete":"off","style":"background: #ffffff url('<?=Yii::app()->baseUrl?>/styles/darkblue/images/"+icon+".png') 98% 50% no-repeat;"});

			}else	if(texto=="Contraseña"){
				icon="lock";
				element.find("input").attr({"placeholder":texto,"autocomplete":"off","style":"background: #ffffff url('<?=Yii::app()->baseUrl?>/styles/darkblue/images/"+icon+".png') 98% 50% no-repeat;"});

			}else{
				element.find("input").attr({"placeholder":texto,"autocomplete":"off"});
			
			}
			
 		});
		var h=jQuery("body").height();
		var imagen="<?=Yii::app()->baseUrl?>/styles/darkblue/images/land2.png";
		var obimg='<img id="imgsalud"  src="'+imagen+'" style="width:60%;height:'+h+'px;position:absolute;z-index:200" />';
		//jQuery(".wrapper").prepend(jQuery(obimg));
 		//jQuery(".wrapper").attr("style","background: url(<?=Yii::app()->baseUrl?>/styles/darkblue/images/land.png) top left no-repeat !important;height:"+(h)+"px; ");
 		//jQuery(".wrapper").attr("style","background-im: #fff !important;height:"+(h)+"px; ");
		jQuery("#linkw").click(function(){
			document.location="http://www.talentrackingpro.com";
 		});
	
	});
</script>
