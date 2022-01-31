<section id="main-content">
    <section class="wrapper">

        <!--******************************************************
            **************************MODAL***************************
            *******************************************************-->

        <div class="showback">
            <h4><i class="fa fa-angle-right"></i> Mensajeria </h4>
            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal"> Enviar un mensaje </button>



            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #ffd777;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" class="">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Destinatario</label>
                                    <div class="col">
                                        <select name="id_to" class="form-control">
                                            <option class="form-control" value="0" disabled> Seleccione un usuario</option>
                                            <?php
                                            foreach ($usuarios as $c) {
                                                echo "<option id='user-" . $c->id . "' value='" . $c->token_mensaje . "'>" . $c->nombre . " " . $c->apellidos . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mensaje</label>
                                    <div class="col">
                                        <textarea class="form-control" rows="3" name="mensaje"></textarea>
                                    </div>
                                </div>

                                <input class="form-control btn-warning" type="submit" name="" value="Enviar">

                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ffd777;">
                        <h4 class="modal-title" id="myModalLabel">Mensaje de</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>


        <div class="form-panel">
            <table id="tablaMensajes" class="display">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha</th>
                        <th>Ver</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($mensaje as $m) {

                        $nombres = $this->Site_model->getNombre($m->id_from);
                        $nombre = $nombres[0]->nombre;
                        $apellidos = $nombres[0]->apellidos;

                        if ($m->is_read == 1) {
                            $class = "isReadClass";
                        } else {
                            $class = "noReadClass";
                        }

                    ?>

                        <tr>
                            <td><?= $nombre ?></td>
                            <td><?= $apellidos ?></td>
                            <td><?= $m->created_at ?></td>
                            <td id="verMensaje-<?= $m->id ?>" class="<?= $class ?>" onclick="verMensaje(<?= $m->id ?>,'<?= $nombre ?>',this.id)"> Ver </td>



                        </tr>
                    <?php
                    }

                    ?>
                </tbody>
            </table>

        </div>
        <style>
            .isReadClass {
                background: #7be37b;
                color: white;
                text-align: center;
                cursor: pointer;
            }

            .noReadClass {
                background: #e37b7b;
                color: white;
                text-align: center;
                cursor: pointer;
            }
        </style>



    </section>
</section>
<script>
    $(document).ready(function() {
        $('#tablaMensajes').DataTable({
            columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [2],
                orderData: [2, 0]

            }]
        });
    });

    function verMensaje(id, nombre, idver) {

        $.post("http://localhost/codeigniter-udemy/dashboardController/getMensaje", {
            idMensaje: id
        }).done(function(data) {

            if (data) {
                $("#" + idver).removeClass("noReadClass");
                $("#" + idver).addClass("isReadClass");

                $("#modalMensaje .modal-title").append(nombre);
                $("#modalMensaje .modal-body").html(data);
                $("#modalMensaje").modal('show');
            }


        });
    }
</script>