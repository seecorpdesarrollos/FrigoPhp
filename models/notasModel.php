<?php 

  require_once 'conexion.php';

  class NotasModel{

  	     public function getNotasCreditoModel($table){


   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN clientes cli ON ta.idCliente = cli.idCliente ORDER BY idNotaCredito DESC");

   	   	    if ($sql->execute()) {
   	   	    	 return $sql->fetchAll();

   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }


         public function addNotasCreditoModel(
              $descripcionCredito,
              $cantidadCredito,
              $importeCredito,   
              $idCliente,
               $tabla){

          // comprobamos que tenga saldo para realizar nota de credito
          
              $sql13 = Conexion::conectar()->prepare("SELECT saldoInicial AS saldo FROM saldos 
                  WHERE idCliente = :idCliente");
               $sql13->bindParam(':idCliente', $idCliente);
               $sql13->execute();
                $resu= $sql13->fetch();
                 $saldo =  $resu['saldo'];

                 if($saldo <=0){
                   return 'noSaldo';
                 }else{

          
                $totalCredito = $cantidadCredito * $importeCredito;
              $sql = Conexion::conectar()->prepare("INSERT INTO $tabla( descripcionCredito, cantidadCredito, importeCredito, totalCredito ,  idCliente)
                VALUES(:descripcionCredito, :cantidadCredito , :importeCredito,:totalCredito, :idCliente)");
                $sql->bindParam(':descripcionCredito', $descripcionCredito);
                $sql->bindParam(':cantidadCredito', $cantidadCredito);
                $sql->bindParam(':importeCredito', $importeCredito);
                $sql->bindParam(':totalCredito', $totalCredito);
                $sql->bindParam(':idCliente', $idCliente);
               
                if ($sql->execute()) {
     
                 $sql3 = Conexion::conectar()->prepare("UPDATE  saldos SET  saldoActual= saldoActual- $totalCredito, saldoFinal= saldoFinal-  $totalCredito   WHERE idCliente = :idCliente");
                 $sql3->bindParam(':idCliente', $idCliente);
                  $sql3->execute();




              $sql41 = Conexion::conectar()->prepare("INSERT INTO cuentacorriente(comprobante,
               pagos,  idCliente, fecha)
                VALUES(:comprobante, :pagos , :idCliente,:fecha)");
                $hoy = date('y-m-d');
                $comprobante = 1;
                $sql41->bindParam(':comprobante',  $comprobante );
                $sql41->bindParam(':pagos', $totalCredito);
                $sql41->bindParam(':idCliente', $idCliente);
                $sql41->bindParam(':fecha', $hoy);
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
                 
                   $sql131 = Conexion::conectar()->prepare("SELECT MAX(idNotaCredito)AS idNotaCredito FROM notacredito 
                    WHERE idCliente = :idCliente");
                 $sql131->bindParam(':idCliente', $idCliente);
                 $sql131->execute();
                  $resu1= $sql131->fetch();
                   $idNotaCredito = 'Nota de Crédito' . ' ' . $resu1['idNotaCredito'];
                  $nroNotaCredito=$resu1['idNotaCredito'];
                    $sql111 = Conexion::conectar()->prepare("UPDATE cuentacorriente 
                   SET comprobante=  :idNotaCredito , nroNotaCredito=:nroNotaCredito 
                   WHERE idCliente=:idCliente AND idCuentaCorriente = :id");
                $sql111->bindParam(':idCliente', $idCliente);
                $sql111->bindParam(':idNotaCredito', $idNotaCredito);
                $sql111->bindParam(':nroNotaCredito', $nroNotaCredito);
               $sql111->bindParam(':id', $id);
                 $sql111->execute();
            
                  return 'success';
                }else{
                return 'errorers';
              }
                 $sql->close();

                 }

    }



         public function deleteNotasCreditoModel(
              $idNotaCredito,                 
              $idCliente,
              $totalCredito,   
               $tabla){

      
              $sql = Conexion::conectar()->prepare("DELETE FROM  cuentacorriente WHERE nroNotaCredito=:idNotaCredito");
                $sql->bindParam(':idNotaCredito', $idNotaCredito);
               
                if ($sql->execute()) {
                   $sql3 = Conexion::conectar()->prepare("DELETE FROM  $tabla WHERE idNotaCredito=:idNotaCredito");
                  $sql3->bindParam(':idNotaCredito', $idNotaCredito);
                  $sql3->execute();
               

                 $sql11 = Conexion::conectar()->prepare("UPDATE saldos 
                   SET saldoActual=saldoActual+ $totalCredito, saldoFinal=saldoFinal+$totalCredito 
                   WHERE idCliente=:idCliente");
                $sql11->bindParam(':idCliente', $idCliente);
                 $sql11->execute();

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
                return 'error al eliminar nota de credito';
              }
                 $sql->close();

               

    }







}