<?php

     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/notasModel.php';
   class CuentasController{

    static public function getnotasCreditoController(){

			      $respuesta = NotasModel::getNotasCreditoModel('notacredito');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }


        	 static public function addNotasCreditoController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;

              $descripcionCredito =$request['descripcionCredito'];
              $cantidadCredito =$request['cantidadCredito'];
              $importeCredito =$request['importeCredito'];
              $idCliente =$request['idCliente'];
              $fechaCredito =$request['fechaCredito'];


			      $respuesta = NotasModel::addNotasCreditoModel(
			      	$descripcionCredito,
			      	$cantidadCredito,
			      	$importeCredito,
			      	$idCliente,
              $fechaCredito,
			      	'notacredito');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }


     static public function deleteNotasCreditoController(){

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
        // ==================================================================0
        // notas de debito
        // =====================================================================

          static public function getnotasDebitoController(){

			      $respuesta = NotasModel::getNotasDebitoModel('notadebito');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }



     	 static public function addNotasDebitoController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;

              $descripcionDebito =$request['descripcionDebito'];
              $cantidadDebito =$request['cantidadDebito'];
              $importeDebito =$request['importeDebito'];
              $nroCheque =$request['nroCheque'];
              $idCliente =$request['idCliente'];
              $fechaDebito =$request['fechaDebito'];


			      $respuesta = NotasModel::addNotasDebitoModel(
			      	$descripcionDebito,
			      	$cantidadDebito,
			      	$importeDebito,
			      	$nroCheque,
			      	$idCliente,
              $fechaDebito,
			      	'notadebito');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }



     	 static public function addNotasDebitoSinChequeController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;

              $descripcionDebito =$request['descripcionDebito'];
              $cantidadDebito =$request['cantidadDebito'];
              $importeDebito =$request['importeDebito'];
              $idCliente =$request['idCliente'];
              $fechaDebito =$request['fechaDebito'];


			      $respuesta = NotasModel::addNotasDebitoSinChequeModel(
			      	$descripcionDebito,
			      	$cantidadDebito,
			      	$importeDebito,
			      	$idCliente,
              $fechaDebito ,
			      	'notadebito');

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


   // notas de debitos
   //
   //
      if(isset($_GET['id'])){
      if ($_GET['id'] == "addNotaDebito") {
        $delete = new CuentasController;
        $delete->addNotasDebitoController();
      }
   }


     if(isset($_GET['id'])){
      if ($_GET['id'] == "addNotaDebitoSinCheque") {
        $delete = new CuentasController;
        $delete->addNotasDebitoSinChequeController();
      }
   }

      if(isset($_GET['id'])){
      if ($_GET['id'] == "getNotaDebito") {
        $delete = new CuentasController;
        $delete->getnotasDebitoController();
      }
   }
