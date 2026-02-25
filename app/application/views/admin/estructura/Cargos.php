<?php

 $strTemp = "";
for($i=0;$i<count($unis);$i++){
	$strTemp .= "<option value='".$unis[$i]->id."'>".utf8_decode($unis[$i]->nombre)."</option>";
}
$unis = $strTemp;

 $strTemp = "<option value='15'>NINGUNA</option>";
for($i=0;$i<count($ares);$i++){
	$criteria = new CDbCriteria;
	$criteria->condition ="id=".$ares[$i]->idunidad;						
	$unidadt= EvalUnidades::model()->find($criteria);
 	$strTemp .= "<option value='".$ares[$i]->id."'>".utf8_decode($unidadt->nombre)." - ".utf8_decode($ares[$i]->nombre)."</option>";
}
$ares = $strTemp;

 
?>
 <script src="//ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js"></script> 
 <script type="text/javascript">

obj = {
	data: <?=json_encode($cunive);?>,
	comps: [],
	idTec : [],
	critsTec : [],
	findPosID:function(laID){
		var i; var pos = 0;
		for(i=0; i < this.data.length; i++){
			if(this.data[i].id == laID)return i;
		}
	},
	add : function(){
		var nombre = jQuery("#textNom").val()+"";
		var descri = jQuery("#textDes").val()+"";
		var empres = "NR";
//		var activa = jQuery("selectActiva").value+"";
                var activa ="1"+"";
		var unidad = jQuery("#selectUnidad").val()+"";
		var area = jQuery("#selectArea").val()+"";
		var proyec = 1;
		var pais = jQuery("#textPai").val()+"";
		jQuery("#hiddenCris").val(this.strucEvaluacion());
 		if(nombre.length == 0){
			alert("Debe escribir un nombre");
			jQuery("#textNom").focus();
			return;
		}
		if(descri.length == 0){
			alert("Debe escribir una descripcion");
			jQuery("#textDes").focus();
			return;
		}
		if(unidad.length == 0){
			alert("Debe escribir una unidad");
			jQuery("#textUni").focus();
			return;
		}
		if(area.length == 0){
			alert("Debe escribir un área");
			jQuery("#textAre").focus();
			return;
		}
		if(proyec.length == 0){
			alert("Debe escribir un proyecto");
			jQuery("#textPro").focus();
			return;
		}
		if(pais.length == 0){
			alert("Debe escribir un país");
			jQuery("#textPai").focus();
			return;
		}
		if(empres.length == 0){
			alert("Debe escribir un empresa");
			jQuery("#textEmp").focus();
			return;
		}
		jQuery("#formForm").submit();
	},
	adds:function(){
		jQuery("#badd").css("display","");
		jQuery("#bsim").css("display","");
		jQuery("#bupd").css("display","none");
		jQuery("#trCompe").css("display","");
		jQuery("#textAccion").val("insert");
		jQuery("#textNom").val("");
		jQuery("#textDes").val("");
		jQuery("#textEmp").val("");
		jQuery("#textUni").val("");
		jQuery("#textAre").val("");
		jQuery("#textPro").val("");
		jQuery("#textPai").val("");
		jQuery("#selectActiva").val(1);
		jQuery("#addUpdate").scrollTo();
	},
	edit:function(id){
		var pos = this.findPosID(id);
		jQuery("#badd").css("display","none");
		jQuery("#bsim").css("display","none");
		jQuery("#trCompe").css("display","none");
		jQuery("#bupd").css("display","");
		jQuery("#textAccion").val("update");
		jQuery("#textId").val(this.data[pos].id);
		jQuery("#textNom").val(this.data[pos].nombre);
		jQuery("#textDes").val(this.data[pos].descripcion);
		jQuery("#textEmp").val(this.data[pos].empresa);
		jQuery("#textUni").val(this.data[pos].unidad);
		jQuery("#textAre").val(this.data[pos].area);
		jQuery("#textPro").val(this.data[pos].proyecto);
		jQuery("#textPai").val(this.data[pos].pais);
		jQuery("#selectActiva").val(this.data[pos].activo)+"";
		jQuery("#addUpdate").scrollTo();
	},
	upd:function(){
		var nombre = jQuery("#textNom").val()+"";
		var descri = jQuery("#textDes").val()+"";
		var empres = 1;
		var unidad = jQuery("#textUni").val()+"";
		var area   = jQuery("#textAre").val()+"";
		var proyec = 1;
		var pais   = jQuery("#textPai").val()+"";
		var activa = "1"; //jQuery("selectActiva").value+"";
		var nivels = "1"; //jQuery("selectNivel").value+"";
		if(nombre.length == 0){
			alert("Debe escribir un nombre");
			jQuery("#textNom").focus();
			return;
		}
		if(descri.length == 0){
			alert("Debe escribir una descripcion");
			jQuery("#textDes").focus();
			return;
		}
		if(unidad.length == 0){
			alert("Debe escribir una unidad");
			jQuery("#textUni").focus();
			return;
		}
		if(area.length == 0){
			alert("Debe escribir un área");
			jQuery("#textAre").focus();
			return;
		}
 
		if(pais.length == 0){
			alert("Debe escribir un país");
			jQuery("#textPai").focus();
			return;
		}
		jQuery("#textPro").val(1);
  		jQuery("#textEmp").val("NR");
		jQuery("#formForm").submit();
	},
	strucComps : function(datos){console.log(datos);
			var i = 0;
		var j = 0;
		for(i=0;i <datos.length;i++){
			for(j=0;j<datos[i].crits.length;j++){
				datos[i].crits[j].nivs = eval('('+datos[i].crits[j].nivs+')');
			}
		}
		for(i=0;i <datos.length;i++){
			for(j=0;j <datos[i].crits.length;j++){
				datos[i].crits[j].nivs.sort(this.sortArrayObject("id_niv"));
			}
		} 
		return datos;
	},
	sortArrayObject: function(field){
		return function(a,b){
			a = a[field];
			b = b[field];
			if (a<b) return -1;
			if (a>b) return 1;
			return 0;
		}
	},
	
	printCompetencias : function(datos){ 
 		//document.getElementById("tdCompetencias").innerHTML = html;
	},
	printCriterios : function(datos1, posct){
 		var html1 = "";
		 
 		return html1;
	},
	printNivs : function(datos2, posct, posc){
		var j = 0;
		var html2 = "";
		for(j=0; j < datos2.length;j++){
			html2 += ""+
			"<input disabled='disabled' type='radio' name='radio-"+posct+"-"+posc+"' id='radio-"+posct+"-"+posc+"-"+j+"'> "+datos2[j].nom_niv;
		}
		return html2;
	},
	checkCheck : function (ele){
		var par = ele.id.split("-");
		var posCo = parseInt(par[1],10);
		var posCr = parseInt(par[2],10);
		var chec = ele.checked;
		var i = 0;
		for(i = 0 ; i< this.comps[posCo].crits[posCr].nivs.length ;i++){
			document.getElementById("radio-"+posCo+"-"+posCr+"-"+i+"").disabled = !chec;
		}
	},
	
	findCritsTec : function(){
		var nom = jQuery("#textTecsFind").val()+"";
		if(nom.length == 0){
			alert("Debe escribir un nombre para poder buscar a personas");
			return;
		}
		var aleatorio = Math.random()*1000000;
		var url = 'ajaxPages/findTecs.php';
		var url="<?=$urlbase?>index.php/admin/estructura/AjaxCargos";
		var pars = { buscar : nom,alea:aleatorio,op:"findTecs"};
		 
		
		var res = jQuery.ajax({ 
		type: "POST",
		dataType: "html",
		async: false,
		url: url,
		data:pars 
 		}).responseText;	
		console.log(res);
		jQuery("#divTecsFinds").html(res);		
 		
	},
	eliminar:function(id){
		 
	},
	addCritTec: function(id, idn, nombre){
		var i = 0;
		for(i=0; i < this.critsTec.length; i++){
			if(this.critsTec[i].id == id){
				alert("Esta comportamiento tecnico ya esta agregado");
				return;
			}
		}
		this.critsTec.push({"id":id,"nombre":nombre,"idn":idn});
		this.pintarCritTecsAct();
	},
	delCritTec: function(id){
		var i = 0;
		for(i=0; i < this.critsTec.length; i++){
			if(this.critsTec[i].id == id){
				if(confirm("Esta seguro de retirar el comportamiento tecnico: "+this.critsTec[i].nombre)){
					break;
				}else{
					return;
				}
			}
		}
		this.critsTec.splice(i,1);
		this.pintarCritTecsAct();
	},
	pintarCritTecsAct : function(){
		var html = "";
		var i = 0;
		for(i=0; i < this.critsTec.length; i++){
			html += "<div onclick='obj.delCritTec("+this.critsTec[i].id+")'>"+this.critsTec[i].nombre+" <img src='<?=$imageurl?>bad.gif' style='vertical-align:middle;cursor:pointer' /></div>";
		}
		jQuery("#divTecsAdds").html(html);
	},
	strucEvaluacion : function (){
		var i = 0;
		var j = 0;
		var k = 0;
		var evalComps = [];
		for(i=0; i<this.comps.length; i++){
			var dato1 = this.comps[i];
			for(j=0; j<dato1.crits.length; j++){
				var dato2 = dato1.crits[j];				
				 if(jQuery("#checkbox-"+i+"-"+j+"").is(":checked")){
					var bbbb = false;
					for(k=0; k<dato2.nivs.length; k++){
						var dato3 = dato2.nivs[k];
						if(jQuery("#radio-"+i+"-"+j+"-"+k).is(":checked")){
							evalComps.push({"idc":dato2.id_c,"idn":dato3.id_niv});
							bbbb = true;
						}
					}
					if(!bbbb){
						alert("A seleccinoado el critero: "+dato2.nom_c+" y no selecciono ningun nivel");
						return;
					}
				} 
				
			}
		}
		for(i=0; i < this.critsTec.length; i++){
			evalComps.push({"idc":this.critsTec[i].id,"idn":this.critsTec[i].idn});
		}
		
		 
		return JSON.stringify(evalComps);
		 		//return jQuery.parseJSON(evalComps);
	},
	sim : function(){
		jQuery("#hiddenSim").val(this.strucEvaluacion());
		jQuery("#formSim").submit();
	}
}

 
jQuery(function(){
	obj.comps = obj.strucComps(obj.comps);

	setTimeout(function(){obj.printCompetencias(obj.comps);},300);
	jQuery("[rel^='elimina_']").click(function(){
		var id=jQuery(this).attr("rel").split("_");
		var OBJ=jQuery(this);
		
		var url="<?=$urlbase?>index.php/admin/estructura/AjaxCargos";
		var pars = { id : id[1],op:"eliminar"};
		if (confirm("Se eliminara el cargo.Desea continuar?")){	
			var res = jQuery.ajax({ 
			type: "POST",
			dataType: "html",
			async: false,
			url: url,
			data:pars 
			}).responseText;	
			if(res=="OK"){
				alert("El cargo ha sido eliminado");
				OBJ.parent().parent().remove();
			}else{
				alert("Algo salio mal, por favor intente denuevo");
			
			} 
		}		 
	
	});
	jQuery("#selectUnidad").change(function(){
		var url="<?=$_SERVER["SCRIPT_NAME"]?>/admin/estructura/getAreas";
		var id=jQuery(this).val();
		var  objdata={"idunidad":jQuery(this).val()};
		jQuery.ajax({ 
			type: "POST",
			dataType: "json",
			async: false,
			url: url,
			data:objdata,
			success:function(res){
				var html="<option value='-1' >Seleccione área</option>";
				jQuery.each(res,function(k,d){
					html+="<option value='"+d["id"]+"' >"+d["nombre"]+"</option>";
				});
				jQuery("[name='selectArea']").html(html);
			}
		});			
 	});
});
</script>
  
