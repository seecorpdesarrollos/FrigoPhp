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

                public function getFacturaController(){
        
      $respuesta = InventarioModel::getFacturasModel('facturas');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

     public function getFacturasController(){
        
      $respuesta = InventarioModel::getDetallesModel('facturado');
      $data = date('Y-m-d');
      // echo $data;

       if ($respuesta) {
        
          echo json_encode($respuesta );
       
       }

        }

                public function getTotalTempController(){
        
      $respuesta = InventarioModel::getTotalTempModel('temp');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

                   public function getTotalTemp1Controller(){
        
      $respuesta = InventarioModel::getTotalTemp1Model('tempmedia');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

                public function getTemporalController(){
        
      $respuesta = InventarioModel::getTemporalModel('temp');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }


                public function getTemporal1Controller(){
        
      $respuesta = InventarioModel::getTemporal1Model('tempmedia');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

                public function getCuarteoController(){
        
      $respuesta = InventarioModel::getCuarteoModel('cuarteo');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

       public function getCuarteoInventarioController(){
        
      $respuesta = InventarioModel::getCuarteoInventarioModel('cuarteoinventario');
          
       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }


                public function getInventariototalController(){
        
      $respuesta = InventarioModel::getInventariototalesModel('inventario');

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


    
      public function getDetallesController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $nroFactura =$request['nroFactura'];
         $respuesta = InventarioModel::getDetallesFacturasModel($nroFactura, 'detalles');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }


              public function masInfoCuarteoController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $idCuarteoInventario =$request['idCuarteoInventario'];
              // $idCuarteoInventario =1;
         $respuesta = InventarioModel::masInfoCuarteoModel($idCuarteoInventario, 'cuarteoinventario');

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
 			 	echo json_encode($respuesta);
 			 }

   	   }


              public function  temporalController(){
             

              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
            
            
              $pesoCuarto =$request['pesoCuarto'];
              $descripcion =$request['descripcion'];
              $precio =$request['precio'];
              $facturaNro =1;
              $idCuarto =$request['idCuarto'];
          $respuesta = InventarioModel::temporalModel($pesoCuarto,$descripcion,$precio,
           $facturaNro, $idCuarto,'temp' );

               if ($respuesta == 'success') {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode("no hay ingreso Inventario");
       }

       }


             public function  temporal1Controller(){
             

              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
            
            
              $medias =$request['medias'];
              $precio =$request['precio'];
              $idInventario =$request['idInventario'];
              $facturaNro =1;
          $respuesta = InventarioModel::temporal1Model($medias,$precio,
           $facturaNro, $idInventario,'tempmedia' );

               if ($respuesta == 'success') {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode("no hay ingreso carrito");
       }

       }
     

        public function  addCuarteoController(){
             

              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $kiloMedia =$request['kiloMedia'];
              $nroTropa =$request['nroTropa'];
              $idInventario =$request['idInventario'];
          $respuesta = InventarioModel::addCuarteoModel($kiloMedia, $nroTropa, $idInventario , 'cuarteo' );

               if ($respuesta == 'success') {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode("no hay ingreso Inventario");
       }

       }


               public function  addInventarioCuarteoController(){
             

              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $pecho =$request['pecho'];
              $mocho =$request['mocho'];
              $parrillero =$request['parrillero'];
              $completos =$request['completos'];
              $largos =$request['largos'];
              $bifes =$request['bifes'];
              $asado =$request['asado'];
              $totalPeso =$request['totalPeso'];
              $idCuarteo =$request['idCuarteo'];
          $respuesta = InventarioModel::addInventarioCuarteoModel(
                                                       $pecho, 
                                                       $mocho, 
                                                       $parrillero ,
                                                       $completos ,
                                                       $largos ,
                                                       $bifes ,
                                                       $asado ,
                                                       $totalPeso,
                                                       $idCuarteo ,
                                                        'cuarteoinventario' );

               if ($respuesta ) {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode($respuesta);
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

                public function deleteCuarteoController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          $idInventario =$request['idInventario'];
      
           $respuesta = InventarioModel::deleteCuarteoModel($idInventario, 'cuarteo' );

               if ($respuesta == 'success') {
                
                  echo json_encode($respuesta);
               
               }else{
                echo json_encode($respuesta);
               }
        }

         public function ventasController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          $idCliente =$request['idCliente'];
          $nroFactura =$request['nroFactura'];
          $total =$request['total'];
          $idAdmin =$request['idAdmin'];
         if(isset($idCliente)){

           $respuesta = InventarioModel::ventasModel($idCliente,  $nroFactura, $total, $idAdmin);

               if ($respuesta == 'success') {
                
                  echo json_encode($respuesta);
               
               }else{
                echo json_encode($respuesta);
               }
         }
         
        }



       public function deleteCuarteoIdController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          $idCuarteo =$request['idCuarteo'];
      
           $respuesta = InventarioModel::deleteCuarteoIdModel($idCuarteo, 'cuarteoinventario' );

               if ($respuesta == 'success') {
                
                  echo json_encode($respuesta);
               
               }else{
                echo json_encode($respuesta);
               }
        }




 public function borrarTempController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          $idTemp =$request['idTemp'];
          $descripcion =$request['descripcion'];
          $peso =$request['peso'];
          $id =$request['id'];
      
           $respuesta = InventarioModel::borrarTempModel($idTemp,$descripcion, $peso,$id, 'temp' );

               if ($respuesta == 'success') {
                
                  echo json_encode($respuesta);
               
               }else{
                echo json_encode($respuesta);
               }
        }



 public function borrarTemp1Controller(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          $idInventario =$request['idInventario'];
         
      
           $respuesta = InventarioModel::borrarTemp1Model($idInventario, 'tempmedia' );

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
      if ($_GET['id'] == "addCuarteo") {
         $usuario = new InventarioController;
         $usuario->addCuarteoController();
      }
   }
   if(isset($_GET['id'])){
      if ($_GET['id'] == "addInventarioCuarteo") {
         $usuario = new InventarioController;
         $usuario->addInventarioCuarteoController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "getInv") {
         $usuario = new InventarioController;
         $usuario->getInventarioController();
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "getInvTotal") {
         $usuario = new InventarioController;
         $usuario->getInventariototalController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "getInvTropa") {
         $usuario = new InventarioController;
         $usuario->getInventarioTropaController();
      }
   }


 if(isset($_GET['id'])){
      if ($_GET['id'] == "idCuarteoInventario") {
         $usuario = new InventarioController;
         $usuario->masInfoCuarteoController();
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
      if ($_GET['id'] == "borrarCuarteo") {
        $delete = new InventarioController;
        $delete->deleteCuarteoController();  
      }
   }
    if(isset($_GET['id'])){
      if ($_GET['id'] == "borrarCuarteoId") {
        $delete = new InventarioController;
        $delete->deleteCuarteoIdController();  
      }
   }
   

    if(isset($_GET['id'])){
      if ($_GET['id'] == "editInv") {
        $delete = new InventarioController;
        $delete->editarProductosController();  
      }
   }


    if(isset($_GET['id'])){
      if ($_GET['id'] == "cuarteo") {
        $delete = new InventarioController;
        $delete->getCuarteoController();  
      }
   }



    if(isset($_GET['id'])){
      if ($_GET['id'] == "cuarteoInventario") {
        $delete = new InventarioController;
        $delete->getCuarteoInventarioController();  
      }
   }

   if(isset($_GET['id'])){
      if ($_GET['id'] == "temporal") {
        $delete = new InventarioController;
        $delete->temporalController();  
      }
   }

   if(isset($_GET['id'])){
      if ($_GET['id'] == "temporal1") {
        $delete = new InventarioController;
        $delete->temporal1Controller();  
      }
   }

     if(isset($_GET['id'])){
      if ($_GET['id'] == "getTemp") {
        $delete = new InventarioController;
        $delete->getTemporalController();  
      }
   }
        if(isset($_GET['id'])){
      if ($_GET['id'] == "getTemp1") {
        $delete = new InventarioController;
        $delete->getTemporal1Controller();  
      }
   }

        if(isset($_GET['id'])){
      if ($_GET['id'] == "getTotalTemp") {
        $delete = new InventarioController;
        $delete->getTotalTempController();  
      }
   }
          if(isset($_GET['id'])){
      if ($_GET['id'] == "getTotalTemp1") {
        $delete = new InventarioController;
        $delete->getTotalTemp1Controller();  
      }
   }

         if(isset($_GET['id'])){
      if ($_GET['id'] == "borrarTemp") {
        $delete = new InventarioController;
        $delete->borrarTempController();  
      }
   }
       if(isset($_GET['id'])){
      if ($_GET['id'] == "borrarTemp1") {
        $delete = new InventarioController;
        $delete->borrarTemp1Controller();  
      }
   }


        if(isset($_GET['id'])){
      if ($_GET['id'] == "getFactura") {
        $delete = new InventarioController;
        $delete->getFacturaController();  
      }
   }

         if(isset($_GET['id'])){
      if ($_GET['id'] == "ventas") {
        $delete = new InventarioController;
        $delete->ventasController();  
      }
   }

         if(isset($_GET['id'])){
      if ($_GET['id'] == "getFacturas") {
        $delete = new InventarioController;
        $delete->getFacturasController();  
      }
   }


    if(isset($_GET['id'])){
      if ($_GET['id'] == "getDetalles") {
        $delete = new InventarioController;
        $delete->getDetallesController();  
      }
   }