<?php 
  
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/vendedorModel.php';
   class VendedoresController{

   	  	public function getVendedoresController(){
 			  
      $respuesta = VendedorModel::getVendedoresModel('vendedores');

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



   	  public function  agregarVendedorController(){
             

              $data = file_get_contents("php://input");
		         $request = json_decode($data);
		         $request = (array) $request;
                
            
              $nombreVendedor =$request['nombreVendedor'];
              $telefonoVendedor =$request['telefonoVendedor'];
          $respuesta = VendedorModel::addVendedorModel($nombreVendedor, $telefonoVendedor,'vendedores' );

          		 if ($respuesta == 'success') {
 			 	
 			 		echo json_encode($respuesta);
 			 
 			 }else{
 			 	echo json_encode("no hay ingreso Vendedor");
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
      if ($_GET['id'] == "addVendedor") {
         $usuario = new VendedoresController;
         $usuario->agregarVendedorController();
      }
   }

        if(isset($_GET['id'])){
      if ($_GET['id'] == "geVen") {
         $usuario = new VendedoresController;
         $usuario->getVendedoresController();
      }
   }
     