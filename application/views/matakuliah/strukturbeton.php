<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Struktur Beton</h2>
            
            <?php if($is_admin): ?>
            <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahBabModal">
                <i class="fas fa-plus"></i> Tambah Bab
            </button>
            <?php endif; ?>

            <div class="bab-container">
                <?php if(empty($bab)): ?>
                    <div class="alert alert-info">
                        Belum ada bab yang tersedia.
                    </div>
                <?php else: ?>
                    <?php foreach($bab as $b): ?>
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <?= $b['judul'] ?>
                                </h5>
                                <?php if($is_admin): ?>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success" onclick="tambahSubBab(<?= $b['id'] ?>)">
                                        <i class="fas fa-plus"></i> Sub Bab
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="editBab(<?= $b['id'] ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="hapusBab(<?= $b['id'] ?>, '<?= htmlspecialchars($b['judul'], ENT_QUOTES) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-body">
                                <?php if(empty($b['sub_bab'])): ?>
                                    <p class="text-muted">Belum ada sub bab.</p>
                                <?php else: ?>
                                    <div class="list-group">
                                        <?php foreach($b['sub_bab'] as $sb): ?>
                                            <a href="<?= base_url('matakuliah/view/' . $sb['id']) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1"><?= $sb['nama_sub_bab'] ?></h6>
                                                </div>
                                                <?php if($is_admin): ?>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-warning" onclick="event.preventDefault(); editSubBab(<?= $sb['id'] ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); hapusSubBab(<?= $sb['id'] ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <?php endif; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if($is_admin): ?>
<!-- Modal Tambah Bab -->
<div class="modal fade" id="tambahBabModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Bab Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahBab">
                    <input type="hidden" name="matakuliah_id" value="<?= $matakuliah['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Bab</label>
                        <input type="text" class="form-control" name="nama_bab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="urutan" value="0" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanBab()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Sub Bab -->
<div class="modal fade" id="tambahSubBabModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub Bab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahSubBab">
                    <input type="hidden" name="bab_id" id="bab_id">
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Bab</label>
                        <input type="text" class="form-control" name="nama_sub_bab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="urutan" value="0" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanSubBab()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Bab -->
<div class="modal fade" id="editBabModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditBab">
                    <input type="hidden" name="id" id="edit_bab_id">
                    <div class="mb-3">
                        <label class="form-label">Judul Bab</label>
                        <input type="text" class="form-control" name="judul" id="edit_judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="edit_deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="urutan" id="edit_urutan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanEditBab()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Sub Bab -->
<div class="modal fade" id="editSubBabModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Bab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditSubBab">
                    <input type="hidden" name="id" id="edit_sub_bab_id">
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Bab</label>
                        <input type="text" class="form-control" name="nama_sub_bab" id="edit_nama_sub_bab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="urutan" id="edit_sub_bab_urutan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanEditSubBab()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk menampilkan modal tambah sub bab
function tambahSubBab(babId) {
    $('#bab_id').val(babId);
    $('#tambahSubBabModal').modal('show');
}

// Fungsi untuk menyimpan bab baru
function simpanBab() {
    const formData = new FormData($('#formTambahBab')[0]);
    
    $.ajax({
        url: '<?= base_url('matakuliah/tambah_bab') ?>',
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
                    alert(data.error || 'Gagal menyimpan bab');
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Terjadi kesalahan saat memproses response server');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax Error:', {xhr, status, error});
            alert('Terjadi kesalahan saat menyimpan bab: ' + error);
        }
    });
}

// Fungsi untuk menyimpan sub bab
function simpanSubBab() {
    const formData = new FormData($('#formTambahSubBab')[0]);
    
    $.ajax({
        url: '<?= base_url('matakuliah/tambah_sub_bab') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            const data = JSON.parse(response);
            if(data.success) {
                location.reload();
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat menyimpan sub bab');
        }
    });
}

// Fungsi untuk menampilkan modal edit bab
function editBab(id) {
    $.ajax({
        url: '<?= base_url('matakuliah/get_bab/') ?>' + id,
        type: 'GET',
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if(data.success) {
                    $('#edit_bab_id').val(data.data.id);
                    $('#edit_judul').val(data.data.judul);
                    $('#edit_deskripsi').val(data.data.deskripsi);
                    $('#edit_urutan').val(data.data.urutan);
                    
                    $('#editBabModal').modal('show');
                } else {
                    alert(data.error || 'Gagal mengambil data bab');
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Terjadi kesalahan saat memproses response server');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax Error:', {xhr, status, error});
            alert('Terjadi kesalahan saat mengambil data bab');
        }
    });
}

// Fungsi untuk menyimpan perubahan bab
function simpanEditBab() {
    const formData = new FormData($('#formEditBab')[0]);
    
    $.ajax({
        url: '<?= base_url('matakuliah/edit_bab') ?>',
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

// Fungsi untuk menampilkan modal edit sub bab
function editSubBab(id) {
    $.ajax({
        url: '<?= base_url('matakuliah/get_sub_bab/') ?>' + id,
        type: 'GET',
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if(data.success) {
                    $('#edit_sub_bab_id').val(data.data.id);
                    $('#edit_nama_sub_bab').val(data.data.nama_sub_bab);
                    $('#edit_sub_bab_urutan').val(data.data.urutan);
                    
                    $('#editSubBabModal').modal('show');
                } else {
                    alert(data.error || 'Gagal mengambil data sub bab');
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Terjadi kesalahan saat memproses response server');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax Error:', {xhr, status, error});
            alert('Terjadi kesalahan saat mengambil data sub bab');
        }
    });
}

// Fungsi untuk menyimpan perubahan sub bab
function simpanEditSubBab() {
    const formData = new FormData($('#formEditSubBab')[0]);
    
    $.ajax({
        url: '<?= base_url('matakuliah/edit_sub_bab') ?>',
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

function hapusBab(id, judul) {
    if (confirm('Apakah Anda yakin ingin menghapus bab "' + judul + '"?\nSemua sub bab dan materi di dalamnya juga akan dihapus.')) {
        $.ajax({
            url: '<?= base_url('matakuliah/hapus_bab/') ?>' + id,
            type: 'POST',
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus bab: ' + (data.error || 'Terjadi kesalahan'));
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus bab');
            }
        });
    }
}

function hapusSubBab(id) {
    if(confirm('Apakah Anda yakin ingin menghapus sub bab ini?\nSemua materi di dalamnya juga akan dihapus.')) {
        $.ajax({
            url: '<?= base_url('matakuliah/hapus_sub_bab/') ?>' + id,
            type: 'POST',
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus sub bab: ' + (data.error || 'Terjadi kesalahan'));
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus sub bab');
            }
        });
    }
}
</script>

<style>
.bab-container .card {
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.bab-container .card-header {
    background-color: #f8f9fa;
    border-bottom: none;
}

.list-group-item {
    border: none;
    margin-bottom: 5px;
    border-radius: 5px !important;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.btn-group .btn i {
    font-size: 0.875rem;
}
</style>
<?php endif; ?> 