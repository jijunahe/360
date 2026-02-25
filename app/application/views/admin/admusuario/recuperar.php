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
<script>
	$.validator.setDefaults({
		submitHandler: function() {
			var url=$("#formCrear").attr("action");
			var objdata=$("#formCrear").serialize();
			 
 			jQuery.ajax({ 
			type: "POST",
			dataType: "json",
 			url: url,
			data:objdata,
			success:function(res){
				jQuery("input[type='text']").val("");
				jQuery("input[type='number']").val("");
				jQuery("input[type='password']").val("");
				jQuery("input[type='email']").val("");
 				if(res[0]=="OK"){
					jQuery.colorbox({html:"<h3>Los datos de acceso se han enviado al email registrado</h3>"});
				}else{
					jQuery.colorbox({html:"<h3>"+res[0]+"</h3>"});
				}
				setTimeout(function(){document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/authentication/sa/login";},3000);
 			}});
		}
	});
	$().ready(function() {
		// validate the comment form when it is submitted
 
		// validate signup form on keyup and submit
		$("#formCrear").validate({
			rules: {
   				documento: {
 					required: true,
					minlength: 4
				} 
			},
			messages: {
  				documento: "Por favor ingrese el documento de identidad",
			}
		});
		
 
		jQuery("[rel='volver']").click(function(){
			document.location="<?=$_SERVER["SCRIPT_NAME"]?>/admin/authentication/sa/login";
		});
 
 
	});
</script>

<?
	$htmlModulos='<ul>';
	foreach($modulos as $data){
		$htmlModulos.='<li><label><input type="checkbox" name="modulo" value="'.$data->id.'" rel="'.$data->proyecto.'" />'.$data->proyecto.'</label></li>';
 	}
	$htmlModulos.='</ul>';
?>

<link href="<?=Yii::app()->baseUrl?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=Yii::app()->baseUrl?>/css/owl.carousel.css" rel="stylesheet">
<link href="<?=Yii::app()->baseUrl?>/css/owl.theme.css" rel="stylesheet">
<link href="<?=Yii::app()->baseUrl?>/css/magnific-popup.css" rel="stylesheet">
<link href="<?=Yii::app()->baseUrl?>/css/style.css" rel="stylesheet">
<link href="<?=Yii::app()->baseUrl?>/css/responsive.css" rel="stylesheet">














<style>
	.maintitle{display:none;}
	.footer{display:none;}
	
	
	
	
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
	/*background-color:#FFF;*/
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

body, html {overflow:hidden !important;}
	
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
	div.x_login{background:none;}
  </style>	
  
  
    <!--fonts google-->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>


<!--PRELOADER-->
<div id="preloader">
  <div id="status">
	  <img alt="logo" src="<?=Yii::app()->baseUrl?>/images/corazones-saludables.png">
  </div>
</div>



<!--/.PRELOADER END-->
    <!--HEADER -->
    <div class="header">
    </div>
    <!--/.HEADER END-->

<!--CONTENT WRAP-->
    <div class="content-wrap">
      <!--CONTENT--> 
      <div class="content">
        <!--HOME-->
        <section id="home">
          <div class="container">
            <div class="row">
              <div class="wrap-hero-content">
                  <div class="hero-content">
                    <h1>Registro</h1>
                     <span class="typed">
						
 						<div id="content"  >
						
						
						
											
											
								<?php echo CHtml::form(array("admin/authentication/sa/recuperar"), 'post', array('class'=>'formCrear' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;')); ?>
									<input type="hidden" name="recuperar" />
									<h3>Por favor ingrese su documento de identidad o email.</h3> <input type="text" name="documento" /> <input type="submit" value="Enviar" /> <input type="button" value="Volver" id="volver" />
								</form>						
											 
					 
 
 
							
						</div>						
						
  					</span>
                  </div>
              </div>
            </div>
          </div>
        </section>
        <!--/.HOME END-->       
        <!--FOOTER-->
        <!--/.FOOTER-END-->

      <!--/.CONTENT END-->
      </div>
    <!--/.CONTENT-WRAP END-->
    </div>
 	   
 

     <script src="<?=Yii::app()->baseUrl?>/js/bootstrap.min.js" type="text/javascript"></script>
     <script src="<?=Yii::app()->baseUrl?>/js/main.js" type="text/javascript"></script>

  	   
	   
<script>
jQuery(function(){


	 jQuery(".maintitle").remove();
	 jQuery(".footer").remove();
 	jQuery("#volver").click(function(){
		
		document.location="<?=Yii::app()->baseUrl?>/admin/";
	
	});

});
 
</script>

 








 
