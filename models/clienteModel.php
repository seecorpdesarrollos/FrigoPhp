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

       public function getClientesTodosModel($table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table   ORDER BY idCliente ASC");

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

          public function getClienteFacturadoIdModel($idCliente, $table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
              JOIN facturado fa ON fa.idCliente=ta.idCliente
              WHERE fa.idCliente=:idCliente AND fa.estado=1");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
             $res= $sql->fetchAll();
            }
             if(empty(($res))){
              return 'error';
             }else{
              return $res;
             }
            $sql->close();
       }

        public function getSaldoIdModel($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE idCliente = :idCliente");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
             $res= $sql->fetch();
            }
             if(empty(($res))){
              return 'nada';
             }else{
              return $res;
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

              public static function addDeudasModel($idCliente, $montoDeuda, $idVendedor ,$tabla)
    {
// genera el pago al cliente.
        $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente, montoDeuda, idVendedor) 
          VALUES(:idCliente, :montoDeuda, :idVendedor)");
        $sql->bindParam(':idCliente', $idCliente);
        $sql->bindParam(':montoDeuda', $montoDeuda);
        $sql->bindParam(':idVendedor', $idVendedor);

        if ($sql->execute()) {
            $sql = Conexion::conectar()->prepare("UPDATE  facturado SET 
               estado= 0 WHERE idCliente= $idCliente");
           $sql->execute();
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

            $sql1 = Conexion::conectar()->prepare("SELECT MAX(idCliente) as ID FROM clientes");
            $sql1->execute();
             $res= $sql1->fetch();
                 $idCliente =  $res['ID'];
                  $sql2 = Conexion::conectar()->prepare("INSERT INTO saldos
                (idCliente) VALUES(:idCliente)");
              $sql2->bindParam(':idCliente', $idCliente);
                 $sql2->execute();
              	return 'success';
              }else{
              return 'error';
            }
               $sql->close();


         }


         public function getClienteIdModel($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table WHERE idCliente = :idCliente");

            if ($sql->execute(array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

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