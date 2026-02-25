<?php
	 //printVar(json_encode($organigrama, JSON_HEX_QUOT | JSON_HEX_TAG));exit;
	
?>
	
	

<style>
.datos{
	margin-left: 94px;
	margin-top: -150px;	
	text-align: left;
	position: absolute;
	border-radius: 10px;
	padding: 11px;
	border: 1px solid #EDEDFB;
	background-color: #D2E0F2;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;
	-moz-box-shadow: rgba(0, 0, 0, 0.5) 3px 3px 3px;	
	
}
</style>
<script>
	google.charts.load('current', {packages:["orgchart"]});
	google.charts.setOnLoadCallback(function(){
		//jQuery("#chart_div").show();
		//drawChart(jQuery(this).val());
		drawChart();
		event();
	});
  	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Name');
		data.addColumn('string', 'Manager');
		data.addColumn('string', 'ToolTip');

		// For each orgchart box, provide the name, manager, and tooltip to show.
		var orgam=   <?=json_encode($organigrama,JSON_HEX_QUOT | JSON_HEX_TAG)?>  ;
 		/*var orgam=[
					[{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},'', 'The President'],
					[{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},'Mike', 'VP'],
					['Alice', 'Mike', ''],
					['Bob', 'Jim', 'Bob Sponge'],
					['Carol', 'Bob', '']
				];	*/
		 console.log(orgam);

		data.addRows(orgam);

		// Create the chart.
		var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
		// Draw the chart, setting the allowHtml option to true for the tooltips.
		chart.draw(data, {allowHtml:true});
 	}
 
	function event(){
		jQuery(".google-visualization-orgchart-node").css({"border":"none"});
		
	}
</script>

<div id="content">
	<div class="divContentBlue"><b>Organigrama</b>
		<div class="divContentWhite"> 
 
			<center>
				<div id="chart_div"  ></div>
			</center>
			<div style="clear:both"></div>
 		</div>
	</div>
</div>