<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
 
		<tr>
		<td>
		
			<div style="display:<?=$_GET["msjDisplay"]?>" class="<?=$_GET["msjClass"]?>"><?=$_GET["msjText"]?></div>
			<div class="divContentBlue">Cargos creados 
			  <div class="divContentWhite">
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
                  <tr>
				    <td align="center" width="20"><a href="javascript:obj.adds();" style="text-decoration:none;"}><img src="<?=$imageurl?>add.gif" width="20" height="20" border="0" /><br />
				      Crear</a></td>
				    <td width="50">ITEM</td>
 					<td>NOMBRE</td>
					<td>DESCRIPCION</td>
                                        <td>EMPRESA</td>
                                        <td>AREA</td>
                      <td align="center" width="50">A/I</td>
                    <td>ELIMINAR</td>
                  </tr>
				  	<?PHP
//                                        echo "CUNIVE: ".count($cunive)."<br/>";
					for($i=0;$i<count($cunive);$i++){
                                       
						$dato = (Object)$cunive[$i];   
						$datoAI = "A";
						if($dato->activo == 0){
							$datoAI = "I";
						}
                                               //$unidades=$uniOBJ->selecUnidadesActivas($conn);
						echo('<tr>'.
							 '<td align="center" >'.
								 '<img src="'.$imageurl.'edit.gif" width="20" height="20" onclick="obj.edit('.$dato->id.');" style="cursor:pointer;" /></td>'.
							 '<td>'.($i+1).'</td>'.
 							 '<td style="text-align:left" id="empresa:'.$dato->id.'"><a href="javascript:;" onclick="obj.edit('.$dato->id.');"  >'. ($dato->nombre).'</a></td>'.
							 '<td style="text-align:left" id="empresa:'.$dato->id.'"><a href="javascript:;" onclick="obj.edit('.$dato->id.');" >'. ($dato->descripcion).'</a></td>'.
							 '<td style="text-align:left" id="unidad:'.$dato->id.'"><a href="javascript:;" onclick="obj.edit('.$dato->id.');"  >'. ($dato->unidad).'</a></td>'.
							 '<td style="text-align:left" id="area:'.$dato->id.'"><a href="javascript:;"    onclick="obj.edit('.$dato->id.');"  >'. ($dato->area).'</a></td>'.
  							 '<td align="center" id="activo:'.$dato->id.'">'.$datoAI.'</td>'.
                              '<td align="center"><a href="javascript:;" rel="elimina_'.$dato->id.'"><img src="'.$imageurl.'bad.gif" alt=""></a></td>'.    
                                  			 '</tr>');
								
		
					}
					?>
                </table>
			  </div>
			</div>
		</td>
		</tr>
		<tr>
		<td height="5"></td>
		</tr>
		<tr>
		<td id="addUpdate">
			<div class="divContentBlue">Registrar cargos  
			  <div class="divContentWhite">
			   <?php echo CHtml::form(array("admin/estructura/AjaxCargos"), 'post', array('class'=>'formularioEstructura', 'id'=>'formForm')); ?>
 			  <input type="hidden" name="textAccion" id="textAccion" value="insert" />
			  <input type="hidden" name="textId" id="textId" value="" />
			  <table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
				  <td width="100">Nombre cargo:</td>
				  <td><input type="text" id="textNom" name="textNom" style="width:300px;" maxlength="100" /></td>
				</tr>
				
                                <tr>
				  <td>Empresa:</td>
				  <td>
                             	 	<select id="selectUnidad" name="selectUnidad">
									<option value="-1">Seleccione una empresa</option>
        					<?=$unis?>
					</select>
                                  </td>
				</tr>
                                <tr>
				  <td>Area o proceso:</td>
            			 <td>
                		 	<select id="selectArea" name="selectArea">
                				<option value="-1">Seleccione empresa</option>
					</select>
                        	 </td>

				</tr>
                               
                                <tr>
				  <td>Pais:</td>
				  <td><input type="text" id="textPai" name="textPai" style="width:400px;" maxlength="100" /></td>
				</tr>
 				<tr>
				  <td>Descripcion:</td>
				  <td><input type="hidden" value="NR" id="textEmp" name="textEmp" style="width:400px;" maxlength="100" /><input type="text" id="textDes" name="textDes" style="width:500px;" maxlength="300" /></td>
				</tr>
				 
<!--				<tr>
				  <td>Activo:</td>
				  <td>
				  	  <select name="selectActiva" id="selectActiva">
					  <option value="1">Activa</option>
					  <option value="0">Inactiva</option>
					  </select>
				  </td>
				</tr>-->
				
 
			  </table>
			  <input type="button" id="badd" value="Guardar" onclick="obj.add();" />
 			  <input type="button" id="bupd" value="Editar" onclick="obj.upd();" style="display:none;" />
			  <input type="hidden" name="hiddenCris" id="hiddenCris" value="" />
			  </form>
			   
			  </div>
			</div>    
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</div>