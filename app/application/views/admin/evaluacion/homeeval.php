<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>

						
					 <style>
 .selected_r{ background-color:rgb(128,255,255);}
.selected_comp{ background-color:#000;}



#pswd_info {
  position: relative;
  width: 250px;
  padding: 15px;
  background: #fefefe;
  font-size: .875em;
  border-radius: 5px;
  box-shadow: 0 1px 3px #ccc;
  border: 1px solid #ddd;
}

#pswd_infob {
  position: relative;
  width: 250px;
  padding: 15px;
  background: #fefefe;
  font-size: .875em;
  border-radius: 5px;
  box-shadow: 0 1px 3px #ccc;
  border: 1px solid #ddd;
}
#pswd_info h4 {
  margin: 0 0 10px 0;
  padding: 0;
  font-weight: normal;
}
#pswd_info::before {
  content: "\25B2";
  position: absolute;
  top: -12px;
  left: 45%;
  font-size: 14px;
  line-height: 14px;
  color: #ddd;
  text-shadow: none;
  display: block;
}

#pswd_infob::before {
  content: "\25B2";
  position: absolute;
  top: -12px;
  left: 45%;
  font-size: 14px;
  line-height: 14px;
  color: #ddd;
  text-shadow: none;
  display: block;
}

.invalid {
   padding-left: 22px;
  line-height: 24px;
  color: #ec3f41;
}
.valid {
   padding-left: 22px;
  line-height: 24px;
  color: #3a7d34;
}
#pswd_info {
   display: none; 
}
#pswd_infob {
   display: none; 
}
.escalas{
	width:100%;
}
.escalas input{
	margin-left:45%;
}
.descriptores{
	width:100%;
}
   #menualternativo{
	   display:none;
   }
 
 #resolver_encuesta .list-group{margin:0px;} 
  @media only screen and (max-width: 935px){
	#menureducido {
		display: none !important;
	}
}  
  @media only screen and (max-width: 934px){
.limebutton {
    display: block !important;
}
}
@media only screen and (max-width: 855px) {
   .escalas{
	   width:20%;
	   float:left;
   }
   .clearescalas{
	   clear:none !important;
   }
   .escala{
	   clear:both;
	   width:95% !important;
	   height:45px;
   }
   .escalas input{
		margin-left:0%;
	}
    .descriptores{
	   width:75%;
	   float:left;
   }

   .descriptor{
	   clear:both;
	   width:95% !important;
	   height:45px;
	   text-align:left !important;
   }

}
@media only screen and (max-width: 768px) {
 
   #menualternativo{
	   display:block;
   }
   #menureducido{
	   display:none;
   }
   
   #inicial{
	   display:none;
   }
   #page-wrapper{margin:0px;}
   
   #logomenu img{width:232px !important;}
   #barra{height:120px !important;}
   #menualternativo{margin-top:20px;}
   
 
}
@media only screen and (max-width: 766px) {
 
  
   #logomenu img{width:232px !important;}
   #barra{height:120px !important;}
   #menualternativo{margin-top:20px;}
 
}
@media only screen and (max-width: 596px) {
 
  
   #pswd_info,#pswd_infob{
		position:unset !important;
		clear:both !important ;
   
   }
   #menualternativo  a{padding:5px !important; font-size:12px;}
   #menualternativo  li{padding:5px !important; font-size:12px;}
 
}

@media only screen and (max-width: 450px) {
 
   #menualternativo{margin-top:18px !important;}
   #menualternativo  a{padding:5px !important; font-size:12px;}
   #menualternativo  li{padding:5px !important; font-size:12px;}
  
}

</style>
<script type="text/javascript">
 function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
