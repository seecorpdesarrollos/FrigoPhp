<?php 
 ob_start();

     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");
        require_once '../models/adminModel.php';
   class AdminController{


   	   static public function getAdminController(){
   	   	 $respuesta = AdminModel::getAdminModel( 'admin');
   	   	  echo json_encode( $respuesta );
   	   }


        static public function getAdminControllerActivo(){
         $respuesta = AdminModel::getAdminModelActivo( 'conectado');
         return $respuesta;
       }
         static public function getAdminControllerUsuario(){
         $respuesta = AdminModel::getAdminModelUsuario('conectado');
         return $respuesta;
       }

       static public function updateUsuarioController(){
            

          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

      
         $password = $request['password'];
         $rol =  $request['rol'];
         $idAdmin =  $request['idAdmin'];
       
          $respuesta = AdminModel::updateUsuarioModel($password , $rol,  $idAdmin, 'admin');
        
        if($respuesta == "success"){
          echo json_encode($respuesta);
        }else{
          echo json_encode("error");
        }

       
         
      }

    static public function addUsuarioController(){
          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

      
         $password = $request['password'];
         $rol =  $request['rol'];
         $nombreAdmin =  $request['nombreAdmin'];
       
          $respuesta = AdminModel::addUsuarioModel($nombreAdmin, $password , $rol,  'admin');
        
        if($respuesta == "success"){
          echo json_encode($respuesta);
        }else{
          echo json_encode("error");
        }

       
         
      }

   }

  
      if(isset($_GET['id'])){
      if ($_GET['id'] == "getUsuarios") {
         $usuario = new AdminController;
         $usuario->getAdminController();
      }
   }


      if(isset($_GET['id'])){
      if ($_GET['id'] == "getUsuariosActual") {
         $usuario = new AdminController;
         $usuario->getUsuarioControllerActual();
      }
   }

   if(isset($_GET['id'])){
      if ($_GET['id'] == "updateAdmin") {
         $usuario = new AdminController;
         $usuario->updateUsuarioController();
      }
   }


if(isset($_GET['id'])){
      if ($_GET['id'] == "addAdmin") {
         $usuario = new AdminController;
         $usuario->addUsuarioController();
      }
   }

