<div class="container-fluid mt-3 px-5">
  <H2 class="text-center pb-1">Listado de los usuarios de la base de datos.</H2>
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
        <th class="th-sm">Rol</th>
        <th class="th-sm">Imagen</th>
        <th class="th-sm">Editar</th>
        <th class="th-sm">Eliminar</th>

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

          <?php if ($d["rol_id"] == 0) : ?>
            <td><strong class="text-success text-bold">Administrador</strong></td>
          <?php elseif ($d["rol_id"] == 1) : ?>
            <td><strong class="text-primary text-bold">Activado</strong></td>
          <?php elseif ($d["rol_id"] == 2) : ?>
            <td><strong class="text-danger text-bold">Por validar</strong></td>
          <?php endif; ?>

          <?php if ($d["imagen"] !== NULL) : ?>
            <td><img src="fotos/<?= $d['imagen'] ?>" width="80" /></td>
          <?php else : ?>
            <td>Sin</td>
          <?php endif; ?>

          <!-- BOTONES DE ACCIÓN -->
          <td>
            <a href="?controller=Admin&accion=editarUsuario&usuario=<?= $d['usuario'] ?>"><button type="button" class="btn btn-primary">Editar</button></a>
          </td>
          <td>
            <a href="?controller=user&accion=deluser&id=<?= $d['id'] ?>&vista=1"><button type="button" class="btn btn-danger">Eliminar</button></a>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
</div>