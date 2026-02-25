<!DOCTYPE html>
<html lang="<?php echo $adminlang; ?>"<?php echo $languageRTL;?>>
<head>
<link rel="apple-touch-icon" sizes="57x57" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=Yii::app()->baseUrl?>/images/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=Yii::app()->baseUrl?>/images/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=Yii::app()->baseUrl?>/images/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?=Yii::app()->baseUrl?>/images/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=Yii::app()->baseUrl?>/images/icon/favicon-16x16.png">
<link rel="manifest" href="<?=Yii::app()->baseUrl?>/images/icon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?=Yii::app()->baseUrl?>/images/icon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">	
	 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">	
	
	
	
	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->
	 <script src="<?=Yii::app()->baseUrl?>/scripts/bootstrap2018/vendor/jquery/jquery.min.js"></script>
	
	
	
	
     <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <?php 
	
        App()->getClientScript()->registerPackage('jqueryui');
        App()->getClientScript()->registerPackage('jquery-cookie');
        App()->getClientScript()->registerPackage('jquery-superfish');
        App()->getClientScript()->registerPackage('qTip2');
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('adminstyleurl') . "jquery-ui/jquery-ui.css" );
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('adminstyleurl') . "superfish.css" );
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('publicstyleurl') . 'jquery.multiselect.css');
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('publicstyleurl') . 'jquery.multiselect.filter.css');
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('adminstyleurl') .  "displayParticipants.css");
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('styleurl') . "adminstyle.css" );
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('adminstyleurl') . "adminstyle.css" );
        App()->getClientScript()->registerCssFile(Yii::app()->getConfig('adminstyleurl') . "printablestyle.css", 'print');
    ?>
	
	
	
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->	
	
	
	
	
	
	
	
	
	 <title>360Evolution</title>
	
 	
   
    <!--link rel="shortcut icon" href="<?php echo $baseurl;?>styles/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo $baseurl;?>styles/favicon.ico" type="image/x-icon" /-->
	<!--link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /-->

    <?php echo $firebug ?>
    <?php $this->widget('ext.LimeScript.LimeScript'); ?>
    <?php $this->widget('ext.LimeDebug.LimeDebug'); ?>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">	 
	<style>
	.loading{
	position: fixed;
    width: 100%;
    height: 120%;	
    background: rgba(0,0,0,0.7);
	z-index: 999999;
    overflow: hidden;
	display:none;
	    margin-top: -23px;
}
.g-loading{
	margin-top:60px;
}
#contenedorbr{
		height:auto !important;
	}
#botones .col-xs-2{
	padding-top:0px !important;
}
#botones .col-xs-10{
	padding-left:35px !important;
}
 
body{background-color:#f8f8f8;}
#botones .huge{text-align:left;font-size:22px !important;}
#tablero{padding:0;}
#tablero .col-xs-2{padding:0;margin-left:5px;}
#tablero .col-xs-10{padding-left:18px !important; width:62% !important;}
 #contenedor360{
	   width:98%;
	   margin:0 auto;
}
 
@media only screen and (min-width:1200px) {
 
   #contenedor360{
	   width:1200px !important;
    }
	#botones .huge{text-align:left;font-size:22px !important;}
	
 #menu360 li img{width:78px !important;}
 
}
@media only screen and (max-width:1200px) {
	#contenedor360{
	   width:100% !important;
    }
	#contenedorbr .col-lg-7{ width:49% !important; float: left !important;}
	#contenedorbr .col-lg-5{ width:49% !important; float: left !important;}
	#contenedorbr .col-lg-8{ width:30% !important; float: left !important;}
	#contenedorbr .col-lg-3{ width:30% !important; float: left !important;}
	#contenedorbr .col-lg-9{ width:30% !important; float: left !important;}
	#contenedorbr .col-lg-12 { width:100% !important; clear: both !important;}
	#contenedorbr .col-lg-6 { width:50% !important;  float: left !important;}
	#menu360 li img{width:74px !important;}
 
}
@media only screen and (max-width:1172px) {
	#contenedor360{
	   width:100% !important;
    }
	#contenedorbr .col-lg-7{ width:49% !important; float: left !important;}
	#contenedorbr .col-lg-5{ width:49% !important; float: left !important;}
	#menu360 li img{width:70px !important;}
 
}     

@media only screen and (max-width:1137px) {
	#contenedor360{
	   width:100% !important;
    }
	#contenedorbr .col-lg-7{ width:49% !important; float: left !important;}
	#contenedorbr .col-lg-5{ width:49% !important; float: left !important;}
	#menu360 li img{width:65px !important;}
 
}     

@media only screen and (max-width:1087px) {
	#contenedor360{
	   width:100% !important;
    }
	#contenedorbr .col-lg-7{ width:49% !important; float: left !important;}
	#contenedorbr .col-lg-5{ width:49% !important; float: left !important;}
	#menu360 li img{width:55px !important;}
 
}     

