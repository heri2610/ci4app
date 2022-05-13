<?= $this->extend('layout/template'); ?>

<?= $this->section('conten'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Form Tambah Data</h2>
            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="my-3 row">
                    <label for="judul" class="col-sm-2 col-form-label" >Judul:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback">
                        <?= $validation->getError('judul'); ?>
                    </div>
                    </div>
                </div>
                <div class="my-3 row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div class="invalid-feedback">
                        <?= $validation->getError('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="my-3 row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        <div class="invalid-feedback">
                        <?= $validation->getError('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="my-3 row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul:</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <input class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" type="file" id="sampul" name="sampul" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid col-4 mx-auto">
                    <button class="btn btn-primary" type="submit">Tambah Data Mahasiswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>