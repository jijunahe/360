 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style type="text/css"> 

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
height:40px;
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
//var origenes="";
//var origenesB=[];
var temporalQuery={};
<?php if(count($origenes)>0){
	//echo "origenes='".$origenes."';";
	//echo "origenesB=".$origenesB.";";
}
?>
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
			filabasica+='<div  class="titulo-grafico" ><b>Titulo:</b> <input type="text" class="titulo" />';
			filabasica+='<input type="button" id="drilldown-'+idcol+'" value="Drilldown" /> '; 
			filabasica+='<input type="button" id="customcolumns-'+idcol+'" value="Columnas" /> ';
			filabasica+='<br><b>Tipo Gráfico:</b>';
			filabasica+='<select id="tipografico-'+idcol+'">';
			filabasica+='<option value="1">pie</option>';
			filabasica+='<option value="2">Barras</option>';
			filabasica+='<option value="8">Barra apilada</option>';
			filabasica+='<option value="3">Tendencia</option>';
			filabasica+='<option value="9">Tacómetro</option>';
			filabasica+='<option value="4">Tabla</option>';
			filabasica+='<option value="5">Número</option>';
			filabasica+='<option value="6">Selector</option>';
			filabasica+='<option value="7">Buscador</option>';
			filabasica+='<option value="10">Javascript</option>';
 			filabasica+='</select>';
 			filabasica+='<input type="button" id="customcolors-'+idcol+'" value="Rango colores" />';
			filabasica+='</div>';
			filabasica+='<div id="grafico-'+idcol+'"></div><div class="clear"></div></div>'; 
  			filabasica+='</li>';
 			jQuery("#columnas-"+id).append(filabasica);
			jQuery("#columnas-"+id).find("li").css({width:w+"%",'margin-left':"1px"}); 
 			acciones.activarcolumnas(id);
			acciones.agregargrafico('#grafico-'+idcol);
 			acciones.construir("columna",idcol);
 			acciones.drilldown(idcol);
 			acciones.customcolumns(idcol);
 			acciones.customcolors(idcol);
			

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
						console.log(objson);
						setTimeout(function(){
							try{
							if(objson["filas"]!=null){
								jQuery.each(objson["filas"],function(k,d){ console.log(d)
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
									console.log(objparent)
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
								jQuery.each(objson["columnas"],function(k,d){ console.log(d)
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
									console.log(objparent)
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
 								jQuery.each(objson["filtro"],function(d,filtros){ console.log(filtros+" FILTROS")
									var objparent=jQuery("#colorbox").find("a[name='"+d+"']").parent().attr("class");
									console.log(objparent)
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
									console.log(objparent)
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
							
							
						},2000); 
					 
					}					
					
					
					
				},2000);
				 
  
		 				
			});
			acciones.eventosval.push("agregar-grafico-"+idg);
		//}		
 		
	},
 	acciongrafico:function(idg){   
		 console.log("#tablas-"+idg);
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
		jQuery("[class^='action-"+idg+"']").off('click');
		setTimeout(function(){
			if(jQuery("[class^='action-"+idg+"']").is(":visible")){
			jQuery("[class^='action-"+idg+"']").on('click',function(){
				var tipo=jQuery(this).attr("rel");
				switch(tipo){
					case "play":
						if(jQuery(this).attr("title")=="Ejecutar consulta"){
							var query=temporalQuery;
							var filtros={};
							if(jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div").size()>0){
								var obf=jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div");
								jQuery.each(obf,function(k,d){
									var atomdiv=jQuery(d);
									var id=atomdiv.attr("rel");
									var fls=atomdiv.html();
									if(fls!=""){
									filtros[id]=fls;
									}
								});
							}
							 
							var res=jQuery.ajax({ 
								type: "POST",
								dataType: "json",
								async: true,
								url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/ejecutar",
								data:{id:jQuery("#cboxContent").find("#tablas-"+idg).val(),query:query, filtros:filtros},
								 
								beforeSend:function(xd){jQuery("#load").show();},
								success:function(res){
									 jQuery("#load").hide();
									acciones.testres=res;
									var cols=[];
									var tcols=0;
									var treg=0;
									jQuery.each(res,function(key,val){
										cols.push(key);
										treg=val.length;
										tcols++;
									});
									 
									var html="<table class='tg'>";
									//console.log(treg+" TOTAL REGISTROS TABLA"); 
									if(treg==undefined){
										treg=1;
									}
									for(var i=0;i<treg;i++){
										 
										if(i==0){
											html+="<tr>";
											for(var j=0;j<tcols;j++){
											
												html+="<td class='tg-yw4l'>"; 
												html+=cols[j]; 
												html+="</td>"; 
											}
											html+="</tr>"; 
										} 
										if(treg>1){
											html+="<tr>";
											for(var j=0;j<tcols;j++){
												 
												html+="<td class='tg-yw4l'>"; 
												html+=res[cols[j]][i]; 
												html+="</td>"; 
												 
											} 
											html+="</tr>"; 
										}else if(treg==1){
											html+="<tr>";
											for(var j=0;j<tcols;j++){
												 
												html+="<td class='tg-yw4l'>"; 
												html+=res[cols[j]]; 
												html+="</td>"; 
												 
											} 
											html+="</tr>"; 
											
										}
										 
										 
									}
 									html+="</table>"; 
									jQuery("#cboxContent").find(".resultado-R").html(html); 									 
 								}
							}).responseJSON;
 						}					
					break;
					case "save":
						var query=temporalQuery;
						var filtros={};
						if(jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div").size()>0){
							var obf=jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div");
							jQuery.each(obf,function(k,d){
								var atomdiv=jQuery(d);
								var id=atomdiv.attr("rel");
								var fls=atomdiv.html();
								if(fls!=""){
								filtros[id]=fls;
								}
							});
						}
						jQuery.ajax({ 
							type: "POST",
							dataType: "text",
							async: true,
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/reportes",
							data:{option:"creargrafico",idtabla:jQuery("#cboxContent").find("#tablas-"+idg).val(),query:query, filtros:filtros},
							beforeSend:function(xd){jQuery("#load").show();},
							success:function(res){ 
								 
								var obj=jQuery("#col-"+idg).find("#config-"+idg);
								if(obj.size()==0){
									var htmlconf='<div id="config-'+idg+'" style="display:none">'+res+'</div>';
									jQuery("#col-"+idg).append(htmlconf);
								}else{
									jQuery("#config-"+idg).text(res);
								}
								jQuery.colorbox.close();

								acciones.graficar(jQuery("#tipografico-"+idg).find("[value='"+jQuery("#tipografico-"+idg).val()+"']").text(),idg); 
								setTimeout(function(){
 								jQuery("#load").hide();
								},800);
							}
						});/*.responseJSON;	*/
						
						
	 
					break;
					case "filtro":
						var obj=jQuery(this).parent().parent().parent();
						var namep=jQuery(this).text();
						if(obj.attr("class")=="fields_list_body filter"){
							if(obj.find(".filtrar").size()==0){
								obj.append("<div style='display:none' class='filtrar'></div>");
							}
							jQuery("#load").show();
							var thiscol=jQuery(this).text();
							//console.log(thiscol+" ggggggggggggggggg");							
							var res=jQuery.ajax({ 
							type: "POST",
							dataType: "json",
							async: true,  
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/verdatoscol",
							data:{id:jQuery("#cboxContent").find("#tablas-"+idg).val(),columna:thiscol},
							beforeSend:function(){jQuery("#load").show();  },
 							success:function(res){ 
								var htmlfiltro='<ul>';
								var colum=thiscol;
								var tchecked=[];
								if(jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+namep+"']").size()>0){
									tchecked=jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+namep+"']").text().split("::");
								}
								jQuery.each(res,function(k,v){
									var ch='';
									if(tchecked.indexOf(v)>=0){
										ch=' checked="checked" ';
									}
									htmlfiltro+='<li><input type="checkbox" name="'+colum+'"  value="'+v+'" '+ch+'/>'+v+'</li>';
								});
								htmlfiltro+='</ul>';
								jQuery.expr[':'].icontains = function(a, i, m) {
								  return jQuery(a).text().toUpperCase()
									  .indexOf(m[3].toUpperCase()) >= 0;
								};						


								jQuery("#cboxContent").find(".modal_filtro").find(".valores").html(htmlfiltro);
								jQuery("#cboxContent").find(".modal_filtro").show();
								var texto=jQuery("#cboxContent").find(".vbuscar").val();
								var objs=jQuery("#cboxContent").find(".valores").find("li");
								var availableTags = [];
								jQuery.each(objs,function(k,d){
									availableTags.push(jQuery(d).text());
								}); 

								jQuery("#cboxContent").find(".vbuscar").on('propertychange input',function(e){
									var valueChanged = false;

									if (e.type=='propertychange') {
									valueChanged = e.originalEvent.propertyName=='value';
									} else {
									valueChanged = true;
									}
									if (valueChanged) {
										jQuery.each(objs,function(k,d){
											jQuery(d).hide();
										});
										var textfind=jQuery(this).val();
										 
										var buscar=jQuery("#cboxContent").find(".valores").find("li:icontains('"+textfind+"')");
										jQuery.each(buscar,function(id,li){
											 
											jQuery("#cboxContent").find(".valores").find("li").find("input[value='"+jQuery(li).text()+"']").parent().show();
										}) 
									}
								});
								//setTimeout(function(){
								jQuery("#cboxContent").find("input[value='Cerrar']").on('click',function(){
									var filtrar=jQuery("#cboxContent").find(".valores").find("li").find("input:checked"); 
									var datafiltrer=[];
									var name="";
									console.log("NAMEEEEE");
									if(filtrar.length>0){
										jQuery.each(filtrar,function(h,j){
											name=jQuery(j).attr("name");
											datafiltrer.push(jQuery(j).val());
										});
										
										console.log(name);
										if(jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+name+"']").size()>0){
										jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+name+"']").text(datafiltrer.join("::"));
										}else{
											var html='<div rel="'+name+'" style="display:none">'+datafiltrer.join("::")+'</div>';
											jQuery("#cboxContent").find(".modal_filtro").find(".filtros").append(html);
										}
									}
									jQuery("#cboxContent").find(".modal_filtro").hide();
								});								
								
 								jQuery("#load").hide();
								
								//},5000); 
								
 							}
							});						
							
						}
					
					break;
				}
			});
			}
		},400);
 	},
	getconsulta:function(idg){
		var filas=jQuery("#cboxContent").find("[class*='rows']").find("li");
		var cols=jQuery("#cboxContent").find("[class*='columns']").find("li");
		var filter=jQuery("#cboxContent").find("[class*='filter']").find("li");
		var tempoQuery={f:[],c:[],fil:[]};
		
		jQuery.each(filas,function(k,d){
			if(jQuery(d).find("a").text()!=""){
			tempoQuery["f"].push(jQuery(d).find("a").text());
			}
		});
		
		jQuery.each(cols,function(k,d){
			if(jQuery(d).find("a").text()!=""){
			tempoQuery["c"].push(jQuery(d).find("a").text());
			}
		});
		
		jQuery.each(filter,function(k,d){
			if(jQuery(d).find("a").text()!=""){
 			tempoQuery["fil"].push(jQuery(d).find("a").text());
			}
		});
		temporalQuery=tempoQuery;
 	}, 
	filtrarc:function(idg){
		jQuery("#cboxWrapper").find(".filter").find("a").on('click',function(){
			

			var obj=jQuery(this).parent().parent().parent();
			var namep=jQuery(this).text();
			if(obj.attr("class")=="fields_list_body filter"){
				if(obj.find(".filtrar").size()==0){
					obj.append("<div style='display:none' class='filtrar'></div>");
				}
				var thiscol=jQuery(this).text();
				var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: true,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/verdatoscol",
				data:{id:jQuery("#cboxContent").find("#tablas-"+idg).val(),columna:thiscol},
				beforeSend:function(){jQuery("#load").show(); console.log(1);},
				success:function(res){
 					var htmlfiltro='<ul>';
					var colum=thiscol;
					var tchecked=[];
					if(jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+namep+"']").size()>0){
						tchecked=jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+namep+"']").text().split("::");
					}
					jQuery.each(res,function(k,v){
						var ch='';
						if(tchecked.indexOf(v)>=0){
							ch=' checked="checked" ';
						}
						htmlfiltro+='<li><input type="checkbox" name="'+colum+'"  value="'+v+'" '+ch+'/>'+v+'</li>';
					});
					htmlfiltro+='</ul>';
					jQuery.expr[':'].icontains = function(a, i, m) {
					  return jQuery(a).text().toUpperCase()
						  .indexOf(m[3].toUpperCase()) >= 0;
					};						
					
					
					jQuery("#cboxContent").find(".modal_filtro").find(".valores").html(htmlfiltro);
					jQuery("#cboxContent").find(".modal_filtro").show();
					var texto=jQuery("#cboxContent").find(".vbuscar").val();
					var objs=jQuery("#cboxContent").find(".valores").find("li");
					var availableTags = [];
					jQuery.each(objs,function(k,d){
						availableTags.push(jQuery(d).text());
					}); 
					
					jQuery("#cboxContent").find(".vbuscar").on('propertychange input',function(e){
						var valueChanged = false;

						if (e.type=='propertychange') {
						valueChanged = e.originalEvent.propertyName=='value';
						} else {
						valueChanged = true;
						}
						if (valueChanged) {
							jQuery.each(objs,function(k,d){
								jQuery(d).hide();
							});
							var textfind=jQuery(this).val();
							 
							var buscar=jQuery("#cboxContent").find(".valores").find("li:icontains('"+textfind+"')");
							jQuery.each(buscar,function(id,li){
								 
								jQuery("#cboxContent").find(".valores").find("li").find("input[value='"+jQuery(li).text()+"']").parent().show();
							}) 
						}
					});
					jQuery("#cboxContent").find("input[value='Cerrar']").on('click',function(){
						var filtrar=jQuery("#cboxContent").find(".valores").find("li").find("input:checked"); 
						var datafiltrer=[];
						var name="";
						if(filtrar.length>0){
							jQuery.each(filtrar,function(h,j){
								name=jQuery(j).attr("name");
								datafiltrer.push(jQuery(j).val());
							});
							if(jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+name+"']").size()>0){
							jQuery("#cboxContent").find(".modal_filtro").find(".filtros").find("div[rel='"+name+"']").text(datafiltrer.join("::"));
							}else{
								var html='<div rel="'+name+'" style="display:none">'+datafiltrer.join("::")+'</div>';
								jQuery("#cboxContent").find(".modal_filtro").find(".filtros").append(html);
							}
						}
						jQuery("#cboxContent").find(".modal_filtro").hide();
					});					 
					 
					jQuery("#load").hide();
				}
				}).responseJSON;						

			}			
 	
			
		});
		
	},
	dragable:function(idg){
			
		jQuery("#cboxWrapper").find( ".connectable" ).sortable({
		  revert: true
		});
		jQuery("#cboxWrapper").find( "li" ).draggable({
		  connectToSortable: ".connectable",
		  helper: "clone",
		  revert: "inactive" ,
		  stop: function( event, ui ) { 
 			acciones.getconsulta(idg);
			acciones.filtrarc(idg);
		  }  
		});	
		acciones.tools(idg);
  		jQuery("#cboxWrapper").find(".connectable").find( "li" ).removeAttr("style");
		acciones.droop(idg);
	},
	droop:function(idg){
		jQuery("#cboxWrapper").find(".clear_axis").on('click',function(){
			jQuery(this).parent().find(".connectable").html("");
		});
	},
	confirmareliminar:function(obj){
		var tipo=obj.parent().parent().attr("id").split("-")[0];
		var id=obj.parent().parent().attr("id").split("-")[1];
		if(id!='undefined'){acciones.construir(tipo,id);}else{
			acciones.construir("eliminarfila",tipo);
		}
		
 		obj.parent().parent().remove();
	},
	eliminar:function(item){
		
		jQuery(item).on('click',function(){
			var objp=jQuery(this);
			var padre=jQuery(this).parent().parent().parent();
			var html="<b>Esta seguro de eliminar este elmento ?</b><br><div class='clear'></div>";
			html+="<div style='width:'100%'><input type='button' style='float:left' class='confirmar' value='Si'/>";
			html+="<input type='button' style='float:left; margin-left:2px' class='confirmar' value='No'/></div>";
			jQuery.colorbox({html:html});
			jQuery("#cboxClose").remove();
			var obj=jQuery(this);
			jQuery(".confirmar").on('click',function(){
				var sino=jQuery(this).val();
				if(sino=="Si"){
					acciones.confirmareliminar(obj);
					if(item==".eliminar-columna"){
						var kfila=jQuery(this).parent().parent().parent().parent().attr("id");;
						var col=jQuery(this).parent().parent().attr("id").split("-")[1];
 						var telements=padre.find("li").size();
						var w=100;
						if(telements>0){
 						 w=( (100/(telements)))-0.2;
						}
						padre.find("li").css({width:w+"%",'margin-left':"1px"});
 						delete acciones.dashboard[kfila][col];
					} 
					if(item==".eliminar-fila"){
						var kfila=objp.parent().parent().attr("id");
						delete acciones.dashboard[kfila];
					}
				}
				jQuery.colorbox.close();
			}) 
		});
	},
	 
	activarfilas:function(){
		$( "#reporte" ).sortable();
		$( "#reporte" ).disableSelection();
		acciones.eliminar(".eliminar-fila");
	},
	activarcolumnas:function(id){
		
		$( "#columnas-"+id ).sortable();
		$( "#columnas-"+id ).disableSelection();
		acciones.eliminar(".eliminar-columna");
	},
	getdata:function(objs,temporalQueryb){
			//var query=
			if(typeof temporalQueryb=="object"){
				temporalQuery=temporalQueryb;
			}
 			 
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/ejecutar",
				data:{id:objs["id_cubo"],query:temporalQuery, filtros:objs["filtro"]},
				success:function(res){
					 
				}
			}).responseJSON;
			 console.log(res);
			return res; 
		
	},
	piechart:function(measures,idg){
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
				title: jQuery("#col-"+idg).find("input[class='titulo']").val(),
				pieStartAngle: 100,
			width:"97%", 
			colors:['#ffbb78','#aec7e8','#2ca02c','#98df8a','#d62728','#dcd6d6','#9467bd','#c5b0d5','#8c564b','#c49c94','#e377c2','#f7b6d2']
			};

			var chart = new google.visualization.PieChart(document.getElementById('graph-'+idg));
			chart.draw(data, options);
		
		}
	},
	tendencia:function(measures,idg){
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
				title: jQuery("#col-"+idg).find("input[class='titulo']").val(),
 			width:"97%",
				hAxis: {title:measures[0][0]},
				vAxis: {title: measures[0][1]},
				legend: 'none',
				trendlines: { 0: {} },
			colors:['#ffbb78','#aec7e8','#2ca02c','#98df8a','#d62728','#dcd6d6','#9467bd','#c5b0d5','#8c564b','#c49c94','#e377c2','#f7b6d2']
				
			};

			var chart = new google.visualization.ScatterChart(document.getElementById('graph-'+idg));
			chart.draw(data, options);
		
		}
	},	
	tabla:function(measures,idg){
		//jQuery("#graph-"+idg).html("");
		 google.charts.load('current', {'packages':['table']});
		// console.log("MEASURES");      
		//  console.log(measures);      
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
				title: jQuery("#col-"+idg).find("input[class='titulo']").val(),
				width: '100%', height: '100%', 
				legend: 'none',
				showRowNumber: true,
				pageSize:10
			};

			var chart = new google.visualization.Table(document.getElementById('graph-'+idg));
			chart.draw(data, options);
		
		}
	},
	numero:function(measures,idg){
		var sumatoria=0;
		jQuery.each(measures,function(k,d){ 
			if(k>0){
				sumatoria=sumatoria+parseFloat(d[d.length-1]);
			}
		});
		var html='<div class="number-container">';
		html+='<div class="number-preview">';
		html+='<div class="chartnumber_widget chartnumber_number number-picked chart-pointer" style="background-color: rgb(184, 209, 237);">';
		html+='<strong class="notranslate chartnumber-title">Total</strong>';
		html+='<var class="chartnumber_color3 chartnumber-val">'+sumatoria+'</var><em>'+jQuery("#col-"+idg).find("input[class='titulo']").val()+'</em>';
		html+='</div>';
		html+='</div>';
		html+='</div>';
		jQuery('#graph-'+idg).html(html);
		
	},	
	selector:function(measures,idg){
 		var options='';
		jQuery.each(measures,function(k,d){ 
			if(k>0){
				options+='<option value="'+d[0]+'">'+d[0]+'</option>';
			}
		});
 		var tempo=JSON.parse(jQuery("#config-"+idg).text());
		var html='<b>'+jQuery("#col-"+idg).find("input[class='titulo']").val()+'</b><select id="select-'+idg+'"><option value="-1">Seleccione una opción</option>'+options+'</select>';
		jQuery('#graph-'+idg).html(html); 
 	},
	buscador:function(measures,idg){ 
 		var html='<div style="float:left;width:20%;padding-left:5px"><b>'+jQuery("#col-"+idg).find("input[class='titulo']").val()+':</b></div>';
		html+='<input type="text" id="textbuscar-'+idg+'" style="float:left;width:80%;" /><input type="button" id="buscar-'+idg+'" value="buscar" />';
		
		jQuery('#graph-'+idg).html(html); 
		jQuery('#buscar-'+idg).on("click",function(){
			jQuery.colorbox({html:"<h2>Para probar esta funcionalidad, guarde y luego haga click en previsualizar</h2>", width:"550px","height":"250px"});
		});
		
 	}, 
	barchart:function(measures,idg){
		 
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBarColors);

		function drawBarColors() {// console.log("measures a"); console.log(measures); 
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
			});				
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
			title: jQuery("#col-"+idg).find("input[class='titulo']").val(),
			 
			width:"97%"

		  };
		  
 
		  var chart = new google.visualization.ColumnChart(document.getElementById('graph-'+idg));
		  chart.draw(data, options);
		}		
		
 
		
	},
	editarhtml:function(idg,contenido){
		jQuery("#editar-"+idg+"").on("click",function(){
			var htmlm='<b>Agregue contenido javascript. La variable en javascript (measures es window[\'measuresw\'] y el id del grafico esta como window[\'idgw\'])</b><textarea cols="60" rows="27" id="txthtml-'+idg+'">'+contenido+'</textarea><input type="button" value="Guardar" id="ghtml-'+idg+'" />';
			jQuery.colorbox({html:htmlm,"width":"400px","height":"580px"});
			jQuery("#ghtml-"+idg+"").unbind(); 
			acciones.guardarhtml(idg);
		});
	},
	guardarhtml:function(idg){
		jQuery("#ghtml-"+idg+"").on("click",function(){
			var str = jQuery("#config-"+idg).text();
			str = JSON.stringify(eval('('+str+')'));
			var objson = JSON.parse(str); 
			var html=objson["html"];	
 			var thtml=jQuery("#txthtml-"+idg).val();
 			objson["html"]=Base64.encode(thtml);
			var obj=JSON.stringify(objson); 
			jQuery("#config-"+idg).text(obj);
			jQuery.colorbox.close();
			if(jQuery('#graph-'+idg).parent().find("#editar-"+idg).size()>0){
				jQuery('#graph-'+idg).parent().find("#editar-"+idg).remove();
			}
			jQuery('#graph-'+idg).parent().append("<br><input type='button' id='editar-"+idg+"' value='editar' />");
 			 
			jQuery('#graph-'+idg).html("");
			/*jQuery("<script>")
			.attr({"type":"application/javascript"})
			.text(html)
			.replaceAll('#graph-'+idg).find("<script>");*/			
			
			
			
			jQuery("#editar-"+idg+"").unbind();
			acciones.editarhtml(idg,thtml);
 		});
	},
	html:function(measures,idg){
		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str); 
		if(objson["html"]!=undefined){
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
		jQuery('#graph-'+idg).parent().append("<br><input type='button' id='editar-"+idg+"' value='editar' />");
 		jQuery('#graph-'+idg).html("");
 		/*jQuery("<script>")
		.attr({"type":"application/javascript"})
		.text(html)
		.appendTo('#graph-'+idg);*/ 
 		//Ejecutar javascript
 		//eval(html); 
		acciones.editarhtml(idg,html); 
		}else{ 
			jQuery('#graph-'+idg).parent().append("<br><input type='button' id='editar-"+idg+"' value='editar' />");
			acciones.editarhtml(idg,html);
		}
		
	},
 	gauge:function(measures,idg){
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
			  width: 400, height: 120,
			  redFrom: 90, redTo: 100,
			  yellowFrom:75, yellowTo: 90,
			  minorTicks: 5
			};
			if(colores!=undefined){
				jQuery.each(colores,function(k,d){
					options[k]=d;
				});
			}

			var chart = new google.visualization.Gauge(document.getElementById('graph-'+idg));

			chart.draw(data, options);

 
		}
	},
	barraapilada:function(measures,idg){
		 
 
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBarColors);
		
		console.log("TAMANIO ME =>"+measures.length);
		if(measures.length==2){
  			 var fmeausere=[[],[]];
			jQuery.each(measures,function(k,d){
				if(k==0){
					fmeausere[k].push("ITEM");
				}else{
					fmeausere[k].push(jQuery("#col-"+idg).find("input[class='titulo']").val());
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
			title: jQuery("#col-"+idg).find("input[class='titulo']").val(),
			 legend: { position: 'top', maxLines: 3 },
			width:"97%",
			isStacked: true,
			colors:['#ffbb78','#aec7e8','#98df8a','#2ca02c','#d62728','#dcd6d6','#9467bd','#c5b0d5','#8c564b','#c49c94','#e377c2','#f7b6d2']

		  };
		  
 
		  var chart = new google.visualization.BarChart(document.getElementById('graph-'+idg));
		  chart.draw(data, options);
		}		
		
 
		
	},
	
	
	
	drilldown:function(idg){
		jQuery("#tipografico-"+idg).on("change",function(){
			var tempo=JSON.parse(jQuery("#config-"+idg).text());
			var tquery={"c":tempo["columnas"],"f":tempo["filas"],"fil":tempo["fil"]};
 			var idfila=jQuery("#col-"+idg).parent().attr("id").split("-")[1];
			acciones.dashboard[idfila][idg]["tipografico"]=(jQuery(this).val()).toString(); 
 			switch(jQuery(this).val()){
				case '1':
					acciones.graficar("pie",idg,tquery);
				break;
				case '2':
					acciones.graficar("Barras",idg,tquery);
				break;
				case '3':
					acciones.graficar("Tendencia",idg,tquery);
				break;
				case '4':
					acciones.graficar("Tabla",idg,tquery);
				break;
				case '5':
					acciones.graficar("Numero",idg,tquery);
				break;
					
				case '6':
					acciones.graficar("Selector",idg,tquery);
				break;
					
				case '7':
					acciones.graficar("Buscador",idg,tquery);
				break;
					
				case '8':
					acciones.graficar("Barraapilada",idg,tquery);
				break;
					
				case '9':
					acciones.graficar("Gauge",idg,tquery);
				break;
					
				case '10':
					acciones.graficar("Html",idg,tquery);
				break;
					
			}		
 		});
		jQuery("#drilldown-"+idg).on('click',function(){
			var str = jQuery("#config-"+idg).text();
 			str = JSON.stringify(eval('('+str+')'));
 			var objson = JSON.parse(str);
			var campos=[];
			var test=['columnas','filas'];
			var reportes=jQuery(".editarreporte");
			jQuery.each(objson,function(k,d){
				if(test.indexOf(k)>=0){
					if(typeof d == 'object' && d!=null){   
						jQuery.each(d,function(kk,dd){
							if(campos.indexOf(dd)==-1){
								campos.push(dd);
							}
						})
					}
				}
			});
			var html='<b>Dimensión:</b> <select id="dimorigen-'+idg+'"><option value="-1">Seleccione una dimensión</option>';
			var checked='';
			try{
			if(objson["acciones"][2]!=undefined){
				if(objson["acciones"][2]==1){
					checked=' checked="checked" ';
				}
			}
			}catch(e){}			
 			
			jQuery.each(campos,function(d,k){
				var selected='';
 				if(typeof objson["acciones"]=="object"){
					if(objson["acciones"][0]==k){
						selected='selected="selected"';
					}
					
				}
				html+='<option value="'+k+'" '+selected+'>';
				html+=k;
				html+='</option>';
			});
			html+='</select><br><br><b>Reporte destino: </b><select id="destino-'+idg+'"><option value="-1">Seleccione reporte destino</option>';
			jQuery.each(reportes,function(d,k){
				var atom=jQuery(k).attr("id").split("-")[1];
				var texto=jQuery(k).find("span").text();
				var selected='';
				if(typeof objson["acciones"]=="object"){ 
					if(objson["acciones"][1]==atom){
						selected='selected="selected"';
					}
				}
				html+='<option value="'+atom+'"  '+selected+'>';
				html+=texto;
				html+='</option>';
 			});
			html+='</select><br><br><b>Enviar a modal? </b> <input type="checkbox" name="modal" value="SI" '+checked+' /><br><br><input type="button" value="Guardar" id="guardardrill-'+idg+'">';
			jQuery.colorbox({html:html,"width":"300px","height":"260px"});
			acciones.guardardrill(idg);
			 
		}); 
	},
	guardardrill:function(idg){
		jQuery("#guardardrill-"+idg).on('click',function(){
			if(jQuery("#dimorigen-"+idg).val()!=-1 && jQuery("#destino-"+idg).val()!=-1){
 				var str = jQuery("#config-"+idg).text();
				str = JSON.stringify(eval('('+str+')'));
				var objson = JSON.parse(str);
				var modal=0;
				if(jQuery("[name='modal']").is(":checked")){
					modal=1;
				} 
 				objson["acciones"]=[jQuery("#dimorigen-"+idg).val(),jQuery("#destino-"+idg).val(),modal];
				var obj=JSON.stringify(objson); 
 				jQuery("#config-"+idg).text(obj);
				jQuery.colorbox.close();
			}else{
				alert("Por favor se leccione una dimensión y el reporte destino");
			}
		});
	},
	graficar:function(grafico,idg,temporalQueryb){
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
		 
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/ejecutar",
			data:{id:objson["id_cubo"],query:temporalQuery, filtros:objson["filtro"]},
			beforeSend:function(){jQuery("#load").show(); console.log(1);
							var tload='<center><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" style="width:70%"></center>';
				jQuery("#graph-"+idg).html(tload);

			},
			success:function(R){
 				//console.log(R);
				var colsT=[];
				var data=[];
				jQuery.each(R,function(k,dd){
 					if(indexcustomcolumns.indexOf(k)>=0){
						k=customcolumns[k];
					}
					colsT.push(k);
					data.push(dd);
				});
				
				var tcol=[];
				for(var i=0;i<(colsT.length-1);i++){
					tcol.push(colsT[i]);
				}
 				if(grafico=="pie"){
					var columnas=[tcol.join("-"),colsT[(colsT.length-1)]];
					var measures=[columnas];
					 
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
				
				console.log("T");
				console.log(measures);
 				switch(grafico){
					case "pie":
						setTimeout(function(){
						acciones.piechart(measures,idg);
						},300);
						
					break;
					
					case 'Barras':
						setTimeout(function(){
						acciones.barchart(measures,idg);
						},300);
											
					break;
					case 'Tendencia':
						setTimeout(function(){
						acciones.tendencia(measures,idg);
						},300);
											
					break;
					case 'Tabla':
						setTimeout(function(){
						acciones.tabla(measures,idg);
						},300);
											
					break;
					case 'Numero':
						setTimeout(function(){
						acciones.numero(measures,idg);
						},300);
											
					break;
						
					case 'Selector':
						setTimeout(function(){
						acciones.selector(measures,idg);
						},300);
											
					break;					
 					
					case 'Buscador':
						setTimeout(function(){
						acciones.buscador(measures,idg);
						},300);
											
					break;					
					case 'Barraapilada':
						setTimeout(function(){
						acciones.barraapilada(measures,idg);
						},300);
											
					break;					
 					
					case 'Gauge':
						setTimeout(function(){
						acciones.gauge(measures,idg);
						},300);
											
					break;					
 					
					case 'Html':
						setTimeout(function(){
						acciones.html(measures,idg);
						},300);
											
					break;					
 					
				}				
 
				jQuery("#load").hide();
				acciones.drilldown(idg);
 			}
		}).responseJSON;		
		
 	},
	guardar:function(){
		jQuery("[rel='Guardar']:eq(0)").click(function(){
			var obj=acciones.dashboard; 
			var filas=[];
			jQuery.each(obj,function(fila,columnas){
				filas.push([fila,jQuery("#"+fila).find("input[class='titulo']:eq(0)").val()]);
				jQuery.each(columnas,function(columna,objeto){
					if(columna!="index"){
 						
						var objectsave={"titulo":jQuery("#col-"+columna).find("input[class='titulo']").val(),
										"titulofila":jQuery("#"+columna).find("input[class='titulo']:eq(0)").val(),
										"configgrafico":jQuery("#config-"+columna).text(),
										"tipografico":jQuery("#tipografico-"+columna).val(),
										//"tipografico":1,
										"acciones":{}
										};
						acciones.dashboard[fila][columna]=objectsave;
					}
				});
			});
 			//reordenar
			var filas=[];
 			jQuery.each(jQuery(".fila"),function(k,objeto){
				var columnas=[];
 				var cols=jQuery(objeto).find("li");
				jQuery.each(cols,function(kk,objcol){
					columnas.push(jQuery(objcol).attr("id").split("-")[1]);
				});
 
				filas.push(jQuery(objeto).attr("id"));
				acciones.dashboard[jQuery(objeto).attr("id")]["index"]=columnas;
			});
			acciones.dashboard["index"]=filas;
   			var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/reportes",
						data:{option:"guardarreporte",titulo:jQuery("#titulo_reporte").val(),reporte:JSON.stringify(acciones.dashboard),'id':acciones.id_reporte},
						beforeSend:function(){jQuery("#load").show();},
						success:function(res){
							jQuery("#load").hide();
							jQuery.colorbox({html:"<center><h2>"+res["mensaje"]+"</h2></center>","width":"450px","height":"170px"});
							if(res["estado"]==1){
								acciones.id_reporte=res["id_reporte"];
								 setTimeout(function(){
								//document.location.href=document.location.origin+document.location.pathname+"?idr="+acciones.id_reporte;
								 },2000);
							}
						}
					});			
			
 		});
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
		jQuery("[rel='editar']").click(function(){
			var id=jQuery(this).attr("id").split("-")[1]; 
 			document.location.href=document.location.origin+document.location.pathname+"?idr="+id;
  		});
	},
	tempcustomcols:{},
 	customcolors:function(idg){
 		jQuery("#customcolors-"+idg).on("click",function(){
			var idg=jQuery(this).attr("id").split("-")[1];
			if(jQuery("#config-"+idg).text()!=""){
				var obj=JSON.parse(jQuery("#config-"+idg).text()); 
 				var configcolors=
				{"greenFrom":"Verde mínimo",
				"greenTo":"Verde máximo",
				"yellowFrom":"Amarillo mínimo",
				"yellowTo":"Amarillo máximo",
				"redFrom":"Rojo mínimo",
				"redTo":"Rojo máximo"
				};
				var html='<b>Rangos de color, únicamente Verde, amarillo y rojo</b><br><br>';
				var customcolors={};
				try{
					customcolors=obj["customcolors"];
				}catch(e){}  
				if(customcolors!=undefined){
					jQuery.each(customcolors,function(k,d){
						if( d!=undefined  && d!=null && d!=""){
 							html+="<div style='width:50%;float:left;padding-left:1px'><b>"+configcolors[k]+": </b></div><input type='text'  name='color-"+idg+"' id='"+k+"' value='"+d+"'  style='width:48%;float:left' /><br><br>";
						}
					});
				}else{
					jQuery.each(configcolors,function(k,d){
						html+="<div style='width:50%;float:left;padding-left:1px'><b>"+configcolors[k]+": </b></div><input type='text'  name='color-"+idg+"' id='"+k+"'  style='width:48%;float:left' /><br><br>";
 					});
				} 
				 
				html+="<input type='button' id='guardarcolores-"+idg+"' value='Guardar' />";
				jQuery.colorbox({html:html,width:"500px","height":"400px","overflow-y":"scroll"});
 				acciones.guardarcolores(idg);
 			}
		});		
 	},
	customcolumns:function(idg){
		jQuery("#customcolumns-"+idg).on("click",function(){
			var idg=jQuery(this).attr("id").split("-")[1];
			if(jQuery("#config-"+idg).text()!=""){
				var obj=JSON.parse(jQuery("#config-"+idg).text()); 
				var cols={};
				var html='<b>Nuevo nombre de columna</b><br><br>';
				var customcolumns={};
				try{
					customcolumns=obj["customcolumns"];
				}catch(e){}
				if(obj["columnas"]!=null){
					jQuery.each(obj["columnas"],function(k,d){
						if( d!=undefined  && d!=null && d!=""){
							cols[d]="";
							try{
								cols[d]=customcolumns[d];
							}catch(e){}							
							
							html+="<div style='width:50%;float:left;padding-left:1px'><b>"+d+": </b></div><input type='text'  name='ncols-"+idg+"' id='"+d+"' value='"+cols[d]+"'  style='width:48%;float:left' /><br><br>";
						}
					});
				} 
				if(obj["filas"]!=null){
					jQuery.each(obj["filas"],function(k,d){
						if( d!=undefined && d!=null && d!=""){
							cols[d]="";
							try{
								cols[d]=customcolumns[d];
							}catch(e){}							
 							html+="<div style='width:50%;float:left;padding-left:1px'><b>"+d+": </b></div><input type='text'  name='ncols-"+idg+"' id='"+d+"' value='"+cols[d]+"'  style='width:48%;float:left' /><br><br>";
 						}
					});
				}
				html+="<input type='button' id='guardarcustom-"+idg+"' value='Guardar' />";
				jQuery.colorbox({html:html,width:"500px","height":"400px","overflow-y":"scroll"});
				acciones.tempcustomcols=cols;
				acciones.guardarcustom(idg);
 			}
		});
	},
	guardarcustom:function(idg){
		jQuery("#guardarcustom-"+idg).on("click",function(){
			var idg=jQuery(this).attr("id").split("-")[1];
 			var obj=JSON.parse(jQuery("#config-"+idg).text()); 
			jQuery.each(acciones.tempcustomcols,function(k,d){
				var nvalor=jQuery("#"+k).val();
				if(nvalor.trim(" ")!=""){ 
					acciones.tempcustomcols[k]=nvalor;
				}
			});
			obj["customcolumns"]=acciones.tempcustomcols;
			var obj=JSON.stringify(obj); 
			jQuery("#config-"+idg).text(obj);
			jQuery.colorbox({html:"<h2>Los datos han sido guardados</h2>",width:"500px","height":"200px"});
		});
	},
	guardarcolores:function(idg){
		jQuery("#guardarcolores-"+idg).on("click",function(){
			var configcolors=
			{"greenFrom":"Verde mínimo",
			"greenTo":"Verde máximo",
			"yellowFrom":"Amarillo mínimo",
			"yellowTo":"Amarillo máximo",
			"redFrom":"Rojo mínimo",
			"redTo":"Rojo máximo"
			};			
			
			var idg=jQuery(this).attr("id").split("-")[1];
 			var obj=JSON.parse(jQuery("#config-"+idg).text()); 
			 
			jQuery.each(configcolors,function(k,d){
				var nvalor=jQuery("#"+k).val();
				if(nvalor.trim(" ")!=""){ 
					configcolors[k]=nvalor;
				}
			});
			obj["customcolors"]=configcolors;
			var obj=JSON.stringify(obj); 
			jQuery("#config-"+idg).text(obj);
			jQuery.colorbox({html:"<h2>Los datos han sido guardados</h2>",width:"500px","height":"200px"});
		});
	},
 	reconstruirreporte:function(id){
		var obj=JSON.parse(jQuery("#preconfig-"+id).text()); 
		var nombre=jQuery("#preconfig-"+id).attr("name");
		jQuery("#titulo_reporte").val(nombre);
 		var html=''; 
		var gpr=[];
		var idsg=[];
		var idfila=[];
		jQuery.each(obj["index"],function(ki,di){
			var k=di;
			var d=obj[k];
			var li='<li class="ui-state-default fila" id="'+k+'" target="0">';
			li+='<div class="clear"><img src="<?=Yii::app()->baseUrl?>/img/bad.gif" class="eliminar-fila"></div><br>';
			li+='<div class="atributos">';
			li+='<img src="<?=Yii::app()->baseUrl?>/img/add.gif" id="fila-'+k+'" class="agregar-col">';
			li+='<div class="titulo-fila"><b>Titulo:</b> <input type="text" class="titulo" value=""></div>';
			li+='<div class="clear"></div></div>';
			
			li+='<ul id="columnas-'+k+'" class="columnas">';
			var tcols=Object.keys(d).length-1;
  			jQuery.each(d["index"],function(jj,td){
				var dd=d[td];
				var kk=td;
				console.log(dd);
				var configgrafico=dd["configgrafico"];
				var titulo=dd["titulo"];
				var tipografico=dd["tipografico"];
				if(titulo!=undefined){
					var col='<li class="ui-state-default" id="col-'+kk+'" target="1" style="width: '+((100/tcols)-(tcols/10))+'%; margin-left: 1px;">';
					col+='<div class="clear"><img src="<?=Yii::app()->baseUrl?>/img/bad.gif" class="eliminar-columna"></div><br>';
					col+='<div class="atributos">';
							col+='<img src="<?=Yii::app()->baseUrl?>/img/pie_chart_21427.png" target="grafico-'+kk+'" id="agregar-grafico-'+kk+'" class="agregar-grafico">';
							col+='<div class="titulo-grafico">';
								col+='<b>Titulo:</b> <input type="text" class="titulo" value="'+titulo+'">';
								col+='<input type="button" id="drilldown-'+kk+'" value="Drilldown" />';
								col+='<input type="button" id="customcolumns-'+kk+'" value="Columnas" /> ';
								col+='<br> <b>Tipo Gráfico:</b>';
								col+='<select id="tipografico-'+kk+'">';
								col+='<option value="1">pie</option><option value="2">Barras</option><option value="8">Barra apilada</option>';
								col+='<option value="3">Tendencia</option>';
								col+='<option value="9">Tacómetro</option>';
								col+='<option value="4">Tabla</option>';
								col+='<option value="5">Número</option><option value="6">Selector</option>';
								col+='<option value="7">Buscador</option>';
								col+='<option value="10">Javascript</option>';
								col+='</select>';
							col+='<input type="button" id="customcolors-'+kk+'" value="Rango colores" />';
 							col+='</div>';
							col+='<div id="grafico-'+kk+'"></div><div class="clear"></div>';
						col+='</div><div id="config-'+kk+'" style="display:none" >'+configgrafico+'</div>';
						col+='</li>';
					li+=col; 
					gpr.push([kk,tipografico]);
					idsg.push(kk);
				}
 			});
			
			li+='</ul>';
			
			li+='<div class="clear"></div>';
			li+='<br>';
			li+='</li>';
			html+=li;
			idfila.push(k);
 		});
		jQuery("#reporte").html(html);
 		
		
		jQuery.each(idsg,function(kv,vv){
			acciones.agregargrafico('#grafico-'+vv);
			 
			acciones.activarcolumnas(vv);acciones.drilldown(vv);acciones.customcolumns(vv);	acciones.customcolors(vv);	
		});
		jQuery.each(idfila,function(kv,vv){
			acciones.agregarcolumna(vv); acciones.activarcolumnas(vv);acciones.activarfilas(vv);
		});
		acciones.eliminar(".eliminar-columna"); 
		acciones.eliminar(".eliminar-fila");
//console.log(gpr);		
		setTimeout(function(){
			jQuery.each(gpr,function(id, valores){
				var tempo=JSON.parse(jQuery("#config-"+valores[0]).text());
 				var tquery={"c":tempo["columnas"],"f":tempo["filas"],"fil":tempo["fil"]};
				 jQuery("#tipografico-"+valores[0]).val(valores[1]);
				switch(valores[1]){
					case '1':
  						acciones.graficar("pie",valores[0],tquery);
 					break;
					
 					case '2':
						acciones.graficar("Barras",valores[0],tquery);
					break;
					case '3':
						acciones.graficar("Tendencia",valores[0],tquery);
					break;
					case '4':
						acciones.graficar("Tabla",valores[0],tquery);
					break;
					case '5':
						acciones.graficar("Numero",valores[0],tquery);
					break;
						
					case '6':
						acciones.graficar("Selector",valores[0],tquery);
					break;					
 						
					case '7':
						acciones.graficar("Buscador",valores[0],tquery);
					break;					
 						
					case '8':
						acciones.graficar("Barraapilada",valores[0],tquery);
					break;					
 						
					case '9':
						acciones.graficar("Gauge",valores[0],tquery);
					break;					
 						
					case '10':
						acciones.graficar("Html",valores[0],tquery);
					break;					
 						
				}
			});
		},600);
		//console.log(idfila+" IDFILA");
		
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
	},
	previsualizar:function(){
		jQuery("#previsualizar").click(function(){
			var bl=(document.location.pathname).split("admin/")[0];
 			window.open(document.location.origin+bl+"admin/authentication/sa/dashboard?idr="+jQuery(this).attr("name"), "Dashboard", "width=1000, height=600");
		});
	}
	
}
$( function() {
	acciones.agregarfila();
	acciones.guardar();
	acciones.misreportes();
	acciones.previsualizar();
<?php 
if(isset($_GET["idr"])){
	?>
	acciones.id_reporte=<?=(int)$_GET["idr"]?>;
	var str=jQuery("#preconfig-"+acciones.id_reporte).text();
 	str = JSON.stringify(eval('('+str+')'));
	var objson = JSON.parse(str);	
	acciones.dashboard=objson;
	<?php
}
?>	
	
	
	
	var query=document.location.search;
	if(query!=""){
		var test=acciones.objquery(query);
		if(test[0]>0 && test[1]>0){
			acciones.reconstruirreporte(test[1]);
		}
	}
	
 } );
	
 </script>

