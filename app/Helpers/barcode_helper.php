<?php
function barcode($valor){
	include_once 'php-barcode-generator-0.4.0/src/BarcodeGenerator.php';
	// include_once 'php-barcode-generator-0.4.0/src/BarcodeGeneratorHTML.php';
	include_once 'php-barcode-generator-0.4.0/src/BarcodeGeneratorPNG.php';
	//include_once 'php-barcode-generator-0.4.0/src/BarcodeGeneratorSVG.php';

	// $generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML;
	$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG;
	
	// return '<canvas id="myCanvas" width="200" height="100" style="border:1px solid #d3d3d3;">Your browser does not support the HTML5 canvas tag.</canvas>';
	return '<img id="img_'.$valor.'" src="data:image/png;base64,'.base64_encode($generatorPNG->getBarcode($valor, $generatorPNG::TYPE_CODE_128)).'">';
}
?>
