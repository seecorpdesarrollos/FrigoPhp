<?php 


 class EnlacesPaginas{

 	 public static function EnlacesPaginasModel($get){


 	   if ($get == 'ventas') {
 	   	  $module = "views/modules/ventas/" . $get . '.php';
 	   } else if ($get == 'reportesVentas'){
 	   	 $module = "views/modules/reportes/reportesVentas.php";
 	   }
 	   else{
 	   	$module = "views/modules/ventas/ventas.php";
 	   }

 	   return $module;
 	 }
 }