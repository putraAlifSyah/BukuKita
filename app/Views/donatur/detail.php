<?php

use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
?>
<?= $this->extend('layout/template') ?>

<?= $this->section('content');  ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2">Detail Buku</h3>
            <div class="card mb-3 mt-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 wrapper">
                        <img src="/img/<?= $donatur['foto'] ?>" class="detail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body tulisan">
                            <h5 class="card-title"><?= $donatur['nama'] ?></h5>
                            <p><strong><?= $donatur['telpon'] ?></strong></p>
                            <p class="text-muted"><?= $donatur['pekerjaan'] ?></p>
                            <p class="sinopsis"><?= $donatur['alamat'] ?></p>
                            <a href="/donatur/edit/<?= $donatur['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/donatur/<?= $donatur['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm ('apakah anda yakin ingin menghapus data?')">Delete</button>
                            </form>
                            <br>
                            <a href="/donatur">kembali ke daftar buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>