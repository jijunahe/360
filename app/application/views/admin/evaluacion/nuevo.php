<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>  
  <style>
  .sortable { list-style-type: none; margin: 0; padding: 0; width: 99%; }
  .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; }
  .sortable li span { position: absolute; margin-left: -1.3em; }

.selected_r{ background-color:rgb(128,255,255);}
.selected_comp{ background-color:#000;}



   .messages{
        float: left;
        font-family: sans-serif;
        display: none;
    }
    .info{
        padding: 10px;
        border-radius: 10px;
        background: orange;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .before{
        padding: 10px;
        border-radius: 10px;
        background: blue;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .success{
        padding: 10px;
        border-radius: 10px;
        background: green;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .error{
        padding: 10px;
        border-radius: 10px;
        background: red;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
 
  </style>
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>

  
<script  > 
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
		
	
	
 	filtraregiones:function(){/*
		jQuery("#formulario").find("[name='region']").off();
		jQuery("#formulario").find("[name='region']").on("change",function(){
			var idpais=jQuery("#formulario").find("[name='pais']").val();
			var idregion=jQuery(this).val();
			if(parseInt(idpais)>0 && parseInt(idregion)>0){
 				jQuery("#formulario").find("[name='ciudad']").html("<option>Seleccione una ciudad</option>");
				//jQuery("[name='empresar']").html("<option>Seleccione una ciudad</option>");
  				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getciudades",
					data:{
						idpais:idpais,
						idregion:idregion
					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option>Seleccione una ciudad</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("#formulario").find("[name='ciudad']").html(html);
							 acciones.filtraciudades();
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("#formulario").find("[name='ciudad']").html("<option>Seleccione un departamento o región</option>");
  				//jQuery("[name='empresar']").html("<option>Seleccione un departamento o región</option>");
			}
		});
		*/
	},
	filtrapaises:function(){
		
var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getregiones",
					data:{
						idpais:"ALL",
 					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option>Seleccione un sector económico</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("#formulario").find("[name='region']").html(html);
							 acciones.filtraregiones();
 						 }
					}
				}).responseJSON;		
		
		
		
		
		
		
		
		/*
		jQuery("#formulario").find("[name='pais']").off();
		jQuery("#formulario").find("[name='pais']").on("change",function(){
			var idpais=jQuery(this).val();
 			if(parseInt(idpais)>0){
				jQuery("#formulario").find("[name='region']").html("<option>Seleccione un departamento o región</option>");
				jQuery("#formulario").find("[name='ciudad']").html("<option>Seleccione un departamento o región</option>");
				//jQuery("[name='empresar']").html("<option>Seleccione un departamento o región</option>");
 				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getregiones",
					data:{
						idpais:idpais,
 					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option>Seleccione un departamento o región</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("#formulario").find("[name='region']").html(html);
							 acciones.filtraregiones();
 						 }
					}
				}).responseJSON;				
 			}else{
				jQuery("#formulario").find("[name='region']").html("<option>Seleccione un pais</option>");
				jQuery("#formulario").find("[name='ciudad']").html("<option>Seleccione un pais</option>");
				//jQuery("[name='empresar']").html("<option>Seleccione un pais</option>");
			}
		});	*/
	},
	filtraciudades:function(){/*
		jQuery("#formulario").find("[name='ciudad']").off();
		jQuery("#formulario").find("[name='ciudad']").on("change",function(){
			var idpais=jQuery("#formulario").find("[name='pais']").val();
			var idregion=jQuery("#formulario").find("[name='region']").val();
			var idciudad=jQuery(this).val();
			if(parseInt(idpais)>0 && parseInt(idregion)>0 && parseInt(idciudad)>0){
 				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getorganizaciones",
					data:{
						idpais:idpais,
						idregion:idregion,
						idciudad:idciudad
					},
					success:function(res){
 						 if(res[0]=="ok"){
							 var html='<option>Seleccione una empresa</option>';
							 jQuery.each(res[1],function(k,d){
								 html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 							 });
 							 jQuery("[name='empresa']").html(html);
 						 }else{
							 
						 }
					}
				}).responseJSON;				
 			}else{
   				//jQuery("[name='empresar']").html("<option>Seleccione una ciudad</option>");
			}
		});		
		*/
	},
	objparticipantes:{},
	participantes:function(){
		
 		if(acciones.dataproyect["tipoproyecto"]==2){
			jQuery("#formulario").find("[name='retroalimentacion']").parent().parent().find("strong").text("<?=$idioma->esorganizacion?>");
		}
		jQuery("#formulario").find("[name='retroalimentacion']").off();
		jQuery("#formulario").find("[name='retroalimentacion']").on("click",function(){   console.log("CAMBIA");
			if(acciones.dataproyect["tipoproyecto"]>1 && jQuery(this).is(":checked")){
				jQuery("#formulario").find("[name='apellido']").parent().parent().hide();
				jQuery("#formulario").find("[rel='agregar_participantes']").val("<?=$idioma->agregar_generico?>");
				//jQuery("#formulario").find("[name='apellido']").val("ORG");
				jQuery("#formulario").find("[name='primer_nombre']").parent().parent().find("strong").html("<?=$idioma->organizacion?>");
				jQuery("#formulario").find("[rel='hidde']").hide();
  			}else{
				jQuery("#formulario").find("[name='apellido']").parent().parent().show();
				//jQuery("#formulario").find("[name='apellido']").val("");
				jQuery("#formulario").find("[name='primer_nombre']").parent().parent().find("strong").html("<?=$idioma->primer_nombre?>");
				jQuery("#formulario").find("[rel='hidde']").show();
				jQuery("#formulario").find("[rel='agregar_participantes']").val("<?=$idioma->agregar?>");

 
			}
		});
		
		jQuery("[rel='cargamasiva']").off();
		jQuery("[rel='cargamasiva']").on("click",function(){
			
			var forma=jQuery("#formas").find("[rel='cargar']").clone();
			//jQuery("#formulario").html(forma.html());			
			
			jQuery.colorbox({html:forma,height:400});
			jQuery("#colorbox").find("#keyproyecto").val(acciones.dataproyect["key"]);
			cargar();
		});
		
		
		jQuery("[rel='editar_participantes']").off();
		jQuery("[rel='editar_participantes']").on("click",function(){
 			var obj=jQuery(this).parent().parent().parent();
 			var objdata=obj.find("input[type='text']");
 			
			var llave=jQuery(this).attr("id").split("_")[1];
 			var retro="N";
			if(obj.find("[name='retroalimentacion']").is(":checked")){
				retro="S";
			}
			
			var valida=true;
			var objdataselect=obj.find("select");
			var mensaje="<h3><?=$idioma->einfoparticipante?></h3><br><br><ul>";
			
			jQuery.each(objdata,function(kk,dd){
				var d=jQuery(dd).val();
				var k=jQuery(dd).attr("name");
				if(jQuery(dd).is(":visible")){
					if(d=="" && k!="email"){
						mensaje+="<li>El <b>"+idioma[k]+"</b> no es válido</li>";
						valida=false;
					}
					if(k=="email"){
						if(validarEmail(d)==false){
							mensaje+="<li>La <b>"+idioma[k]+"</b> es incorreco</li>";
							valida=false;
						}
					}
				}
			});
 			
/*			
			var objdataselect=obj.find("select");
			jQuery.each(objdataselect,function(kk,dd){
				var d=jQuery(dd).val();
				var k=jQuery(dd).attr("name");
				if(jQuery(dd).is(":visible")){
					if(d=="" || d=="-1" || d==null){
						mensaje+="<li>Por favor elija una opción para <b>"+idioma[k]+"</b> no es válido</li>";
						valida=false;
					}
					 
				} 
			});	*/	
			
			 
			mensaje+="</ul>";
			if(valida==false){
				jQuery.colorbox({html:mensaje}); 
				valida=false;
			} 
			//console.log(valida+" VALIDARRRRR");
 			if(valida==true){	
				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					keyid:llave,
					keyproyecto:acciones.dataproyect["key"],
					apellido:obj.find("[name='apellido']").val(),
					nombre:obj.find("[name='primer_nombre']").val(),
					email:obj.find("[name='email']").val(),
					usuario:obj.find("[name='usuario']").val(),
					clave:obj.find("[name='clave']").val(),
					edad:obj.find("[name='edad']").val(),
					genero:obj.find("[name='genero']").val(),
					antiguedad:obj.find("[name='antiguedad']").val(),
					ecivil:obj.find("[name='ecivil']").val(),
					nacademico:obj.find("[name='nacademico']").val(),
					retroalimentacion:retro,
					mode:"editarparticipante"
					},
					success:function(res){
						if(res[0]=="ok"){
							jQuery("#nombre_"+llave).text(obj.find("[name='apellido']").val()+" "+obj.find("[name='primer_nombre']").val());
							jQuery("#nombre_"+llave).show("slow");
							setTimeout(function(){
								//jQuery.colorbox({html:"<center><h2>El participante ha sido actualizado</h2></center>"});
								jQuery("[href='#participantes']").click();
							},1000);
						}else if(res[0]=='emailexiste'){
							jQuery.colorbox({html:"<center><h2>El email ya existe registrado para este proyecto, por favor verifique la información</h2></center>"});

						}else{
							jQuery.colorbox({html:"<center><h2>No es posible llevar a cabo esta acción</h2></center>"});

						}
					}
				}).responseJSON;
			}
 		});
 		jQuery("[rel='agregar_participantes']").off();
		jQuery("[rel='agregar_participantes']").on("click",function(){
			var obj=jQuery(this).parent().parent().parent();
			var retro="N";
			if(obj.find("[name='retroalimentacion']").is(":checked")){
				retro="S";
			}
			
			
			var valida=true;
			var objdataselect=obj.find("select");
			var objdata=obj.find("input[type='text']");
			var mensaje="<h3><?=$idioma->einfoparticipante?></h3><br><br><ul>";
			
			jQuery.each(objdata,function(kk,dd){
				var d=jQuery(dd).val();
				var k=jQuery(dd).attr("name");
				if(jQuery(dd).is(":visible")){
					if(d=="" && k!="email"){
						mensaje+="<li>El <b>"+idioma[k]+"</b> no es válido</li>";
						valida=false;
					}
					if(k=="email"){
						if(validarEmail(d)==false){
							mensaje+="<li>La <b>"+idioma[k]+"</b> es incorreco</li>";
							valida=false;
						}
					}
				}
			});
 			
/*			
			var objdataselect=obj.find("select");
			jQuery.each(objdataselect,function(kk,dd){
				var d=jQuery(dd).val();
				var k=jQuery(dd).attr("name");
				if(jQuery(dd).is(":visible")){
					if(d=="" || d=="-1" || d==null){
						mensaje+="<li>Por favor elija una opción para <b>"+idioma[k]+"</b> no es válido</li>";
						valida=false;
					}
					 
				} 
			});	*/	
			
			 
			mensaje+="</ul>";
			if(valida==false){
				jQuery.colorbox({html:mensaje}); 
				valida=false;
			} 
			//console.log(valida+" VALIDARRRRR");
 			if(valida==true){			
 				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					keyproyecto:acciones.dataproyect["key"],
					apellido:obj.find("[name='apellido']").val(),
					nombre:obj.find("[name='primer_nombre']").val(),
					email:obj.find("[name='email']").val(),
					usuario:obj.find("[name='usuario']").val(),
					clave:obj.find("[name='clave']").val(),
					edad:obj.find("[name='edad']").val(),
					genero:obj.find("[name='genero']").val(),
					antiguedad:obj.find("[name='antiguedad']").val(),
					ecivil:obj.find("[name='ecivil']").val(),
					nacademico:obj.find("[name='nacademico']").val(),				
					
					retroalimentacion:retro,
					mode:"agregarparticipante"
					},
					success:function(res){
					}
				}).responseJSON;
				if(res["existe"]=="NO"){
					var  htmlt=' <li class="list-group-item" id="itempar-'+res["key"]+'"  style="display:none">';
					htmlt+=' <strong id="nombre_'+res["key"]+'"> '+obj.find("[name='apellido']").val()+' '+obj.find("[name='primer_nombre']").val();
					htmlt+='</strong> <span class="pull-right text-muted small">';
					htmlt+='<a href="javascript:;" rel="editarparticipante_'+res["key"]+'" title="<?=$idioma->{"editar"}?>" rel="participante_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
					htmlt+=' <a href="javascript:;" rel="editarparticipante_'+res["key"]+'" title="<?=$idioma->{"eliminar"}?>" rel="participante_eliminar"><i class="fa fa-trash fa-2x"></i></a>'; 
					htmlt+='  </span>';
					htmlt+=' </li>';							 
					jQuery("#view_data").append(htmlt);
					jQuery("#itempar-"+res["key"]).show("slow");
					jQuery("[href='#participantes']").click();
					acciones.participantes();
				}else if(res["existe"]=="SI"){
					jQuery.colorbox({html:"<strong>Ya existe un participante en este proyecto con email "+obj.find("[name='email']").val()+", el participante no fue agregado</strong>"});
				}else{
					jQuery.colorbox({html:"<center><h2>Ya existe el participante en este proyecto</h2></center>"});
				}
			}
			
		});
		
		jQuery("[rel^='participante_']").off();
		jQuery("[rel^='participante_']").on("click",function(){
			var option=jQuery(this).attr("rel").split("_")[1];
			var llave=jQuery(this).attr("id").split("_")[1];
			switch(option){
				case "editar":
 				//	if(validar==true){
						var res=jQuery.ajax({ 
							type: "POST",
							dataType: "json",
							async: true,
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
							data:{
							mode:"get",
							key:llave,
							get:"participante"
							},
							success:function(res){
								if(res[0]=="ok"){
									var objs=res[1];
									jQuery("#formulario").find("[name='apellido']").val(objs["apellido"]);
									jQuery("#formulario").find("[name='primer_nombre']").val(objs["nombre"]);
									jQuery("#formulario").find("[name='usuario']").val(objs["usuario"]);
									jQuery("#formulario").find("[name='email']").val(objs["email"]);
									jQuery("#formulario").find("[name='edad']").val(objs["edad"]);
									jQuery("#formulario").find("[name='genero']").val(objs["genero"]);
									jQuery("#formulario").find("[name='antiguedad']").val(objs["antiguedad"]);
									jQuery("#formulario").find("[name='ciudad']").val(objs["ciudad"]);
									jQuery("#formulario").find("[name='pais']").val(objs["pais"]);
									jQuery("#formulario").find("[name='nacademico']").val(objs["nivelacademico"]);
									jQuery("#formulario").find("[name='ecivil']").val(objs["estadocivil"]);
									//jQuery("#formulario").find("[name='clave']").val(objs["clave"]);
									
									
									
									if(objs["retroalimentacion"]=="S"){
										document.getElementsByName("retroalimentacion")[1].checked=1;
										if(acciones.dataproyect["tipoproyecto"]!=1){
											jQuery("#formulario").find("[rel='hidde']").hide();
											jQuery("#formulario").find("[name='primer_nombre']").parent().parent().find("strong").text("<?=$idioma->organizacion?>");
											
										}else{
											jQuery("#formulario").find("[rel='hidde']").show();
											jQuery("#formulario").find("[name='primer_nombre']").parent().parent().find("strong").text("<?=$idioma->primer_nombre?>");
										}
											
										
									}else{
										document.getElementsByName("retroalimentacion")[1].checked=0;
										jQuery("#formulario").find("[rel='hidde']").show();
										jQuery("#formulario").find("[name='primer_nombre']").parent().parent().find("strong").text("<?=$idioma->primer_nombre?>");
									}
									
								
									
									jQuery("#formulario").find("[rel='agregar_participantes']").hide();
									jQuery("#formulario").find("[rel='editar_participantes']").show();
									jQuery("#formulario").find("[rel='editar_participantes']").attr({"id":"keyidp_"+llave});
								}else{
									jQuery.colorbox({html:"<center><h2>El participante no existe</h2></center>"});

								}
							}
						}).responseJSON;
				//	}
				
				
				break;
				
				case "eliminar":
				
 					if(confirm("<?=$idioma->{"seguroeliminarparticipante"}?>")){

						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						mode:"get",
						key:llave,
						get:"eliminarparticipante"
						},
						success:function(res){
							if(res[0]=="ok"){
								jQuery("#nombre_"+llave).parent().remove();
								//jQuery.colorbox({html:"<center><h2>El participante ha sido eliminado del proyecto</h2></center>"});
							}else{
								jQuery.colorbox({html:"<center><h2>El participante no existe</h2></center>"});

							}
						}
						}).responseJSON;
					}
 				
				break;
				
			}
		});
		
	},
	relaciones:function(){
		
 		
		
		jQuery("[rel='editar_relacion']").off();
		jQuery("[rel='editar_relacion']").on("click",function(){
 			var obj=jQuery(this).parent().parent().parent();
			var llave=jQuery(this).attr("id").split("_")[1];
 
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyid:llave,
				keyproyecto:acciones.dataproyect["key"],
				abreviacion:obj.find("[name='abreviacionrelacion']").val(),
				nombre:obj.find("[name='nombredelarelacion']").val(),
				descripcion:obj.find("[name='descripcionrelacion']").val(),
				color:obj.find("[name='colorrelacion']").val(),
				idorigen:obj.find("[name='idorigen']").val(),
				mode:"get",
				get:"editarrelacion"
				},
				success:function(res){
					if(res[0]=="ok"){
						jQuery("#nombre_"+llave).text(obj.find("[name='nombredelarelacion']").val()+" ("+obj.find("[name='abreviacionrelacion']").val()+')');
						jQuery("#nombre_"+llave).show("slow");
						setTimeout(function(){
							//jQuery.colorbox({html:"<center><h2>La relación ha sido actualizada</h2></center>"});

						},1000);
					}else{
						jQuery.colorbox({html:"<center><h2>No es posible llevar a cabo esta acción, por favor intentelo más tarde</h2></center>"});

					}
				}
			}).responseJSON;
 		});
 		jQuery("[rel='agregar_relacion']").off();
		jQuery("[rel='agregar_relacion']").on("click",function(){
			var obj=jQuery(this).parent().parent().parent();
 			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyproyecto:acciones.dataproyect["key"],
				abreviacion:obj.find("[name='abreviacionrelacion']").val(),
				nombre:obj.find("[name='nombredelarelacion']").val(),
				descripcion:obj.find("[name='descripcionrelacion']").val(),
				color:obj.find("[name='colorrelacion']").val(),
				idorigen:obj.find("[name='idorigen']").val(),
 				mode:"get",
 				get:"agregarrelacion"
				},
				success:function(res){
				}
			}).responseJSON;
			if(res["existe"]=="NO"){
				var  htmlt=' <li class="list-group-item" id="itempar-'+res["key"]+'"  style="display:none">';
				htmlt+=' <strong id="nombre_'+res["key"]+'"> '+obj.find("[name='nombredelarelacion']").val()+' ('+obj.find("[name='abreviacionrelacion']").val()+')';
				htmlt+='</strong> <span class="pull-right text-muted small">';
				htmlt+='<a href="javascript:;" rel="editarrelacion_'+res["key"]+'" title="<?=$idioma->{"editar"}?>" rel="relacion_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
				htmlt+=' <a href="javascript:;" rel="editarrelacion_'+res["key"]+'" title="<?=$idioma->{"eliminar"}?>" rel="relacion_eliminar"><i class="fa fa-trash fa-2x"></i></a>'; 
				htmlt+='  </span>';
				htmlt+=' </li>';							 
  				jQuery("#view_data").append(htmlt);
  				jQuery("#itempar-"+res["key"]).show("slow");
				acciones.relaciones();
			}else{
				jQuery.colorbox({html:"<center><h2>Ya existe esta relación en el proyecto</h2></center>"});
			}
			
			
		});
		
		jQuery("[rel^='relacion_']").off();
		jQuery("[rel^='relacion_']").on("click",function(){ console.log("RELACIONES ACA");
			var option=jQuery(this).attr("rel").split("_")[1];
			var llave=jQuery(this).attr("id").split("_")[1];
			switch(option){
				case "editar":
				
				
					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
					key:llave,
					get:"relacion"
					},
					success:function(res){
						if(res[0]=="ok"){
							var objs=res[1];
							jQuery("#formulario").find("[name='nombredelarelacion']").val(objs["nombre"]);
							jQuery("#formulario").find("[name='abreviacionrelacion']").val(objs["abreviacion"]);
							jQuery("#formulario").find("[name='descripcionrelacion']").val(objs["descripcion"]);
							jQuery("#formulario").find("[name='colorrelacion']").val(objs["color"]);
							jQuery("#formulario").find("[name='idorigen']").val(objs["idorigen"]);
  							jQuery("#formulario").find("[rel='agregar_relacion']").hide();
							jQuery("#formulario").find("[rel='editar_relacion']").show();
							jQuery("#formulario").find("[rel='editar_relacion']").attr({"id":"keyidp_"+llave});
 						}else{
							jQuery.colorbox({html:"<center><h2>La relación no existe</h2></center>"});

						}
					}
				}).responseJSON;
				
				
				
				break;
				
				case "eliminar":
				
 					if(confirm("<?=$idioma->{"seguroeliminarrelacion"}?>")){

						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
 						key:llave,
						mode:"get",
						get:"eliminarrelacion",
						},
						success:function(res){
							if(res[0]=="ok"){
								jQuery("#nombre_"+llave).parent().remove();
								//jQuery.colorbox({html:"<center><h2>La relación ha sido eliminada del proyecto</h2></center>"});
							}else{
								jQuery.colorbox({html:"<center><h2>La relación no existe</h2></center>"});

							}
						}
						}).responseJSON;
					}
 				
				break;
				
			}
		});
		
 		
	},
	asignaciones:function(){
		
 		jQuery("[rel='editar_relacion']").off();
		jQuery("[rel='editar_relacion']").on("click",function(){
 			var obj=jQuery(this).parent().parent().parent();
			var llave=jQuery(this).attr("id").split("_")[1];
 
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyid:llave,
				keyproyecto:acciones.dataproyect["key"],
				abreviacion:obj.find("[name='abreviacionrelacion']").val(),
				nombre:obj.find("[name='nombredelarelacion']").val(),
				descripcion:obj.find("[name='descripcionrelacion']").val(),
				color:obj.find("[name='colorrelacion']").val(),
				idorigen:obj.find("[name='idorigen']").val(),
				mode:"get",
				get:"editarrelacion"
				},
				success:function(res){
					if(res[0]=="ok"){
						jQuery("#nombre_"+llave).text(obj.find("[name='nombredelarelacion']").val()+" ("+obj.find("[name='abreviacionrelacion']").val()+')');
						jQuery("#nombre_"+llave).show("slow");
						setTimeout(function(){
							//jQuery.colorbox({html:"<center><h2>La relación ha sido actualizada</h2></center>"});

						},1000);
					}else{
						jQuery.colorbox({html:"<center><h2>No es posible llevar a cabo esta acción, por favor intentelo más tarde</h2></center>"});

					}
				}
			}).responseJSON;
 		});
 		jQuery("[rel='agregar_asignaciones']").off();
		jQuery("[rel='agregar_asignaciones']").on("click",function(){
			var selectores=jQuery("#paraasignar").find("select");
			
			var asignaciones={};
			jQuery.each(selectores,function(k,sel){
				var keyid=jQuery(sel).attr("name").split("_")[1];
				var valor=jQuery(sel).val();
 				asignaciones[keyid]=valor;
			});
  			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyproyecto:acciones.dataproyect["key"],
				keyidparticipante:jQuery("#keyidp").attr("rel"),
				asignaciones:asignaciones,
 				mode:"get",
 				get:"agregarasignacion"
				},
				success:function(res){
					if(res[0]){
						//jQuery.colorbox({html:"<center><h2>Asignación exitosa</h2></center>"});
					}
				}
			}).responseJSON;
			 
			
			
		});

		
		jQuery("[rel^='asignacion_']").off();
		jQuery("[rel^='asignacion_']").on("click",function(){ console.log("ASIGNACIONES ACA");
			var option=jQuery(this).attr("rel").split("_")[1];
			var llave=jQuery(this).attr("id").split("_")[1];
			switch(option){
				case "editar":
 					jQuery("#formulario").hide(); 
					jQuery("#formulario").html("<div class='row'><div id='elparticipante'></div><div id='paraasignar' class='col-lg-12'  ></div></div>");

					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
					key:llave,
					keyidproyecto:acciones.dataproyect["key"],
					get:"relacionasignada"
					},
					success:function(res){
						if(res[0]=="ok"){
							var objs=res[1];
							var relaciones=res[2];
							var html='<li class="list-group-item" style="background-color:#F0FFF0">';
								html+='<strong id="keyidp" rel="'+llave+'" >Asignaciones para '+jQuery("#nombre_"+llave).text()+'</strong> ';
 								html+='</li>';
								var selector='<select name="asignacion_todos" style="width:300px">';
								selector+='<option value="NR"><b><?=$idioma->{"notienerelacion"}?></b></option>';
								jQuery.each(relaciones,function(kr,datarel){
									if(datarel["idorigen"]!=2){ 
									selector+='<option value="'+datarel["keyid"]+'">'+datarel["nombre"]+' <b>('+datarel["abreviacion"]+')</b></option>';
									} 
								});
								selector+='</select>';								
								
								
								html+='<li class="list-group-item" >';
								html+='<strong >Establecer la misma relación para todos  </strong> '+selector;
 								html+='</li>';
							 jQuery("#elparticipante").html(html);
							 
							jQuery("[name='asignacion_todos']").off();
							jQuery("[name='asignacion_todos']").on("change",function(){
								var keyid=jQuery(this).val();
								var selectores=jQuery("#paraasignar").find("select");
								jQuery.each(selectores,function(k,sel){
									jQuery(sel).val(keyid);
								})
							});
									 
							 
							 
							 
							jQuery.each(objs,function(k,data){
								var color="";
								if(llave==data["keyid"]){color='style="background-color:#CDF9CD"';}
									var selected="";
									try{
										 
										if(typeof data["keyidrelacion"]=='string' ){
 											 selected=data["keyidrelacion"];
 										}
 									}catch(e){}
								
								
									var html='<div class="list-group list-group-item" '+color+'>';
									html+='		<div class="col-lg-5"><strong>'+data["nombre"]+' '+data["apellido"]+'</strong></div>';
									html+='		<div class="col-lg-7">';
									
									if(llave!=data["keyid"]){
										html+='<select name="asignacion_'+data["keyid"]+'" style="width:70%">';
										var selt='';
										if(selected=="NR"){selt=' selected="selected"';}
										html+='<option value="NR" '+selt+'><b><?=$idioma->{"notienerelacion"}?></b></option>';
										jQuery.each(relaciones,function(kr,datarel){
											selt='';
											if(datarel["idorigen"]!=2){
												if(selected==datarel["keyid"]){selt=' selected="selected"';}
												html+='<option value="'+datarel["keyid"]+'" '+selt+'>'+datarel["nombre"]+' <b>('+datarel["abreviacion"]+')</b></option>';
											}else{keyidsimismo=datarel["keyid"];}
										});
										html+='</select>';
										//html+='<a href="javascript:;" id="eliminar_'+data["keyid"]+'" title="<?=$idioma->{"eliminarasignacion"}?>" rel="asignacion_eliminar"><i class="fa fa-trash fa-2x"></i></a>';
 									}else{
										var keyidsimismo="";
										jQuery.each(relaciones,function(kr,datarel){
											if(datarel["idorigen"]==2){
												keyidsimismo=datarel["keyid"];
											}
										});
										selt='';
										if(selected=="autoeval" || selected==""){selt=' selected="selected"';}
										html+='<select name="asignacion_'+data["keyid"]+'" style="width:70%">';
										html+='<option value="NR"><b><?=$idioma->{"notienerelacion"}?></b></option>';
										html+='<option value="autoeval" '+selt+'><b><?=$idioma->{"simismo"}?></b></option>';
 										html+='</select>';										
 									}
									html+='</div>';
									html+='		<div style="clear:both"></div>';
									html+='	</div>';
									
									
									
								jQuery("#formulario").find("#paraasignar").append(html);
							});
							html='<div class="list-group list-group-item">';
							html+='<div class="col-lg-5">';
							html+='<input type="button" value="<?=$idioma->{"guardarasignaciones"}?>" rel="agregar_asignaciones" class="limebutton">';
							html+='</div>';
							html+='<div class="col-lg-7"></div>';
							html+='<div style="clear:both"></div>';
							html+='</div>';									

							jQuery("#formulario").append(html);  setTimeout(function(){jQuery("#formulario").show("slow");},700);
							acciones.asignaciones();
 						}else{
							jQuery.colorbox({html:"<center><h2>No hay asignaciones</h2></center>"});

						}
					}
				}).responseJSON;
				
				
				
				break;
				
				case "eliminar":
				
 					if(confirm("<?=$idioma->{"seguroeliminarrelacion"}?>")){

						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
 						key:llave,
						mode:"get",
						get:"eliminarrelacion",
						},
						success:function(res){
							if(res[0]=="ok"){
								jQuery("#nombre_"+llave).parent().remove();
								//jQuery.colorbox({html:"<center><h2>La relación ha sido eliminada del proyecto</h2></center>"});
							}else{
								jQuery.colorbox({html:"<center><h2>La relación no existe</h2></center>"});

							}
						}
						}).responseJSON;
					}
 				
				break;
				
			}
		});
		
 		
	},
	competencias:function(){
		
		jQuery("#formulario").find("[name='tenc']").off();
		jQuery("#formulario").find("[name='tenc']").on("click",function(){
			var ischecked=jQuery(this).val();
			 
			var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
			data:{
 			keyproyecto:acciones.dataproyect["key"],
			mode:"get",
			idtipo:ischecked,
			get:"tipoencuesta"
			},
			success:function(res){
				
			}});			
 			
		});
		
		
		jQuery("[rel='agregarpregunta']").off();
		jQuery("[rel='agregarpregunta']").on("click",function(){
			var obj=jQuery("#formulario").find("#lista_preguntas").find("ul");
			var total=jQuery("#formulario").find("#lista_preguntas").find("ul").find("li").size()+1;
			var li='<li class="ui-state-default" rel="pregunta">'+total+'<br><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>';
				li+='<textarea style="width:94%;margin-right:5px;height:35px" ></textarea>';
				li+='<a href="javascript:;" rel="eliminarpregunta"><i class="fa fa-trash" aria-hidden="true"></i></a>';
				li+='</li>'; 
			
			obj.append(li);
			jQuery( ".sortable" ).sortable();
			jQuery( ".sortable" ).disableSelection();

			acciones.competencias();
		});


		jQuery("[rel='eliminarpregunta']").off();
		jQuery("[rel='eliminarpregunta']").on("click",function(){
			var text=jQuery(this).parent().find("textarea").val(); 
			var rel=jQuery(this).parent().find("textarea").attr("rel");
			console.log(rel+" valor rel");
			var validar=true;
			var eliminarcompletamente="NO";/*
			if(text.trim(" ")!=""){
				if(!confirm("<?=$idioma->{"celiminarpregunta"}?>")){
					validar=false;
				}
			}*/
			if(validar==true){
 				var input=jQuery(this).parent().find("textarea").attr("rel");
				if(input !="" && input !=undefined){
					if(confirm("<?=$idioma->{"elimpregunta"}?>") ){
						eliminarcompletamente="SI"; 
					}
 					var lineq=jQuery(this);
					var llavest=input.split("_");
					
					var llaves={"idpregunta":llavest[1],"idcompetencia":llavest[2],"idproyecto":llavest[3]}
					
					var res=jQuery.ajax({ 
							type: "POST",
							dataType: "json",
							async: false,
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
							data:{
							llaves:llaves,
							keyproyecto:acciones.dataproyect["key"],
							mode:"get",
							eliminarcompletamente:eliminarcompletamente,
							get:"eliminarpregunta"
							},
							success:function(res){
 								if(res[0]=="ok"){
									//jQuery.colorbox({html:"<center><h2>La pregunta ha sido eliminada de la categoría</h2></center>"});
									lineq.parent().remove();
								}
								
								if(res[0]=="okok"){
									//jQuery.colorbox({html:"<center><h2>La pregunta ha sido eliminada en todas las categorias</h2></center>"});
									lineq.parent().remove();
								}
								if(res[0]=="no1"){
									jQuery.colorbox({html:"<center><h2>La pregunta no existe en esta categoría</h2></center>"});
								}
 							}
					});					
					
					
					
					
					
					
				}else{
					jQuery(this).parent().remove();
				}
				acciones.competencias();
			}
 		});
 








 		jQuery("[rel='biblioteca_de_encuestas']").off();
		jQuery("[rel='biblioteca_de_encuestas']").on("click",function(){
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyproyecto:acciones.dataproyect["key"],
  				mode:"get",
				get:"bibliotecaencuestas"
				},
				success:function(res){
					if(res[0]=="ok"){
						var html="<div class='col-lg-12' ><div class='panel-body'><div class='list-group'><ul>";
						jQuery.each(res[1],function(k,d){
							var competencias='<ul>';
							jQuery.each(d["competencias"],function(indice,valores){
								var preguntas='<ul>';
								jQuery.each(valores["preguntas"],function(indicep,valoresp){
									preguntas+='<li class="list-group-item ui-state-default" style="cursor:pointer;display:none" rel="comp_'+valores["id"]+'" id="pregunta_'+valoresp["keyid"]+'">'+valoresp["enunciado"]+'</li>';
								});
								preguntas+='</ul>';
 								competencias+='<li class="list-group-item ui-state-default" style="display:none" id="'+valores["id"]+'" rel="enc_'+d["id"]+'" ><input style="height:15px" type="button" rel="actcomp"><strong style="cursor:pointer; " id="comp_'+valores["id"]+'">'+valores["nombre"]+'</strong><div style="clear:both"></div>'+preguntas+'</li>';
							});
							competencias+='</ul>';
							html+='<li class="list-group-item ui-state-default"  ><input type="checkbox" id="selallcomp_'+d["id"]+'"><strong style="cursor:pointer" id="enc_'+d["id"]+'">'+d["nombre"]+'</strong><div style="clear:btoh"></div>'+competencias+'</li>';
						})
						html+='</ul></div></div></div>';
						jQuery.colorbox({html:"<center><h2></h2></center><div class='col-lg-12 panel panel-default' style='overflow-x:hidden;overflow-y:scroll;height:86%'>"+html+"</div><input type='button' value='Aplicar' rel='aplicarencuesta' />",width:"90%","height":"90%"});
						acciones.competencias();
						
					}
				}
			});					
			
 		});
		
		

 		jQuery("[rel='aplicarencuesta']").off();
		jQuery("[rel='aplicarencuesta']").on("click",function(){ 
			var competencias=[];
			jQuery.each(jQuery("[rel='actcomp']"),function(k,d){
				var selected=jQuery(this).attr("class");
				var parentId=jQuery(this).parent().attr("id");
				if(selected=="selected_comp"){
					competencias.push(parentId);
				}
			});
			
			 
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
 				competencias:competencias,
				keyproyecto:acciones.dataproyect["key"],
  				mode:"get",
				get:"aplicarencuesta"
				},
				success:function(res){
					if(res[0]=="ok"){
													//jQuery.colorbox({html:"<center><h2>La Encuesta ha sido aplicada</h2></center>"});
							jQuery("[href='#competencias']").click();

						
					}
				}
			}
			);
			
			
			
			
			
			
			
			
			
			
  		});
		
		
		
		
 		jQuery("[id^='enc_']").off();
		jQuery("[id^='enc_']").on("click",function(){ 
			var id=jQuery(this).attr("id");
			jQuery("[rel^='enc_']").hide();
			jQuery("[rel='"+id+"']").fadeIn();
  		});
		
		
 		jQuery("[id^='comp_']").off();
		jQuery("[id^='comp_']").on("click",function(){ 
			var id=jQuery(this).attr("id");
			//jQuery("[rel^='comp_']").hide();
			if(jQuery("[rel='"+id+"']:eq(0)").is(":visible")){
				jQuery("[rel='"+id+"']").fadeOut();
			}else{jQuery("[rel='"+id+"']").fadeIn();}
  		});
		
		jQuery("[id^='selallcomp_']").off();
		jQuery("[id^='selallcomp_']").on("click",function(){ 
			var idenc=jQuery(this).attr("id").split("_")[1];
			var objr=jQuery(this);
			
			jQuery.each(jQuery("[rel='enc_"+idenc+"']"),function(k,c){
				if(objr.is(":checked")){
					jQuery(c).find("input").addClass("selected_comp")
 				}else{
					jQuery(c).find("input").removeClass("selected_comp");
				}
					
			});
			
		});
		
		jQuery("[rel='actcomp']").off();
		jQuery("[rel='actcomp']").on("click",function(){ 
			if(jQuery(this).attr("class")=="selected_comp"){
				jQuery(this).removeClass("selected_comp");
			}else{jQuery(this).addClass("selected_comp");}
			
		});
		
		
		
 		jQuery("[rel='cancelar_competencia']").off();
		jQuery("[rel='cancelar_competencia']").on("click",function(){
			jQuery("[href='#competencias']").click();
 		});
		
 		jQuery("[rel='editar_competencia']").off();
		jQuery("[rel='editar_competencia']").on("click",function(){
 			var obj=jQuery(this).parent().parent().parent();
			var llave=obj.find("[name='keyid']").val();
			var llavesp={};
			var objpreg=obj.find("ul").find("li");
			var enunciado="";
			var kidp="";
			jQuery.each(objpreg,function(k,d){
				enunciado=jQuery(d).find("textarea").val();
				var rel=jQuery(d).find("textarea").attr("rel");
				kidp="Nr";
				try{
					if(rel!=""){
						kidp=rel.split("_")[1];
					}
				}catch(e){console.log(e);}
				llavesp[k]=[kidp,enunciado];
			}) 
 
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyid:obj.find("[name='keyid']").val(),
				preguntas:llavesp,
				keyproyecto:acciones.dataproyect["key"],
 				nombre:obj.find("[name='nombrecompetencia']").val(),
				descripcion:obj.find("[name='descripcioncompetencia']").val(),
 				mode:"get",
				get:"editarcompetencia"
				},
				success:function(res){
					if(res[0]=="ok"){
						jQuery("#nombre_"+llave).text(obj.find("[name='nombrecompetencia']").val());
						jQuery("#nombre_"+llave).show("slow");
						setTimeout(function(){
							//jQuery.colorbox({html:"<center><h2>La competencia ha sido actualizada</h2></center>"});
							jQuery("[href='#competencias']").click();

						},1000);
					}else{
						jQuery.colorbox({html:"<center><h2>No es posible llevar a cabo esta acción, por favor intentelo más tarde</h2></center>"});

					}
				}
			}).responseJSON;
 		});
 		jQuery("[rel='actualizarorden_competencia']").off();
		jQuery("[rel='actualizarorden_competencia']").on("click",function(){
			var objs=jQuery("#view_data").find("ul").find("li");
			var competencias={};
			jQuery.each(objs,function(k,d){
				var keyid=jQuery(d).find("strong").attr("id").split("_")[1];
				competencias[k]=keyid;
			});
 			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyidproyecto:acciones.dataproyect["key"],
 				competencias:competencias,
  				mode:"get",
  				get:"ordenarcompetencias"
				},
				success:function(res){
				}
			}).responseJSON;			
			
			
			
		});
 		jQuery("[rel='agregar_competencia']").off();
		jQuery("[rel='agregar_competencia']").on("click",function(){
			var obj=jQuery(this).parent().parent().parent();
			
			
			var preguntas=jQuery("#formulario").find("[rel='pregunta']");
			var objpreg={};
			jQuery.each(preguntas,function(k,d){
				objpreg[k]=jQuery(d).find('textarea').val();
			});
			
			console.log("LAS PREGUTNAS");
			console.log(objpreg);
 			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				key:acciones.dataproyect["key"],
 				nombre:obj.find("[name='nombrecompetencia']").val(),
				descripcion:obj.find("[name='descripcioncompetencia']").val(),
  				mode:"get",
				preguntas:objpreg,
 				get:"agregarcompetencia"
				},
				success:function(res){
				}
			}).responseJSON;
			if(res["existe"]=="NO"){
				var  htmlt=' <li class="list-group-item" id="itempar-'+res["key"]+'"  style="display:none">';
				htmlt+=' <strong id="nombre_'+res["key"]+'"> '+obj.find("[name='nombrecompetencia']").val()+' ';
				htmlt+='</strong> <span class="pull-right text-muted small">';
				htmlt+='<a href="javascript:;" rel="editarcompetencia_'+res["key"]+'" title="<?=$idioma->{"editar"}?>" rel="competencia_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
				htmlt+=' <a href="javascript:;" rel="editarcompetencia_'+res["key"]+'" title="<?=$idioma->{"eliminar"}?>" rel="competencia_eliminar"><i class="fa fa-trash fa-2x"></i></a>'; 
				htmlt+='  </span>';
				htmlt+=' </li>';							 
  				jQuery("#view_data").append(htmlt);
  				jQuery("#view_data").show();
  				jQuery("#itempar-"+res["key"]).show("slow");
				acciones.competencias();
				
				jQuery("[rel='agregar_preguntas']").show();
				jQuery("[rel='agregar_preguntas']").attr({"id":"cp_"+res["key"]});
			}else{
				jQuery.colorbox({html:"<center><h2>Ya existe esta competencia en el proyecto</h2></center>"});
			}
			jQuery("[href='#competencias']").click();
			
		});
		
		jQuery("[rel^='competencia_']").off();
		jQuery("[rel^='competencia_']").on("click",function(){ console.log("COMPETENCIAS ACA");
			var option=jQuery(this).attr("rel").split("_")[1];
			var llave=jQuery(this).attr("id").split("_")[1];
			switch(option){
				case "editar":
 					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
					keyidcompetencia:llave,
					keyidproyecto:acciones.dataproyect["key"],
					get:"competencias"
					},
					success:function(res){
						if(res[0]=="ok"){jQuery("#formulario").show();
							var datos=res[1][0];
							jQuery("#formulario").find("[name='nombrecompetencia']").val(datos["nombre_esp"]);
							jQuery("#formulario").find("[name='descripcioncompetencia']").val(datos["descripcion_esp"]);
							jQuery("#formulario").find("[name='keyid']").val(datos["keyid"]);
							
							var preguntas=datos["preguntas"];
							
							jQuery("#formulario").find(".sortable").html("");
							var segundos=100;
 							jQuery.each(preguntas,function(k,data){
								var li='';
								var id=(parseInt(k)+1);
								li+='<li class="ui-state-default" rel="pregunta" id="'+data["keyid"]+'" style="display:none">'+id+'<br><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>';
								li+='<textarea type="text" style="width:94%;margin-right:5px;height:35px" rel="p_'+data["keyid"]+'_'+datos["keyid"]+'_'+datos["keyidproyecto"]+'" >'+data["enunciado"]+'</textarea>';
								li+='<a href="javascript:;" rel="eliminarpregunta"><i class="fa fa-trash" aria-hidden="true"></i></a>';
								li+='</li>';

								
									
								jQuery("#formulario").find(".sortable").append(li);
								setTimeout(function(){jQuery("#formulario").find("#"+data["keyid"]).fadeIn();},segundos);
								segundos=segundos+100;
							});
							jQuery("#formulario").find("[rel='agregar_competencia']").val("<?=$idioma->{"actualizar"}?>");
							jQuery("#formulario").find("[rel='agregar_competencia']").attr({"rel":"editar_competencia"});
							
 						}else{
							jQuery.colorbox({html:"<center><h2>La competencia no existe</h2></center>"});

						}
						acciones.competencias();
					}
				}).responseJSON;
				
				
				
				break;
				
				case "eliminar":
				
 					if(confirm("<?=$idioma->{"seguroeliminarrelacion"}?>")){

						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
 						key:llave,
						mode:"get",
						get:"eliminarrelacion",
						},
						success:function(res){
							if(res[0]=="ok"){
								jQuery("#nombre_"+llave).parent().remove();
								jQuery.colorbox({html:"<center><h2>La relación ha sido eliminada del proyecto</h2></center>"});
							}else{
								jQuery.colorbox({html:"<center><h2>La relación no existe</h2></center>"});

							}
						}
						}).responseJSON;
					}
 				
				break;
				
			}
		});
 	},
 prevencuesta:function(){
	 jQuery("#colorbox").find("#resolver_encuesta").find("[type='button']").on("off");
	 jQuery("#colorbox").find("#resolver_encuesta").find("[type='button']").on("click",function(){
		 var keyidp=jQuery(this).attr("name");
		 jQuery.each(jQuery("[name='"+keyidp+"']"),function(k,d){
			 jQuery(d).removeClass("selected_r");
		 });
		 jQuery(this).addClass("selected_r");  

	 });
 },
	competenciasxevaluado:function(){
		jQuery("[rel='previsualizar']").off();
 		jQuery("[rel='previsualizar']").on("click",function(){
			var id=jQuery(this).attr("id");
			var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{get:"previsualizarencuesta",keyidproyecto:acciones.dataproyect["key"],keyid:id,mode:'get'},
					success:function(res){
						if(res[0]=="ok"){
							var encuesta='<div class="list-group" id="resolver_encuesta"></div>';
							jQuery.colorbox({html:encuesta,width:"99%","height":"99%"});
							var datosencuesta=res[1]["proyecto"]["contexto"];
							var nombreproyecto=res[1]["proyecto"]["nombre"];
							var contador=0;
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
								
  
								
									
									var categorias='<div class="col-lg-12">'+titulo;
									var preguntas=d["preguntas"];
									jQuery.each(preguntas,function(kk,pp){
										var escala='<br><br><div style="clear:both"></div>';
										 
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

											var wha=jQuery("#colorbox").width()-40;
											var whb=wha/res[2][2];

											var whp=(whb*100)/wha;

											//escala+='<div class="col-lg-12">';
											escala+='<div class="col-lg-12">';
											
											
											var testcols=((redondeo((12/res[2][2]),0)));

											if(testcols*12>12){
												testcols=testcols-1;
											}											
											
											for(var i=1;i<=res[2][2];i++){
												escala+='<div style="width:'+whp+'%;float:left">';
												escala+='<input type="button" name="'+pp["keyid"]+'"  style="width:30px;height:30px;border-radius:20px" value="'+i+'" />';
												escala+='</div>';
 												
											}
											 escala+='<div style="clear:both"></div>';
											 escala+='</div>';
											// escala+='<div style="clear:both"></div>';
											// escala+='</div>';
											
											escala+='<div class="col-lg-12">';
											escala+='<div class="col-lg-12">';
											
											var wha=jQuery("#colorbox").width()-40;
											var whb=wha/res[2][3];

											var whp=(whb*100)/wha;


											
											
											jQuery.each(res[2][1],function(kkk,ddd){
												escala+='<div style="width:'+whp+'%;float:left">';
												escala+='<strong>'+ddd+' </strong>';
												escala+='</div>';
 												
											});
											
											 escala+='<div style="clear:both"></div>';
											 escala+='</div>';escala+='<div style="clear:both"></div>';
											 escala+='</div>';
											
										}
										var na='<div class="col-lg-12">';
										na+='<div class="col-lg-11"></div>';
										na+='<div class="col-lg-1">';
 										na+='<input type="button" name="'+pp["keyid"]+'"  style="width:45px;height:30px" value="N/A" />';
										na+='</div></div>';
 											 
										 
										categorias+='<li class="list-group-item" rel="'+pp["keyid"]+'"><strong>'+pp["enunciado"]+'</strong>'+na+escala+'<div style="clear:both"></div></li>';
									});
									
								
								
								
								categorias+='<div style="clear:both"></div></div>';
								jQuery("#colorbox").find("#resolver_encuesta").append(categorias);
								acciones.prevencuesta();
								contador++;
 							});
							if(res[3]!="no"){
								var na='<div class="col-lg-12"><h4>Preguntas abiertas</h4>';
								 
								jQuery.each(res[3],function(id,enunciado){
									na+='<li class="list-group-item" >';
									na+='<strong>'+enunciado[0]+'</strong>';
									na+='<div style="clear:both"></div>';
									na+='<textarea   name="'+enunciado[1]+'"  style="width:60%;height:150px"   ></textarea><div style="clear:both"></div>';
									na+='</li>';
	 
								});
								na+='<div style="clear:both"></div></div>';

								jQuery("#colorbox").find("#resolver_encuesta").append(na);
							}
						}
				
					}
			});
			
		});
		jQuery("[rel^='competenciasxevaluado_']").off();
 		jQuery("[rel^='competenciasxevaluado_']").on("click",function(){
			var keyid=jQuery(this).attr("id").split("_")[1];
							
				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{get:"competenciasdisponibles",keyidproyecto:acciones.dataproyect["key"],keyid:keyid,mode:'get'},
					success:function(res){
						if(res[0]=="ok"){
							var html='';
							var competencias=res[1][0]["jsoncompetencias"];
							var competenciasexclude=res[1][0]["competenciasexclude"];
							
							
							var html='<div class="col-lg-12"><div  class="list-group">';
							html+='<h4 class="ui-widget-header"><?=$idioma->{"competenciasasignadasalparticipante"}?> '+res[1][0]["apellido"]+' '+res[1][0]["nombre"]+' </h4><br>';
							html+='<input id="'+res[1][0]["keyid"]+'" type="button" value="<?=$idioma->{"previsualizar"}?> " rel="previsualizar">';
							html+='<ul   class="ui-helper-reset" id="competenciasasignadasp" style="min-height:100px"></ul><div style="clear:both"></div>';
							html+='</div><input type="button" value="<?=$idioma->{"guardar"}?>" rel="actualizar_competencias" id="'+keyid+'" />';
  							jQuery("#formulario").html(html);
 							jQuery.each(competencias,function(k,d){
								var lista='';
								lista+='<li class="list-group-item">';
								lista+='<div style="float:left;margin-left:4px"><input type="checkbox" rel="'+k+'" checked="checked"></div><div style="float:left;margin-left:7px"> '+d;
								lista+='</div><div style="clear:both"></div></li>';
								jQuery("#formulario").find("#competenciasasignadasp").append(lista);
							});
							
 							jQuery.each(competenciasexclude,function(k,d){
								var lista='';
								lista+='<li class="list-group-item">';
								lista+='<div style="float:left;margin-left:4px"><input type="checkbox" rel="'+k+'" checked="checked"></div><div style="float:left;margin-left:7px"> '+d;
								lista+='</div><div style="clear:both"></div></li>';
								jQuery("#formulario").find("#competenciasasignadasp").append(lista);
							});
 							acciones.competenciasxevaluado();
						}
					}});
			
		});
			
		jQuery("[rel='actualizar_competencias']").off();
		jQuery("[rel='actualizar_competencias']").on("click",function(){
			
			var keyid=jQuery(this).attr("id");
			var competencias={};
			var objs=jQuery("#formulario").find("ul").find("li");
			
			jQuery.each(objs,function(k,d){
				var datainput=jQuery(d).find("input").is(":checked");
				var keyidt=jQuery(d).find("input").attr("rel");
				var nombre=jQuery(d).text();
				if(datainput==true){
					competencias[keyidt]=nombre;
				}
			})
			
			var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
			data:{get:"actualizarcompetenciasparticipante",competencias:competencias,keyidproyecto:acciones.dataproyect["key"],keyid:keyid,mode:'get'},
			success:function(res){
				if(res[0]=="ok"){
				//jQuery("[href='#competenciasxevaluado']").click();
				jQuery.colorbox({html:"<center><h2>Las competencias para este participante han sido actualizadas</h2></center>"});
				}else{
				jQuery.colorbox({html:"<center><h2>No es posible llevar a cabo esta acción, probablemente el participante no permite ser evaluado</h2></center>"});

				}

				
			}});

			
		});
		
		
	},
	escalas:function(){
		
		
		
 		jQuery("[rel='agregar_escala']").off();
		jQuery("[rel='agregar_escala']").on("click",function(){
			var obj=jQuery(this).parent().parent().parent();
			
			
			var descriptores=jQuery("#formulario").find("[rel='descriptor']");
			var objpreg={};
			jQuery.each(descriptores,function(k,d){
				objpreg[k]=jQuery(d).find('input').val();
			});
			
			var aplicar="0";
			if(obj.find("[name='aplicar']").is(":checked")){
				aplicar="1";
			}
  			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				key:acciones.dataproyect["key"],
 				nombre:obj.find("[name='escala']").val(),
				abreviacion:obj.find("[name='abreviacionescala']").val(),
				preguntaescala:obj.find("[name='preguntaescala']").val(),
				aplicar:aplicar,
				rangoescala:obj.find("[name='rangoescala']").val(),
  				mode:"get",
				descriptores:objpreg,
 				get:"agregarescala"
				},
				success:function(res){
				}
			}).responseJSON;
			 
			jQuery("[href='#escalas']").click();
			
		});		
		
		
		
		
		
		jQuery("[rel='cancelar_escala']").off();
		jQuery("[rel='cancelar_escala']").on("click",function(){
			jQuery("[href='#escalas']").click();
 		});
		
 		jQuery("[rel='editar_escala']").off();
		jQuery("[rel='editar_escala']").on("click",function(){
 			var obj=jQuery(this).parent().parent().parent();
			var llave=obj.find("[name='keyid']").val();
			var llavesp={};
			var objpreg=obj.find("ul").find("li");
			var enunciado="";
			var kidp="";
			jQuery.each(objpreg,function(k,d){
				enunciado=jQuery(d).find("input").val();
				var rel=jQuery(d).find("input").attr("rel");
 				llavesp[k]=enunciado;
			}) 
			var aplicar="0";
			if(obj.find("[name='aplicar']").is(":checked")){
				aplicar="1";
			}
			var res=jQuery.ajax({ 
				type: "POST",
				dataType: "json",
				async: false,
				url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
				data:{
				keyid:obj.find("[name='keyid']").val(),
				descriptores:llavesp,
				keyproyecto:acciones.dataproyect["key"],
 				nombre:obj.find("[name='escala']").val(),
 				abreviacion:obj.find("[name='abreviacionescala']").val(),
 				preguntaescala:obj.find("[name='preguntaescala']").val(),
				aplicar:aplicar,
 				rango:obj.find("[name='rangoescala']").val(),
  				mode:"get",
				get:"editarescala"
				},
				success:function(res){
					if(res[0]=="ok"){
						jQuery("#nombre_"+llave).text(obj.find("[name='nombre']").val());
						jQuery("#nombre_"+llave).show("slow");
						setTimeout(function(){
							jQuery.colorbox({html:"<center><h2>La escala ha sido actualizada</h2></center>"});
							jQuery("[href='#escalas']").click();

						},1000);
 					}else{
						jQuery.colorbox({html:"<center><h2>No es posible llevar a cabo esta acción, por favor intentelo más tarde</h2></center>"});

					}
				}
			}).responseJSON;
 		});		
		
 		
		
		
		jQuery("[rel^='escala_']").off();
		jQuery("[rel^='escala_']").on("click",function(){ console.log("COMPETENCIAS ACA");
			var option=jQuery(this).attr("rel").split("_")[1];
			var llave=jQuery(this).attr("id").split("_")[1];
			switch(option){
				case "editar":
 					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
					keyidescala:llave,
					key:acciones.dataproyect["key"],
					get:"escalas"
					},
					success:function(res){
						if(res[0]=="ok"){jQuery("#formulario").show();
							var datos=res[1][0];
							jQuery("#formulario").find("[name='escala']").val(datos["nombre"]);
							jQuery("#formulario").find("[name='abreviacionescala']").val(datos["abreviacion"]);
							jQuery("#formulario").find("[name='preguntaescala']").val(datos["preguntaescala"]);
							jQuery("#formulario").find("[name='rangoescala']").val(datos["rango"]);
							jQuery("#formulario").find("[name='keyid']").val(datos["keyid"]);
							
							var descriptores=datos["jsondesccriptor"];
							
							jQuery("#formulario").find(".sortable").html("");
							var segundos=100;
							var c=1;
 							jQuery.each(descriptores,function(k,data){
								var li='';
								li+='<li class="ui-state-default" rel="descriptor" id="'+k+'" style="display:none">'+c;
								li+=' <input type="text" style="width:90%;margin-right:5px;" rel="p_'+k+'_'+datos["keyid"]+'_'+datos["keyidproyecto"]+'"  value="'+data+'" />';
								li+='<a href="javascript:;" rel="eliminarpregunta"><i class="fa fa-trash" aria-hidden="true"></i></a>';
								li+='</li>';

								
									c++;
								jQuery("#formulario").find(".sortable").append(li);
								setTimeout(function(){jQuery("#formulario").find("#"+k).fadeIn();},segundos);
								segundos=segundos+100;
							});
							jQuery("#formulario").find("[rel='agregar_escala']").val("<?=$idioma->{"actualizar"}?>");
							jQuery("#formulario").find("[rel='agregar_escala']").attr({"rel":"editar_escala"});
							
 						}else{
							jQuery.colorbox({html:"<center><h2>La competencia no existe</h2></center>"});

						}
						acciones.escalas();
					}
				}).responseJSON;
				
				
				
				break;
				
				case "eliminar":
				
 					if(confirm("<?=$idioma->{"seguroeliminarrelacion"}?>")){

						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
 						key:llave,
						mode:"get",
						get:"eliminarrelacion",
						},
						success:function(res){
							if(res[0]=="ok"){
								jQuery("#nombre_"+llave).parent().remove();
								jQuery.colorbox({html:"<center><h2>La relación ha sido eliminada del proyecto</h2></center>"});
							}else{
								jQuery.colorbox({html:"<center><h2>La relación no existe</h2></center>"});

							}
						}
						}).responseJSON;
					}
 				
				break;
				
			}
		});		
		
		
		
		
		
		
		
		
		
		
		
		
		jQuery("[rel='agregardescriptor']").off();
		jQuery("[rel='agregardescriptor']").on("click",function(){
			var obj=jQuery("#formulario").find("#lista_descriptores").find("ul");
			var li='<li class="ui-state-default" rel="descriptor"><span class="ui-icon  "  style="text-indent:0;font-size:15px">'+(jQuery("#formulario").find("#lista_descriptores").find("[rel='descriptor']").size()+1)+'</span>';
				li+='<input type="text" style="width:94%"/>';
				li+='<a href="javascript:;" rel="eliminardescriptor"><i class="fa fa-trash" aria-hidden="true"></i></a>';
				li+='</li>'; 
			
			obj.append(li);
			//jQuery( ".sortable" ).sortable();
			//jQuery( ".sortable" ).disableSelection();

			acciones.escalas();
		});


		jQuery("[rel='eliminardescriptor']").off();
		jQuery("[rel='eliminardescriptor']").on("click",function(){
			var text=jQuery(this).parent().find("input").val(); 
			var rel=jQuery(this).parent().find("input").attr("rel");
			console.log(rel+" valor rel");
			var validar=true;
			var eliminarcompletamente="NO";
			if(text.trim(" ")!=""){
				if(!confirm("<?=$idioma->{"celiminarpregunta"}?>")){
					validar=false;
				}
			}
			if(validar==true){
 				var input=jQuery(this).parent().find("input").attr("rel");
				if(input !="" && input !=undefined){
					if(confirm("<?=$idioma->{"elimpregunta"}?>") ){
						eliminarcompletamente="SI"; 
					}
 					var lineq=jQuery(this);
					var llavest=input.split("_");
					
					var llaves={"idpregunta":llavest[1],"idcompetencia":llavest[2],"idproyecto":llavest[3]}
					
					var res=jQuery.ajax({ 
							type: "POST",
							dataType: "json",
							async: false,
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
							data:{
							llaves:llaves,
							keyproyecto:acciones.dataproyect["key"],
							mode:"get",
							eliminarcompletamente:eliminarcompletamente,
							get:"eliminarpregunta"
							},
							success:function(res){
 								if(res[0]=="ok"){
									//jQuery.colorbox({html:"<center><h2>La pregunta ha sido eliminada de la categoría</h2></center>"});
									lineq.parent().remove();
								}
								
								if(res[0]=="okok"){
									//jQuery.colorbox({html:"<center><h2>La pregunta ha sido eliminada en todas las categorias</h2></center>"});
									lineq.parent().remove();
								}
								if(res[0]=="no1"){
									jQuery.colorbox({html:"<center><h2>La pregunta no existe en esta categoría</h2></center>"});
								}
 							}
					});					
					
					
					
					
					
					
				}else{
					jQuery(this).parent().remove();
				}
				acciones.competencias();
			}
 		});
		
		
 		
		
	},
	preguntas_abiertas:function(){
		
 
		
		jQuery("[rel^='preguntas_abiertas_']").off();
		jQuery("[rel^='preguntas_abiertas_']").on("click",function(){
			var obj=jQuery(this).attr("rel").split("preguntas_abiertas_")[1];
			
			switch(obj){
				case "editar":
					var id=jQuery(this).attr("id").split("preguntas_abiertas_")[1];
					jQuery("#formulario").find("[name='enunciado']").val(jQuery("#nombre_"+id).text());
					jQuery("#formulario").find("[name='keyid']").val(id);
					jQuery("#formulario").find("[rel='preguntas_abiertas_agregarpa']").val("<?=$idioma->actualizar?>");
					jQuery("#formulario").find("[rel='preguntas_abiertas_agregarpa']").attr({"rel":"preguntas_abiertas_editarpa"});
				break;
				case "editarpa":
					var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						key:acciones.dataproyect["key"],
						enunciado:jQuery("#formulario").find("[name='enunciado']").val(),
						keyid:jQuery("#formulario").find("[name='keyid']").val(),
						mode:"get",
						get:"editarpa"
						},
						success:function(res){
						}
					}).responseJSON;
					 
					jQuery("[href='#preguntas_abiertas']").click();				
 				break;
				case "cancelarpa":
					jQuery("[href='#preguntas_abiertas']").click();	
				break;
				case "agregarpa": console.log("ACA PA");
					var obj=jQuery(this).parent().parent().parent();
 					var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						key:acciones.dataproyect["key"],
						enunciado:obj.find("[name='enunciado']").val(),
						mode:"get",
						get:"agregarpa"
						},
						success:function(res){
							if(res[0]=="ok"){
								//jQuery.colorbox({html:"<center><h2>La pregunta ha sido creada</h2></center>"});
							jQuery("[href='#preguntas_abiertas']").click();
							}else{
								jQuery.colorbox({html:"<center><h2>No fue posible realizar esta acción, por favor contacte al administrador</h2></center>"});
							}
						}
					}).responseJSON;
 
				break;
				case "eliminarpa": //console.log("ACA PA");
					var obj=jQuery(this).parent().parent().parent();
 					var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						key:acciones.dataproyect["key"],
						keyid:obj.find("[name='keyid']").val(),
						mode:"get",
						get:"eliminarpa"
						},
						success:function(res){
							if(res[0]=="ok"){
								jQuery.colorbox({html:"<center><h2>La pregunta ha sido eliminada</h2></center>"});
								jQuery("[href='#preguntas_abiertas']").click();
							}else{
								jQuery.colorbox({html:"<center><h2>No fue posible realizar esta acción, por favor contacte al administrador</h2></center>"});
							}
						}
					}).responseJSON;
 
				break;
			}
			 
			
		});		
		
		
		
		
		
	},
		mailing_data:{"id":""},
	mailing_seleccionados:{},
	mailing:function(){
		jQuery("#formulario").find('[name="html"]').summernote({height:200,tabsize:1}); 
		if(acciones.mailing_seleccionados[acciones.mailing_data["id"]]==undefined && acciones.mailing_data["id"]!=""){
			acciones.mailing_seleccionados[acciones.mailing_data["id"]]=[];
		}else if(acciones.mailing_data["id"]==""){
			acciones.mailing_seleccionados["NUEVOMAILING"]=[];
			acciones.mailing_data["id"]="NUEVOMAILING";
		}
 		
		jQuery("[rel^='mailing_']").off();
		jQuery("[rel^='mailing_']").on("click",function(){  
			var option=jQuery(this).attr("rel").split("_")[1];
			
			switch(option){
				case "verbio":
					var id=jQuery(this).attr("id");
					jQuery("[rel^='bio_']").hide();
					jQuery("[rel='"+id+"']").show();
				break;
				case "aplicarbio":
					var idb=jQuery(this).attr("id").split("_")[1];
					var nombre=jQuery("#b_"+idb).find("#itemname").html();
					var html=jQuery("#b_"+idb).find(".bio").html();
					jQuery("#formulario").find('[name="nombre"]').val(nombre); 
					jQuery("#formulario").find('[name="html"]').summernote("code",html); 
					jQuery.colorbox.close();
				break;
 				case "biblioteca":
 					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
 					get:"bibliotecamailing"
					},
					success:function(res){
						if(res[0]=="ok"){
							var html='<div class="panel-body" id="biblioteca">';
								
								jQuery.each(res[1],function(k,d){
								 html+='<li class="list-group-item" id="b_'+d["id"]+'" > ';
									html+='<strong id="itemname">'+d["nombre"]+'</strong>';
 									html+='<span class="pull-right text-muted small"><input type="button" id="item_'+d["id"]+'"  rel="mailing_aplicarbio"  value="<?=$idioma->aplicar?>" >  </span>';
									html+='<span class="pull-right text-muted small"><a href="javascript:;" id="bio_'+d["id"]+'"  rel="mailing_verbio"><i class="fa fa-search-plus fa-2x"></i></a>  </span>';
									html+='<div rel="bio_'+d["id"]+'" class="panel panel-default" style="display:none" >'; 
										html+='<div  class="panel-heading">';
										 	html+='<div class="bio" style="background-color:#fff;padding:10px">';
											html+=d["html"];
										 	html+='</div>';
										html+='</div>';
										html+='<span class="pull-right text-muted small"><input type="button" id="item_'+d["id"]+'"  rel="mailing_aplicarbio"  value="<?=$idioma->aplicar?>" ></span>';
									html+='<div style="clear:both"></div>';
									html+='</div>';
									html+='<div style="clear:both"></div>';
									html+='</li>';
								});
							
							html+='</div>';   
							jQuery.colorbox({html:html,width:"70%",height:"50%"});
 						}else{
							jQuery.colorbox({html:"<center><h2>No hay biblioteca disponible</h2></center>"});

						}
						acciones.mailing();
					}
					}).responseJSON;				
				break;
				case "editar":
					
						var llave=jQuery(this).attr("id").split("_")[1];

						acciones.mailing_data["id"]=llave;
						if(acciones.mailing_seleccionados[acciones.mailing_data["id"]]==undefined){
							acciones.mailing_seleccionados[acciones.mailing_data["id"]]=[];
						}else if(acciones.mailing_data["id"]==""){
							acciones.mailing_seleccionados["NUEVOMAILING"]=[];
						}
						
						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						mode:"get",
						id:llave,
						key:acciones.dataproyect["key"],
						get:"mailing"
						},
						success:function(res){
							if(res[0]=="ok"){jQuery("#formulario").show();
								var datos=res[1][0];
								jQuery("#formulario").find("[name='nombre']").val(datos["nombre"]);
								//jQuery("#formulario").find("[name='html']").val(datos["html"]);
								jQuery("#formulario").find('[name="html"]').summernote("code",datos["html"]); 
								jQuery("#formulario").find("[name='asunto']").val(datos["asunto"]);
								 acciones.mailing_seleccionados[acciones.mailing_data["id"]]=datos["participantes"];
								jQuery("#formulario").find("[rel='mailing_guardar']").val("<?=$idioma->{"actualizar"}?>");
								jQuery("#formulario").find("[rel='mailing_guardar']").attr({"rel":"mailing_actualizar"});
								try{
								jQuery("#formulario").find("[rel='mailing_enviar']").val("<?=$idioma->enviar?> a "+acciones.mailing_seleccionados[acciones.mailing_data["id"]].length+" participantes");
								}catch(e){console.log(e);}
							}else{
								jQuery.colorbox({html:"<center><h2>El template no existe</h2></center>"});

							}
							acciones.mailing();
						}
					}).responseJSON;
 				
 				break;
				
				case "clonar":
					var llave="NUEVOMAILING";
 					acciones.mailing_data["id"]=llave;
					acciones.mailing_seleccionados["NUEVOMAILING"]=[];
  					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
					id:llave,
					key:acciones.dataproyect["key"],
					get:"mailing"
					},
					success:function(res){
						if(res[0]=="ok"){jQuery("#formulario").show();
							var datos=res[1][0];
							jQuery("#formulario").find("[name='nombre']").val(datos["nombre"]);
							//jQuery("#formulario").find("[name='html']").val(datos["html"]);
							jQuery("#formulario").find('[name="html"]').summernote("code",datos["html"]); 
							jQuery("#formulario").find("[name='asunto']").val(datos["asunto"]);
							acciones.mailing_seleccionados["NUEVOMAILING"]=[];
 							jQuery("#formulario").find("[rel='mailing_guardar']").val("<?=$idioma->{"actualizar"}?>");
							jQuery("#formulario").find("[rel='mailing_guardar']").attr({"rel":"mailing_actualizar"});
							
 						}else{
							jQuery.colorbox({html:"<center><h2>La competencia no existe</h2></center>"});

						}
						acciones.mailing();
					}
				}).responseJSON;
				jQuery("#formulario").find("[rel='mailing_enviar']").val("<?=$idioma->enviar?> a "+acciones.mailing_seleccionados[acciones.mailing_data["id"]].length+" participantes");
 				break;				
				
 				case "seleccionar": 
					var idpar=jQuery(this).attr("id").split("seleccionar_")[1];
					if(jQuery(this).attr("class")=="selected"){
  						jQuery(this).removeAttr("class");
 						jQuery(this).html('<li class="fa fa-circle-o fa-2x"></li>');
						if(acciones.mailing_seleccionados[acciones.mailing_data["id"]]!=undefined){
							var index=acciones.mailing_seleccionados[acciones.mailing_data["id"]].indexOf(idpar);
							if(index>=0){
								acciones.mailing_seleccionados[acciones.mailing_data["id"]].splice(index,1);
							}
						}
					}else{
 						jQuery(this).attr({"class":"selected"});
						jQuery(this).html('<li class="fa fa-check fa-2x"></li>');
						if(acciones.mailing_seleccionados[acciones.mailing_data["id"]]!=undefined){
							var index=acciones.mailing_seleccionados[acciones.mailing_data["id"]].indexOf(idpar);
							if(index==-1){
 							acciones.mailing_seleccionados[acciones.mailing_data["id"]].push(idpar);
							}
 						}
					}
					jQuery("#formulario").find("[rel='mailing_enviar']").val("<?=$idioma->enviar?> a "+acciones.mailing_seleccionados[acciones.mailing_data["id"]].length+" participantes");
				break;
				case "seleccionartodo":
					var obj=jQuery("#view_data_mailing").find("a[rel='mailing_seleccionar']");
					jQuery.each(obj,function(kob,dob){
						var idpar=jQuery(dob).attr("id").split("seleccionar_")[1];
  						jQuery(dob).removeAttr("class");
 						jQuery(dob).attr({"class":"selected"});
						jQuery(dob).html('<li class="fa fa-check fa-2x"></li>');
						if(acciones.mailing_seleccionados[acciones.mailing_data["id"]]!=undefined){
							var index=acciones.mailing_seleccionados[acciones.mailing_data["id"]].indexOf(idpar);
							if(index==-1){
 							acciones.mailing_seleccionados[acciones.mailing_data["id"]].push(idpar);
							}
 						}
 					});
					jQuery("#formulario").find("[rel='mailing_enviar']").val("<?=$idioma->enviar?> a "+acciones.mailing_seleccionados[acciones.mailing_data["id"]].length+" participantes");
				break;
				case "desseleccionartodo":
					var obj=jQuery("#view_data_mailing").find("a[rel='mailing_seleccionar']");
					jQuery.each(obj,function(kob,dob){
						var idpar=jQuery(dob).attr("id").split("seleccionar_")[1];
   						jQuery(dob).removeAttr("class");
 						jQuery(dob).html('<li class="fa fa-circle-o fa-2x"></li>');
						if(acciones.mailing_seleccionados[acciones.mailing_data["id"]]!=undefined){
							var index=acciones.mailing_seleccionados[acciones.mailing_data["id"]].indexOf(idpar);
							if(index>=0){
								acciones.mailing_seleccionados[acciones.mailing_data["id"]].splice(index,1);
							}
						}
 					});
					jQuery("#formulario").find("[rel='mailing_enviar']").val("<?=$idioma->enviar?> a "+acciones.mailing_seleccionados[acciones.mailing_data["id"]].length+" participantes");
 				break;
				case "participantes":
				
 					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
 					key:acciones.dataproyect["key"],
					get:"participantes_mailing"
					},
					success:function(res){
								
						if(res[0]=="ok"){
							
							
							var html='<div class="panel panel-default">';
							html+='	<div class="panel-heading">';
							html+='<i class="fa  fa-gears  fa-fw"></i><strong id="idItem"><?=$idioma->participantes?></strong>';
							html+='</div>';

							html+='<div class="panel-body">';
							
							var htmsq='<div class="list-group" id="view_data" style="display: block;">';
								htmsq+='<li class="list-group-item">';
								htmsq+='<strong><?=$idioma->nombre?>:</strong> <input type="text" rel="mailing_sq" name="nombre" style="width:30%" />';
								htmsq+='</li>';
								htmsq+='<li class="list-group-item">';
								htmsq+='<strong><?=$idioma->apellido?>:</strong> <input type="text"  rel="mailing_sq" name="apellido" style="width:30%" />';
								htmsq+='</li>';
								htmsq+='<li class="list-group-item">';
								htmsq+='<strong><?=$idioma->estado?>:</strong>';
								htmsq+='<select  rel="mailing_sq" name="estado">';
								htmsq+='<option value=""><?=$idioma->mailing_seleccioneunestado?></option>';
								htmsq+='<option value="1"><?=$idioma->completo?></option>';
								htmsq+='<option value="0"><?=$idioma->incompleto?></option>';
								htmsq+='<option value="2"><?=$idioma->todos?></option>';
								htmsq+='</select>';
								htmsq+='</li>';
								htmsq+='<li class="list-group-item">';
								htmsq+='<input type="button" value="<?=$idioma->buscar?>" rel="mailing_buscarparticipantes">';
								htmsq+='</li>';
								htmsq+='</div>';
							
							
							html+='<div class="panel-body"><strong><?=$idioma->buscar?></strong>'+htmsq+'</div>';
							html+='	<div class="list-group" id="view_data_mailing" style="display: block;"> ';
									html+='<li class="list-group-item">';
									html+='<input type="button" style="float:left;margin-left:5px" rel="mailing_seleccionartodo" value="<?=$idioma->seleccionartodo?>" />'; 
									html+='<input type="button" style="float:left;margin-left:5px" rel="mailing_desseleccionartodo" value="<?=$idioma->desseleccionartodo?>" />'; 
									html+='<div style="clear:both"></div></li>';							
							var seleccionados=acciones.mailing_seleccionados[acciones.mailing_data["id"]];
							
 							jQuery.each(res[1],function(k,d){
								
								html+='<li class="list-group-item">';
								
									var classsel='';
									var liclass='fa fa-circle-o fa-2x';
									if(seleccionados!=undefined && Array.isArray(seleccionados)){
										if(seleccionados.indexOf(d["keyid"])>=0){
											classsel=' class="selected"';
											liclass='fa fa-check fa-2x'
										}
									}
									html+='<strong id="nombre_undefined"> '+d["nombre"]+' '+d["apellido"]+'</strong> ';
									html+='<span class="pull-right text-muted small">';
									html+='<a href="javascript:;" id="seleccionar_'+d["keyid"]+'"  '+classsel+' rel="mailing_seleccionar"><i class="'+liclass+'"></i>';
									html+='</a>  ';
									html+='</span>'; 
									html+='</li>';
							})
						
							html+='	</div>';
							html+=' </div>';
							html+='</div>';
						
							jQuery.colorbox({html:html,width:"60%",height:"70%"});
							acciones.mailing();
						}
					}});
 				
				break;
				case "buscarparticipantes":
				var object={};
					jQuery.each(jQuery("#colorbox").find("[rel='mailing_sq']"),function(){
						if(jQuery(this).val()!=""){
							object[jQuery(this).attr("name")]=jQuery(this).val();
						}
					});
					object["mode"]="get";
					object["key"]=acciones.dataproyect["key"];
					object["get"]="participantes_mailing";
					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:object,
					success:function(res){
						if(res[0]=="ok"){
							var html='';
							html+='<li class="list-group-item">';
							html+='<input type="button" style="float:left;margin-left:5px" rel="mailing_seleccionartodo" value="<?=$idioma->seleccionartodo?>" />'; 
							html+='<input type="button" style="float:left;margin-left:5px" rel="mailing_desseleccionartodo" value="<?=$idioma->desseleccionartodo?>" />'; 
							html+='<div style="clear:both"></div></li>';							
							var seleccionados=acciones.mailing_seleccionados[acciones.mailing_data["id"]];
							jQuery.each(res[1],function(k,d){
								var classsel='';
								var liclass='fa fa-circle-o fa-2x';
								if(seleccionados!=undefined && Array.isArray(seleccionados)){
									if(seleccionados.indexOf(d["keyid"])>=0){
										classsel=' class="selected"';
										liclass='fa fa-check fa-2x'
									}
								}
 								html+='<li class="list-group-item">';
								html+='<strong id="nombre_undefined"> '+d["apellido"]+' '+d["nombre"]+'</strong> ';
								html+='<span class="pull-right text-muted small">';
								html+='<a href="javascript:;" id="seleccionar_'+d["keyid"]+'"  '+classsel+' rel="mailing_seleccionar"><i class="'+liclass+'"></i>';
								html+='</a>  ';
								html+='</span>'; 
								html+='</li>';
							});
							if(html==''){
								html+='<li class="list-group-item">';
								html+='<strong id="nombre_undefined"> <?=$idioma->sinresultados?></strong> ';
								html+=''; 
								html+='</li>';							
							}
							jQuery("#colorbox").find("#view_data_mailing").html(html);
							acciones.mailing();
						}
						
					}});
				break;
				case "guardar":
					var valida=true;
					var nombre=jQuery("#formulario").find("[name='nombre']").val();
					if(nombre==''){
						valida=false;
						jQuery.colorbox({html:"<h2>Por favor, escriba el nombre del comunicado</h2>"});
						
					}
					if(valida==true){					
 						var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						mode:"get",
						nombre:jQuery("#formulario").find("[name='nombre']").val(),
						html:jQuery("#formulario").find('[name="html"]').summernote("code"),
						asunto:jQuery("#formulario").find("[name='asunto']").val(),
						key:acciones.dataproyect["key"],
						participantes:acciones.mailing_seleccionados[acciones.mailing_data["id"]],
						get:"guardar_mailing"
						},
						success:function(res){
							if(res[0]=="ok"){
								
								setTimeout(function(){jQuery("[href='#mailing']").click();},1000);
								
							}else{
								jQuery.colorbox({html:"<center><h2>La competencia no existe</h2></center>"});

							}
							acciones.escalas();
						}
						}).responseJSON;
					}	
					
				
				break;
				case "actualizar":
 					var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: true,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{
					mode:"get",
					id:acciones.mailing_data["id"],
					nombre:jQuery("#formulario").find("[name='nombre']").val(),
					html:jQuery("#formulario").find('[name="html"]').summernote("code"),
					asunto:jQuery("#formulario").find('[name="asunto"]').val(),
 					key:acciones.dataproyect["key"],
					participantes:acciones.mailing_seleccionados[acciones.mailing_data["id"]],
					get:"actualizar_mailing"
					},
					success:function(res){console.log(res)
						if(res[0]=="ok"){jQuery("#formulario").show();
							setTimeout(function(){jQuery("[href='#mailing']").click();},1000);
							
 						}else{
							jQuery.colorbox({html:"<center><h2>La competencia no existe</h2></center>"});

						}
						acciones.mailing();
					}
				}).responseJSON;
				
				
				
				break;
 
				case "enviar":
					var evaluados=acciones.mailing_seleccionados['NUEVOMAILING'].length;
					var losevaluados=acciones.mailing_seleccionados['NUEVOMAILING'];
					if(evaluados==0){
						if(acciones.mailing_data["id"]!=""){
							evaluados=acciones.mailing_seleccionados[acciones.mailing_data["id"]].length;
							losevaluados=acciones.mailing_seleccionados[acciones.mailing_data["id"]];
						}
					}
					var costo = 0;
					if(acciones.dataproyect.tipoproyecto == 2){
						costo = parseInt('<?=$costoproyectoclima?>');
					}
					else{
						costo = parseInt('<?=$costoevaluados360?>');
					}
					console.log(costo);
					var tevaluados= costo *evaluados;
					
					//if(parseInt('<?=$creditosdisponibles?>')>=evaluados){
						
					var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
						mode:"get",
						key:acciones.dataproyect["key"],
						participantes:losevaluados,
						get:"verificarevaluados"
						},
						beforeSend:function(){},						
						success:function(res){
							var continuar=true;
							evaluados=res.length;
							tevaluados= costo *evaluados;
							if(confirm("Se descontarán "+costo+" créditos por evaluado, en total "+tevaluados+" créditos. Desea continuar?")  ){
							if((parseInt(acciones.dataproyect["tipoproyecto"])==2 || parseInt(acciones.dataproyect["tipoproyecto"])==3))
								continuar=true;
							 

							}else{console.log("false");continuar=false;}
							if(continuar==true){
													console.log("continuar es un valor verdadero");
													var res=jQuery.ajax({ 
													type: "POST",
													dataType: "json",
													async: true,
													url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
													data:{
													mode:"get",
													id:acciones.mailing_data["id"],
													nombre:jQuery("#formulario").find("[name='nombre']").val(),
													html:jQuery("#formulario").find('[name="html"]').summernote("code"),
													asunto:jQuery("#formulario").find("[name='asunto']").val(),
													key:acciones.dataproyect["key"],
													participantes_correo:acciones.mailing_seleccionados[acciones.mailing_data["id"]],
													participantes:res,
													concopia:jQuery("#formulario").find("[name='concopia']").val(),
													tipoproyecto:acciones.dataproyect.tipoproyecto,
													tevaluados:tevaluados,
													get:"enviar_mailing"
													},
													beforeSend:function(){
														jQuery.colorbox({html:"<center><h2>Notificando a "+acciones.mailing_seleccionados[acciones.mailing_data["id"]].length+" participantes, espere un momento por favor</h2></center>"});
														jQuery("#formulario").find('[rel="mailing_enviar"]').off(); 
														jQuery("#formulario").find('[rel="mailing_enviar"]').val("Notificando, por favor espere un momento."); },
													success:function(res){
														if(res[0]=="ok"){jQuery("#formulario").show(); 
														
															if(res[1][1].length>0){
																var no='<br>';
																jQuery.each(res[1][1], function(k,d){
																	if(d["email"]==""){
																		d["email"]="<?=$idioma->erroremail?>";
																	}
																	no+='<strong>'+d["nombre"]+' '+d["apellido"]+' '+d["email"]+'</strong><br> ';
																});
																jQuery.colorbox({html:"<center><strong>No fue posible hacer el envio para los siguientes participantes, por favor verifique email de envio</strong></center><div>"+no+"</div>"});
															}else{
															jQuery.colorbox({html:"<center><h2>El email ha sido enviado</h2></center>"});
																	
																var creditos = parseInt(jQuery("#creditosdisponibles").text());
																 creditos = creditos - tevaluados;
																 jQuery("#creditosdisponibles").text(creditos);								}
															//setTimeout(function(){jQuery("[href='#mailing']").click();},1000);
															
														}else{
															jQuery.colorbox({html:"<center><h2>No fue posible hacer el envio, por favor intente más tarde, o contacte al administrador</h2></center>"});

														}
														acciones.mailing();
													}
													}).responseJSON;
																		
												}							
							
							
							
							
							
							
						}
						});
						
						
						
					//}else{
					//	jQuery.colorbox({html:"<center><h2>No fue posible hacer el envio, no tiene suficientes creditos. Por favor contacte al administrador o reduzca el numero de evaluados</h2></center>"});

					//	continuar=false;
					//}
					
				break;
				
			}
		});		
				
		
		

	},
	evaluaciones_del_participante:function(){
		jQuery("[rel^='revaluado_ver']").off();
		jQuery("[rel^='revaluado_ver']").on("click",function(){
			var obs=jQuery("#view_data").find("[id^='desplegar_']");
			jQuery.each(obs,function(k,d){
				jQuery(d).hide();
			});
 			var id=jQuery(this).attr("id").split("_")[1];
			jQuery("#desplegar_"+id).fadeIn("slow");
 			
		});	
		jQuery("[rel^='revaluado_descargar']").off();
		jQuery("[rel^='revaluado_descargar']").on("click",function(){
			var id=jQuery(this).attr("id").split("_")[1];
			jQuery(".informered").append('<input type="hidden" name="mode" value="informedered" />');
			jQuery(".informered").append('<input type="hidden" name="key" value="'+acciones.dataproyect["key"]+'" />');
			jQuery(".informered").append('<input type="hidden" name="keyid" value="'+id+'" />');
			jQuery(".informered").submit();
			jQuery(".informered").find("[name='keyid']").remove();
			
		});	
		
		jQuery("[rel='evaluaciones_del_participante_descargar']").off();
		jQuery("[rel='evaluaciones_del_participante_descargar']").on("click",function(){
 			jQuery(".informe").append('<input type="hidden" name="mode" value="informedeavance" />');
			jQuery(".informe").append('<input type="hidden" name="key" value="'+acciones.dataproyect["key"]+'" />');
			jQuery(".informe").submit();
			
		});		
		
		jQuery("[rel='evaluaciones_del_participante_descargar_red']").off();
		jQuery("[rel='evaluaciones_del_participante_descargar_red']").on("click",function(){
 			jQuery(".informered").append('<input type="hidden" name="mode" value="informedered" />');
			jQuery(".informered").append('<input type="hidden" name="key" value="'+acciones.dataproyect["key"]+'" />');
			jQuery(".informered").submit();
			
		});		
		
		
	},
	reportes:function(){
		
		jQuery("[rel='reportes_descargar']").off();
		jQuery("[rel='reportes_descargar']").on("click",function(){
			
 			jQuery(".descargarreporte").append('<input type="hidden" name="mode" value="descargarreporte" />');
			jQuery(".descargarreporte").append('<input type="hidden" name="keyid" value="'+acciones.dataproyect["key"]+'" />');
			var test=jQuery(this).attr("rel").split("reportes_descargar_pdf_")[1];
			if(test!=undefined){
				jQuery(".descargarreporte").append('<input type="hidden" name="keyidparticipante" value="'+test+'" />');
				
			}
			
			jQuery(".descargarreporte").submit();
			jQuery(".descargarreporte").find("[name='keyidparticipante']").remove();
			jQuery(".descargarreporte").find("[name='mode']").remove();
			jQuery(".descargarreporte").find("[name='keyid']").remove();
			
		});
		jQuery("[rel^='reportes_descargar_pdf']").off();
		jQuery("[rel^='reportes_descargar_pdf']").on("click",function(){
 			jQuery(".descargarreporte").append('<input type="hidden" name="mode" value="descargarreportepdf" />');
			jQuery(".descargarreporte").append('<input type="hidden" name="keyid" value="'+acciones.dataproyect["key"]+'" />');
			var test=jQuery(this).attr("rel").split("reportes_descargar_pdf_")[1];
			 
			if(test!=undefined){
				jQuery(".descargarreporte").append('<input type="hidden" name="keyidparticipante" value="'+test+'" />');
				jQuery(".descargarreporte").find("[name='mode']").val('descargarreportepdf');
				if(jQuery("#formulario").find("[name='avanzado']").is(":checked")){      
					jQuery(".descargarreporte").append('<input type="hidden" name="keyidparticipante" value="'+test+'" />');
					jQuery(".descargarreporte").find("[name='mode']").val('descargarreportepdfAvanzado');
				}
			}    
			var tcomp=jQuery("#rcomp").find("input[type='checkbox']:checked").length;
			       
			if(tcomp<=10 && tcomp>0 ){
					var objCOmp=jQuery("#rcomp").find("input[type='checkbox']:checked");
					var selectedCOmp=[];
					$.each(objCOmp,function(k,check){
						selectedCOmp.push($(check).val());
					});
					jQuery(".descargarreporte").append('<input type="hidden" name="selectedcomp" value="'+Base64.encode(JSON.stringify(selectedCOmp))+'" />');
					$.ajax(
					   { url: jQuery(".descargarreporte").attr("action"),
						 type: 'POST',//tipo de petición
						 dataType: 'json', //tipo de datos
						 data:jQuery(".descargarreporte").serialize(),
						 //jsonpCallback: 'envoltorio',  //nombre de la funcion que envuelve la respuesta
						 error: function(xhr, status, error) {
							alert("error");
						 },
						 success: function(data) {
							var url= 'https://cardiorisk.tk/reporte360/index.php';   
							if(jQuery("#formulario").find("[name='avanzado']").is(":checked")){      
 								url= 'https://cardiorisk.tk/reporte360Avanzado/index.php';    
							}

							$.ajax(
							   { url:url,
								 type: 'POST',//tipo de petición
								 dataType: 'jsonp', //tipo de datos
								 jsonpCallback: 'envoltorio',  //nombre de la funcion que envuelve la respuesta
								 data:{"json":data[0],"base":data[1][0]},
								 error: function(xhr, status, error) {
									alert("error");
								 },
								 success: function(jsonp) {
									//console.log(jsonp);
									var url= 'https://cardiorisk.tk/reporte360/';   
									if(jQuery("#formulario").find("[name='avanzado']").is(":checked")){      
										url= 'https://cardiorisk.tk/reporte360Avanzado/';    
									}
 									jQuery("body").append('<div id="ladescarga"><form id="fromaDescargaiframe" action="'+url+jsonp+'" target="descargaiframe"></form><iframe id="descargaiframe" ></iframe></div>');
									jQuery("#fromaDescargaiframe").submit();
									setTimeout(function(){
										jQuery("#ladescarga").remove();
									},300);
									setTimeout(function(){
										var url= 'https://cardiorisk.tk/reporte360/index.php';   
										if(jQuery("#formulario").find("[name='avanzado']").is(":checked")){      
											url= 'https://cardiorisk.tk/reporte360Avanzado/index.php';    
										}
										$.ajax(
										   { url:url,
											 type: 'POST',//tipo de petición
											 dataType: 'jsonp', //tipo de datos
											 jsonpCallback: 'envoltorio',  //nombre de la funcion que envuelve la respuesta
											 data:{"del":jsonp[0]},
											 error: function(xhr, status, error) {
												 
											 },
											success: function(jsonp) {}
										   });									
									},(1000*15));   
								 }
								}
							);						

						 }
						}
					);			

				jQuery(".descargarreporte").submit();
				jQuery(".descargarreporte").submit();
				jQuery(".descargarreporte").find("[name='keyidparticipante']").remove();
				jQuery(".descargarreporte").find("[name='mode']").remove();
				jQuery(".descargarreporte").find("[name='keyid']").remove();
			}else{
				jQuery.colorbox({html:"<h2>Por favor seleccione al menos una competencia</h2>"})
			}
 		});

		//implementacion de reporte avanzado con el boton 
		jQuery("[rel^='avanzado_pdf_']").off();
		jQuery("[rel^='avanzado_pdf_']").on("click",function(){
			console.log("estoy en avanzado");
 			jQuery(".descargarreporte").append('<input type="hidden" name="mode" value="descargarreporte" />');
			jQuery(".descargarreporte").append('<input type="hidden" name="keyid" value="'+acciones.dataproyect["key"]+'" />');
			var test=jQuery(this).attr("rel").split("avanzado_pdf_")[1];
			if(test!=undefined){
				jQuery(".descargarreporte").append('<input type="hidden" name="keyidparticipante" value="'+test+'" />');
				
			}
			
			jQuery(".descargarreporte").submit();
			jQuery(".descargarreporte").find("[name='keyidparticipante']").remove();
			jQuery(".descargarreporte").find("[name='mode']").remove();
			jQuery(".descargarreporte").find("[name='keyid']").remove();
			
		});
		jQuery("[rel^='avanzado_pdf_']").off();
		jQuery("[rel^='avanzado_pdf_']").on("click",function(){
			if(!confirm("Esta seguro de continuar se descontara 3 creditos por reporte")){
    				return;
			}
 			jQuery(".descargarreporte").append('<input type="hidden" name="mode" value="descargarreportepdf" />');
			jQuery(".descargarreporte").append('<input type="hidden" name="keyid" value="'+acciones.dataproyect["key"]+'" />');
			var test=jQuery(this).attr("rel").split("avanzado_pdf_")[1];
			jQuery.colorbox({html:"<h2>El costo por Participante es de 3 Cr&#233ditos el cual se descontará una &#250;nica vez.</h2>"})
			if(test!=undefined){				      
				jQuery(".descargarreporte").append('<input type="hidden" name="keyidparticipante" value="'+test+'" />');
				jQuery(".descargarreporte").find("[name='mode']").val('descargarreportepdfAvanzado');
			}    
			var tcomp=jQuery("#rcomp").find("input[type='checkbox']:checked").length;
			       
			if(tcomp<=10 && tcomp>0 ){
					var objCOmp=jQuery("#rcomp").find("input[type='checkbox']:checked");
					var selectedCOmp=[];
					$.each(objCOmp,function(k,check){
						selectedCOmp.push($(check).val());
					});
					jQuery(".descargarreporte").append('<input type="hidden" name="selectedcomp" value="'+Base64.encode(JSON.stringify(selectedCOmp))+'" />');
					$.ajax(
					   { url: jQuery(".descargarreporte").attr("action"),
						 type: 'POST',//tipo de petici�n
						 dataType: 'json', //tipo de datos
						 data:jQuery(".descargarreporte").serialize(),
						 //jsonpCallback: 'envoltorio',  //nombre de la funcion que envuelve la respuesta
						 error: function(xhr, status, error) {
							alert("error");
						 },
						 success: function(data) {
							var url= 'https://cardiorisk.tk/reporte360Avanzado/index.php';

							$.ajax(
							   { url:url,
								 type: 'POST',//tipo de petici�n
								 dataType: 'jsonp', //tipo de datos
								 jsonpCallback: 'envoltorio',  //nombre de la funcion que envuelve la respuesta
								 data:{"json":data[0],"base":data[1][0]},
								 error: function(xhr, status, error) {
									alert("error");
								 },
								 success: function(jsonp) {
									//console.log(jsonp);
									var url= 'https://cardiorisk.tk/reporte360Avanzado/';    
 									jQuery("body").append('<div id="ladescarga"><form id="fromaDescargaiframe" action="'+url+jsonp+'" target="descargaiframe"></form><iframe id="descargaiframe" ></iframe></div>');
									jQuery("#fromaDescargaiframe").submit();
									setTimeout(function(){
										jQuery("#ladescarga").remove();
									},300);
									setTimeout(function(){
										var url= 'https://cardiorisk.tk/reporte360Avanzado/index.php';    
																				$.ajax(
										   { url:url,
											 type: 'POST',//tipo de petici�n
											 dataType: 'jsonp', //tipo de datos
											 jsonpCallback: 'envoltorio',  //nombre de la funcion que envuelve la respuesta
											 data:{"del":jsonp[0]},
											 error: function(xhr, status, error) {
												 
											 },
											success: function(jsonp) {}
										   });									
									},(1000*15));   
								 }
								}
							);						

						 }
						}
					);			

				jQuery(".descargarreporte").submit();
				jQuery(".descargarreporte").submit();
				jQuery(".descargarreporte").find("[name='keyidparticipante']").remove();
				jQuery(".descargarreporte").find("[name='mode']").remove();
				jQuery(".descargarreporte").find("[name='keyid']").remove();

				jQuery.post("<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/pagarpdf",{value:1,key:acciones.dataproyect["key"],keyid:test},function(res){
					
					res = JSON.parse(res);
					console.log(res);
					if(res.status == 1){
						var creditos = parseInt(jQuery("#creditosdisponibles").text());
				   		creditos = creditos - 3;
				   		jQuery("#creditosdisponibles").text(creditos);
					}
				});
			}else{
				jQuery.colorbox({html:"<h2>Por favor seleccione al menos una competencia</h2>"})
			}
 		});
		//fin implementacion de reporte avanzado con el boton
		
		
	},
	aceptar:false,
	aceptarcondicion:function(){ 
		jQuery("[rel='aceptarcondicion']").off();
		jQuery("[rel='aceptarcondicion']").on("click",function(){
			var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: true,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/creditos",
			data:{key:acciones.dataproyect["key"]},
			success:function(res){
				if(res[0]=="ok"){
					jQuery.colorbox({html:"<b>Los créditos han sido descontados correctamente, desde este momento no podrá agregar más evaluadores.</b>"})
					setTimeout(function(){
						document.location=document.location.href;
					},2000);
					acciones.aceptar=false;
				}else{
					acciones.aceptar=true;
				}
			}});
		});
		
	},
	eventmenu:function(){
 		jQuery("[rel='menu360']").find("a").off();
 		jQuery("[rel='menu360']").find("a").on("click",function(){
			if(acciones.dataproyect["nombre"]!=""){
 				
				var hr=jQuery(this).attr("href").split("#")[1];
				console.log(hr);
				var titulo=idioma[hr];
				jQuery("#idItem").text(titulo);
				var forma=jQuery("#formas").find("[rel='"+hr+"']").clone();
				jQuery("#formulario").html(forma.html());
				eval("acciones."+hr+"()");
				jQuery("#view_data").html("");
				jQuery("#view_data").hide();

				jQuery("#formulario").find("[rel='agregar_"+hr+"']").show();
				jQuery("#formulario").find("[rel='editar_"+hr+"']").hide();

				jQuery("#etapa").show();
				jQuery("[rel='etapa']").text(titulo);  
				acciones.aceptar=true;
				if(parseInt(acciones.dataproyect["tipoproyecto"])==2 || parseInt(acciones.dataproyect["tipoproyecto"])==3){
					<?php if($validapago==false){ ?>
					if(hr=="reportes"){
						jQuery.colorbox({html:"<strong>Si hace click en aceptar, el sistema te cargara <?=$costoPDFAV?> créditos y no podrás asignar mas evaluadores a tu proyecto</strong><br><button rel='aceptarcondicion'>Aceptar</button> <button onclick='"+('jQuery("[href=#relaciones]").click();')+"jQuery.colorbox.close()'>Cancelar</button>",width:"350px",height:"150px"})
						acciones.aceptarcondicion();  
					}
					<?php } ?>
				}
				if(acciones.aceptar==true){
					var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: true,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{get:hr,key:acciones.dataproyect["key"],mode:'get'},
						success:function(res){
							jQuery("#view_data").html("");
							if(res[0]=="ok"){
								if(hr=="participantes"){
									var htmlt='';
									var participantes=res[1];
									jQuery.each(participantes,function(k,d){
										var retro=d["retroalimentacion"];
										
										//var color="#FFEFD5";
										if(retro=="S"){											
											color="#CDF9CD";
											var nombre=d["nombre"]+' '+d["apellido"];
											if(parseInt(acciones.dataproyect["tipoproyecto"])>1){
												nombre=d["nombre"];
											}
											htmlt+=' <li class="list-group-item" style="background-color:'+color+'" >';
											htmlt+='<strong id="nombre_'+d["keyid"]+'">   '+nombre;
											htmlt+='</strong> <span class="pull-right text-muted small">';
											htmlt+='<a href="javascript:;" id="editarparticipante_'+d["keyid"]+'" title="<?=$idioma->{"editar"}?>" rel="participante_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
											htmlt+=' <a href="javascript:;" id="editarparticipante_'+d["keyid"]+'" title="<?=$idioma->{"eliminar"}?>" rel="participante_eliminar"><i class="fa fa-trash fa-2x"></i></a>'; 
											htmlt+='  </span>';
											htmlt+=' </li>';
										}
										

									});
									
									jQuery.each(participantes,function(k,d){
										var retro=d["retroalimentacion"];
										if(retro!="S"){
											var color="#FFEFD5";
											htmlt+=' <li class="list-group-item" style="background-color:'+color+'" >';
											htmlt+='<strong id="nombre_'+d["keyid"]+'">   '+d["nombre"]+' '+d["apellido"];
											htmlt+='</strong> <span class="pull-right text-muted small">';
											htmlt+='<a href="javascript:;" id="editarparticipante_'+d["keyid"]+'" title="<?=$idioma->{"editar"}?>" rel="participante_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
											htmlt+=' <a href="javascript:;" id="editarparticipante_'+d["keyid"]+'" title="<?=$idioma->{"eliminar"}?>" rel="participante_eliminar"><i class="fa fa-trash fa-2x"></i></a>'; 
											htmlt+='  </span>';
											htmlt+=' </li>';										
										}
										
									
									});
									jQuery("#view_data").append(htmlt); 
									acciones.participantes();
								}
								if(hr=="relaciones"){
									var htmlt='';
									var relaciones=res[1];
									jQuery.each(relaciones,function(k,d){ console.log(d);
										htmlt+=' <li class="list-group-item" >';
										htmlt+='<strong id="nombre_'+d["keyid"]+'">   '+d["nombre"]+' ('+d["abreviacion"]+')';
										htmlt+='</strong> <span class="pull-right text-muted small">';
										htmlt+='<a href="javascript:;" id="relacion_'+d["keyid"]+'" title="<?=$idioma->{"editarrelacion"}?>" rel="relacion_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
										htmlt+=' <a href="javascript:;" id="relacion_'+d["keyid"]+'" title="<?=$idioma->{"eliminarrelacion"}?>" rel="relacion_eliminar"><i class="fa fa-trash fa-2x"></i></a>'; 
										htmlt+='  </span>';
										htmlt+=' </li>';
									});
									jQuery("#view_data").append(htmlt); 
									acciones.relaciones();	 							
								}
								if(hr=="asignaciones"){
									var htmlt='';
									var asignaciones=res[1];
									jQuery("#view_data").html("<div class='row'><div id='participantes_x_asignar' class='col-lg-12' style='height:600px;overflow-x:hidden;overflow-y:scroll'></div></div>");
									jQuery.each(asignaciones,function(k,d){ console.log(d);
										var retro=d["retroalimentacion"];
										var color="#FFEFD5";
										var nombre=d["nombre"]+' '+d["apellido"];
										if(retro=="S"){
											color="#F0FFF0";
											if(parseInt(acciones.dataproyect["tipoproyecto"])>1){
												nombre=d["nombre"];
											}										
										}
										htmlt+=' <li class="list-group-item" style="background-color:'+color+'">';
										htmlt+='<strong id="nombre_'+d["keyid"]+'">   '+nombre+'';
										htmlt+='</strong> <span class="pull-right text-muted small">';
										htmlt+='<a href="javascript:;" id="asignacion_'+d["keyid"]+'" title="<?=$idioma->{"editarrelacion"}?>" rel="asignacion_editar"><i class="fa fa-search-plus fa-2x"></i></a>'; 
										htmlt+='  </span>';
										htmlt+=' </li>';
									});
									jQuery("#view_data").find("#participantes_x_asignar").append(htmlt); 
									
									jQuery("#formulario").html("<div class='row'><div id='elparticipante'></div><div id='paraasignar' class='col-lg-12' ></div></div>");

									acciones.asignaciones();	 							
								}

								if(hr=="competencias"){
									var htmlt='';
									var competencias=res[1];
									var tipoencuesta=res[2];
									
																	
									jQuery.each(competencias,function(k,d){ console.log(d);
										htmlt+=' <li class="list-group-item ui-state-default" ><span class="ui-icon ui-icon-arrowthick-2-n-s"  style="float:left"></span>';
										htmlt+='<strong id="nombre_'+d["keyid"]+'" style="float:left">    '+d["nombre_esp"]+'';
										htmlt+='</strong> <span class="pull-right text-muted small">';
										htmlt+='<a href="javascript:;" id="competencia_'+d["keyid"]+'" title="<?=$idioma->{"editarcompetencia"}?>" rel="competencia_editar"><i class="fa fa-search-plus fa-2x"></i></a>'; 
										htmlt+='  </span><div style="clear:both"></div>';
										htmlt+=' </li>';
									});
									jQuery("#view_data").append("<ul class='sortable2' style='padding:1px'>"+htmlt+"</ul>"); 
									acciones.competencias();
									jQuery( ".sortable" ).sortable();
									jQuery( ".sortable" ).disableSelection();

									jQuery( ".sortable2" ).sortable({ beforeStop: function( event, ui ) {
										 
										if(event["type"]=="sortbeforestop"){
											 
											var objs=jQuery("#view_data").find("ul").find("li");
											var competencias={};
											jQuery.each(objs,function(k,d){
												if(jQuery(d).attr("class")=="list-group-item ui-state-default"){
												var keyid=jQuery(d).find("strong").attr("id").split("_")[1];
												
												competencias[k]=keyid;
												}else{//jQuery(d).remove();
												}
											});
											var res=jQuery.ajax({ 
												type: "POST",
												dataType: "json",
												async: false,
												url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
												data:{
												keyidproyecto:acciones.dataproyect["key"],
												competencias:competencias,
												mode:"get",
												get:"ordenarcompetencias"
												},
												success:function(res){
												}
											}).responseJSON;
																					
											
										}
										 
									}});
									jQuery( ".sortable2" ).disableSelection();	 							
									var tipos=jQuery("#formulario").find("[name='tenc']");
									jQuery.each(tipos,function(k,d){
										if(jQuery(d).val()==tipoencuesta){
											jQuery(d).attr({"checked":"checked"});
										}
									})
									
								}
								if(hr=="competenciasxevaluado"){
									var htmlt='';
									jQuery("#formulario").html("");
									var participantes=res[1];
									jQuery.each(participantes,function(k,d){
										var retro=d["retroalimentacion"];
										var color="#FFEFD5";
										if(retro=="S"){
											color="#F0FFF0";
										}
										
									htmlt+=' <li class="list-group-item" style="background-color:'+color+'" >';
									htmlt+='<strong id="nombre_'+d["keyid"]+'">   '+d["nombre"]+' '+d["apellido"];
									htmlt+='</strong> <span class="pull-right text-muted small">';
									htmlt+='<a href="javascript:;" id="editarcompetenciasxevaluado_'+d["keyid"]+'" title="<?=$idioma->{"editar"}?>" rel="competenciasxevaluado_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
									htmlt+='  </span>';
									htmlt+=' </li>';
									});
									jQuery("#view_data").append(htmlt); 
									acciones.competenciasxevaluado();								
								}
								if(hr=="mailing"){
									var htmlt='';
									//jQuery("#formulario").html("");
									 
									jQuery.each(res[1],function(k,d){
										htmlt+=' <li class="list-group-item"   >';
										htmlt+='<strong id="nombre_'+d["keyid"]+'"> '+d["nombre"];
										htmlt+='</strong>';
										htmlt+='<span class="pull-right text-muted small" title="<?=$idioma->{"editar"}?>" >';
										htmlt+='<a href="javascript:;" id="editarmailing_'+d["id"]+'" title="<?=$idioma->{"editar"}?>" rel="mailing_editar"><i class="fa fa-pencil-square-o fa-2x"></i></a>'; 
										htmlt+='</span>';									
										htmlt+='<span class="pull-right text-muted small" title="<?=$idioma->{"clonar"}?>" >';
										htmlt+='<a href="javascript:;" id="editarmailing_'+d["id"]+'" title="<?=$idioma->{"clonar"}?>" rel="mailing_clonar"><i class="fa fa fa-clone fa-2x"></i></a>'; 
										htmlt+='</span>';
										htmlt+=' </li>';
									});
									jQuery("#view_data").append(htmlt); 
									acciones.mailing();								
								}							
								if(hr=="reportes"){
								
									var htmlt='';
									var htmltR='';
										htmltR+=' <div class="list-group list-group-item"  >';
											htmltR+=' <div class="col-lg-6"><strong>Descargar resultados</strong></div>';
											//htmltR+=' <div class="col-lg-4"><input type="checkbox" name="avanzado" />Rerpote Avanzado</div>';
											htmltR+=' <div class="col-lg-1"><a href="javascript:;" rel="reportes_descargar"><i class="fa fa-tasks fa-fw"></i>Excel</a></div>';
											//htmltR+=' <div class="col-lg-1"><a href="javascript:;" rel="reportes_descargar_pdf"><i class="fa fa-tasks fa-fw"></i>PDF</a></div>';
											htmltR+=' <div style="clear:both"></div>';
											htmltR+=' <strong id="alertcomp">Seleccione al menos 5 competencias, y no más de 10</strong><br><br><div id="rcomp">';
											$.each(res[2],function(k,d){
											htmltR+='<input type="checkbox" value="'+d.keyid+'" >'+d.nombre_esp+"<br>";
											})
										htmltR+=' </div> </div>';	
									var htmlt="";									
									jQuery.each(res[1],function(k,d){
										if(d["retroalimentacion"] == "S"){
											htmlt+=' <li class="list-group-item"   >';
											htmlt+='<strong id="nombre_'+d["keyid"]+'"> '+d["nombre"]+' '+d["apellido"];
											htmlt+='</strong>';
											htmlt+='<span class="pull-right text-muted small" title="<?=$idioma->{"clonar"}?>" >';
											htmlt+='<a href="javascript:;" rel="reportes_descargar_pdf_'+d["keyid"]+'" title="Descargar informe"  data-toggle="tooltip" ><i class="fa fa-tasks fa-fw"></i></a>';
											htmlt+=' | <a href="javascript:;" rel="avanzado_pdf_'+d["keyid"]+'" title="Descargar informe avanzado"  ><i class="fa fa-tasks fa-fw"></i></a>'; 
											htmlt+='</span>';
											htmlt+=' </li>';
										}
									});
									jQuery("#view_data").append(htmlt); 								 
									jQuery(".panel-body").css({"height":"400px"}); 								 
									  
									jQuery("#formulario").append(htmltR); 
									acciones.reportes();								
								}
								if(hr=="evaluaciones_del_participante"){ 
									
									 
									var htmlt=' <div class="list-group list-group-item"  >';
											htmlt+=' <div class="col-lg-10"><strong>Descargar Red</strong></div>';
											htmlt+=' <div class="col-lg-2"><a href="javascript:;" title="<?=$idioma->{"descargar"}?>" rel="evaluaciones_del_participante_descargar_red"><i class="fa fa-tasks fa-fw"></i></a></div>';
											htmlt+=' <div style="clear:both"></div>';
											htmlt+=' </div><div style="clear:both"></div><br>';
									var htmltR='';
										htmltR+=' <div class="list-group list-group-item"  >';
											htmltR+=' <div class="col-lg-6"><strong>Participantes</strong></div>';
											htmltR+=' <div class="col-lg-5"><strong>Evaluaciones Terminadas</strong></div>';
											htmltR+=' <div class="col-lg-1"><a href="javascript:;" title="<?=$idioma->{"descargar"}?>"  rel="evaluaciones_del_participante_descargar"><i class="fa fa-tasks fa-fw"></i></a></div>';
											htmltR+=' <div style="clear:both"></div>';
										htmltR+=' </div>';								
					
									
									var evaluados=res[2];
									jQuery.each(evaluados,function(k,d){
										var retro=d["retroalimentacion"];
										var color="#FFF";
										htmlt+=' <li class="list-group-item" style="background-color:'+color+'" >';
										htmlt+='<strong id="nombre_'+k+'">   '+d[0]["evaluado"][1];
										htmlt+='</strong> <span class="pull-right text-muted small">';
										htmlt+='<a href="javascript:;" id="evaluado_'+k+'" title="<?=$idioma->{"descargar"}?>" rel="revaluado_descargar"><i class="fa fa-tasks fa-2x"></i></a>'; 
										htmlt+='   <a href="javascript:;" id="evaluado_'+k+'" title="<?=$idioma->{"editar"}?>" rel="revaluado_ver"><i class="fa fa-search-plus fa-2x"></i></a>'; 
										htmlt+='  </span><div style="clear:both"></div><div class="col-lg-12  " id="desplegar_'+k+'" style="display:none">';
										jQuery.each(d,function(kk,dd){
											var estado='<div style="color:red"><b>Sin resolver</b></div>';
											if(parseInt(dd["estado"][0])==1){
												estado='<div style="color:green"><b>Resuelto '+dd["estado"][1]+'</b></div>';
											}
											
											htmlt+=' <div style="background-color:'+color+'" class="col-lg-12 list-group-item" >'+dd["evaluador"][1]+' <b>'+dd["relacion"]+' </b> '+estado+'</div>';
										})
										htmlt+='<div style="clear:both"></div></div><div style="clear:both"></div> </li>'; 
										
										
										
									});
									
									var participantes=res[1];
									jQuery.each(participantes,function(k,d){
										/*
										#FE2E2E rojo
										#F0FFF0 verde
										#FFEFD5 naranja
										*/
										//var color='#FE2E2E'; 
										/*if(d["terminado"]==0){
											color='#F5A9A9';
										}*/
										/*
										if(d["iniciado"]>0){
											color='#FFEFD5';
										}*/
										
										if(d["terminado"]>0 && (d["terminado"]==d["todos"])){
											var color='#F0FFF0';
											htmltR+=' <div class="list-group list-group-item"   id="nombre_'+d["keyid"]+'" style="background-color:'+color+'">';
											htmltR+=' <div class="col-lg-7"><strong>'+d["nombre"]+' '+d["apellido"]+'</strong></div>';
											htmltR+=' <div class="col-lg-5"><strong>'+d["terminado"]+' de '+d["todos"]+'</strong></div>';
											//htmltR+=' <div class="col-lg-2"><a href="javascript:;" rel="descargar_informe" id="'+d["keyid"]+'"><i class="fa fa-tasks fa-fw"></i></a> </div>';
											htmltR+=' <div style="clear:both"></div>';
											htmltR+=' </div>';
										}
									});
									
									jQuery.each(participantes,function(k,d){
										/*
										#FE2E2E rojo
										#F0FFF0 verde
										#FFEFD5 naranja
										*/
										var color='#F5A9A9'; 
										/*if(d["terminado"]==0){
											color='#F5A9A9';
										}*/
										/*
										if(d["iniciado"]>0){
											color='#FFEFD5';
										}*/
										
										if(d["terminado"]==0 || (d["terminado"]!=d["todos"])){
											htmltR+=' <div class="list-group list-group-item"   id="nombre_'+d["keyid"]+'" style="background-color:'+color+'">';
											htmltR+=' <div class="col-lg-7"><strong>'+d["apellido"]+' '+d["nombre"]+'</strong></div>';
											htmltR+=' <div class="col-lg-5"><strong>'+d["terminado"]+' de '+d["todos"]+'</strong></div>';
											//htmltR+=' <div class="col-lg-2"></div>';
											htmltR+=' <div style="clear:both"></div>';
											htmltR+=' </div>';
										}
									});
									
									
									
									
									
									jQuery("#view_data").append(htmlt); 
									jQuery("#formulario").append(htmltR); 
									acciones.evaluaciones_del_participante();
									
								}

							}
							if(hr=="escalas"){
								var htmlt='';
								var escalas=res[1];
								
								var c=1;							
								jQuery.each(escalas,function(k,d){ console.log(d);
								
									var color="#FFF";
									if(d["aplicar"]=="1"){
										color="#F0FFF0";
									}
									htmlt+=' <li class="list-group-item ui-state-default" style="background-color:'+color+'" ><span class="ui-icon "  style="float:left;text-indent:0">'+c+'</span>';
									htmlt+='<strong id="nombre_'+d["keyid"]+'" style="float:left">    '+d["nombre"]+'';
									htmlt+='</strong> <span class="pull-right text-muted small">';
									htmlt+='<a href="javascript:;" id="escala_'+d["keyid"]+'" title="<?=$idioma->{"editarescala"}?>" rel="escala_editar"><i class="fa fa-search-plus fa-2x"></i></a>'; 
									htmlt+='  </span><div style="clear:both"></div>';
									htmlt+=' </li>';
									c++;
								});
								jQuery("#view_data").append("<ul class='sortable2' style='padding:1px'>"+htmlt+"</ul>"); 
								acciones.escalas();
								//jQuery( ".sortable" ).sortable();
								//jQuery( ".sortable" ).disableSelection();

								 
								
							}						
							
							
							
							
							if(hr=="preguntas_abiertas"){
								var htmlt='';
								if(res[0]=="ok"){
									var preguntas_abiertas=res[1];
									
																	
									jQuery.each(preguntas_abiertas,function(k,d){ console.log(d);
										htmlt+=' <li class="list-group-item ui-state-default" ><span class="ui-icon ui-icon-arrowthick-2-n-s"  style="float:left"></span>';
										htmlt+='<strong id="nombre_'+d["keyid"]+'" style="float:left">'+d["enunciado"]+'';
										htmlt+='</strong> <span class="pull-right text-muted small">';
										htmlt+='<a href="javascript:;" id="preguntas_abiertas_'+d["keyid"]+'" title="<?=$idioma->{"editarpa"}?>" rel="preguntas_abiertas_editar"><i class="fa fa-search-plus fa-2x"></i></a>'; 
										htmlt+='  </span><div style="clear:both"></div>';
										htmlt+=' </li>';
									});
									jQuery("#view_data").append("<ul class='sortable2' style='padding:1px'>"+htmlt+"</ul>"); 
									acciones.preguntas_abiertas();
									jQuery( ".sortable" ).sortable();
									jQuery( ".sortable" ).disableSelection();
								}

								 
								
							}						
							
							
							//jQuery("a[href='#"+hr+"']").click();
							var objecta=jQuery("#menu360").find("a");
							var hret="#"+hr;
							jQuery.each(objecta,function(k,a){
								var hre=jQuery(a).attr("href");
								if(hre!=hret){
									jQuery(a).parent().attr({"style":""});
								}else if(hre==hret){
									jQuery(a).parent().css({'background-color':'#ddd'});
								}
							}); 
							jQuery("#view_data").show("slow");
						}
					}).responseJSON; 				
 				}
 				
				
			}else{
				var forma=jQuery("#formas").find("[rel='proyecto']").clone();
				jQuery("#formulario").html(forma.html());
				acciones.filtrapaises();
				jQuery("[rel='guardar_proyecto']").on("click",function(){ //console.log("Okkkkkkkkkkkkkkkkkkkkk"); 
					acciones.dataproyect["nombre"]=jQuery("#formulario").find("[name='nombreproyecto']").val();
					acciones.dataproyect["bienvenida"]=jQuery("#formulario").find('[name="bienvenida"]').summernote("code");
					acciones.dataproyect["tipoproyecto"]=jQuery("#formulario").find('[name="tipoproyecto"]').val();
					acciones.dataproyect["id_ciudad"]=jQuery("#formulario").find('[name="ciudad"]').val();
					acciones.dataproyect["id_region"]=jQuery("#formulario").find('[name="region"]').val();
					acciones.dataproyect["id_pais"]=jQuery("#formulario").find('[name="pais"]').val();
					acciones.dataproyect["id_empresa"]=jQuery("#formulario").find('[name="empresa"]').val();
					acciones.dataproyect["email"]=jQuery("#formulario").find('[name="emailproyecto"]').val();
					acciones.dataproyect["clave"]="123";
					jQuery("#pannel-menu").show();
					jQuery("#formulario").html(""); 
					
					if(parseInt(acciones.dataproyect["tipoproyecto"])>0){	
						var res=jQuery.ajax({  
							type: "POST",
							dataType: "json",
							async: false,
							url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
							data:{
								nombreproyecto:acciones.dataproyect["nombre"],
								clave:"123",
								mode:"nuevo",
								emailproyecto:acciones.dataproyect["email"],
								tipoproyecto:acciones.dataproyect["tipoproyecto"],
								bienvenida:acciones.dataproyect["bienvenida"],
								id_ciudad:acciones.dataproyect["id_ciudad"],
								id_region:acciones.dataproyect["id_region"],
								id_pais:acciones.dataproyect["id_pais"],
								id_empresa:acciones.dataproyect["id_empresa"],
								},
							success:function(res){
								
							}
						}).responseJSON;  

						if(res["key"]!=""){
						jQuery.colorbox({html:"<h2>Exito al crear el proyecto</h2>"})	
						}
						
						jQuery("#formulario").html("");
						acciones.dataproyect["key"]=res["key"];
						jQuery.each(acciones.dataproyect,function(k,d){
							if(k!='bienvenida'){
							setCookie(k, d, 0.2); 
							}
						});					
						
						setTimeout(function(){
							document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo&editar=1";
						},1000);
					}else{   
						jQuery.colorbox({html:"<h2>Por favor seleccione tipo de proyecto</h2>"});
						setTimeout(function(){
							document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo";
						},1000);
					}
					
				});
			}
		});		
 		
	},

	inicio:function(){ //console.log(acciones.dataproyect);
		setTimeout(function(){
		var hshdata=document.location.hash;
		if(hshdata!=""){
			jQuery("a[href='"+hshdata+"']").click();
			jQuery("a[href='"+hshdata+"']").parent().css({'background-color':'#ddd'});
		}},150);
		if(acciones.dataproyect["nombre"]==""){	//console.log(123456789);
			jQuery("[rel='bienvenida']").html(acciones.dataproyect["bienvenida"]);
			var forma=jQuery("#formas").find("[rel='proyecto']").clone();
			jQuery("#formulario").html(forma.html());
			
			setTimeout(function(){
				jQuery("#formulario").find('[name="bienvenida"]').summernote({height:200,tabsize:1});
			
				jQuery("#formulario").find("[rel='cancelar_proyecto']").off();
				jQuery("#formulario").find("[rel='cancelar_proyecto']").on("click",function(){
					document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo&editar=1";
				});
				
			acciones.filtrapaises();
			acciones.tipoproyecto(); 
			},200);			
			
			
			
			
 			jQuery("#formulario").find("[rel='guardar_proyecto']").off();
 			jQuery("#formulario").find("[rel='guardar_proyecto']").on("click",function(){
				acciones.dataproyect["nombre"]=jQuery("#formulario").find("[name='nombreproyecto']").val();
				acciones.dataproyect["clave"]=jQuery("#formulario").find("[name='calveproyecto']").val();
				acciones.dataproyect["tipoproyecto"]=jQuery("#formulario").find("[name='tipoproyecto']").val();
				acciones.dataproyect["email"]=jQuery("#formulario").find("[name='emailproyecto']").val();
				acciones.dataproyect["id_pais"]=jQuery("#formulario").find("[name='pais']").val();
				acciones.dataproyect["id_region"]=jQuery("#formulario").find("[name='region']").val();
				acciones.dataproyect["id_ciudad"]="123";
				acciones.dataproyect["id_empresa"]=jQuery("#formulario").find("[name='empresa']").val();
				//acciones.dataproyect["bienvenida"]=jQuery("#formulario").find("[name='bienvenida']").val();
				
				 
				jQuery("#tempoproyect").find("[rel='nombreproyecto']").html(acciones.dataproyect["nombre"]);
				jQuery("#tempoproyect").find("[rel='actualizar_proyecto']").hide();
				jQuery("#tempoproyect").find("[rel='cancelar_proyecto']").hide();
				
				
				jQuery("#tempoproyect").find("[name='nombreproyecto']").val(acciones.dataproyect["nombre"]);
				jQuery("#tempoproyect").find("[name='calveproyecto']").val(acciones.dataproyect["clave"]);
				jQuery("#tempoproyect").find("[name='bienvenida']").val(acciones.dataproyect["bienvenida"]);
 				
				
				jQuery("#pannel-menu").show();
				jQuery("#tempoproyect").show();
				
				
				
				var valida=true;
				var vk={"nombre":"<?=$idioma->{"nombre_proyecto"}?>","bienvenida":"<?=$idioma->{"bienvenida"}?>","tipoproyecto":"<?=$idioma->{"bienvenida"}?>","email":"<?=$idioma->{"emailproyecto"}?>"};
				var mensaje="<h3><?=$idioma->einfoproyecto?></h3><br><br><ul>";
				jQuery.each(acciones.dataproyect,function(k,d){
					if(d=="" || d=="undefined"){
						mensaje+="<li>Por favor ingrese datos en <b>"+vk[k]+"</b></li>";
						valida=false;
					}
					if(k=="email"){
						if(validarEmail(d)==false){
							mensaje+="<li>El <b>"+vk[k]+"</b> no es válido</li>";
							valida=false;
						}
					}

				});
				mensaje+="</ul>";
				if(acciones.dataproyect["tipoproyecto"]=='-1'){  
					mensaje="Por favor seleccione un tipo de proyecto";
					valida=false;
				}
				if(valida==false){
					jQuery.colorbox({html:mensaje});
				} 
					
				
				
				
				if(valida==true){	
					var res=jQuery.ajax({ 
						type: "POST",
						dataType: "json",
						async: false,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
							nombreproyecto:acciones.dataproyect["nombre"],
							clave:"",
							mode:"nuevo",
							tipoproyecto:jQuery("#formulario").find('[name="tipoproyecto"]').val(),
							bienvenida:jQuery("#formulario").find('[name="bienvenida"]').summernote("code"),
							emailproyecto:acciones.dataproyect["email"],
							id_ciudad:acciones.dataproyect["id_ciudad"],
							id_region:acciones.dataproyect["id_region"],
							id_pais:acciones.dataproyect["id_pais"],
							id_empresa:acciones.dataproyect["id_empresa"],
							},
						success:function(res){
						}
					}).responseJSON;    
					jQuery("#formulario").html("");
					acciones.dataproyect["key"]=res["key"];
					jQuery.each(acciones.dataproyect,function(k,d){
						setCookie(k, d, 0.2); 
					});
				}
				
			});
			setTimeout(function(){
 				jQuery("#formulario").find("[rel='cancelar_proyecto']").off();
				jQuery("#formulario").find("[rel='cancelar_proyecto']").on("click",function(){
					document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo&editar=1";
				});
 			},200);				 
		 
		 
		}else{
 			
			jQuery("#tempoproyect").find("[rel='nombreproyecto']").html(acciones.dataproyect["nombre"]);
			jQuery("#tempoproyect").find("[rel='actualizar_proyecto']").hide();
			jQuery("#tempoproyect").find("[rel='cancelar_proyecto']").hide();

			jQuery("#tempoproyect").find("[name='nombreproyecto']").val(acciones.dataproyect["nombre"]);
			jQuery("#tempoproyect").find("[name='bienvenida']").val(acciones.dataproyect["bienvenida"]);
			jQuery("#pannel-menu").show();
			jQuery("#tempoproyect").show();
			
			jQuery("[rel='actualizar_proyecto']").off()
			jQuery("[rel='actualizar_proyecto']").on("click",function(){
				acciones.dataproyect["nombre"]=jQuery("#formulario").find("[name='nombreproyecto']").val();
				acciones.dataproyect["bienvenida"]=jQuery("#formulario").find("[name='bienvenida']").val();
				var nombre=jQuery("#tempoproyect").find("[name='nombreproyecto']").val();
				var bienvenida=jQuery("#tempoproyect").find("[name='bienvenida']").val();
				jQuery("#pannel-menu").show();
 				jQuery("#formulario").html("");
				
				var res=jQuery.ajax({ 
					type: "POST",
					dataType: "json",
					async: false,
					url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
					data:{nombreproyecto:nombre,bienvenida:bienvenida,mode:"actualizar",key:acciones.dataproyect["key"]},
					success:function(res){
					}
				}).responseJSON;  
				if(res[0]=="ok"){
					acciones.dataproyect["nombre"]=nombre;
					acciones.dataproyect["bienvenida"]=bienvenida;
					jQuery.each(acciones.dataproyect,function(k,d){
						setCookie(k, d, 0.2); 
					});
					jQuery.colorbox({html:"<center><h2>Datos actualizados</h2></center>"});

				}else{
					jQuery.colorbox({html:"<center><h2>No es posible actualizar ahora, por favor intente más tarde</h2></center>"});

				}
				
				
			});
						
			
			

		}
	},
	tipoproyecto:function(){
		jQuery("#formulario").find('[name="tipoproyecto"]').on("change",function(){
			if(parseInt(jQuery(this).val())==2){
				jQuery.colorbox({html:"<center><h3>Tenga en cuenta que las eveluaciones de clima tienen un costo de <?=$costoproyectoclima?> créditos,<br> estos se descontarán al enviar notificaciones</h3></center>"});
 			}
			if(parseInt(jQuery(this).val())==1){
				jQuery.colorbox({html:"<center><h3>Para este tipo de proyecto, el costo por evaluado son <?=$costoevaluados360?> créditos,<br> estos se descontarán al enviar notificaciones.</h3></center>"});
 			}
			if(parseInt(jQuery(this).val())==3){
				jQuery.colorbox({html:"<center><h3>Para este tipo de proyecto, el costo por evaluado son <?=$costoevaluadosequipos?> créditos,<br> estos se descontarán al enviar notificaciones.</h3></center>"});
 			}
		}) 
	},    
	proyecto:function(){
		
		
		var res=jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
			data:{
 				keyid:acciones.dataproyect["key"],
				mode:"ver",
				},
			success:function(res){
			}
		}).responseJSON; 			
	
	//console.log(res);
		
		jQuery("#formulario").find("[name='nombreproyecto']").val(acciones.dataproyect["nombre"]);
		jQuery("#formulario").find("[name='bienvenida']").val(res[1]["bienvenida"]);
		jQuery("#formulario").find("[name='tipoproyecto']").val(acciones.dataproyect["tipoproyecto"]);
		jQuery("#formulario").find("[name='emailproyecto']").val(acciones.dataproyect["email"]);
 		
		jQuery("#formulario").find("[rel='guardar_proyecto']").off() //console.log("Okkkkkkkkkkkkkkkkkkkkk"); 
		jQuery("#formulario").find("[rel='guardar_proyecto']").on("click",function(){ //console.log("Okkkkkkkkkkkkkkkkkkkkk"); 
			acciones.dataproyect["nombre"]=jQuery("#formulario").find("[name='nombreproyecto']").val();
			acciones.dataproyect["bienvenida"]=jQuery("#formulario").find('[name="bienvenida"]').summernote("code");
			acciones.dataproyect["tipoproyecto"]=jQuery("#formulario").find('[name="tipoproyecto"]').val();
			acciones.dataproyect["email"]=jQuery("#formulario").find('[name="emailproyecto"]').val();
			acciones.dataproyect["clave"]="123"; 
			acciones.dataproyect["id_ciudad"]="123"; 
			acciones.dataproyect["id_empresa"]=jQuery("#formulario").find('[name="id_empresa"]').val(); 
 			acciones.dataproyect["id_pais"]=jQuery("#formulario").find("[name='pais']").val();
			acciones.dataproyect["id_region"]=jQuery("#formulario").find("[name='region']").val();

			var valida=true;
			var vk={"nombre":"<?=$idioma->{"nombre_proyecto"}?>","bienvenida":"<?=$idioma->{"bienvenida"}?>","tipoproyecto":"<?=$idioma->{"bienvenida"}?>","email":"<?=$idioma->{"emailproyecto"}?>"};
			var mensaje="<h3><?=$idioma->einfoproyecto?></h3><br><br><ul>";
			jQuery.each(acciones.dataproyect,function(k,d){
				if(d=="" || d=="undefined"){
					mensaje+="<li>Por favor ingrese datos en <b>"+vk[k]+"</b></li>";
					valida=false;
				}
				if(k=="email"){
					if(validarEmail(d)==false){
						mensaje+="<li>El <b>"+vk[k]+"</b> no es válido</li>";
						valida=false;
					}
				}
			});
			mensaje+="</ul>";
			if(valida==false){
				jQuery.colorbox({html:mensaje}); 
			}   
			if(valida==true){ 
				jQuery("#pannel-menu").show();
				jQuery("#formulario").html(""); 

				var res=jQuery.ajax({  
						type: "POST",
						dataType: "json",
						async: false,
						url: "<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto",
						data:{
							key:acciones.dataproyect["key"],
							nombreproyecto:acciones.dataproyect["nombre"],
							clave:"123",
							mode:"editarproyecto",
							email:acciones.dataproyect["email"],
							tipoproyecto:acciones.dataproyect["tipoproyecto"],
							bienvenida:acciones.dataproyect["bienvenida"],
							id_ciudad:acciones.dataproyect["id_ciudad"],
							id_region:acciones.dataproyect["id_region"],
							id_pais:acciones.dataproyect["id_pais"],
							id_empresa:acciones.dataproyect["id_empresa"],

							
							},
						success:function(res){
							
					}
				}).responseJSON;  

				if(res["key"]!=""){
				jQuery.colorbox({html:"<h2>Exito al actualizar el proyecto</h2>"})	
				}

				jQuery("#formulario").html("");
				//acciones.dataproyect["key"]=res["key"];
				jQuery.each(acciones.dataproyect,function(k,d){
					 
					setCookie(k, d, 0.2); 
					 
				});					

				setTimeout(function(){
					document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo&editar=1";
				},1000);
			}
		
		});
		
		
		jQuery("#formulario").find("[rel='cancelar_proyecto']").click(function(){
				document.location="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo&editar=1";
		});

	},
	dataproyect:{"nombre":"","clave":"","key":"","bienvenida":"","tipoproyecto":"","email":"","id_pais":"","id_region":"","id_ciudad":"","id_empresa":"",}
	
}
function validarEmail(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
  return true;
  } else {
   return false;
  }
}

