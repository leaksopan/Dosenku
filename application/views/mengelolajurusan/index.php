<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mengelola Jurusan</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus me-2"></i>Tambah Jurusan
        </button>
    </div>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th>Tanggal Dibuat</th>
                            <th>Terakhir Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($jurusan as $j): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $j['nama_jurusan'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($j['created_at'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($j['updated_at'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-info me-1" 
                                        onclick="editJurusan(<?= $j['id'] ?>, '<?= $j['nama_jurusan'] ?>')"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('mengelolajurusan/hapus/' . $j['id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')"
                                   title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mengelolajurusan/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mengelolajurusan/ubah') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="edit_nama_jurusan" name="nama_jurusan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editJurusan(id, nama) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama_jurusan').value = nama;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>

<style>
.btn-info {
    color: white;
    background-color: var(--primary);
    border-color: var(--primary);
}

.btn-info:hover {
    color: white;
    background-color: var(--secondary);
    border-color: var(--secondary);
}
</style> 