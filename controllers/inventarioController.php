<?php 
  
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/inventarioModel.php';
   class InventarioController{

   	  	public function getInventarioController(){
 			  
      $respuesta = InventarioModel::getInventarioModel('inventario');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

      public function getInventarioTropaController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $nroTropa =$request['nroTropa'];
         $respuesta = InventarioModel::getInventarioTropaModel($nroTropa, 'inventario');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }

             public function getInventarioIdController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $idInventario =$request['idInventario'];
         $respuesta = InventarioModel::getInventarioIdModel($idInventario, 'inventario');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }

          public function getInventarioTotalTropaController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $nroTropa =$request['nroTropa'];
         $respuesta = InventarioModel::getInventarioTotalModel($nroTropa, 'inventario');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }



   	  public function  AgregarInventarioController(){
             

              $data = file_get_contents("php://input");
		         $request = json_decode($data);
		         $request = (array) $request;
                
            
              $kiloMedia =$request['kiloMedia'];
              $nroTropa =$request['nroTropa'];
          $respuesta = InventarioModel::addInventarioModel($kiloMedia, $nroTropa,'inventario' );

          		 if ($respuesta == 'success') {
 			 	
 			 		echo json_encode($respuesta);
 			 
 			 }else{
 			 	echo json_encode("no hay ingreso Inventario");
 			 }

   	   }

         public function  editarInventarioController(){
             

              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $kiloMedia =$request['kiloMedia'];
              $nroTropa =$request['nroTropa'];
              $idInventario =$request['idInventario'];
          $respuesta = InventarioModel::editarInventarioModel($kiloMedia, $nroTropa,$idInventario, 'inventario' );

               if ($respuesta == 'success') {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode("no hay edicion de  Inventario");
       }

       }


        public function  editarProductosController(){
             
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
  
        public function deleteProductosController(){
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

      // public function getProductosControllerId(){
      //       $data = file_get_contents("php://input");
      //       $request = json_decode($data);
      //       $request = (array) $request;

      //       $idProductos =$request['idProductos'];
        
      //       $respuesta = AgregarProductosModel::getProductosModelId($idProductos , 'productos');

      //    if ($respuesta) {
          
      //       echo json_encode($respuesta);
         
      //    }

      //   }

       public function comprobarInventarioController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          // $nroTropaComprobar =4563200;
          $nroTropaComprobar =$request['nroTropaComprobar'];
      
           $respuesta = InventarioModel::comprobarInventarioModel($nroTropaComprobar, 'inventario' );

               if ($respuesta == 'success') {
                
                  echo json_encode(1);
               
               }else{
                echo json_encode(0);
               }
        }
  

   }

  
        if(isset($_GET['id'])){
      if ($_GET['id'] == "editarInvId") {
         $usuario = new InventarioController;
         $usuario->getInventarioIdController();
      }
   }
      if(isset($_GET['id'])){
      if ($_GET['id'] == "comprobar") {
         $usuario = new InventarioController;
         $usuario->comprobarInventarioController();
      }
   }
           if(isset($_GET['id'])){
      if ($_GET['id'] == "editarInventario") {
         $usuario = new InventarioController;
         $usuario->editarInventarioController();
      }
   }

     if(isset($_GET['id'])){
      if ($_GET['id'] == "addInventario") {
         $usuario = new InventarioController;
         $usuario->AgregarInventarioController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "getInv") {
         $usuario = new InventarioController;
         $usuario->getInventarioController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "getInvTropa") {
         $usuario = new InventarioController;
         $usuario->getInventarioTropaController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "getInvTropaKilos") {
         $usuario = new InventarioController;
         $usuario->getInventarioTotalTropaController();
      }
   }


      if(isset($_GET['id'])){
      if ($_GET['id'] == "deleteInv") {
        $delete = new InventarioController;
        $delete->deleteProductosController();  
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "editInv") {
        $delete = new InventarioController;
        $delete->editarProductosController();  
      }
   }