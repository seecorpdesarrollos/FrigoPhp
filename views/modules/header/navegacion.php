<?php  

 $estado = AdminController::getAdminControllerActivo();
      $ip = $_SERVER['REMOTE_ADDR'];
     // echo $ip;
   foreach ($estado as $value) {
       // echo $value['TOTAL'];
       if ($value['TOTAL'] == 0) {
          header('location:http://localhost:4200/#/login');
       }
       // echo $value['ip'];
       if ($value['ip'] != $ip) {
            header('location:http://localhost:4200/#/login');
       }
   }


 ?>
 <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="assets/img/logo.jpg" alt="..." class="img-fluid "></div>
                <div class="title">          
                        <!--  -->
                  <h1 class="h4">Sistema</h1>

                  <p> Versión : 1.0</p>
                  <small class="text-warning">Sistema de Gestión</small>
                </div>
          </div>
          <span class="heading text-info">Menu Principal</span>
  <ul class="list-unstyled">
            <li routerLinkActive="active"><a href="http://localhost:4200/#/principal"> <i class="icon-home"></i>Principal </a></li>
            <li routerLinkActive="active"><a href="http://localhost:4200/#/productos"> <i class="icon-grid"></i>Productos </a></li>
            <li routerLinkActive="active"><a href="http://localhost:4200/#/inventario"> <i class="icon-list"></i>Inventario </a></li>
            <li id="ventas" class=""><a href="ventas"> <i class="fa fa-bar-chart"></i>Ventas </a></li>
            <li id="reportesVentas" class=""><a href="reportesVentas"> <i class="icon-padnote"></i>Reportes Ventas </a></li>
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
            <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li>
  </ul><span class="heading text-info">Menu Secundario</span>
          <ul class="list-unstyled">
            <li> <a href="http://localhost:4200/#/clientes"> <i class="icon-flask"></i>Clientes </a></li>
            <li> <a href="http://localhost:4200/#/vendedores"> <i class="icon-screen"></i>Vendedores </a></li>
            <li> <a href="#"> <i class="icon-mail"></i>Demo </a></li>
            <li> <a href="#"> <i class="icon-picture"></i>Demo </a></li>
          </ul>
        </nav>
         