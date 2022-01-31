<section id="main-content">
    <section class="wrapper">

        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="m-3"><i class="fa fa-angle-right"></i> Crear Tareas</h4>


                    <form action="" method="post" class="form-horizontal style-form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre de la tarea</label>
                            <div class="col">
                                <input type="text" class="form-control" name="nombreTarea">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion</label>
                            <div class="col">
                                <input type="text" class="form-control" name="descripcionTarea">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha de finalizacion</label>
                            <div class="col">
                                <input type="date" class="form-control round-form" name="fechaFinalizacion">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Archivos adjuntos</label>
                            <div class="col">
                                <input class="form-control" id="focusedInput" type="file" name="archivo">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-1 control-label pl-5"> Curso </label>
                            <div class="col-sm-3">
                                <select name="curso" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>

                                </select>
                            </div>

                            <div class="col-sm-6 text-center">
                                <button type="submit" class="btn btn-success"> Enviar </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</section>