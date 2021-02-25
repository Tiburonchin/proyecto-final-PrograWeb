<div class="container">

  <section class="dark-grey-text text-center">
    <h2 class="font-weight-bold mt-4">Bienvenido <?php echo "" . ucfirst($_SESSION['usuario']) . ""  ?></h2>
    <h4 class="font-weight mt-2">Estás conectado como <strong class="bold text-info">Usuario. </strong> </h4>
  </section>

  <div class="row justify-content-md-center pt-4">

    <div class="col-sm-6">
      <p class="font-weight-bold h5">Comprueba las actividades disponibles en nuestro Gym</p>
      <p class="bold text-center">No te olvides de revisarlo.</p>

      <div class="text-center">
        <a class="btn btn-success mx-auto " href="?controller=index&accion=verActividades"> <strong class="bold">Ver TODAS las actividades</strong> </a>
      </div>

    </div>

    <div class="col-sm-6">
      <p class="font-weight-bold h5">Si deseas apuntarte a una actividad de esta semana comprueba el horario</p>
      <p class="font-italic">Cada semana el horario se renueva.</p>
      <p class="bold text-center"><strong> No te olvides de revisarlo.</strong> </p>

      <div class="text-center">
        <a class="btn btn-primary mx-auto " href="?controller=index&accion=listarhorario"> <strong class="bold">Visualizar horario.</strong> </a>
      </div>
    </div>

  </div>

</div>