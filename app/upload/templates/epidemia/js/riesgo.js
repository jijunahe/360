jQuery(function(){  
  	jQuery(".question-text").css({"width":"99%","background":"#f6f6f6"});
	jQuery(".answertext").show();
	jQuery("#question1425").find("input").css("margin-left","0px");
	jQuery("#question1425 li").attr("style","width: 94px !important;padding-left: 26px !important; padding-top: 9px"); 
	autocompletar("question1424","/hseq/ciudades.csv");
	
	jQuery("#question1597").find("input").css("margin-left","0px");
	jQuery("#question1597 li").attr("style","width: 94px !important;padding-left: 26px !important; padding-top: 9px"); 
	autocompletar("question1600","/hseq/ciudades.csv");
	jQuery(".tools").hide(); 
 	autodata();
	controlEncuesta2();
	pocentajes();
});
function bFixNumAuto  (){return true;}
function LEMradix (){return true;}
function numRegex (valor){
	if( isNaN(valor) ) {
		return false;
	}else{return true;}
	
}
function redondeo(numero, decimales)
{
	var flotante = parseFloat(numero);
	var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
	return resultado;
}


function pocentajes(){
	var total=0;
	jQuery("[name^='294584X97X2096']").on("keyup",function(){
		total=jQuery("[name^='294584X97X2096']").val();
		localStorage.setItem("total", total);
		
		actualizarvalores(total);
		
 	});
	jQuery("input[type='text']").on("keyup",function(){
		var thisval=jQuery(this).val();
		var td=0;
		if(jQuery("[name^='294584X97X2096']").size()==0){
			td=localStorage.getItem("total");
		}else{
			td=jQuery("[name^='294584X97X2096']").val();
		}
		if(td=="" || td==0){
			alert("¿Cuántas personas laboran en su empresa?");
			jQuery(this).val("");
			jQuery("[name^='294584X97X2096']").focus();
			
		}else{
			actualizarvalores(td,jQuery(this));
		}
 	});
	actualizarvalores(total);
}
function actualizarvalores(total,atom=""){
	if(atom==""){
		var objs=jQuery("input[type='text']");
		jQuery.each(objs,function(k,d){
			var td=0;
			if(jQuery("[name^='294584X97X2096']").size()==0){
				td=localStorage.getItem("total");
			}else{
				td=jQuery("[name^='294584X97X2096']").val();
			}
 			var valor=jQuery(d).val();
			var key=jQuery(d).attr("name");
			var oparent=jQuery(d).parent();
			var promedio=0;
			//var excluir=["294584X97X2096"];
 			if(valor>0 ){
				var t=(valor/td)*100;
				promedio=redondeo(t, 2);//console.log(key);
				if(jQuery("#por"+key).size()>0){
					jQuery("#por"+key).html("%"+promedio);
				}else{
					
					oparent.append('<div id="por'+key+'">%'+promedio+'</div>');
				}
 			}
		});
	}else{
		var total=0;
		if(jQuery("[name^='294584X97X2096']").size()==0){
			total=localStorage.getItem("total");
		}else{
			total=jQuery("[name^='294584X97X2096']").val();
		}
 		var t=(atom.val()/total)*100;
		var key=atom.attr("name");
		var oparent=atom.parent();
 		var promedio=redondeo(t, 2);
		if(key=="294584X97X2097mujer"){
			var h=total-atom.val();
			jQuery("[name='294584X97X2097hombre']").val(h);
			var tt=(h/total)*100;
			var	promedio2=redondeo(tt, 2);
			var oparent2=jQuery("[name='294584X97X2097hombre']").parent();
			if(jQuery("#por294584X97X2097hombre").size()>0){
				jQuery("#por294584X97X2097hombre").html("%"+promedio2);
			}else{
				
				jQuery(oparent2).append('<div id="por294584X97X2097hombre">%'+promedio2+'</div>');
			}				
			
			
		}
		if(key=="294584X97X2097hombre"){
			var m=total-atom.val();
			jQuery("[name='294584X97X2097mujer']").val(m);
			var tt=(m/total)*100;
			var	promedio2=redondeo(tt, 2);
			var oparent2=jQuery("[name='por294584X97X2097mujer']").parent();
			if(jQuery("#por294584X97X2097mujer").size()>0){
				jQuery("#por294584X97X2097mujer").html("%"+promedio2);
			}else{
				
				jQuery(oparent2).append('<div id="por294584X97X2097mujer">%'+promedio2+'</div>');
			}			
 		}
		if(jQuery("#por"+key).size()>0){
			jQuery("#por"+key).html("%"+promedio);
		}else{
			
			jQuery(oparent).append('<div id="por'+key+'">%'+promedio+'</div>');
		}
	}
	
} 
function fecha(){
	$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);	
	
	
	
}
 

