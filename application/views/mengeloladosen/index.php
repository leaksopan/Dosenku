<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Mengelola Akun Dosen</h3>
        <a href="<?= base_url('mengeloladosen/add') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Dosen
        </a>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($dosen_list)): ?>
                            <?php foreach($dosen_list as $i => $dosen): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $dosen->username ?></td>
                                    <td><?= $dosen->email ?></td>
                                    <td>
                                        <a href="<?= base_url('mengeloladosen/edit/'.$dosen->id) ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete(<?= $dosen->id ?>)" 
                                                class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data dosen</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        window.location.href = '<?= base_url('mengeloladosen/delete/') ?>' + id;
    }
}
</script> 