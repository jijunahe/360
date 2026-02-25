var headDocument = document.getElementsByTagName('head').item(0)
var btnClose = '<a href="#" class="" style="position:absolute; top:0; right:0; margin:0 0 0 20px;" onClick="jQuery.colorbox.close();"><img src="images/close.png" border="0"/></a>';

//Funcion para agregar archivos .js en cabecera del documento
function setScript(fileSearch, newFile, fileId){
    for(var i=0,scs; scs=document.getElementsByTagName('script')[i];i++){ 
        if(scs.src.indexOf(fileSearch)>-1){
            return true;
		}
    }
	
	script = document.createElement('script');
	script.src = newFile;
	script.type = 'text/javascript';
	script.id = fileId;
	headDocument.appendChild(script);
}

function trim(cadena){
    var nuevacadena="";
    nuevacadena=cadena.replace(/\ /g,"");
    return nuevacadena.length;
}

function validaCorreo(valor){
	if (/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(valor)){
        return true;
    } else {
        return false;
    }
}

function validaFloat(numero){
    if (!/^([0-9])*[.]?[0-9]*$/.test(numero)) return false;
    else return true;
}

function validarEntero(valor){ 
    valor = parseInt(valor);
    if(isNaN(valor)) return false;
    else return true;
}

function confirmAction(msn, url){
    var agree=confirm(msn);
    if (agree){		
        makeRedirect(url);
        return true ;
    }else{
        return false ;
    }
}

function makeRedirect(url){
    location.href = url;
}

//Funcion que abre el popup de terminos
function abrePopup( div ){		
    jQuery('#' + div).fadeIn('slow');
}

//Funcion que muestra el popup de error
function errorMessage( message ){
    jQuery('#popupError').fadeIn('slow');
    jQuery('.errorMessage').html( message );
}

function cierraPopup( div ){
    jQuery('#'+div).fadeOut(); 
}
//

//Reemplar texto
function replaceContent( div, message ){
    jQuery('#' + div).html( message );
}

//Este Codigo permite Validar que ingresen solo numeros
function ValidateNum(variable){
    Numer = parseInt(variable);
    if (isNaN(Numer)){
        return "";
    }
    return Numer;
}
function ValNumero(Control){
	Control.value=ValidateNum(Control.value);
}

//Funcion para envio de login
function validaLogin(){
    usuario = jQuery('#usuario');
    password = jQuery('#password');
    error = "";
	
    if(trim(usuario.val())==0){
        error += 'El campo usuario se encuentra vacio.<br>';
    }
	
    if(trim(password.val())==0){
        error += 'El campo password se encuentra vacio.';
    }
	
    if(error!=''){
        replaceContent( 'errorField', error );
        return false;
    }else{
        jQuery.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'html',
            data: {
                tipo: "login", 
                usuario: usuario.attr('value'), 
                password: password.attr('value')
                },
            success: function (data){
                if(data=='1'){
                    location.reload();
                }else{
                    //replaceContent( 'errorField', data );	
                    replaceContent( 'errorField', "El usuario o contraseña son incorrectos." );
                }
            }
        });
        return false;
    }	
}

//Funcion para validar Form Editar Administrador
function validaFormEditaAdmin( url ){	
    type = jQuery('#type').val();
    itemId = jQuery('#itemId').val();    
    nombre = jQuery('#nombre').val();
    user = jQuery('#user').val();
	email = jQuery('#email').val();
	perfil = jQuery('#perfil').val();	
	if(jQuery('#oldpass').length==0){
		oldpass = "null";
	}else{
		oldpass = jQuery('#oldpass').val();
	}
    newpass = jQuery('#newpass').val();
	
    error = "";
	
    if(nombre==''){
        error += "* El campo Nombre es obligatorio.<br>";
    }	
    if(user==''){
        error += "* El campo Usuario es obligatorio.<br>";
    }
    if(email==''){
        error += "* El campo Email es obligatorio.<br>";
    }
    if(validaCorreo(email)==false){
        error += "* El campo Email no es correcto.<br>"; 
    }
	if(perfil==0){
        error += "* El campo Perfil es obligatorio.<br>";
    }
    if(oldpass==''){
        error += "* El campo Antigua Clave es obligatorio.<br>";
    }
	if(newpass==''){
        error += "* El campo Nueva Clave es obligatorio.<br>";
    }
	
    if(error!=''){
		replaceContent( 'errorField div', error );	
        jQuery.colorbox({ html:jQuery('#errorField').html()+btnClose });
        return false;
    }else{
		//return false;
        jQuery.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'html',
            data: {
                tipo: "userAdmin", 
                type: type, 
                itemId: itemId,
                nombre: nombre,
				login: user,
				email: email,
				perfil: perfil,
				oldPass: oldpass,
				newPass: newpass
            },
            success: function (data){
                if(data=="Ok"){
                    location.href = url;
                }else{
                    //replaceContent( 'errorField', data );	
                    replaceContent( 'errorField div', data );
					jQuery.colorbox({ html:jQuery('#errorField').html()+btnClose, width:520, height:300 });
                }
            }
        });
        return false;
    }
			
}

//Validar Save IP
function validateSaveIp(){
	ip = jQuery('#ip').val();
	resumen = jQuery('#resumen').val();
	
	error = "";
	
    if(ip==''){
        error += "* El campo Ip es obligatorio.\n";
    }	
    if(resumen==''){
        error += "* El campo Resumen es obligatorio.\n";
    }
	
	if(error!=''){	
		alert(error);        
        return false;
    }else{
		jQuery.ajax({
			url: 'ajax.php',
			type: 'POST',
			dataType: 'html',
			data: {
				tipo: "managerIp",
				method: "add",
				ip: ip,
				resumen: resumen
			},
			success: function (data){
				if(data=="Ok"){
					location.reload();
				}else{
					alert('Ocurrio un error, intentelo mas tarde.');
				}
			}
		});
	}
}

//Eliminar Item
function deleteItem( msn, seccion, id ){
	var agree=confirm(msn);
    if (agree){		
        jQuery.ajax({
			url: 'ajax.php',
			type: 'POST',
			dataType: 'html',
			data: {
				tipo: seccion,
				itemId: id,
				method: "delete"
			},
			success: function (data){
				if(data=="Ok"){
					location.reload();
				}else{
					alert('Ocurrio un error, intentelo mas tarde.');
				}
			}
		});

        return true ;
    }else{
        return false ;
    }
}

//Guardar nuevo contenido
function saveContentList( itemId ){
	jQuery.ajax({
		type:'post', 
		url:'ajax.php',
		data : jQuery("#myFormList_"+itemId).serialize(),
		success : function(data){
			if(data == 'Ok'){				
				location.reload();
			}else{
				replaceContent( 'errorField div', 'Ocurrio un error al enviar tus datos, por favor int&eacute;ntalo de nuevo' );
				jQuery.colorbox({ html:jQuery('#errorField').html()+btnClose });
			}
		}
	});
	return false;
}