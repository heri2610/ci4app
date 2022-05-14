<?= $this->extend('layout/template'); ?>

<?= $this->section('conten'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">daftar orang</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="masukan keyword pencarian" name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
           
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">nama</th>
                    <th scope="col">alamat</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentpage - 1)); ?>
                    <?php foreach($orang as $o) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $o['nama']; ?></td>
                        <td><?= $o['alamat']; ?></td>
                        <td>
                            <a href="" class="badge bg-success">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>