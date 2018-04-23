<?php 
  
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/productosModel.php';
   class AgregarProductos{

   	  	static public function getProductosController(){
 			  
      $respuesta = AgregarProductosModel::getProductosModel('productos');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }



   	  static public function  AgregarProductosController(){
             

              $data = file_get_contents("php://input");
		      $request = json_decode($data);
		      $request = (array) $request;
                
              $dueHacienda =$request['dueHacienda'];
              $cantCabeza =$request['cantCabeza'];
              $cantMedia =$request['cantMedia'];
              $fechaFaena =$request['fechaFaena'];
              $cantKilos =$request['cantKilos'];
              $nroTropa =$request['nroTropa'];
          $respuesta = AgregarProductosModel::addProductosModel(
        $dueHacienda,
        $cantCabeza,
        $cantMedia,
        $fechaFaena,
        $cantKilos,
        $nroTropa,
 				 'productos' );

          		 if ($respuesta == 'success') {
 			 	
 			 		echo json_encode($respuesta);
 			 
 			 }else{
 			 	echo json_encode("no hay ingreso");
 			 }

   	   }


        static public function  editarProductosController(){
             
            $data = file_get_contents("php://input");
            $request = json_decode($data);
            $request = (array) $request;
                
              $dueHacienda =$request['dueHacienda'];
              $cantCabeza =$request['cantCabeza'];
              $cantMedia =$request['cantMedia'];
              $fechaFaena =$request['fechaFaena'];
              $cantKilos =$request['cantKilos'];
              $nroTropa =$request['nroTropa'];
              $idProductos =$request['idProductos'];
          $respuesta = AgregarProductosModel::editarProductosModel(
        $dueHacienda,
        $cantCabeza,
        $cantMedia,
        $fechaFaena,
        $cantKilos,
        $nroTropa,
        $idProductos,
         'productos' );

               if ($respuesta == 'success') {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode("no hay edición");
       }

       }
  
        static public function deleteProductosController(){
       	  $data = file_get_contents("php://input");
    		  $request = json_decode($data);
    		  $request = (array) $request;

    		  $idProductos =$request['idProductos'];
 			
 			     $respuesta = AgregarProductosModel::deleteProductosModel($idProductos, 'productos' );

         			 if ($respuesta == 'success') {
         			 	
         			 		echo json_encode($respuesta);
         			 
         			 }else{
         			 	echo json_encode($respuesta);
         			 }
        }

      static public function getProductosControllerId(){
            $data = file_get_contents("php://input");
            $request = json_decode($data);
            $request = (array) $request;

            $idProductos =$request['idProductos'];
        
            $respuesta = AgregarProductosModel::getProductosModelId($idProductos , 'productos');

         if ($respuesta) {
          
            echo json_encode($respuesta);
         
         }

        }
  

   }

     if(isset($_GET['id'])){
      if ($_GET['id'] == "editarProdId") {
         $usuario = new AgregarProductos;
         $usuario->getProductosControllerId();
      }
   }

     if(isset($_GET['id'])){
      if ($_GET['id'] == "add") {
         $usuario = new AgregarProductos;
         $usuario->AgregarProductosController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "getProd") {
         $usuario = new AgregarProductos;
         $usuario->getProductosController();
      }
   }


      if(isset($_GET['id'])){
      if ($_GET['id'] == "delete") {
        $delete = new AgregarProductos;
        $delete->deleteProductosController();  
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "edit") {
        $delete = new AgregarProductos;
        $delete->editarProductosController();  
      }
   }