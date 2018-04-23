<?php 

  require_once 'conexion.php';

  class VendedorModel{

  	     static public function getVendedoresModel($table){

   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE estado = 1  ORDER BY idVendedor ASC");

   	   	    if ($sql->execute()) {
   	   	    	 return $sql->fetchAll();

   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }
               static public function getVendedoresInactivosModel($table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE estado = 0  ORDER BY idVendedor ASC");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }


         static public function getInventarioTotalModel($nroTropa , $table){


            $sql = Conexion::conectar()->prepare("SELECT sum(kiloMedia) as total FROM $table  WHERE nroTropa=:nroTropa ");

            if ($sql->execute(array(':nroTropa'=>$nroTropa))) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

          static public function getVendedorIdModel($idVendedor, $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table 
              WHERE idVendedor=:idVendedor");

            if ($sql->execute( array(':idVendedor'=>$idVendedor))) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
       }


      static public function getInventarioIdModel($idInventario, $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table
              WHERE idInventario=:idInventario");

            if ($sql->execute( array(':idInventario'=>$idInventario))) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
       }


         static public  function bajaVendedorModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0  WHERE idVendedor = :idVendedor");
        $sql->bindParam(':idVendedor', $datosModel);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

             static public  function altaVendedorModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 1  WHERE idVendedor = :idVendedor");
        $sql->bindParam(':idVendedor', $datosModel);

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

              static public function getProductosModelId($datosModel , $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE idProductos = :idProductos");

            if ($sql->execute(array(':idProductos' =>$datosModel))) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
       }




             static public function addVendedorModel($nombreVendedor,$telefonoVendedor, $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (nombreVendedor,telefonoVendedor)
                           VALUES(:nombreVendedor,:telefonoVendedor)");

              $sql->bindParam(':nombreVendedor', $nombreVendedor);
              $sql->bindParam(':telefonoVendedor', $telefonoVendedor);

              if ($sql->execute()) {
              	return 'success';
              }


         }

          static public function editarVendedorModel($nombreVendedor,$telefonoVendedor, $idVendedor, $tabla){

               $sql = Conexion::conectar()->prepare("UPDATE  $tabla SET 
                nombreVendedor = :nombreVendedor , telefonoVendedor= :telefonoVendedor WHERE idVendedor=:idVendedor");

              $sql->bindParam(':nombreVendedor', $nombreVendedor);
              $sql->bindParam(':telefonoVendedor', $telefonoVendedor);
              $sql->bindParam(':idVendedor', $idVendedor);

              if ($sql->execute()) {
                return 'success';
              }


         }

      static public function comprobarVendedorModel($nombreVendedor , $table){

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