var acciones={
	paginaactual:{"p":1},
	pagifinal:{"p":1},
	guardarencuesta:function(){
 		var objres=jQuery("[rel='preguntas']");
		var objrespa=jQuery("[rel='preguntas_abiertas']").find("textarea");
		 
		var respuesta={};
		var comentarios={};
		jQuery.each(objres,function(k,d){
			var res=jQuery(d).find(".selected_r").val();
			var keyid=jQuery(d).find(".key").attr("rel");
			respuesta[keyid]=res;
			if(jQuery("[rel='comentario_"+keyid+"']").val()!=""){
			comentarios[keyid]=jQuery("[rel='comentario_"+keyid+"']").val();
			}
		});
		
		var respuestapa={};
		
		jQuery.each(objrespa,function(k,d){
			var res=jQuery(d).val();
			var keyid=jQuery(d).attr("id");
			respuestapa[keyid]=res;
 		});
		
	   
		var validar=true;
		var nexto="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/guardarencuesta";
		var incompleto=0;
		jQuery.each(jQuery("[id^='pg_"+acciones.paginaactual['p']+"_']"),function(k,d){
			if(jQuery(d).find(".selected_r").size()==0){
				//jQuery(d).find(".panel-default").css({"border-color":"red"})
				incompleto++;
			}else{
				jQuery(d).find(".panel-default").css({"border-color":"#ddd"});
			}
		});//incompleto=0
		nexto="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/guardarencuestatemporalmente"; /*
		if(incompleto>0){
			validar=false;
			if(confirm("No ha completado la encuesta, sin embargo puede guardar temporalmente. Desea continuar?")){
				nexto="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/guardarencuestatemporalmente";
				validar=true;
			}
			
		}	*/
		if(validar==true){
			var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: nexto,
			data:{keyidproyecto:'<?=$keyidproyecto?>',respuesta:respuesta,respuestapa:respuestapa,comentarios:comentarios,guardar:"1","keyidp":acciones.keyid["key"]},
			success:function(res){
				if(res[0]=="ok"){
					setTimeout(function(){
					jQuery("#resolver_encuesta").scrollTop(1);
					},2000);
				}
			}});
		}
 		
	},
	prevencuesta:function(){
	jQuery("[rel^='adc_']").off(); 
	jQuery("[rel^='adc_']").on("click",function(){
		var keyid=jQuery(this).attr("rel").split("_")[1];
		jQuery("#comentar_"+keyid).show();
		jQuery(this).hide();
	}); 
		 
	jQuery("[rel^='delc_']").off(); 
	jQuery("[rel^='delc_']").on("click",function(){
		if(confirm("Está seguro de cancelar? El comentario no será tenido en cuenta")){
		var keyid=jQuery(this).attr("rel").split("_")[1];
		jQuery("#comentar_"+keyid).hide();
		jQuery("[rel='comentario_"+keyid+"']").val("");
		jQuery("[rel='adc_"+keyid+"']").show();
		}
	}); 
		 
	jQuery("[rel='avanzar']").off()	 
	jQuery("[rel='avanzar']").on("click",function(){
		if(acciones.paginaactual['p']>=1){
			var validar=false;
 			var incompleto=0;
			jQuery.each(jQuery("[id^='pg_"+acciones.paginaactual['p']+"_']"),function(k,d){
				if(jQuery(d).find(".selected_r").size()==0){
					jQuery(d).find(".panel-default").css({"border-color":"red"})
 					incompleto++;
				}else{
					jQuery(d).find(".panel-default").css({"border-color":"#ddd"});
				}
			});//incompleto=0
			if(incompleto==0){
				acciones.paginaactual['p']=acciones.paginaactual['p']+1;
				if(acciones.paginaactual['p']<=acciones.pagifinal["p"]){
					jQuery("[id^='pg_']").hide();
					jQuery("[id^='pg_"+acciones.paginaactual['p']+"_']").fadeIn();
					acciones.guardarencuesta();
					setTimeout(function(){
					jQuery("#resolver_encuesta").scrollTop(1);
					},500);	
					if(acciones.paginaactual['p']>1){
						jQuery("[rel='retroceder']").show();
					}else{jQuery("[rel='retroceder']").hide();}
					
				} 
				if(acciones.paginaactual['p']==acciones.pagifinal["p"] && acciones.pagifinal["p"] >1){
					jQuery("[rel='avanzar']").hide();
					jQuery("[rel='guardar']").show();
					jQuery("[rel='retroceder']").show();
 				}
			}else{
				var w=500+"px";
			if(jQuery("body").width()<=510){
			w=98+"%";
			}
				jQuery.colorbox({html:"<center><h2>Una o más preguntas obligatorias no han sido respondidas. No puede continuar hasta que se hayan completado.</h2></center>",width:w,"height":"300px"});

			}
		}
	});	 
		 
	jQuery("[rel='retroceder']").off()	 
	jQuery("[rel='retroceder']").on("click",function(){
		if(acciones.paginaactual['p']>1){
			
			var validar=false;
 			var incompleto=0;
			jQuery.each(jQuery("[id^='pg_"+acciones.paginaactual['p']+"_']"),function(k,d){
				if(jQuery(d).find(".selected_r").size()==0 && jQuery(d).find(".abierta").size()==0){
					jQuery(d).find(".panel-default").css({"border-color":"red"})
 					incompleto++;
				}else{
					jQuery(d).find(".panel-default").css({"border-color":"#ddd"});
				}
			});
			if(incompleto==0){
				acciones.paginaactual['p']=acciones.paginaactual['p']-1;
				if(acciones.paginaactual['p']<=acciones.pagifinal["p"]){
					jQuery("[id^='pg_']").hide();
					jQuery("[id^='pg_"+acciones.paginaactual['p']+"_']").fadeIn();
					acciones.guardarencuesta();
					setTimeout(function(){
					jQuery("#resolver_encuesta").scrollTop(1);
					},500);					

				}
				jQuery("[rel='avanzar']").show();
				jQuery("[rel='guardar']").hide();
				if(acciones.paginaactual['p']==1){
					jQuery("[rel='retroceder']").hide();
				}
				
			}else{
								var w=500+"px";
			if(jQuery("body").width()<=510){
			w=98+"%";
			}
				jQuery.colorbox({html:"<center><h2>Una o más preguntas obligatorias no han sido respondidas. No puede continuar hasta que se hayan completado.</h2></center>",width:w,"height":"300px"});

			}
 		}
	});	 
		 
		 
	 jQuery("#resolver_encuesta").find("[type='button']").on("off");
	 jQuery("#resolver_encuesta").find("[type='button']").on("click",function(){
		 var keyidp=jQuery(this).attr("name");
		 if(keyidp!="" && keyidp!="undefined" && keyidp!=undefined){
			 jQuery.each(jQuery("[name='"+keyidp+"']"),function(k,d){
				 jQuery(d).removeClass("selected_r");
			 });
			 jQuery(this).addClass("selected_r"); 
		 }		 

	 });
	 
	 jQuery("[rel='guardar']").on("off");
	 jQuery("[rel='guardar']").on("click",function(){
 		var objres=jQuery("[rel='preguntas']");
		var objrespa=jQuery("[rel='preguntas_abiertas']").find("textarea");
		 
		var respuesta={};
		var comentarios={};
		jQuery.each(objres,function(k,d){
			var res=jQuery(d).find(".selected_r").val();
			var keyid=jQuery(d).find(".key").attr("rel");
			respuesta[keyid]=res;
			if(jQuery("[rel='comentario_"+keyid+"']").val()!=""){
			comentarios[keyid]=jQuery("[rel='comentario_"+keyid+"']").val();
			}
		});
		
		var respuestapa={};
		
		jQuery.each(objrespa,function(k,d){
			var res=jQuery(d).val();
			var keyid=jQuery(d).attr("id");
			respuestapa[keyid]=res;
 		});
 	   
		var validar=true;
		var nexto="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/guardarencuesta";
		var incompleto=0;
		jQuery.each(jQuery("[id^='pg_"+acciones.paginaactual['p']+"_']"),function(k,d){
			if(jQuery(d).find(".selected_r").size()==0 && jQuery(d).find(".abierta").size()==0 ){
				jQuery(d).find(".panel-default").css({"border-color":"red"})
				incompleto++;
			}else{
				jQuery(d).find(".panel-default").css({"border-color":"#ddd"});
			}
		});     
		//incompleto=0
		if(incompleto>0){
			validar=false;
			var w=500+"px";
			if(jQuery("body").width()<=510){
			w=98+"%";
			}
			jQuery.colorbox({html:"<center><h2>Una o más preguntas obligatorias no han sido respondidas. No puede continuar hasta que se hayan completado.</h2></center>",width:w,"height":"300px"});
 		}	
		if(validar==true){
			var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: nexto,
			data:{keyidproyecto:'<?=$keyidproyecto?>',respuesta:respuesta,respuestapa:respuestapa,comentarios:comentarios,guardar:"1","keyidp":acciones.keyid["key"]},
			success:function(res){
				if(res[0]=="ok"){
					var w=500+"px";
					if(jQuery("body").width()<=510){
					w=98+"%";
					}					
					
					//jQuery.colorbox({html:"<center><h2>La encuesta ha sido guardada</h2></center>",width:w,"height":"150px"});
					jQuery("#resolver_encuesta").html(jQuery("#agradecimientos").html()); 
					jQuery("#guardar").html(""); 
					//setTimeout(function(){document.location=document.location.origin+""+document.location.pathname;},5000);
					jQuery("a[id='"+acciones.keyid["key"]+"']").css({"color":"green"});
				}if(res[0]=="ok2"){
										var w=500+"px";
					if(jQuery("body").width()<=510){
					w=98+"%";
					}	
					jQuery.colorbox({html:"<center><h2>La encuesta ha sido guardada temporalmente</h2></center>",width:w,"height":"150px"});
				 	setTimeout(function(){document.location=document.location.origin+""+document.location.pathname;},5000);
				}if(res[1]==0){
									var w=500+"px";
			if(jQuery("body").width()<=510){
			w=98+"%";
			}
					jQuery.colorbox({html:"<center><h2>Algo paso, por favor intentelo más tarde, o contacte al administrador del sistema</h2></center>",width:w,"height":"300px"});
				}
			}});
		}

		 

	 });
	 
 	 
	 
	 
	},
	keyid:{"key":0},
	encuesta:function(){
		jQuery("[rel='evaluacion']").off();
 		jQuery("[rel='evaluacion']").on("click",function(){ 
		
			jQuery("#resolver_encuesta").attr({"style":"height:"+(jQuery("body").height()-240)+"px;overflow-x:hidden;overflow-y:scroll"});   
		
		
		
			acciones.validareset();
			jQuery("#resolver_encuesta").fadeOut();
			var id=jQuery(this).attr("id");
			acciones.keyid["key"]=id;
			jQuery("#resolver").find("strong").html(jQuery(this).text());
			jQuery("#resolver").show();
			var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/encuesta",
					data:{keyidproyecto:'<?=$keyidproyecto?>',keyid:id},
					success:function(res){
						if(res[0]=="ok"){jQuery("#resolver_encuesta").fadeIn();
							jQuery("#resolver_encuesta").html("");
							//var encuesta='<div class="list-group" id="resolver_encuesta"></div>';
							//jQuery.colorbox({html:encuesta,width:"90%","height":"90%"});
							var datosencuesta=res[1]["proyecto"]["contexto"];
							var nombreproyecto=res[1]["proyecto"]["nombre"];
							
							var respuestast=[];
							var comentariost=[];
							var comentariosrespuestast=[];
							if(res[1]["temporales"]!=undefined && res[1]["temporales"]!='undefined' ){
							 respuestast=res[1]["temporales"]["respuestas"];
							 comentariost=res[1]["temporales"]["comentarios"];
							 comentariosrespuestast=res[1]["temporales"]["comentariosrespuestas"];
							}
							var contador=0;
							var tpreg=1;
							var pagina=1;
							jQuery.each(datosencuesta,function(k,d){
								
								var categoria=d["categoria"];
								var descripcion=d["descripcion"];
								var keyid=d["keyid"];
								var titulo='<h4>'+categoria+'</h4>';
								var desc="";
								if(descripcion!=""){
									 
									desc='<li class="list-group-item"><div class="panel-heading"><strong>'+descripcion+'</strong></div><div style="clear:both"></div></li>';
									 
								} 								
								
								
								if(keyid=="generico"){
									categoria=nombreproyecto;
									titulo='<h4>'+categoria+'</h4>'+desc;
								}else{
									titulo='<h4>'+categoria+'</h4>'+desc;
								}
								
								
								if(categoria=="NOTITLE"){
									categoria=nombreproyecto;
									titulo='<h4>'+categoria+'</h4>';
									if(contador>0){
									titulo='';
									}
								}
								
								titulo='';
 								
									
									var categorias='<div class="col-lg-12">'+titulo;
									var preguntas=d["preguntas"];
									jQuery.each(preguntas,function(kk,pp){
										var escala='<br><div style="clear:both"></div>';
										var descripcionescala=""; 
										if(res[2][0]!="ok"){
 											escala+='<div class="col-lg-6">';
											for(var i=1;i<=5;i++){
												escala+='<div class="col-lg-1">';
												escala+='<input type="button" name="'+pp["keyid"]+'"  style="width:30px;height:30px" value="'+i+'" />';
												escala+='</div>';
												escala+='<div class="col-lg-1"><b></b>';
												escala+='</div>';
												
											}
											 escala+='<div style="clear:both"></div>';
											 escala+='</div>';
										}else{
											

											
											//escala+='<div class="col-lg-12">';
											//escala+='<div class="col-lg-12" rel="escalas">';
											escala+='<div   class="escalas">';
											
											
											var testcols=((redondeo((12/res[2][2]),0)));

											if(testcols*12>12){
												testcols=testcols-1;
											}											
											
											var wha=jQuery("#resolver_encuesta").width()-150;
											var whb=wha/res[2][2];
											
											var whp=(whb*100)/wha;
											
											for(var i=1;i<=res[2][2];i++){
												escala+='<div  style="width:'+whp+'%;float:left" class="escala">';
												var classel="";
												if(respuestast[pp["keyid"]]!=undefined && respuestast[pp["keyid"]]!='undefined' ){
													if(i==respuestast[pp["keyid"]]){
														classel=' class="selected_r"';
													}
												}
												escala+='<input type="button" name="'+pp["keyid"]+'"  '+classel+' style="width:30px;height:30px" value="'+i+'" />';
												escala+='</div>';
 												
											}
											 escala+='<div style="clear:both"></div>';
											 escala+='</div>';
											 escala+='<div style="clear:both" class="clearescalas"></div>';
 											 
											//escala+='<div class="col-lg-12">';
											//escala+='<div class="col-lg-12" >';
											escala+='<div class="descriptores" >';
											var testcols=((redondeo((12/res[2][3]),0))+1);
											
											if(testcols*12>12){
												testcols=testcols-1;
											}
											
											
											var wha=jQuery("#resolver_encuesta").width()-150;
											var whb=wha/res[2][3];
											
											var whp=(whb*100)/wha;
											
											jQuery.each(res[2][1],function(kkk,ddd){
												escala+='<div  style="width:'+whp+'%;float:left;padding:8px;text-align:center" class="descriptor">';
												escala+='<strong>'+ddd+'</strong>';
												escala+='</div>';
 												
											});
											
											 escala+='<div style="clear:both"></div>';
											 escala+='</div>';
											// escala+='<div style="clear:both"></div>';
											// escala+='</div>';											 
											 
											 
											 
											 
											 
											 
											 
											// escala+='<div style="clear:both"></div>';
											// escala+='</div>';
											
											descripcionescala=res[2][4];
											
										}
										
										var na='<div class="col-lg-12">';
										na+='<div class="col-lg-12">'+descripcionescala+'</div>';
										na+='<div class="col-lg-11"></div>';
										na+='<div class="col-lg-1">';
 										na+='<input type="button" name="'+pp["keyid"]+'"  style="width:45px;height:30px"   value="N/A" />';
										na+='</div></div>';
 										
										if(tpreg<=10){
											pagina=1;
											
										}else if((tpreg-1)%10==0){
											pagina++;
										}
										acciones.pagifinal["p"]=pagina;
										categorias+='<div class="col-lg-12" rel="preguntas" id="pg_'+pagina+'_'+tpreg+'">'; 
										categorias+='<div class="panel panel-default">'; 
										categorias+='<div class="panel-heading">'; 
										categorias+='<li class="list-group-item key"  rel="'+pp["keyid"]+'"><strong name="pg_'+pagina+'_'+tpreg+'">'+tpreg+').  '+pp["enunciado"]+'</strong></li>';
										categorias+='</div>';
										categorias+='<div class="panel-body">';
										categorias+='<div class="list-group">';
										categorias+=na+'<div style="clear:both"></div><br>'+escala+'<div style="clear:both"></div>';
										categorias+='</div>';
										categorias+='</div><div style="clear:both"></div>';
										
										var ctemp="";
										var displayt=' style="display:none" ';
										var displayboton='';
										if(comentariosrespuestast[pp["keyid"]]!="undefined" && comentariosrespuestast[pp["keyid"]]!=undefined ){
											if(comentariosrespuestast[pp["keyid"]]!=""){
												ctemp=comentariosrespuestast[pp["keyid"]];
												displayt='';
												displayboton=' style="display:none" ';
											}
										}
										categorias+='<input type="button" value="<?=$idioma->agregarcomentario?>" rel="adc_'+pp["keyid"]+'" '+displayboton+' />';
										categorias+='<div id="comentar_'+pp["keyid"]+'" '+displayt+'>';
										categorias+='Ponga aquí sus comentarios<textarea rel="comentario_'+pp["keyid"]+'" style="width:90%;height:120px">'+ctemp+'</textarea><div style="clear:both"></div>';
										categorias+='<input type="button" value="<?=$idioma->cancelar?>" rel="delc_'+pp["keyid"]+'" />';
										categorias+='</div>';
										categorias+='</div>';
										categorias+='</div>'; tpreg++;
										
									});
									
								
								
/*								
								
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bar-chart-o fa-fw"></i> <?=$idioma->{"misproyectos"}?>
			 
		</div>
 		<div class="panel-body">
			 
			<div class="list-group" id="view_data" style="display: block;"> 
			 
			 
			</div>
			 
		</div>
 	</div>
  </div>								
*/								
								
								
								
								categorias+='<div style="clear:both"></div></div>';
								jQuery("#resolver_encuesta").append(categorias);
 								contador++;
 							});
							if(res[3]!="no"){
								
								if(tpreg<=10){
									pagina=1;
									
								}else if((tpreg-1)%10==0){
									pagina++;
								}
								
								acciones.pagifinal["p"]=pagina;
								var na='<div class="col-lg-12" rel="preguntas_abiertas" id="pg_'+pagina+'_'+tpreg+'"><a name="pg_'+pagina+'_'+tpreg+'"></a><h4>Preguntas abiertas</h4>';
 								jQuery.each(res[3],function(id,enunciado){
									na+='<li class="list-group-item abierta"  >';
									na+='<strong>'+enunciado[0]+'</strong>';
									na+='<div style="clear:both"></div>';
									var valtext="";
									if(comentariost[enunciado[1]]!="undefined" && comentariost[enunciado[1]]!=undefined){
										if(comentariost[enunciado[1]]!=""){
											valtext=comentariost[enunciado[1]];
										}
									}
									na+='<textarea   id="'+enunciado[1]+'"  style="width:80%;height:150px"   >'+valtext+'</textarea><div style="clear:both"></div>';
									na+='</li>';
									
	 
								});
								na+='<div style="clear:both"></div></div>';
								tpreg++;
								jQuery("#resolver_encuesta").append(na);
							}
							acciones.paginaactual['p']=1;
							var av="";
							var gv="display:none";
							var rv="style='display:none'";;
							if(acciones.pagifinal["p"]==acciones.paginaactual['p']){
								gv="";
								av="display:none";
  							}
							var htmlbotones="<div style='width:100%'>";
								htmlbotones+="<center><input type='button' "+rv+" rel='retroceder'  value='<?=$idioma->retroceder?>'>"; 
 								htmlbotones+="<input type='button' rel='avanzar' style='margin-left:10px;"+av+"' value='<?=$idioma->avanzar?>'>";
 								htmlbotones+="<input type='button' rel='guardar' style='margin-left:10px;"+gv+"' value='<?=$idioma->guardarencuesta?>'>";
								htmlbotones+="</center></div>"; 

							jQuery("#guardar").html(htmlbotones+"<div style='clear:both'></div>");
							jQuery("[id^='pg_']").hide();
							jQuery("[id^='pg_1_']").show();
 							acciones.prevencuesta();
						}
				
					}
			});
			
		});
		
	},
	paramsvalidapass:{"longitud":false,"minuscula":false,"numero":false,"mayuscula":false,"iguales":false},
 	validarpassword:function(){
		var longitud = false,
		minuscula = false,
		numero = false,
		mayuscula = false;
		jQuery("#resolver_encuesta").find('input[name="claveb"]').keyup(function() {
			if(jQuery(this).val()!=jQuery("#resolver_encuesta").find('input[name="clave"]').val()){
				jQuery("#resolver_encuesta").find("#pswd_infob").show();
				 jQuery("#resolver_encuesta").find('#passb').removeClass('valid').addClass('invalid');
				 jQuery("#resolver_encuesta").find('#passb').text("<?=$idioma->clavenocoincide?>");
				 acciones.paramsvalidapass["iguales"]=false;
			}
			
			if(jQuery(this).val()==jQuery("#resolver_encuesta").find('input[name="clave"]').val()){
				//jQuery("#resolver_encuesta").find("#pswd_infob").hide();
				jQuery("#resolver_encuesta").find('#passb').text("<?=$idioma->clavesegura?>");
				jQuery("#resolver_encuesta").find('#passb').removeClass('invalid').addClass('valid');
				 acciones.paramsvalidapass["iguales"]=true;

			}
			
		}).focus(function() {
			jQuery("#resolver_encuesta").find('#pswd_infob').show();
		}).blur(function() {
			jQuery("#resolver_encuesta").find('#pswd_infoh').hide();
		});
		jQuery("#resolver_encuesta").find('input[name="clave"]').keyup(function() {
			var pswd = jQuery(this).val();
			if (pswd.length < 8) {
			 jQuery("#resolver_encuesta").find('#length').removeClass('valid').addClass('invalid');
			  longitud = false;
			  acciones.paramsvalidapass["longitud"]=false;
			} else {
			 jQuery("#resolver_encuesta").find('#length').removeClass('invalid').addClass('valid');
			  longitud = true;
			  acciones.paramsvalidapass["longitud"]=true;
			}

			//validate letter
			if (pswd.match(/[A-z]/)) {
			  jQuery("#resolver_encuesta").find('#letter').removeClass('invalid').addClass('valid');
			  minuscula = true;
			  acciones.paramsvalidapass["minuscula"]=true;
			} else {
			  jQuery("#resolver_encuesta").find('#letter').removeClass('valid').addClass('invalid');
			  minuscula = false;
			  acciones.paramsvalidapass["minuscula"]=false;
			}

			//validate capital letter
			if (pswd.match(/[A-Z]/)) {
			  jQuery("#resolver_encuesta").find('#capital').removeClass('invalid').addClass('valid');
			  mayuscula = true;
			  acciones.paramsvalidapass["mayuscula"]=true;
			} else {
			  jQuery("#resolver_encuesta").find('#capital').removeClass('valid').addClass('invalid');
			  mayuscula = false;
			  acciones.paramsvalidapass["mayuscula"]=false;
			}

			//validate number
			if (pswd.match(/\d/)) {
			jQuery("#resolver_encuesta").find('#number').removeClass('invalid').addClass('valid');
			  numero = true;
			  acciones.paramsvalidapass["numero"]=true;
			} else {
			  jQuery("#resolver_encuesta").find('#number').removeClass('valid').addClass('invalid');
			  numero = false;
			  acciones.paramsvalidapass["numero"]=false;
			}
		}).focus(function() {
			jQuery("#resolver_encuesta").find('#pswd_info').show();
		}).blur(function() {
			jQuery("#resolver_encuesta").find('#pswd_info').hide();
		});		
		
		
		
	},
	perfil:function(){
		jQuery("[rel='perfildeusuario']").off();
		jQuery("[rel='perfildeusuario']").on("click",function(){
			
			jQuery("#resolver_encuesta").html(jQuery("#perfil_template").html()); 
			acciones.perfil();
			jQuery("#resolver_encuesta").find("#pswd_info").css({
				"left":jQuery("#resolver_encuesta").find("#pass").width()-160+"px",
				"bottom":(jQuery("#resolver_encuesta").find("#pass").find(".list-group:eq(0)").height()*3)+20-94+"px"
				});
			jQuery("#resolver_encuesta").find("#pswd_infob").css({
				"left":jQuery("#resolver_encuesta").find("#pass").width()-160+"px",
				"bottom":(jQuery("#resolver_encuesta").find("#pass").find(".list-group:eq(0)").height()*2)-94+"px"
				});
			jQuery("#resolver").hide();
			jQuery("#guardar").html("");
			acciones.paramsvalidapass={"longitud":false,"minuscula":false,"numero":false,"mayuscula":false,"iguales":false};
			acciones.validarpassword();
			
		});
		
		jQuery("[rel='editar_participantes']").off();
		jQuery("[rel='editar_participantes']").on("click",function(){
			var validar=true;
			var error='';
			
			jQuery.each(acciones.paramsvalidapass,function(k,d){
				if(d==false){
					validar=false;
				}
			});
			var data={clave:jQuery("#resolver_encuesta").find("[name='clave']").val()};
			/*
			<? if($evaluador->genero==""){ ?>
			data["genero"]=jQuery("#resolver_encuesta").find("[name='genero']").val();

			<? } ?>
			<? if($evaluador->edad==""){ ?>
			data["edad"]=jQuery("#resolver_encuesta").find("[name='edad']").val();
			<? }?>
			<? if($evaluador->antiguedad==""){ ?>
			data["antiguedad"]=jQuery("#resolver_encuesta").find("[name='antiguedad']").val();
			<? }?>
			<? if($evaluador->estadocivil==""){ ?>
			data["estadocivil"]=jQuery("#resolver_encuesta").find("[name='estadocivil']").val();
			<? }?>
			<? if($evaluador->nivelacademico==""){ ?>
			data["nivelacademico"]=jQuery("#resolver_encuesta").find("[name='nivelacademico']").val();
			<? }?>*/
			var erroes=0;
			var campos={};
			var temporalvar=validar;
			var keys=[];
			jQuery.each(data,function(k,d){
				if(d=="" || d==-1){
					erroes++;
 					campos[k]=d;
					validar=false;
				}
				keys.push(k);
			});
			data["keys"]=keys;
 			if(validar==true){
 				 var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/actualizarparticipante",
						data:data,
						success:function(res){
							if(res[0]=="ok"){
												var w=500+"px";
			if(jQuery("body").width()<=510){
			w=98+"%";
			}
								jQuery.colorbox({html:"<center><h2>Sus datos han sido actualizados</h2></center>",width:w,"height":"300px"});
								acciones.validarestado=0;
								acciones.bienvenida();
							}
						}
				 }
				 )
			}else{
				if(temporalvar==false){
					jQuery("#resolver_encuesta").find('#pswd_info').show();
					jQuery("#resolver_encuesta").find('#pswd_infob').show();
				}
				if(errores>0){
 
					jQuery.colorbox({html:"<h2><?=$idioma->novacio?></h2>"});
				}
			}
		});
		
	},
	contactenos:function(){
		jQuery("[rel='contactenos']").off();
		jQuery("[rel='contactenos']").on("click",function(){
			jQuery("#resolver_encuesta").html(jQuery("#contactenos_template").html()); 
			acciones.contactenos();
		});
		
		jQuery("[rel='enviar_comentario']").off();
		jQuery("[rel='enviar_comentario']").on("click",function(){
			 var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/authentication/contactenos",
					data:{
					asunto:jQuery("#resolver_encuesta").find("[name='asunto']").val(),
 					email:jQuery("#resolver_encuesta").find("[name='email']").val(),
					comentario:jQuery("#resolver_encuesta").find("[name='comentario']").val()},
					success:function(res){
						if(res[0]=="ok"){
							jQuery.colorbox({html:"<center><h2>Sus comentarios han sido enviados</h2></center>",width:"500px","height":"300px"});
							setTimeout(function(){document.location=document.location.origin+""+document.location.pathname;},1000);
						}
					}
			 }
			 )
		});
		
	},
	validarestado:<?=(int)$evaluador->resetpassword?>,
	validareset:function(){
		if(acciones.validarestado==1){
 			jQuery("[rel='perfildeusuario']").click();
		} else{
			acciones.bienvenida();
		}
	},
	bienvenida:function(){
		<? if(in_array(0,$estadoencuesta) or in_array(2,$estadoencuesta)){?>
			jQuery("#resolver_encuesta").html(jQuery("#bienvenida").html()); 
			//jQuery("#instrucciones").show(); 
		<? }else{ ?>
		jQuery("#resolver_encuesta").html(jQuery("#bienvenida").html()); 
			jQuery("#resolver_encuesta").find("#instrucciones").html("<b>"+jQuery("#nohayencuestaspendientes").html()+"</b>"); 
			
	<? } ?>
	},
	
}
var idioma=jQuery.parseJSON( '<?=json_encode($idioma)?>');

