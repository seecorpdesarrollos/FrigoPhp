<?php 

  require_once 'conexion.php';

  class ClientesModel{

  	     public function getClientesModel($table){

   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE estadoCliente = 1  ORDER BY idCliente ASC");

   	   	    if ($sql->execute()) {
   	   	    	 return $sql->fetchAll();

   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }
               public function getClientesInactivosModel($table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE estadoCliente = 0  ORDER BY idCliente ASC");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }


         public function getInventarioTotalModel($nroTropa , $table){


            $sql = Conexion::conectar()->prepare("SELECT sum(kiloMedia) as total FROM $table  WHERE nroTropa=:nroTropa ");

            if ($sql->execute(array(':nroTropa'=>$nroTropa))) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

          public function getClienteIdModel($idCliente, $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table 
              WHERE idCliente=:idCliente");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
       }





         public static function bajaClientesModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("UPDATE $tabla SET estadoCliente = 0  WHERE idCliente = :idCliente");
        $sql->bindParam(':idCliente', $datosModel);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

             public static function altaClientesModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("UPDATE $tabla SET estadoCliente = 1  WHERE idCliente = :idCliente");
        $sql->bindParam(':idCliente', $datosModel);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

  

             static public function addClienteModel($nombreCliente,$telefonoCliente,$direccionCliente, $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (nombreCliente,telefonoCliente,direccionCliente)
                           VALUES(:nombreCliente,:telefonoCliente,:direccionCliente)");

              $sql->bindParam(':nombreCliente', $nombreCliente);
              $sql->bindParam(':telefonoCliente', $telefonoCliente);
              $sql->bindParam(':direccionCliente', $direccionCliente);

              if ($sql->execute()) {
              	return 'success';
              }else{
              return 'error';
            }
               $sql->close();


         }

          public function editarClientesModel($nombreCliente,$telefonoCliente,$direccionCliente ,
            $idCliente, $tabla){

               $sql = Conexion::conectar()->prepare("UPDATE  $tabla SET 
                nombreCliente = :nombreCliente , telefonoCliente= :telefonoCliente , 
                direccionCliente=:direccionCliente WHERE idCliente=:idCliente");

              $sql->bindParam(':nombreCliente', $nombreCliente);
              $sql->bindParam(':telefonoCliente', $telefonoCliente);
              $sql->bindParam(':direccionCliente', $direccionCliente);
              $sql->bindParam(':idCliente', $idCliente);

              if ($sql->execute()) {
                return 'success';
              }else{
                return 'error';
              }


         }

      public function comprobarVendedorModel($nombreVendedor , $table){

  $sql = Conexion::conectar()->prepare("SELECT * FROM $table 
              WHERE nombreVendedor = :nombreVendedor");
            $sql->execute(array(':nombreVendedor'=>$nombreVendedor));
            $res = $sql->fetchAll();
            if ( $res ) {
               return 'success';

            }else{
              return 'error';
            }
            $sql->close();
       }

      
}