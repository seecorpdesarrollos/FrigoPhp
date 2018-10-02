<?php

     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/cuentasModel.php';
   class CuentasController{

    static public function getPagosController(){

			      $respuesta = CuentasModel::getPagosModel('pagos');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }



         	 static public function getCuentasController(){

			      $respuesta = CuentasModel::getCuentasModel('saldos');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }


  	 static public function getCuentasControllerId(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;


              $idCliente =$request['idCliente'];
              // $idCliente =1;

			      $respuesta = CuentasModel::getCuentasModelId($idCliente,'saldos');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }


     static public function getDetallesFacturaController(){

         $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;


              $idCliente =$request['idCliente'];
              $fechaInicial =$request['fechaInicial'];
              $fechaFinal =$request['fechaFinal'];
                if (empty($fechaInicial) && empty($fechaFinal)) {
                $fechaInicials ='2015-01-01';
                $fechaFinals ='2100-01-01';

                $respuesta = CuentasModel::getDetallesFacturaModel($idCliente,$fechaInicials, $fechaFinals ,  'detalles');

                    echo json_encode($respuesta);


              }else{

                $respuesta = CuentasModel::getDetallesFacturaModel($idCliente,$fechaInicial,
                    $fechaFinal ,  'detalles');

                    echo json_encode($respuesta);


              }


        }


     static public function gettotalKilosController(){

         $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;


              $idCliente =$request['idCliente'];
              $fechaInicial =$request['fechaInicial'];
              $fechaFinal =$request['fechaFinal'];
                if (empty($fechaInicial) && empty($fechaFinal)) {
                $fechaInicials ='2015-01-01';
                $fechaFinals ='2100-01-01';
                // $idCliente=1;
                $respuesta = CuentasModel::getTotalKilosModel($idCliente,$fechaInicials, $fechaFinals ,  'detalles');

                    echo json_encode($respuesta);


              }else{

                $respuesta = CuentasModel::getTotalKilosModel($idCliente,$fechaInicial,
                    $fechaFinal ,  'detalles');

                    echo json_encode($respuesta);


              }


        }




  	 static public function getEntradaControllerId(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;


              $idCliente =$request['idCliente'];
              // $idCliente =1;

			      $respuesta = CuentasModel::getEntradaModelId($idCliente,'cuentacorriente');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }



  	 static public function getSalidaControllerId(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;


              $idCliente =$request['idCliente'];
              // $idCliente =1;

			      $respuesta = CuentasModel::getSalidaModelId($idCliente,'cuentacorriente');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }

          	 static public function getTodoController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;


              $idCliente =$request['idCliente'];
              $fechaInicial =$request['fechaInicial'];
              $fechaFinal =$request['fechaFinal'];
              // $idCliente =1;
              if (empty($fechaInicial) && empty($fechaFinal)) {
	              $fechaInicials ='2015-01-01';
	              $fechaFinals ='2100-01-01';
	               $respuesta = CuentasModel::getTodoModelId($idCliente, $fechaInicials, $fechaFinals,
			      	'cuentacorriente');
              	echo json_encode($respuesta);
              }else{

			      $respuesta = CuentasModel::getTodoModelId($idCliente, $fechaInicial, $fechaFinal,
			      	'cuentacorriente');
              	echo json_encode($respuesta);


              }



        }

        static public function getSaldoAnteriorController(){

    $data = file_get_contents("php://input");
        $request = json_decode($data);
        $request = (array) $request;


         $idCliente =$request['idCliente'];
         $fechaInicial =$request['fechaInicial'];
         // $fechaInicial ='2018-07-20';
         //
         //  $idCliente =18;
         if (empty($fechaInicial)) {

           echo json_encode(0);
         }else{

       $respuesta = CuentasModel::getSaldoAnteriorModelId($idCliente, $fechaInicial,
         'cuentacorriente');
           echo json_encode($respuesta);


         }



   }




  	 static public function addCuentasController(){

  	 	   $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;

              $idCliente =$request['idCliente'];
              $comprobante =$request['comprobante'];
              $monto =$request['monto'];
              $efectivo =$request['efectivo'];
              $cheque =$request['cheque'];
              $nroCheque =$request['nroCheque'];
              $banco =$request['banco'];
              $propietario =$request['propietario'];
              $idVendedor =$request['idVendedor'];
              $fechaCobro =$request['fechaCobro'];
              // $idCliente =1;

			      $respuesta = CuentasModel::addCuentasModel(
			      	$idCliente,
			      	$comprobante,
			      	$monto,
			      	$efectivo,
			      	$cheque,
			      	$nroCheque,
			      	$banco,
			      	$propietario,
              $idVendedor,
              $fechaCobro,
			      	'pagos');

			       if ($respuesta) {

			          echo json_encode($respuesta);

			       }

        }





        // principal panel
        // ////////////////
        // ////////////////


        static public function getExistenciaController(){

            $data = file_get_contents("php://input");
                $request = json_decode($data);
                $request = (array) $request;


                 $nroTropa =$request['nroTropa'];
                  // $nroTropa =44586;

               $respuesta = CuentasModel::getExistenciaModel($nroTropa, 'inventario');

                if ($respuesta) {

                   echo json_encode($respuesta);

                }

           }



     static public function getInventarioTropaController(){

          $respuesta = CuentasModel::getInventarioTropaModel('inventario');

             if ($respuesta) {

                echo json_encode($respuesta);

             }
     }

       static public function getInventarioTropaDisponibleController(){

          $respuesta = CuentasModel::getInventarioTropaDisponibleModel('inventario');

             if ($respuesta) {

                echo json_encode($respuesta);

             }
     }


     static public function getInventarioTropaVendidoController(){

          $respuesta = CuentasModel::getInventarioTropaVendidoModel('inventario');

             if ($respuesta) {

                echo json_encode($respuesta);

             }
     }


       static public function getCantController(){

          $respuesta = CuentasModel::getCantModel('productos');

             if ($respuesta) {

                echo json_encode($respuesta);

             }
     }


}



    if(isset($_GET['id'])){
      if ($_GET['id'] == "getSaldos") {
        $delete = new CuentasController;
        $delete->getCuentasController();
      }
   }

   if(isset($_GET['id'])){
      if ($_GET['id'] == "getDetallesFac") {
        $delete = new CuentasController;
        $delete->getDetallesFacturaController();
      }
   }

 if(isset($_GET['id'])){
      if ($_GET['id'] == "totalKilos") {
        $delete = new CuentasController;
        $delete->gettotalKilosController();
      }
   }

   if(isset($_GET['id'])){
      if ($_GET['id'] == "totalEntradaId") {
        $delete = new CuentasController;
        $delete->getEntradaControllerId();
      }
   }


   if(isset($_GET['id'])){
      if ($_GET['id'] == "totalSalidaId") {
        $delete = new CuentasController;
        $delete->getSalidaControllerId();
      }
   }



    if(isset($_GET['id'])){
      if ($_GET['id'] == "todo") {
        $delete = new CuentasController;
        $delete->getTodoController();
      }
   }

   if(isset($_GET['id'])){
     if ($_GET['id'] == "saldoAnterior") {
       $delete = new CuentasController;
       $delete->getSaldoAnteriorController();
     }
  }


   if(isset($_GET['id'])){
      if ($_GET['id'] == "getPagos") {
        $delete = new CuentasController;
        $delete->getPagosController();
      }
   }

       if(isset($_GET['id'])){
      if ($_GET['id'] == "getSaldosId") {
        $delete = new CuentasController;
        $delete->getCuentasControllerId();
      }
   }

       if(isset($_GET['id'])){
      if ($_GET['id'] == "addPagos") {
        $delete = new CuentasController;
        $delete->addCuentasController();
      }
   }




   // panel principal
   //

    if(isset($_GET['id'])){
      if ($_GET['id'] == "getInventarioTropa") {
        $delete = new CuentasController;
        $delete->getInventarioTropaController();
      }
   }


    if(isset($_GET['id'])){
      if ($_GET['id'] == "getInventarioTropaDisponible") {
        $delete = new CuentasController;
        $delete->getInventarioTropaDisponibleController();
      }
   }

      if(isset($_GET['id'])){
      if ($_GET['id'] == "getInventarioTropaVendido") {
        $delete = new CuentasController;
        $delete->getInventarioTropaVendidoController();
      }
   }


      if(isset($_GET['id'])){
      if ($_GET['id'] == "getCant") {
        $delete = new CuentasController;
        $delete->getCantController();
      }
   }

   if(isset($_GET['id'])){
   if ($_GET['id'] == "getExistencia") {
     $delete = new CuentasController;
     $delete->getExistenciaController();
   }
}
