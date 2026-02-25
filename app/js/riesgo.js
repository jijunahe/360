 

var LEMradix=0;

jQuery(function(){


	jQuery("#movenextbtn span.ui-button-text").css({"float":"left"});
	jQuery(".ui-icon-triangle-1-e").css({"float":"left","bottom": "-6px"});

	//var OBJ=jQuery(".navigator").clone();OBJ.find("button").css({"top":"9px"}); jQuery("ul.tools").append("<li>"+OBJ.html()+"</li>");

	jQuery(".navigator").css({"margin-top": "20px"});
	//jQuery(".navigator").hide()
	jQuery("#privacy").css({"clear":"both"});
	jQuery("#title").hide();

	jQuery("#surveydescription span").css({"font-family":"tahoma,geneva,sans-serif"});
	jQuery("#privacy").remove();
	//jQuery("#loadallbtn").remove();
	jQuery(".tools").remove();

	//CABECERA

	jQuery("#head").css({"position": "fixed","z-index": "999","width": "100%"});
	jQuery("#limesurvey").css({"margin-top": "105px"});
	jQuery("#footer").css({"position": "fixed"});
	jQuery("#content").css({"overflow-x": "hidden"});

	var alto=parseInt(jQuery("#container").css("height"))+1200;
	//console.log(parseInt(jQuery("#container").css("height")));
	//console.log(alto);
	jQuery("#container").attr("style","height:"+alto+"px !important");
	//console.log(parseInt(jQuery("#container").css("height")));

	 jQuery("#completed").attr("style","margin-top: 20%");
	 jQuery("#tokenmessage").attr("style","margin-top: 20%");
  
});

 

$(function() {
	//autocompletar("question251","/hseq/cargos.csv");
  	//edades("year317614X32X703","day317614X32X703","month317614X32X703","question716");
 	//referencia("317614X32X744");
	//ocultar("317614X32X704");
 	//opciones("question410", "answer431454X15X410SQ010");
 	//altura("answer431454X14X638");
 	//peso("answer431454X14X614");
  	//horas("answer431454X15X462");
 	//tiempo("answer317614X32X715");
	
	//referencia("146,147,148,149");
	ajustar();
	autoacept();
	codes();
	guardar();
});
function cargando(){
	jQuery.colorbox({html:"<h1>Cargando datos, espere un momento por favor</h1>",scrolling:false});
	jQuery("#cboxClose").remove();
	jQuery("#cboxOverlay").click(function(){
		cargando();
	});	
}
function guardar(){
	jQuery("#movesubmitbtn").click(function(){
		var test=jQuery(this).attr("id");
		var validadrerror=jQuery(".input-error").size();
		if(validadrerror==0){
			cargando();
  		}
		
	});
	
	
}
function ajustar(){
	var obj=jQuery(".tip");
	jQuery.each(obj,function(k,o){
		if(jQuery(o).html()==""){
			jQuery(o).parent().parent().find(".question-text").css({"width":"98%","backgroundColor":"rgb(109,92,157)","margin-left":"5px","color":"#fff","fontWeight":"bold"})
		}else{
			jQuery(o).parent().parent().find(".question-text").css({"backgroundColor":"rgb(178,154,196)","color":"#fff","fontWeight":"bold","min-height":"60px"})
 		}
	});
	
	var ul=jQuery(".radio-list:eq(0)");
	
	if(jQuery(ul).find("li").size()>0){
		var obli=jQuery(ul).find("li");
		var html="<ul  >";
		jQuery.each(obli,function(k,o){
			html+="<li class='answer-item columna' style='color:#fff;background-color: rgb(178, 154, 196);border-radius: 6px;    height: 31px !important;'>";
			html+=jQuery(o).find("label").html();
			html+="</li>";
		});
		html+="</ul>";
		
		jQuery(".left").html(html);
		jQuery(ul).parent().parent().prepend("<div style='float: right;width: 62%;'>"+html+"</div><div style='clear:both'></div>");
	}
	
	
	
}
function autoacept(){
	var se=document.location.search;
	var data=se.split("?")[1];
	if(data!=undefined){
		data=data.split("&");
		var key=[];
		for(var i=0;i<data.length;i++){
			var td=data[i].split("=");
 			console.log(td[0]);
			if(td[0]=="sid"){
				if(td[1]==296378){
 				}else{
					if(jQuery("#welcome").size()>0){
						jQuery("#welcome").hide();
						jQuery("input").hide();
						jQuery("label").hide();
						jQuery("#movenextbtn").click(); 
					}
 				}
			}
		}
	}
	
}
function edades(year,day,month,question){
	if(jQuery("#"+year).size()>0 && jQuery("#"+day).size()>0 && jQuery("#"+month).size()>0){$("#"+question).hide();}
 	jQuery("#"+year+",#"+day+",#"+month).change(function(){
		 
		if(jQuery("#"+day).val()!="" && jQuery("#"+month).val()!="" && jQuery("#"+year).val()!=""){
			 
			var fechaCumpleanios=jQuery("#"+day).val()+"/"+jQuery("#"+month).val()+"/"+jQuery("#"+year).val();
			var f = new Date();
			var fechaHoy=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
 			if(f.getFullYear()>jQuery("#"+year).val()){
 				var test=restaFechas(fechaCumpleanios,fechaHoy);
				 
				var edad=test/365;
 				 var valida=edad.toString().split(".");
 				 $("#"+question+" input[type=text]").val(valida[0]);
			}
		}
	});	
	
	
	
	
}

