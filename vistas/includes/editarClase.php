<div class="container" >

    <?php if (isset($mensajes)) {
          foreach ($mensajes as $mensaje) : ?> 
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach;
    }?>

    <!-- Default form register -->
    <form class="text-center border border-light pt-3" action="?controller=index&accion=editarClase&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">

        <p class="h4 mb-4">Editar información de la clase.</p>

        <!-- Nombre -->
        <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4" placeholder="Nombre" name="txtnombre" value="<?= $datos[0]['nombre']?>">

        <!-- Descripcion -->
        <div class="form-group">
            <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" name="txtdescripcion" rows="6" placeholder="Descripcion"><?= $datos[0]['descripcion']?></textarea>
        </div>   


        <!-- Imagen -->
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="imagen">
            <label class="custom-file-label" for="customFileLang"><?= $datos[0]['Imagen']?></label>
        </div>

        <!-- Sign up button -->
        <button class="btn btn-info my-4" type="submit" name="submit">Actualizar</button>

    </form>
    <!-- Default form register -->
</div>