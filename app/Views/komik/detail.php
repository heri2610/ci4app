<?= $this->extend('layout/template'); ?>

<?= $this->section('conten'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Detail Komik</h1>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 profile" >
                    <img src="/img/<?= $komik['sampul']; ?>" class="img-fluid rounded-start" alt="sampul">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $komik['judul']; ?></h5>
                        <p class="card-text"><b>penulis: </b><?= $komik['penulis']; ?></p>
                        <p class="card-text"><small class="text-muted"><b>penerbit: </b><?= $komik['penerbit']; ?></small></p>
                        <a href="/komik/edit/<?= $komik['slug']; ?>" ><button class="badge bg-success px-3">Edit</button> </a>
                        <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                            <input type = "hidden" name = "_method" value = "DELETE">
                            <button type="submit" class="badge bg-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                    <div><a href="/komik" class="badge bg-primary ms-3 mb-2">kembali</a>
                    </div>    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>