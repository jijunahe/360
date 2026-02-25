<style type="text/css"> 
#content-box{
	width:1200px;
}
#tableContent{
    border:1px solid #CCCCCC;
    border-collapse:collapse;
	font-size:11px;
}
#tableContent th {
    border:1px solid #CCCCCC;
    font-size:11px;
}

#tableContent td {
    border:1px solid #CCCCCC;
    font-size:11px;
}
</style>
<script>

function trimestreSelect(){
	
	jQuery("#trimestreS").change(function(){
		 trimestre(jQuery(this));	
		
	});
	
}

function trimestre(obj){
	
	jQuery.ajax({
	  method: "POST",
	  url: "<?=$rbase?>/index.php/admin/reportes/AjaxseguimientoObjetivos/",
	  data: { "trimestre": obj.val(),"periodo": jQuery("#periodo").val(), action: 2 }
	})
	  .done(function( data ) {
		jQuery("#resdiv").html(data);
 		trimestreSelect();
	});		
	
}

function periodo(obj){
	 
	jQuery.ajax({
	  method: "POST",
	  url: "<?=$rbase?>/index.php/admin/reportes/AjaxseguimientoObjetivos/",
	  data: { "periodo": obj.val(), action: 1 }
	})
	  .done(function( data ) {
		jQuery("#trimestreS").html(data);
		jQuery("#trimestre").show();
		trimestreSelect();
	});		
}
jQuery(function(){
	jQuery("#periodo").change(function(){
		 periodo(jQuery(this));	
		
	});
	
	
});
</script>
<div id="content" style="width:1200px;margin:0 auto">
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
            
            <tr>
                <td style="padding:20px;border:1px solid #CCCCCC" align="left">
                    <table width='100%' border='0' class='tbrepor1' cellpadding="2" cellspacing="0">
                        
                        <tr>
                            <td>
                                <div style="height:10px;">
                                </div>
                                <div style="height:10px;">
                                </div>
                                <table width='100%' border='0' cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="40%">
                                        </td>
                                    </tr>
									
									
                                    <form name="reporteObjetivosForm" action="reporteCreacionObjetivos.php" method="GET">
 									<tr>
										<td width="30%">
											<div class="divContentBlue">
											<div style="float:left">
												Periodo: <select name="periodo" id="periodo" style="border: 1px; border-style: solid; border-color:gray; font-size: 12px;">
												<option >Por favor seleccione un periodo.
												</option>
												<option value="<?=$periodo->id?>">
												<?=$periodo->nombre?>
												</option>
												<?
												foreach($periodo2 as $dato2) { 
													if($periodo->id!=$dato2->id){
													?>
													<option value="<?=$dato2->id?>">
														<?=$dato2->nombre?>
														</option>
												<?
													}
												}
												?>
												</select>
												</div>
												<div id="trimestre" style="display:none; float:left">
													Trimestre: <select name="trimestre" id="trimestreS" style="border: 1px; border-style: solid; border-color:gray; font-size: 12px;">
													<option >Por favor seleccione un trimestre.
													</option>
													 
													</select>
												</div>
											<div style="clear:both"></div>												
  											</div>
												<div class="divContentBlue" id="resdiv">
												</div>
											
											
										</td>
									</tr>
                                    </form>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
</div>
