
            <form action="<?= site_url('insert-liga') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Registrar nueva liga</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-12">
                                <h6 class="mb-3">Datos de la liga</h6>
                            </div>

                            <div class="col-md-8">
                                <label for="nombre_liga" class="form-label">Nombre de la liga</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nombre_liga"
                                    name="nombre_liga"
                                    value="<?= old('nombre_liga') ?>"
                                    placeholder="Ingrese el nombre de la liga" required>
                            </div>

                            <div class="col-md-4">
                                <label for="idcategoria" class="form-label">Categoría</label>
                                <select id="idcategoria" name="idcategoria" class="form-select" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php
                                    if (isset($categorias)) {
                                        foreach ($categorias as $key => $categoria) {
                                            echo '<option value="' . $categoria->id . '">' . $categoria->categoria . ' ' . $categoria->genero . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="img_logo" class="form-label">Logo de la liga</label>
                                <input class="form-control" type="file" id="img_logo" name="img_logo" accept="image/*">
                                <div class="form-text">Suba un logo en formato PNG, JPG o SVG.</div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="<?= site_url() ?>ligas" class="btn btn-secondary ms-2">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        