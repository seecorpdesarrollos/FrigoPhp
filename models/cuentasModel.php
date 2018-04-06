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
         public function getPagosModel($table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN clientes cli ON cli.idCliente= ta.idCliente
              ORDER BY ta.fechaPago  DESC");

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



         public function getEntradaModelId($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(entrada) AS totalEntrada  FROM $table  WHERE idCliente = :idCliente AND estado = 1");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'errors';
            }
            $sql->close();
       }



         public function getSalidaModelId($idCliente, $table){

            $sql = Conexion::conectar()->prepare("SELECT SUM(pagos) AS totalSalida  FROM $table  WHERE idCliente = :idCliente AND estado = 1");

            if ($sql->execute( array(':idCliente'=>$idCliente))) {
               return $sql->fetch();

            }else{
              return 'errors';
            }
            $sql->close();
       }
         public function getTodoModelId($idCliente, $fechaInicial, $fechaFinal,  $table){

            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
             LEFT JOIN clientes cli ON cli.idCliente= ta.idCliente
             LEFT JOIN vendedores ve ON ta.idVendedor= ve.idVendedor 
              WHERE ta.idCliente = :idCliente AND ta.estado = 1 AND ta.fecha 
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
              $propietario, $tabla){

           $sql1 = Conexion::conectar()->prepare("SELECT idCliente FROM deudas WHERE idCliente= :idCliente");
           $sql1->execute(array(':idCliente'=>$idCliente));
           $result= $sql1->fetch();
 
                  if ($result == "") {
                     return 'noCliente';
                  }else{

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
              
                 $sql1 = Conexion::conectar()->prepare("SELECT SUM(montoDeuda)AS suma,idVendedor FROM deudas 
                  WHERE idCliente = :idCliente");
               $sql1->bindParam(':idCliente', $idCliente);
               $sql1->execute();
              $res= $sql1->fetch();
                 $saldo =  $res['suma'] - $monto;
                 $ven =  $res['idVendedor'];
              
               $sql3 = Conexion::conectar()->prepare("UPDATE  saldos SET  saldoActual=  $saldo, saldoFinal=  $saldo , 
               idVendedor=$ven WHERE idCliente = :idCliente");
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
              $sql41->bindParam(':idVendedor', $ven);
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
            $sql4 = Conexion::conectar()->prepare("DELETE FROM  deudas WHERE idCliente = :idCliente");
               $sql4->bindParam(':idCliente', $idCliente);
                $sql4->execute();

                return 'success';
              }else{
              return 'errorers';
            }
               $sql->close();



       }
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

//     SELECT DISTINCt *
// FROM saldos ta
// JOIN clientes cli ON cli.idCliente= ta.idCliente
// JOIN facturado fa on fa.idCliente= ta.idCliente
// join pagos pa on pa.idCliente= fa.idCliente
// WHERE ta.idCliente=1 and fa.estado=0