function autodata(){
	var url=location.search;
	var t=url.split("?");
	var idorg="";
	var idus="";
 	
	if(t[1]!=undefined){
		var data=t[1].split("&");
 		
		for(var i=0;i<data.length;i++){
			var atoms=data[i].split("=");
 			localStorage.setItem(atoms[0], atoms[1]);
  			var object=jQuery(".question-text:contains('"+atoms[0]+"')").parent();
			console.log(object.find(".question-text").text().trim(" ")+"=>"+atoms[0]);
 			if(object.find(".question-text").text().trim(" ")==atoms[0]){
 				object.hide();
				object.find("input").val(atoms[1]);
			} 
 		}
 		
 	}else if(localStorage.getItem("idorg")!=""){
		idorg=localStorage.getItem("idorg");
		idus=localStorage.getItem("idus");
 		if(idorg!=""){
			 var object=jQuery(".question-text:contains('idorg')").parent();
			 if(object.find(".question-text").text().trim(" ")=="idorg"){
				 object.hide();
				 object.find("input").val(idorg);
			 }
		}
		if(idus!=""){
			 var object=jQuery(".question-text:contains('idus')").parent();
			 if(object.find(".question-text").text().trim(" ")=="idus"){
				 object.hide();
				 object.find("input").val(idus);
			 }
		}
		 
	}
}
 function autocompletar(id,archivo){
   $("#"+id+" input[type=text]").hide();
	var htmlinput='<input type="text" id="od_'+id +'" />';
	$("#"+id+" .question").append(htmlinput);
 
	var cargos = "/hseq/cargos.csv";
	var gerencias = "/hseq/gerencias.csv";
 
	var seriesTitle = new Array();
	
 	$.get(archivo,function(data){
		fullArray = $.csv.toArrays(data);
		var obj="[{";
		$(fullArray).each(function(i, item){
			seriesTitle.push(item[0]);
			obj+="'"+item[0]+"':'',";
		});
		obj+="n:''}]";
		
		$("#od_"+id).autocomplete({
			source: seriesTitle
		});
		window['resob']=eval(obj);
 	});	
	$('body').on('click', '#movesubmitbtn',function(){
		var values=$("#od_"+id).val();
		//console.log(id);
		$("#"+id+" input[type=text]").val(values);
	});	
	 
}
function controlEncuesta2(){	
	window["refreshIntervalId"] = setInterval(function(){ 
		if(jQuery("#completed").size()>0){
			clearInterval(window["refreshIntervalId"]);
			setTimeout(function(){
 				autolink2();
			},200);
  		}
	},500);	
}

function autolink2(){
	
	
	window["conta"]=5;
	var tim=setInterval(function(){
 		if(window["conta"]>=0){
			
			jQuery("#completed").html("<center><b style='font-size:17px'>Usted ha finalizado la encuesta, para continuar dirijase al menú de opciones!</b><br><br><b style='font-size:40px'>  </b></center>");
			window["conta"]--;
		}
		if(window["conta"]==0){
			clearInterval(tim);
			//document.location="http://www.talentracking.com/clima/admin";
		}
		
	}, 1000);	
	
	
	
}