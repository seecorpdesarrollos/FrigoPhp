<?php 
date_default_timezone_set('America/Argentina/Buenos_Aires');
  

// Controllers
require_once 'controllers/enlacesController.php';
require_once 'controllers/admin/adminController.php';





// Models
require_once 'models/enlacesModel.php';
require_once 'models/admin/adminModel.php';




$mvc = new EnlacesControllers;
$mvc->plantilla();
