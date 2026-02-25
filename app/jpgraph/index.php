<?php
	//=============================================================================
// File:	ODOEX04.PHP
// Description: Example 1 for odometer graphs
// Created:	2002-02-22
// Version:	$Id$
// 
// Comment:
// Example file for odometer graph. This examples extends odoex03
// by 1) changing the indicator needle style and color 2) Introducing
// a half circle in the middle that is not affetced by the indicator bands.
//
// Copyright (C) 2002 Johan Persson. All rights reserved.
//=============================================================================
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_odo.php');

//---------------------------------------------------------------------
// Create a new odometer graph (width=250, height=200 pixels)
//---------------------------------------------------------------------
$graph = new OdoGraph(320,200);

//---------------------------------------------------------------------
// Specify title and subtitle using default fonts
// * Note each title may be multilines by using a '\n' as a line
// divider.
//---------------------------------------------------------------------
$t=explode("Corporal",$_GET["titulo"]);
$aa=$_GET["titulo"];
$bb="";
if(isset($t[1])){
	
$aa=	$t[0]." Corporal";
$bb=$t[1];
}

$graph->title->Set($aa);
$graph->title->SetColor("black");
$graph->subtitle->Set($bb); 
$graph->subtitle->SetColor("black"); 


//---------------------------------------------------------------------
// Specify caption.
// * (This is the text at the bottom of the graph.) The margins will
// automatically adjust to fit the height of the text. A caption
// may have multiple lines by including a '\n' character in the 
// string.
//---------------------------------------------------------------------
$graph->caption->Set($_GET["puntaje"]);
$graph->caption->SetColor("black");

//---------------------------------------------------------------------
// Now we need to create an odometer to add to the graph.
// By default the scale will be 0 to 100
//---------------------------------------------------------------------
$odo = new Odometer(); 

//---------------------------------------------------------------------
// Set color indication 
//---------------------------------------------------------------------
$relojes=json_decode(base64_decode($_GET["relojes"]));
foreach($relojes as $color=>$valor){
	$odo->AddIndication($valor[0],$valor[1],$color);
}
 //$odo->AddIndication(80,100,"black"); 
 //---------------------------------------------------------------------
// Set the center area that will not be affected by the color bands
//---------------------------------------------------------------------
$odo->SetCenterAreaWidth(0.9);  // Fraction of radius 

//---------------------------------------------------------------------
// Adjust scale ticks to be shown at 10 steps interval and scale
// labels at every second tick
//---------------------------------------------------------------------
$p=explode(".",(String)$_GET["puntaje"]);
$a=$_GET["puntaje"];
$b=0;
if(isset($p[1])){
	$b=$p[1];
	$a=$p[0];
 }
//$odo->scale->SetTicks($a,$b);
$odo->scale->SetTicks(10,2);

//---------------------------------------------------------------------
// Use a bold font for tick labels
//---------------------------------------------------------------------
$odo->scale->label->SetFont(FF_FONT1, FS_BOLD);

//---------------------------------------------------------------------
// Set display value for the odometer
//---------------------------------------------------------------------
$odo->needle->Set($_GET["puntaje"]);

//---------------------------------------------------------------------
// Set a new style for the needle
//---------------------------------------------------------------------
$odo->needle->SetStyle(NEEDLE_STYLE_MEDIUM_TRIANGLE);
$odo->needle->SetLength(0.8);  // Length as 70% of the radius 
$odo->needle->SetFillColor("black");


//---------------------------------------------------------------------
// Add the odometer to the graph
//---------------------------------------------------------------------
$graph->Add($odo);

//---------------------------------------------------------------------
// ... and finally stroke and stream the image back to the browser
//---------------------------------------------------------------------
$graph->Stroke();

// EOF
?>