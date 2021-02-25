<div class="container">
  <section class="dark-grey-text">

    <h2 class="text-center font-weight-bold my-2">Las diferentes clases</h2>
    <p class="text-center mx-auto w-responsive mb-2">Un pequeño resumen de lo que encontrarás.</p>

    <!-- Tabla donde mostramos las clases con su información -->
    <table class="table table-striped table-hover">
      <thead class="text-center">
        <tr>
          <th class="th-sm">Foto</th>
          <th class="th-sm">Clase</th>
          <th class="th-sm">Descripción</th>
        </tr>
      </thead>
      <tbody>

        <?php if (isset($datos)) foreach ($datos as $d) : ?>
          <!--Mostramos cada registro en una fila de la tabla-->
          <tr>
            <?php if ($d["Imagen"] !== NULL) : ?>
              <td><img src="img/clases/<?= $d['Imagen'] ?>" width="200" /></td>
            <?php else : ?>
              <td>----</td>
            <?php endif; ?>
            <td class="text-center"> <strong class="text-primary font-weight-bold h5"><?= $d["nombre"] ?></strong></td>
            <td> <strong class="font-weight-bold"> <?= $d["descripcion"] ?></strong></td>
          </tr>
        <?php endforeach; ?>
    </table>
</div>