var _getType = function( inp ) {
	var type = typeof inp, match;
	var key;
	if (type == 'object' && !inp) {
		return 'null';
	}
	if (type == "object") {
		if (!inp.constructor) {
			return 'object';
		}
		var cons = inp.constructor.toString();
		if (match = cons.match(/(\w+)\(/)) {
			cons = match[1].toLowerCase();
		}
		var types = ["boolean", "number", "string", "array"];
		for (key in types) {
			if (cons == types[key]) {
				type = types[key];
				break;
			}
		}
	}
	return type;
};

var OBJURL={};
function objectUr(){
	var url=location.search;
	var t=url.split("?");
	var codes="";
	if(t[1]!=undefined){
		var data=t[1].split("&");
		
		var atoms=data[0].split("=");
 		if(atoms[0]=="random"){
			localStorage.setItem("codes", atoms[1]);
			codes=Base64.decode(atoms[1]);
  		}
		
 	}else if(localStorage.getItem("codes")!=""){
		codes=Base64.decode(localStorage.getItem("codes"));
  	}
	if(codes!=""){
		jQuery.getJSON(codes,function(data){
			OBJURL=data;
			selectores(OBJURL);
		});	
	}
}
var objel=[];
function selectores(obj){
	var areas=obj["areas"];
	var empresas=obj["empresas"];
	var uid=obj["uid"];
	var sid=obj["sid"];
	jQuery.each(obj,function(k,d){
		var elemento=k;
		var datos=d;
		var temporal=jQuery(".questiontext:contains('"+elemento+"')").parent().parent().parent().parent().attr("id");
		if(temporal==undefined){
			temporal=jQuery(".question-text:contains('"+elemento+"')").parent().attr("id");
		}
		if(_getType(datos)!="object" && _getType(datos)!="array" ){	
			if(temporal!=undefined){
				jQuery("#"+temporal).hide();
 				var id=temporal.split("question");
				jQuery("[id*='X"+id[1]+"']").val(datos);
			}		
		}else{
			var idinput=jQuery("#"+temporal).find("input").attr("name");
			jQuery("#"+temporal).find("input").remove()
			var htmlt="<select id='answer"+idinput+"' name='"+idinput+"'>";
			htmlt+="<option value=''>Seleccione</option>";
			var emp="";
			objel.push(idinput);
			jQuery.each(datos,function(sk,sd){
 				if(sd.parentid!=undefined){
					emp=sd.parentid;
				}
 				htmlt+="<option value='"+sd.id+"' rel='"+emp+"'>";
				htmlt+=sd.nombre;
				htmlt+="</option>";
 			});
			htmlt+="</select>";
 			jQuery("#"+temporal).find(".question").append(htmlt);
 		}	
 	});
 	jQuery.each(objel,function(k,d){
		jQuery("#answer"+d).change(function(){
			var valor=jQuery(this).val();
			var nextid=objel[k+1];
   			if(nextid!=undefined){
				jQuery("#answer"+nextid).find("[rel]").hide();
				jQuery("#answer"+nextid).find("[rel='"+valor+"']").show();
			}
 		});
 	});
} 
function getUrl(){
	var url=location.search;
	var t=url.split("?");
	var atoms=[];
	var values=[];
 	if(t[1]!=undefined){
		var tob=t[1].split("&");
		jQuery.each(tob,function(k,d){
			var tatoms=d.split("=");
			if(tatoms[1]!=undefined){
				atoms.push({"key":tatoms[0],"val":tatoms[1]});
				values.push(tatoms[0]);
				localStorage.setItem(tatoms[0], tatoms[1]); 
 			}
		});
		//
 		localStorage.setItem("values", JSON.stringify(values)); 

 	}else{
 		if(localStorage.getItem("values")!=""){
			var values=JSON.parse(localStorage.getItem("values"));
			jQuery.each(values,function(k,d){
				var data=localStorage.getItem(d);
				if(data!=""){
					atoms.push({"key":d,"val":data});
				}
			});
 		}
 	}
	return atoms;
}

function autodata(){
	var obj=getUrl();
	
 	var OBJURL;
	
	if(_getType(obj)=="object" || _getType(obj)=="array" ){
		jQuery.each(obj,function(k,d){
			if(d.key=="random"){
				jQuery.getJSON(Base64.decode(d.val),function(data){  
					//OBJURL=JSON.parse(data);
					OBJURL=data;
					jQuery.each(OBJURL,function(kkk,dd){
						var temporal=jQuery(".questiontext:contains('"+dd.key+"')").parent().parent().parent().parent().attr("id");console.log(temporal);
						if(temporal==undefined){
							temporal=jQuery(".question-text:contains('"+dd.key+"')").parent().attr("id");
						}						
						jQuery("#"+temporal).find("input").val(dd.val);
						jQuery("#"+temporal).hide();
 					});
  				});	
 			}else if(d.key=="IDESTRUCTURA"){
				var temporal=jQuery(".questiontext:contains('IDESTRUCTURA')").parent().parent().parent().parent().attr("id");console.log(temporal);
				if(temporal==undefined){
					temporal=jQuery(".question-text:contains('IDESTRUCTURA')").parent().attr("id");
				}						
 				jQuery("#"+temporal).find("input").val(d.val);
				jQuery("#"+temporal).hide();
 			}
 		});
	}
	
}
function guardar(){
	jQuery("#movesubmitbtn").click(function(){
		jQuery.colorbox({html:"<h3>Enviando información, por favor espere un momento</h3>"});
		setTimeout(function(){
			jQuery.colorbox.close();
		},6000);
		
	})
	
	
}

function calcularEdad(dia,mes,ano)
{
          // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
 
       // return edad+" años, "+meses+" meses y "+dias+" días";
        return edad;
	}


function edad(){
	var temporal=jQuery(".questiontext:contains('Edad')").parent().parent().parent().parent().attr("id");console.log(temporal+" edad");
	if(temporal==undefined){
		temporal=jQuery(".question-text:contains('Edad')").parent().attr("id");
	}						
 	if(jQuery("#"+temporal).size()>0){
 		var picker=jQuery(".questiontext:contains('Fecha de Nacimiento')").parent().parent().parent().parent().attr("id");console.log(temporal);
		if(picker==undefined){
			picker=jQuery(".question-text:contains('Fecha de Nacimiento')").parent().attr("id");
		}						
 		if(jQuery("#"+picker).find("input").size()>0){
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
			jQuery("#"+picker).find("input").keypress(function(e){
				if(e.charCode>=48 && e.charCode<=57 ||  e.charCode==45){
					jQuery(this).val("");
				}
			});				 
 			$.datepicker.setDefaults($.datepicker.regional['es']);
  			jQuery("#"+temporal).hide();
			jQuery( "#"+picker ).find("input").datepicker({changeMonth: true,changeYear: true, "dateFormat": "yy-mm-dd",minDate: "-120Y",maxDate: "-18Y","yearSuffix":"Fecha de nacimiento","yearRange":"1920:2050"});
   			jQuery("#"+picker).find("input").change(function(){
				var fecha=jQuery(this).val().split("-");
				if(fecha.length==3){
					if((parseInt(fecha[0])>1920) && (parseInt(fecha[1])>0 && parseInt(fecha[1])<=12) && (parseInt(fecha[2])>0 && parseInt(fecha[2])<=31)){
						var edad= calcularEdad(fecha[2],fecha[1],fecha[0]);
						jQuery("#"+temporal).find("input").val(edad);
					}
				}else{
					alert("La fecha no es valida");
					jQuery( "#"+picker ).find("input").val("");
					jQuery( "#"+picker ).find("input").focus();
				}
			});
		}else if(jQuery("#"+temporal).find(".year").size()>0){
			jQuery("#"+temporal).find(".year,.month,.day").change(function(){
				var fecha=(jQuery("#"+temporal).find(".year").val()+"-"+jQuery("#"+temporal).find(".month").val()+"-"+jQuery("#"+temporal).find(".day").val()).split("-");
				//console.log(fecha);
				if(fecha.length==3){
					if((parseInt(fecha[0])>1920) && (parseInt(fecha[1])>0 && parseInt(fecha[1])<=12) && (parseInt(fecha[2])>0 && parseInt(fecha[2])<=31)){
						var edad= calcularEdad(fecha[2],fecha[1],fecha[0]);
						jQuery("#"+temporal).find("input").val(edad);
					}
				}else{
					alert("La fecha no es valida");
				}
			});		
		
		}
	}
	
	
}
function autocompletar(id,archivo){
   $("#"+id+" input[type=text]").hide();
	var htmlinput='<input type="text" id="od_'+id +'" />';
	$("#"+id+" .question").append(htmlinput);
 
	var cargos = archivo;
  
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
	$('body').on('click', '.ui-menu-item a',function(){
		var values=$("#od_"+id).val();
		//console.log(id);
		$("#"+id+" input[type=text]").val(values);
	});	
	 
}
function cargos(){
	var pathname=(document.location.pathname).split("/");
	var temporal=jQuery(".questiontext:contains('Cargo:')").parent().parent().parent().parent().attr("id");console.log(temporal);
	if(temporal==undefined){
		temporal=jQuery(".question-text:contains('Cargo')").parent().attr("id");
	}						
 	if(jQuery("#"+temporal).size()>0){
		autocompletar(temporal,"/"+pathname[1]+"/cargos.csv");
	}
}
function tiempo(id){
	 
		jQuery("#"+id).hide();
		var obj=jQuery("#"+id).parent();
		var html='<select id="horas">';
 				 html+='<option value="">';
				 html+="Horas";
				 html+='</option>';
			for(var h=0;h<24;h++){
				var hh=h;
				
				if(hh.toString().length==1){
					hh="0"+hh.toString();	
				}
				var text=hh;
 				 html+='<option value="'+hh+'">';
				 html+=text;
				 html+='</option>';
			}

			html+='</select>';
			
			
		html+=':<select id="minutos">';
			 html+='<option value="">';
			 html+="minutos";
			 html+='</option>';
			for(var m=0;m<60;m++){
				var mm=m;
				if(mm.toString().length==1){
					mm="0"+mm.toString();	
				}
				var text=mm;
 				 html+='<option value="'+mm+'">';
				 html+=text;
				 html+='</option>';
			}
		html+='</select>';
			
			
		obj.append(html);	
		jQuery("#horas,#minutos").change(function(){
			var hh=jQuery("#horas").val();
			var mm=jQuery("#minutos").val();
			if(hh=="horas" || hh==""){hh="00";}
			if(mm=="minutos" || mm==""){mm="00";}
				jQuery("#"+id).val(hh+":"+mm);
			
		});	
}
function RemoveAttr(type,attr){
	
	var obj=jQuery("input");
	jQuery.each(obj,function(k,d){
		var atom = jQuery(d);
		if(atom.attr("type")==type){
			atom.removeAttr(attr);
		}
	});
	
}
  
 function solonumeros(query){
	var id=jQuery(".questiontext:contains('"+query+"')").parent().parent().parent().parent().attr("id"); 
	if(id==undefined){
		id=jQuery(".question-text:contains('"+query+"')").parent().attr("id");
	}						
 	if(id!=""){ 
		jQuery("#"+id).find("input").keypress(function(e){
			if(e.charCode>=48 && e.charCode<=57){
				var data=jQuery(this).val();
				if(data.length==1 && !isNaN(data.substring(0, 0))){
					jQuery(this).val(data);
				}else if(data.length>2 && data.length<3){
					var res = data.substring(0, 3);
					jQuery(this).val(res); 
				}else if(data.length>3){
					 
					jQuery(this).val(data.val());
				}
			}else{
				var data=jQuery(this).val();
				if(data.length>0){
					var res1 = data.toString().substring(0,data.length-1);
					jQuery(this).val(res);
					if(data.length==1){
						jQuery(this).val("");
					}
				}
			}
			
		});
	}
}
function anulaopciones(query){
	var obj=jQuery(".answertext:contains('"+query+"')").parent().find("input[type='checkbox']");
	obj.click(function(){
		var test=jQuery(this).is(":checked");
		if(test==true){
			var name=jQuery(this).attr("name");
			var atoms=(jQuery(this).attr("name")).split("X");
 			var quid=parseInt(atoms[2]);
			var objs=jQuery("#question"+quid).find("input[type='checkbox']");
			jQuery.each(objs,function(k,d){console.log(name);
				if(jQuery(d).attr("name")!=name){
					var tempname=jQuery(d).attr("name");
					jQuery(d).removeAttr("checked");
					jQuery("#java"+tempname).val("");
				}
			});
 		}
	});
	jQuery("input[type='checkbox']").click(function(){
		var name=jQuery(this).attr("name");
		var atoms=(jQuery(this).attr("name")).split("X");
		if(((jQuery("#javatbd"+name+":contains('"+query+"')").text()).trim())!=query){
			var quid=parseInt(atoms[2]);
			var objs=jQuery("#question"+quid).find("li:contains('"+query+"')");
			var box=objs.find("input[type='checkbox']");
 			var tempname=box.attr("name");
			box.removeAttr("checked");
			jQuery("#java"+tempname).val("");
		}
	});
}
jQuery(function(){
	//objectUr();
	autodata();
	edad();
	cargos();
	tiempo("answer751388X42X1293");
	jQuery("#saveallbtn").hide();
	jQuery("#loadallbtn").hide();
	jQuery(".clearall").hide();
	RemoveAttr("text","size");
	solonumeros("Altura");
	solonumeros("Peso");
	anulaopciones("NINGUNO");
});
