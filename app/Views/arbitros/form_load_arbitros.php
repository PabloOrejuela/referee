<link rel="stylesheet" href="<?= site_url(); ?>public/css/grid-productos.css">

<div class="col-md-6">
    <div class="card card-warning card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Importar Lista de Arbitros</div>
        </div>
        <div class="card-body">
            <form action="<?=  site_url(); ?>load-arbitros" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="form-file-multi">Subir archivo Excel (.xlsx, .xls, .csv)</label>
                    <input class="form-control" type="file" name="excelEquipos" id="form-file-multi" multiple />
                </div>
                
                <button class="btn btn-primary" type="submit">Enviar</button>
            </form>
        </div>
    </div>
</div>