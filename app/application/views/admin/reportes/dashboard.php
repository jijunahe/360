 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<!--script type="text/javascript" src="<?=Yii::app()->baseUrl?>/js/Concurrent.Thread.js"></script-->
<style type="text/css"> 
html,body{ overflow-x:hidden !important;}
table {
	font-size: 1em;
}

.ui-draggable, .ui-droppable {
	background-position: top;
}

	#reporte { list-style-type: none; margin: 0; padding: 0; width: 100%; list-style:none; }
	.fila { 
		margin: 0 3px 3px 3px; 
		font-size: 1.4em; 
		min-height: 300px; 
	}
	#reporte li span {  text-decoration: none;float:left; }


	.columnas { list-style-type: none; margin: 0; padding: 0; width: 100%; list-style:none; }
	.columnas li { 
		margin-left;3px; 
		font-size: 1.4em; 
		min-height: 300px; 
		width:100%;
		float:left;
		border: 1px solid #BED2F6;
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
.paginaselected{
	
	padding-left: 16px;
	padding-right: 16px;
	padding-top: 4px;
	padding-bottom: 3px;
	display: inline-block;
	border-radius: 7px;
	border: 1px solid rgb(109,92,157);
	background: #ABC;
	text-align: center;
	
}
.divContentBlue{
	    padding: 5px;
}
.crearorigenes{
	float:left;
 	width: 97%;
	margin-left:20px;
}
.menudrag{
	float:left;
	margin-left:20px;
	width: 97%;
 }



.agregar-col{
	width:20px;
	float:left;
	cursor:pointer;
}
.agregar-grafico{
	width:20px;
	float:left;
	cursor:pointer;
}
.titulo-fila{
	float:left;
	margin-left:3px;
	padding:2px;
}
.titulo-grafico{
	float:left;
	margin-left:5px;
	padding:2px;
}
.atributos{
	border: 1px solid #BED2F6;
	padding:2px;
}
.clear{
	clear:both;
	/*margin-top: 10px;*/
}
.eliminar-fila{
	float:right;cursor:pointer;
	width:20px;
}
.eliminar-columna{
	float:right;cursor:pointer;
	width:20px;
}
#don-fer-ku{
	width:100%;
}
.right-pannel{
	float:left;
	width:260px;
	height:100%
}

