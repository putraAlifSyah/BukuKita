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
                        <img src="/img/<?= $penulis['foto'] ?>" class="detail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body tulisan">
                            <h5 class="card-title"><?= $penulis['nama'] ?></h5>
                            <p><strong><?= $penulis['tanggal_lahir'] ?></strong></p>
                            <p class="text-muted"><?= $penulis['deskripsi'] ?></p>
                            <p class="sinopsis"><?= $penulis['alamat'] ?></p>
                            <p class="sinopsis"><em><?= $penulis['motto'] ?></em></p>
                            <a href="/penulis/edit/<?= $penulis['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/penulis/<?= $penulis['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm ('apakah anda yakin ingin menghapus data?')">Delete</button>
                            </form>
                            <br>
                            <a href="/penulis">kembali ke daftar buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>