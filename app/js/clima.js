 

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
	//ajustar();
	/*
	ocultar2("1225");
	ocultar2("1226");
	ocultar2("1227");
	ocultar2("1228");
	ocultar2("1230");
	ocultar2("1370");
	ocultar2("1232");
	ocultar2("1358");
 	ocultar2("1233");
	ocultar2("1244");
	ocultar2("1245");
	ocultar2("1246");
	ocultar2("1247");
	ocultar2("1248");
	ocultar2("1249");
	ocultar2("1250");
	ocultar2("1251");
	ocultar2("1252");
	ocultar2("1267");
	ocultar2("1286");
	ocultar2("1287");
	ocultar2("1288");
	ocultar2("1289");
	ocultar2("1290");
	ocultar2("1291");
	ocultar2("1292");
	ocultar2("1293");
	ocultar2("1307");
	ocultar2("1308");
	ocultar2("1312");
	ocultar2("1309");
	ocultar2("1310");
	ocultar2("1311");
	ocultar2("1372");
	ocultar2("1313");
	ocultar2("1314");
	ocultar2("1315");
	ocultar2("1316");
	ocultar2("1329");
	ocultar2("1330");
	ocultar2("1337");
	ocultar2("1339");
	ocultar2("1338");
	ocultar2("1340");
	ocultar2("1345");
	ocultar2("1346");
	ocultar2("1347");
	ocultar2("1348");
	ocultar2("1349");
	ocultar2("1350");
	ocultar2("1351");
	ocultar2("1352");
	ocultar2("1353");
	ocultar2("1354");
	ocultar2("1355");
	ocultar2("1356");
	ocultar2("1357");
	ocultar2("1359");
	ocultar2("1360");
	ocultar2("1361");
	ocultar2("1362");
	ocultar2("1363");
	ocultar2("1364");
	ocultar2("1365");
 
 	autoacept();
	
	jQuery.colorbox({html:"<h2>Cargando...</h2>"});
	jQuery("#cboxClose").hide();
	setTimeout(function(){
		var or=jQuery("[id^='question']");
		var c=0;
		jQuery.each(or,function(k,d){
			
			if(jQuery(d).is(":visible")){
				c++;
			}
		});
		if(c==0){
			jQuery("#movesubmitbtn").click();
			jQuery("#movenextbtn").click();
		}
		jQuery.colorbox.close();
 	},400);*/
	codes();
});
function ajustar(){
	var obj=jQuery(".tip");
	jQuery.each(obj,function(k,o){
		if(jQuery(o).html()==""){
			jQuery(o).parent().parent().find(".question-text").css({"width":"98%","backgroundColor":"rgb(109,92,157)","margin-left":"5px","color":"#fff","fontWeight":"bold"})
		}else{
			jQuery(o).parent().parent().find(".question-text").css({"backgroundColor":"rgb(178,154,196)","color":"#fff","fontWeight":"bold","min-height":"60px"})
 		}
	});
	
 	$(window).scroll(function (event) {
		var scrollr = $(window).scrollTop();
		var position=$("#question1023").position();
		var res=scrollr-position.top;
		console.log(res);
		var ul=jQuery(".radio-list:eq(0)");
		var size="font-size: 16px; ";
		if(res>0){
			ul=jQuery("#question1023").find(".radio-list");
			size="font-size: 10px;height: 50px !important; ";
		}
		var totales=jQuery(ul).find("li").size();
 		if(jQuery(ul).find("li").size()>0){
			var obli=jQuery(ul).find("li");
			var html="<ul>";
			jQuery.each(obli,function(k,o){
 				html+="<li class='answer-item columna' style='color:#fff;background-color: rgb(178, 154, 196);border-radius: 6px;    "+size+"   font-weight: bold;    text-align: center;'>";
				html+=jQuery(o).find("label").html()+"<div style='clear:both'></div>";
				html+="</li>";
			});
			html+="</ul>";
 			jQuery(".left").html(html);
			if(jQuery(ul).parent().parent().find("[rel='titles']").size()==0){
				jQuery(ul).parent().parent().prepend("<div style='float: right;width: 62%;' rel='titles'>"+html+"</div><div style='clear:both'></div>");
			}
		}
	});	
 	
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
		//jQuery("#movesubmitbtn").click();
	}else{
		try{

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
		}catch(e){console.log("localStorage keys");}
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



function ocultar2(celda){
	if(jQuery("#question"+celda).size()>0){
		jQuery("#question"+celda).hide();
		
		jQuery("#question"+celda).find("[type='text']").val("1");
		var t=jQuery("#question"+celda).find("[type='radio']").length;
		if(t>0){t=t-1;
			jQuery("#question"+celda).find("[type='radio']:eq("+t+")").attr("checked","checked");
		}
		jQuery("#question"+celda).find("[type='checkbox']:eq(0)").attr("checked","checked");
		jQuery("#question"+celda).find("[name^='java']:eq(0)").val("Y");

		jQuery("#question"+celda).find("[name^='day']").find("option:eq(1)").attr("selected","selected");
		jQuery("#question"+celda).find("[name^='month']").find("option:eq(1)").attr("selected","selected");
		jQuery("#question"+celda).find("[name^='year']").find("option:eq(1)").attr("selected","selected");
		
		jQuery("#question"+celda).find("select").find("option:eq(1)").attr("selected","selected");
	}
	
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
 
function getvar(){
	var obj=(document.location.search).split("?")[1];
	var objects={};
	if(obj!=undefined){	obj=obj.split("&");
		jQuery.each(obj,function(k,d){
			var atoms=d.split("=");
			objects[atoms[0]]=atoms[1];
		});
	}
	return objects;
} 
 
function getDatajson(){
	try{
	var objects=getvar();
	//if(objects.length>0){	
		var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
		var decodedString = Base64.decode(objects["random"]);
		jQuery.getJSON(decodedString,function(d){
			jQuery.each(d,function(k,dd){
				if(jQuery(".question-text:contains('"+dd["key"]+"')").size()>0){
					var object=jQuery(".question-text:contains('"+dd["key"]+"')").parent();
					jQuery(object).find("input").val(dd["val"]);
					jQuery(object).hide();
				}
			})
			 
		});
	//}
	}
	catch(e){console.log("function getDatajson");}
	 
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
	 
	 getDatajson();
 })