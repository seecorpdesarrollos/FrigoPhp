<?php 

  require_once 'conexion.php';

   class UsuarioModel{
      static public function getUsuarioModel($datosModel,  $tabla){
         
          $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombreAdmin = :nombreAdmin && password = :password");
          $sql->execute( array(
            ':nombreAdmin'=>$datosModel['nombreAdmin'],
            ':password'=>$datosModel['password'],
            ));
            
           return  $sql->fetch();        
            	
        $sql->close();
   	  }


      public function updateEstadoModel($datosModel , $tabla){
       
        $sql1 = Conexion::conectar()->prepare("DELETE FROM  conectado WHERE  idAdmin = :idAdmin");
               $sql1->execute( array(
            ':idAdmin'=>$datosModel['idAdmin']
            ));
               $resultado = $sql1->fetch();
               if ($resultado) {
              return json_encode( $resultado );
            }else{
              return json_encode($resultado);
            }
             $sql->close();

      }

      public function usuarioEstadoModel($datosModel , $tabla){
       
        $sql1 = Conexion::conectar()->prepare("SELECT *  FROM  $tabla WHERE  idAdmin = :idAdmin");
               $sql1->execute( array(
            ':idAdmin'=>$datosModel
            ));
               $resultado = $sql1->fetch();
               if ($resultado) {
              return json_encode( $resultado );
            }else{
              return json_encode($resultado);
            }
             $sql->close();

      }


      public function deleteEstadoModel($datosModel , $tabla){
       
        $sql1 = Conexion::conectar()->prepare("DELETE  FROM  $tabla WHERE  idAdmin = :idAdmin");
               $sql1->execute( array(
            ':idAdmin'=>$datosModel
            ));
               $resultado = $sql1->fetch();
               if ($resultado) {
              return json_encode( $resultado );
            }else{
              return json_encode($resultado);
            }
             $sql->close();

      }
   }



 ?>