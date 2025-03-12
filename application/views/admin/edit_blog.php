<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Blog</h2>
                <a href="<?= base_url('admin/blog') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
                    
                    <?= form_open_multipart('admin/edit_blog/' . $blog['id']) ?>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= set_value('judul', $blog['judul']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten</label>
                            <textarea class="form-control" id="editor" name="konten" rows="10" required><?= set_value('konten', $blog['konten']) ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <?php if($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/blog/' . $blog['gambar']) ?>" 
                                     alt="<?= $blog['judul'] ?>" 
                                     class="img-thumbnail" 
                                     style="max-height: 200px;">
                            </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
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