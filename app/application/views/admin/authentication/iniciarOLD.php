 <? if($error!=""){ ?>
	<center><h1><b><?=$error?></b> </h1></center>
	<? } 
	
	?>
	<style>
.iniimage{
	
	width: 100%;
	height: auto;
	background-repeat: no-repeat;        
	position: relative;
}
#contentlogin{
	z-index:999;
	position:relative
 }
 div.messagebox {
    width: 570px !important; 
     background-color: #FFF !important;
	
}
.x_login{
	float:left;
}
#gestores{
	float:left;
	margin-left:0.7em;
	width:250px;
	height:254px;
	background-color:#FFF;
	overflow-x:hidden;
	overflow-y:visible;
	
}
#con{padding:0.7em}
#gestores img{
	width:75%;
	
}
#empresas{
	padding-top: 0.9em;
	float:left;
	margin-top:0.4em;
	width:509px;
	height:120px;
	background-color:#FFF;

}

#s2id_loginlang{
	
	display:none;
}
@media (max-width: 1080px) {
	div.messagebox{
		margin: 1em auto !important;
		float: none;
		z-index:999;
		width: 100%!important;
		padding:10px !important;
	}
	#imgsalud{
		display:none;
	}
}
@media (max-width: 584px) {
	body{
	 padding-top:0px;
	}
	#gestores{
  		margin-left:0px;
		margin-top:0.4em;
 		width:100%;
		height:100px;
		overflow-x: visible;
		overflow-y: hidden;
		padding:10px;
	}
	#con{padding:0px;}
	#gestores img{
		width: 23%;
		float: left;
		margin-left: 0.5em;
	}	
	
	
	.x_login{
		width:100%
	}
	#empresas{
		width:100%

	}
	#loginform input[type='text'], #loginform input[type='password'], #loginform select{
		width:100%
	}
}



	</style>
 <!-- SlidesJS Optional: If you'd like to use this design -->
  <style>
     

    #slides {
      display: none
    }

    #slides .slidesjs-navigation {
      margin-top:5px;
	  display:none;
     }

    a.slidesjs-next,
    a.slidesjs-previous,
    a.slidesjs-play,
    a.slidesjs-stop {
      background-image: url(<?=Yii::app()->baseUrl?>/scripts/slider/examples/playing/img/btns-next-prev.png);
      background-repeat: no-repeat;
      display:block;
      width:12px;
      height:18px;
      overflow: hidden;
      text-indent: -9999px;
      float: left;
      margin-right:5px;
    }

    a.slidesjs-next {
      margin-right:10px;
      background-position: -12px 0;
    }

    a:hover.slidesjs-next {
      background-position: -12px -18px;
    }

    a.slidesjs-previous {
      background-position: 0 0;
    }

    a:hover.slidesjs-previous {
      background-position: 0 -18px;
    }

    a.slidesjs-play {
      width:15px;
      background-position: -25px 0;
    }

    a:hover.slidesjs-play {
      background-position: -25px -18px;
    }

    a.slidesjs-stop {
      width:18px;
      background-position: -41px 0;
    }

    a:hover.slidesjs-stop {
      background-position: -41px -18px;
    }

    .slidesjs-pagination {
      margin: 7px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
      background-image: url(<?=Yii::app()->baseUrl?>/scripts/slider/examples/playing/img/pagination.png);
      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: hidden
    }
  </style>
  <!-- End SlidesJS Optional-->

  <!-- SlidesJS Required: These styles are required if you'd like a responsive slideshow -->
  <style>
  li{clear:none !important;}
    #slides {
      display: none
	  }
	.slidesjs-pagination{display:none}
	.slidesjs-navigation{display:none}
    .container {
      margin: 0 auto;
	  width:520px;
	  padding:0px !important;
    }
	.slidesjs-slide img{
		float:left;
		margin-left: 0.5em;
		width: 23%;
		height:100px;
	
	}

    /* For tablets & smart phones */
    @media (max-width: 767px) {
      body {
        padding-left: 20px;
        padding-right: 20px;
      }
      .container {
        width: auto
      }
    }

    /* For smartphones */
    @media (max-width: 480px) {
      .container {
        width: auto
      }
    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
     /* .container {
        width: 724px
      }*/
    }

    /* For larger displays */
    @media (min-width: 1200px) {
      /*.container {
        width: 1170px
      }*/
    }
  </style>	
	
	
<?php echo CHtml::form(array('admin/authentication/sa/login'), 'post', array('id'=>'loginform', 'name'=>'loginform',"autocomplete"=>"off"));?>
    <div class='messagebox ui-corner-all' class="contentlogin">
		<center>
 			<div class="x_login">
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
						<a href='<?php echo $this->createUrl("admin/authentication/registrar"); ?>'>Registrar empresa</a><br />
				</p>
			<div style="clear:both"></div>
		</div>
		<div id="gestores" >
			<div id="con" >
				<?
				foreach($logoges as $data){ ?>
 					<img src="<?=Yii::app()->baseUrl?>/files/pcos/gestores/<?=$data->descriptcion?>"  alt="<?=$data->nombre?>">
 				<? 
				} 
				?><div style="clear:both"></div>			
			</div>
		</div>
		<!--	<div style="clear:both"></div>
		<div id="empresas">
 			  <div class="container">
				<div id="slides">
					<? 
					$totales=count($logemp);
 					$i=1;
					$j=0;
					foreach($logemp as $data){ ?>
						<? if($i==1){ ?>
							<div>
						<? }   ?>
						  <img src="<?=Yii::app()->baseUrl?>/files/pcos/empresas/<?=$data->descriptcion?>"  alt="<?=$data->nombre?>">
						  
						  <?  if($i==4 or $j==$totales){ ?>
							</div>
						<? $i=0; }$i++; ?>
					<? $j++;} ?>
					 
			   </div>
			   </div>		
 		</div>-->
		<div style="clear:both"></div>
  		</center>
     </div>
	 		<img class="iniimage" src="<?=Yii::app()->baseUrl?>/images/ini.jpg" />

  <script src="<?=Yii::app()->baseUrl?>/scripts/slider/examples/playing/js/jquery.slides.min.js"></script>

<!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
 
<script>
    $(function() {
		$('#slides').slidesjs({
        width: 570,
        height: 100,
        play: {
		<? 
		if($totales>4){?> 
			active: true,
			auto: true,
			interval:4000,
		<? 
		} 
		else{?>
			active: false,
			auto: false,
		<? 
		}?>
			swap: false
        }
      });
	  <? if($totales<=4){?> 
		jQuery('#slides').find(".slidesjs-slide").css({'left': '0px'});
	   <? } ?>
    });
  </script>

  <!-- End SlidesJS Required -->  
  
  
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
  		//jQuery(".wrapper").attr("style","background: url(<?=Yii::app()->baseUrl?>/styles/darkblue/images/land.png) top left no-repeat !important;height:"+(h)+"px; ");
 		//jQuery(".wrapper").attr("style","background-im: #fff !important;height:"+(h)+"px; ");
		jQuery("#linkw").click(function(){
			document.location="http://www.talentrackingpro.com";
 		});
	
	});
</script>
