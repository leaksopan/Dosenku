<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Admin Panel</h1>
            <div class="row g-4">
                <?php foreach($menu_items as $item): ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="<?= base_url($item['url']) ?>" class="text-decoration-none">
                            <div class="card h-100 admin-menu-card">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <div class="menu-letter">
                                        <?= $item['id'] === 'A' ? 'Mengelola Dosen' : $item['id'] ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.admin-menu-card {
    transition: all 0.3s ease;
    border: 2px solid #eee;
    border-radius: 15px;
    overflow: hidden;
    position: relative;
    background: white;
    aspect-ratio: 1;
}

.admin-menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    border-color: var(--primary);
}

.menu-letter {
    font-size: 2rem;
    font-weight: bold;
    color: var(--primary);
    text-align: center;
    padding: 1rem;
}

.card-body {
    min-height: 200px;
}
</style> 