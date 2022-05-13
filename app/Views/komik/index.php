<?= $this->extend('layout/template'); ?>

<?= $this->section('conten'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">judul komik</h1>
            <a href="/komik/create" class="badge bg-primary p-3">Tambah Data</a>
            <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success mt-3" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">judul</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($komik as $k) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                        <td><?= $k['judul']; ?></td>
                        <td>
                            <a href="/komik/<?= $k['slug']; ?>" class="badge bg-success">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>