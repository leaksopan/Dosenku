<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Sub Topik</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach($materi as $m): ?>
                        <a href="#materi-<?= $m['id'] ?>" 
                           class="list-group-item list-group-item-action subtopik-item"
                           onclick="showMateri(<?= $m['id'] ?>)">
                            <?= $m['judul'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if($is_admin): ?>
            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
                <i class="fas fa-plus"></i> Tambah Materi
            </button>
            <?php endif; ?>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('matakuliah/' . strtolower(str_replace(' ', '', $matakuliah['nama']))) ?>"><?= $matakuliah['nama'] ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $bab['judul'] ?> - <?= $sub_bab['nama_sub_bab'] ?></li>
                </ol>
            </nav>

            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title mb-4"><?= $sub_bab['nama_sub_bab'] ?></h2>
                    
                    <!-- Rangkuman -->
                    <div id="rangkuman">
                        <h4 class="mb-3">Rangkuman Materi</h4>
                        <?php if(empty($materi)): ?>
                            <div class="alert alert-info">
                                Belum ada materi yang tersedia.
                            </div>
                        <?php else: ?>
                            <?php foreach($materi as $m): ?>
                                <div class="mb-4">
                                    <h5><?= $m['judul'] ?></h5>
                                    <p><?= substr(strip_tags($m['konten']), 0, 200) ?>...</p>
                                    <button class="btn btn-sm btn-outline-primary" onclick="showMateri(<?= $m['id'] ?>)">
                                        Baca Selengkapnya
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Detail Materi (Hidden by default) -->
                    <?php foreach($materi as $m): ?>
                        <div id="materi-<?= $m['id'] ?>" class="materi-detail" style="display: none;">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4><?= $m['judul'] ?></h4>
                                <?php if($is_admin): ?>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning" onclick="editMateri(<?= $m['id'] ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="hapusMateri(<?= $m['id'] ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="materi-content mb-3">
                                <?= nl2br($m['konten']) ?>
                            </div>

                            <?php if($m['file_lampiran']): ?>
                            <div class="mt-3">
                                <a href="<?= base_url('uploads/materi/' . $m['file_lampiran']) ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fas fa-download"></i> Download Lampiran
                                </a>
                            </div>
                            <?php endif; ?>

                            <button class="btn btn-secondary mt-3" onclick="showRangkuman()">
                                <i class="fas fa-arrow-left"></i> Kembali ke Rangkuman
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($is_admin): ?>
<!-- Modal Tambah Materi -->
<div class="modal fade" id="tambahMateriModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Materi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahMateri" enctype="multipart/form-data">
                    <input type="hidden" name="sub_bab_id" value="<?= $sub_bab['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea class="form-control" name="konten" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Lampiran (Opsional)</label>
                        <input type="file" class="form-control" name="file_lampiran">
                        <small class="text-muted">Format yang diizinkan: PDF, DOC, DOCX, PPT, PPTX. Maksimal 10MB.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="urutan" value="0" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanMateri()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Materi -->
<div class="modal fade" id="editMateriModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditMateri" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit_materi_id">
                    <div class="mb-3">
                        <label class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" name="judul" id="edit_materi_judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea class="form-control" name="konten" id="edit_materi_konten" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Lampiran (Opsional)</label>
                        <input type="file" class="form-control" name="file_lampiran">
                        <small class="text-muted">Format yang diizinkan: PDF, DOC, DOCX, PPT, PPTX. Maksimal 10MB.</small>
                        <div id="current_file" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="urutan" id="edit_materi_urutan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanEditMateri()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
function simpanMateri() {
    const formData = new FormData($('#formTambahMateri')[0]);
    
    $.ajax({
        url: '<?= base_url('matakuliah/tambah_materi') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if(data.success) {
                    location.reload();
                } else {
                    alert(data.error || 'Gagal menyimpan materi');
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Terjadi kesalahan saat memproses response server');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax Error:', {xhr, status, error});
            alert('Terjadi kesalahan saat menyimpan materi');
        }
    });
}

