<link rel="stylesheet" href="<?= site_url(); ?>public/css/grid-jugadores.css">
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <section class="connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a type="button" href="<?= site_url().'form-nuevo-jugador'; ?>"  class="btn btn-success mb-2" >Registrar un nuevo jugador</a>
                        </div>
                        <form action="#" method="post">
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            
                            <thead>
                                <th>Imagen</th>
                                <th>Jugador</th>
                                <th>Seudónimo</th>
                                <th>Documento</th>
                                <th>Equipo</th>
                                <th>Posición</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($jugadores) && $jugadores != NULL) {
                                        foreach ($jugadores as $key => $jugador) {
                                            echo '<tr>
                                                <td><img src="'.site_url().'public/img/jugadores/'.$jugador->imagen.'" alt="foto" id="foto-thumb"></td>
                                                <td><a href="'.site_url().'form-edit-jugador/'.$jugador->id.'" id="link-editar">'.$jugador->nombre.' '.$jugador->apellido.'</a></td>
                                                <td>'.$jugador->apodo.'</td>
                                                <td>'.$jugador->documento.'</td>
                                                <td>'.$jugador->equipo.'</td>
                                                <td>'.$jugador->posicion.'</td>
                                            ';

                                            echo '<td>
                                                <div class="contenedor">
                                                    <a type="button" id="btn-register" href="'.site_url().'print-jugador-historial/'.$jugador->id.'" class="btnAction">
                                                        <img src="'.site_url().'public/img/btn-print.png" width="30" >
                                                    </a>
                                                </div>
                                            </td>';
                                            // <td>
                                            //     <div class="contenedor">
                                            //         <a type="button" id="btn-register" href="'.site_url().'cliente-delete/'.$jugador->id.'" class="btnAction">
                                            //             <img src="'.site_url().'public/img/delete.png" width="30" >
                                            //         </a>
                                            //     </div>
                                            // </td>
                                            echo '</tr>';
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