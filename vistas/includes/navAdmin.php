<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="?controller=Admin&accion=inicio">Gimnasio</a>

  <div class="collapse navbar-collapse">
    <!-- Dropdown -->
    <li class="navbar-nav dropdown mr-1">
      <a class="nav-link dropdown-toggle" href="?controller=Admin&accion=listaUsuariosNoValidados" id="navbardrop" data-toggle="dropdown">
        Horario
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="?controller=index&accion=insertClaseExistente">Insertar nueva actividad</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="?controller=index&accion=editarHorario">Eliminar actividad existente</a>
      </div>
    </li>

    <li class="navbar-nav dropdown mr-1">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Clases
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="?controller=index&accion=verActividades">Listar</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="?controller=index&accion=insertClase">Insertar</a>
      </div>
    </li>

    <li class="navbar-nav dropdown mr-auto">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Usuarios
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="?controller=Admin&accion=listaUsuarios">Listar</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="?controller=Admin&accion=listaUsuariosNoValidados">No validados</a>
      </div>
    </li>


    <li class="navbar-nav dropdown mr-5">
      <i class="navbar font-weight-bold text-warning">Administrador</i>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo "" . ucfirst($_SESSION['usuario']) . ""  ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="?controller=User&accion=EditarPerfil">Editar perfil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="?controller=User&accion=cerrarSesion">Cerrar sesión</a>
      </div>
    </li>

  </div>
</nav>