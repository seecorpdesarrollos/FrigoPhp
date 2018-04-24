<?php 

  require_once 'conexion.php';

  class ReportesModel{

     	     static public function getMediasModel($idCliente , $table){

   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              WHERE ta.idCliente =:idCliente
              ");

   	   	    if ($sql->execute(array(':idCliente'=>$idCliente))) {
   	   	    	return $sql->fetchAll();
   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }

   	      static public function getMediasFechaModel($fecha1, $fecha2 , $table){

   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN clientes cli ON cli.idCliente= ta.idCliente
             WHERE ta.fecha BETWEEN :fecha1 AND :fecha2
              ");

   	   	    if ($sql->execute(array(
   	   	    	':fecha1'=>$fecha1,
   	   	    	':fecha2'=>$fecha2

   	   	    	))) {
   	   	    	return $sql->fetchAll();
   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }

    static public function getTropaModel($nroTropa,  $table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              JOIN productos pro ON pro.nroTropa= ta.nroTropa
             WHERE ta.nroTropa=:nroTropa
              ");

            if ($sql->execute(array( ':nroTropa'=>$nroTropa  ))) {
              $res= $sql->fetchAll();
              if ($res) {
                return $res;   
              }
            else{
              return 'nada';
            }
            }
            $sql->close();
       }

}