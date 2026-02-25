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
	.sut{
	border: 1px solid #EDEDFB ;padding-top:10px;padding-bottom:10px;
	
	}
	.dee{
	border: 1px solid #EDEDFB ;padding-top:10px;padding-bottom:10px;
	
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
	@media screen  and  (min-width: 200px)  and (max-width: 600px) {
		#imglogo {
 			width: 80%;
 		}
  	}	
	@media screen  and  (min-width: 601px) {
		#imglogo {
 			width: 80%;
 		}
  	}	 
</style>
  <script>
  
$(document).ready(function(){
	jQuery("#contenedor_encuesta").attr({"src":"<?=Yii::app()->baseUrl?>/index.php/294584/lang-es?idorg=<?=$dUsuario->id_unidad?>&idus=<?=$dUsuario->id?>","style":"height:1200px;width:100%;overflow: hidden;border-style: none;"});
 	var  w=jQuery(window).width();
	if(w<=600){
		jQuery("#imglogo").attr({"src":"<?=Yii::app()->baseUrl?>/images/atmse_mini.jpg"});
	}
	if(w>600){
		jQuery("#imglogo").attr({"src":"<?=Yii::app()->baseUrl?>/images/atmse.jpg"});
	}
});
 
</script>
 
 
 
<div id="content" style="padding:10px">
	<div class="col-md-12">
		 
		
		<div class="divContentBlue" id="encuesta" >
				<div style="clear:both"></div> 
				<div class="divContentWhite">	
				<center><img id="imglogo" src=""></center>
				<div style="clear:both"></div>
				<iframe src="" id="contenedor_encuesta" style="height:3000px"></iframe>
				</div>
		</div>
 		
	</div>
	 
</div>