.right-pannel h3.top {
    border-top: none !important;
    margin: 0;
    padding-top: 5px;
}
.right-pannel h3 {
    line-height: 1.5em;
     padding: 5px 10px 6px;
	 background: -webkit-gradient(linear,left top,left bottom,from(#fff),to(#f0f0f0));
	 border-bottom: 1px solid #CCC;
    font-size: 12px;
    font-weight: bold;
	text-shadow: 1px 1px 0 #fff;
}
h3 {
    display: block;
     -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
 }
.sidebar_inner{
	padding: 10px;
}
.sidebar_inner.dimension_tree {
    display: block;
    max-height: 200px;
    overflow-y: auto;
}
.sidebar_inner.measure_tree {
    display: block;
    max-height: 130px;
    overflow-y: auto;
}
div {
    display: block;
}

.left-pannel{
	float:left;
	width:80%;
	height:100%
}

.sidebar_separator{
	background: #f0f0f0;
    border-right: 1px solid #CCC;
    border-left: 1px solid #CCC;
    cursor: pointer;
    float: left;
    width: 3px;
}

.d_measure {

    color: #000;
  	padding:1px;
	margin-top:2px;
	width:auto;
	padding-left: 8px;
	
}

.d_measure  a {
    padding-left: 20px;
    background: url(<?=Yii::app()->baseUrl?>/images/bullet_red.png) 0 4px no-repeat;
}


.dimension_tree ul li{
	list-style:none;
}
.measure_tree ul li{
	list-style:none;
}
.d_dimension {
 	padding:1px;
	margin-top:2px;
	width:auto;
	padding-left: 8px;

}
.d_dimension  a {
    padding-left: 20px;
    background: url(<?=Yii::app()->baseUrl?>/images/bullet_blue.png) 0 4px no-repeat;
}
.fields_list, .resultado-R {
    min-width: 98%;
    border: 1px solid #CCC;
    margin-bottom: 10px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    box-shadow: 2px 2px 4px rgba(0,0,0,0.10);
    -moz-box-shadow: 2px 2px 4px rgba(0,0,0,0.10);
    -webkit-box-shadow: 2px 2px 4px rgba(0,0,0,0.10);
}
.fields_list .fields_list_header {
    background-color: #e6e6e6;
    background: linear-gradient(to bottom,#fff,#e6e6e6);
    background: -webkit-gradient(linear,left top,left bottom,from(#fff),to(#e6e6e6));
    background: -moz-linear-gradient(top,#fff 0,#e6e6e6 100%);
    border-right: 1px solid #CCC;
    float: left;
    font-weight: bold;
    padding: 3px 5px 3px 10px;
    line-height: 28px;
    border-radius: 5px 0 0 5px;
}
.fields_list .fields_list_body {
    float: left;
    padding: 0;
    margin-right: 37px;
    width: 85%;
}
span.clear_axis {
    background: url(<?=Yii::app()->baseUrl?>/images/cancel3.png) no-repeat scroll center center transparent;
    cursor: pointer;
    height: 32px;
    opacity: .1;
    float: right;
    width: 30px;
    margin-left: -35px;
    z-index: 1;
}
.workspace_inner{
	float: left;
	width:870px;
}
.connectable{list-style:none}
.connectable .d_dimension{
    background: #e5f6ff;
    background: -webkit-gradient(linear,left top,left bottom,from(#e0e9ef),to(#c2d5e2));
    background: -moz-linear-gradient(top,#e0e9ef 0,#c2d5e2 100%);
    border: 1px solid #2a6085;
	box-shadow: 0 0 2px #DDD; 
    color: #2a6085;
    display: inline-block !important;
	padding:4px !important;
	width: auto !important;
	margin-left:2px;
	margin-top:2px;
}
.connectable .d_measure{
    background: #ffe8e8;
    background: -webkit-gradient(linear,left top,left bottom,from(#fcf5f5),to(#fad9d9));
    background: -moz-linear-gradient(top,#fcf5f5 0,#fad9d9 100%);
    border: 1px solid #ed9393;	
 	box-shadow: 0 0 2px #DDD; 
	display: inline-block !important;
    color: #2a6085;
 	padding:4px !important;
	width: auto !important;
	margin-left:2px;
	margin-top:2px;
}
.connectable  a {
    padding-left: 0px;
    background: none;
	float:left;
}
.connectable  span.droop {
    padding-left: 0px;
    display:block !important;
	background: url(<?=Yii::app()->baseUrl?>/images/cancel3.png) 0 4px no-repeat;
	width: 20px;
    height: 20px;
    float: left;
	margin-left:5px;
}
.workspace_toolbar {
    background: #f9f9f9;
    border-bottom: 1px solid #CCC;
    font-weight: bold;
    height: 32px;
    margin: 0 0 3px 0;
     text-shadow: 1px 1px 0 #fff;
    overflow: hidden;
    box-shadow: 2px 1px 3px rgba(0,0,0,0.1) -moz-box-shadow:2px 2px 4px rgba(0,0,0,0.10);
    -webkit-box-shadow: 2px 2px 4px rgba(0,0,0,0.10);
	clear:both;
}

.workspace_toolbar ul {
    margin: 0;
    padding: 0;
}

.workspace_toolbar ul li {
    display: inline;
    float: left;
    padding-left: 5px;
}
.workspace_toolbar ul li.seperator {
    border-left: 1px solid #d5d5d5;
    margin-left: 5px;
}
.workspace_toolbar a.button {
    display: block;
    height: 16px;
    padding: 8px;
    width: 16px;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    background-repeat: no-repeat;
}
.action { 
   cursor:pointer;
   width:30px;
 }
 .modal_filtro{
	 position:absolute;
	 z-index:1000;
	 width:400px;
	 height:60%;
	 background:#fff;
	 display:none;
	 margin-left:30%;
	 margin-top:5%;
 	padding: 15px 0 0 20px;
    box-shadow: 2px 2px 5px #999999;
 }
.valores{
	overflow-y: scroll;
	height:80%;

}

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-style:solid}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-yw4l{vertical-align:top}

.chart {
  width: 100%; 
  min-height: 300px;
}
.row {
  margin:0 !important;
}

.editarreporte{
	float:left;
	margin-left:10px;
	padding:5px;
	cursor:pointer;
	box-shadow: 2px 2px 5px #999999;
} 
.number-container {
    color: rgb(34,34,34);
    text-align: center;
    margin-left: auto;
    margin-right: auto;
	width: 235px;
	border-radius: 20px;
}

.chartnumber_widget{
	background-color: rgb(184, 209, 237);
    border-radius: 20px;
}

.number-preview {
    color: rgb(34,34,34);
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}
.number-preview var {
    display: block;
    font-size: 36px;
    font-style: normal;
    font-weight: bold;
    padding-bottom: 3px;
}

.number-preview em {
    display: block;
    font-size: 10px;
    font-style: normal;
}

 </style> 
<script>
var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}
//var origenes="";
//var origenesB=[];
var temporalQuery={};
<?php if(count($origenes)>0){
	//echo "origenes='".$origenes."';";
	//echo "origenesB=".$origenesB.";";
}
?>
function getidr(){
	var qery=(document.location.search).split("?")[1];
	var qery=qery.split("&");
	var obj={};
	jQuery.each(qery,function(k,d){
		var atoms=d.split("=");
		obj[atoms[0]]=atoms[1];
	});
	return obj;
}
function getCookie(){
	var qery=document.cookie;
	var qery=qery.split("; ");
	var obj={};
	jQuery.each(qery,function(k,d){
		var atoms=d.split("=");
		obj[atoms[0]]=atoms[1];
	});
	return obj;
}
function setCookie(params) {
	var name            = params.name,
		value           = params.value,
		expireDays      = params.days,
		expireHours     = params.hours,
		expireMinutes   = params.minutes,
		expireSeconds   = params.seconds;

	var expireDate = new Date();
	if (expireDays) {
		expireDate.setDate(expireDate.getDate() + expireDays);
	}
	if (expireHours) {
		expireDate.setHours(expireDate.getHours() + expireHours);
	}
	if (expireMinutes) {
		expireDate.setMinutes(expireDate.getMinutes() + expireMinutes);
	}
	if (expireSeconds) {
		expireDate.setSeconds(expireDate.getSeconds() + expireSeconds);
	}

	document.cookie = name +"="+ escape(value) +
		";domain="+ window.location.hostname +
		";path=/"+
		";expires="+expireDate.toUTCString();
}

function deleteCookie(name) {
	setCookie({name: name, value: "", seconds: 1});
}
function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 5; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
window["controlplay"]=false;
var acciones={
	dashboard:{},
	indexfilas:[],
	id_reporte:null,
	construir:function(tipo,id){
		switch(tipo){
			case "fila":
				if(typeof acciones.dashboard[id]!="object"){
					//console.log("existe");
					acciones.dashboard[id]={};
					acciones.indexfilas.push(id);
 				} 
			break; 
			case "columna":
				var idfila=jQuery("#col-"+id).parent().attr("id").split("-")[1];
				if(Object.keys(acciones.dashboard[idfila]).length==0){
					acciones.dashboard[idfila]["index"]=[];
					acciones.dashboard[idfila][id]={};
					acciones.dashboard[idfila]["index"].push(id);
				}else{
					acciones.dashboard[idfila][id]={};
					acciones.dashboard[idfila]["index"].push(id);
				}
 			break;
			case "col"://eliminar columna
				var idfila=jQuery("#col-"+id).parent().attr("id").split("-")[1];
				delete acciones.dashboard[idfila][id];
				var index=acciones.dashboard[idfila]["index"].indexOf(id);
				acciones.dashboard[idfila]["index"].splice(index,1); 
			break;
			case "eliminarfila"://eliminar fila
 				delete acciones.dashboard[id];
				var index=acciones.indexfilas.indexOf(id);
				acciones.indexfilas.splice(index,1); 
 			break;
		}
	},
 	agregarfila:function(){
 		jQuery("#agregar").on('click',function(){
			var id=makeid();
			var telements=jQuery("#reporte").find("li").size();
			var filabasica='<li class="ui-state-default fila" id="'+id+'" target="'+telements+'" >';
			filabasica+='<div class="clear">';
 			filabasica+='<image src="<?=Yii::app()->baseUrl?>/img/bad.gif"  class="eliminar-fila"  />';
			filabasica+='</div><br>';
			filabasica+='<div class="atributos" >';
			filabasica+='<image src="<?=Yii::app()->baseUrl?>/img/add.gif"  id="fila-'+id+'"   class="agregar-col"/>';
			filabasica+='<div  class="titulo-fila" ><b>Titulo:</b> <input type="text" class="titulo" /></div>';
			filabasica+='<div class="clear"></div></div>'; 
			
			filabasica+='<ul id="columnas-'+id+'" class="columnas"></ul>'; 
			filabasica+='<div class="clear"></div><br></li>';
			jQuery("#reporte").append(filabasica); 
			acciones.activarfilas();
			acciones.agregarcolumna(id);
			acciones.construir("fila",id);
		});
	},
	agregarcolumna:function(id){
		jQuery(".agregar-col").on('click',function(){
			
			var idcol=makeid();
			var telements=jQuery(this).parent().parent().find('#columnas-'+id+'').find("li").size();
			var w=100;
			if(telements>0){
			 w=( (100/(telements+1)))-0.2;
			}
			
 			var filabasica='<li class="ui-state-default" id="col-'+idcol+'" target="'+telements+'" >';
			filabasica+='<div class="clear">';
 			filabasica+='<image src="<?=Yii::app()->baseUrl?>/img/bad.gif"  class="eliminar-columna"  />';
			filabasica+='</div><br>';
			filabasica+='<div class="atributos" >';
			filabasica+='<image src="<?=Yii::app()->baseUrl?>/img/pie_chart_21427.png"   target="grafico-'+idcol+'" id="agregar-grafico-'+idcol+'"  class="agregar-grafico"/>';
			filabasica+='<div  class="titulo-grafico" ><b>Titulo:</b> <input type="text" class="titulo" /><br> <b>Tipo Gráfico:</b><select id="tipografico-'+idcol+'"><option value="1">pie</option><option value="2">Barras</option><option value="3">Tendencia</option><option value="4">Tabla</option><option value="5">Número</option><option value="6">Selector</option></select></div>';
			filabasica+='<div id="grafico-'+idcol+'"></div><div class="clear"></div></div>'; 
  			filabasica+='</li>';
 			jQuery("#columnas-"+id).prepend(filabasica);
			jQuery("#columnas-"+id).find("li").css({width:w+"%",'margin-left':"1px"}); 
 			acciones.activarcolumnas(id);
			acciones.agregargrafico('#grafico-'+idcol);
 			acciones.construir("columna",idcol);

		});
	},eventosval:[],
	agregargrafico:function(id){
		 
		var html=jQuery("#modalgrafico").html();
		var idg=id.split("-")[1];
		//if(acciones.eventosval.indexOf("agregar-grafico-"+idg)==-1){
			jQuery("#agregar-grafico-"+idg).on('click',function(){
				jQuery("#load").show();
				jQuery.colorbox({html:html,width:"90%",height:"90%"});
				jQuery("#colorbox").find("#codigografico").text(idg);
				var objchange=jQuery("#colorbox").find(".action");
				jQuery("#colorbox").find("#tablas").attr({"id":"tablas-"+idg});
				jQuery.each(objchange,function(k,ob){
					jQuery(ob).attr({"class":"action-"+idg+" action"});
				});
				setTimeout(function(){
					acciones.acciongrafico(idg);
					jQuery("#load").hide();
					
					if(jQuery("#config-"+idg).size()>0){
					 
						var str = jQuery("#config-"+idg).text();
						str = JSON.stringify(eval('('+str+')'));
						var objson = JSON.parse(str);
						 
						jQuery("#tablas-"+idg).val(objson["id_cubo"]);
						jQuery("#tablas-"+idg).trigger('change');
 						setTimeout(function(){
							try{
							if(objson["filas"]!=null){
								jQuery.each(objson["filas"],function(k,d){  
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
 									if(objparent=="d_dimension ui-draggable"){
										var html='<li class="d_dimension ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".rows").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".rows").find("ul").append(html);
										}
									}
									if(objparent=="d_measure ui-draggable"){
										var html='<li class="d_measure ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".rows").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".rows").find("ul").append(html);
										}										
 									}
								});
							}
							}catch(e){}
							try{
							if(objson["columnas"]!=null){
								jQuery.each(objson["columnas"],function(k,d){ 
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
									 
									if(objparent=="d_dimension ui-draggable"){
										var html='<li class="d_dimension ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".columns").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".columns").find("ul").append(html);
										}
									}
									if(objparent=="d_measure ui-draggable"){
										var html='<li class="d_measure ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".columns").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".columns").find("ul").append(html);
										}										
 									}
								});
							}
							}catch(e){}
							
							try{
							if(typeof objson["filtro"] == "object"){
 								jQuery.each(objson["filtro"],function(d,filtros){  
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
									 
									if(objparent=="d_dimension ui-draggable"){
										var html='<li class="d_dimension ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".filter").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".filter").find("ul").append(html);
										}
									}
									if(objparent=="d_measure ui-draggable"){
										var html='<li class="d_measure ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".filter").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".filter").find("ul").append(html);
										}										
 									}
									if(jQuery("#colorbox").find(".filtros").find("[rel='"+d+"']").size()==0){
 										var html='<div rel="'+d+'" style="display:none">'+filtros+'</div>';
										jQuery("#colorbox").find(".filtros").append(html);
									}
									
								});
							}
							}catch(e){}
							
							try{
							if(typeof objson["fil"] == "object"){
 								jQuery.each(objson["fil"],function(k,d){ //console.log(filtros+" FILTROS")
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
									 
									if(objparent=="d_dimension ui-draggable"){
										var html='<li class="d_dimension ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".filter").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".filter").find("ul").append(html);
										}
									}
									if(objparent=="d_measure ui-draggable"){
										var html='<li class="d_measure ui-draggable" style="display: inline-block;">';
										html+='<a href="javascript:;" class="action-'+idg+'" rel="filtro" style="width: auto;">'+d+'</a>';
										html+='<span class="droop" style="display:none;cursor:pointer" onclick="javascript:jQuery(this).parent().remove();acciones.getconsulta(\''+idg+'\');">';
										html+='</span>';
										html+='<div class="clear"></div>';
										html+='</li>';
										if(jQuery("#colorbox").find(".filter").find("a:contains('"+d+"')").parent().size()==0){
											jQuery("#colorbox").find(".filter").find("ul").append(html);
										}										
 									}
 								});
							}
							}catch(e){}
							
							
							acciones.getconsulta(idg);
							acciones.filtrarc(idg);
							
							
						},50); 
					 
					}					
					
					
					
				},50);
				 
  
		 				
			});
			acciones.eventosval.push("agregar-grafico-"+idg);
		//}		
 		
	},
 	acciongrafico:function(idg){   
		 
 		if(jQuery("#tablas-"+idg).is(":visible")){
 			jQuery("#tablas-"+idg).change(function(){  
 				var idtabla=jQuery(this).val();
 				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/reportes",
					data:{id:idtabla,option:"dimensiones"},
					beforeSend:function(){jQuery("#load").show();},
 					success:function(res){ 
						if(typeof res=="object"){
							if(res[0]==true){
								var htmla="<ul style='padding-left: 0px;'>";
								var htmlb="<ul  style='padding-left: 0px;'>";
								var list=["int","double","decimal","float"];
								jQuery.each(res[3],function(k,d){
									if(list.indexOf(d[1])==-1 ){
										htmla+="<li class='d_dimension'><a href='javascript:;' class='action-"+idg+"' name='"+d[0]+"' rel='filtro' style='width: auto;'>";
										htmla+=d[0];
										htmla+="</a><span class='droop' style='display:none;cursor:pointer' onclick='javascript:jQuery(this).parent().remove();acciones.getconsulta(\""+idg+"\");'></span><div class='clear'></div></li>";
									}else{
										htmlb+="<li class='d_measure'><a href='javascript:;' class='action-"+idg+"'  name='"+d[0]+"' rel='filtro' style='width: auto;'>";
										htmlb+=d[0];
										htmlb+="</a><span class='droop' style='display:none;cursor:pointer' onclick='javascript:jQuery(this).parent().remove();'></span><div class='clear'></div></li>";
									}						
								});
								htmla+="</ul>"; 
								htmlb+="</ul>";
								jQuery("#cboxWrapper").find(".dimension_tree").html(htmla);
								jQuery("#cboxWrapper").find(".measure_tree").html(htmlb);
								 acciones.dragable(idg);
								 acciones.tools(idg);
								 jQuery("#load").hide();
							}
						}	else{console.log("error");}					
						
						  
					}
				}).responseJSON;
				

				
			});
		} 
		 
 	},
	testres:0,
	tools: function(idg){
		return false;
 	},
	getconsulta:function(idg){
		return false;
 	}, 
	filtrarc:function(idg){
		return false;
		
	},
	dragable:function(idg){
		return false;
	},
	droop:function(idg){
		return false;
	},
	confirmareliminar:function(obj){
		return false;
	},
	eliminar:function(item){
		return false;
	},
	 
	activarfilas:function(){
		return false;
	},
	activarcolumnas:function(id){
		return false;
	},
	getdata:function(objs,temporalQueryb){
		return false;
		
	},
	getdataurl:function(idr=false){
		var search=(document.location.search).split("&");
		var atoms={};
		jQuery.each(search,function(k,d){
			var tatom=d.split("=");
			if(tatom[0]!="?idr"){
				atoms[tatom[0]]=tatom[1];
			}
			if(idr==true){
				atoms[tatom[0]]=tatom[1];
			}
		});
		return atoms;
	},
	drilldown:function(chart,idg,data,measures,indexcustomcolumns){
		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str);
		function selectHandler() {
			  var selectedItem = chart.getSelection()[0];
 			   console.log(selectedItem);
			  if (selectedItem) {
				var topping = data.getValue(selectedItem.row, 0);
				var toppingB = data.getValue(selectedItem.row,1);
				var dim=measures[0][0].split("-");
				var t=dim.length-1;
				console.log('The user selected ' + topping);
				console.log(dim[t]);
				console.log(toppingB);
				console.log(measures);
				console.log(indexcustomcolumns);
				if(typeof objson["acciones"]=="object"){
					if(objson["acciones"][1]!="" && objson["acciones"][0]!=""){
						var index=indexcustomcolumns.indexOf(objson["acciones"][0]);
						console.log(indexcustomcolumns); 
						console.log(" INDEX "+index);
						if(index<0){
							index=0;
						}
						var atoms=acciones.getdataurl();
						atoms["param:"+objson["acciones"][0]]=data.getValue(selectedItem.row,index);
						var nq=[];
						var controlvar=[];
						jQuery.each(atoms,function(kk,dd){
							if(controlvar.indexOf(kk)==-1){
								nq.push(kk+"="+dd);
								controlvar.push(kk);
							}
						});
						var params=getidr();
						jQuery.each(params,function(k,valor){
							if(k!="idr" && k!="param:"+objson["acciones"][0]){
								if(controlvar.indexOf(k)==-1){
									nq.push(k+"="+valor);
									controlvar.push(k);
								}
							}
						});
						
						var validamodal=false;
						if(objson["acciones"][2]!=undefined){
							if(objson["acciones"][2]){
								validamodal=true;
							}
						}
						if(validamodal==false){
						document.location.href=document.location.origin+document.location.pathname+"?idr="+objson["acciones"][1]+"&"+nq.join("&");
						}else if(validamodal==true){
							var url=document.location.origin+document.location.pathname+"?idr="+objson["acciones"][1]+"&"+nq.join("&")+"&iframe=1";
							var w=jQuery(window).width();
							var width="40%";
							var height="400px";
							if(w<=600){
								width="90%";
								height="400px";
							}
							var iframemodal='<iframe src="'+url+'"  overflow-x="hidden" style="width:100%;height:97%;overflow-x:hidden;overflow-y:scroll"></iframe>';
							jQuery.colorbox({html:iframemodal,'width':width,'height':height,'overflow':"hidden"});
						}
						//}   
						
					}
				}
			  }
		}			
		google.visualization.events.addListener(chart, 'select', selectHandler);		
		
		
	},
	piechart:function(measures,idg,titulo,indexcustomcolumns){
		//jQuery("#graph-"+idg).html("");
 		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			
			var data = google.visualization.arrayToDataTable(measures);
			/*
			var options = {
			legend: 'none',
			pieSliceText: 'label',
			title: '',
			pieStartAngle: 100,
			width:"90%"
			};*/
			var options = {
				title: titulo,
				pieStartAngle: 100,
			width:"97%",
			click:function(e){console.log(e);},
						colors:['#ffbb78','#aec7e8','#2ca02c','#98df8a','#d62728','#dcd6d6','#9467bd','#c5b0d5','#8c564b','#c49c94','#e377c2','#f7b6d2']

			};

			var chart = new google.visualization.PieChart(document.getElementById('graph-'+idg));
			
			acciones.drilldown(chart,idg,data,measures,indexcustomcolumns);   
 			chart.draw(data, options);
			acciones.descargar(idg,measures);
 		}
  	},
 	tendencia:function(measures,idg,titulo,indexcustomcolumns){
		//jQuery("#graph-"+idg).html("");
		 google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			
			var data = google.visualization.arrayToDataTable(measures);
			/*
			var options = {
			legend: 'none',
			pieSliceText: 'label',
			title: '',
			pieStartAngle: 100,
			width:"90%"
			};*/
			var options = {
				title: titulo,
 			width:"97%",
				hAxis: {title:measures[0][0]},
				vAxis: {title: measures[0][1]},
				legend: 'none',
				trendlines: { 0: {} }  
			};

			var chart = new google.visualization.ScatterChart(document.getElementById('graph-'+idg));
			acciones.drilldown(chart,idg,data,measures,indexcustomcolumns);   
 			chart.draw(data, options);
			acciones.descargar(idg,measures);
		}
	},	
	tabla:function(measures,idg,titulo,indexcustomcolumns){ 
		//jQuery("#graph-"+idg).html("");
		 google.charts.load('current', {'packages':['table']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			
			var data = google.visualization.arrayToDataTable(measures);
			/*
			var options = {
			legend: 'none',
			pieSliceText: 'label',
			title: '',
			pieStartAngle: 100,
			width:"90%"
			};*/
			jQuery("#tg-"+idg).html("<b>"+titulo+"</b>");
			var options = {
				title: titulo,
				width: '99%', height: '100%', 
				legend: titulo,
				showRowNumber: true,
				pageSize:25
			};

			var chart = new google.visualization.Table(document.getElementById('graph-'+idg));
			acciones.drilldown(chart,idg,data,measures,indexcustomcolumns);   
 			chart.draw(data, options);
			acciones.descargar(idg,measures);
 		}
	},
	numero:function(measures,idg,titulo,indexcustomcolumns){
		var sumatoria=0;
		jQuery.each(measures,function(k,d){ 
			if(k>0){
				sumatoria=sumatoria+parseFloat(d[d.length-1]);
			}
		});
		var html='<div class="number-container" id="numero-'+idg+'">';
		html+='<div class="number-preview">';
		html+='<div class="chartnumber_widget chartnumber_number number-picked chart-pointer" style="background-color: rgb(184, 209, 237);">';
		html+='<strong class="notranslate chartnumber-title">Total</strong>';
		html+='<var class="chartnumber_color3 chartnumber-val">'+sumatoria+'</var><em>'+titulo+'</em>';
		html+='</div>';
		html+='</div>';
		html+='</div>';
		jQuery('#graph-'+idg).html(html);
		var h=jQuery("#numero-"+idg).height()+30;
		jQuery("#numero-"+idg).parent().attr({"style":"min-height:"+h+"px !important"});
		jQuery("#numero-"+idg).parent().parent().attr({"style":"min-height:"+(h+4)+"px !important"});
		jQuery("#numero-"+idg).parent().parent().parent().attr({"style":"min-height:"+(h+4)+"px !important"});
		jQuery("#numero-"+idg).parent().parent().parent().parent().attr({"style":"min-height:"+(h+4)+"px !important"});
		
	},	
	selector:function(measures,idg,titulo,indexcustomcolumns){
 		var options='';
		jQuery.each(measures,function(k,d){ 
			if(k>0){
				options+='<option value="'+d[0]+'">'+d[0]+'</option>';
			}
		});
 		var tempo=JSON.parse(jQuery("#config-"+idg).text());
		var html='<b>'+titulo+': </b><select id="select-'+idg+'"><option value="-1">Seleccione una opción</option>'+options+'</select>';
		jQuery('#graph-'+idg).html(html); 
		
		var h=jQuery("#select-"+idg).height()+30;
		jQuery("#select-"+idg).parent().attr({"style":"min-height:"+h+"px !important;width"});
		jQuery("#select-"+idg).parent().parent().attr({"style":"min-height:"+(h+4)+"px !important"});
		jQuery("#select-"+idg).parent().parent().parent().attr({"style":"min-height:"+(h+4)+"px !important;width:30%;float:left"});
		jQuery("#select-"+idg).parent().parent().parent().parent().attr({"style":"min-height:"+(h+4)+"px !important"});
		
  		var cols=[];
		var max=(measures[0].length-1);
		jQuery.each(measures[0],function(k,d){
			if(max!=k){
				cols.push(d);
			}
		});		
  		jQuery("#select-"+idg).change(function(){
 			var idg=jQuery(this).attr("id").split("-")[1];
			var valor=jQuery(this).val();
			if(valor.trim(" ")!=""){ 
			var query=[];
			var atoms=acciones.getdataurl(true);
			jQuery.each(cols,function(kk,dd){
				atoms["param:"+dd]=valor.trim(" ");
			});
			jQuery.each(atoms,function(kk,dd){
				query.push(kk+"="+dd);
			});
			console.log(query.join("&"));
			document.location.href=document.location.origin+document.location.pathname+query.join("&");

			}
		})
 	},
	
	html:function(measures,idg,titulo,indexcustomcolumns){
		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str); 
		var thtml=Base64.decode(objson["html"]);
		var html="";
		if(thtml!=undefined){
			html=thtml;
		}
		if(jQuery('#graph-'+idg).parent().find("#editar-"+idg).size()>0){
			jQuery('#graph-'+idg).parent().find("#editar-"+idg).remove();
		}
		window["measuresw"]=measures;
		window["idgw"]=idg;
  		jQuery('#graph-'+idg).html("");
 		jQuery("<script>")
		.attr({"type":"application/javascript"})
		.text(html)
		.appendTo('#graph-'+idg);
 		//Ejecutar javascript
 		//eval(html); 
 	},
 	
	buscador:function(measures,idg,titulo,indexcustomcolumns){ jQuery('#graph-'+idg).html(""); 
 		var cols=[];
		var max=(measures[0].length-1);
		jQuery.each(measures[0],function(k,d){
			if(max!=k){
				cols.push(d);
			}
		});
 		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str); 
 		var html='<div style="float:left;width:20%;padding-left:5px"><b>'+titulo+': </b></div>';
		html+='<input type="text" id="textbuscar-'+idg+'" style="float:left;width:55%;" /><input type="button" id="buscartexto-'+idg+'" value="buscar" />';
		jQuery('#graph-'+idg).html(html); 
		var h=jQuery("#buscartexto-"+idg).height()+30;
		
		jQuery("#buscartexto-"+idg).parent().attr({"style":"min-height:"+h+"px !important"});
		jQuery("#buscartexto-"+idg).parent().parent().attr({"style":"min-height:"+(h+4)+"px !important"});
		jQuery("#buscartexto-"+idg).parent().parent().parent().attr({"style":"min-height:"+(h+4)+"px !important;width:30%;float:left"});
		jQuery("#buscartexto-"+idg).parent().parent().parent().parent().attr({"style":"min-height:"+(h+4)+"px !important;"});
 		
		 
		jQuery('#buscartexto-'+idg).on("click",function(){  
 			var idg=jQuery(this).attr("id").split("-")[1];
			var valor=jQuery("#textbuscar-"+idg).val(); 
			if(valor.trim(" ")!=""){ 
				var query=[];
				var atoms=acciones.getdataurl(true);
				jQuery.each(cols,function(kk,dd){
 					atoms["param:"+dd]=valor.trim(" ");
				});
				jQuery.each(atoms,function(kk,dd){
					query.push(kk+"="+dd);
 				});
				console.log(query.join("&"));
 				document.location.href=document.location.origin+document.location.pathname+query.join("&");

			}
		});
		
 	}, 
	
	
	
	
	barchart:function(measures,idg,titulo,indexcustomcolumns){  
		 
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBarColors);
		jQuery.each(measures,function(k,d){
			if(k>0){
				jQuery.each(d,function(kk,dd){
					if(kk>0){
						var index=kk;
						measures[k][index]=parseFloat(d[index]);
						if(!jQuery.isNumeric(measures[k][index])){
							measures[k][index]=0;
						}
					}
				});
			}
		}); console.log("measures"); console.log(measures);
		function drawBarColors() {
		  var data = google.visualization.arrayToDataTable(measures);

		  /*var options = {
			title: 'Population of Largest U.S. Cities',
			chartArea: {width: '50%'},
			colors: ['#b0120a', '#ffab91'],
			hAxis: {
			  title: 'Total Population',
			  minValue: 0
			},
			vAxis: {
			  title: 'City'
			}
		  };*/
		  var options = {
			title: titulo,
			 
			width:"97%"

		  };
 			var chart = new google.visualization.ColumnChart(document.getElementById('graph-'+idg));
			acciones.drilldown(chart,idg,data,measures,indexcustomcolumns);   
			chart.draw(data, options);
			acciones.descargar(idg,measures);
		}		
		
 
		
	},
	gauge:function(measures,idg,titulo,indexcustomcolumns){
		google.charts.load('current', {'packages':['gauge']});
		google.charts.setOnLoadCallback(drawChart);
  		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str); 
		var colores=objson["customcolors"];
		
 		function drawChart() {

			/*var data = google.visualization.arrayToDataTable([
			  ['Label', 'Value'],
			  ['Memory', 80],
			  ['CPU', 55],
			  ['Network', 68]
			]);*/
			//console.log("ANTES");console.log(measures);
			var nmeasures=[];
			jQuery.each(measures,function(k,d){
				if(k<=1){
				nmeasures.push([d[0],d[1]]);
				} 
			});
			measures=nmeasures;  console.log(" MM ");
			  console.log(measures);
			var data = google.visualization.arrayToDataTable(measures);

			var options = {
				title:titulo,
			  width: 600, height: 200,
			  redFrom: 90, redTo: 100,
			  yellowFrom:75, yellowTo: 90,
			  minorTicks: 5,
			  
			};
			if(colores!=undefined){
				jQuery.each(colores,function(k,d){
					options[k]=d;
				});
			}
			var chart = new google.visualization.Gauge(document.getElementById('graph-'+idg));

			chart.draw(data, options);
			
			var objlis=jQuery("#col-"+idg).parent().find("li");
			var w=jQuery("#col-"+idg).parent().width();
			var lis=jQuery("#col-"+idg).parent().find("li").size();
			var nw=w;
			if(lis>0){
				nw=w/lis;
			}
			jQuery("#graph-"+idg).prepend("<center><b>"+titulo+"</b></center><br>");

			if(nw!=w){
 				jQuery.each(objlis,function(k,d){
					jQuery(d).css({width:nw-2+"px"});
					jQuery(d).find("[id^='graph-']").css({width:"200px","margin":"0 auto"});
				});
			}else{
 				jQuery("#graph-"+idg).css({width:"200px","margin":"0 auto"});
			}
			//acciones.descargar(idg,measures);
		}
	},
