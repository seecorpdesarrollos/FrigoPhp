<?php 
  
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
   require_once '../models/vendedorModel.php';
   class VendedoresController{

   	  	static public function getVendedoresController(){
 			  
      $respuesta = VendedorModel::getVendedoresModel('vendedores');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }


      static public function getVendedoresInactivosController(){
        
      $respuesta = VendedorModel::getVendedoresInactivosModel('vendedores');

       if ($respuesta) {
        
          echo json_encode($respuesta);
       
       }

        }

 

      static public function getVendedoresControllerId(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $idVendedor =$request['idVendedor'];
         $respuesta = VendedorModel::getVendedorIdModel($idVendedor, 'vendedores');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }

             static public function getInventarioIdController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $idInventario =$request['idInventario'];
         $respuesta = InventarioModel::getInventarioIdModel($idInventario, 'inventario');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }

          static public function getInventarioTotalTropaController(){
              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $nroTropa =$request['nroTropa'];
         $respuesta = InventarioModel::getInventarioTotalModel($nroTropa, 'inventario');

         if ($respuesta) {
          
              echo json_encode($respuesta);
           
         }

        }



   	  static public function  agregarVendedorController(){
             

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

         static public function  editarVendedorController(){
             

              $data = file_get_contents("php://input");
             $request = json_decode($data);
             $request = (array) $request;
                
            
              $nombreVendedor =$request['nombreVendedor'];
              $telefonoVendedor =$request['telefonoVendedor'];
              $idVendedor =$request['idVendedor'];
          $respuesta = VendedorModel::editarVendedorModel($nombreVendedor, $telefonoVendedor,$idVendedor,
           'vendedores' );

               if ($respuesta == 'success') {
        
          echo json_encode($respuesta);
       
       }else{
        echo json_encode("no hay edicion de  Vendedor");
       }

       }


  
        static public function bajaVendedorController(){
       	  $data = file_get_contents("php://input");
    		  $request = json_decode($data);
    		  $request = (array) $request;

    		  $idVendedor =$request['idVendedor'];
 			
 			     $respuesta = VendedorModel::bajaVendedorModel($idVendedor, 'vendedores' );

         			 if ($respuesta == 'success') {
         			 	
         			 		echo json_encode($respuesta);
         			 
         			 }else{
         			 	echo json_encode($respuesta);
         			 }
        }

        static public function altaVendedorController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          $idVendedor =$request['idVendedor'];
      
           $respuesta = VendedorModel::altaVendedorModel($idVendedor, 'vendedores' );

               if ($respuesta == 'success') {
                
                  echo json_encode($respuesta);
               
               }else{
                echo json_encode($respuesta);
               }
        }


       static public function comprobarVendedorController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

          // $nombreVendedor ='juan valdes';
          $nombreVendedor =$request['nombreVendedor'];
      
           $respuesta = VendedorModel::comprobarVendedorModel($nombreVendedor, 'vendedores' );

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

           if(isset($_GET['id'])){
      if ($_GET['id'] == "geVenInactivo") {
         $usuario = new VendedoresController;
         $usuario->getVendedoresInactivosController();
      }
   }
     if(isset($_GET['id'])){
      if ($_GET['id'] == "geVenId") {
         $usuario = new VendedoresController;
         $usuario->getVendedoresControllerId();
      }
   }
        if(isset($_GET['id'])){
      if ($_GET['id'] == "comprobarVen") {
         $usuario = new VendedoresController;
         $usuario->comprobarVendedorController();
      }
   }

          if(isset($_GET['id'])){
      if ($_GET['id'] == "editarVendedor") {
         $usuario = new VendedoresController;
         $usuario->editarVendedorController();
      }
   }

           if(isset($_GET['id'])){
      if ($_GET['id'] == "bajaVenId") {
         $usuario = new VendedoresController;
         $usuario->bajaVendedorController();
      }
   }

           if(isset($_GET['id'])){
      if ($_GET['id'] == "altaVenId") {
         $usuario = new VendedoresController;
         $usuario->altaVendedorController();
      }
   }
     