@media only screen and (max-width:1000px) {
	#contenedor360{
	   width:100% !important;
    }
	#contenedorbr .col-lg-7{ width:49% !important; float: left !important;}
	#contenedorbr .col-lg-5{ width:49% !important; float: left !important;}
	#menu360 li img{width:50px !important;}
 
}     

 
@media only screen and (max-width:1501px) {
 
   #botones  .col-xs-10{
 	   width:50% !important;
    }
 
   #botones  .col-xs-10 .huge{
	   font-size:28px !important;;
    }
 
}
@media only screen and (max-width:1459px) {
 
  #botones .row .huge{
	   font-size:30px  !important;
   }
  #botones .col-lg-3{
	  width:25%;
    } 
#botones  .row .huge{
	   font-size:22px  !important;
   }


}
@media only screen and (max-width:1392px) {
 
   #botones  .row .huge{
	   font-size:28px;
   }
 
}

@media only screen and (max-width:1386px) {
 
    #botones  .col-xs-10 .huge{
	   font-size:25px !important;;
    }
 
}

@media only screen and (max-width:1328px) {
 
    #botones  .col-xs-10 .huge{
	   font-size:22px !important;;
    }
 
}

@media only screen and (max-width:1264px) {
 
    #botones  .col-xs-10 .huge{
	   font-size:20px !important;;
    }
 
}

@media only screen and (max-width:1200px) {
 
  #botones .row .huge{
	   font-size:30px  !important;
   }
  #botones .col-lg-3{
	  width:18%;
    } 
#botones  .row .huge{
	   font-size:22px  !important;
   }


}
  
 
 
@media only screen and (max-width:1064px) {
 
 
#botones  .row .huge{
	   font-size:18px  !important; 
   }

}
@media only screen and (max-width:1122px) {
 
 
#botones  .row .huge{
	   font-size:20px  !important; 
   }

}
 @media only screen and (max-width:1064px) {
 
 
#botones  .row .huge{
	   font-size:18px  !important; 
   }

} 
@media only screen and (max-width:1004px) {
 
 
	#botones  .row .huge{
		   font-size:16px  !important; 
	   }
	#botones  .col-md-3{
		  width:20%;
	   }
	#botones  .col-lg-3{
		  width:20%;
	   }

}
@media only screen and (max-width:992px) {
 
 
	#botones  .col-lg-2{
		   width:20%;
		    float:left;
	   }
	#botones  .col-md-3{
		  width:100%;
	   }
	#botones  .col-lg-3{
		  float:left;
		  width:25%;
	   }
	#botones  .col-lg-10{
		  float:left;
	   }
 
}
@media only screen and (max-width:972px) {
  
	#botones  .col-lg-3{
 		  width:25%;
	   }
	#botones  .col-lg-10{
 		  width:72%;
 	   }
	   	#botones  .col-lg-2{
		   width:25%;
 	   }

  }
  
  @media only screen and (max-width:958px) {
	#botones  .row .huge{
		font-size:14px !important;
	}
  }   
 	
  @media only screen and (max-width:934px) {
	#botones  .row .huge{
		font-size:14px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:24px !important;
	}
	#botones  .row .col-xs-9{
		clear:both;
	}
	#botones  .col-lg-10{
 		  width:80%;
		  padding:0px;
 	}
	#botones  .col-lg-2{
 		  width:20%;
		  padding:0px;
 	}

  }   
 	
  @media only screen and (max-width:934px) {
	#botones  .row .huge{
		font-size:16px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:16px !important;
	}
	#botones  .row .col-xs-9{
		clear:unset;
	}
	#botones  .col-lg-10{
 		  width:100%;
		  padding-left:15px;
		  padding-right:15px;
  	}
	#botones  .col-lg-3{
 		  width:100%;
		  padding:0px;
  	}
	#botones .col-xs-2{
		width:12.6%;
	}
	#botones  .col-xs-3{
 		  width:12%;
  	}
	#botones  .col-lg-2{
 		  width:100%;
		  padding-left:15px;
		  padding-right:15px;
  	}
	#botones  .col-lg-12{
 		  width:100%;
		  padding:0px;
  	}
	#contenedorbr{
		height:auto !important;
	}
	.limebutton{ display:none}
	#botones .col-xs-10{
	padding-left:5px !important;
}


  }   
 	
	
	

