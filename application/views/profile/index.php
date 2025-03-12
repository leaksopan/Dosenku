<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Profile Saya</h4>
                        <button class="btn btn-primary btn-sm" onclick="toggleEdit()">
                            <i class="fas fa-edit me-1"></i>Edit Profile
                        </button>
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

                    <!-- View Mode -->
                    <div id="viewMode">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width: 200px">Username</th>
                                    <td><?= $user->username ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $user->email ?></td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td><span class="badge bg-primary"><?= ucfirst($user->role) ?></span></td>
                                </tr>
                                <tr>
                                    <th>Login Terakhir</th>
                                    <td><?= $user->last_login ? date('d/m/Y H:i', strtotime($user->last_login)) : '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Edit Mode -->
                    <div id="editMode" style="display: none;">
                        <?= form_open('profile/edit') ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="username" 
                                       name="username" 
                                       value="<?= $user->username ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="<?= $user->email ?>" 
                                       required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Simpan
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="toggleEdit()">
                                    <i class="fas fa-times me-1"></i>Batal
                                </button>
                            </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEdit() {
    const viewMode = document.getElementById('viewMode');
    const editMode = document.getElementById('editMode');
    
    if (viewMode.style.display === 'none') {
        viewMode.style.display = 'block';
        editMode.style.display = 'none';
    } else {
        viewMode.style.display = 'none';
        editMode.style.display = 'block';
    }
}
</script> 