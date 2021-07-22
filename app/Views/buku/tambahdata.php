<?php

use Config\Validation;
use PHPUnit\Util\Xml\Validator;
?>
<?= $this->extend('layout/template') ?>

<?= $this->section('content');  ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Form Tambah Data</h2>
            <form action="/Buku/simpan" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul"
                            class="form-control  <?= ($validation->hasError('judul')? 'is-invalid': ''); ?>" id="judul"
                            placeholder="Judul" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('judul'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">penulis</label>
                    <div class="col-sm-10">
                        <input type="text" name="penulis"
                            class="form-control  <?php ($validation->hasError('penulis')? 'is-invalid': ''); ?>"
                            id="penulis" placeholder="Penulis">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" name="penerbit"
                            class="form-control  <?php ($validation->hasError('penerbit')? 'is-invalid': ''); ?>"
                            id="penerbit" placeholder="Penerbit">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="sinopsis"
                            class="form-control  <?php ($validation->hasError('sinopsis')? 'is-invalid': ''); ?>"
                            id="sinopsis" placeholder="Sinopsis"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cover" class="col-sm-2 col-form-label">cover</label>
                    <div class="col-sm-2">
                        <img src="/img/default.png" class="img-thumbnail img-preview" alt="">
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="custom-file-input <?php ($validation->hasError('cover')? 'is-invalid': ''); ?>" id="cover" name="cover" onchange="preview()">
                        <div class="invalid-feedback"><?= $validation->getError('cover'); ?></div>
                        <label class="custom-file-label" for="cover">Pilih Gambar..</label>
                    </div>
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>