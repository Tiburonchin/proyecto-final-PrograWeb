<div class="container">
    <!-- <?php if (isset($mensajes)) { ?> 
        <div class="alert alert-info"><?= $mensajes ?></div>
    <?php }; ?> -->
    <!-- Default form register -->
    <form class="text-center border border-light pt-3" action="?controller=index&accion=insertarClaseExistente" method="post" enctype="multipart/form-data">

        <p class="h4 mb-4">Añade una clase al horario.</p>

        <div class="row">
            <div class="col">
                <!-- idClase -->
                <select class="browser-default custom-select form-control mb-4" name="txtidclase">
                    <?php if (isset($clases)) {
                        foreach ($clases as $clase) : ?>
                            <option selected value="<?php echo $clase['id'] ?>"><?php echo $clase['nombre'] ?></option>
                    <?php endforeach;
                    } ?>
                    <option selected value="-">Actividad</option>
                </select>

                <!-- horaInicio -->
                <select class="browser-default custom-select form-control mb-4" name="txtHoraInicio">
                    <?php if (isset($horario)) {
                        foreach ($horario as $hora) : ?>
                            <option selected value="<?php echo $hora ?>"><?php echo $hora ?></option>
                    <?php endforeach;
                    } ?>
                    <option selected value="-">Inicio</option>
                </select>

            </div>

            <div class="col">

                <!-- Dia -->
                <select class="browser-default custom-select form-control mb-4" name="txtDia">
                    <option selected value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sabado">Sabado</option>
                </select>

                <!-- horaFin -->
                <select class="browser-default custom-select form-control mb-4" name="txtHoraFin">
                    <?php if (isset($horario)) {
                        foreach ($horario as $hora) : ?>
                            <option selected value="<?php echo $hora ?>"><?php echo $hora ?></option>
                    <?php endforeach;
                    } ?>
                    <option selected value="-">Fin</option>
                </select>

            </div>
        </div>
        <!-- Sign up button -->
        <button class="btn btn-info" type="submit" name="submit">Actualizar</button>
    </form>
    <!-- Default form register -->

</div>