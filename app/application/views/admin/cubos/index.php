 <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<style type="text/css"> 
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
 	width: 45%;
	
}
.origenes{
	float:left;
 	width: 100%
}
.contenedorcubos{
	float:right;
 	width: 45%;
	 
}
</style>
<script>
var origenes=[];
<?php if(count($origenes)>0){
	echo "origenes=".json_encode($origenes).";";
}
?>
var cubos=[];
<?php if(count($cubos)>0){
	echo "cubos=".json_encode($cubos).";";
}
?>
window["dimensiones"]=[];
var Base64={
	_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}
	}

var acciones={
	guardar:function(){
 		jQuery("#guardar").click(function(){
			if(jQuery("[name='nombre']").val()!="" && jQuery("[name='tablas']").val()!=""){
				var idorigen=jQuery("[name='origenes']").val();
				var idtabla=jQuery("[name='tablas']").val();
				var dimensiones=Base64.encode(JSON.stringify(window["dimensiones"]));
				//console.log(dimensiones)
				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/cubos",
					data:{idtabla:idtabla,idorigen:idorigen,option:"guardar",tokenid:dimensiones,nombre:jQuery("[name='nombre']").val()},
					success:function(res){
					}
				}).responseJSON;
				if(res[0]==true || res[0]=="true"){
					alert("El cubo ha sido creado exitosamente");
					setTimeout(function(){
					document.location=document.location.href;
					},2000);
				}else{
					alert("El cubo no ha sido guardado, por favor intente de nuevo.");
				}
 			}else{
				if(jQuery("[name='tablas']").val()==-1){
 					alert("Seleccione una tabla");
				}
				if(jQuery("[name='nombre']").val()=="" ){
					alert("Escriba un nombre para el cubo");
				}
 			}
		});
	},
	instanciar:function(tabla,id){
		if(jQuery("[name='tablas']").val()!=-1){ 
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/cubos",
				data:{tabla:tabla,id:id,option:"instanciar"},
				success:function(res){
				}
			}).responseJSON;		
 			 var html="";
			jQuery.each(res,function(k,d){ 
				//html+="<div id='"+k+"' style='padding:4px;cursor:pointer;float:left;margin-left: 2px;box-shadow:2px 2px 5px #999999'>"+d['campo']+"</div>";
				
				html+="<div id='"+k+"' style='padding:4px;float:left;margin-left: 2px;box-shadow:2px 2px 5px #999999'><div style='padding:4px;float:left;'  >"+d['campo']+"</div><div style='padding:4px;cursor:pointer;float:left'><image src='<?=Yii::app()->baseUrl?>/images/edit.png' style='width:20px' target='"+k+"' class='editardim' /></div> ";
				html+="<div style='padding:4px;cursor:pointer;float:left'><image src='<?=Yii::app()->baseUrl?>/images/delete.png' style='width:20px' target='"+k+"' class='eliminardim' /></div> ";
				html+="<div style='padding:4px;cursor:pointer;float:left'></div></div>";
				
				
				window["dimensiones"].push([d['campo'],d['tipo']]);
			});
			jQuery("#instancias").html(html+"<div style='clear:both'></div>");
			jQuery(".origenes").show();  
		}
	},

	instancia:function(){
		jQuery("[name='tablas']").change(function(){
			acciones.instanciar(jQuery(this).val(),jQuery("[name='origenes']").val());
		});
	},
	tablas:function(id){
		var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/cubos",
					data:{id:id,option:"tablas"},
					success:function(res){
					}
				}).responseJSON;
		var htmll="<select name='tablas'><option value='-1' >Seleccione una tabla</option>";
 		jQuery.each(res,function(k,d){
			htmll+="<option value='"+d['0']+"'>";
			htmll+=d['0'];
			htmll+="</option>";
		});
		htmll+="</select><div style='clear:both'></div><input type='button' id='guardar' value='Guardar' >";
 		jQuery("#tablas").html("<b>Tablas</b><br>"+htmll);
		jQuery("#tablas").show();
		acciones.instancia(); 
		acciones.guardar();
	},
	editar:function(k){
		var cubo=cubos[k];
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/cubos",
			data:{id:cubo["id"],option:"getcubo"},
			success:function(res){
			}
		}).responseJSON;
		if(res[0]==true || res[0]=="true"){
			var config={"idorigen":"origenes","tabla":"tablas"};
			jQuery.each(res[1],function(k,d){
				if(jQuery("[name='"+config[k]+"']").size()>0){
					jQuery("[name='"+config[k]+"']").val(d);
				}
			});
			jQuery("[name='nombre']").val(res[2]);
			 var html="";
			jQuery.each(res[3],function(k,d){ 
				html+="<div id='"+k+"' style='padding:4px;float:left;margin-left: 2px;box-shadow:2px 2px 5px #999999'><div style='padding:4px;float:left;'  >"+d[0]+"</div><div style='padding:4px;cursor:pointer;float:left'><image src='<?=Yii::app()->baseUrl?>/images/edit.png' style='width:20px' target='"+k+"' class='editardim' /></div> ";
				html+="<div style='padding:4px;cursor:pointer;float:left'><image src='<?=Yii::app()->baseUrl?>/images/delete.png' style='width:20px' target='"+k+"' class='eliminardim' /></div> ";
				html+="<div style='padding:4px;cursor:pointer;float:left'></div></div>";
				window["dimensiones"].push([d[0],d[1]]);
			});
			jQuery("#instancias").html(html+"<div style='clear:both'></div>");
			jQuery(".origenes").show();  			
			
			
			
		}
 	},
	eliminar:function(k){
		if(confirm("Eliminar?")){
			var cubo=cubos[k];
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/cubos",
				data:{id:cubo["id"],option:"eliminar"},
				success:function(res){
				}
			}).responseJSON;
			if(res[0]==true || res[0]=="true"){
				alert("El cubo ha sido eliminado");
				setTimeout(function(){
				document.location=document.location.href;
				},800);
			}else{
				alert("El cubo no ha sido eliminado, por favor intente de nuevo.");
			}
		}
  	}
}
jQuery(function(){
	jQuery("[name='origenes']").change(function(){
		if(jQuery(this).val()>0){
			acciones.tablas(jQuery(this).val());
		}
 	});
	jQuery(".editar").click(function(){
		var k=jQuery(this).attr("target");
		acciones.editar(k);
	});
	 
	jQuery(".eliminar").click(function(){
		if(confirm("Tenga en cuenta que es posible que el cubo este asociado a reportes. Decea eliminar?")){
			var k=jQuery(this).attr("target");
			acciones.eliminar(k);
		}
	});
	 

})
</script>
 
