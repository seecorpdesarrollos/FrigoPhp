<?php require 'modules/header/header.php'; ?>

  <body>
    <div class="page">
      <!-- Main Navbar-->
       <?php require 'modules/header/menu.php'; ?>

      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
          <?php require 'modules/header/navegacion.php'; ?>

        <div class="content-inner">
          <!-- Page Header-->
            <?php 
            $template = new EnlacesControllers;
            $template->enlacesPaginasController();
             ?>
          
        <?php  require 'modules/header/footer.php'; ?>