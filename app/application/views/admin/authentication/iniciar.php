 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<script>
/*
			  grecaptcha.ready(function() {
				  grecaptcha.execute();
			  });

*/
var acciones={
	recuperar:function(){
		jQuery("[rel='recuperar']").off();
		jQuery("[rel='recuperar']").on("click",function(){
			var html='<div class="panel-body">';
 			html+='<fieldset>';
			html+='<div class="form-group">';
				html+='<input class="form-control" placeholder="<?=$idioma->accesousuario?>"  value="'+jQuery("[name='user']").val()+'" name="user" type="user" autofocus>';
			html+='</div>';
			html+='<div class="form-group"  id="error" style="display:none">';
				html+='<?=$idioma->emailnovalido?>';
			html+='</div>';
			html+='<input class="btn btn-lg btn-success btn-block" type="button" name="login_submit" value="<?=$idioma->recuperarpassword?>" pb-role="submit">';
 			html+='</fieldset>';
			html+='</div><br><br><br><br>';
			jQuery.colorbox({html:html,width:400});
			acciones.enviarclave();
			
			
		});
		jQuery("#colorbox").find("#cerrar").off();
		jQuery("#colorbox").find("#cerrar").on("click",function(){
			jQuery.colorbox.close();
		});
		
	},
	validaremail:function(){
		 
		var vemail = jQuery("#colorbox").find("[name='user']").val();

		var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		//Se muestra un texto a modo de ejemplo, luego va a ser un icono
		var estado=false;
		if (emailRegex.test(vemail)) {
			jQuery("#colorbox").find("#error").hide();
			estado=true;
		} else {
		 jQuery("#colorbox").find("#error").show();
		 estado=false;
		}
		return estado;
	},
	enviarclave:function(){
		jQuery("#colorbox").find("[name='login_submit']").off();
		jQuery("#colorbox").find("[name='login_submit']").on("click",function(){
			if(acciones.validaremail()){
				var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/recuperar",
						data:{email:jQuery("#colorbox").find("[name='user']").val(),hashcontrol:"<?=$_GET["token"]?>"},
						success:function(res){
							if(res[0]=="ok"){
								var html='<div class="panel-body">';
								html+='<fieldset>';
 
								html+='<div class="form-group"   >';
									html+='<?=$idioma->confirmacionenvio?>';
								html+='</div>';
								html+='<input class="btn btn-lg btn-success btn-block" type="button" id="cerrar" value="<?=$idioma->cerrar?>" pb-role="submit">';
								html+='</fieldset>';
								html+='</div><br><br><br><br>';
								jQuery.colorbox({html:html,width:400});								
 							}
							if(res[0]=="no"){
								var html='<div class="panel-body">';
								html+='<fieldset>';
 
								html+='<div class="form-group"   >';
									html+='<?=$idioma->noenvio?>';
								html+='</div>';
								html+='<input class="btn btn-lg btn-success btn-block" type="button" id="cerrar" value="<?=$idioma->cerrar?>" pb-role="submit">';
								html+='</fieldset>';
								html+='</div><br><br><br><br>';
								jQuery.colorbox({html:html,width:400});								
 							}
							if(res[0]=="noexiste"){
								var html='<div class="panel-body">';
								html+='<fieldset>';
 
								html+='<div class="form-group"   >';
									html+='<?=$idioma->noexiste?>';
								html+='</div>';
								html+='<input class="btn btn-lg btn-success btn-block" type="button" id="cerrar" value="<?=$idioma->cerrar?>" pb-role="submit">';
								html+='</fieldset>';
								html+='</div><br><br><br><br>';
								jQuery.colorbox({html:html,width:400});								
 							}
							if(res[0]=="urlnovalida"){
								var html='<div class="panel-body">';
								html+='<fieldset>';
 
								html+='<div class="form-group"   >';
									html+='<?=$idioma->urlnovalida?>';
								html+='</div>';
								html+='<input class="btn btn-lg btn-success btn-block" type="button" id="cerrar" value="<?=$idioma->cerrar?>" pb-role="submit">';
								html+='</fieldset>';
								html+='</div><br><br><br><br>';
								jQuery.colorbox({html:html,width:400});								
 							}
							acciones.recuperar();
						}
					});
			}
			
			
		});
		
	}
}
jQuery(function(){
	acciones.recuperar();
	document.cookie = "key=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "nombre=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "tipoproyecto=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "bienvenida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
})

