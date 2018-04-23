<?php 
  
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/reportesModel.php';

   class ReportesController{

    
     static public function getMediasController(){
     	 $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $idCliente =$request['idCliente'];
               // $idCliente =1;
			 			  
			      $respuesta = ReportesModel::getMediasModel($idCliente, 'detalles');

			       if ($respuesta) {
			        
			          echo json_encode($respuesta);
			       
			       }
     }


      static public function getMediasFechaController(){
     	 $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $fecha1 =$request['fecha1'];
              $fecha2 =$request['fecha2'];
               // $fecha2 =1;
			 			  
			      $respuesta = ReportesModel::getMediasFechaModel($fecha1,$fecha2,  'detalles');

			       if ($respuesta) {
			        
			          echo json_encode($respuesta);
			       
			       }
     }

       static public function getTropaController(){
       $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $nroTropa =$request['nroTropa'];
         
                // $nroTropa =45605;
              
            $respuesta = ReportesModel::getTropaModel($nroTropa,'detalles');

             if ($respuesta) {
              
                echo json_encode($respuesta);
             
             }
     }



   }


    if(isset($_GET['id'])){
      if ($_GET['id'] == "mediasVendidas") {
        $delete = new ReportesController;
        $delete->getMediasController();  
      }
   }


    if(isset($_GET['id'])){
      if ($_GET['id'] == "getTropa") {
        $delete = new ReportesController;
        $delete->getTropaController();  
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "mediasVendidasFecha") {
        $delete = new ReportesController;
        $delete->getMediasFechaController();  
      }
   }