function codes(){
	var se=document.location.search;
	var data=se.split("?")[1];
	if(data!=undefined){
		data=data.split("&");
		var key=[];
		for(var i=0;i<data.length;i++){
			var td=data[i].split("=");
			localStorage.setItem(td[0], td[1]);
			key.push(td[0]);
		}
		localStorage.setItem("keys", key);
		if(jQuery("[id^='question']").size()>0){
 			var keys=localStorage.getItem("keys").split(",");
			var obj=jQuery("[id^='question']").find(".question-text");
			jQuery.each(obj,function(k,d){
				var temp=jQuery(d).text();
				temp=temp.replace("*","");
				temp=temp.replace(" ","");
				temp=temp.replace("\n","");
				temp=temp.replace("\t","");
				temp=temp.split("\n").join("");
				temp=temp.trim();
				if(keys.indexOf(temp)>=0){
					var data=localStorage.getItem(keys[keys.indexOf(temp)]);
					var id=jQuery(d).parent().attr("id");
					jQuery(d).parent().find("input").val(data);
					jQuery(d).parent().hide();
				}
			});		
 		}
	}else{
		var keys=localStorage.getItem("keys").split(",");
		var obj=jQuery("[id^='question']").find(".question-text");
		jQuery.each(obj,function(k,d){
			var temp=jQuery(d).text();
			temp=temp.replace("*","");
			temp=temp.replace(" ","");
			temp=temp.replace("\n","");
			temp=temp.replace("\t","");
			temp=temp.split("\n").join("");
			temp=temp.trim();
			if(keys.indexOf(temp)>=0){
				var data=localStorage.getItem(keys[keys.indexOf(temp)]);
 				var id=jQuery(d).parent().attr("id");
				jQuery(d).parent().find("input").val(data);
				jQuery(d).parent().hide();
  			}
 		});
 	}
}

function referencia(codigopregunta){
	var campos=codigopregunta.split(",");
	var keys=["programacion","area","idus","sid"];
 	if(jQuery("#question"+campos[0]).size()==0){ 
		var se=document.location.search;
		var data=se.split("?")[1];
		if(data!=undefined){
			data=data.split("&");
			for(var i=0;i<data.length;i++){
				var td=data[i].split("=");
				localStorage.setItem(td[0], td[1]);
			}
 		}
 	}else{
 		//jQuery.cookie("rf");
 		for(var i=0;i<campos.length;i++){
			 jQuery("#question"+campos[i]).hide();
		}
 		var programacion="";
 		var area="";
 		var idus="";
 		var sid="";
		if(localStorage.getItem("programacion")!=undefined && localStorage.getItem("programacion")!="undefined" &&  localStorage.getItem("programacion")!=""){
			 programacion=localStorage.getItem("programacion");
			 area=localStorage.getItem("area");
			 idus=localStorage.getItem("idus");
			 sid=localStorage.getItem("sid");
			 
			for(var i=0;i<keys.length;i++){
				jQuery("#question"+campos[i]).find("input[id*='answer']").val(eval(""+keys[i]+""));
			}
  		}else{
 			var se=document.location.search;
			var data=se.split("?")[1];
 			data=data.split("&");
			for(var i=0;i<data.length;i++){
				var td=data[i].split("=");
				localStorage.removeItem(td[0]);
				localStorage.setItem(td[0], td[1]);
			}
   		}
		//console.log("ffffffffffffffffffff"+valor);
		
		
		//localStorage.removeItem("rf");
	}
	
}


function ocultar(celda){
	var ex=celda.split("X")[2];
	jQuery("#question"+ex).hide();
	
	jQuery("#answer"+celda+"Y").attr("checked","checked");
	
	
}