@media only screen and (max-width:934px) {
	#contenedor360{
	   width:100% !important;
    }
	.limebutton{display:block !important;}
	#contenedorbr{ border-color:#fff !important; padding: 0 !important;}
	#contenedorbr .col-lg-7{ width:100% !important; padding: 0 !important;}
	#contenedorbr .col-lg-5{ width:100% !important; padding: 0 !important;}
	#contenedorbr .col-lg-6{ width:100% !important; height: 627px !important;padding: 0 !important;}
	#contenedorbr  .col-lg-6 .panel-default{ height:600px !important; padding: 0 !important;}
	#contenedorbr #formulario .col-lg-7{ width:45% !important;float:left !important; padding: 0 !important;}
	#contenedorbr #formulario .col-lg-5{ width:25% !important; float:left !important;  padding: 0 !important;}
	#menu360 li img{width:49px !important;}
	html, body{ height: auto !important;}
	#page-wrapper{ height: auto !important;}
	#botones #tablero{ width: 25% !important; float:left !important;}
	#botones .col-lg-10{ width: 70% !important; float:left !important;}
	#botones .col-lg-10 .col-lg-3{ width: 22% !important; float:left !important; margin-left:17px !important;}
}     

@media only screen and (max-width:905px) {

	#botones  .row .huge{
		font-size:12px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:12px !important;
	}


	#botones #tablero{ width: 22% !important; float:left !important;}
	#botones .col-lg-10{ width: 76% !important; float:left !important;}
	#botones .col-lg-10 .col-lg-3{ width: 22% !important; float:left !important; margin-left:17px !important;}
}     
@media only screen and (max-width:837px) {

	#botones  .row .huge{
		font-size:12px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:12px !important;
	}


	#botones #tablero{ width: 19% !important; float:left !important;}
	#botones .col-lg-10{ width: 81% !important; float:left !important;}
	#botones .col-lg-10 .col-lg-3{ width: 22% !important; float:left !important; margin-left:17px !important;}
}     

@media only screen and (max-width:786px) {

	#botones  .row .huge{
		font-size:12px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:12px !important;
	}


	#botones #tablero{ width: 20% !important; float:left !important;}
	#botones .col-lg-10{ width: 79% !important; float:left !important; padding: 0 !important;}
	#botones .col-lg-10 .col-lg-3{ width: 23% !important; float:left !important; margin-left:8px !important;}
} @media only screen and (max-width:768px) {

	 .navbar-header button{ display:none !important;}
}     
@media only screen and (max-width:690px) {

	#botones  .row .huge{
		font-size:12px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:12px !important;
	}
	#botones  .col-xs-3{ display:none !important;}
	#botones  .col-xs-2{ display:none !important;}
	#menu360 li img{width:40px !important;}

	#botones #tablero{ width: 17% !important; float:left !important; padding:0px;}
	#botones .col-lg-10{ width: 79% !important; float:left !important; padding: 0 !important;}
	#botones .col-xs-9{ width: 92% !important; padding: 0 !important; padding-left:9px !important;}
	#botones #tablero .col-xs-10{padding-left:14px !important;}
	#botones #tablero {margin-left:14px !important;}
	#botones .col-lg-10 .col-lg-3{ width: 23% !important; float:left !important; margin-left:8px !important;}
	
	#botones .fa-fw{ display:none !important;}
}     
	
@media only screen and (max-width:508px) {

	#botones  .row .huge{
		font-size:11px !important;
	}
	#botones  .row .col-xs-9 .huge{
		font-size:11px !important;
	}
	#botones  .pull-left{ display:none !important;}
	#botones  .col-xs-3{ display:none !important;}
	#botones  .col-xs-2{ display:none !important;}
	#botones  .fa{ font-size:19px !important;}

	#botones #tablero{ width: 18% !important; float:left !important; padding:0px;}
	#botones .col-lg-10{ width: 78% !important; float:left !important; padding: 0 !important;}
	#botones .col-xs-9{ width: 92% !important; padding: 0 !important; padding-left:9px !important;}
	#botones #tablero .col-xs-10{padding-left:14px !important;}
	#botones #tablero {margin-left:8px !important;}
	#botones .col-lg-10 .col-lg-3{ width: 22% !important; float:left !important; margin-left:8px !important;}
	
	#botones .fa-fw{ display:none !important;}
}     
	
	
	</style>
</head>
<body>
<div class="loading" id="load">
<center><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" class="g-loading" /></center>
 
</div>
<script>
jQuery(function(){
	var html='<div style="clear:both"></div>';
	html+='<div style="padding:5px" class="col-lg-12 panel-heading list-group list-group-item">';
	 
	html+='<div class="col-lg-12" style="padding:5px;font-size:6pt">';
     html+=' &copy;2019 Talent Evolution';	
    html+='</div>'; 	
	
	
	
	html+='</div>';
 
	//jQuery("body").append(html);
	setTimeout(function(){
	//	jQuery("body").height(jQuery("body").height()-100);
	},300);
})
</script>
<?php if(isset($formatdata)) { ?>
    <script type='text/javascript'>
        var userdateformat='<?php echo $formatdata['jsdate']; ?>';
        var userlanguage='<?php echo $adminlang; ?>';
    </script>
    <?php } ?>
 
 
 
<div  id="wrapper">
    <?php $this->widget('ext.FlashMessage.FlashMessage'); ?>
 