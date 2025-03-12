<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('blog') ?>">Ruang Baca</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $blog['judul'] ?></li>
                </ol>
            </nav>

            <article class="blog-post">
                <h1 class="mb-3"><?= $blog['judul'] ?></h1>
                
                <p class="text-muted mb-4">
                    <i class="fas fa-calendar"></i> 
                    <?= date('d M Y', strtotime($blog['created_at'])) ?>
                    <?php if($blog['updated_at'] != $blog['created_at']): ?>
                    <span class="ms-3">
                        <i class="fas fa-edit"></i> 
                        Diperbarui: <?= date('d M Y', strtotime($blog['updated_at'])) ?>
                    </span>
                    <?php endif; ?>
                </p>

                <?php if($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])): ?>
                <div class="text-center mb-4">
                    <img src="<?= base_url('uploads/blog/' . $blog['gambar']) ?>" 
                         class="img-fluid rounded" 
                         alt="<?= $blog['judul'] ?>"
                         style="max-height: 400px;">
                </div>
                <?php endif; ?>

                <div class="blog-content">
                    <?= $blog['konten'] ?>
                </div>
            </article>

            <?php if($is_admin): ?>
            <div class="mt-4">
                <a href="<?= base_url('blog/edit/' . $blog['id']) ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Artikel
                </a>
                <button onclick="hapusBlog(<?= $blog['id'] ?>)" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus Artikel
                </button>
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
                    window.location.href = '<?= base_url('blog') ?>';
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

<style>
.blog-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content img {
    max-width: 100%;
    height: auto;
    margin: 1rem 0;
}
</style>
<?php endif; ?> 