<div id="modalgrafico" style="display:none">
	<div id="don-fer-ku">
	<div class="modal_filtro"><div class="clear"></div>
		<div class="buscador">
			
			<div class="ui-widget" style="float:left">
			  <label for="vbuscar">BUSCAR: </label>
			  <input type="text" class="vbuscar" />
			</div>
			<div style="    float: right;    margin-right: 20px;"><input type="button" value="Cerrar"/></div>
 		</div>
		<div class="clear"></div>
		<div class="valores"></div>
		<div class="filtros"></div>
	</div>
	<div id="codigografico" style="display:none"></div>
		<div class="divContentWhite"> 
			<div class="right-pannel" style="height: 564px;">
				<h3 class="top">Tablas</h3>
				<div class="sidebar_inner">
					<select id="tablas" style="width:95%"><option id="-1">Seleccione una tabla</option>
					<? foreach($cubos as $cubo){ ?>
						<option value="<?=$cubo->id?>"><?=$cubo->nombre?></option>
					<? } ?>
					</select>
				</div>
				<h3 class="top">Campos</h3>
				<div class="sidebar_inner dimension_tree">
				</div>
				<h3 >Campos numéricos</h3>
				<div class="sidebar_inner measure_tree"></div>
			</div>
			<div class="sidebar_separator" style="height: 564px;"> </div>
			<div class="workspace_inner">
			
