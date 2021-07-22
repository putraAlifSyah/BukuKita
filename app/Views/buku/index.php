<?= $this->extend('layout/template') ?>
<?= $this->section('content');  ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2">Daftar Buku</h3>
            
            <a href="/Buku/tambah" class="btn btn-primary mt-2 mb-2">Tambah Buku</a>
            <a href="/Buku/cetak" class="btn btn-primary mt-2 mb-2">Cetak Data</a>
            
            <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php endif; ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($buku as $b) : ?>
                    <tr>
                        <th scope="row"><?= $b['id'] ?></th>
                        <td><img src="/img/<?= $b['cover'] ?>" class="cover" alt=""></td>
                        <td><?= $b['judul'] ?></td>
                        <td><a href="/buku/<?= $b['slug']; ?>" class="btn btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('databuku', 'pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>