<div class="container mt-2">
    <section class="dark-grey-text">
        <h2 class="text-center font-weight-bold">Editar actividades.</h2>

        <!-- Tabla donde mostramos las clases con su información -->
        <table class="table table-hover mt-3">
            <thead class="text-center">
                <tr>
                    <th class="th-sm">Foto</th>
                    <th class="th-sm">Clase</th>
                    <th class="th-sm">Descripción</th>
                    <th class="th-sm">Editar/Eliminar</th>
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
                        <td><strong class="text-primary font-weight-bold h5"><?= $d["nombre"] ?></strong></td>
                        <td><strong class="font-weight-bold"><?= $d["descripcion"] ?></strong></td>
                        <td><a href="?controller=index&accion=editClase&id=<?= $d['id']?>"><i class="fas fa-user-edit"></i> Editar</a><br>
                            <a href="?controller=index&accion=delClase&id=<?= $d['id']?>"><i class="fas fa-trash-alt"></i> Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>

    </section>
    <!--Section: Content-->


</div>