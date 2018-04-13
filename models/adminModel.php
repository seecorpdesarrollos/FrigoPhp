<?php 
 ob_start();
require_once 'conexion.php';

 class AdminModel{

 	 public function getAdminModel( $tabla){

          $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla" );
          $sql->execute();
            return $sql->fetchAll();
            $sql->close();
 	 }


   public function getAdminModelActual( $idAdmin, $tabla){

          $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idAdmin = :idAdmin" );
          $sql->execute(array(':idAdmin'=>$idAdmin));
           $resulatado = $sql->fetch();
           if ($resulatado) {
             return json_encode($resulatado);
           }else{
             return json_encode($resulatado);

           }
            $sql->close();
   }
 	  public function getAdminModelActivo($tabla){

          $sql = Conexion::conectar()->prepare("SELECT * ,  COUNT(estado) AS TOTAL FROM $tabla" );
          $sql->execute();
            return $sql->fetchAll();
            $sql->close();
 	 }

 	   public function getAdminModelUsuario($tabla){

          $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla" );
          $sql->execute();
            return $sql->fetchAll();
            $sql->close();
 	 }

     public function addUsuarioModel( $nombreAdmin ,$password,$rol , $tabla){
       
        $sql1 = Conexion::conectar()->prepare("INSERT INTO   $tabla (nombreAdmin, password, rol)
         VALUES(:nombreAdmin, :password, :rol)");
               $sql1->execute( array(
            ':nombreAdmin'=>$nombreAdmin,
            ':password'=>$password,
            ':rol'=>$rol,
            ));
               $resultado = $sql1->fetchAll();
               if ($resultado) {
              return 'success' ;
            }else{
              return 'error';
            }
             $sql->close();

      }

 }
 ob_end_flush();