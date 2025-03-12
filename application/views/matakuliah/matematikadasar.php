<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Matematika Dasar</h2>
            
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
                                    <?= $b['nama_bab'] ?>
                                </h5>
                                <?php if($is_admin): ?>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success" onclick="tambahSubBab(<?= $b['id'] ?>)">
                                        <i class="fas fa-plus"></i> Sub Bab
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="editBab(<?= $b['id'] ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="hapusBab(<?= $b['id'] ?>, '<?= htmlspecialchars($b['nama_bab'], ENT_QUOTES) ?>')">
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

<script>
// Fungsi untuk menampilkan modal tambah sub bab
function tambahSubBab(babId) {
    $('#bab_id').val(babId);
    $('#tambahSubBabModal').modal('show');
}

// Fungsi untuk menyimpan bab baru
function simpanBab() {
    const formData = new FormData($('#formTambahBab')[0]);
    
    // Debug: tampilkan data yang akan dikirim
    console.log('Data yang akan dikirim:', {
        matakuliah_id: formData.get('matakuliah_id'),
        nama_bab: formData.get('nama_bab'),
        urutan: formData.get('urutan')
    });
    
    $.ajax({
        url: '<?= base_url('matakuliah/tambah_bab') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Response:', response); // Debug
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

// Fungsi-fungsi edit dan hapus akan ditambahkan nanti
function editBab(id) {
    alert('Fitur edit bab akan segera hadir');
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

function editSubBab(id) {
    alert('Fitur edit sub bab akan segera hadir');
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