</script> 

<center>  
  <div class="container" >
        <div class="row" id="titulo">
			<img src="<?=Yii::app()->baseUrl?>/images/360evolution.png" style="width:80%; float:right" />
			<strong id="subtitle"><?=$idioma->administracion?></strong> 
        </div>
        <div class="row">
            <div class="col-md-5 ">
                <div class="login-panel panel panel-default">
                     
                    <div class="panel-body">
                       <?php echo CHtml::form(array('admin/authentication/sa/login'), 'post', array('id'=>'loginform', 'name'=>'loginform',"autocomplete"=>"off"));?>

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?=$idioma->accesousuario?>" name="user" type="user" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?=$idioma->password?>" name="password" type="password" value="">
                                </div>
								<!--
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label> width
                                </div-->
                                <!-- Change this to a button or input when using this as a form -->
								<input class="btn btn-lg btn-success btn-block" type="submit" name="login_submit" value="<?=$idioma->acceder?>" pb-role="submit">
								
								<br>
								 <div class="form-group"> <span rel="recuperar" style="cursor:pointer"><?=$idioma->recuperarpassword?></span></div>
 								<div class="form-group">¿Interesado en usar nuestra plataforma?</div>
								 <div class="form-group">Contactenos a <a href="mailto:info@360evolution.net">info@360evolution.net</a></div>
                             </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</center>	
	
<style>
#titulo strong{
	font-size:37px;
	margin-top:-65px;
	margin-right:52px;
	float:right;
	color:#000;
}
.container{
	width:800px;
	margin-top:45px;
	border:1px solid #eee;
	border-radius:20px;
	padding:50px;
}
.login-panel{margin-top:5px;}
.form-group{
	text-align:left;
	font-size:12px;
	}
.btn-success{background-color:#337ab7;border-color:#337ab7;}
.btn-success:hover{background-color:#337ab7;border-color:#337ab7;}
.panel-default{border-color:#fff;box-shadow:none;}
fieldset{border-color:#fff;}
html, body{height:95% !important;}
.footer{display:none;}
.push{display:none;}

 .form-control{ background-color:#fff !important;}

@media only screen and (max-width:992px) {
 
   .col-md-5 {
	  width:45%;
    }
	input{ width:100% !important;}
 
}
@media only screen and (max-width:934px) {
 
  .limebutton{
	  display:block !important;
    }
 
}
@media only screen and (max-width:836px) {
 
 .container{
	  width:90%;
    }
.col-md-5 {
	  width:60%;
    }
 
}
@media only screen and (max-width:730px) {
 
 .container{
	  width:95%;
    }
.col-md-5 {
	  width:70%;
    }
 
}
@media only screen and (max-width:688px) {
 
 
	#titulo img{
		width:100% !important;
	}
 
}
@media only screen and (max-width:600px) {
 
 
	#titulo .subtitle{
		font-size:28px;
		margin-top:-49px;
	}
 
}
@media only screen and (max-width:527px) {
 
 
	#titulo strong{
		font-size:26px !important;
		margin-top:-45px !important;
	}
	
	.container{
	  width:98%;
	}
	.col-md-5 {
	  width:90%;
	}
}
@media only screen and (max-width:527px) {
	#titulo strong{
		font-size:18px !important;
		margin-top:-38px !important;
		margin-right:29px !important;
	}
	
 	.container{
	  width:99%;
	  padding:10px;
	}
	.col-md-5 {
	  width:99%;
	}
}
body{
	background-color:#fff !important;
}
</style>
	