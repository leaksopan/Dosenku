<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mengelola Mata Kuliah</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus me-2"></i>Tambah Mata Kuliah
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
                            <th>Nama Mata Kuliah</th>
                            <th>Jurusan</th>
                            <th>Icon</th>
                            <th>Tanggal Dibuat</th>
                            <th>Terakhir Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($matakuliah as $mk): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mk['nama'] ?></td>
                            <td><?= $mk['nama_jurusan'] ?></td>
                            <td><i class="fas <?= $mk['icon'] ?>"></i></td>
                            <td><?= date('d/m/Y H:i', strtotime($mk['created_at'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($mk['updated_at'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-info me-1" 
                                        onclick="editMatakuliah(<?= $mk['id'] ?>, '<?= $mk['nama'] ?>', <?= $mk['jurusan_id'] ?>, '<?= $mk['icon'] ?>')"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('mengelolamatakuliah/hapus/' . $mk['id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')"
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
                <h5 class="modal-title">Tambah Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mengelolamatakuliah/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan_id" class="form-label">Jurusan</label>
                        <select class="form-select" id="jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            <?php foreach($jurusan as $j): ?>
                                <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <select class="form-select" id="icon" name="icon" required>
                            <option value="fa-book">📚 Buku (Default)</option>
                            <option value="fa-code">💻 Kode</option>
                            <option value="fa-laptop-code">🖥️ Laptop</option>
                            <option value="fa-database">🗄️ Database</option>
                            <option value="fa-microchip">🔧 Microchip</option>
                            <option value="fa-network-wired">🌐 Jaringan</option>
                            <option value="fa-cogs">⚙️ Settings</option>
                            <option value="fa-project-diagram">📊 Diagram</option>
                            <option value="fa-language">🗣️ Bahasa</option>
                            <option value="fa-shield-alt">🛡️ Keamanan</option>
                            <option value="fa-globe">🌍 Web</option>
                            <option value="fa-brain">🧠 AI</option>
                        </select>
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
                <h5 class="modal-title">Edit Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mengelolamatakuliah/ubah') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jurusan_id" class="form-label">Jurusan</label>
                        <select class="form-select" id="edit_jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            <?php foreach($jurusan as $j): ?>
                                <option value="<?= $j['id'] ?>"><?= $j['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_icon" class="form-label">Icon</label>
                        <select class="form-select" id="edit_icon" name="icon" required>
                            <option value="fa-book">📚 Buku (Default)</option>
                            <option value="fa-code">💻 Kode</option>
                            <option value="fa-laptop-code">🖥️ Laptop</option>
                            <option value="fa-database">🗄️ Database</option>
                            <option value="fa-microchip">🔧 Microchip</option>
                            <option value="fa-network-wired">🌐 Jaringan</option>
                            <option value="fa-cogs">⚙️ Settings</option>
                            <option value="fa-project-diagram">📊 Diagram</option>
                            <option value="fa-language">🗣️ Bahasa</option>
                            <option value="fa-shield-alt">🛡️ Keamanan</option>
                            <option value="fa-globe">🌍 Web</option>
                            <option value="fa-brain">🧠 AI</option>
                        </select>
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
function editMatakuliah(id, nama, jurusan_id, icon) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_jurusan_id').value = jurusan_id;
    document.getElementById('edit_icon').value = icon;
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