<link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/example1/colorbox.css" />
<script src="<?=Yii::app()->baseUrl?>/scripts/admin/colorbox/jquery.colorbox.js"></script>
<?
					$urls=Yii::app()->baseUrl."/files/pcos/".$url."/";

	?>
<style type="text/css"> 
	.navbar-default{
		z-index:999;
	}
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
	.sut{
	border: 1px solid #EDEDFB ;padding-top:10px;padding-bottom:10px;
	
	}
	.dee{
	border: 1px solid #EDEDFB ;padding-top:10px;padding-bottom:10px;
	
	}
	
.custom-file-input {
		display: inline-block;
		position: relative;
		color: #533e00;
	}
	.custom-file-input input {
		visibility: hidden;
		width: 150px;
	}
	.custom-file-input:before {
		content: 'Choose File';
		display: block;
		background: -webkit-linear-gradient( -180deg, #ffdc73, #febf01);
		background: -o-linear-gradient( -180deg, #ffdc73, #febf01);
		background: -moz-linear-gradient( -180deg, #ffdc73, #febf01);
		background: linear-gradient( -180deg, #ffdc73, #febf01);
		border: 3px solid #dca602;
		border-radius: 10px;
		padding: 5px 0px;
		outline: none;
		white-space: nowrap;
		cursor: pointer;
		text-shadow: 1px 1px rgba(255,255,255,0.7);
		font-weight: bold;
		text-align: center;
		font-size: 10pt;
		position: absolute;
		left: 0;
		right: 0;
	}
	.custom-file-input:hover:before {
		border-color: #febf01;
	}
		.custom-file-input:active:before {
		background: #febf01;
	}
	.file-blue:before {
		content: 'Buscar archivo';
		background: -webkit-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: -o-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: -moz-linear-gradient( -180deg, #99dff5, #02b0e6);
		background: linear-gradient( -180deg, #99dff5, #02b0e6);
		border-color: #57cff4;
		color: #FFF;
		text-shadow: 1px 1px rgba(000,000,000,0.5);
	}
	.file-blue:hover:before {
		border-color: #02b0e6;
	}
	.file-blue:active:before {
		background: #02b0e6;
	}	
	
	
</style>
  <script>
 window["idformulario"]=0; 
$(document).ready(function(){
	<? if(count($empresas)==1){?>
		window["idorg"]=<?=$empresas[0]->id?>;
		jQuery("[name='EvalEncuesta[nombreempresa]']").val('<?=$empresas[0]->nombre?>');
 		
		jQuery("[name='EvalEncuesta[direccionempresa]']").val('<?=$empresas[0]->direccion?>');
 		
		jQuery("[name='EvalEncuesta[ciudaddepartamento]']").val('<?=$empresas[0]->ciudad?>');
 		
		jQuery("[name='EvalEncuesta[nit]']").val('<?=$empresas[0]->nit?>');
 		
		jQuery("[name='EvalEncuesta[telefono]']").val('<?=$empresas[0]->telefono?>');
 		
		jQuery("[name='EvalEncuesta[fax]']").val('<?=$empresas[0]->fax?>');
 		
		jQuery("[name='EvalEncuesta[representantelegal]']").val('<?=$empresas[0]->representantelegal?>');
 		
		jQuery("[name='EvalEncuesta[docrepresentante]']").val('<?=$empresas[0]->docidentidadrep?>');
 		
		jQuery("[name='EvalEncuesta[nombrecontacto]']").val('<?=$empresas[0]->nombrecontacto?>');
 		
		jQuery("[name='EvalEncuesta[doccontacto]']").val('<?=$empresas[0]->docidentidadcontacto?>');
 		
		jQuery("[name='EvalEncuesta[emailcontacto]']").val('<?=$empresas[0]->emailcontacto?>');
 		
		jQuery("[name='EvalEncuesta[actividadeconomica]']").val('<?=$empresas[0]->actividadeconomica?>');
 		
		
			<? if($dUsuario->perfil!=4) {?> 
				 
				jQuery("[name='EvalEncuesta[emailcontacto]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[doccontacto]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[nombrecontacto]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[docrepresentante]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[representantelegal]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[fax]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[telefono]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[nit]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[ciudaddepartamento]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[direccionempresa]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[nombreempresa]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[actividadeconomica]']").attr({"readonly":"true"}); 
				 
				 
			<? } ?> 
		
		
		
		
	<?}else if(count($empresas)>1){
		
		?>
		seleccioneempresa(); 
	
	<?}?>
	var fecha = new Date();
var ano = fecha.getFullYear();
		$( "#fecha" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "dd-mm-yy","yearRange":"2013:"+ano});
		//$( "#fecha" ).datepicker({changeMonth: true,changeYear: true, "dateFormat": "dd-mm-yy" }); 
	
	<? if($tipo=="simulacro"){ ?>

 	jQuery(function(){
		var w="450px";
		var h="180px";
		if(jQuery(window).width()<=500){
			w="90%";
			h="40%";
 		}
		jQuery.colorbox({html:"<center><h3>¿Desea guardar el simulacro?</h3><br><input type='button' rel='vs' value='Si' /><input type='button' rel='vs' value='No' /></center>",width:w,height:h}); 
		jQuery("[rel='vs']").click(function(){
			var op=jQuery(this).val();
			if(op=="No"){
							jQuery("[name='EvalEncuesta[estado]']").val("D");
			} else{
					jQuery("[name='EvalEncuesta[estado]']").val("S");
			}
			jQuery.colorbox.close();
		}
		);
	});
	<? } ?>
	
	jQuery("[rel='guardar']").click(function(){
		var validar=true;
		
		var checked=jQuery("[rel='tipovisita']:checked"); 
		
 		
		if(checked.length==0  && validar==true){
			alert('Por favor seleccione el tipo de visita.');
			validar=false;
		}
 		if((jQuery("[name='EvalEncuesta[fecha]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese la fecha");
			validar=false;
		}
		
 		if($("[name='EvalEncuesta[emailcontacto]']").val().indexOf('@', 0) == -1 || $("[name='EvalEncuesta[emailcontacto]").val().indexOf('.', 0) == -1) {
            alert('El correo electrónico introducido no es correcto.');
			validar=false;
        }
		if((esnumero(jQuery("[name='EvalEncuesta[telefono]']").val())==false || (jQuery("[name='EvalEncuesta[telefono]']").val()).trim(" ")=="") && validar==true){
			alert("El teléfono debe ser numérico");
			validar=false;
		}
 		if((esnumero(jQuery("[name='EvalEncuesta[fax]']").val())==false  || (jQuery("[name='EvalEncuesta[fax]']").val()).trim(" ")=="") && validar==true){
			alert("El fax debe ser numérico");
			validar=false;
		}
		
 		if((esnumero(jQuery("[name='EvalEncuesta[docrepresentante]']").val())==false  || (jQuery("[name='EvalEncuesta[docrepresentante]']").val()).trim(" ")=="") && validar==true){
			alert("El documento de representante legal debe ser numérico");
			validar=false;
		}
		
 		if((esnumero(jQuery("[name='EvalEncuesta[doccontacto]']").val())==false  || (jQuery("[name='EvalEncuesta[doccontacto]']").val()).trim(" ")=="") && validar==true){
			alert("El documento del contacto debe ser numérico");
			validar=false;
		}
  		if((jQuery("[name='EvalEncuesta[nombreempresa]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese el nombre de la empresa");
			validar=false;
		}
		
 		if((jQuery("[name='EvalEncuesta[direccionempresa]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese la dirección de la empresa");
			validar=false;
		}
		
 		if((jQuery("[name='EvalEncuesta[ciudaddepartamento]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese ciudad y departamento");
			validar=false;
		}
		
 		if((jQuery("[name='EvalEncuesta[nit]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese el Nit");
			validar=false;
		}
		
 		if((jQuery("[name='EvalEncuesta[representantelegal]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese nombre del representante legal");
			validar=false;
		}
		
 		if((jQuery("[name='EvalEncuesta[nombrecontacto]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese nombre del contacto");
			validar=false;
		}
		
 		if((jQuery("[name='EvalEncuesta[actividadeconomica]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor ingrese actividad económica");
			validar=false;
		}
		
 		
 		if((jQuery("[name='EvalEncuesta[alcance]']").val()).trim(" ")=="" && validar==true){
			alert("Por favor escriba el alcance");
			validar=false;
		}
 		
 		if((jQuery("[name='EvalEncuesta[idorg]']").val()).trim(" ")=="" && validar==true){
			seleccioneempresa();
			validar=false;
 		}
 		
		validar=validarelementosdinamicos(jQuery("[name^='EvalEncuesta[sut]']"),validar);
		validar=validarelementosdinamicos(jQuery("[name^='EvalEncuesta[dee]']"),validar);
 		console.log(validar);
		
 		if(validar==true){
 			var formData = new FormData($(".formu")[0]);
			$.ajax({
				url: $(".formu").attr("action"),  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				dataType: "json",
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					//message = $("<span class='before'>Eliminando archivo...</span>");
					//showMessage(message)        
				},
				//una vez finalizado correctamente
				success: function(data){
					try{
						var id=data.id; 
						if(id>0){
							jQuery("#formularioinicial").fadeOut("slow");
							setTimeout(function(){
								jQuery("#encuesta").fadeIn("slow");
								var visita=jQuery("[rel='tipovisita']:checked").attr("title");
								window["idformulario"]=id;
								jQuery("#contenedor_encuesta").attr({"src":"<?=Yii::app()->baseUrl?>/index.php/984333/lang-es?idorg="+window["idorg"]+"&idus=<?=$usuario->id?>&visita="+visita+"&tipo=<?=$tipo?>&idform="+id,"style":"height:"+jQuery("body").height()+"px;width:100%"});
 							},800);
 							
 						}
					}catch(e){
						alert("Error al guardar, intentelo más tarde");
					}
					 

				},
				//si ha ocurrido un error
				error: function(){
					message = $("<span class='error'>Ha ocurrido un error.</span>");
					showMessage(message);
				}
			});				
	
			
 			
		}
	});
	$('#formu').submit(function() {
	  return false;
	});		
	
	jQuery("[id^='add_']").click(function(){
		var sufijo=jQuery(this).attr("id").split("_")[1];
		var attrs=jQuery(this).attr("rel").split(",");
		var tipo=[];
		var place=[];
		jQuery.each(attrs,function(k,d){
			var tk=d.split(":");
			tipo.push(tk[1]);
			place.push(tk[0]);
		});
 		var totales=jQuery("."+sufijo).size()+1;
		var sut='<div  class="col-md-12 col-xs-12 '+sufijo+'" >';
			sut+='<div  class="col-md-4 col-xs-12">';
			sut+='			<img src="<?=Yii::app()->baseUrl?>/img/bad.gif" id="del_'+sufijo+'_'+totales+'" style="cursor:pointer;float:left" />';
			sut+='			<input type="'+tipo[0]+'"  name="EvalEncuesta['+sufijo+']['+totales+'][0]" style="width:91%;float:right" placeholder="'+place[0]+'" />';
			sut+='		</div>';
			sut+='		<div  class="col-md-4 col-xs-12">';
			sut+='			<input type="'+tipo[1]+'"  name="EvalEncuesta['+sufijo+']['+totales+'][1]" style="width:91%;float:right" placeholder="'+place[1]+'" />';
			sut+='		</div>';
			sut+='		<div  class="col-md-4 col-xs-12">';
			sut+='			<input type="'+tipo[2]+'"  name="EvalEncuesta['+sufijo+']['+totales+'][2]" style="width:91%;float:right" placeholder="'+place[2]+'" />';
			sut+='		</div>';
			sut+='		<div style="clear:both"></div>';
			sut+='	</div> <div style="clear:both"></div>';
			jQuery("#"+sufijo).append(sut);
			delsut(sufijo);
	});
	jQuery("[rel='tipovisita']").click(function(){
		var t=jQuery(this).attr("title");
		if(jQuery(this).is(":checked")){
			jQuery.each(jQuery("[rel='tipovisita']"),function(k,d){
				var st=jQuery(d).attr("title");
				if(st!=t){
					jQuery(d).removeAttr("checked");
				}
			});
		} 
	});
	delsut();
	href();
	checkend();
	 
});
function seleccioneempresa(){
		<?
		$emptemp=array();
		foreach($empresas as $data){
			$dt=array();
			foreach($data as $kk=>$dd){
				$dt[$kk]=$dd;
			}
			array_push($emptemp,(object)$dt);
		}
		$datajemp=json_encode($emptemp);
		?>
		var h="<b>Seleccione una empresa:</b><select id='selempresa'><option value='-1'>----------</option><? foreach($empresas as $id=>$emp){?><option value='<?=$id?>'><?=$emp->nombre?></option><?}?></select>";
		jQuery.colorbox({html:"<dvi>"+h+"</div>","width":"400px","height":"150px"});
		jQuery("#selempresa").change(function(){
			jQuery.colorbox.close();
			var id= jQuery(this).val();
 			var empresa=jQuery.parseJSON('<?=$datajemp?>');
			window["idorg"]=empresa[id]['id'];

 			jQuery("[name='EvalEncuesta[nombreempresa]']").val(empresa[id]['nombre']);
			
			jQuery("[name='EvalEncuesta[direccionempresa]']").val(empresa[id]['direccion']);
			jQuery("[name='EvalEncuesta[ciudaddepartamento]']").val(empresa[id]['ciudad']);
			jQuery("[name='EvalEncuesta[nit]']").val(empresa[id]['nit']);
			jQuery("[name='EvalEncuesta[telefono]']").val(empresa[id]['telefono']);
			jQuery("[name='EvalEncuesta[fax]']").val(empresa[id]['fax']);
			jQuery("[name='EvalEncuesta[representantelegal]']").val(empresa[id]['representantelegal']);
			jQuery("[name='EvalEncuesta[docrepresentante]']").val(empresa[id]['docidentidadrep']);
			jQuery("[name='EvalEncuesta[nombrecontacto]']").val(empresa[id]['nombrecontacto']);
			jQuery("[name='EvalEncuesta[doccontacto]']").val(empresa[id]['docidentidadcontacto']);
			jQuery("[name='EvalEncuesta[emailcontacto]']").val(empresa[id]['emailcontacto']);
			jQuery("[name='EvalEncuesta[actividadeconomica]']").val(empresa[id]['actividadeconomica']);
 			jQuery("[name='EvalEncuesta[idorg]']").val(empresa[id]['id']);
			  
			<? if($dUsuario->perfil!=4) {?> 
				 
				jQuery("[name='EvalEncuesta[emailcontacto]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[doccontacto]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[nombrecontacto]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[docrepresentante]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[representantelegal]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[fax]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[telefono]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[nit]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[ciudaddepartamento]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[direccionempresa]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[nombreempresa]']").attr({"readonly":"true"});
				jQuery("[name='EvalEncuesta[actividadeconomica]']").attr({"readonly":"true"}); 
				 
				 
			<? } ?> 
			 
			 
			 
  		});
  }
function validarelementosdinamicos(objs,v){
	var obj=objs; 
	var totales=obj.length;
	var bandera=false;
	var con=0;
	var validar=v;
	while(bandera==false && validar==true){
		if(jQuery(obj[con]).val().trim(" ")==""){
			alert("Por favor asegúrese de llenar los campos correspondientes a "+jQuery(obj[con]).attr("placeholder"));
			validar=false;
			bandera=true;
		}
		con++;
		if(con>=totales){
			bandera=true;
			validar=true;
		}
	}
	return validar;
 }


function href(){
	jQuery("[rel^='href_']").click(function(){
		var h=jQuery(this).attr("rel").split("_")[1];
		document.location="<?=Yii::app()->baseUrl?>/index.php/admin/pcos/"+h;
	});
	
}
function delsut(sufijo){
	jQuery("[id^='del_"+sufijo+"']").click(function(){ console.log(1);
		jQuery(this).parent().parent().remove();
	})
}	
function esnumero(numero){
	var r=true;
    if (!/^([0-9])*$/.test(numero)){
      r=false;
	}
	return r;
  }

function checkend(){
	
	window["refreshIntervalId"] = setInterval(function(){ 
		if($("#contenedor_encuesta").contents().find("#completed").size()>0){
			clearInterval(window["refreshIntervalId"]);
			setTimeout(function(){
 				anexos();
			},200);
  		}
	},500);	 
}

function anexos(){
	if(confirm("Desea agregar anexos referentes a la auditoría?")){
		var id=window["idformulario"];
		$(".validar").find("[name='idform']").val(id);
		$(".validar").find("[name='option']").val("validar");
		var formData = new FormData($(".validar")[0]);
			$.ajax({
				url: $(".validar").attr("action"),  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				dataType: "json",
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					//message = $("<span class='before'>Eliminando archivo...</span>");
					//showMessage(message)        
				},
				//una vez finalizado correctamente
				success: function(data){
				var archivos='';
				jQuery.each(data[3],function(k,d){
					var nombre=d["nombre"];
					var fecha=d["fecha"];
					var tipo=d["tipo"];
					var url=d["url"];
					var id=d["id"];
					archivos+='<div><button rel="delanexo" value="'+id+'" ><img src="<?=Yii::app()->baseUrl?>/img/bad.gif" width="20" /></button><button rel="getanexo" value="'+id+'" ><img src="<?=Yii::app()->baseUrl?>/img/'+tipo+'.png" width="20" /></button>'+nombre+'</div><br>';
					
				});
				var html="<div id='addarc'>"+archivos+"</div>";
				if(data[1]=="ok"){  
					var html='<div class="divContentWhite"><div id="addarc">'+archivos+"</div>";
					html+='<br><br><b>Subir Archivos</b><form class="formulario" id="formCrear" style="margin:0px; padding:0px;" enctype="multipart/form-data" action="<?=Yii::app()->baseUrl?>/index.php/admin/pcos/cargar" method="post">';
					html+='<input name="YII_CSRF_TOKEN" type="hidden" value="'+jQuery(".formu").find("[name='YII_CSRF_TOKEN']").val()+'" /><br /><br />';
					html+='<input name="archivo" type="file" id="archivo" /><br /><br />';
					html+='<input name="idform" type="hidden" value="'+data[2]+'" id="idform" />';
					html+='<input type="button" id="canexo_'+data[2]+'" value="Subir Archivo" /><br />';
					html+='<input type="hidden" name="save" />';
					html+='</form>';
					html+='<div class="messages"></div><br /><br />';
					html+='<div class="showImage"></div>';
					html+='</div>';
					
				}
				
				var w=jQuery(window).width();
				var width="600px";
				var height="600px";
				if(w<=600){
					width="95%";
					height="80%";
				} 
				
				
				jQuery.colorbox({html:html,width:width,height:height});
				anexo(data[2]);
				actionanexos();	
				
				
			}
		});		
	
	}
	
}

function anexo(id){
	
 
    $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    var name = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#archivo")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
		name=fileName;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });
 
    //al enviar el formulario
    $('#canexo_'+id).click(function(){
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
		var ida=jQuery(this).attr("id").split("_")[1];
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: $(".formulario").attr("action"),  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                message = $("<span class='before'>Subiendo archivo, por favor espere...</span>");
                showMessage(message)        
            },
            //una vez finalizado correctamente
            success: function(data){
                if(!isImage(fileExtension))
                {
					showMessage("El archivo con extención "+fileExtension+" no es válido");
                   // $(".showImage").html("<img src='files/"+data+"' />");
                }else{
 					message = $("<span class='success'>El archivo se ha cargado correctamente.</span>");
					showMessage(message);
					var archivos='<div><button rel="delanexo" value="'+ida+'" ><img src="<?=Yii::app()->baseUrl?>/img/bad.gif" width="20" /></button><button rel="getanexo" value="'+ida+'" ><img src="<?=Yii::app()->baseUrl?>/img/'+fileExtension+'.png" width="20" /></button>'+name+'</div><br>';
					jQuery("#addarc").append(archivos); 
					actionanexos();
 				}
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                showMessage(message);
            }
        });
    });	
	
	
	
}
//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
          case 'jpg':
            return true;
          case 'gif':
            return true;
          case 'png':
            return true;
          case 'doc':
            return true;
          case 'docx':
            return true;
          case 'pdf':
            return true;
          case 'xls':
            return true;
          case 'xlsx':
            return true;
          case 'ppt':
            return true;
          case 'pptx':
            return true;
        break;
        default:
            return false;
        break;
    }
}
function actionanexos(){
	jQuery("[rel='delanexo']").click(function(){
 		if(confirm("Desea eliminar este archivo?")){
		$(".validar").find("[name='id']").val(jQuery(this).val());
		$(".validar").find("[name='option']").val("del");
		var obj=jQuery(this);
		var formData = new FormData($(".validar")[0]);;
			$.ajax({
			url:$(".validar").attr("action"),  
			type: 'POST',
			// Form data
			//datos del formulario
			data: formData,
			//necesario para subir archivos via ajax
			cache: false,
			dataType: "json",
			contentType: false,
			processData: false,
			//mientras enviamos el archivo
			beforeSend: function(){
				//message = $("<span class='before'>Eliminando archivo...</span>");
				//showMessage(message)        
			},
			//una vez finalizado correctamente
			success: function(data){	
				if(data[0]=="ok"){
					alert("El archivo ha sido eliminado");
					obj.parent().remove();
				}
				if(data[0]=="no"){
					alert(data[1]); 
 				}
			}
			});
		}
 	});
	jQuery("[rel='getanexo']").click(function(){
		var id=jQuery(this).val();
		$(".fanexo").find("[name='id']").val(id);
		$(".fanexo").find("[name='option']").val("get");
		$(".fanexo").submit();
	})
	
	
}
</script>
<?php echo CHtml::form(array("admin/pcos/action"), 'post', array('class'=>'acciones' , 'id'=>'acciones')); ?>
</form>
 <?php echo CHtml::form(array("admin/pcos/cargar"), 'post', array('class'=>'validar' , 'id'=>'validar')); ?>
 	<input type="hidden" name="id" />
 	<input type="hidden" name="idorg" />
 	<input type="hidden" name="idform" />
 	<input type="hidden" name="option" />
</form>
<?php echo CHtml::form(array("admin/pcos/getanexo"), 'post', array('class'=>'fanexo' , 'id'=>'fanexo','target'=>"iframeanexo")); ?>
  	<input type="hidden" name="id" />
 	<input type="hidden" name="option" />
</form>
 
<div id="content" style="padding:10px">
	<div class="col-md-12">
		<div class="divContentBlue" id="formularioinicial">  
		<!--
		<? if($dUsuario->perfil==6 or $dUsuario->perfil==7 or  $dUsuario->perfil==3 or $oRecord->uid==1 ){ ?>
		<input type="button" value="Simulacro" style="float:left;" rel="href_simulacro"/>
		<? } ?>
		<? if($dUsuario->perfil==6 or  $dUsuario->perfil==3 or $oRecord->uid==1 ){ ?>
		<input type="button" value="Auditoría Interna" rel="href_interno" style="float:left;margin-left:10px"/>
		<? } ?>
		<? if($dUsuario->perfil==7 or  $dUsuario->perfil==3 or $oRecord->uid==1 ){ ?>
 		<input type="button" value="Auditoría Externa" rel="href_externo" style="float:left;margin-left:10px"/>
		<? } ?> -->
		<div style="clear:both"></div>
		 <h3><?=$titulo?></h3><div style="clear:both"></div>
			<div class="divContentWhite">
				<?php echo CHtml::form(array("admin/pcos/".$tipo), 'post', array('class'=>'formu' , 'id'=>'formu')); ?>
				<div class="col-md-2 col-xs-1"></div>
				<div class="col-md-8 col-xs-12">
					<h4 style="display:none"><b>TIPO DE VISITA</b></h4>
					<div style="clear:both"></div>
						<div class="col-md-6" style="display:none" >
						<ul>   
							<li><label><input checked="checked" type="checkbox" rel="tipovisita" value="Y" title="Verificacion" name="EvalEncuesta[vistaverificacion]" checked="checked" /><?=$formulario['vistaverificacion']?></label></li>
							<li><label><input type="checkbox" rel="tipovisita" value="Y" title="Seguimiento" name="EvalEncuesta[vistaseguimiento]" /><?=$formulario['vistaseguimiento']?></label></li>
							<li><label><input type="checkbox" rel="tipovisita" value="Y" title="Adicional" name="EvalEncuesta[vistaadicional]" /><?=$formulario['vistaadicional']?></label></li>
						</ul>
						</div>
						<div class="col-md-6">
							<b><?=$formulario["fecha"]?></b><div style="clear:both"></div>
							<input type="text" id="fecha" name="EvalEncuesta[fecha]" /> 
						</div>
				</div>
				<div class="col-md-2 col-xs-1"></div>
				<div style="clear:both"></div>
				
				<div class="col-md-2 col-xs-1"></div>
				<div class="col-md-8 col-xs-12">
					<center><h4><b>Datos de identificación de la empresa</b></h4></center><br>
					
					<div style="clear:both"></div>
					<div  class="col-md-12 col-xs-12">
						<div  class="col-md-4 col-xs-12">
							<span style="float:left"><b><?=$formulario["nombreempresa"]?>:</b></span>
						</div>
						<div  class="col-md-8 col-xs-12">
							<input type="text" name="EvalEncuesta[nombreempresa]" style="width:100%" /> 
						</div>
						<div style="clear:both"></div>
					</div>
					
					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
						<div  class="col-md-4 col-xs-12">
							<span style="float:left"><b><?=$formulario["direccionempresa"]?>:</b></span>
						</div>
						<div  class="col-md-8 col-xs-12">
							<input type="text" name="EvalEncuesta[direccionempresa]" style="width:100%" /> 
						</div>
						<div style="clear:both"></div>
					</div> 
					
					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
 							<div  class="col-md-4 col-xs-12">
								<span style="float:left"><b><?=$formulario["ciudaddepartamento"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[ciudaddepartamento]" style="width:100%" /> 
							</div>
							
 							<div  class="col-md-2 col-xs-12">
								<span style="float:left"><b><?=$formulario["nit"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[nit]" style="width:100%" /> 
							</div>
 						<div style="clear:both"></div>
					</div> 
					
					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
 							<div  class="col-md-4 col-xs-12">
								<span style="float:left"><b><?=$formulario["telefono"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[telefono]" style="width:100%" /> 
							</div>
							
 							<div  class="col-md-2 col-xs-12">
								<span style="float:left"><b><?=$formulario["fax"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[fax]" style="width:100%" /> 
							</div>
 						<div style="clear:both"></div>
					</div> 
					
					
					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
 							<div  class="col-md-4 col-xs-12">
								<span style="float:left"><b><?=$formulario["representantelegal"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[representantelegal]" style="width:100%" /> 
							</div>
							
 							<div  class="col-md-2 col-xs-12">
								<span style="float:left"><b><?=$formulario["docrepresentante"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[docrepresentante]" style="width:100%" /> 
							</div>
 						<div style="clear:both"></div>
					</div> 
					
					
					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
 							<div  class="col-md-4 col-xs-12">
								<span style="float:left"><b><?=$formulario["nombrecontacto"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[nombrecontacto]" style="width:100%" /> 
							</div>
							
 							<div  class="col-md-2 col-xs-12">
								<span style="float:left"><b><?=$formulario["doccontacto"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[doccontacto]" style="width:100%" /> 
							</div>
 						<div style="clear:both"></div>
					</div> 
					
					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
 							<div  class="col-md-4 col-xs-12">
								<span style="float:left"><b><?=$formulario["emailcontacto"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[emailcontacto]" style="width:100%" /> 
							</div>
							
 							<div  class="col-md-2 col-xs-12">
								<span style="float:left"><b><?=$formulario["actividadeconomica"]?>:</b></span>
							</div>
							<div  class="col-md-3 col-xs-12">
								<input type="text" name="EvalEncuesta[actividadeconomica]" style="width:100%" /> 
							</div>
 						<div style="clear:both"></div>
					</div> 
 					
					<div style="clear:both"></div><br>
					<div  class="col-md-12 col-xs-12">
 							<div  class="col-md-12 col-xs-12">
								<center><span ><b><?=$formulario["alcance"]?></b></span></center>
							</div><div style="clear:both"></div><br>
							<div  class="col-md-12 col-xs-12">
								<textarea  name="EvalEncuesta[alcance]" style="width:100%" > </textarea >
							</div>
  						<div style="clear:both"></div>
					</div> 
 					
 					
					<div style="clear:both"></div><br>
					<div class="col-md-12 col-xs-12">
					<label><img src="<?=Yii::app()->baseUrl?>/img/add.gif" id="add_sut" rel="Nombre Sede:text,Ubicación:text,No. Trabajadores:number" style="cursor:pointer;float:left;" />Agregar</label>
					<div style="clear:both"></div>	
					    <div  id="sut">
							<div  class="col-md-12 col-xs-12 sut" >
									<div  class="col-md-4 col-xs-12">
 										<input type="text"  name="EvalEncuesta[sut][0][0]" style="width:91%;float:right" placeholder="Nombre Sede" />
									</div>
									<div  class="col-md-4 col-xs-12">
										<input type="text"  name="EvalEncuesta[sut][0][1]" style="width:91%;float:right" placeholder="Ubicación" />
									</div>
									<div  class="col-md-4 col-xs-12">
										<input type="number"  name="EvalEncuesta[sut][0][2]" style="width:91%;float:right" placeholder="No. Trabajadores" />
									</div>
								<div style="clear:both"></div>
							</div> <div style="clear:both"></div>
						</div>
					</div>
					
					
					<div style="clear:both"></div><br>
					<div class="col-md-12 col-xs-12">
						<div  class="col-md-12 col-xs-12">
						<center><span ><b>Datos del equipo evaluador</b></span></center>
						</div><div style="clear:both"></div><br>
 						<label><img src="<?=Yii::app()->baseUrl?>/img/add.gif" id="add_dee"  rel="Nombre Evaluador:text,Documento de Identidad:number,Cargo:text"  style="cursor:pointer;float:left;" />Agregar</label>
						<div style="clear:both"></div>	
						<div  id="dee">
							<div  class="col-md-12 col-xs-12 dee" >
									<div  class="col-md-4 col-xs-12">
										<input type="text"  name="EvalEncuesta[dee][0][0]" style="width:91%;float:right" placeholder="Nombre Evaluador" />
									</div>
									<div  class="col-md-4 col-xs-12">
										<input type="number"  name="EvalEncuesta[dee][0][1]" style="width:91%;float:right" placeholder="Documento de Identidad" />
									</div>
									<div  class="col-md-4 col-xs-12">
										<input type="text"  name="EvalEncuesta[dee][0][2]" style="width:91%;float:right" placeholder="Cargo" />
									</div>
								<div style="clear:both"></div>
							</div> <div style="clear:both"></div>
						</div>
					</div>
					
					
					
 					
				</div>
				<div class="col-md-2 col-xs-1"></div>
				
				<div style="clear:both"></div><br>
				<div class="col-md-2 col-xs-1"></div>
					<div class="col-md-8 col-xs-12">
						<input type="hidden" name="EvalEncuesta[tipoeval]" value="<?=$tipo?>" />
						<input type="hidden" name="EvalEncuesta[estado]" value="S" />
						<? if(count($empresas)==1){?>
 						<input type="hidden" name="EvalEncuesta[idorg]" value="<?=$empresas[0]->id?>" />
						<? }else{?><input type="hidden" name="EvalEncuesta[idorg]"   /><?} ?>
						
 						<center><input type="button" value="Continuar" rel="guardar"/></center>
					</div>
				<div class="col-md-2 col-xs-1"></div>
				</form>
				<div style="clear:both"></div>
			</div>
 		</div>
		
		
		
		<div class="divContentBlue" id="encuesta" style="display:none">
				 <h3><?=$titulo?> Lista de chequeo</h3><div style="clear:both"></div>
				<div class="divContentWhite">	
				<iframe src="" id="contenedor_encuesta"></iframe>
				</div>
		</div>
 		
	</div>
	 
</div>