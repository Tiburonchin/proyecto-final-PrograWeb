<div class="container">

  <section class="dark-grey-text text-center">
    <h2 class="font-weight-bold mt-4">Bienvenido <?php echo "" . ucfirst($_SESSION['usuario']) . ""  ?></h2>
    <h4 class="font-weight mt-2">Estás conectado como <strong class="bold text-warning">Administrador. </strong> </h4>
  </section>

  <div class="row justify-content-md-center pt-4">

    <div class="col-sm-5">
      <p class="font-weight-bold h5">Debes de comprobar si hay usuarios esperando la validación.</p>
      <p class="font-italic">No se debe tardar más de 48 Horas en <strong class="bold"> activar </strong> a un usuario.</p>

      <div class="text-center">
        <a class="btn btn-warning mx-auto " href="?controller=Admin&accion=listaUsuariosNoValidados"> <strong class="bold"> ACTIVAR USUARIOS NUEVOS</strong> </a>
      </div>

    </div>

    <div class="col-sm-5">

      <p class="font-weight-bold text-center h5">El horario es semanal</p>
      <p class="font-italic text-center">Si deseás modificar el horario...</p>

      <div class="text-center">
        <a class="btn btn-danger mx-auto" href="?controller=index&accion=editarHorario"> Modificar horario</a>
        <a class="btn btn-primary mx-auto" href="?controller=index&accion=insertClaseExistente">Añadir clase al horario</a>
      </div>

    </div>

  </div>

</div>