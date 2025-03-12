<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kelola Blog</h2>
                <a href="<?= base_url('admin/tambah_blog') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Blog Baru
                </a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Gambar</th>
                                    <th width="30%">Judul</th>
                                    <th width="20%">Tanggal</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($blogs)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada blog yang tersedia.</td>
                                </tr>
                                <?php else: ?>
                                <?php $no = 1; foreach($blogs as $blog): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if($blog['gambar'] && file_exists('./uploads/blog/' . $blog['gambar'])): ?>
                                        <img src="<?= base_url('uploads/blog/' . $blog['gambar']) ?>" 
                                             alt="<?= $blog['judul'] ?>" 
                                             class="img-thumbnail" 
                                             style="max-height: 80px;">
                                        <?php else: ?>
                                        <div class="bg-light text-center py-3">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $blog['judul'] ?></td>
                                    <td>
                                        <small>
                                            <i class="fas fa-calendar-alt"></i> 
                                            <?= date('d M Y', strtotime($blog['created_at'])) ?>
                                            <br>
                                            <i class="fas fa-clock"></i> 
                                            <?= date('H:i', strtotime($blog['created_at'])) ?>
                                        </small>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('blog/view/' . $blog['id']) ?>" class="btn btn-sm btn-info mb-1" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/edit_blog/' . $blog['id']) ?>" class="btn btn-sm btn-warning mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/hapus_blog/' . $blog['id']) ?>" 
                                           class="btn btn-sm btn-danger mb-1" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus blog ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 