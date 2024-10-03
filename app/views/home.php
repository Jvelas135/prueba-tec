<div class="container mt-5">
    <h1 class="mb-4">Lista de Empleados</h1>

    <button type="button" class="btn btn-primary mb-3" id="btnAbrir">
        <i class="fas fa-plus"></i> Agregar Empleado
    </button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Área</th>
                <th>Boletin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody name="empleadoList">
           
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalAgregarEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Agregar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="empleadoForm">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="area">Área</label>
                        <select class="form-control" id="area" name="area" required>
                            <option value="">Selecciona...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sexo</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M">
                            <label class="form-check-label" for="masculino">Masculino</label>
                        </div>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="fenmino" value="F">
                            <label class="form-check-label" for="fenemino">Femenino</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="confirm" required>
                        <label class="form-check-label" for="confirm">Confirmo que los datos son correctos</label>
                    </div>

                    <div class="form-group">
                        <label>Roles</label><br>
                         <div name="roles">

                         </div>
                    </div>
                </form>
                <div id="message" class="alert alert-success d-none" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar <i
                        class="fas fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Editar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="empleadoForm">
                    <div class="form-group">
                        <label for="nombreEdit">Nombre</label>
                        <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="emailEdit">Email</label>
                        <input type="email" class="form-control" id="emailEdit" name="emailEdit" required>
                    </div>

                    <div class="form-group">
                        <label for="areaEdit">Área</label>
                        <select class="form-control" id="areaEdit" name="areaEdit" required>
                            <option value="">Selecciona...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sexo</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexoEdit" id="masculinoEdit" value="M">
                            <label class="form-check-label" for="masculinoEdit">Masculino</label>
                        </div>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexoEdit" id="feneminoEdit" value="F">
                            <label class="form-check-label" for="feneminoEdit">Femenino</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" rows="3" required></textarea>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="confirmEdit" required>
                        <label class="form-check-label" for="confirmEdit">Confirmo que los datos son correctos</label>
                    </div>

                    <div class="form-group">
                        <label>Roles</label><br>
                         <div name="rolesEdit">

                         </div>
                    </div>
                    <input type="hidden" name="codigo">
                </form>
                <div id="message" class="alert alert-success d-none" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" name="btnEditar" class="btn btn-primary">Editar <i
                        class="fas fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $.getScript('http://localhost/prueba-tecnica/assets/js/home.js');
</script>

