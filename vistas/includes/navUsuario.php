<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="?controller=User&accion=inicio">Gimnasio</a>

  <div class="collapse navbar-collapse">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="?controller=index&accion=verActividades">Ver actividades<span class="sr-only"></span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?controller=index&accion=listarhorario">Horario<span class="sr-only"></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?controller=index&accion=listarInscripciones">Actividades inscritas<span class="sr-only"></a>
      </li>
    </ul>

    <li class="navbar-nav dropdown mr-5">
      <i class="navbar font-weight-bold text-success">Usuario</i>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo "" . ucfirst($_SESSION['usuario']) . ""  ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="?controller=User&accion=editarPerfil">Editar perfil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="?controller=User&accion=cerrarSesion">Cerrar sesión</a>
      </div>
    </li>

  </div>
</nav>