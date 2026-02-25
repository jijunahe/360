jQuery(function(){
	/*BASE DE SELECCION LOGO*/
 	NewItems();
	NewItems("agregar");
 	Guardar();

});



/*FUNCIONES PARA LOGOS*/
function Guardar(){
    jQuery("#guardar").click(function(){
		var type = jQuery('#type').val();
		var count=jQuery("#LOGOS > div.Items").size();
		

		var errorNombre = "";
		var errorLogo = "";
		var genericError="";
 
		
		
		for(i=0;i<count-1;i++){
		
			if(jQuery("#LOGOS div.Items:eq("+(i)+") .logo").val()=="" && jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").val()==""){
				if(jQuery("#LOGOS div.Items:eq("+(i)+") .logo").val()==""){
					errorNombre = "* Debes seleccionar una imagen, por favor revisa los elementos de color ROJO.<br>";
					jQuery("#LOGOS div.Items:eq("+(i)+") .logo").css({"border":"solid red"})
				}
				
				if(jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").val()==""){
					errorLogo= "* Por favor, ingresa el nombre del logo, por favor revisa los elementos de color VERDE.<br>";
					jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").css({"border":"solid green"})
				}
			}
			
			if(jQuery("#LOGOS div.Items:eq("+(i)+") .logo").val()=="" && jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").val()!="")
			{
					errorNombre = "* Debes seleccionar una imagen, por favor revisa los elementos de color ROJO.<br>";
					jQuery("#LOGOS div.Items:eq("+(i)+") .logo").css({"border":"solid red"})
			}
			
			if(jQuery("#LOGOS div.Items:eq("+(i)+") .logo").val()!="" && jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").val()=="")
			{
					errorLogo= "* Por favor, ingresa el nombre del logo, por favor revisa los elementos de color VERDE.<br>";
					jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").css({"border":"solid green"})
			}
			if(jQuery("#LOGOS div.Items:eq("+(i)+") .logo").val()!="" && jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").val()!="")
			{       jQuery("#LOGOS div.Items:eq("+(i)+") .logo").removeAttr("style");
 					jQuery("#LOGOS div.Items:eq("+(i)+") .nombre").removeAttr("style");
			}
			
			
		}
		
		if(jQuery("#LOGOS div.Items:eq("+(count-1)+") .logo").val()!="" && jQuery("#LOGOS div.Items:eq("+(count-1)+") .nombre").val()=="" && count>1)
		{
			errorLogo= "* Por favor, ingresa el nombre del logo, por favor revisa los elementos de color VERDE.<br>";
				jQuery("#LOGOS div.Items:eq("+(count-1)+") .nombre").css({"border":"solid green"})
		}
		if(jQuery("#LOGOS div.Items:eq("+(count-1)+") .logo").val()=="" && jQuery("#LOGOS div.Items:eq("+(count-1)+") .nombre").val()!="" && count>1)
		{
				errorNombre = "* Debes seleccionar una imagen, por favor revisa los elementos de color ROJO.<br>";
				jQuery("#LOGOS div.Items:eq("+(count-1)+") .logo").css({"border":"solid red"})
		}
		if(jQuery("#LOGOS div.Items:eq("+(count-1)+") .logo").val()!="" && jQuery("#LOGOS div.Items:eq("+(count-1)+") .nombre").val()!="" && count>1)
		{       jQuery("#LOGOS div.Items:eq("+(count-1)+") .logo").removeAttr("style");
				jQuery("#LOGOS div.Items:eq("+(count-1)+") .nombre").removeAttr("style");
		}
		
		genericError=errorNombre+errorLogo;
		
		
		
		if(genericError!=''){
			replaceContent( 'errorField div', genericError );	
			jQuery.colorbox({ html:jQuery('#errorField').html()+btnClose });
			return false;
		}else{
			//return false;
			 var nombre=   "...";
			 var nivel=   "...";
			 var imagen=   "...";
			 for(i=0;i<count;i++){
				nombre+=   jQuery("div.Items:eq("+i+")").find(".nombre").val()+"...";
				nivel+=   jQuery("div.Items:eq("+i+")").find(".nivel").val()+"...";
				imagen+=   jQuery("div.Items:eq("+i+") .images").find("img").attr("src")+"...";
			}
			var ItemId="";
			if(jQuery(".Items:eq(0)").find(".itemID").size()==1){
			  ItemId=jQuery(".Items:eq(0)").find(".itemID").val();
			}
			jQuery.ajax({
				url: 'ajax.php?'+jQuery("#editaLogos").serialize(),
				type: 'POST',
				dataType: 'html',
				data: {
					tipo: "logos", 
					type: 'subirdatos',
					nombre:nombre,
					nivel:nivel,
					imagen:imagen,
					update:jQuery(".Items:eq(0)").find(".update").val(),
					id:ItemId
				},
				success: function (data){
					if(data=="Ok"){
					
					}
				}
			  });
 			return false;
		}	
	  
	}); 
   
} 
function Redimencion(){
$win = $(window);

		scroll(0,jQuery(".seccion").height()+arguments[0]);
			 
		$win.scroll(function () { 
 				myHeight = $(window).height();
				myWidth = $(window).width();
				jQuery('.seccion, .titleSeccion, .pagelist').width(myWidth-menuLeft-14);
				jQuery('.seccion .itemlist').width( jQuery('.seccion, .titleSeccion, .pagelist').width()-20 );
				myHeightSeccion = jQuery(".seccion").height();
				jQuery('.sombra1').height( myHeightSeccion );
		});	

}
function NewItems(){
	var $win = $(window);
	if(arguments[0]=="agregar" && jQuery("#LOGOS.Items:eq(0)").find(".update").val()==0){
	    jQuery("#AgregarItem").click(function(){
			var NewObj=jQuery("#item_1").clone();
			var count=jQuery("#LOGOS > div.Items").size();
			//var ContentNewItem="<div></div>";
		   
			NewObj.attr("id","item_"+(count+1));
			jQuery("#LOGOS").append(NewObj);
			
			jQuery("#item_"+(count+1)+" #nombre_1").attr("name","nombre_"+(count+1));
			jQuery("#item_"+(count+1)+" #nombre_1").attr("id","nombre_"+(count+1)).removeAttr("style").val("");
			  
			jQuery("#item_"+(count+1)+" #nivel_1").attr("name","nivel_"+(count+1));
			jQuery("#item_"+(count+1)+" #nivel_1").attr("id","nivel_"+(count+1)).removeAttr("style");
			  
			jQuery("#item_"+(count+1)+" #imglogo_1").attr("name","imglogo_"+(count+1));
			jQuery("#item_"+(count+1)+" #imglogo_1").attr("id","imglogo_"+(count+1)).removeAttr("style");
			
			jQuery("#item_"+(count+1)+" .count").val(count+1);
			jQuery("#item_"+(count+1)+" .images").html(""); 
 			  
			jQuery("#item_"+(count+1)).append("<div class='left remover'  rel='"+(count+1)+"'>remover</div>");
			jQuery(".remover").click(function(){
				var Item=jQuery(this).attr('rel');
				jQuery("#item_"+Item).remove();
				Redimencion(-400);
				Items=jQuery("#LOGOS > div.Items").size();
				NewItems();
			})
		  Items=count;
		  Redimencion(400);	
		  NewItems();	
		});
	
	}else {
			jQuery("#LOGOS div.Items:eq("+Items+") input[type='file']").change(function(){
				if(jQuery(".Items:eq(0)").find(".update").val()==0){

					//console.log(Items)
					if(jQuery(this).parent().find(".count").val()==(Items+1) || (Items+1)==1){
							var NewObj=jQuery("#item_1").clone();
							var count=jQuery("#LOGOS > div.Items").size();
							//var ContentNewItem="<div></div>";
						   
							NewObj.attr("id","item_"+(count+1));
							jQuery("#LOGOS").append(NewObj);
							
							jQuery("#item_"+(count+1)+" #nombre_1").attr("name","nombre_"+(count+1));
							jQuery("#item_"+(count+1)+" #nombre_1").attr("id","nombre_"+(count+1)).removeAttr("style").val("");
							  
							jQuery("#item_"+(count+1)+" #nivel_1").attr("name","nivel_"+(count+1));
							jQuery("#item_"+(count+1)+" #nivel_1").attr("id","nivel_"+(count+1)).removeAttr("style");
							  
							jQuery("#item_"+(count+1)+" #imglogo_1").attr("name","imglogo_"+(count+1));
							jQuery("#item_"+(count+1)+" #imglogo_1").attr("id","imglogo_"+(count+1)).removeAttr("style");
							  
							jQuery("#item_"+(count+1)+" .count").val(count+1);
							 
							jQuery("#item_"+(count+1)+" .images").html("");
							 
							jQuery("#item_"+(count+1)).append("<div class='left remover'  rel='"+(count+1)+"'>remover</div>");
							jQuery(".remover").click(function(){
								var Item=jQuery(this).attr('rel');
								jQuery("#item_"+Item).remove();
								Redimencion(-400);
								Items=jQuery("#LOGOS > div.Items").size();
								NewItems();
							})
						  Items=count;
						  Redimencion(400);	
						  NewItems();
					}
				  
				}
				 jQuery(this).parent().submit();
				 var actual= jQuery("#LOGOS div.Items:eq("+Items+")").find(".count").val();
				 parent=jQuery(this).parent().parent();
				 setTimeout(getThisimg,1000);
		 
			});	
	} 
}
function getThisimg(){
	var key=parent;
	//console.log(key)
			jQuery.ajax({
				url: 'upload.php',
				type: 'POST',
				dataType: 'html',
				data: {
					tipo: "getImg"
				},
				success: function (data){
						key.find(".images").hide();
						key.find(".images").html("<img style='width: 118;' src='../images/temp/"+data+"' />");
						key.find(".images").show("slow");
				}
			});
}