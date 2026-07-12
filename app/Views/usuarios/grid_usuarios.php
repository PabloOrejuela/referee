<link rel="stylesheet" href="<?= site_url(); ?>public/css/grid-usuarios.css">
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <section class="connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a type="button" href="<?= site_url().'form-nuevo-usuario'; ?>"  class="btn btn-success mb-2" >Registrar un nuevo usuario</a>
                        </div>
                        <form action="#" method="post">
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            
                            <thead>
                                <th>Usuario</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($usuarios) && $usuarios != NULL) {
                                        foreach ($usuarios as $key => $usuario) {
                                            echo '<tr>
                                                <td><a href="'.site_url().'cliente-edit/'.$usuario->id.'" id="link-editar">'.$usuario->nombre.' '.$usuario->apellido.'</a></td>
                                                <td>'.$usuario->documento.'</td>
                                                <td>'.$usuario->telf_1.'</td>
                                                <td>'.$usuario->direccion.'</td>
                                                <td>'.$usuario->email.'</td>
                                                <td>'.$usuario->idrol.'</td>';
                                                if ($usuario->estado == 1) {
                                                    echo '<td>Activo</td>';
                                                }else if($usuario->estado == 0){
                                                    echo '<td>Inactivo</td>';
                                                }
                                            echo '<td>
                                                <div class="contenedor">
                                                    <a type="button" id="btn-register" href="'.site_url().'print-client-historial/'.$usuario->id.'" class="btnAction">
                                                        <img src="'.site_url().'public/img/btn-print.png" width="30" >
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="contenedor">
                                                    <a type="button" id="btn-register" href="'.site_url().'cliente-delete/'.$usuario->id.'" class="btnAction">
                                                        <img src="'.site_url().'public/img/delete.png" width="30" >
                                                    </a>
                                                </div>
                                            </td>
                                            </tr>';
                                    }
                                    }
                                ?>
                            </tbody>
                        </table>
                        </form>
                    </div></div><!-- /.card-body -->
                </div><!-- /.card-->
            </section>
        </div>
    </div>
</section>
<script>
  $(document).ready(function () {
    $.fn.DataTable.ext.classes.sFilterInput = "form-control form-control-sm search-input";
    $('#datatablesSimple').DataTable({
        "responsive": true, 
        "order": [[0, 'asc']],
        lengthMenu: [
                [25, 50, -1],
                [25, 50, 'Todos']
        ],
        language: {
            processing: 'Procesando...',
            lengthMenu: 'Mostrando _MENU_ registros por página',
            zeroRecords: 'No hay registros',
            info: 'Mostrando _START_ a _END_ de _MAX_',
            infoEmpty: 'No hay registros disponibles',
            infoFiltered: '(filtrando de _MAX_ total registros)',
            search: 'Buscar',
            paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Último"
                },
                aria: {
                    sortAscending:  ": activar para ordenar ascendentemente",
                    sortDescending: ": activar para ordenar descendentemente"
                }
        },
        //"lengthChange": false, 
        "autoWidth": false,
        "dom": "<'row'<'col-sm-12 col-md-8'l><'col-md-12 col-md-2'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>"
    });
});
</script>