var idioma=jQuery.parseJSON( '<?=json_encode($idioma)?>');
//console.log(idioma); 
 jQuery(function(){
	 <? if($_GET["mode"]=="nuevo" and !isset($_GET["editar"])  and  !isset($_GET["editarproyecto"])){ ?>
	acciones.dataproyect={"nombre":"","clave":"","key":"","bienvenida":"","tipoproyecto":""};
	acciones.eventmenu();
	acciones.inicio();
	

	<? }else if($_GET["mode"]=="nuevo" and  isset($_GET["editarproyecto"])){ ?>
		jQuery.each(acciones.dataproyect,function(k,d){
			acciones.dataproyect[k]=getCookie(k);
		});
		var forma=jQuery("#formas").find("[rel='proyecto']").clone();
		jQuery("#formulario").html(forma.html());
		setTimeout(function(){
		jQuery("#formulario").find('[name="bienvenida"]').summernote({height:200,tabsize:1});
		acciones.filtrapaises();
		},200);	 
		acciones.proyecto();
 	<? }else { ?>  
			jQuery.each(acciones.dataproyect,function(k,d){
				acciones.dataproyect[k]=getCookie(k);
			});
			acciones.eventmenu();
			acciones.inicio();

	<? } ?>
	

	
 });
 function redondeo(numero, decimales)
{
var flotante = parseFloat(numero);
var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
return resultado;
}

