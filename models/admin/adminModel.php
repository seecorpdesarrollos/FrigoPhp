<?php 
 ob_start();
require_once 'models/conexion.php';

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

 }
 ob_end_flush();