jQuery(function(){
	//jQuery("#instrucciones").hide(); 
	acciones.encuesta();
	acciones.perfil();
	acciones.contactenos();
	acciones.validareset();
	<?
		if($mensaje!=""){
	?>
					var w=500+"px";
			if(jQuery("body").width()<=510){
			w=98+"%";
			}
	jQuery.colorbox({html:"<center><h2><?=$mensaje?></h2></center>",width:w,"height":"300px"});
		<? } ?>
		var quitar=180;
	/*if(jQuery("body").width()<=768){
		quitar=quitar+450;    
	}*/
	jQuery("#resolver_encuesta").css({"height":(jQuery("body").height()-quitar)+"px","overflow-x":"hidden","overflow-y":"scroll"});   
	jQuery("html,body").css({"overflow":"hidden"}); 

});
 function redondeo(numero, decimales)
{
var flotante = parseFloat(numero);
var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
return resultado;
}
</script>   
 <div id="contenedor360"   >
  
 
 

<? //printVar($evaluador->resetpassword); ?>
 <div id="perfil_template" style="display:none">
 <div class="panel-body" id="formulario" style="display: block;">
 
		<div class="col-lg-7" id="pass">
			<!--
			<? if($evaluador->genero==""){ ?>
			<div class="list-group list-group-item"  rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"genero"}?></strong></div>
				<div class="col-lg-7">
					<select   name="genero" style="width:100%" />
					<option value="-1"><?=$idioma->seleccione?></option>
					<? foreach($genero as $d){ ?>
					<option value="<?=$d->id?>"><?=$d->esp?></option>
					<? } ?>
					</select>
				</div>
				<div style="clear:both"></div>
			</div>
			<? } ?>
			<? if($evaluador->edad==""){ ?>
			<div class="list-group list-group-item"  rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"edad"}?></strong></div>
				<div class="col-lg-7">
					<select   name="edad" style="width:100%" />
					<option value="-1"><?=$idioma->seleccione?></option>
					<? foreach($edad as $d){ ?>
					<option value="<?=$d->id?>"><?=$d->esp?></option>
					<? } ?>
					</select>
				</div>
				<div style="clear:both"></div>
			</div>
			<? }?>
			
			<? if($evaluador->antiguedad==""){ ?>
			<div class="list-group list-group-item"  rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"antiguedad"}?></strong></div>
				<div class="col-lg-7">
					<select   name="antiguedad" style="width:100%" />
					<option value="-1"><?=$idioma->seleccione?></option>
					<? foreach($antiguedad as $d){ ?>
					<option value="<?=$d->id?>"><?=$d->esp?></option>
					<? } ?>
					</select>
				</div>
				<div style="clear:both"></div>
			</div>
			<? }?>
			<? if($evaluador->estadocivil==""){ ?>
			<div class="list-group list-group-item"  rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"ecivil"}?></strong></div>
				<div class="col-lg-7">
					<select   name="estadocivil" style="width:100%" />
					<option value="-1"><?=$idioma->seleccione?></option>
					<? foreach($ecivil as $d){ ?>
					<option value="<?=$d->id?>"><?=$d->esp?></option>
					<? } ?>
					</select>
				</div>
				<div style="clear:both"></div>
			</div>
			<? }?>
			<? if($evaluador->nivelacademico==""){ ?>
			<div class="list-group list-group-item"  rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"nacademico"}?></strong></div>
				<div class="col-lg-7">
					<select   name="nivelacademico" style="width:100%" />
					<option value="-1"><?=$idioma->seleccione?></option>
					<? foreach($nacademico as $d){ ?>
					<option value="<?=$d->id?>"><?=$d->esp?></option>
					<? } ?>
					</select>
				</div>
				<div style="clear:both"></div>
			</div>			
			<? }?>
 			-->
		
			<div class="list-group list-group-item">
				<div class="col-lg-12"><h2><strong>Nueva clave</strong></h2></div>
 				
				<div style="clear:both"></div>
			</div>
			<div class="list-group list-group-item">
				<div class="col-lg-5"><strong>Nueva Clave</strong></div>
				<div class="col-lg-7"><input type="password" name="clave" style="width:100%" ></div>
				
				<div style="clear:both"></div>
			</div>
	 
			<div class="list-group list-group-item">
				<div class="col-lg-5"><strong>Confirmar Clave</strong></div>
				<div class="col-lg-7"><input type="password" name="claveb" style="width:100%" ></div>
				<div style="clear:both"></div>
			</div>
	 
			<div class="list-group list-group-item">
				<div class="col-lg-5">
				<input type="button" value="Actualizar" rel="editar_participantes" id="keyid"   class="limebutton">
				</div>
				<div class="col-lg-7"></div>
				<div style="clear:both"></div>
			</div>
			<div id="pswd_info">
			<h4><?=$idioma->enunciadopassword?></h4>
			<ul>
			  <li id="letter" class="invalid"> <strong><?=$idioma->almenosunaletra?></strong>
			  </li>
			  <li id="capital" class="invalid"><strong><?=$idioma->almenosunamayuscula?></strong>
			  </li>
			  <li id="number" class="invalid"><strong><?=$idioma->almenosunnumero?></strong>
			  </li>
			  <li id="length" class="invalid"><strong><?=$idioma->almenos8caracteres?></strong>
			  </li>
			</ul>
			</div>
			<div id="pswd_infob">
			<div  id="passb" class="invalid"><?=$idioma->clavenocoincide?></div>
			 
			</div>
			
			
		</div>
  	</div>
 </div> 
 <div id="contactenos_template" style="display:none">
 
 
 <div class="panel-body" id="formulario" style="display: block;">
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong>Asunto</strong></div>
			<div class="col-lg-7"><input type="text" name="asunto" style="width:100%" ></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong>Email de contacto</strong></div>
			<div class="col-lg-7"><input type="text" name="email" style="width:100%"  value="<?=$evaluador->email?>"></div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong>Comentarios</strong></div>
			<div class="col-lg-7"><textarea  name="comentario" style="width:98%;height:120px"></textarea></div>
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5">
 			<input type="button" value="Enviar" rel="enviar_comentario" id="keyid"   class="limebutton">
			</div>
			<div class="col-lg-7"></div>
			<div style="clear:both"></div>
		</div>
		
		
		
  	</div>
 </div>
  
 <div  id="bienvenida" style="display: none;">
	<div class="panel-body" >
		<div class="list-group list-group-item">
			<div class="col-lg-12"><?=$proyecto->bienvenida?></div>
			
			<div style="clear:both"></div>
		</div>
		 <div  id="instrucciones" class="list-group list-group-item" style="margin-top:10px"><div class="col-lg-12"><?=$idioma->instrucionessihayencuestas?>
			</div><div style="clear:both"></div>
			</div>
	</div>
  </div>
  
 <div  id="agradecimientos" style="display: none;">
	<div class="panel-body" >
		<div class="list-group list-group-item">
			<div class="col-lg-12"><?=$idioma->agradecimientoencuesta?></div>
			 
			<div style="clear:both"></div>
		</div>
	</div>
  </div>
  
 <div  id="nohayencuestaspendientes" style="display: none;">
	<?=$idioma->instrucionessinohayencuestas?> 
  </div>
  
         <!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" id="barra" style="margin-bottom: 0;height:100px">
            <div class="navbar-header" id="logomenu">
                <button type="button" class="navbar-toggle" id="menureducido" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/evaluacion?token=<?=$_GET["token"]?>" style="padding:0px">
				<img src="<?=Yii::app()->baseUrl?>/images/360evolution.png" style="width: 350px;" /></a>
				
            </div> 
            <!-- /.navbar-header -->
             <ul class="nav navbar-top-links navbar-right" id="menualternativo"  >
				<li>
				<a  href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/evaluacion?token=<?=$_GET["token"]?>">
					<i class="fa fa-home fa-fw"></i>  
				</a>
				</li>
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-edit fa-fw"></i>Evaluaciones <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
					
 
						<?php
							if(isset($autoevaluacion[0]["nombre"])){
								?>
								<? if((int)$autoevaluacion[0]["estado"]!=1){ ?>
								<li>
									<a href="javascript:;" rel="evaluacion" id="<?=$autoevaluacion[0]["keyid"]?>"><div><strong> <?=$idioma->autoevaluacion?></strong>
                                 </div></a>
								</li>
								<? }else if((int)$autoevaluacion[0]["estado"]==1){?>
								<li>
									<a href="javascript:;" ><strong  style="color:green"> <?=$idioma->autoevaluacion?> RESUELTO</strong> </a>
                                  
								</li>
								<? }?>
						<?php
							}
						?>
						
						<? 
						
						
						foreach($otros as $relacion=>$paraevaluar){ ?>
							<li>
							 
								<? foreach($paraevaluar as $datoseval){ ?>
									<? if((int)$datoseval["estado"]!=1){ ?>
									<a href="javascript:;" rel="evaluacion" id="<?=$datoseval["keyid"]?>"><div><strong style="color:red"><?=$datoseval["nombre"]?></strong>
                                 </div></a>
								 
									<? }else if((int)$datoseval["estado"]==1){ ?>
									<a href="javascript:;"  ><div><strong style="color:green"><?=$datoseval["nombre"]?> RESUELTO</strong>
                                 </div></a>
									<? } ?>
								<? } ?>
							</li>
							 
						<? } ?>				
					
					 
                          
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
				
				
				
				<li>
				<a href="javascript:;" rel="perfildeusuario"><i class="fa fa-user fa-fw"></i> Perfil</a>
				</li>
				<li>
				<!--a href="javascript:;" rel="contactenos"><i class="fa fa-envelope-o fa-fw"></i> Contactenos</a-->
				<a href="mailto:info@360evolution.net"  ><i class="fa fa-envelope-o fa-fw"></i> Contáctenos</a>
				</li>
				<li>
				<a href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/salir"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
				</li>

				
				
				
				
				
				
				
				
				
				
			</ul>				
			




