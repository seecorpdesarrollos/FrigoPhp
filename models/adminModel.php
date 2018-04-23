<?php 
 ob_start();
require_once 'conexion.php';

 class AdminModel{

 	  static public function getAdminModel( $tabla){

          $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla" );
          $sql->execute();
            return $sql->fetchAll();
            $sql->close();
 	 }


   static public function getAdminModelActual( $idAdmin, $tabla){

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
 	  static public function getAdminModelActivo($tabla){

          $sql = Conexion::conectar()->prepare("SELECT * ,  COUNT(estado) AS TOTAL FROM $tabla" );
          $sql->execute();
            return $sql->fetchAll();
            $sql->close();
 	 }

 	   static public function getAdminModelUsuario($tabla){

          $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla" );
          $sql->execute();
            return $sql->fetchAll();
            $sql->close();
 	 }

     static public function addUsuarioModel( $nombreAdmin ,$password,$rol , $tabla){
       
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

                static public  function updateUsuarioModel($password , $rol,  $idAdmin,  $tabla)
    {

        $sql = Conexion::conectar()->prepare("UPDATE $tabla SET password = :password, rol=:rol  WHERE idAdmin = :idAdmin");
        $sql->bindParam(':password', $password);
        $sql->bindParam(':rol', $rol);
        $sql->bindParam(':idAdmin', $idAdmin);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

 }
 ob_end_flush();