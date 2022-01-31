<section id="main-content">
    <section class="wrapper">

        <div class="form-panel">
            <table id="alumno" class="display">
                <thead>
                    <tr id="rowAlumno<?= $a->id ?>">
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Nombre de usuario</th>
                        <th>Curso</th>
                        <th>Editar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumno as $a) {
                    ?>
                        <tr>
                            <td><?= $a->nombre ?></td>
                            <td><?= $a->apellidos ?></td>
                            <td><?= $a->username ?></td>
                            <td><?= $a->curso ?></td> <!-- aqui ira el nombre del usuario (alumno-1, alumno-2...) -->
                            <td><i class="eliminar fas fa-trash" style="cursor:pointer; color:darkred;" id='alumno-<?= $a->id ?>'></i></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</section>

<script type="text/javascript">
    //Con esto lo que hacemos es que cuando le damos click a cualquier elemento de la clase eliminar, ejecutamos lo que hay adentro.
    $(".eliminar").click(function() {

        var idalumno = this.id;

        //ahora, tenemos el siguiente formato almacenado: alumno-1, alumno-2, alumno-3, etc...
        //y para separarlo, podemos hacer lo siguiente:
        var resto = idalumno.split("-"); //resto se convierte en un array
        var id = resto[1];
        console.log(id);


        //Una vez se envie y se elimine el alumno, ejecutamos una funcion:
        //Enviamos una variable POST a dashboardController a eliminar alumno, y el POST es idalumno
        $.post("<?= base_url() ?>dashboardController/eliminarAlumno", {
            idalumno: id
        }).done(function(data) {
            console.log("Entra al fadeout");
            $("#rowAlumno" + id).fadeOut("slow");
            console.log("Sale del fadeout");

        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#alumno').DataTable();
    });
</script>