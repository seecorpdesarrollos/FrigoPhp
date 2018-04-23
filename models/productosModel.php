<?php 

  require_once 'conexion.php';

  class AgregarProductosModel{

  	     static public function getProductosModel($table){


   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table  ORDER BY idProductos DESC");

   	   	    if ($sql->execute()) {
   	   	    	 return $sql->fetchAll();

   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }


         static public  function deleteProductosModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idProductos = :idProductos");
        $sql->bindParam(':idProductos', $datosModel);

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




             static public function addProductosModel($dueHacienda,
                                             $cantCabeza,
                                             $cantMedia,
                                             $fechaFaena,
                                             $cantKilos,
                                             $nroTropa
                                              , $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (dueHacienda,cantCabeza,cantMedia,fechaFaena,cantKilos,nroTropa)
                           VALUES(:dueHacienda,:cantCabeza,:cantMedia,:fechaFaena,:cantKilos,:nroTropa)");

              $sql->bindParam(':dueHacienda', $dueHacienda);
              $sql->bindParam(':cantCabeza', $cantCabeza);
              $sql->bindParam(':cantMedia', $cantMedia);
              $sql->bindParam(':fechaFaena', $fechaFaena);
              $sql->bindParam(':cantKilos', $cantKilos);
              $sql->bindParam(':nroTropa', $nroTropa);

              if ($sql->execute()) {
              	return 'success';
              }


  }

        static public function editarProductosModel($dueHacienda,
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