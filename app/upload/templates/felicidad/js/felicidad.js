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
	var idempresa="";
	var idtoken="";
	if(t[1]!=undefined){
		var data=t[1].split("&");
		
		var atoms=data[0].split("=");
 		if(atoms[0]=="idempresa"){
			localStorage.setItem("idempresa", atoms[1]);
			idempresa=atoms[1];
  		}
		
		var atoms=data[1].split("=");
 		if(atoms[0]=="idtoken"){
			localStorage.setItem("idtoken", atoms[1]);
			idtoken=atoms[1];
  		}
		
 	}else if(localStorage.getItem("idempresa")!=""){
		idempresa=localStorage.getItem("idempresa");
		idtoken=localStorage.getItem("idtoken");
  	}
	if(idempresa!=""){
		 var object=jQuery(".question-text:contains('idempresa')").parent();
		 object.hide();
		 object.find("input").val(idempresa);
	}
	if(idtoken!=""){
		 var object=jQuery(".question-text:contains('idtoken')").parent();
		 object.hide();
		 object.find("input").val(idtoken);
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
			},1000);
  		}
	},500);	
}

function autolink2(){
	
	
	window["conta"]=5;
	var tim=setInterval(function(){
 		if(window["conta"]>=0){
			
			jQuery("#completed").html("<center><b style='font-size:17px'>Revisa tu correo tu diagnóstico esta llegando!</b><br><br><b style='font-size:40px'> "+window["conta"]+"</b></center>");
			window["conta"]--;
		}
		if(window["conta"]==0){
			clearInterval(tim);
			document.location="http://www.talentracking.com";
		}
		
	}, 1000);	
	
	
	
}