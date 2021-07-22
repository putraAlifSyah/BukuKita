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
            <form action="/Donatur/update/<?= $donatur['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="lama" value="<?= $donatur['foto']; ?>">

                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?= $donatur['nama']; ?>"
                            class="form-control  <?= ($validation->hasError('nama')? 'is-invalid': ''); ?>" id="nama"
                            placeholder="Judul" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" value="<?= $donatur['alamat']; ?>"
                            class="form-control  <?php ($validation->hasError('alamat')? 'is-invalid': ''); ?>"
                            id="alamat" placeholder="Penulis">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="pekerjaan" value="<?= $donatur['pekerjaan']; ?>"
                            class="form-control  <?php ($validation->hasError('pekerjaan')? 'is-invalid': ''); ?>"
                            id="pekerjaan" placeholder="Penulis">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                    <div class="col-sm-10">
                        <input type="text" name="telpon" value="<?= $donatur['telpon']; ?>"
                            class="form-control  <?php ($validation->hasError('telpon')? 'is-invalid': ''); ?>"
                            id="telpon" placeholder="Penulis">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">foto</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $donatur['foto']; ?>" class="img-thumbnail img-preview" alt="">
                    </div>
                    <div class="col-sm-8">
                        <input type="file"
                            class="custom-file-input <?php ($validation->hasError('foto')? 'is-invalid': ''); ?>"
                            id="cover" name="foto" onchange="preview()">
                        <div class="invalid-feedback"><?= $validation->getError('foto'); ?></div>
                        <label class="custom-file-label" for="foto">Pilih Gambar..</label>
                    </div>
                </div>

                <button class="btn btn-primary">Ubah</button>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>