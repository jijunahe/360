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
});

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
	var visita="";
	var tipo="";
	var idform="";
	
	if(t[1]!=undefined){
		var data=t[1].split("&");
 		
		for(var i=0;i<data.length;i++){
			var atoms=data[i].split("=");
 			localStorage.setItem(atoms[0], atoms[1]);
			console.log(atoms);
 			var object=jQuery(".question-text:contains('"+atoms[0]+"')").parent();
			if(object.text().trim(" ")==atoms[0]){
 				object.hide();
				object.find("input").val(atoms[1]);
			}
 		}
 		
 	}else if(localStorage.getItem("idorg")!=""){
		idorg=localStorage.getItem("idorg");
		idus=localStorage.getItem("idus");
		visita=localStorage.getItem("visita");
		tipo=localStorage.getItem("tipo");
		idform=localStorage.getItem("idform");
		if(idorg!=""){
			 var object=jQuery(".question-text:contains('idorg')").parent();
			 if(object.text().trim(" ")=="idorg"){
				 object.hide();
				 object.find("input").val(idorg);
			 }
		}
		if(idus!=""){
			 var object=jQuery(".question-text:contains('idus')").parent();
			 if(object.text().trim(" ")=="idus"){
				 object.hide();
				 object.find("input").val(idus);
			 }
		}
		if(visita!=""){
			 var object=jQuery(".question-text:contains('visita')").parent();
			 if(object.text().trim(" ")=="visita"){
				 object.hide();
				 object.find("input").val(visita);
			 }
		}
		if(tipo!=""){
			 var object=jQuery(".question-text:contains('tipo')").parent();
			 if(object.text().trim(" ")=="tipo"){
				 object.hide();
				 object.find("input").val(tipo);
			 }
		}
		if(idform!=""){
			 var object=jQuery(".question-text:contains('idform')").parent();
			 if(object.text().trim(" ")=="idform"){
				 object.hide();
				 object.find("input").val(idform);
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
			
			jQuery("#completed").html("<center><b style='font-size:17px'>Usted ha finalizado La evaluación del sistema de gestión del riesgo de enfermedades cardiovasculares y otras enfermedades crónicas, para continuar dirijase al menú de opciones!</b><br><br><b style='font-size:40px'>  </b></center>");
			window["conta"]--;
		}
		if(window["conta"]==0){
			clearInterval(tim);
			//document.location="http://www.talentracking.com/clima/admin";
		}
		
	}, 1000);	
	
	
	
}