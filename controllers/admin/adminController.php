<?php 
 ob_start();

     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Headers:Origin, X-Requested-Withd, Content-Type, Accept");

   class AdminController{


   	   public function getAdminController(){
   	   	 $respuesta = AdminModel::getAdminModel( 'admin');
   	   	 return $respuesta;
   	   }


       public function getAdminControllerActivo(){
         $respuesta = AdminModel::getAdminModelActivo( 'conectado');
         return $respuesta;
       }
        public function getAdminControllerUsuario(){
         $respuesta = AdminModel::getAdminModelUsuario('conectado');
         return $respuesta;
       }

      public function getUsuarioControllerActual(){
            

          $data = file_get_contents("php://input");
          $request = json_decode($data);
          $request = (array) $request;

      
         $idAdmin =1;
       
          $respuesta = AdminModel::updateEstadoModel($idAdmin , 'admin');
        
        echo $respuesta ;

       
         
      }

   }

  
      if(isset($_GET['id'])){
      if ($_GET['id'] == "getUsuariosActual") {
         $usuario = new AdminController;
         $usuario->getUsuarioControllerActual();
      }
   }

?>