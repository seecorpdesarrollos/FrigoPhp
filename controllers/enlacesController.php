<?php 
 class EnlacesControllers{


 	  public function plantilla(){

 	  	 include 'views/template.php';
 	  }

 	  public function enlacesPaginasController(){
 	  	if (isset($_GET['action'])) {
 	  	$enlaces = $_GET['action'];
 	  	}else{
 	  		$enlaces = 'index';
 	  	}

 	  	 $repuesta = enlacesPaginas::enlacesPaginasModel($enlaces);
 	  	 require $repuesta;
 	  }
 }