function tiempo(id){
	 
		jQuery("#"+id).hide();
		var obj=jQuery("#"+id).parent();
		var html='<select id="horas">';
 				 html+='<option value="">';
				 html+="HH";
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
			 html+="mm";
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
			if(hh=="HH" || hh==""){hh="00";}
			if(mm=="mm" || mm==""){mm="00";}
				jQuery("#"+id).val(hh+":"+mm);
			
		});	
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
	$('body').on('click', '.ui-menu-item a',function(){
		var values=$("#od_"+id).val();
		//console.log(id);
		$("#"+id+" input[type=text]").val(values);
	});	
	 
}
 
 function opciones(padre, negado){
	 
	 jQuery("#"+padre+" input[type='checkbox']").click(function(){
 		var elemento=jQuery(this).attr("id");
		if(elemento!=negado){
			if(jQuery(this).is(":checked")){
				if(jQuery("#"+negado).is(":checked")){
					jQuery("#"+negado).click();
				}
			}
		}else if(elemento==negado){
			if(jQuery(this).is(":checked")){
				jQuery("#"+padre+" input[type='checkbox']").each(function(key,obj){
					var el=jQuery(obj).attr("id");
 					if(el!=negado){
						jQuery(obj).removeAttr("checked");
					}
				})
			}
		}
 	});
	 
}
 function peso(id){
	 
	jQuery("#"+id).keypress(function(e){console.log(e.charCode)
		if(e.charCode>=48 && e.charCode<=57){
			var data=jQuery(this).val();
			var valida=data.substring(0, 1);
			if(valida>4 && !isNaN(valida)){
				if(data.length==2 ){
					jQuery(this).val(data+".0");
				}else if(data.length>3 && data.length<5){
					var res = data.substring(0, 4);
					jQuery(this).val(res); 
				}else if(data.length>3){
					var res = data.substring(0, 6);
					var valida=res.toString().split(".");
					console.log(valida)
					if(valida[1]==undefined){
						 var res1 = valida[0].substring(0,1);
						 var res2 = valida[1].substring(0, 1);
						 res=res1+"."+res2;
						 console.log(res)
					}
					jQuery(this).val(res);
				}
			}else if(valida<=4 && !isNaN(valida)){
				if(data.length==3){
					jQuery(this).val(data+".0");
				}else if(data.length>4 && data.length<6){
					var res = data.substring(0, 5);
					jQuery(this).val(res); 
				}else if(data.length>4){
					var res = data.substring(0, 6);
					var valida=res.toString().split(".");
					console.log(valida)
					if(valida[1]==undefined){
						 var res1 = valida[0].substring(0,1);
						 var res2 = valida[1].substring(0, 1);
						 res=res1+"."+res2;
						 console.log(res)
					}
					jQuery(this).val(res);
				}			
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
 function altura(id){
	 
	jQuery("#"+id).keypress(function(e){
		if(e.charCode>=48 && e.charCode<=57){
			var data=jQuery(this).val();
			if(data.length==1 && !isNaN(data.substring(0, 0))){
				jQuery(this).val(data+".");
			}else if(data.length>2 && data.length<3){
				var res = data.substring(0, 3);
				jQuery(this).val(res); 
			}else if(data.length>3){
				var res = data.substring(0, 4);
				var valida=res.toString().split(".");
				console.log(valida)
				if(valida[1]!=undefined){
					 var res1 = valida[0];
					 var res2 = valida[1].toString().substring(0, 2);
					 res=res1+"."+res2;
					 console.log(res)
				}else if(valida[1]==undefined){ 
					 var res1 = res.toString().substring(0,0);
					 var res2 = res.toString().substring(1, 2);
					 res=res1+"."+res2;
				}
				jQuery(this).val(res);
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
 function horas(id){
	jQuery("#"+id).keypress(function(e){
		if(e.charCode>=48 && e.charCode<=57){
			var data=jQuery(this).val();
			if(data.length==2 && !isNaN(data.substring(0, 1))){
				jQuery(this).val(data+":00");
			}else if(data.length>3 && data.length<5){
				var res = data.substring(0, 5);
				jQuery(this).val(res);
			}else if(data.length>5){
				var res = data.substring(0, 5);
				var valida=res.toString().split(":");
				
				if(valida[1]==undefined){
					 var res1 = valida[0].substring(0, 1);
					 var res2 = valida[1].substring(0, 1);
					 res=res1+":"+res2;
				}
				jQuery(this).val(res);
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
 function restaFechas(f1,f2)
 {
	 var aFecha1 = f1.split('/'); 
	 var aFecha2 = f2.split('/'); 
	 var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
	 var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
	 var dif = fFecha2 - fFecha1;
	 var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
	 return dias;
 }
 
 
 jQuery(function(){
		jQuery(".navigator").hide();
		jQuery("#accepta").click(function(){
			var estado=jQuery(this).is(":checked");
			if(estado==true){
				
				jQuery(".navigator").fadeIn("slow");
			}else{
				jQuery(".navigator").fadeOut("slow");
			}
		});
		
		jQuery("[rel='terminos']").click(function(){
			 var html='<div style="float:right"><img rel="cerrar" src="/bateria/img/cerrar.svg" style="    width: 41px;cursor:pointer" /></div><div style="clear:both"></div>';
			 html+=jQuery("#modal").html();
			jQuery.colorbox({html:html,width:'90%',height:'80%'});
			jQuery("[rel='cerrar']").click(function(){
				jQuery.colorbox.close();
				})
		});
	 var testGroups=jQuery(".group").size();
	 if(testGroups>0)jQuery(".navigator").fadeIn("slow");
 })