function showMessage(message){
    jQuery("#colorbox").find(".messages").html("").show();
    jQuery("#colorbox").find(".messages").html(message);
}
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
         case 'csv':
            return true;
        break;
        default:
            return false;
        break;
    }
}

function cargar(){
	 
   jQuery("#colorbox").find(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    jQuery("#colorbox").find(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = jQuery("#colorbox").find("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
		if(fileExtension.toUpperCase()!="CSV"){
			message = $("<span class='error'>El archivo debe ser de formato CSV</span>");
			showMessage(message);
			
		}
    });
 
    //al enviar el formulario
    jQuery("#colorbox").find(':button').off()
    jQuery("#colorbox").find(':button').on("click",function(){ 
		if(fileExtension.toUpperCase()=="CSV"){
			//información del formulario
			var formData = new FormData(jQuery("#colorbox").find(".formulario")[0]);
			var message = ""; 
			//hacemos la petición ajax  
			$.ajax({
				url: jQuery("#colorbox").find(".formulario").attr("action"),  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				dataType: "json",
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					message = $("<span class='before'>Subiendo archivo, por favor espere...</span>");
					showMessage(message)        
				},
				//una vez finalizado correctamente success
				success: function(data){
					message = $("<span class='info'>Analizando archivo, por favor espere. Esto puede tardar varios minutos.</span>");
					showMessage(message);
					console.log(data);
					if(data["estado"]=="error"){
						var htmlerr="<span class='error'>Los datos precentan errores, por favor verificar lo siguiente:</span><br><br>";
						htmlerr+="<ul>";
						jQuery.each(data["errores"],function(k,d){
							htmlerr+="<li>";
							htmlerr+=d;
							htmlerr+="</li>";
						});
						htmlerr+="</ul>";
						message = $(htmlerr);
						showMessage(message);
						
					}
					if(data["estado"]=="ok"){
						if(typeof data["existeemail"] == "undefined" ){
							if(data[1].length>0){
								var htmlerr="<span class='error'>Los siguiente email ya se encuentran registrados</span>";
								htmlerr+="<ul>";
								jQuery.each(data[1],function(k,d){
									htmlerr+="<li>";
									htmlerr+=d;
									htmlerr+="</li>";
								});
								htmlerr+="</ul><br><b>Por favor corrija la información erronea y carguelo nuevamente. </b>";
								showMessage(htmlerr);
								
							}else{

							
								message = $("<span class='success'>Los datos ha sido cargados exitosamente</span>");
								showMessage(message);
							}
						}else {
							var email="";
							jQuery.each(data[0],function(k,e){
								email+="<br> "+e;
							});
							message = $("<span class='error'>Los email ya existen</span><br> "+email+"");
								showMessage(message);
						}
					}
					 
				},
				//si ha ocurrido un error
				error: function(){
					message = $("<span class='error'>Ha ocurrido un error.</span>");
					showMessage(message);
				}
			});
		}else{
			message = $("<span class='error'>El archivo debe ser de formato CSV</span>");
			showMessage(message);
						
		}
    });
}


