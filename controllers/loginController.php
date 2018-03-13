<?php 
    header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");

  require_once '../models/loginModel.php';
  class UsuarioController{

      public function getUsuarioController(){

     $ip = $_SERVER['REMOTE_ADDR'];
      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

        $nombre =$request['nombreAdmin'];
        $password =$request['password'];

        $datosController = array('nombreAdmin' => $nombre,
                'password' => $password,
               
            );
       
        $respuesta = UsuarioModel::getUsuarioModel($datosController, $ip , 'admin');

        echo $respuesta ;
         
      }

    

      public function updateEstadoController(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

      
        $idAdmin =$request['idAdmin'];
       
          $respuesta = UsuarioModel::updateEstadoModel($idAdmin , 'admin');
        
        echo $respuesta ;
      }


      public function usuarioEstadoController(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $request = (array) $request;

      
        $idAdmin =1;
        // $idAdmin =$request['idAdmin'];
       
          $respuesta = UsuarioModel::usuarioEstadoModel($idAdmin , 'admin');
        
        echo $respuesta ;
      }

  }

   
      if(isset($_GET['id'])){
      if ($_GET['id'] == "getUsuarios") {
         $usuario = new UsuarioController;
         $usuario->getUsuarioController();
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