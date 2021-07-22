<?= $this->extend('layout/template') ?>
<?= $this->section('content');  ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2">Daftar Donatur</h3>
            <a href="/Donatur/tambah" class="btn btn-primary mt-2 mb-2">Tambah Donatur</a>
            <a href="/Donatur/cetak" class="btn btn-primary mt-2 mb-2">Cetak Data</a>
            <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php endif; ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($donatur as $b) : ?>
                    <tr>
                        <th scope="row"><?= $b['id'] ?></th>
                        <td><img src="/img/<?= $b['foto'] ?>" class="cover" alt=""></td>
                        <td><?= $b['nama'] ?></td>
                        <td><a href="/donatur/<?= $b['id']; ?>" class="btn btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('datadonatur', 'pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>