<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('blog') ?>">Ruang Baca</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Artikel</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Tambah Artikel Baru</h4>

                    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

                    <?= form_open_multipart('blog/tambah') ?>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?= set_value('judul') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konten</label>
                            <textarea class="form-control" name="konten" id="editor" rows="10" required><?= set_value('konten') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar (Opsional)</label>
                            <input type="file" class="form-control" name="gambar" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('blog') ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor', {
    height: 400,
    removeButtons: 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,Maximize,BGColor,ShowBlocks,Flash,Smiley,SpecialChar,PageBreak,Iframe,HorizontalRule,Font,FontSize,TextColor,Styles,Format'
});
</script> 