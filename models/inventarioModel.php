<?php 

  require_once 'conexion.php';

  class InventarioModel{

  	     public function getInventarioModel($table){


   	   	    $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN productos pro ON ta.nroTropa = pro.nroTropa WHERE cantidad =1 ORDER BY idInventario DESC");

   	   	    if ($sql->execute()) {
   	   	    	 return $sql->fetchAll();

   	   	    }else{
   	   	    	return 'error';
   	   	    }
            $sql->close();
   	   }

             public function getInventariototalesModel($table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN productos pro ON ta.nroTropa = pro.nroTropa   ORDER BY idInventario DESC");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

                   public function getCuarteoModel($table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN productos pro ON ta.nroTropa = pro.nroTropa ORDER BY idCuarteo DESC ");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

     public function getFacturasModel($table){


            $sql = Conexion::conectar()->prepare("SELECT MAX(idFactura) AS total FROM $table ");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

          public function getDetallesModel($table){


            $sql = Conexion::conectar()->prepare("SELECT  *  FROM $table de  
              JOIN clientes cli ON cli.idCliente=de.idCliente 
              ORDER BY idFacturado DESC
             ");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

          public function getTemporalModel($table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table  ");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }


          public function getTemporal1Model($table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table  ");

            if ($sql->execute()) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }

         public function getCuarteoInventarioModel($table){


            $sql = Conexion::conectar()->prepare("SELECT * FROM $table ta 
              JOIN cuarteo pro ON ta.idCuarteo = pro.idCuarteo WHERE cantidad!= 0 ");

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


          public function getDetallesFacturasModel($nroFactura, $table){


            $sql = Conexion::conectar()->prepare("SELECT *   FROM $table ta 
              JOIN clientes cli ON ta.idCliente = cli.idCliente
              WHERE ta.nroFactura=:nroFactura ");

            if ($sql->execute( array(':nroFactura'=>$nroFactura))) {
               return $sql->fetchAll();

            }else{
              return 'error';
            }
            $sql->close();
       }


          public function masInfoCuarteoModel($idCuarteoInventario, $table){


            $sql = Conexion::conectar()->prepare("SELECT *   FROM $table ta 
              JOIN cuarteo pro ON ta.idCuarteo = pro.idCuarteo
              JOIN productos a ON a.nroTropa = pro.nroTropa
              WHERE idCuarteoInventario=:idCuarteoInventario");

            if ($sql->execute( array(':idCuarteoInventario'=>$idCuarteoInventario))) {
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


         public static function deleteCuarteoModel($idInventario, $tabla)
    {

        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idInventario = :idInventario");
        $sql->bindParam(':idInventario', $idInventario);

        if ($sql->execute()) {
           $sql1 = Conexion::conectar()->prepare("UPDATE  inventario SET 
                  cantidad= 1 , estado= 'Disponible' WHERE idInventario=:idInventario");
                    $sql1->bindParam(':idInventario', $idInventario);
                    $sql1->execute();
            return 'success';
        }
        $sql->close();
    }
// realizamos una venta a un cliente en particular.

            public static function ventasModel($idCliente, $nroFactura, $total, $idAdmin)
    {
  // insertamos el número de factura.
           $sql7 = Conexion::conectar()->prepare("INSERT INTO facturas(estado)VALUES(estado = 1)");
                
                if($sql7->execute()){
                  // actualizamos las tablas temporales.
                $sql = Conexion::conectar()->prepare("UPDATE temp SET idCliente=:idCliente, nroFactura=:nroFactura");
            $sql->bindParam(':idCliente', $idCliente);
            $sql->bindParam(':nroFactura',  $nroFactura);
            $sql->execute();
                  $sql1 = Conexion::conectar()->prepare("UPDATE tempmedia SET idCliente=:idCliente, nroFactura=:nroFactura");
              $sql1->bindParam(':idCliente', $idCliente);
              $sql1->bindParam(':nroFactura',  $nroFactura);
              $sql1->execute();

// insertamos lo de las tablas temporales a las de detalles correspondientes.
            $sql2 = Conexion::conectar()->prepare("INSERT INTO detalles(kilo,descripcion,cantidad,precio,fecha,nroFactura,idCuarteo,idCliente)
  SELECT tem.kiloMedia,tem.descripcion,tem.cantidad,tem.precioMedia,tem.fechaVenta,tem.nroFactura,tem.id,tem.idCliente FROM temp tem");
           $sql2->execute();



            $sql3 = Conexion::conectar()->prepare("INSERT INTO detalles(kilo,nroTropa, descripcion,cantidad,precio,fecha,nroFactura,idInventario,idCliente)
  SELECT temm.kilo,temm.nroTropa,temm.descripcionMedia,temm.cantidad,temm.precio,temm.fecha,temm.nroFactura,temm.idInventario,temm.idCliente FROM tempmedia temm");
          $sql3->execute();


     
         $hoy = date('y-m-d');

            $sql57 = Conexion::conectar()->prepare("INSERT INTO facturado(nroFactura,fecha, idCliente, totalVenta, idAdmin)
              VALUES(:nroFactura,:fecha,:idCliente,:totalVenta,:idAdmin)");
              $sql57->bindParam(':nroFactura', $nroFactura);
              $sql57->bindParam(':fecha', $hoy);
             $sql57->bindParam(':idCliente', $idCliente);
             $sql57->bindParam(':totalVenta', $total);
             $sql57->bindParam(':idAdmin', $idAdmin);
          $sql57->execute();

         $sql571 = Conexion::conectar()->prepare("INSERT INTO cuentacorriente(comprobante,entrada,idCliente, fecha)
              VALUES(:nroFactura,:totalVenta,:idCliente,:fecha)");
         $fa = 'Factura '. ' '. $nroFactura;
              $sql571->bindParam(':nroFactura', $fa);
             $sql571->bindParam(':totalVenta', $total);
             $sql571->bindParam(':idCliente', $idCliente);
             $sql571->bindParam(':fecha', $hoy);
          $sql571->execute();

             $sql1 = Conexion::conectar()->prepare("UPDATE saldos SET saldoActual= saldoActual + $total  WHERE idCliente=:idCliente " );
              $sql1->bindParam(':idCliente', $idCliente);
             
              $sql1->execute();


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

          // borramos las tablas temporales para la siguiente venta.
             $borrar = Conexion::conectar()->prepare("DELETE FROM temp");
             $borrar->execute();

            $borrar1 = Conexion::conectar()->prepare("DELETE FROM tempmedia");
            $borrar1->execute();
        

          }
  
    }


         public static function deleteCuarteoIdModel($idCuarteo, $tabla)
    {

        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idCuarteo = :idCuarteo");
        $sql->bindParam(':idCuarteo', $idCuarteo);

        if ($sql->execute()) {
           $sql1 = Conexion::conectar()->prepare("UPDATE  cuarteo SET 
                  estadoCuarteo= 1 WHERE idCuarteo=:idCuarteo");
                    $sql1->bindParam(':idCuarteo', $idCuarteo);
                    $sql1->execute();
            return 'success';
        }
        $sql->close();
    }


         public static function borrarTempModel($idTemp,$descripcion, $peso, $id , $tabla)
    {

        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idTemp = :idTemp");
        $sql->bindParam(':idTemp', $idTemp);

        if ($sql->execute()) {
           $sql1 = Conexion::conectar()->prepare("UPDATE  cuarteoinventario SET 
                  $descripcion= $peso , cantidad= cantidad+1 WHERE idCuarteo=:idCuarteo");
                    $sql1->bindParam(':idCuarteo', $id);
                    $sql1->execute();
            return 'success';
        }
        $sql->close();
    }

         public static function borrarTemp1Model($idInventario , $tabla)
    {

        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idInventario = :idInventario");
        $sql->bindParam(':idInventario', $idInventario);

        if ($sql->execute()) {
           $sql1 = Conexion::conectar()->prepare("UPDATE  inventario SET 
                cantidad= 1 , estado= 'Disponible' WHERE idInventario=:idInventario");
                    $sql1->bindParam(':idInventario', $idInventario);
                    $sql1->execute();
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




             public function addInventarioModel($kiloMedia,$nroTropa, $tabla){
              $sql1 = Conexion::conectar()->prepare("SELECT cantMedia FROM productos WHERE nroTropa = :nroTropa");
            if ($sql1->execute(array(':nroTropa'=>$nroTropa))) {
              $res= $sql1->fetch();
              $sql2 = Conexion::conectar()->prepare("SELECT * , COUNT(nroTropa) as totalesVentas FROM inventario WHERE nroTropa = :nroTropa");
              $sql2->execute(array(':nroTropa'=>$nroTropa));
               $res1= $sql2->fetch();
            }else{
              return 'error';
            }

             if ($res['cantMedia'] == $res1['totalesVentas']) {
               return 'no';
             }else{

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (kiloMedia,nroTropa)
                           VALUES(:kiloMedia,:nroTropa)");

              $sql->bindParam(':kiloMedia', $kiloMedia);
              $sql->bindParam(':nroTropa', $nroTropa);

              if ($sql->execute()) {
              	return 'success';
              }
             }

}

             public function temporalModel($pesoCuarto,
            $descripcion,$precio, $facturaNro, $idCuarto, $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (kiloMedia,descripcion,precioMedia,nroFactura,id)
                           VALUES(:kiloMedia,:descripcion,:precioMedia,:nroFactura,:idCuarto)");

              $sql->bindParam(':kiloMedia', $pesoCuarto);
              $sql->bindParam(':descripcion', $descripcion);
              $sql->bindParam(':precioMedia', $precio);
              $sql->bindParam(':nroFactura', $facturaNro);
              $sql->bindParam(':idCuarto', $idCuarto);

              if ($sql->execute()) {
                $sql1 = Conexion::conectar()->prepare("UPDATE  cuarteoinventario SET 
                  $descripcion= 0 , cantidad=cantidad-1 WHERE idCuarteo=:idCuarto");
                    $sql1->bindParam(':idCuarto', $idCuarto);
                    $sql1->execute();
                return 'success';
              }
            }


   public function temporal1Model($medias,$nroTropa,
           $precio, $facturaNro, $idInventario, $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (kilo,nroTropa,precio,nroFactura,idInventario)
                           VALUES(:kiloMedia,:nroTropa,:precioMedia,:nroFactura,:idInventario)");

              $sql->bindParam(':kiloMedia', $medias);
              $sql->bindParam(':nroTropa', $nroTropa);
              $sql->bindParam(':precioMedia', $precio);
              $sql->bindParam(':nroFactura', $facturaNro);
              $sql->bindParam(':idInventario', $idInventario);

              if ($sql->execute()) {
                $sql1 = Conexion::conectar()->prepare("UPDATE  inventario SET 
                  cantidad= 0 , estado= 'Vendida'  WHERE idInventario=:idInventario");
                    $sql1->bindParam(':idInventario', $idInventario);
                    $sql1->execute();
                return 'success';
              }
            }

            public function getTotalTempModel($tabla){
               
                $sql = Conexion::conectar()->prepare("SELECT *, SUM(kilomedia * preciomedia) AS total FROM $tabla");

            if ($sql->execute()) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
            }
                       public function getTotalTemp1Model($tabla){
               
                $sql = Conexion::conectar()->prepare("SELECT *, SUM(kilo * precio) AS total FROM $tabla");

            if ($sql->execute()) {
               return $sql->fetch();

            }else{
              return 'error';
            }
            $sql->close();
            }

                 public function addCuarteoModel($kiloMedia,$nroTropa,$idInventario, $tabla){

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (kiloMedia,nroTropa, idInventario)
                           VALUES(:kiloMedia,:nroTropa, :idInventario)");

              $sql->bindParam(':kiloMedia', $kiloMedia);
              $sql->bindParam(':nroTropa', $nroTropa);
              $sql->bindParam(':idInventario', $idInventario);

              if ($sql->execute()) {
                  $sql1 = Conexion::conectar()->prepare("UPDATE  inventario SET 
                  cantidad= 0 , estado= 'Cuarteo' WHERE idInventario=:idInventario");
                    $sql1->bindParam(':idInventario', $idInventario);
                    $sql1->execute();
                return 'success';
              }


         }

           public function addInventarioCuarteoModel(
                                                       $pecho, 
                                                       $mocho, 
                                                       $parrillero,
                                                       $completos,
                                                       $largos,
                                                       $bifes,
                                                       $asado,
                                                      $totalPeso,
                                                       $idCuarteo, 
                                                       $tabla){
            $cantidad = 0;
            if ($pecho != 0) {
              $cantidad = $cantidad + 1;
            } 
             if($mocho != 0){
              $cantidad = $cantidad + 1;   
            }
             if($parrillero != 0){
              $cantidad = $cantidad + 1;  
            } 
             if($completos != 0){
              $cantidad = $cantidad + 1;  
            } 
             if($largos != 0){
              $cantidad = $cantidad + 1;  
            }  
             if($bifes != 0){
              $cantidad = $cantidad + 1;  
            }  
             if($asado != 0){
              $cantidad = $cantidad + 1;  
            }     

                       

               $sql = Conexion::conectar()->prepare("INSERT INTO $tabla
                (pecho,mocho, parrillero, completos,largos,bifes,asado,totalPeso,cantidad ,  idCuarteo)
                           VALUES(:pecho,:mocho, :parrillero,:completos,:largos,:bifes,:asado,:totalPeso,:cantidad,:idCuarteo)");

              $sql->bindParam(':pecho', $pecho);
              $sql->bindParam(':mocho', $mocho);
              $sql->bindParam(':parrillero', $parrillero);
              $sql->bindParam(':completos', $completos);
              $sql->bindParam(':largos', $largos);
              $sql->bindParam(':bifes', $bifes);
              $sql->bindParam(':asado', $asado);
              $sql->bindParam(':totalPeso', $totalPeso);
              $sql->bindParam(':cantidad', $cantidad);
              $sql->bindParam(':idCuarteo', $idCuarteo);

              if ($sql->execute()) {
                  $sql1 = Conexion::conectar()->prepare("UPDATE  cuarteo SET 
                  estadoCuarteo = 0 WHERE idCuarteo=$idCuarteo");
                    // $sql1->bindParam(':idCuarteo', $idCuarteo);
                    $sql1->execute();
                return $cantidad;
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
            $res = $sql->fetch();
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