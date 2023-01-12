@extends('adminlte::page')

@section('title', 'SIVOC-PROYECTOS')

@section('content_header')
    @section('plugins.Jstree', true)
    <link rel="stylesheet" href="{{ asset("vendor/mycss/style.css") }}">

    @section('css')
        <style>
            ul, #myUL {
                list-style-type: none;
            }

            #myUL {
                margin: 0;
                padding: 0;
            }

            .caret {
                cursor: pointer;
                -webkit-user-select: none; /* Safari 3.1+ */
                -moz-user-select: none; /* Firefox 2+ */
                -ms-user-select: none; /* IE 10+ */
                user-select: none;
            }

            .caret::before {
                content: "\25B6";
                color: red;
                display: inline-block;
                margin-right: 6px;
            }

            .caret-down::before {
                -ms-transform: rotate(90deg); /* IE 9 */
                -webkit-transform: rotate(90deg); /* Safari */'
                transform: rotate(90deg);
            }

            .nested {
                display: none;
            }

            .active {
                display: block;
            }
        </style>
    @stop
    <h1 class="m-0 text-dark">Lista Maestra</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasAnyRole(['admin', 'calidad', 'compras', 'tesoreria', 'manufactura', 'servicio', 'ventas', 'lider calidad', 'lider compras', 'lider recursos humanos', 'lider tesoreria', 'lider ventas', 'lider servicio']))

                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Lista Maestra" onclick="show('divCarpetas')">
                        <i class="fas fa-plus"></i>
                    </button>

                    <!-- <span >
                        <button type="button" class="btn btn-info" onclick="showDiv('divProject')" title="Mostrar Proyectos">
                            <i class="fas fa-project-diagram"></i>
                        </button>
                    </span>
                    <span >
                        <button type="button" class="btn btn-success" onclick="showDiv('divFiles')" title="Archivos">
                            <i class="fas fa-folder"></i>
                        </button>
                    </span> -->

                    @endif

                    @include('listaMaestra.create_folder')
                    @include('listaMaestra.upload_file')

                </div>
            </div>
        </div>
    </div>

    <div class="row" id="divCarpetas">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <span data-toggle="modal" data-target="#modalCreateFolder">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Nueva Lista Maestra">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                    <div class="row"></div>
                    <div class="row" id="listasMaestras">
                        @isset($folders)
                            <?php echo $folders; ?>
                        @endisset
                        <!-- <ul>
                            <li >nodo 1</li>
                            <li >nodo 2
                                <ul>
                                    <li data-jstree='{"opened":false, "type":"file"}'>subnodo 1</li>
                                    <li data-jstree='{"opened":false, "type":"file"}'>subnodo 2</li>
                                </ul>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div id="informacion">

                        </div>
                    </div>
                    <div class="row">
                        <span data-toggle="modal" data-target="#modalUploadFile">
                            <button type="button" id="btnAgregarArchivo" style="display: none" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Agregar Archivo">
                                <i class="fas fa-file"></i>
                            </button>
                        </span>

                        <button type="button" id="btnMostrarListaMaestra" style="display: none" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lista Maestra" onclick="show('divListaMaestra')">
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row" id="divListaMaestra" style="display: none">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputEmail4">Proyecto</label>
                                            <input type="text" id="txtProyect" class="form-control" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="inputEmail4">Fecha de Creación</label>
                                            <input type="text" id="dateCreacionProject" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputState">Sección</label>
                                            <select id="sltSeccion" class="form-control" onchange="listaSeccion()">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table id="tblListaMaestra" class="table table-striped table-bordered display nowrap" style="width:100%; font-size: 12px;">
                            <thead>
                                <th>Folio</th>
                                <th>Descripcion</th>
                                <th>Modelo</th>
                                <th>Fabricante</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Accion</th>
                            </thead>
                            <tfoot>
                                <th>Folio</th>
                                <th>Descripcion</th>
                                <th>Modelo</th>
                                <th>Fabricante</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Accion</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script>
        $(document).ready(function() {
            let statusGrafica="";
            $('#listasMaestras').jstree({
                "types" : {
                    "default" : {
                        "icon" : "jstree-folder"
                    },
                    "file" : {
                        "icon" : "fas fa-file"
                    }
                },
                "plugins" : ["types"]
            });
            $('#listasMaestras').on("changed.jstree", function (e, data) {
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).text);
                }
                console.log(data.selected);
                console.log(r);
                console.log("seleccion: " + r.join(', '));
                $('#informacion').html('Seleccinado: ' + r.join(', '));
                $("#hiddenAddFilefolder").val(r.join(', '));
                $("#btnAgregarArchivo").show();
                $("#btnMostrarListaMaestra").show();
            });




            $("#tableProjects").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [ {
                    className: 'control',
                    orderable: false,
                    targets:   -1
                } ]
            });

            let status= [@json($projects)]

        } );


    </script>
    <script src="{{ asset('vendor/myjs/listaMaestra.js') }}"></script>

@stop
