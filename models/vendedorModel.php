<?php 

  require_once 'conexion.php';

  class VendedorModel{

  	     public function getVendedoresModel($table){


   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE estado = 1  ORDER BY idVendedor ASC");

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

          public function getInventarioTropaModel($nroTropa, $table){


            $sql = Conexion::conectar()->prepare("SELECT *   FROM $table ta 
              JOIN productos pro ON ta.nroTropa = pro.nroTropa
              WHERE pro.nroTropa=:nroTropa");

            if ($sql->execute( array(':nroTropa'=>$nroTropa))) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }


      public function getInventarioIdModel($idInventario, $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table
              WHERE idInventario=:idInventario");

            if ($sql->execute( array(':idInventario'=>$idInventario))) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
       }


         public static function deleteProductosModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idProductos = :idProductos");
        $sql->bindParam(':idProductos', $datosModel);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

              public function getProductosModelId($datosModel , $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE idProductos = :idProductos");

            if ($sql->execute(array(':idProductos' =>$datosModel))) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
       }




             public function addVendedorModel($nombreVendedor,$telefonoVendedor, $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (nombreVendedor,telefonoVendedor)
                           VALUES(:nombreVendedor,:telefonoVendedor)");

              $sql->bindParam(':nombreVendedor', $nombreVendedor);
              $sql->bindParam(':telefonoVendedor', $telefonoVendedor);

              if ($sql->execute()) {
              	return 'success';
              }


         }

          public function editarInventarioModel($kiloMedia,$nroTropa, $idInventario, $tabla){

               $sql = Conexion::conectar()->prepare("UPDATE  $tabla SET 
                kiloMedia = :kiloMedia , nroTropa= :nroTropa WHERE idInventario=:idInventario");

              $sql->bindParam(':kiloMedia', $kiloMedia);
              $sql->bindParam(':nroTropa', $nroTropa);
              $sql->bindParam(':idInventario', $idInventario);

              if ($sql->execute()) {
                return 'success';
              }


         }

       public function comprobarInventarioModel($datosModel , $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table 
              WHERE nroTropa = :datosModel");
            $sql->execute(array(':datosModel'=>$datosModel));
            $res = $sql->fetchAll();
            if ( $res ) {
               return 'success';

            }else{
              return 'error';
            }
            $sql->close();
       }

        public function editarProductosModel($dueHacienda,
                                             $cantCabeza,
                                             $cantMedia,
                                             $fechaFaena,
                                             $cantKilos,
                                             $nroTropa,
                                             $idProductos
                                              , $tabla){

               $sql = Conexion::conectar()->prepare("UPDATE  $tabla SET 
dueHacienda = :dueHacienda,  cantCabeza = :cantCabeza,cantMedia =:cantMedia,fechaFaena=:fechaFaena,cantKilos =:cantKilos,nroTropa=:nroTropa WHERE idProductos=:idProductos ");

              $sql->bindParam(':dueHacienda', $dueHacienda);
              $sql->bindParam(':cantCabeza', $cantCabeza);
              $sql->bindParam(':cantMedia', $cantMedia);
              $sql->bindParam(':fechaFaena', $fechaFaena);
              $sql->bindParam(':cantKilos', $cantKilos);
              $sql->bindParam(':nroTropa', $nroTropa);
              $sql->bindParam(':idProductos', $idProductos);

              if ($sql->execute()) {
                return 'success';
              }


  }

}