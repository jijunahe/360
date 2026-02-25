var Items=0;
var parent="";
$(document).ready(function(){	
	
	if(jQuery( ".fecha" ).size()>0){
		//Config Data
		jQuery.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '&#x3c;Ant',
			nextText: 'Sig&#x3e;',
			currentText: 'Hoy',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
			'Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
			dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
			weekHeader: 'Sm',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearRange: "1900",
			yearSuffix: ''
		};
		jQuery.datepicker.setDefaults($.datepicker.regional['es']);
		
		//Calendario
		jQuery( ".fecha" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/iconCalendar.png",
			buttonImageOnly: true
		});
	}
		
	$(window).bind("load", function() {		
		jQuery("#loader").fadeOut("slow");
		
		/*Bordes Redondos IE*/
		if (window.PIE) {			
			jQuery('.rounded15, .rounded3').each(function() {
				PIE.attach(this);
			});
		}		
		
		/*Validar formulario Login*/
		if(jQuery('#login').length>0){
			jQuery('#btnlogin').bind("click", function(){
				return validaLogin();
			})
		}	
		/*Fin Validar formulario Login*/	
		
		//variables de alto y width		
		menuLeft = $(".menuLeft").width();
		jQuery(window).resize(function(){
			myHeight = $(window).height();
			myWidth = $(window).width();
			jQuery('.seccion, .titleSeccion, .pagelist').width(myWidth-menuLeft-14);
			jQuery('.seccion .itemlist').width( jQuery('.seccion, .titleSeccion, .pagelist').width()-20 );
			myHeightSeccion = jQuery(".seccion").height();
			jQuery('.sombra1').height( myHeightSeccion );
		})
		.ready(function(){
			myHeight = $(window).height();
			myWidth = $(window).width();
			jQuery('.seccion, .titleSeccion, .pagelist').width(myWidth-menuLeft-14);
			jQuery('.seccion .itemlist').width( jQuery('.seccion, .titleSeccion, .pagelist').width()-20 );
			myHeightSeccion = jQuery(".seccion").height();
			jQuery('.sombra1').height( myHeightSeccion );
		});
		
		//Ajax para Autorizaciones IP
		jQuery('#managerIP').bind('click', function(){
			jQuery.ajax({
				url: 'ajax.php',
				type: 'POST',
				dataType: 'html',
				data: {
					tipo: "managerIp"
				},
				success: function (data){
					if(data=="Ok"){
						//location.href = url;
					}else{						
						jQuery.colorbox({ html:data+btnClose, width:660 });
					}
				}
			});
		});
		//Ajax para Autorizaciones IP
		
		if (typeof tinyMCE !== 'undefined') {
			tinyMCE.init({
				// General options
				mode : "textareas",
				theme : "advanced",
				plugins : /*"pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",*/
				"save,preview,template,autosave",
				
				// Theme options
				theme_advanced_buttons1 : "save,|,code,|,template,|,preview",
				/*theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
				*/
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,

				// Example content CSS (should be your site CSS)
				// using false to ensure that the default browser settings are used for best Accessibility
				// ACCESSIBILITY SETTINGS
				content_css : false,
				// Use browser preferred colors for dialogs.
				browser_preferred_colors : true,
				detect_highcontrast : true,

				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",

				// Style formats
				style_formats : [
					{title : 'Bold text', inline : 'b'},
					{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
					{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
					{title : 'Example 1', inline : 'span', classes : 'example1'},
					{title : 'Example 2', inline : 'span', classes : 'example2'},
					{title : 'Table styles'},
					{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
				],
				
				template_templates : [
					{
							title : "Formulario",
							src : "/Tienda/templates/dejanosTusDatos.html",
							description : "Adds Editors Name and Staff ID"
					}
				],

				// Replace values for the template plugin
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				}
			});

		}
		
	});
	
	
});