<div id="content" style="position:relative">
  
		<div class="crearorigenes">
			<div class="divContentBlue">
				<h1>Configuración de cubo</h1>
				<div class="divContentWhite"> 
					<b>Nombre</b><br>
					<input type="text" name="nombre" /><br>
					<b>Origenes de datos</b><br><select name="origenes" ><option value="-1">Seleccione un origen de datos</option>
					<?php 
					foreach($origenes as $datos){
						?>
						<option value="<?=$datos->id?>"><?=$datos->nombre?></option>
						<?php
					}
					?>
					</select>
					<br>
					<div style="display:none" id="tablas">
					</div>
 				 <div style="clear:both" ></div>
 				</div>
			</div>
		</div>
		<div class="contenedorcubos">
			<div class="divContentBlue">
				<h1>Cubos</h1>
				<div class="divContentWhite"  style="    height: 200px;    overflow: scroll;    overflow-x: hidden;">
					<ul> 
 					<?php
 						foreach($cubos as $k=>$cubo){
							?>
							<li>
							 
							<div style="float:left; width:45%"><?=$cubo->nombre?></div>
							<div style="float:left; width:45%">
								<div style="float:left; width:45%; cursor:pointer" target="<?=$k?>" class="editar" id="<?=$cubo->nombre?>">Editar</div>
								<div style="float:left; width:45%; cursor:pointer" target="<?=$k?>" class="eliminar" id="<?=$cubo->nombre?>">Eliminar</div>
							</div>
 							</li>
							<?php
						}
 					?>
					</ul>
 					<div style="clear:both" ></div>
				</div>
				<div style="clear:both" ></div>
			</div>
 		</div>
		<div class="origenes" style="display:none"><br>
			<div class="divContentBlue">
				<h2>Previsualización</h2> 
				<div class="divContentWhite" id="instancias">
					 
				</div>
			</div>
			<div style="clear:both"></div><br>
		</div>
		
		<div style="clear:both"></div>
	 
</div>
