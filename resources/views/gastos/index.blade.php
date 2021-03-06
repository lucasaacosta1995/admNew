@extends('layouts.cambiemos')

@section('content')
    <div class="row">
        <div class="col-md" id="countGastosPisos">
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gastos</h5>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-raised btn-sm btn-success" data-toggle="modal" data-target="#addNewGasto" onclick="$('#formCrearGasto')[0].reset();">
                                Agregar gasto
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-raised btn-sm btn-info" data-toggle="modal" data-target="#verGastosPorFecha">
                                Ver gastos por fecha
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
                                    <th>Importe</th>
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
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" name="importe" required class="form-control"  aria-label="Amount (to the nearest dollar)">
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
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" id="editImporte" name="importe" required class="form-control"  aria-label="Amount (to the nearest dollar)">
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
    <!-- Modal ver gastos por fecha y piso-->
    <div class="modal fade" id="verGastosPorFecha" tabindex="-1" role="dialog" aria-labelledby="verGastosPorFechaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewGastoLabel">Ver gastos por fecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formVerGastosPorFecha" action="#">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Fecha desde</label>
                                <input class="form-control" name="fecha_desde" type="date" id="fechaDesde" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Fecha hasta</label>
                                <input class="form-control" name="fecha_hasta" type="date" id="fechaHasta" >
                            </div>
                        </div>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button id="resultadoGastosPorFecha" type="button" class="btn btn-raised btn-secondary">Resultado </button>
                            </div>
                        </div>
                        <div class="row" style="display: none;" id="contenedorTableShowResultadoPorFecha">
                            <div class="col-md table-responsive">
                                <table id="tableShowResultadoPorFecha" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Piso</th>
                                        <th>Fecha</th>
                                        <th>Resposable</th>
                                        <th>Importe</th>
                                        <th>Fecha de creacion</th>
                                    </tr>
                                    </thead>
                                    <tbody id="trDataGastos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Buscar</button>
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
                ajax:'{{ url('gastosC/getAll') }}'
            });
            getCountPisosImporte();
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
        $("#formVerGastosPorFecha").submit(function(stay){
            stay.preventDefault();
            $("#tableShowResultadoPorFecha tbody").html('');
            $("#tableShowResultadoPorFecha").hide('');
            $('#resultadoGastosPorFecha').html('');
            var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
            $.ajax({
                type: 'GET',
                url: "{{ url('gastosC/gastosPorFecha') }}",
                data: formdata, // here $(this) refers to the ajax object not form
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.total == 0){
                        $('#resultadoGastosPorFecha').html('Sin gastos para mostrar');
                    }
                    else{
                        $('#resultadoGastosPorFecha').html('Resultado $'+data.total);
                        $("#contenedorTableShowResultadoPorFecha").show();

                        $.each(data.data,function(e,i){
                           var html =   "<tr>"+
                                            "<td>"+i.titulo+"</td>"+
                                            "<td>"+i.descripcion+"</td>"+
                                            "<td>"+i.piso+"</td>"+
                                            "<td>"+i.fecha+"</td>"+
                                            "<td>"+i.responsable+"</td>"+
                                            "<td>"+i.importe+"</td>"+
                                            "<td>"+i.created_at+"</td>"+
                                        "</tr>";

                            $("#tableShowResultadoPorFecha tbody").append(html);
                        });
                        $("#tableShowResultadoPorFecha").show();
                    }
                }
            });
        });
        function getCountPisosImporte(){
            $("#countGastosPisos").html('');
            $.ajax({
                type: 'GET',
                url: "{{ url('gastosC/importesTotalesPisos') }}",
                data: {}, // here $(this) refers to the ajax object not form
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.status){
                        $.each(data.data,function(e,i){
                            var html = '<button type="button" class="btn btn-raised btn-secondary">Piso Nº '+e+' | $'+i+'</button> ';
                            $("#countGastosPisos").append(html);
                        });
                    }
                },
            });
        }
        function recargarTableGastos(){
            $('#tablaGastosIndex').DataTable().ajax.reload();
            getCountPisosImporte();
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
                        $("#editImporte").val(data.gasto.importe);
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
