<script type="text/javascript" src="/bateria/scripts/yav1_4_1/js/yav.js"></script>
<script type="text/javascript" src="/bateria/scripts/yav1_4_1/js/yav-config-es.js"></script>
 
<?php if($msg==""){ ?>
<script type="text/javascript">

 
var rules=new Array();
var rulesItem = 0;
rules[rulesItem]='textDoc|required|No puede dejar en blanco su numero de documento';rulesItem++;
rules[rulesItem]='textDoc|numeric|Solo escriba numeros, sin puntos, comas o espacios';rulesItem++;
rules[rulesItem]='textNom|required|No puede dejar en blanco su nombre';rulesItem++;
rules[rulesItem]='textNom|alphaspace|Solo utilize letras del abecedario y vocales con tilde';rulesItem++;
rules[rulesItem]='textApe|required|No puede dejar en blanco sus apelldos';rulesItem++;
rules[rulesItem]='textApe|alphaspace|Solo utilize letras del abecedario y vocales con tilde';rulesItem++;
rules[rulesItem]='textUsrEval|equal|1|Debe escribir un nombre de usuario valido';rulesItem++;
rules[rulesItem]='textMail|required|Escriba su correo electronico';rulesItem++;
rules[rulesItem]='textMail|email|Escriba su correo electronico en el siguiente formato: micorreo@ejemplo.com';rulesItem++;
rules[rulesItem]='textPais|required|Escriba el pais donde trabaja el usuario';rulesItem++;

 
obj = {
	data: null,
	evals: [],
	jefes: [],
	colas: [],
	findPosID:function(laID){
		var i; var pos = 0;
		for(i=0; i < this.data.length; i++){
			if(this.data[i].id == laID)return i;
		}
	},
	consultarUserName : function(){
		jQuery("#imgAccountGood").css("display","none");
		jQuery("#imgAccountBad").css("display","none");
		jQuery("#textUsrEval").val("-1");
		jQuery("#imgAccountLoad").css("display","");
		jQuery("#textUsr").value = jQuery("#textUsr").val().toLowerCase();
		var username = jQuery("#textUsr").val()+"";
		if(username.length == 0){
			jQuery("#imgAccountLoad").css("display","none");
			jQuery("#imgAccountBad").css("display","");
						alert("Debe escribir el nombre de usuario");
			jQuery("#textUsr").focus();
			return;
		}
		if(username.length < 8){
			jQuery("#imgAccountLoad").css("display","none");
			jQuery("#imgAccountBad").css("display","");
			alert("El nombre de usuario debe tener minimo 8 caracteres");
			jQuery("#textUsr").focus();
			return;
		}
		if(username.length > 100){
			jQuery("#imgAccountLoad").css("display","none");
			jQuery("#imgAccountBad").css("display","");
			alert("El nombre de usuario debe tener maximo 100 caracteres");
			jQuery("#textUsr").focus();
			return;
		}
		var permitidos = "abcdefghijklmnopqrstuvwxyz1234567890-_.";
		var i = 0;
		for(i=0;i<username.length;i++){
			if(permitidos.indexOf(username.charAt(i)) == -1){
				jQuery("#imgAccountLoad").css("display","none");
				jQuery("#imgAccountBad").css("display","");
				alert("Solo se permiten letras, numeros, punto, guion bajo y guion medio. No se permiten tildes, ñ, espacios.");
				jQuery("#textUsr").focus();
				return;
			}
		}
		var especiales = "-_.";
		if(especiales.indexOf(username.charAt(0)) != -1 || especiales.indexOf(username.charAt(username.length - 1)) != -1){
			jQuery("#imgAccountLoad").css("display","none");
			jQuery("#imgAccountBad").css("display","");
			alert("El nombre de usuario no puede empezar ni finalizar por (-_.)");
			jQuery("#textUsr").focus();
			return;
		}
		var aleatorio = Math.random()*1000000;
 		
		var url="/bateria/index.php/admin/usuarios/";
		var pars = {account:username,alea:aleatorio,option:6};
		var res = jQuery.ajax({ 
		type: "POST",
		dataType: "html",
		async: false,
		url: url,
		data:pars 
		}).responseText;
		
		jQuery("#imgAccountLoad").css("display","none");
		jQuery("#imgAccountGood").css("display","none");
		jQuery("#imgAccountBad").css("display","none");
		if(res=="OK"){
 			jQuery("#imgAccountGood").css("display","");
			jQuery("#textUsrEval").val("1");
 		}else{
		
			jQuery("#imgAccountBad").css("display","");
			alert("El nombre de usuario "+username+" ya existe en la base de datos. \n"+
				  "Le recomendamos usar las siguientes combinaciones:\n"+
				  "nombre.apellido o nombre_apellido o nombre-apellido\n"+
				  "nombre.apellido1970 o nombre_apellido1970 o nombre-apellido1970\n");
 		}			
		
 	},
	consultarJefe: function(){
		var nom = jQuery("#textFindJefe").val()+"";
		if(nom.length == 0){
			alert("Debe escribir un nombre para poder buscar a personas");
			return;
		}
 		
		var aleatorio = Math.random()*1000000;
 		
		var url="/bateria/index.php/admin/usuarios/";
		var pars = {account:nom,alea:aleatorio,option:7};
		var res = jQuery.ajax({ 
		type: "POST",
		dataType: "html",
		async: false,
		url: url,
		data:pars 
		}).responseText;
		
 		if(res){
 			 jQuery("#divListJefes").html(res);
 		} 		
 		
	},
	consultarCola : function(){
		var nom = jQuery("#textFindCola").val()+"";
		if(nom.length == 0){
			alert("Debe escribir un nombre para poder buscar a personas");
			return;
		}
 
		var aleatorio = Math.random()*1000000;
 		
		var url="/bateria/index.php/admin/usuarios/";
		var pars = {account:nom,alea:aleatorio,option:8};
		var res = jQuery.ajax({ 
		type: "POST",
		dataType: "html",
		async: false,
		url: url,
		data:pars 
		}).responseText;
		
 		if(res){
 			 jQuery("#divListColas").html(res);
 		} 			
 		
	},
	consultarEval : function(){
		var nom = jQuery("#textFindEval").val()+"";
		if(nom.length == 0){
			alert("Debe escribir un nombre para poder buscar a personas");
			return;
		}
 		
		var aleatorio = Math.random()*1000000;
 		
		var url="/bateria/index.php/admin/usuarios/";
		var pars = {account:nom,alea:aleatorio,option:9};
		var res = jQuery.ajax({ 
		type: "POST",
		dataType: "html",
		async: false,
		url: url,
		data:pars 
		}).responseText;
		
 		if(res){
 			 jQuery("#divListEval").html(res);
 		} 			
		
 	},
	setEval : function (id, name){
		var i; var pos = 0;
		if(this.existe(id)){
			return;
		}
		this.evals.push({"id":id,"name":name});
		this.pintarEvaluadodes();
		jQuery("#divListEval").html("");
	},
	setJefe : function (id, name){
		var i; var pos = 0;
		if(this.existe(id)){
			return;
		}
		var evalua = "0";
		if(confirm("El empleado que esta creando va a evaluar el jefe "+name+" que acaba de seleccionar")){
			evalua = "1";
		}
		this.jefes.push({"id":id,"name":name,"evalua":evalua});
		this.pintarJefes();
		jQuery("#divListJefes").html("");
	},
	setCola : function (id, name){
		var i; var pos = 0;
		if(this.existe(id)){
			return;
		}
		var evalua = "0";
		if(confirm("El colaborador "+name+" que acaba de seleccionar va evaluar al jefe que esta creando")){
			evalua = "1";
		}
		this.colas.push({"id":id,"name":name,"evalua":evalua});
		this.pintarColas();
		jQuery("#divListColas").html("");
	},
	pintarEvaluadodes : function(){
		var html = "";
		for(i=0; i < this.evals.length; i++){
			html += "<div>"+this.evals[i].name+" <img onclick='obj.remEval("+i+")' src='<?=$imageurl?>bad.gif' style='cursor:pointer;vertical-align:middle' /></div>";
		}
		if(this.evals.length == 0){
			html = "Agrege los pares que requiera";
		}
		jQuery("#divEvaluadores").html(html);
	},
	pintarJefes : function(){
		var html = "";
		for(i=0; i < this.jefes.length; i++){
			var evalua = "NO";
			if(this.jefes[i].evalua == 1){
				evalua = "SI";
			}
			html += "<div>"+this.jefes[i].name+" <img onclick='obj.remJefe("+i+")' src='<?=$imageurl?>bad.gif' style='cursor:pointer;vertical-align:middle' /> el colaborador que esta creando "+evalua+" evalua a este jefe</div>";
		}
		if(this.jefes.length == 0){
			html = "Agrege los jefes que requiera";
		}
		jQuery("#divJefes").html(html);
	},
	pintarColas : function(){
		var html = "";
		for(i=0; i < this.colas.length; i++){
			var evalua = "NO";
			if(this.colas[i].evalua == 1){
				evalua = "SI";
			}
			html += "<div>"+this.colas[i].name+" <img onclick='obj.remCola("+i+")' src='<?=$imageurl?>bad.gif' style='cursor:pointer;vertical-align:middle' /> este colaborador "+evalua+" evalua al jefe</div>";
		}
		if(this.colas.length == 0){
			html = "Agrege los colaboradores que requiera";
		}
		jQuery("#divColaboradores").html(html);
	},
	remEval :function (pos){
		this.evals.splice(pos,1);
		this.pintarEvaluadodes ();
	},
	remJefe:function (pos){
		this.jefes.splice(pos,1);
		this.pintarJefes ();
	},
	remCola:function (pos){
		this.colas.splice(pos,1);
		this.pintarColas();
	},
	existe: function(id){
		for(i=0; i < this.evals.length; i++){
			if(this.evals[i].id == id){
				alert("Esta persona ya fue agregada como par");
				return true;
			}
		}
		for(i=0; i < this.jefes.length; i++){
			if(this.jefes[i].id == id){
				alert("Esta persona ya fue agregada como jefe");
				return true;
			}
		}
		for(i=0; i < this.colas.length; i++){
			if(this.colas[i].id == id){
				alert("Esta persona ya fue agregada como colaborador");
				return true;
			}
		}
		return false;
	},
	reestablecerDivError : function(){
		var i = 0;
		for(i = 0; i < rules.length; i++){
			var partes = rules[i].split("|");
			document.getElementById('errorsDiv_'+partes[0]).innerHTML = "";
			document.getElementById('errorsDiv_'+partes[0]).className = "";
		}
	},
	printEvals : function(){
		var	valor = "-1:0";
		for(i=0; i < this.evals.length; i++){
			valor += ","+this.evals[i].id+":1";
		}
		jQuery("#textEvals").val(valor);
	},
	printJefes : function(){
		var	valor = "-1:0";
		for(i=0; i < this.jefes.length; i++){
			valor += ","+this.jefes[i].id+":"+this.jefes[i].evalua;
		}
		jQuery("#textJefes").val(valor);
	},
	printColas : function(){
		var	valor = "-1:0";
		for(i=0; i < this.colas.length; i++){
			valor += ","+this.colas[i].id+":"+this.colas[i].evalua;
		}
		jQuery("#textColas").val(valor);
	},
	enviarForm : function(){
		this.printEvals();
		this.printJefes();
		this.printColas();
		this.reestablecerDivError();
		var bool1 = performCheck('formCrear', rules, 'inline');
		console.log(bool1);
		if(bool1 == true){
			return true;
		}else{
			return false;
		}
	},
	evaluarForm :function (){
		if(this.enviarForm()){
			jQuery('#formCrear').submit();
		}
	}	
}


</script>

<style>
.ventanaBodyError {
color: #990000;
border: solid 1px #4F0000;
padding: 3px;
background-color: #FFF0E1;
}

.divGood {
background-color: #E2FFDF;
border: 1px solid #085500;
padding: 5px;
text-align: center;
}
</style>

<div id="content">
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
		<?php if($validaini=="OK"){ ?>

	<tr>
		<td>
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formActivo', 'id'=>'formActivo','style'=>'float: left')); ?>
				  <input type="hidden" id="option" name="option" value="1" />
				  <input type="button" value="Activos"  onclick="jQuery(this).parent().submit();"   />
			  </form>		
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formIncativo', 'id'=>'formIncativo','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="0" />
				  <input type="button" value="Invactivos"  onclick="jQuery(this).parent().submit();"    />
			  </form>		
			 <?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formTodos', 'id'=>'formTodos','style'=>'float: left')); ?>
				   <input type="hidden" id="option" name="option" value="2" />
				  <input type="button" value="Todos" onclick="jQuery(this).parent().submit();"  />
			  </form>		
 	
		</td>
	
	</tr>
		<?php } ?>
	<tr>
	<td style="padding:20px;border:1px solid #CCCCCC" align="left">
		<table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
		 
		<tr>
		<td>
			<div style="display:<?=$msjDisplay?>" class="<?=$msjClass?>"><?=$msjText?></div>
			<div class="divContentBlue">Crear usuario
			  <div class="divContentWhite">
				<?php echo CHtml::form(array("admin/usuarios/"), 'post', array('class'=>'formCrear', 'onsubmit'=>"return obj.enviarForm();", 'id'=>'formCrear','style'=>'margin:0px; padding:0px;')); ?>
			    
			    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tableData">
                  <tr valign="top">
				     <td width="15%">Nombres:</td>
					 <td width="85%">
					 	<input type="text" name="textNom" id="textNom" maxlength="40" style="width:150px">
						<div id="errorsDiv_textNom"></div>
					</td>
				  </tr>
				  <tr valign="top">
				     <td>Apellidos:</td>
					 <td>
					 	<input type="text" name="textApe" id="textApe" maxlength="40" style="width:150px">
						<div id="errorsDiv_textApe"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Nombre de usuario</td>
					 <td>
					 	Nombre de usuario que usara la persona para ingresar al sistema.<br />
						<input type="text" name="textUsr" id="textUsr" maxlength="100" style="width:100px" onblur="obj.consultarUserName();">
						<span id="imgAccountGood" style="display: none; "><img style="vertical-align: middle; width: 20px; height: 20px;" src="<?=$imageurl?>good.gif" /> disponible</span>
						<span id="imgAccountBad" style="display: none; "><img style="vertical-align: middle; width: 20px; height: 20px;" src="<?=$imageurl?>bad.gif" /> mal</span>
						<span id="imgAccountLoad" style="display: none; "><img style="vertical-align: middle; width: 20px; height: 20px;" src="<?=$imageurl?>ajax-loader.gif" /></span>
						<br />
						Solo se permiten letras, numeros, punto, guion bajo y guion medio. No se permiten tildes, ñ, espacios.
						<input type="hidden" name="textUsrEval" id="textUsrEval" value="-1">
						<div id="errorsDiv_textUsrEval"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>No Documento</td>
					 <td>
					 	<input type="text" name="textDoc" id="textDoc" maxlength="20" style="width:100px">
						<div id="errorsDiv_textDoc"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Email</td>
					 <td>
					 	<input type="text" name="textMail" id="textMail" maxlength="50" style="width:200px">
						<div id="errorsDiv_textMail"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Pais</td>
					 <td>
					 	<input type="text" name="textPais" id="textPais" maxlength="50" style="width:300px">
						<div id="errorsDiv_textPais"></div>
					 </td>
				  </tr>
				  <tr valign="top">
				     <td>Perfil</td>
					 <td>
					 	<select id="selectPerfil" name="selectPerfil">
						<?=$pers?>
						</select>
					 </td>
				  </tr>
				  
				  <tr valign="top">
				     <td>Area</td>
					 <td>
					 	<select id="selectArea" name="selectArea">
						<?=$ares?>
						</select>
					 </td>
				  </tr>
				  
				  <tr valign="top">
				     <td></td>
					 <td><input type="button" value="Crear usuario" onclick="return obj.evaluarForm();" /></td>
				  </tr>
                </table>
				<input type="hidden" name="textColas" id="textColas" value="-1:0" />
				<input type="hidden" name="textEvals" id="textEvals" value="-1:0" />
				<input type="hidden" name="textJefes" id="textJefes" value="-1:0" />
				<input type="hidden" name="textAccion" value="insert" />
				<input type="hidden" name="option" value="5" />
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
<?php }else{ ?>



<div id="content">
  	<div class="divContentBlue">
		<h2><b>Perfil de usuario</b></h2>
		
		 <div class="divContentWhite"><h3><b> <? echo $msg;?></b></h3></div>  			  
		
	</div>
</div>

 
<?php } ?>