barraapilada:function(measures,idg,titulo,indexcustomcolumns){
		 
 
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBarColors);
		
		console.log("TAMANIO ME =>"+measures.length);
		if(measures.length==2){
  			 var fmeausere=[[],[]];
			jQuery.each(measures,function(k,d){
				if(k==0){
					fmeausere[k].push("ITEM");
				}else{
					fmeausere[k].push(titulo);
				}
 				jQuery.each(d,function(kk,dd){
					if(k>0){dd=parseFloat(dd);}
					fmeausere[k].push(dd);
				});
			});
			measures=fmeausere;

		} 
		
		  

		function drawBarColors() { console.log("measures apilado"); console.log(measures); 
			 				
			// console.log("measures b"); console.log(measures); 
		  var data = google.visualization.arrayToDataTable(measures);
				  
 		  /*var options = {
			title: 'Population of Largest U.S. Cities',
			chartArea: {width: '50%'},
			colors: ['#b0120a', '#ffab91'],
			hAxis: {
			  title: 'Total Population',
			  minValue: 0
			},
			vAxis: {
			  title: 'City'
			}
		  };*/
		  var options = {
			title:titulo,
			 legend: { position: 'top', maxLines: 3 },
			width:"97%",
			isStacked: true,
			colors:['#ffbb78','#aec7e8','#98df8a','#2ca02c','#d62728','#dcd6d6','#9467bd','#c5b0d5','#8c564b','#c49c94','#e377c2','#f7b6d2']

		  };
		  
 
		  var chart = new google.visualization.BarChart(document.getElementById('graph-'+idg));
		  acciones.drilldown(chart,idg,data,measures,indexcustomcolumns);   

		  chart.draw(data, options);
		  acciones.descargar(idg,measures);
		}		
		
 
		
	},
	intentos:{},
	descargar:function(idg,measures){
		window["measures_"+idg]=measures;
		window["idg_"+idg]=idg;
		var obj=jQuery('#graph-'+idg).parent();
		var btdes='<div  style="width:32px;height:32px;  float:right;margin-right:10px;margin-top:10px"><a  id="next-'+idg+'" target="view_'+idg+'" style="width:1px" ></a><iframe id="view_'+idg+'"  name="view_'+idg+'" style="display:none" ></iframe>';
		//btdes='<iframe id="tdesc_'+idg+'" src="" > </iframe>';
		btdes+='<a href="javascript:;" class="descargar_excel" id="descargar_xls_'+idg+'"   target="_blanck"><image src="<?=Yii::app()->baseUrl?>/images/icon/Excel.png" /></a></div>';
		obj.prepend(btdes);
		obj.find(".descargar_excel").click(function(){
		<?php 
			$filter="";
			if(isset($_GET)){
				$filter=array();
				foreach($_GET as $key=>$val){
					$test=explode(":",$key);
					if($test[0]=="param"){
						array_push($filter,$key."=".$val);
					}
				}
			}
			$limit="";
			if(isset($_GET["limit"])){
				$limit="&limit=".(int)$_GET["limit"];
			}  		
		
		?>			
 			
  			var idg=jQuery(this).attr("id").split("descargar_xls_")[1];
			var str = jQuery("#config-"+idg).text();
			str = JSON.stringify(eval('('+str+')'));
			var objson = JSON.parse(str); 
			var tquery={"c":objson["columnas"],"f":objson["filas"],"fil":objson["fil"]};

			var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/ejecutar?<?=join("&",$filter)?><?=$limit?>",
			data:{id:objson["id_cubo"],query:tquery, filtros:objson["filtro"],"descargar":1},
			beforeSend:function(){
				//jQuery("#load").show();  
				//var tload='<center><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" style="width:20%"></center>';
				//jQuery("#graph-"+idg).html(tload);

			},
			success:function(R){
				if(R[0]=="SI"){
					jQuery("#next-"+idg).attr({"href":"<?=Yii::app()->baseUrl?>/index.php/admin/authentication/sa/descargar?f="+R[1]});
					setTimeout(function(){
					document.getElementById("next-"+idg).click();
					console.log("#next-"+idg);
					},500);
				}
				 
			}
			}).responseJSON;
			
 		});	
		 
	
	
	},
 	graficar:function(grafico,idg,temporalQueryb,titulo){
 		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str); 
 		var customcolumns={};
		var indexcustomcolumns=[];
		try{
			customcolumns=objson["customcolumns"];
			jQuery.each(customcolumns,function(k,d){
				indexcustomcolumns.push(k);
			});
		}catch(e){}
 		var obj=jQuery("#col-"+idg).find("#graph-"+idg);
		if(obj.size()==0){
			var htmlconf='<div id="graph-'+idg+'" class="chart"></div>';
			jQuery("#col-"+idg).append(htmlconf);
		}
		//var R=acciones.getdata(objson,temporalQueryb);
		
		
		if(typeof temporalQueryb=="object"){
			temporalQuery=temporalQueryb;
		}
		
		<?php 
			$filter="";
			if(isset($_GET)){
				$filter=array();
				foreach($_GET as $key=>$val){
					$test=explode(":",$key);
					if($test[0]=="param"){
						array_push($filter,$key."=".$val);
					}
				}
			}
			$limit="";
			if(isset($_GET["limit"])){
				$limit="&limit=".(int)$_GET["limit"];
			}  		
		
		?>
		
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/ejecutar?<?=join("&",$filter)?><?=$limit?>",
			data:{id:objson["id_cubo"],query:temporalQuery, filtros:objson["filtro"]},
			beforeSend:function(){jQuery("#load").show();  
							var tload='<center><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" style="width:20%"></center>';
				jQuery("#graph-"+idg).html(tload);

			},
			success:function(R){
 				console.log(" RRRRRRRRRRRRRRRRRRRR "+titulo); 
 				console.log(R);
				
				var colsT=[];
				var data=[];
				var isnull=false;
				var contador=0;
				var contadorex=0;
				jQuery.each(R,function(k,dd){
					if(indexcustomcolumns.indexOf(k)>=0){
						k=customcolumns[k];
					}
					colsT.push(k);
					data.push(dd);
					if(dd==''){
						contador++;
					}
					contadorex++;
				});
				if(contadorex>contador || acciones.intentos[idg]>=2){
					console.log("LA DATA "+contadorex+" <> "+contador);
					console.log(data);
					var tcol=[];
					for(var i=0;i<(colsT.length-1);i++){
						tcol.push(colsT[i]);
					}
					
					if(grafico=="pie"){

						var columnas=[tcol.join("-"),colsT[(colsT.length-1)]];
						var measures=[columnas];
						 if(typeof data[0]=="object"){
							for(var i=0;i<data[0].length;i++){
								var me="";
								var t=0;
								 
								jQuery.each(colsT,function(kk,dd){
									if(kk==(colsT.length-1)){
										t=data[kk][i];	
									}else{
										if(me==""){
											me=data[kk][i];
										}else{
											me=me+"-"+data[kk][i];
										}
									}
								});
								measures.push([me.toString(),t]);
							 
							}
							
						}else{
							measures.push([data[0].toString(),data[1]]);
						}
					}else{
						
						
						var tempo=tcol;
						var i=0;
						var tmeasure=[];
						jQuery.each(tempo,function(k,d){
							if(d!=undefined && tmeasure.indexOf(d)==-1){
							tmeasure.push(d);
							i++;
							}
						});
						
						for(i=i-1;i<=colsT.length;i++){
							if(colsT[i]!=undefined  && tmeasure.indexOf(colsT[i])==-1){
							tmeasure.push(colsT[i]);
							}
						} 
						
						var columnas=tmeasure;
						var measures=[columnas];
						if(typeof data[0]=="object"){
							for(var i=0;i<data[0].length;i++){
								var me=[];
								var t=[];
								var tempo=[];
								jQuery.each(colsT,function(kk,dd){
									if(isNaN(parseFloat(data[kk][i]))==true  && data[kk][i]!="NA" && data[kk][i]!=undefined){
										tempo.push((data[kk][i]).toString());
									}else{
										tempo.push(data[kk][i]);
									}
								});					
								measures.push(tempo);
							}
						}else{
							var tempo=[];
							for(var i=0;i<data.length;i++){
								if(isNaN(parseFloat(data[i]))==true  && data[i]!="NA" && data[i]!=undefined){
									tempo.push((data[i]).toString());
								}else{
									tempo.push(data[i]);
								}
							}
							measures.push(tempo);
						}
					}
					//jQuery("#graph-"+idg).html("");
					//alert(grafico+" "+idg);
					switch(grafico){
						 
						
						case "pie":
							setTimeout(function(){
							acciones.piechart(measures,idg,titulo,indexcustomcolumns);
							},50);
							
						break;
						
						case 'Barras':
							setTimeout(function(){
							acciones.barchart(measures,idg,titulo,indexcustomcolumns);
							},50);
												
						break;
						case 'Tendencia':
							setTimeout(function(){
							acciones.tendencia(measures,idg,titulo,indexcustomcolumns);
							},50);
												
						break;
						case 'Tabla':
							setTimeout(function(){
							acciones.tabla(measures,idg,titulo,indexcustomcolumns);
							},700);
												
						break;
						case 'Numero':
							setTimeout(function(){
							acciones.numero(measures,idg,titulo,indexcustomcolumns);
							},50);
												
						break;
						case 'Selector':
							setTimeout(function(){
							acciones.selector(measures,idg,titulo,indexcustomcolumns);
							},50);
												
						break;					
						case 'Buscador':
							setTimeout(function(){  
								acciones.buscador(measures,idg,titulo,indexcustomcolumns);
							},50);
						break;						
						case 'Barraapilada':
							setTimeout(function(){
								//alert("deberia ser buscador");
								acciones.barraapilada(measures,idg,titulo,indexcustomcolumns);
							},50);
												
						break;						
						case 'Gauge':
							setTimeout(function(){
							acciones.gauge(measures,idg,titulo,indexcustomcolumns);
							},50);
												
						break;	
						
						case 'Html':
							setTimeout(function(){
							acciones.html(measures,idg,titulo,indexcustomcolumns);
							},10);
												
						break;	
					}				
	 
					jQuery("#load").hide();
				}else{ 
				
					if(typeof acciones.intentos[idg]=='number'){
						acciones.intentos[idg]=acciones.intentos[idg]+1;
					}else{
						acciones.intentos[idg]=1;
					}
					acciones.graficar(grafico,idg,temporalQueryb,titulo);
				} 
 			}
		}).responseJSON;		
		
 	},
	guardar:function(){
		return false;
 	},
	misreportes:function(){
		jQuery("#mis_reportes").parent().parent().show();
 		var alto=jQuery("#mis_reportes").parent().height();
  		if(alto>=20){
			jQuery("#mis_reportes").parent().parent().show();
			if(alto<150){
			jQuery("#mis_reportes").parent().css({"height":alto+20+"px","overflow-x":"hidden","overflow-y":"hiden"});
			}else{
				jQuery("#mis_reportes").parent().css({"height":150+"px","overflow-x":"hidden","overflow-y":"scroll"});
			}
			acciones.editar();
		}else{
			jQuery("#mis_reportes").parent().parent().hide();
		} 
		
	},
	editar:function(){
		return false;
	},
	reconstruirreporte:function(id){
		var obj=JSON.parse(jQuery("#preconfig-"+id).text()); 
		var nombre=jQuery("#preconfig-"+id).attr("name");
		var historiback='';
		<?php 	 
				$validar=false;
				$atomsget=array();
				foreach($_GET as $k=>$valor){
					$atom=explode(":",$k);
					if($atom[0]=="param"){
						$validar=true;
						array_push($atomsget,array($atom[1]=>$valor));
					}
				}
				if($validar==true and !isset($_GET["iframe"])){
				?>
					historiback='<div style="float:left"><a href="javascript:history.back();" >VOLVER</a></div>';    
				<?php }
 		?>
		historiback+='<div id="imprime" style="float:right;width:20%"><a href="javascript:;" rel="print" style="float:right;"><img src="//talentracking.com/bateria/img/print.png" width="30" /></a></div>';
 		jQuery("#titulo_reporte").html(historiback+"<h1>"+nombre+"</h1><div style='clear:both'></div>");
 		var html=''; 
		var gpr=[];
		jQuery.each(obj["index"],function(ki,di){
			var k=di;
			var d=obj[k];
 			var li='<li class="ui-state-default fila" id="'+k+'" target="0">';
  			li+='<div   class="titulo" ></div><br>';
 			li+='<ul id="columnas-'+k+'" class="columnas">';
			var tcols=Object.keys(d).length-1;
 			jQuery.each(d["index"],function(jj,td){
				var dd=d[td];
				var kk=td;
 				var configgrafico=dd["configgrafico"];
				var titulo=dd["titulo"];
				var tipografico=dd["tipografico"];
				if(titulo!=undefined){
					var w=jQuery(window).width();
					var width=((100/tcols)-(tcols/10));
					if(w<=600){
						width=98;
					}
				var col='<li class="ui-state-default" id="col-'+kk+'" target="1" style="width: '+width+'%; margin-left: 1px;"><div id="tg-'+kk+'"></div><div class="clear"></div>';
 				col+=' <div id="config-'+kk+'" style="display:none" >'+configgrafico+'</div>';
					col+='</li>';
				li+=col; 
				console.log("TIPO GRAFICO");
				console.log(tipografico+" =>"+titulo);
				gpr.push([kk,tipografico,titulo]);
				}
 			});
			
			li+='</ul>';
			
			li+='<div class="clear"></div>';
			li+='<br>';
			li+='</li>';
			html+=li;
 		});
		jQuery("#reporte").html(html);
//console.log(gpr);		
		setTimeout(function(){
			jQuery.each(gpr,function(id, valores){
				var tempo=JSON.parse(jQuery("#config-"+valores[0]).text());
 				var tquery={"c":tempo["columnas"],"f":tempo["filas"],"fil":tempo["fil"]};
				console.log("NUMERO GRAFICO");
				console.log(valores[1]);
				console.log(valores[0]);
 				switch(valores[1]){
 					
					case '1':
  						acciones.graficar("pie",valores[0],tquery,valores[2]);
 					break;
					
 					case '2':
						acciones.graficar("Barras",valores[0],tquery,valores[2]);
					break;
					case '3':
						acciones.graficar("Tendencia",valores[0],tquery,valores[2]);
					break;
					case '4':
						acciones.graficar("Tabla",valores[0],tquery,valores[2]);
					break;
					case '5':
						acciones.graficar("Numero",valores[0],tquery,valores[2]);
					break;
						
					case '6':
						acciones.graficar("Selector",valores[0],tquery,valores[2]);
					break;					
 						
					case '7':  
						acciones.graficar("Buscador",valores[0],tquery,valores[2]);
					break;
					case '8':  
						acciones.graficar("Barraapilada",valores[0],tquery,valores[2]);
					break;						
 						
					case '9':
						acciones.graficar("Gauge",valores[0],tquery,valores[2]);
					break;	
					case '10':
						acciones.graficar("Html",valores[0],tquery,valores[2]);
					break;					
 						
				}
			});
		},10); 
		jQuery("#load").hide();
 	},
	objquery:function(query){
		var obj=query.split("&");
		var idreporte=null;
		var contar=0;
		var estado=false;
		if(typeof obj =="object"){
			jQuery.each(obj,function(k, d){
				var atom=d.split("=");
				if(typeof atom=="object"  && contar==0 ){
					if(atom[0]=="idr" || atom[0]=="?idr"){
						idreporte=atom[1];
						contar++;
 					}
				}
			});
		}else{
			var atom=query.split("=");
			if(typeof atom=="object"  && contar==0 ){
				if(atom[0]=="idr" || atom[0]=="?idr"){
					idreporte=atom[1];
					contar++;
				}
			}			
		}
		return [contar,idreporte];
	}
	
}
$( function() {
  	acciones.misreportes();
	jQuery("#sidemenu").remove();
	jQuery("#menuleft").remove();
	jQuery(".contentmenu").remove();
	jQuery("#contenedor").attr({"class":"dashboard"});
	jQuery("#mis_reportes").parent().parent().hide();
	jQuery("#contenedor").css({"width":"100%  !important"});
	jQuery(".divContentBlue").css({"background-color":"#fff"});
	
	jQuery("#load").show();
	setTimeout(function(){
	acciones.reconstruirreporte(<?=$idr?>);
	jQuery(".ui-state-default").css({"background-color":"#fff","border":'1px solid rgba(200,200,200,0.4)'});
	
	},50);  
	//jQuery(".ui-state-default").css({"border":"1px solid #fff"});
	
	jQuery("[rel='print']").click(function(){
		jQuery("#buscalo").hide();
		jQuery("#imprime").hide();
		setTimeout(function(){
			//window.print();
			jQuery("#buscalo").show();
			jQuery("#imprime").show();
			
		},200);
	});
var test=getidr();
var validariframe=false;
jQuery.each(test,function(k,valor){
	if(k=="iframe"){
		validariframe=true;
	}
});
if(validariframe==true){
	jQuery("#imprime").remove();
	jQuery("#titulo_reporte").remove(); 
}
	
	
 } );
	
 </script>

 
<div id="content" style="position:relative">
  
		<div class="menudrag">
			 
				<div  id="titulo_reporte"></div> 
				
 <div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
		<div class="crearorigenes">
			<div class="divContentBlue">
				<b>Mis Reportes</b>
				<div class="divContentWhite" style="min-height:5px;overflow-x:hidden;overflow-y:hidden"> 
 						<div id="mis_reportes">
						<? foreach($reportesusuario as $reporte){  
						?>
							<span rel="editar" class="editarreporte" id="rep-<?=$reporte->id?>"><?=$reporte->nombre?><div  id="preconfig-<?=$reporte->id?>" name="<?=$reporte->nombre?>" style="display:none"><?=$reporte->config?></div></span>
						<?
						}?>
						</div> 
  				 <div style="clear:both"></div>
				</div>
			</div>
			<div style="clear:both"></div>
			<div class="divContentBlue">
				<div class="divContentWhite"> 
 						<ul id="reporte">
 						</ul> 
  				 <div style="clear:both"></div>
				</div>
			</div>
			
			
			
		</div>
 		<div style="clear:both"></div>
	 
</div>
