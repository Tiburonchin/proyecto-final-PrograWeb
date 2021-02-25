<body class="text-center">
  <div class="row justify-content-center h-100">
    <form class="form-signin" action="?controller=Login&accion=inUser" id="login" method="post">
      <img src="img/logo-gimnasio_24016-140.jpg" width="250">
      <?php if (isset($mensajes)) {
        foreach ($mensajes as $mensaje) : ?>
          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
      <?php endforeach;
      } ?>
      <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>

      <!-- input para el usuario -->
      <input type="text" name="txtusuario" class="form-control" placeholder="Usuario" required autofocus>
      <!-- input para la contraseña -->
      <input type="password" name="txtpassword" id="inputPassword" class="form-control mt-2" placeholder="Password" required>
      <!-- Para recordar -->
      <div class="checkbox mb-3">
        <label class="mt-2">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Entrar</button>
      <h4 class="mt-2">¿No tienes cuenta? <a href="?controller=Index&accion=registro">Registrarse.</a></h4>

      <p class="mt-5 mb-3 text-muted">&copy;2020-2021 <br> José Manuel Urbano Moreno </p>
    </form>
  </div>

</body>