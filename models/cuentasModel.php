<?php

  require_once 'conexion.php';

  class CuentasModel{

  	     static public function getCuentasModel($table){

   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              JOIN vendedores ve ON ta.idVendedor= ve.idVendedor WHERE ta.saldoActual >0 ORDER BY ta.idCliente ASC");

   	   	    if ($sql->execute()) {
   	   	    	return $sql->fetchAll();
   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }


         static public function getCuentasModelId($idCliente, $table){
            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              -- JOIN vendedores ve ON ta.idVendedor= ve.idVendedor
              WHERE ta.idCliente = :idCliente ");
            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();
            }else{
              return 'errors';
            }
            $sql->close();
       }
         static public function getPagosModel($table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              JOIN vendedores ve ON ta.idVendedor= ve.idVendedor
              ORDER BY ta.fechaPago  DESC");

            if ($sql->execute()) {
              return $sql->fetchAll();
            }else{
              return 'error';
            }
            $sql->close();
       }


         static public function getDetallesFacturaModel($idCliente, $fechaInicial, $fechaFinal, $table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
             JOIN facturado det ON ta.nroFactura= det.nroFactura
              WHERE ta.idCliente = :idCliente AND ta.fecha  BETWEEN :fechaInicial AND :fechaFinal");

            if ($sql->execute( array(
                                  ':idCliente'=>$idCliente,
                                   ':fechaInicial'=>$fechaInicial,
                                    ':fechaFinal'=>$fechaFinal,
                                  ))) {
               return $sql->fetchAll();

            }else{
              return 'error detalles';
            }
            $sql->close();
       }


         static public function getTotalKilosModel($idCliente, $fechaInicial, $fechaFinal, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(kilo) AS totalKilos FROM $table ta
              WHERE ta.idCliente = :idCliente AND ta.fecha  BETWEEN :fechaInicial AND :fechaFinal");

            if ($sql->execute( array(
                                  ':idCliente'=>$idCliente,
                                   ':fechaInicial'=>$fechaInicial,
                                    ':fechaFinal'=>$fechaFinal,
                                  ))) {
               return $sql->fetch();

            }else{
              return 'error detalles';
            }
            $sql->close();
       }




         static public function getEntradaModelId($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(entrada) AS totalEntrada  FROM $table  WHERE idCliente = :idCliente");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'errors de cuentas';
            }
            $sql->close();
       }



         static public function getSalidaModelId($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(pagos) AS totalSalida  FROM $table  WHERE idCliente = :idCliente");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'errors';
            }
            $sql->close();
       }
         static public function getTodoModelId($idCliente, $fechaInicial, $fechaFinal,  $table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
             -- LEFT JOIN detalles de ON de.nroFactura=ta.nroFactura
             LEFT JOIN clientes cli ON cli.idCliente= ta.idCliente
             LEFT JOIN vendedores ve ON ta.idVendedor= ve.idVendedor
              WHERE ta.idCliente = :idCliente  AND ta.fecha
              BETWEEN :fechaInicial AND :fechaFinal ORDER BY ta.fecha ASC ");

            if ($sql->execute( array(
              ':idCliente'=>$idCliente,
              ':fechaInicial'=>$fechaInicial,
              ':fechaFinal'=>$fechaFinal,
              ))) {
               return $sql->fetchAll();

            }else{
              return 'errors';
            }
            $sql->close();
       }

       static public function getSaldoAnteriorModelId($idCliente, $fechaInicial,   $table){

          $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta
            WHERE ta.idCliente = :idCliente  AND ta.fecha < :fechaInicial");

          if ($sql->execute( array(
            ':idCliente'=>$idCliente,
            ':fechaInicial'=>$fechaInicial,

            ))) {
             return $sql->fetchAll();

          }else{
            return 'errors';
          }
          $sql->close();
     }


       static public function addCuentasModel($idCliente,
              $comprobante,
              $monto,
              $efectivo,
              $cheque,
              $nroCheque,
              $banco,
              $propietario,
              $idVendedor ,
              $fechaCobro,
              $tabla){



            $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente, comprobante, monto, efectivo, cheque, nroCheque, banco,propietario,fechaPago, idVendedor)
              VALUES(:idCliente,:comprobante, :monto , :efectivo,:cheque,:nroCheque, :banco, :propietario,:fechaPago , :idVendedor)");
              $sql->bindParam(':idCliente', $idCliente);
              $sql->bindParam(':comprobante', $comprobante);
              $sql->bindParam(':monto', $monto);
              $sql->bindParam(':efectivo', $efectivo);
              $sql->bindParam(':cheque', $cheque);
              $sql->bindParam(':nroCheque', $nroCheque);
              $sql->bindParam(':banco', $banco);
              $sql->bindParam(':propietario', $propietario);
              $sql->bindParam(':idVendedor', $idVendedor);
              $sql->bindParam(':fechaPago', $fechaCobro);
              // $ven=1; // vendedor
              if ($sql->execute()) {

               $sql3 = Conexion::conectar()->prepare("UPDATE  saldos SET  saldoActual= saldoActual- $monto, saldoFinal= saldoFinal-  $monto ,
               idVendedor=$idVendedor WHERE idCliente = :idCliente");
               $sql3->bindParam(':idCliente', $idCliente);
                $sql3->execute();




            $sql41 = Conexion::conectar()->prepare("INSERT INTO cuentacorriente(comprobante,
             pagos,  idCliente, fecha, idVendedor)
              VALUES(:comprobante, :pagos , :idCliente,:fecha,:idVendedor)");
              $hoy = $fechaCobro;
              $sql41->bindParam(':comprobante', $comprobante);
              $sql41->bindParam(':pagos', $monto);
              $sql41->bindParam(':idCliente', $idCliente);
              $sql41->bindParam(':fecha', $hoy);
              $sql41->bindParam(':idVendedor', $idVendedor);
              $sql41->execute();


                 $sql13 = Conexion::conectar()->prepare("SELECT MAX(idCuentaCorriente)AS id FROM cuentacorriente
                  WHERE idCliente = :idCliente");
               $sql13->bindParam(':idCliente', $idCliente);
               $sql13->execute();
                $resu= $sql13->fetch();
                 $id =  $resu['id'];


               $sql11 = Conexion::conectar()->prepare("UPDATE cuentacorriente
                 SET saldo= (SELECT saldoFinal FROM saldos WHERE idCliente=$idCliente)
                 WHERE idCliente=:idCliente AND idCuentaCorriente = :id" );
              $sql11->bindParam(':idCliente', $idCliente);
              $sql11->bindParam(':id', $id);
               $sql11->execute();


                return 'success';
              }else{
              return 'errores';
            }
               $sql->close();

    }




       // panel principal
       //

       static public function getExistenciaModel($nroTropa , $table){

            $sql = Conexion::conectar()->prepare("SELECT * , count(inv.cantidad) as total  , sum(inv.kiloMedia) AS totalKilos FROM inventario inv JOIN productos pro ON inv.nroTropa= pro.nroTropa
  WHERE inv.nroTropa= :nroTropa AND inv.cantidad = 1 ");

            if ($sql->execute(array(':nroTropa'=>$nroTropa))) {
              return $sql->fetchAll();
            }else{
              return 'error';
            }
            $sql->close();
       }

       static public function getInventarioTropaModel($table){

            $sql = Conexion::conectar()->prepare("SELECT nroTropa , estado,  COUNT(*) as total from inventario WHERE  estado = 'cuarteo'  GROUP BY nroTropa");

            if ($sql->execute()) {
              return $sql->fetchAll();
            }else{
              return 'error';
            }
            $sql->close();
       }

          static public function getInventarioTropaDisponibleModel($table){

            $sql = Conexion::conectar()->prepare("SELECT nroTropa , estado,  COUNT(*) as total from inventario WHERE  estado = 'Disponible'  GROUP BY nroTropa");

            if ($sql->execute()) {
              return $sql->fetchAll();
            }else{
              return 'error';
            }
            $sql->close();
       }


        static public function getInventarioTropaVendidoModel($table){

            $sql = Conexion::conectar()->prepare("SELECT nroTropa , estado,  COUNT(*) as total from inventario WHERE  estado = 'Vendida'  GROUP BY nroTropa");

            if ($sql->execute()) {
              return $sql->fetchAll();
            }else{
              return 'error';
            }
            $sql->close();
       }

        static public function getCantModel($table){

            $sql = Conexion::conectar()->prepare("SELECT nroTropa , cantMedia  From $table order by nroTropa asc");

            if ($sql->execute()) {
              return $sql->fetchAll();
            }else{
              return 'error';
            }
            $sql->close();
       }


     }
