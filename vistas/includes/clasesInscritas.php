<div class="container-fluid mt-3 px-5">
<H2 class="text-center pb-1">Tus actividades inscritas</H2>
<!--Mostramos los mensajes que se hayan generado al realizar el listado-->

<?php if (isset($mensajes)) {
   foreach ($mensajes as $mensaje) : ?> 
    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
<?php endforeach;
}?>

<table id="dtBasicExample" class="table table-sm table-striped table-bordered table-dark table-hover" >
  <thead class="text-center">
    <tr>
      <th class="th-sm">Dia</th>
      <th class="th-sm">Clase</th>
      <th class="th-sm">Hora Inicio</th>
      <th class="th-sm">Hora Fin</th>
      <th class="th-sm">Eliminar</tr>
  </thead>
  <tbody class="text-center">

  <?php foreach ($datos as $d) :?>
      
          <!--Mostramos cada registro en una fila de la tabla-->
          <tr>
            <td><strong class="font-weight-bold"><?= $d["Dia"] ?></strong></td>
            <td><strong class="font-weight-bold text-success"><?= $d["nombre"]?></strong></td>
            <td><strong class="font-weight-bold"><?= $d["horaInicio"] ?></strong></td>
            <td><strong class="font-weight-bold"><?= $d["horaFin"] ?></strong></td>

            <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
            <td><a href="?controller=index&accion=borrarInscripcion&id=<?= $d['id'] ?>"><button class="btn btn-danger"> Eliminar</button></a></td>
          </tr>
    <?php endforeach; ?>

</table>
</div>
