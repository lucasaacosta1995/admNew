@extends('layouts.cambiemos')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gastos</h5>
                    <div class="row">
                        <div class="col-md">
                            <button type="button" class="btn btn-raised btn-sm btn-success" data-toggle="modal" data-target="#addNewGasto" onclick="$('#formCrearGasto')[0].reset();">
                                Agregar gasto
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md table-responsive">
                            <table id="tablaGastosIndex" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Piso</th>
                                    <th>Fecha</th>
                                    <th>Resposable</th>
                                    <th>Fecha de creacion</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="trDataGastos">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal new gasto -->
    <div class="modal fade" id="addNewGasto" tabindex="-1" role="dialog" aria-labelledby="addNewGastoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewGastoLabel">Agregando gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formCrearGasto" action="#">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Titulo</label>
                            <input class="form-control" name="titulo" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Fecha realizado</label>
                            <input class="form-control" name="fecha" type="date" required>
                        </div>
                        <div class="form-group">
                            <label>Piso</label>
                            <select class="form-control" name="piso" id="exampleFormControlSelect1" required>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Responsable</label>
                            <input class="form-control" name="responsable" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea class="form-control" name="descripcion" placeholder="Ingrese una breve descripcion del gasto" rows="3" maxlength="250" minlength="1" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edit gasto-->
    <div class="modal fade" id="editNewGasto" tabindex="-1" role="dialog" aria-labelledby="editNewGastoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewGastoLabel">Agregando gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditGasto" action="#">
                    {{ csrf_field() }}
                    <input type="hidden" id="editId" name="editId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Titulo</label>
                            <input class="form-control" name="titulo" type="text" id="editTitulo" required>
                        </div>
                        <div class="form-group">
                            <label>Fecha realizado</label>
                            <input class="form-control" name="fecha" type="date" id="editFecha" required>
                        </div>
                        <div class="form-group">
                            <label>Piso</label>
                            <select class="form-control" name="piso" id="editPiso" required>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Responsable</label>
                            <input class="form-control" name="responsable" type="text" id="editReponsable" required>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea class="form-control" id="editDescripcion" name="descripcion" placeholder="Ingrese una breve descripcion del gasto" rows="3" maxlength="250" minlength="1" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tablaGastosIndex').DataTable({
                ajax:'{{ url('/') }}/getAll'
            });
        } );
        $("#formCrearGasto").submit(function(stay){
            stay.preventDefault();
            var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
            $.ajax({
                type: 'POST',
                url: "{{ url('/') }}/gastos",
                data: formdata, // here $(this) refers to the ajax object not form
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.status){
                        $('#formCrearGasto')[0].reset();
                        $('#addNewGasto').modal('hide');
                        recargarTableGastos();
                    }
                },
            });
        });
        $("#formEditGasto").submit(function(stay){
            stay.preventDefault();
            var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
            var id = $("#editId").val();
            $.ajax({
                type: 'PUT',
                url: "{{ url('/') }}/gastos/"+id,
                data: formdata, // here $(this) refers to the ajax object not form
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.status){
                        $('#formEditGasto')[0].reset();
                        $('#editNewGasto').modal('hide');
                        recargarTableGastos();
                    }
                },
            });
        });
        function recargarTableGastos(){
            $('#tablaGastosIndex').DataTable().ajax.reload();
        }
        function changeGasto(id){
            $('#formEditGasto')[0].reset();
            $("#editId").val(0);
            $.ajax({
                type: 'get',
                url: "{{ url('/') }}/gastos/"+id+"/edit",
                data: {}, // here $(this) refers to the ajax object not form
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.status){
                        $("#editId").val(data.gasto.id);
                        $("#editTitulo").val(data.gasto.titulo);
                        $("#editDescripcion").val(data.gasto.descripcion);
                        $("#editPiso").val(data.gasto.piso);
                        $("#editFecha").val(data.gasto.fecha);
                        $("#editReponsable").val(data.gasto.responsable);
                        $('#editNewGasto').modal('show');
                    }
                },
            });
        }
        function deleteGasto(id){
            $.ajax({
                type: 'DELETE',
                url: "{{ url('/') }}/gastos/"+id,
                data: {"_token": "{{ csrf_token() }}"}, // here $(this) refers to the ajax object not form
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.status){
                        recargarTableGastos();
                    }
                },
            });
        }
    </script>
@endsection