/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/
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

</script>
 <div id="contenedor360"   >
<?php echo CHtml::form(array("admin/evaluacion/proyecto"), 'post', array('class'=>'saveproyect', 'id'=>'saveproyect','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#reportes"), 'post', array('class'=>'descargarreporte', 'id'=>'descargarreporte','target'=>'descargar','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#evaluaciones_del_participante"), 'post', array('class'=>'informe', 'id'=>'informe','target'=>'descargar','style'=>'display: none')); ?>

</form>
<?php echo CHtml::form(array("admin/evaluacion/proyecto#evaluaciones_del_participante"), 'post', array('class'=>'informered', 'id'=>'informered','target'=>'descargar','style'=>'display: none')); ?>

</form>
<iframe name="descargar" id="descargar" style="display:none"></iframe>
<? //printVar($idioma->{"nombredelarelacion"}); ?>
<div id="formas" style="display:none">
 
	<div rel="cargar">
		<?php echo CHtml::form(array("admin/evaluacion/proyecto"), 'post', array('class'=>'formulario' , 'id'=>'formCrear','style'=>'margin:0px; padding:0px;','enctype'=>'multipart/form-data')); ?>
		 
		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-12"><?=$idioma->{"indicaciones"}?></div>
 				<div style="clear:both"></div>
			</div>		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"archivocsv"}?></strong></div>
				<div class="col-lg-7"><input name="archivo" type="file" id="imagen" /><input name="keyproyecto" type="hidden" id="keyproyecto" /></div>
				<div style="clear:both"></div>
			</div>		
		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-5"><strong><?=$idioma->{"seleccionetipocsv"}?></strong></div>
				<div class="col-lg-7">
					<select name="delimitador"> 
					<option value=";">;</option>
					<option value=",">,</option>
					</select>				
				</div>
				<div style="clear:both"></div>
			</div>		
		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-12"><div class="messages"></div><div class="showImage"></div></div>
 				<div style="clear:both"></div>
			</div>		
			<div class="list-group list-group-item" rel="hidde">
				<div class="col-lg-5"><input type="button" value="<?=$idioma->subir?>" /><br />
				<input type="hidden" name="save" /></div>
				<div class="col-lg-7"> </div>
				<div style="clear:both"></div>
			</div>		
 			
		</form>
 	</div>
	
	
	
	
	
	
	
	<div rel="participantes">
		<div class="list-group list-group-item" rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"apellido"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="apellido" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"primer_nombre"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="primer_nombre" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"email"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="email" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
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
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"ecivil"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="ecivil" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($ecivil as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		
		<div class="list-group list-group-item"  rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"nacademico"}?></strong></div>
			<div class="col-lg-7">
 				<select   name="nacademico" style="width:100%" />
				<option value="-1"><?=$idioma->seleccione?></option>
				<? foreach($nacademico as $d){ ?>
				<option value="<?=$d->id?>"><?=$d->esp?></option>
				<? } ?>
				</select>
			</div>
			<div style="clear:both"></div>
		</div>
		
		
		<div class="list-group list-group-item" style="display:none">
			<div class="col-lg-5"><strong><?=$idioma->{"usuario"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="usuario" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		
		<div class="list-group list-group-item" rel="hidde">
			<div class="col-lg-5"><strong><?=$idioma->{"clave"}?></strong></div>
			<div class="col-lg-7"><input type="password" name="clave" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		 <div class="list-group list-group-item">
			<div class="col-lg-1"><input type="checkbox" name="retroalimentacion"  /></div>
			<div class="col-lg-11"><strong class="enunciadoretro"><?=$idioma->{"retroalimentacion"}?></strong></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5">
			<input type="button" value="<?=$idioma->{"agregar"}?>" rel="agregar_participantes" />
 			<input type="button" value="<?=$idioma->{"actualizar"}?>" rel="editar_participantes" id="keyid" style="display:none"/>
			</div>
			<div class="col-lg-7"><input type="button" value="<?=$idioma->{"cargamasiva"}?>" rel="cargamasiva" /></div>
			<div style="clear:both"></div>
		</div>
		
		
		
  	</div> 
	
	<div rel="proyecto">
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombre_proyecto"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="nombreproyecto" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"emailproyecto"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="emailproyecto" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div> 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"tipoproyecto"}?></strong></div>
			<div class="col-lg-7">
				<select  name="tipoproyecto" style="width:100%;" /><option value="-1" >Seleccione un tipo de proyecto</option>
				<? foreach($tipoproyecto as $tipo){ ?>
				<option value="<?=$tipo->id?>" ><?=$tipo->nombre?></option>
				<? }?>
				</select>
 			</div>
			<div style="clear:both"></div>
		</div>
 		
		
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->paises?></strong></div>
			<div class="col-lg-7">
				<select name="pais" style="width:100%;"><option value="-1">Seleccione un país</option>
				<? foreach($paises as $pais){ 
					$checked="";
					if(isset($empresa->id_pais)){
						if($empresa->id_pais==$pais->id){
							$checked=" selected='selected' ";
						}
					}
				?>
						
								<option <?=$checked?> value="<?=$pais->id?>"><?=$pais->nombre?></option>
				<? } ?>
								
								</select>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->regiones?></strong></div>
			<div class="col-lg-7">
				<select name="region" style="width:100%;">
					<? if(isset($region->id)){ ?>
						 <option value="<?=$region->id?>" selected="selected"><?=$region->nombre?></option>
						
					<? }else{ ?>									
				
					 <option value="-1">Seleccione un país</option>
								
					<? } ?>			
				</select>
			</div>
			<div style="clear:both"></div>
		</div> 	
		
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->empresa?></strong></div>
			<div class="col-lg-7"><input type="text" name="empresa" style="width:100%" /></div>
 
			<div style="clear:both"></div>
		</div>	 	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"bienvenida"}?></strong></div>
			<div class="col-lg-12"   >
				<textarea name="bienvenida" style="width:100%;height:100%" ></textarea>
 			</div>
			<div style="clear:both"></div>
		</div>
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><input type="button" value="<?=$idioma->{"guardar"}?>" rel="guardar_proyecto" /></div>
			<div class="col-lg-7"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_proyecto" /></div>
			<div style="clear:both"></div>
		</div>
	
	</div>
		
	<div rel="mailing">
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombremailing"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="nombre" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"participantes"}?></strong></div>
			<div class="col-lg-7">
				<input type="button"  rel="mailing_participantes"  value="<?=$idioma->participantes?>">
 			</div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"concopia"}?></strong></div>
			<div class="col-lg-7">
				<input type="text"  name="concopia" style="width:100%"  >
 			</div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"asunto"}?></strong></div>
			<div class="col-lg-12">
				<input type="text" name="asunto" style="width:100%" />
 			</div>
			<div style="clear:both"></div>
		</div>		
		
		
		
		
		<div class="list-group list-group-item">
			<div class="col-lg-12"><strong><?=$idioma->{"contenidomailing"}?></strong></div>
			<div class="col-lg-12"><strong><?=$idioma->{"nota"}?></strong><?=$idioma->{"notavariables"}?></div>
			<div class="col-lg-12">
				<textarea name="html" style="width:100%;height:250px" ></textarea>
 			</div>
			<div style="clear:both"></div>
		</div>

 		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"guardar"}?>" rel="mailing_guardar" /></div>
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="mailing_cancelar" /></div>
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"biblioteca"}?>" rel="mailing_biblioteca" /></div>
			<div class="col-lg-6"><input type="button" value="<?=$idioma->{"enviar"}?>" rel="mailing_enviar" /></div>

 			<div style="clear:both"></div>
		</div>
	
	</div>
	
	<div rel="relaciones">
	
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"nombredelarelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="nombredelarelacion" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"abreviacionrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="abreviacionrelacion" maxlength="6" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item" style="display:none">
			<div class="col-lg-5"><strong><?=$idioma->{"descripcionrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="descripcionrelacion" value="NR" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item" style="display:none">
			<div class="col-lg-5"><strong><?=$idioma->{"colorrelacion"}?></strong></div>
			<div class="col-lg-7"><input type="color" name="colorrelacion" style="width:100%" /><input type="hidden" name="idorigen"   /></div>
			<div style="clear:both"></div>
		</div>
		 
		<div class="list-group list-group-item">
			<div class="col-lg-5">
			<input type="button" value="<?=$idioma->{"agregarrelacion"}?>" rel="agregar_relacion" />
			<input type="button" value="<?=$idioma->{"cancelarrelacion"}?>" rel="cancelar_relacion" />
			<input type="button" value="<?=$idioma->{"actualizarrelacion"}?>" rel="editar_relacion" id="keyid" style="display:none"/>
			</div>
			<div class="col-lg-7"></div>
			<div style="clear:both"></div>
		</div>
	
 	
	
	
	
	
	</div>
	
	<div rel="asignaciones">
	</div>
	
	<div rel="competencias">
		<div class="list-group list-group-item">
			
			<div class="col-lg-12">
				<div class="col-lg-12">
					<strong><?=$idioma->{"tipodeencuesta"}?></strong><div style="clear:both"></div>
				</div><br>
				<div style="clear:both"></div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-1">
					<input type="radio" name="tenc" value="1" checked="checked" ><div style="clear:both"></div>
				</div>
				<div class="col-lg-11">
					<strong><?=$idioma->{"mostrarcategorias"}?></strong><div style="clear:both"></div>
				</div><div style="clear:both"></div>
			</div>
			 
				
			<div class="col-lg-12">
				<div class="col-lg-1">
				<input type="radio" name="tenc"  value="2" ><div style="clear:both"></div>
				</div>
				<div class="col-lg-11">
				<strong><?=$idioma->{"ocultarcategorias"}?></strong><div style="clear:both"></div>
				</div><div style="clear:both"></div>
			</div>
				
			<div class="col-lg-12">
				<div class="col-lg-1">
				<input type="radio" name="tenc"   value="3" ><div style="clear:both"></div>
				</div>
				<div class="col-lg-11">
				<strong><?=$idioma->{"encuestaaleatoria"}?></strong><div style="clear:both"></div>
				</div><div style="clear:both"></div>
			</div>
				
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"competencia"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="nombrecompetencia" style="width:100%;" /></div>
			<div style="clear:both"></div>
		</div>
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"descripcion"}?></strong></div>
			<div class="col-lg-7"><textarea name="descripcioncompetencia" style="width:100%;height:40px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="button" value="<?=$idioma->{"agregarcompetencia"}?>" rel="agregar_competencia" /></div>
			<div class="col-lg-7">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_competencia" />
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="eliminar_competencia" style="display:none" />
			<input type="hidden" name="keyid" />
			</div>
			<div class="col-lg-3"><input type="button" value="<?=$idioma->{"biblioteca_de_encuestas"}?>" rel="biblioteca_de_encuestas" /></div>
			<div style="clear:both"></div> 
		</div>
		
		<div class="list-group list-group-item" >
			<div class="col-lg-12">
				<input style="width:200px" class="btn btn-lg btn-success btn-block limebutton" type="button" rel="agregarpregunta" value="<?=$idioma->agregarpregunta?>"  pb-role="submit">
 			<div style="clear:both"></div> 
			</div> <div style="clear:both"></div> 
 		</div>
		<div class="list-group list-group-item" id="lista_preguntas">
			
			<div class="col-lg-12">
				
				<ul class="sortable">
					<li class="ui-state-default" rel="pregunta"> 1<br> <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
					<textarea style="width:94%;margin-right:5px;height:35px" ></textarea>
					<a href="javascript:;" rel="eliminarpregunta"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</li>

 
				</ul>			
				<div style="clear:both"></div>
			
			</div>
			<div style="clear:both"></div> 
		</div>
		
	</div>
	
	<div rel="escalas">
	
	
 
 
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"escala"}?></strong></div>
			<div class="col-lg-7"><textarea name="escala" style="width:100%;height:25px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 
		<!--div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"abreviacionescala"}?></strong></div>
			<div class="col-lg-7"><input type="text" name="abreviacionescala" maxlength="6" style="width:100%" /></div>
			<div style="clear:both"></div>
		</div-->
 <input type="hidden" name="abreviacionescala" value="NR" maxlength="6" style="width:100%" />
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"preguntaescala"}?></strong></div>
			<div class="col-lg-7"><textarea name="preguntaescala" style="width:100%;height:40px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
		
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"rangoescala"}?></strong></div>
			<div class="col-lg-7"><select name="rangoescala" style="width:50px" >
			<option value="2">2 </option>
			<option value="3">3 </option>
			<option value="4">4 </option>
			<option value="5">5 </option>
			<option value="6">6 </option>
			<option value="7">7 </option>
			<option value="8">8 </option>
			<option value="9">9 </option>
			<option value="10">10 </option>
			<option value="11">11 </option>
			<option value="12">12 </option>
			</select>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="list-group list-group-item">
			<div class="col-lg-2"><input type="checkbox" name="aplicar"/></div>
			<div class="col-lg-10">
			<strong><?=$idioma->{"activarescala"}?></strong>
			</div>
 			<div style="clear:both"></div> 
 		</div>
		
 		<div class="list-group list-group-item">
			<div class="col-lg-5"><input type="button" value="<?=$idioma->{"agregarescala"}?>" rel="agregar_escala" /></div>
			<div class="col-lg-7">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_escala" />
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="eliminar_escala" style="display:none" />
			<input type="hidden" name="keyid" />
			</div>
 			<div style="clear:both"></div> 
		</div>
		
		<div class="list-group list-group-item" >
			<div class="col-lg-12"><a href="javascript:;" rel="agregardescriptor"><i class="fa fa-plus" aria-hidden="true"></i><b>Agregar descriptor</b></a></div>
			<div style="clear:both"></div> 
 		</div>
		<div class="list-group list-group-item" id="lista_descriptores">
			
			<div class="col-lg-12">
				
				<ul class="sortable">
					<li class="ui-state-default" rel="descriptor"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
					<input type="text" style="width:94%;"/>
					<a href="javascript:;" rel="eliminardescriptor"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</li>

 
				</ul>			
				<div style="clear:both"></div>
			
			</div>
			<div style="clear:both"></div> 
		</div>	
 	
	</div>
	
	<div rel="preguntas_abiertas">
	
		<div class="list-group list-group-item">
			<div class="col-lg-5"><strong><?=$idioma->{"enunciado"}?></strong></div>
			<div class="col-lg-7"><textarea name="enunciado" style="width:100%;height:100px" ></textarea></div>
			<div style="clear:both"></div>
		</div>
 
		
 		<div class="list-group list-group-item">
			<div class="col-lg-4"><input type="button" value="<?=$idioma->{"agregarpa"}?>" rel="preguntas_abiertas_agregarpa" /></div>
			<div class="col-lg-4">
			<input type="button" value="<?=$idioma->{"cancelar"}?>" rel="preguntas_abiertas_cancelarpa" />
			
			<input type="hidden" name="keyid" />
			</div>
			<div class="col-lg-4">
			<input type="button" value="<?=$idioma->{"eliminar"}?>" rel="preguntas_abiertas_eliminarpa"   />
			</div>
 			<div style="clear:both"></div> 
		</div>	
	
	
	
	
	
	</div>
	
	<div rel="evaluaciones_del_participante">
	</div>
	
	<div rel="reportes">
	</div>
 </div>
  
         <!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
				
                <a class="navbar-brand" href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=ver" style="padding:0px">
				<img src="<?=Yii::app()->baseUrl?>/images/360evolution.png" style="width: 190px;" /></a>				
				
				
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
		<li> <b>&#161HOLA <?= strtoupper($usuariomodel->nombres) ?>&#33</b> Tienes <?=$creditosdisponibles ?> cr&#233ditos</li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo">
                                <div> 
                                    <strong><?=$idioma->{"nuevo_proyecto"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=ver">
                                <div>
                                    <strong><?=$idioma->{"mis_proyectos"}?></strong>
                                 </div>
                             </a>
                        </li>
						 <?php  if($usuariomodel->perfil==1){?>
						  <li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/moneda">
                                <div>
                                    <strong><?=$idioma->{"monedas"}?></strong> 
                                 </div>
                             </a>
                        </li>
                        <? } ?>  
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
                                <?php if($usuariomodel->perfil==1 or $usuariomodel->perfil==2){ ?> 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cogs fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/crear">
                                 <div> 
                                    <strong>Crear Cuenta</strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
			<li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/gestionar">
                                 <div>
                                    <strong>Gestionar Cuentas</strong>
                                 </div>
                             </a>
                        </li>
			<li class="divider"></li>
			<li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/historial">
                                 <div>
                                    <strong>Historial de Ventas</strong>
                                 </div>
                             </a>
                        </li>
			<li class="divider"></li>
                        <!--<li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/paises">
                                 <div>
                                    <strong><?=$idioma->{"paises"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/regiones">
                                 <div>
                                    <strong><?=$idioma->{"regiones"}?></strong>
                                 </div>
                             </a>
                        </li>
                        <li class="divider"></li>
                         <li> 
                            <a href="<?=Yii::app()->baseUrl?>/index.php/admin/empresas">
                                 <div>
                                    <strong><?=$idioma->{"empresas"}?></strong>
                                 </div>
                             </a>
                        </li>-->
                          
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <?php } ?>
                 
				
				<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
			<li style ="margin-left: 12%"><i class="fa fa-user fa-fw" style="color:#000000"></i> <form action="<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/crear" method="POST" style="margin-top: -17%;margin-left: 6%;"><input type="hidden" name="idusuario" value="<?=$usuariomodel->id?>"><input type="submit" value="<?=$idioma->{"perfil_de_usuario"}?>" style="color:#000000" class="btn btn-link"></form></li>
                        <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> <?=$idioma->{"configuracion"}?></a>
                        </li>-->
			<li class="divider"></li>
                        <li><a href="#">Créditos <i class="fa  fa-dollar fa-fw"></i>  <label for="" id="creditosdisponibles"><?=$creditosdisponibles?></label></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=Yii::app()->baseUrl?>/index.php/admin/authentication/sa/logout"><i class="fa fa-sign-out fa-fw"></i> <?=$idioma->{"salir"}?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
 			<?//$menulat ?>
         </nav> 	
		
		
		
		
		   
		
		
		
		
		

        <div id="page-wrapper">
            <div class="row" id="linea">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row" id="botones">
				<div class="col-lg-2" id="tablero">
			
					<div class="col-lg-12 col-md-3">
						<div class="panel panel-primary">
							<div class="panel-heading" style="background-color:#FFF;color:#333">
								<div class="row">
									<div class="col-xs-2 text-left" style="padding-top:12px">
										<div class="huge"  style="font-size:26px"> <i class="fa fa-newspaper-o fa-fw"></i></div>
 									</div>
									<div class="col-xs-10 text-left">
										
										<div class="huge" ><?=$idioma->{"tablero"}?></div> 
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					
				</div>	
				<div class="col-lg-10">	
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<!--div class="huge"><?=$tproyectos?></div-->
										<div class="huge"  > <i class="fa fa-tasks fa-fw"></i></div>

									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?=$idioma->{"proyectos"}?></div>
										 
									</div>
								</div>
							</div>
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=ver">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					
					
					
					
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									 
									<div class="col-xs-3">
										<div class="huge"> <i class="fa fa-folder-o fa-fw"></i></div>
 									</div>
									 
									<div class="col-xs-9">
 										<div class="huge"><?=$idioma->{"biblioteca_de_encuestas"}?></div>
									</div>
								</div>
							</div>
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=catalogo">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<div class="huge"> <i class="fa fa-pencil-square fa-fw"></i></div>
 									</div>
									<div class="col-xs-9 text-left">
										<div class="huge"><?=$idioma->{"lista_maestra"}?></div>
										 
									</div>
								</div>
							</div> 
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=archivos">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<div class="huge"> <i class="fa fa-crosshairs fa-fw"></i></div>
 									</div>
									<div class="col-xs-9 text-left">
										<div class="huge"><?=$idioma->{"guia360"}?></div>
 									</div>
								</div>
							</div>
							<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=guia360">
								<div class="panel-footer">
									<span class="pull-left"><?=$idioma->{"verdetalles"}?></span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>
            </div>
            <!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					 <div class="pull-left" id="pannel-menu"  style="display:none">
 							
								<ul class="nav navbar-top-links navbar-left in" id="menu360" rel="menu360"  >
												 
									<!-- /.dropdown -->
									<li class="dropdown">
										<a class="dropdown-toggle" title="<?=$idioma->{"participantes"}?>"   href="#participantes">
											<!--i class="fa fa-user-plus fa-2x"></i--> 
											<img  title="<?=$idioma->{"participantes"}?>" src="<?=Yii::App()->baseUrl?>/images/icon/participantes.png" style="width:60px"/>
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									<!-- /.dropdown -->
									<li class="dropdown">
										<a class="dropdown-toggle" title="<?=$idioma->{"relaciones"}?>"   href="#relaciones">
											<!--i class="fa fa-exchange fa-2x"></i--> 
											<img title="<?=$idioma->{"relaciones"}?>"    src="<?=Yii::App()->baseUrl?>/images/icon/relaciones.png" style="width:60px"/>											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"asignaciones"}?>"  href="#asignaciones">
											<!--i class="fa  fa-users   fa-2x"></i-->  
											<img  title="<?=$idioma->{"asignaciones"}?>" src="<?=Yii::App()->baseUrl?>/images/icon/redes.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"competencias"}?>"  href="#competencias">
											<!--i class="fa fa-group  fa-2x"></i-->  
											<img title="<?=$idioma->{"competencias"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/competencia.png" style="width:60px"/>	
										</a>
										
										<!-- /.dropdown-user -->
									</li>
																	
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"competenciasxevaluado"}?>"  href="#competenciasxevaluado">
											<!--i class="glyphicon glyphicon-th-list" style="font-size:20px;"></i--> 
											<img  title="<?=$idioma->{"competenciasxevaluado"}?>" src="<?=Yii::App()->baseUrl?>/images/icon/evaluador.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
																	
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"escalas"}?>"  href="#escalas">
											<!--i class="fa fa-list-ol  fa-2x"></i--> 
											<img  title="<?=$idioma->{"escalas"}?>"   src="<?=Yii::App()->baseUrl?>/images/icon/escalas.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"preguntas_abiertas"}?>"   href="#preguntas_abiertas">
											<!--i class="fa fa-question-circle  fa-2x"></i--> 
											<img   title="<?=$idioma->{"preguntas_abiertas"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/preguntas.png" style="width:60px"/>											
											
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"mailing"}?>"   href="#mailing">
											<!--i class="fa fa-envelope-o  fa-2x"></i-->  
											<img  title="<?=$idioma->{"mailing"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/notificaciones.png" style="width:60px"/>											

										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"evaluaciones_del_participante"}?>"  href="#evaluaciones_del_participante">
											<!--i class="fa  fa-floppy-o fa-2x"></i-->  
											<img title="<?=$idioma->{"evaluaciones_del_participante"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/progreso.png" style="width:60px"/>											

										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									
									<li class="dropdown">
										<a class="dropdown-toggle"  title="<?=$idioma->{"reportes"}?>"  href="#reportes">
											<!--i class="fa  fa-line-chart fa-2x"></i-->  
											<img  title="<?=$idioma->{"reportes"}?>"  src="<?=Yii::App()->baseUrl?>/images/icon/reporte.png" style="width:60px"/>	
										</a>
										
										<!-- /.dropdown-user -->
									</li>
									
									 
									<!-- /.dropdown -->
								</ul>							
							
								<div style="clear:both"></div>
							
 								
                            </div>
				</div>
			
			</div>
            <div class="row" style="padding-left:13px;padding-right:13px">
				<div  class="col-lg-12" id="contenedorbr">
					<div class="col-lg-7" style="height:100%">
						<div class="panel panel-default" style="height:97%;overflow-y:scroll">
							<div class="panel-heading" >
							
								<div class="col-lg-12 " > 
									<div  id="tempoproyect"   style="display:none">
									
											<div class="col-lg-12 " > 
												<div class="col-lg-3"><strong><?=$idioma->{"nombre_proyecto"}?>:</strong></div>
												<div class="col-lg-8">
													<strong rel="nombreproyecto"></strong>
													
													<input type="hidden" name="nombreproyecto" style="width:100%;" />
												</div>
												<div class="col-lg-1 text-right">
													<a href="<?=Yii::app()->baseUrl?>/index.php/admin/evaluacion/proyecto?mode=nuevo&editarproyecto" title="<?=$idioma->editarproyecto?>"  rel="editarproyecto"><i class="fa fa-pencil-square-o fa-2x"></i></a>
												</div>
 											</div> 
											
											<div class="col-lg-12 " id="etapa" style="display:none" > 
												<div class="col-lg-3"><strong><?=$idioma->{"etapa"}?>:</strong></div>
												<div class="col-lg-9">
													<strong rel="etapa"></strong>
													 
												</div>
 											</div> 
											
											<div class="list-group list-group-item" style="display:none">
												<div class="col-lg-12"><strong><?=$idioma->{"bienvenida"}?>:</strong></div>
												<div class="col-lg-12">
													<strong rel="bienvenida"></strong>
													<input type="hidden" name="bienvenida" style="width:100%;" /> 
												</div>
												<div style="clear:both"></div>
											</div>
											 
											<div class="list-group list-group-item" style="display:none">
												<div class="col-lg-6"><input type="button" value="<?=$idioma->{"actualizar"}?>" rel="actualizar_proyecto" /></div>
												<div class="col-lg-6"><input type="button" value="<?=$idioma->{"cancelar"}?>" rel="cancelar_proyecto" /></div>
												<div style="clear:both"></div>
											</div>									
									</div>
								</div>
								
								
								
								 
							   <div style="clear:both"></div>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body" id="formulario" >
								 
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					 </div>
					<!-- /.col-lg-8 -->
					<div class="col-lg-5" style="height:100%">
						<div class="panel panel-default" style="height:97%;overflow-y:scroll">
							<div class="panel-heading">
								<i class="fa  fa-gears  fa-fw"></i><strong id="idItem"> </strong>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="list-group" id="view_data">
									 
									 
								</div>
								<!-- /.list-group -->
							 </div>
							<!-- /.panel-body -->
						</div>
						
						 
					</div><div style="clear:both"></div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
		
