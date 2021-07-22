<?php

use Config\Validation;
use PHPUnit\Util\Xml\Validator;
?>
<?= $this->extend('layout/template') ?>

<?= $this->section('content');  ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Form Ubah Data</h2>
            <form action="/Penulis/update/<?= $penulis['id']; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="lama" value="<?= $penulis['foto']; ?>">
            <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?= $penulis['nama']; ?>"
                            class="form-control  <?= ($validation->hasError('nama')? 'is-invalid': ''); ?>" id="nama"
                            placeholder="Judul" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal_lahir" value="<?= $penulis['tanggal_lahir']; ?>"
                            class="form-control  <?php ($validation->hasError('tanggal_lahir')? 'is-invalid': ''); ?>"
                            id="tanggal_lahir" placeholder="Penulis">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="deskripsi"
                            class="form-control  <?php ($validation->hasError('deskripsi')? 'is-invalid': ''); ?>"
                            id="deskripsi" placeholder="Sinopsis"><?= $penulis['deskripsi']; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="alamat"
                            class="form-control  <?php ($validation->hasError('alamat')? 'is-invalid': ''); ?>"
                            id="alamat" placeholder="Sinopsis"><?= $penulis['alamat']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">foto</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $penulis['foto']; ?>" class="img-thumbnail img-preview" alt="">
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="custom-file-input <?php ($validation->hasError('foto')? 'is-invalid': ''); ?>" id="cover" name="foto" onchange="preview()">
                        <div class="invalid-feedback"><?= $validation->getError('foto'); ?></div>
                        <label class="custom-file-label" for="foto"><?= $penulis['foto']; ?></label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="motto" class="col-sm-2 col-form-label">Motto</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="motto"
                            class="form-control  <?php ($validation->hasError('motto')? 'is-invalid': ''); ?>"
                            id="motto" placeholder="Sinopsis"><?= $penulis['motto']; ?></textarea>
                    </div>
                </div>
               <button class="btn btn-primary">Ubah</button>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>