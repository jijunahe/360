 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!--script type="text/javascript" src="<?=Yii::app()->baseUrl?>/js/Concurrent.Thread.js"></script-->
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
								url: "<?=Yii::app()->baseUrl?>/index.php/admin/bi/ejecutar",
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
							//console.log(res);
							
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

								acciones.piechart(idg);
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
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/bi/verdatoscol",
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
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/bi/verdatoscol",
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
						
						var telements=padre.find("li").size();
						var w=100;
						if(telements>0){
 						 w=( (100/(telements)))-0.2;
						}
						padre.find("li").css({width:w+"%",'margin-left':"1px"});
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
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/bi/ejecutar",
				data:{id:objs["id_cubo"],query:temporalQuery, filtros:objs["filtro"]},
				beforeSend:function(){jQuery("#load").show(); console.log(1);},
				success:function(res){
					
					 
				}
			}).responseJSON;
			 console.log(res);
			 jQuery("#load").hide();
			 return res; 
		
	},
	drilldown:function(chart,idg,data,measures){
		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str);
		function selectHandler() {
			  var selectedItem = chart.getSelection()[0];
			   
			  if (selectedItem) {
				var topping = data.getValue(selectedItem.row, 0);
				var toppingB = data.getValue(selectedItem.row,1);
				var dim=measures[0][0].split("-");
				var t=dim.length-1;
				console.log('The user selected ' + topping);
				console.log(dim[t]);
				console.log(toppingB);
				if(typeof objson["acciones"]=="object"){
					if(objson["acciones"][1]!="" && objson["acciones"][0]!=""){
						document.location.href=document.location.origin+document.location.pathname+"?idr="+objson["acciones"][1]+"&param:"+objson["acciones"][0]+"="+topping;
					}
				}
			  }
		}			
		google.visualization.events.addListener(chart, 'select', selectHandler);		
		
		
	},
	piechart:function(measures,idg,titulo){
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
			
			acciones.drilldown(chart,idg,data,measures);   
 			chart.draw(data, options);
 		}
  	},
 	tendencia:function(measures,idg,titulo){
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
			acciones.drilldown(chart,idg,data,measures);   
 			chart.draw(data, options);
		
		}
	},	
	tabla:function(measures,idg,titulo){
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
			var options = {
				title: titulo,
				width: '100%', height: '100%', 
				legend: 'none',
				showRowNumber: true,
				pageSize:10
			};

			var chart = new google.visualization.Table(document.getElementById('graph-'+idg));
			acciones.drilldown(chart,idg,data,measures);   
 			chart.draw(data, options);
 		}
	},
	numero:function(measures,idg,titulo){
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
	selector:function(measures,idg,titulo){
 		var options='';
		jQuery.each(measures,function(k,d){ 
			if(k>0){
				options+='<option value="'+d[0]+'">'+d[0]+'</option>';
			}
		});
 		var tempo=JSON.parse(jQuery("#config-"+idg).text());
		var html='<b>'+titulo+'</b><select id="select-'+idg+'"><option value="-1">Seleccione una opción</option>'+options+'</select>';
		jQuery('#graph-'+idg).html(html); 
 	},
	barchart:function(measures,idg,titulo){
		 
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawBarColors);

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
			pieStartAngle: 100,
			width:"97%"

		  };
 			var chart = new google.visualization.BarChart(document.getElementById('graph-'+idg));
			acciones.drilldown(chart,idg,data,measures);   
			chart.draw(data, options);
		}		
		
 
		
	},
 	graficar:function(grafico,idg,temporalQueryb,titulo){
 		var str = jQuery("#config-"+idg).text();
		str = JSON.stringify(eval('('+str+')'));
		var objson = JSON.parse(str);
		 
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
		
		?>
		
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/bi/ejecutar?<?=join("&",$filter)?>",
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
					 console.log(R);
					for(var i=0;i<data[0].length;i++){
						var me=[];
						var t=[];
						jQuery.each(colsT,function(kk,dd){
							if(isNaN(parseFloat(data[kk][i]))==true){
 								me.push((data[kk][i]).toString());
 							}else{
								t.push(data[kk][i]);
							}
						});
						var tempo=[];
						console.log("T");
						console.log(t);
						for(j=0;j<=(me.length);j++){  
							 if(  me[j]!=undefined){
 								 tempo.push(me[j]);
							 } 
						}
						for(j=0;j<=(t.length);j++){  
							 if(  t[j]!=undefined){
 								 tempo.push(parseFloat(t[j]));
							 } 
						}
						  
						measures.push(tempo);
					}					
 					console.log(measures);
 				}
				
  				switch(grafico){
					 
					
					case "pie":
						setTimeout(function(){
						acciones.piechart(measures,idg,titulo);
						},300);
						
					break;
					
					case 'Barras':
						setTimeout(function(){
						acciones.barchart(measures,idg,titulo);
						},300);
											
					break;
					case 'Tendencia':
						setTimeout(function(){
						acciones.tendencia(measures,idg,titulo);
						},300);
											
					break;
					case 'Tabla':
						setTimeout(function(){
						acciones.tabla(measures,idg,titulo);
						},300);
											
					break;
					case 'Numero':
						setTimeout(function(){
						acciones.numero(measures,idg,titulo);
						},300);
											
					break;
 					case 'Selector':
						setTimeout(function(){
						acciones.selector(measures,idg,titulo);
						},300);
											
					break;					
 				}				
 
				jQuery("#load").hide();
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
			console.log(acciones.dashboard); 
			console.log(filas); 
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
								document.location.href=document.location.origin+document.location.pathname+"?idr="+acciones.id_reporte;
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
				if($validar==true){
				?>
					historiback='<a href="javascript:history.back();" >VOLVER</a><br><br><br>';    
				<?php }
 		?>
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
 				/*/console.log("DDDDDDD");console.log(dd);*/  
				var configgrafico=dd["configgrafico"];
				var titulo=dd["titulo"];
				var tipografico=dd["tipografico"];
				if(titulo!=undefined){
				var col='<li class="ui-state-default" id="col-'+kk+'" target="1" style="width: '+((100/tcols)-(tcols/10))+'%; margin-left: 1px;">';
 				col+=' <div id="config-'+kk+'" style="display:none" >'+configgrafico+'</div>';
					col+='</li>';
				li+=col; 
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
				console.log(valores);
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
 						
				}
			});
		},600);
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
	acciones.agregarfila();
	acciones.guardar();
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
	
	},600);
	//jQuery(".ui-state-default").css({"border":"1px solid #fff"});
		 
	
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