</div>		
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
   <style>
   #formulario .note-editing-area p{
	   text-align:initial;
	   padding-bottom:0px;
   }
   
   #colorbox p{
	   text-align:initial;
	   padding-bottom:0px;
   }
   
   
   #formulario .note-editing-area{
	   border:1px solid #ddd;
   }
    
   #menu360 li{
	   border:0.04em solid;
	   border-color:#ddd;
	   border-top-left-radius:6px;
	   border-top-right-radius:6px;  
   }
   #contenedorbr{
 	   border:0.04em solid;
	   border-color:#ddd;
	   border-top-left-radius:6px;
	   border-top-right-radius:6px; 
padding-top:10px;	   
   }
   #page-wrapper{
	   margin:0px;
   }
   .page-header{
	   margin:10px 0 20px;
   }
   .huge{font-size:38px;}
   </style>
<script>
jQuery(function(){
	var h1=jQuery("[role='navigation']").height();
	var h2=jQuery("#botones").height();
	var h3=jQuery("#linea").height();
	var h4=jQuery("#menu360").height();
	var ht=h1+h2+h3+h4+50;
	if(parseInt(acciones.dataproyect["tipoproyecto"])>=2){
		jQuery(".enunciadoretro").text("<?=$idioma->esorganizacion?>");
		
	}
	
	   
	
	var hcontenedor=jQuery('body').height()-ht;
	//jQuery("#contenedorbr").height(hcontenedor);
	jQuery("#contenedorbr").attr({"style":'height:'+hcontenedor+'px !important'});
	
	
	jQuery("#page-wrapper").height((h2+h4+hcontenedor)-100);
	jQuery(".push").remove()
	setTimeout(function(){
	var hw=jQuery("#wrapper").height();
	jQuery("#wrapper").height((hw-20));
	
	},200);
	jQuery("[href='#participantes']").click();  
	jQuery("#formulario").find('[name="tipoproyecto"]').off();
	console.log(acciones);
	jQuery.get("<?=Yii::app()->baseUrl?>/index.php/admin/admusuario/getpaises",function(res){
		res = JSON.parse(res);
		res.sort(function(a,b){
			return (a.nombre > b.nombre) ? 1: (a.nombre < b.nombre) ? -1 : 0;
		});
		var html='<option>Seleccione un país</option>';
		jQuery.each(res,function(k,d){ 
			html+='<option value="'+d["id"]+'">'+d["nombre"]+'</option>';
 		});
		var selectPaises = jQuery("#formulario").find('[name="pais"]').html(html);
	});
	jQuery('[data-toggle="tooltip"]').tooltip();		  
	
 });
</script>	