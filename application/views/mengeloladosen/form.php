<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <?= isset($dosen) ? 'Edit Data Dosen' : 'Tambah Dosen Baru' ?>
                    </h4>

                    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

                    <?= form_open(isset($dosen) ? 'mengeloladosen/edit/'.$dosen->id : 'mengeloladosen/add') ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="username" 
                                   name="username" 
                                   value="<?= set_value('username', isset($dosen) ? $dosen->username : '') ?>" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                                <?php if(isset($dosen)): ?>
                                    <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small>
                                <?php endif; ?>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password"
                                   <?= isset($dosen) ? '' : 'required' ?>>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="<?= set_value('email', isset($dosen) ? $dosen->email : '') ?>" 
                                   required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                            <a href="<?= base_url('mengeloladosen') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div> 