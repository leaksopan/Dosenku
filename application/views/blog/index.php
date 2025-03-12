<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Ruang Baca</h2>
            
            <?php if($is_admin): ?>
            <a href="<?= base_url('blog/tambah') ?>" class="btn btn-primary mb-4">
                <i class="fas fa-plus"></i> Tambah Artikel
            </a>
            <?php endif; ?>

            <!-- Search Form -->
            <form action="<?= base_url('blog/search') ?>" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari artikel...">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <?php if(empty($blogs)): ?>
                <div class="alert alert-info">
                    Belum ada artikel yang tersedia.
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($blogs as $blog): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <?php if($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])): ?>
                                <img src="<?= base_url('uploads/blog/' . $blog['gambar']) ?>" class="card-img-top" alt="<?= $blog['judul'] ?>" style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                <div class="bg-light text-center py-5" style="height: 200px;">
                                    <i class="fas fa-book fa-3x text-muted"></i>
                                </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $blog['judul'] ?></h5>
                                    <p class="card-text text-muted">
                                        <small>
                                            <i class="fas fa-calendar"></i> 
                                            <?= date('d M Y', strtotime($blog['created_at'])) ?>
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        <?= substr(strip_tags($blog['konten']), 0, 200) ?>...
                                    </p>
                                    <a href="<?= base_url('blog/view/' . $blog['id']) ?>" class="btn btn-primary">
                                        Baca Selengkapnya
                                    </a>
                                    <?php if($is_admin): ?>
                                    <div class="btn-group float-end">
                                        <a href="<?= base_url('blog/edit/' . $blog['id']) ?>" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="hapusBlog(<?= $blog['id'] ?>)" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if($is_admin): ?>
<script>
function hapusBlog(id) {
    if(confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
        $.ajax({
            url: '<?= base_url('blog/hapus/') ?>' + id,
            type: 'POST',
            success: function(response) {
                var data = JSON.parse(response);
                if(data.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus artikel: ' + (data.error || 'Terjadi kesalahan'));
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus artikel');
            }
        });
    }
}
</script>
<?php endif; ?> 