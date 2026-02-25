// JavaScript Document
$(document).ready(function(){
	//var aCampos = new Array('#nombre', '#apellidos', '#num_documento', '#celular', '#email', '#fecha_nac', '#ciudad', '#codigo', '#captcha', '#comoteenteraste');
	/**/
	$('#nombre').focus();
	
	/**/
	/*
	// validate signup form on keyup and submit
	$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});
	$("#registro").validate({
		rules: {
			nombre: "required",
			apellidos: "required",
			num_documento: {required: true, minlength: 6},
			email: {required: true,	email: true},
			celular:{required: true, minlength: 10},
			fecha_nac:{}
		},
		messages: {
			nombre: "Please enter your firstname",
			apellidos: "Please enter your lastname",
			email: "Please enter a valid email address"
		}
	});
	
	*/
	// Datepicker
		$('#datepicker').datepicker({
			minDate: '-90y',
			maxDate: '-5y',
			dateFormat: 'd MM yy',
			changeMonth: true,
			changeYear: true,
			yearRange:'-90:-5',
			showOtherMonths: true,
			selectOtherMonths: true,
			showButtonPanel: true
		});
});