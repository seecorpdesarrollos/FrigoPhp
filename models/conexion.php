<?php 
date_default_timezone_set('America/Argentina/Buenos_Aires');
    class Conexion{
    	static public  function conectar(){
    	 try {
            $conexion = new PDO('mysql:host=localhost;dbname=frigorifico', 'root', 
            	'');
            $conexion->exec('SET CHARACTER SET ut8');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;

        } catch (Exception $e) {
            echo "Error de Conexion" . $e->getMessage();
            echo "Error de Conexion" . $e->getLine();
        }

    		// $conexion= new PDO('mysql:host=localhost;dbname=frigorifico', 'root', '');
    		// $conexion->exec('SET CHARACTER SET UTF8');
    		//  return $conexion;
    	}
    }


 ?>
