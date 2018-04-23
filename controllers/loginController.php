<?php 
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");

  require_once '../models/loginModel.php';
  class UsuarioController{

      public static function getUsuarioController(){

  
      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

        $nombre =$request['nombreAdmin'];
        $password =$request['password'];

        $datosController = array('nombreAdmin' => $nombre,
                'password' => $password,
               
            );
       
        $respuesta = UsuarioModel::getUsuarioModel($datosController, 'admin');

        echo  json_encode($respuesta) ;
         
      }

    

      public static function updateEstadoController(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

      
        $idAdmin =$request['idAdmin'];
       
          $respuesta = UsuarioModel::updateEstadoModel($idAdmin , 'admin');
        
        echo $respuesta ;
      }


      public static function usuarioEstadoController(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

      
        $idAdmin =1;
        // $idAdmin =$request['idAdmin'];
       
          $respuesta = UsuarioModel::usuarioEstadoModel($idAdmin , 'admin');
        
        echo $respuesta ;
      }

       public static function deleteEstadoController(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

      
        // $idAdmin =1;
        $idAdmin =$request['idAdmin'];
       
          $respuesta = UsuarioModel::deleteEstadoModel($idAdmin , 'admin');
        

         if ($respuesta == 'success') {
           
          echo json_encode($respuesta);
         }else{
            echo json_encode($respuesta);
         }
      }

  }

   
      if(isset($_GET['id'])){
      if ($_GET['id'] == "getUsuarios") {
         $usuario = new UsuarioController;
         $usuario->getUsuarioController();
      }
   }

       if(isset($_GET['id'])){
      if ($_GET['id'] == "delete") {
         $usuario = new UsuarioController;
         $usuario->deleteEstadoController();
      }
   }


  if(isset($_GET['id'])){
      if ($_GET['id'] == "updateEstado") {
         $usuario = new UsuarioController;
         $usuario->updateEstadoController();
      }
   }

     if(isset($_GET['id'])){
      if ($_GET['id'] == "getUsuariosActual") {
         $usuarios = new UsuarioController;
         $usuarios->getUsuarioActual();
      }
   }

    if(isset($_GET['id'])){
      if ($_GET['id'] == "usuarioEstado") {
         $usuario = new UsuarioController;
         $usuario->usuarioEstadoController();
      }
   }


 ?>