<? //printVar($autoevaluacion[0]["temporales"]); ?>
<div class="navbar-default sidebar" role="navigation" id="inicial" style="margin-top:103px">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li>
			<a  href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/evaluacion?token=<?=$_GET["token"]?>">
				<i class="fa fa-home fa-fw" rel="<?=$evaluador->keyid?>"></i> Bienvenido(a) <?=$evaluador->nombre?> 
			</a>
			</li>
 			<li>
				<a href="#"><i class="fa fa-edit fa-fw"></i> Evaluaciones<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					 
					<!--<li>
					<? foreach($otros as $relacion=>$paraevaluar){ ?>
						<a href="#"><?=$relacion?> <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<? foreach($paraevaluar as $datoseval){ ?>
							<li>
								<a href="javascript:;" rel="evaluacion" id="<?=$datoseval["keyid"]?>"><?=$datoseval["nombre"]?></a>
							</li>
							<? } ?>
						</ul>
						 
					<? } ?>
 					</li>-->
					<?php
						if(isset($autoevaluacion[0]["nombre"])){
							?>
							<? if((int)$autoevaluacion[0]["estado"]!=1){ ?>
							<li>
								<a href="javascript:;" rel="evaluacion" id="<?=$autoevaluacion[0]["keyid"]?>" style="color:red"><?=$idioma->autoevaluacion?></a>
							</li>
						<? }else if((int)$autoevaluacion[0]["estado"]==1){ ?>
							<li style="color:green" >
								<a href="javascript:;"  rel="evaluacion" id="<?=$datoseval["keyid"]?>" style="color:green"><?=$idioma->autoevaluacion?> RESUELTO</a>
							</li>
						
						
						<? } ?>
					<?php
						}
					?>
					
					<? foreach($otros as $relacion=>$paraevaluar){ ?>
						 
							<li>
							 
								<? foreach($paraevaluar as $datoseval){ ?>
									<? if((int)$datoseval["estado"]!=1){ ?>
									<a href="javascript:;" rel="evaluacion" id="<?=$datoseval["keyid"]?>" style="color:red"><?=$datoseval["nombre"]?></a>
								 
									<? }else if((int)$datoseval["estado"]==1){ ?>
										<a href="javascript:;"  rel="evaluacion" id="<?=$datoseval["keyid"]?>"  style="color:green"><?=$datoseval["nombre"]?> RESUELTO</a>
									<? } ?>
								<? } ?>
							</li>
							 
						 			
					<? } ?>				
					
					
					
					
					
					
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
                <a href="javascript:;" rel="perfildeusuario"><i class="fa fa-user fa-fw"></i> Perfil</a>
            </li>
			<li>
                <!--a href="javascript:;" rel="contactenos"><i class="fa fa-envelope-o fa-fw"></i> Contactenos</a-->
                <a href="mailto:info@360evolution.net"  ><i class="fa fa-envelope-o fa-fw"></i> Contáctenos</a>
            </li>
			<li>
                <a href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/salir"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
            </li>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->			
			
			
 			
			
			
