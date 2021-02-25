<body>
    <form action="?controller=User&accion=adduser" id="login" method="post">
        <img class="rounded mx-auto d-block" src="images/logo-gimnasio_24016-140.jpg" width="250">

        <?php if (isset($mensajes)) {
            foreach ($mensajes as $mensaje) : ?>
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
        } ?>

        <h1 class="h3 mb-3 font-weight-normal text-center">Registro en nuestra plataforma</h1>

        <div class="form-row justify-content-md-center mx-5 px-5">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Usuario</label>
                <input type="text" name="txtusuario" class="form-control my-2" placeholder="Usuario" required autofocus>
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4">Contraseña</label>
                <input type="password" name="txtpassword" id="inputPassword" class="form-control my-2" placeholder="Password" required>
            </div>
        </div>

        <div class="form-row justify-content-md-center mx-5 px-5">

            <div class="form-group col-md-2">
                <label for="inputEmail4">Nombre</label>
                <input type="text" name="txtnombre" class="form-control my-2" placeholder="Nombre" required autofocus>
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Primer Apellido</label>
                <input type="text" name="txtapellido1" class="form-control my-2" placeholder="Primer Apellido" required autofocus>
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4">Segundo Apellido</label>
                <input type="text" name="txtapellido2" class="form-control my-2" placeholder="Segundo Apellido" required autofocus>
            </div>

        </div>

        <div class="form-row justify-content-md-center mx-5 px-5">

            <div class="form-group col-md-4">
                <label for="inputEmail4">Dirreción</label>
                <input type="text" name="txtdireccion"  class="form-control my-2" placeholder="Dirreción" required autofocus>
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4">DNI</label>
                <input type="text" name="txtdni" class="form-control my-2" placeholder="DNI" required autofocus>
            </div>
        </div>

        <div class="form-row justify-content-md-center mx-5 px-5">

            <div class="form-group col-md-4">
                <label for="inputEmail4">Correo electronico</label>
                <input type="email" name="txtemail" class="form-control my-2" placeholder="Email" required autofocus>
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4">Telefono</label>
                <input type="number" name="txttelefono" class="form-control my-2" placeholder="Email" required autofocus>
            </div>

        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit" name="submit">Crear cuenta</button>
            <h5 class="mt-2"><a class="text-center" href="?controller=Home&accion=index">Volver al Login</a></h5>
            <p class="mt-5 mb-3 text-muted">&copy; 2020-2021 <br> José Manuel Urbano Moreno </p>
        </div>
    </form>


</body>