// Fungsi untuk menampilkan detail materi
function showMateri(id) {
    // Sembunyikan rangkuman
    document.getElementById('rangkuman').style.display = 'none';
    
    // Sembunyikan semua detail materi
    document.querySelectorAll('.materi-detail').forEach(el => {
        el.style.display = 'none';
    });
    
    // Tampilkan detail materi yang dipilih
    document.getElementById('materi-' + id).style.display = 'block';
    
    // Update active state di sidebar
    document.querySelectorAll('.subtopik-item').forEach(el => {
        el.classList.remove('active');
    });
    document.querySelector(`[href="#materi-${id}"]`).classList.add('active');
}

// Fungsi untuk kembali ke rangkuman
function showRangkuman() {
    // Sembunyikan semua detail materi
    document.querySelectorAll('.materi-detail').forEach(el => {
        el.style.display = 'none';
    });
    
    // Tampilkan rangkuman
    document.getElementById('rangkuman').style.display = 'block';
    
    // Remove active state dari sidebar
    document.querySelectorAll('.subtopik-item').forEach(el => {
        el.classList.remove('active');
    });
}

// Fungsi untuk menampilkan modal edit materi
function editMateri(id) {
    // Ambil data materi dari server
    $.ajax({
        url: '<?= base_url('matakuliah/get_materi/') ?>' + id,
        type: 'GET',
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if(data.success) {
                    // Isi form dengan data yang ada
                    $('#edit_materi_id').val(data.data.id);
                    $('#edit_materi_judul').val(data.data.judul);
                    $('#edit_materi_konten').val(data.data.konten);
                    $('#edit_materi_urutan').val(data.data.urutan);
                    
                    // Tampilkan info file lampiran jika ada
                    if(data.data.file_lampiran) {
                        $('#current_file').html(
                            `<p>File saat ini: ${data.data.file_lampiran}</p>
                             <small class="text-muted">Upload file baru untuk mengganti file yang ada</small>`
                        );
                    } else {
                        $('#current_file').empty();
                    }
                    
                    // Tampilkan modal
                    $('#editMateriModal').modal('show');
                } else {
                    alert(data.error || 'Gagal mengambil data materi');
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Terjadi kesalahan saat memproses response server');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax Error:', {xhr, status, error});
            alert('Terjadi kesalahan saat mengambil data materi');
        }
    });
}

// Fungsi untuk menyimpan perubahan materi
function simpanEditMateri() {
    const formData = new FormData($('#formEditMateri')[0]);
    
    $.ajax({
        url: '<?= base_url('matakuliah/edit_materi') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if(data.success) {
                    location.reload();
                } else {
                    alert(data.error || 'Gagal menyimpan perubahan');
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Terjadi kesalahan saat memproses response server');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax Error:', {xhr, status, error});
            alert('Terjadi kesalahan saat menyimpan perubahan');
        }
    });
}

// Fungsi untuk menghapus materi
function hapusMateri(id) {
    if(confirm('Yakin ingin menghapus materi ini?')) {
        $.ajax({
            url: '<?= base_url('matakuliah/hapus_materi/') ?>' + id,
            type: 'GET',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if(data.success) {
                        location.reload();
                    } else {
                        alert(data.error || 'Gagal menghapus materi');
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    alert('Terjadi kesalahan saat memproses response server');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax Error:', {xhr, status, error});
                alert('Terjadi kesalahan saat menghapus materi');
            }
        });
    }
}
</script>

<style>
.card {
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.breadcrumb {
    background: none;
    padding: 0;
}

.breadcrumb-item a {
    color: var(--primary);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--secondary);
}

.list-group-item {
    border: none;
    border-radius: 0 !important;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.list-group-item:hover,
.list-group-item.active {
    background-color: var(--primary);
    color: white;
    transform: translateX(5px);
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.btn-group .btn i {
    font-size: 0.875rem;
}

.materi-content {
    line-height: 1.8;
}

@media (max-width: 768px) {
    .col-md-3 {
        margin-bottom: 2rem;
    }
}
</style>
<?php endif; ?> 