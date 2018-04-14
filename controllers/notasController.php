<?php 
  
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/notasModel.php';
   class CuentasController{
  
    public function getnotasCreditoController(){
			 			  
			      $respuesta = NotasModel::getNotasCreditoModel('notacredito');

			       if ($respuesta) {
			        
			          echo json_encode($respuesta);
			       
			       }

        }


        	 public function addNotasCreditoController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
               
              $descripcionCredito =$request['descripcionCredito'];
              $cantidadCredito =$request['cantidadCredito'];
              $importeCredito =$request['importeCredito'];
              $idCliente =$request['idCliente'];
            
			 			  
			      $respuesta = NotasModel::addNotasCreditoModel(
			      	$descripcionCredito,
			      	$cantidadCredito,
			      	$importeCredito,			     
			      	$idCliente,
			      	'notacredito');

			       if ($respuesta) {
			        
			          echo json_encode($respuesta);
			       
			       }

        }


     public function deleteNotasCreditoController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
               
              $idNotaCredito =$request['idNotaCredito'];
              $idCliente =$request['idCliente'];
              $totalCredito =$request['totalCredito'];

              //  $idNotaCredito =9;
              // $idCliente =2;
              // $totalCredito =1;
	  
			      $respuesta = NotasModel::deleteNotasCreditoModel(
			      	$idNotaCredito,
			      	$idCliente,
			      	$totalCredito,		     
			      	'notacredito');

			       if ($respuesta) {
			        
			          echo json_encode($respuesta);
			       
			       }

        }



}




    if(isset($_GET['id'])){
      if ($_GET['id'] == "getNotaCredito") {
        $delete = new CuentasController;
        $delete->getnotasCreditoController();  
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "addNotaCredito") {
        $delete = new CuentasController;
        $delete->addNotasCreditoController();  
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "deleteNotaCredito") {
        $delete = new CuentasController;
        $delete->deleteNotasCreditoController();  
      }
   }