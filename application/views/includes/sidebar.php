   <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
   <!--sidebar start-->
   <aside>
       <div id="sidebar" class="nav-collapse ">
           <!-- sidebar menu start-->
           <ul class="sidebar-menu" id="nav-accordion">

               <p class="centered"><a href="profile.html"><img src="<?= base_url() ?>assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
               <h5 class="centered">
                   <?php
                    if (isset($_SESSION['nombre']) && isset($_SESSION['apellidos'])) {
                        echo $_SESSION['nombre'] . " " . $_SESSION['apellidos'];
                    }
                    ?>
               </h5>
               <li class="sub-menu">
                   <a href="<?php base_url() ?>">
                       <i class="fa fa-dashboard"></i>
                       <span>Dashboard</span>

                   </a>
               </li>

               <?php
                if ($_SESSION['tipo'] == "profesor") {
                ?>
                   <li class="sub-menu">
                       <a href="<?php base_url() ?>gestionAlumnos">
                           <i class="fa fa-th"></i>
                           <span>Gestion de Alumnos</span>
                       </a>

                   </li>

                   <li class="sub-menu">
                       <a href="<?php base_url() ?>crearTareas">
                           <i class="fa fa-desktop"></i>
                           <span>Crear Tareas</span>
                       </a>

                   </li>
               <?php
                }
                ?>
               <li class="sub-menu">
                   <a href="<?php base_url() ?>misTareas">
                       <i class="fa fa-book"></i>
                       <span>Mis Tareas</span>
                   </a>
               </li>
               <li class="sub-menu">
                   <a href="<?php base_url() ?>mensajes">
                       <i class="fa fa-tasks"></i>
                       <span>Mensajes</span>
                   </a>

               </li>

           </ul>
           <!-- sidebar menu end-->
       </div>
   </aside>
   <!--sidebar end-->