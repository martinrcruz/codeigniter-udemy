<section id="main-content">
    <section class="wrapper">
        <div class="form-panel">
            <table id="tarea" class="display">
                <thead>
                    <tr id="rowTarea<?= $t->id ?>">
                        <th>Tarea</th>
                        <th>Curso</th>
                        <th>Descripcion</th>
                        <th>fecha_final</th>
                        <th>archivo</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarea as $t) {
                    ?>
                        <tr>
                            <td><?= $t->nombre ?></td>
                            <td><?= $t->curso ?></td>
                            <td><?= $t->descripcion ?></td>
                            <td><?= date('d-m-Y', strtotime($t->fecha_final)); ?></td>



                            <?php if ($t->archivo == 'nulo') { ?>
                                <td class="light">No disponible</td>
                            <?php } else { ?>
                                <td><a href='<?= base_url() . 'uploads/' . $t->archivo ?>' download> Descargar </a></td>
                            <?php } ?>


                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</section>
<script>
    $(document).ready(function() {
        $('#tarea').DataTable();
    });
</script>