<div class="container-fluid mt-3 px-5">
  <H2 class="text-center pb-1">Lista de usuarios sin validar.</H2>
  <!--Mostramos los mensajes que se hayan generado al realizar el listado-->

  <?php if (isset($mensajes)) {
    foreach ($mensajes as $mensaje) : ?>
      <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
  <?php endforeach;
  } ?>

  <table id="dtBasicExample" class="table table-sm table-striped table-bordered table-dark table-hover">
    <thead class="text-center">
      <tr>
        <th class="th-sm">ID</th>
        <th class="th-sm">@Usuario</th>
        <th class="th-sm">Nombre</th>
        <th class="th-sm">Primer apellido</th>
        <th class="th-sm">Segundo apellido</th>
        <th class="th-sm">DNI</th>
        <th class="th-sm">E-Mail</th>
        <th class="th-sm">Teléfono</th>
        <th class="th-sm">Dirección</th>
        <th class="th-sm">Imagen</th>
        <th class="th-sm text-center">Activar</th>
        <th class="th-sm text-center bg-danger">Activar Admin</th>
        <th class="th-sm text-center">Borrar usuario</th>
      </tr>
    </thead>
    <tbody class="text-center">

      <?php foreach ($datos as $d) : ?>
        <!--Mostramos cada registro en una fila de la tabla-->
        <tr>
          <td><?= $d["id"] ?></td>
          <td><?= $d["usuario"] ?></td>
          <td><?= $d["nombre"] ?></td>
          <td><?= $d["apellido1"] ?></td>
          <td><?= $d["apellido2"] ?></td>
          <td><?= $d["nif"] ?></td>
          <td><?= $d["email"] ?></td>
          <td><?= $d["telefono"] ?></td>
          <td><?= $d["direccion"] ?></td>

          <?php if ($d["imagen"] !== NULL) : ?>
            <td><img src="fotos/<?= $d['imagen'] ?>" width="40" /></td>
          <?php else : ?>
            <td>Sin</td>
          <?php endif; ?>
          <!-- BOTONERA -->
          <td class="text-center"><a href="?controller=user&accion=actualizaruser&id=<?= $d['id'] ?>&rol_id=1"><button type="button" class="btn btn-primary">Activar</button><i class="fas fa-check"></i></a></td>
          <td class="text-center"><a href="?controller=user&accion=actualizaruser&id=<?= $d['id'] ?>&rol_id=0"><button class="btn btn-danger">ADMIN</button><i class="fas fa-user-shield"></i></a></td>
          <td class="text-center"><a href="?controller=user&accion=deluser&id=<?= $d['id'] ?>"><button class="btn btn-warning">Borrar</button> <i class="fas fa-trash-alt"></i></a></td>
        </tr>
      <?php endforeach; ?>
  </table>
</div>