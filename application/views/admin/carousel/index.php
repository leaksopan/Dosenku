<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Carousel Management</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload me-2"></i>Upload Gambar
                </button>
            </div>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <?php if(!empty($images)): ?>
                    <?php foreach($images as $image): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100">
                                <img src="<?= base_url('assets/img/lecturers/'.$image) ?>?v=<?= time() ?>" 
                                     class="card-img-top" 
                                     alt="Lecturer Image"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate"><?= $image ?></h5>
                                    <button class="btn btn-danger btn-sm w-100" 
                                            onclick="deleteImage('<?= $image ?>')">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">
                            Belum ada gambar carousel. Silakan upload gambar.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Gambar Carousel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?= form_open_multipart('admin/carousel/upload_image') ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <div class="form-text">
                            Format: JPG, JPEG, PNG (Max. 2MB)
                        </div>
                    </div>
                    <div id="imagePreview" class="d-none">
                        <img src="" alt="Preview" class="img-fluid rounded">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
function deleteImage(filename) {
    if(confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
        window.location.href = '<?= base_url('admin/carousel/delete_image/') ?>' + filename;
    }
}

// Image preview
document.querySelector('input[name="image"]').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const file = e.target.files[0];
    
    if(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('d-none');
    }
});
</script> 