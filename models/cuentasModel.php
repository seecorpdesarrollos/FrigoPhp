<?php 

  require_once 'conexion.php';

  class CuentasModel{

  	     public function getCuentasModel($table){

   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              JOIN vendedores ve ON ta.idVendedor= ve.idVendedor ORDER BY ta.idCliente ASC");

   	   	    if ($sql->execute()) {
   	   	    	return $sql->fetchAll();
   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }

              
         public function getCuentasModelId($idCliente, $table){
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
         public function getPagosModel($table){

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


         public function getDetallesFacturaModel($idCliente, $fechaInicial, $fechaFinal, $table){

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


         public function getTotalKilosModel($idCliente, $fechaInicial, $fechaFinal, $table){

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




         public function getEntradaModelId($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(entrada) AS totalEntrada  FROM $table  WHERE idCliente = :idCliente");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'errors de cuentas';
            }
            $sql->close();
       }



         public function getSalidaModelId($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(pagos) AS totalSalida  FROM $table  WHERE idCliente = :idCliente");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'errors';
            }
            $sql->close();
       }
         public function getTodoModelId($idCliente, $fechaInicial, $fechaFinal,  $table){

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


       public function addCuentasModel($idCliente,
              $comprobante,
              $monto,
              $efectivo,
              $cheque,
              $nroCheque,
              $banco,
              $propietario,
              $idVendedor , $tabla){

        

            $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente, comprobante, monto, efectivo, cheque, nroCheque, banco,propietario, idVendedor)
              VALUES(:idCliente,:comprobante, :monto , :efectivo,:cheque,:nroCheque, :banco, :propietario,:idVendedor)");
              $sql->bindParam(':idCliente', $idCliente);
              $sql->bindParam(':comprobante', $comprobante);
              $sql->bindParam(':monto', $monto);
              $sql->bindParam(':efectivo', $efectivo);
              $sql->bindParam(':cheque', $cheque);
              $sql->bindParam(':nroCheque', $nroCheque);
              $sql->bindParam(':banco', $banco);
              $sql->bindParam(':propietario', $propietario);
              $sql->bindParam(':idVendedor', $idVendedor);
              // $ven=1; // vendedor
              if ($sql->execute()) {
   
               $sql3 = Conexion::conectar()->prepare("UPDATE  saldos SET  saldoActual= saldoActual- $monto, saldoFinal= saldoFinal-  $monto , 
               idVendedor=$idVendedor WHERE idCliente = :idCliente");
               $sql3->bindParam(':idCliente', $idCliente);
                $sql3->execute();




            $sql41 = Conexion::conectar()->prepare("INSERT INTO cuentacorriente(comprobante,
             pagos,  idCliente, fecha, idVendedor)
              VALUES(:comprobante, :pagos , :idCliente,:fecha,:idVendedor)");
              $hoy = date('y-m-d');
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
              return 'errorers';
            }
               $sql->close();

    }


      public function addCuentasModels($idCliente,
              $comprobante,
              $monto,
              $efectivo,
              $cheque,
              $nroCheque,
              $banco,
              $propietario, $tabla){

        
            $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente, comprobante, monto, efectivo, cheque, nroCheque, banco,propietario)
              VALUES(:idCliente,:comprobante, :monto , :efectivo,:cheque,:nroCheque, :banco, :propietario)");
              $sql->bindParam(':idCliente', $idCliente);
              $sql->bindParam(':comprobante', $comprobante);
              $sql->bindParam(':monto', $monto);
              $sql->bindParam(':efectivo', $efectivo);
              $sql->bindParam(':cheque', $cheque);
              $sql->bindParam(':nroCheque', $nroCheque);
              $sql->bindParam(':banco', $banco);
              $sql->bindParam(':propietario', $propietario);

              if ($sql->execute()) {

               $sql571 = Conexion::conectar()->prepare("INSERT INTO cuentacorriente(comprobante,pagos,idCliente, fecha)
                    VALUES(:nroFactura,:pagos,:idCliente,:fecha)");
               $hoy = date('y-m-d');
             
                   $sql571->bindParam(':nroFactura', $comprobante);
                   $sql571->bindParam(':pagos', $monto);
                   $sql571->bindParam(':idCliente', $idCliente);
                   $sql571->bindParam(':fecha', $hoy);
                   $sql571->execute();


               $sql3 = Conexion::conectar()->prepare("UPDATE  saldos SET  saldoActual= saldoActual - $monto , saldoFinal = saldoFinal - $monto WHERE idCliente = :idCliente");
               $sql3->bindParam(':idCliente', $idCliente);
                $sql3->execute();

                
                 $sql13 = Conexion::conectar()->prepare("SELECT MAX(idCuentaCorriente)AS id FROM cuentacorriente 
                  WHERE idCliente = :idCliente");
               $sql13->bindParam(':idCliente', $idCliente);
               $sql13->execute();
                $resu= $sql13->fetch();
                 $id =  $resu['id'];
  
               $sql11 = Conexion::conectar()->prepare("UPDATE cuentacorriente 
                SET saldo= (SELECT saldoActual FROM saldos WHERE idCliente=$idCliente)  WHERE idCliente=:idCliente AND idCuentaCorriente = :id " );
              $sql11->bindParam(':idCliente', $idCliente);
              $sql11->bindParam(':id', $id);
            
              $sql11->execute();
              
              
                return 'success';
              }else{
              return 'errorers';
            }
               $sql->close();
    }
       
       
           



     }