</nav> 	
		
		
		
		
		
		
		
		
		
		

        <div id="page-wrapper" style="overflow-y:hidden">
             
           
            <div class="row">
				<div class="col-lg-12" >
					<div class="panel panel-default">
						<div id="resolver" lass="navbar-header" style="margin:0 auto;display:none;"><center><h2><strong></strong></h2></center></div><div style="clear:both"></div>
						<div  id="resolver_encuesta"><strong> </strong>
						</div>
						

					</div>
				</div>
				
				
				
				<div class="col-lg-12">
					<div  >
						<div  id="guardar">
						</div>

					</div>
				  </div>				
				
				
				
				
				
				
				
				
				
				
 				
            </div>
            <!-- /.row -->
        </div>
        </div>
        <!-- /#page-wrapper -->
		
		
		
<script>
	jQuery(function(){
		setTimeout(function(){
		jQuery("#page-wrapper").removeAttr("style");
		jQuery("#page-wrapper").css({"height":(jQuery("body").height()-30)+"px","overflow-x":"hidden","overflow-y":"hidden"});
		},300);
		 
	})
</script>	
<style>
   #resolver_encuesta p{
	   text-align:initial;
	   padding-bottom:0px;
   }
  .escala input{
	   border-radius: 15px;
   }
</style>