<div class="workspace_toolbar">
	<div>
        <ul>
            <li> 
			 <image src='<?=Yii::app()->baseUrl?>/images/save-all.png' title="Guardar consulta"  class="action" rel='save' />
			 </li>
            <li class="seperator" style="display: block;">
				<image src='<?=Yii::app()->baseUrl?>/images/play.svg' title="Ejecutar consulta"  class="action" rel='play' />
 			</li>
         </ul>
		<div class="clear"></div>
    </div>
</div>			
			
	<div class="clear"></div>		
 			
				<div class="fields_list"  rel="fila"  title="ROWS">
					<div class="fields_list_header limit on"><span class="i18n_translated">Filas</span><span class="dropdown"></span></div>
					<div class="fields_list_body rows">
						<ul class="connectable ui-sortable"  style="min-height:40px">
 						</ul>
					</div>
					<span class="clear_axis i18n_translated" title="Limpiar eje"></span>
					<div class="clear"></div>
				</div>

				<div class="fields_list" rel="columna" title="COLUMNS">
					<div class="fields_list_header limit"><span class="i18n_translated">Columnas</span><span class="dropdown"></span></div>
					<div class="fields_list_body columns">
						<ul class="connectable ui-sortable"  style="min-height:40px">
 
 						</ul>
					</div>
					<span class="clear_axis i18n_translated" title="Limpiar eje"></span>
					<div class="clear"></div>
				</div>
				
				<div class="fields_list"  rel="filtro"  title="FILTER">
					<div class="fields_list_header limit"><span class="i18n_translated">Filtro</span><span class="dropdown"></span></div>
					<div class="fields_list_body filter">
						<ul class="connectable ui-sortable" style="min-height:40px">
  						</ul>
					</div>
					<span class="clear_axis i18n_translated" title="Limpiar eje"></span>
					<div class="clear"></div>
				</div>

				<div class="resultado-R"></div>
				
			
			
			
			</div>
			<div class="left-pannel" style="height: 564px;">
			</div>
		</div>
 		 
		<div style="clear:both"></div>
	</div>
</div>
<div id="content" style="position:relative">
  
		<div class="menudrag">
			<div class="divContentBlue">
				<image src="<?=Yii::app()->baseUrl?>/img/add.gif" width="20" style="cursor:pointer" id="agregar" value="Agregar" />
				<b>Titulo:</b><input type="text"  id="titulo_reporte"/>
				

				<img src="<?=Yii::app()->baseUrl?>/images/save-all.png" title="Guardar" class="action" rel="Guardar">
				<? $name="";if(isset($_GET["idr"])){ $name="name='".(int)$_GET["idr"]."'";}?>
 				<input type="button" value="Previsualizar" id="previsualizar" <?=$name?> />
  				
			</div>
		</div>
		<div style="clear:both"></div>
		<div class="crearorigenes">
			<div class="divContentBlue">
				<b>Mis Reportes</b>
				<div class="divContentWhite" style="min-height:5px;overflow-x:hidden;overflow-y:hidden"> 
 						<div id="mis_reportes">
						<? foreach($reportesusuario as $reporte){  
						?>
							<span rel="editar" class="editarreporte" id="rep-<?=$reporte->id?>"><span><?=$reporte->nombre?></span><div  id="preconfig-<?=$reporte->id?>" name="<?=$reporte->nombre?>" style="display:none"><?=$reporte->config?></div></span>
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
